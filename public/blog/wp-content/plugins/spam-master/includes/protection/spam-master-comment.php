<?php
global $wpdb, $blog_id;
//Add Table & Load Spam Master Options
if(is_multisite()){
	$spam_master_keys = $wpdb->get_blog_prefix($blog_id)."spam_master_keys";
}
else{
	$spam_master_keys = $wpdb->prefix."spam_master_keys";
}
$spam_master_status = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_status'");
$spam_master_comment_strict_on = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_comment_strict_on'");

//Set malfunctions as VALID
if($spam_master_status == 'VALID' || $spam_master_status == 'MALFUNCTION_1' || $spam_master_status == 'MALFUNCTION_2'){
	if($spam_master_comment_strict_on == 'true'){
		add_filter( 'pre_comment_approved', 'spam_master_comment_learning', 99, 2 );
		add_filter( 'pre_trackback_post', 'spam_master_comment_learning', 99, 2 );
		function spam_master_comment_learning($approved, $commentdata){
		global $wpdb, $blog_id;

			//Add Table & Load Spam Master Options
			if(is_multisite()){
				$spam_master_keys = $wpdb->get_blog_prefix($blog_id)."spam_master_keys";
			}
			else{
				$spam_master_keys = $wpdb->prefix."spam_master_keys";
			}
			$spam_master_alert_level = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_alert_level'");
			$spam_master_message = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_message'");
			$comment_russian_char = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'comment_russian_char'");
			$comment_chinese_char = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'comment_chinese_char'");
			$comment_asian_char = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'comment_asian_char'");
			$comment_arabic_char = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'comment_arabic_char'");
			$comment_spam_char = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'comment_spam_char'");

			//Remote Ip
			$remote_ip = substr($_SERVER['REMOTE_ADDR'],0,48);
			//Remote Agent
			if(isset($_SERVER['HTTP_USER_AGENT'])){
				$remote_agent = substr($_SERVER['HTTP_USER_AGENT'],0,360);
			}
			else{
				$remote_agent = 'Sniffer';
			}
			// Remote Referer
			if(isset($_SERVER['HTTP_REFERER'])){
				$remote_referer = substr($_SERVER['HTTP_REFERER'],0,360);
			}
			else{
				$remote_referer = 'Direct';
			}
			// DEST URL
			if(isset($_SERVER['REQUEST_URI'])){
				$dest_url = substr($_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'],0,360);
			}
			else{
				$dest_url = 'Weird';
			}
			//exempt admins from check
			if(!function_exists('wp_get_current_user')) {
				include(ABSPATH . "wp-includes/pluggable.php"); 
			}
			// Current User
			$current_user_id = get_current_user_id();
			if(!empty($current_user_id) && $current_user_id != '0'){
				$spam_new_user = get_userdata($current_user_id);
				if(!empty($spam_new_user)){
					$spam_username = $spam_new_user->user_login;
					$blog_threat_email = $spam_new_user->user_email;
				}
				else{
					$spam_username = 'none';
					$blog_threat_email = 'comment@'.rand(10000000, 99999999).'.wp';
				}
				$spam_avatar = get_avatar( $current_user_id, 64, '', $current_user_id, array('scheme' => 'https', 'force_display' => true));
				$spamuser = array('ID' => $current_user_id, 'username' => $spam_username, 'avatar' => $spam_avatar);
			}
			else{
				$spamuser = array('ID' => 'none');
				//Prepare Email
				if (!empty($commentdata['comment_author_email'])) {
					if (filter_var($commentdata['comment_author_email'], FILTER_VALIDATE_EMAIL)) {
						$blog_threat_email = wp_strip_all_tags(substr($commentdata['comment_author_email'],0,256));
					}
					else{
						$blog_threat_email = 'comment@'.rand(10000000, 99999999).'.wp';
					}
				}
				else{
					$blog_threat_email = 'comment@'.rand(10000000, 99999999).'.wp';
				}
			}
			$spamuserA = json_encode($spamuser, true);

			//check Trackback or Comment
			if(is_trackback()){
				//Spam Master page
				$spam_master_page = 'Trackback';

				@$request_array = 'HTTP_POST_VARS';
				$blog_threat_type = 'trackback';

				$blog_threat_email = 'trackback@'.date('YmdHis').'.wp';
				$tb_url = $_POST['url'];
				if(empty($tb_url)){
					$tb_url = 'empty url';
				}
				$title  = $_POST['title'];
				if(empty($title)){
					$title = 'empty title';
				}
				$excerpt = $_POST['excerpt'];
				if(empty($excerpt)){
					$excerpt = 'empty excerpt';
				}
				$join_tbs = 'URL: '.$tb_url.' - NAME: '.$title.' - TITLE: '.$title.' - EXC: '.$excerpt;
				$result_comment_content_trim = substr($join_tbs,0,360);
				$result_comment_content_clean = wp_strip_all_tags(stripslashes_deep($result_comment_content_trim), true);
			}
			else{
				//Spam Master page
				$spam_master_page = 'Comment';

				$result_comment_content_trim = substr($commentdata['comment_content'],0,360);
				$result_comment_content_clean = wp_strip_all_tags(stripslashes_deep($result_comment_content_trim), true);
			}

			//Spam White Controller
			////////////////////////
			$spamtype = $spam_master_page;
			$SpamMasterWhiteController = new SpamMasterWhiteController;
			$is_spamadmin = $SpamMasterWhiteController->SpamMasterWhiteAdmin($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype);
			if(!empty($is_spamadmin)){
				$approved = '1';
				return $approved;
			}

			//Spam White Controller
			////////////////////////
			$spamtype = $spam_master_page;
			$SpamMasterWhiteController = new SpamMasterWhiteController;
			$is_white = $SpamMasterWhiteController->SpamMasterWhiteSearch($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype);
			if(!empty($is_white)){
				$approved = '1';
				return $approved;
			}

			//Spam Buffer Controller
			////////////////////////
			$SpamMasterBufferController = new SpamMasterBufferController;
			$is_buffer = $SpamMasterBufferController->SpamMasterBufferSearch($remote_ip, $blog_threat_email);
			if(!empty($is_buffer)){
				$approved = 'spam';
				return new WP_Error( 'require_valid_email', __( '<strong>SPAM MASTER</strong> '.$spam_master_message.'' ), 200 );
				return $approved;
			}

			///////////////////////////////////
			//lets do a quick character block//
			///////////////////////////////////
			$contact_russian_char = false;
			$contact_chinese_char = false;
			$contact_asian_char = false;
			$contact_arabic_char = false;
			$contact_spam_char = false;
	
			if ($comment_russian_char == 'true'){
				//Spam ComCon Controller
				////////////////////////
				$SpamMasterComConController = new SpamMasterComConController;
				$is_char = $SpamMasterComConController->SpamMasterCharScan($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spam_master_page, $result_comment_content_clean, $comment_russian_char, $comment_chinese_char, $comment_asian_char, $comment_arabic_char, $comment_spam_char, $contact_russian_char, $contact_chinese_char, $contact_asian_char, $contact_arabic_char, $contact_spam_char);
				if($is_char){
					$approved = 'spam';
					return $approved;
				}
			}
			if ($comment_chinese_char == 'true'){
				//Spam ComCon Controller
				////////////////////////
				$SpamMasterComConController = new SpamMasterComConController;
				$is_char = $SpamMasterComConController->SpamMasterCharScan($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spam_master_page, $result_comment_content_clean, $comment_russian_char, $comment_chinese_char, $comment_asian_char, $comment_arabic_char, $comment_spam_char, $contact_russian_char, $contact_chinese_char, $contact_asian_char, $contact_arabic_char, $contact_spam_char);
				if($is_char){
					$approved = 'spam';
					return $approved;
				}
			}
			if ($comment_asian_char == 'true'){
				//Spam ComCon Controller
				////////////////////////
				$SpamMasterComConController = new SpamMasterComConController;
				$is_char = $SpamMasterComConController->SpamMasterCharScan($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spam_master_page, $result_comment_content_clean, $comment_russian_char, $comment_chinese_char, $comment_asian_char, $comment_arabic_char, $comment_spam_char, $contact_russian_char, $contact_chinese_char, $contact_asian_char, $contact_arabic_char, $contact_spam_char);
				if($is_char){
					$approved = 'spam';
					return $approved;
				}
			}
			if ($comment_arabic_char == 'true'){
				//Spam ComCon Controller
				////////////////////////
				$SpamMasterComConController = new SpamMasterComConController;
				$is_char = $SpamMasterComConController->SpamMasterCharScan($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spam_master_page, $result_comment_content_clean, $comment_russian_char, $comment_chinese_char, $comment_asian_char, $comment_arabic_char, $comment_spam_char, $contact_russian_char, $contact_chinese_char, $contact_asian_char, $contact_arabic_char, $contact_spam_char);
				if($is_char){
					$approved = 'spam';
					return $approved;
				}
			}
			if ($comment_spam_char == 'true'){
				//Spam ComCon Controller
				////////////////////////
				$SpamMasterComConController = new SpamMasterComConController;
				$is_char = $SpamMasterComConController->SpamMasterCharScan($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spam_master_page, $result_comment_content_clean, $comment_russian_char, $comment_chinese_char, $comment_asian_char, $comment_arabic_char, $comment_spam_char, $contact_russian_char, $contact_chinese_char, $contact_asian_char, $contact_arabic_char, $contact_spam_char);
				if($is_char){
					$approved = 'spam';
					return $approved;
				}
			}

			//Spam ComCon Controller
			////////////////////////
			$SpamMasterComConController = new SpamMasterComConController;
			$is_comcon = $SpamMasterComConController->SpamMasterComConScan($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spam_master_page, $result_comment_content_clean);
			if($is_comcon){
				$approved = 'spam';
				return $approved;
			}
			else{
				$approved = '0';
				return $approved;
			}
		//end func comments
		}
	//end spam_master_comment_strict_on
	}
//end valid
}
?>
