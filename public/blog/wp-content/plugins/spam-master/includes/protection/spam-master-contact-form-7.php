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

if($spam_master_status == 'VALID' || $spam_master_status == 'MALFUNCTION_1' || $spam_master_status == 'MALFUNCTION_2'){

	add_filter('wpcf7_spam', 'spam_master_contact_form_7');
	function spam_master_contact_form_7($spam){
	global $wpdb, $blog_id;
		//buffer action
		if ( $spam ) {
			return $spam;
		}

		//Add Table & Load Spam Master Options
		if(is_multisite()){
			$spam_master_keys = $wpdb->get_blog_prefix($blog_id)."spam_master_keys";
		}
		else{
			$spam_master_keys = $wpdb->prefix."spam_master_keys";
		}
		$spam_master_alert_level = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_alert_level'");
		$spam_master_message = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_message'");
		$contact_text_override = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'contact_text_override'");
		$contact_russian_char = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'contact_russian_char'");
		$contact_chinese_char = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'contact_chinese_char'");
		$contact_asian_char = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'contact_asian_char'");
		$contact_arabic_char = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'contact_arabic_char'");
		$contact_spam_char = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'contact_spam_char'");

		//Spam Master page
		$spam_master_page = 'Contact Form';

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
				$blog_threat_email = 'contact@'.rand(10000000, 99999999).'.wp';
			}
			$spam_avatar = get_avatar( $current_user_id, 64, '', $current_user_id, array('scheme' => 'https', 'force_display' => true));
			$spamuser = array('ID' => $current_user_id, 'username' => $spam_username, 'avatar' => $spam_avatar);
		}
		else{
			$spamuser = array('ID' => 'none');
			//Prepare Email
			if (!empty($_POST['your-email'])) {
				if (filter_var($_POST['your-email'], FILTER_VALIDATE_EMAIL)) {
					$blog_threat_email = wp_strip_all_tags(substr($_POST['your-email'],0,256));
				}
				else{
					$blog_threat_email = 'contact@'.rand(10000000, 99999999).'.wp';
				}
			}
			else{
				$blog_threat_email = 'contact@'.rand(10000000, 99999999).'.wp';
			}
		}
		$spamuserA = json_encode($spamuser, true);
		if (!empty($_POST['your-message'])) {
			$result_comment_content_trim = substr($_POST['your-message'],0,360);
			$result_comment_content_clean = wp_strip_all_tags(stripslashes_deep($result_comment_content_trim), true);
		}
		else{
			$result_comment_content_clean = 'your-message';
		}

		//Spam White Controller
		////////////////////////
		$spamtype = $spam_master_page;
		$SpamMasterWhiteController = new SpamMasterWhiteController;
		$is_spamadmin = $SpamMasterWhiteController->SpamMasterWhiteAdmin($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype);
		if(!empty($is_spamadmin)){
			return false;
		}

		//Spam White Controller
		////////////////////////
		$spamtype = $spam_master_page;
		$SpamMasterWhiteController = new SpamMasterWhiteController;
		$is_white = $SpamMasterWhiteController->SpamMasterWhiteSearch($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype);
		if(!empty($is_white)){
			return false;
		}
				
		//Spam Buffer Controller
		////////////////////////
		$SpamMasterBufferController = new SpamMasterBufferController;
		$is_buffer = $SpamMasterBufferController->SpamMasterBufferSearch($remote_ip, $blog_threat_email);
		if(!empty($is_buffer)){
			return  $result['reason'] = array( 'date_too_late' => wpcf7_get_message( 'date_too_late' ) );
			exit();
		}

		///////////////////////////////////
		//lets do a quick character block//
		///////////////////////////////////
		$comment_russian_char = false;
		$comment_chinese_char = false;
		$comment_asian_char = false;
		$comment_arabic_char = false;
		$comment_spam_char = false;

		if ($contact_russian_char == 'true'){
			//Spam ComCon Controller
			////////////////////////
			$SpamMasterComConController = new SpamMasterComConController;
			$is_char = $SpamMasterComConController->SpamMasterCharScan($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spam_master_page, $result_comment_content_clean, $comment_russian_char, $comment_chinese_char, $comment_asian_char, $comment_arabic_char, $comment_spam_char, $contact_russian_char, $contact_chinese_char, $contact_asian_char, $contact_arabic_char, $contact_spam_char);
			if($is_char){
				return  $result['reason'] = array( 'spam' => wpcf7_get_message( 'spam' ) );
				exit();
			}
		}
		if ($contact_chinese_char == 'true'){
			//Spam ComCon Controller
			////////////////////////
			$SpamMasterComConController = new SpamMasterComConController;
			$is_char = $SpamMasterComConController->SpamMasterCharScan($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spam_master_page, $result_comment_content_clean, $comment_russian_char, $comment_chinese_char, $comment_asian_char, $comment_arabic_char, $comment_spam_char, $contact_russian_char, $contact_chinese_char, $contact_asian_char, $contact_arabic_char, $contact_spam_char);
			if($is_char){
				return  $result['reason'] = array( 'spam' => wpcf7_get_message( 'spam' ) );
				exit();
			}
		}
		if ($contact_asian_char == 'true'){
			//Spam ComCon Controller
			////////////////////////
			$SpamMasterComConController = new SpamMasterComConController;
			$is_char = $SpamMasterComConController->SpamMasterCharScan($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spam_master_page, $result_comment_content_clean, $comment_russian_char, $comment_chinese_char, $comment_asian_char, $comment_arabic_char, $comment_spam_char, $contact_russian_char, $contact_chinese_char, $contact_asian_char, $contact_arabic_char, $contact_spam_char);
			if($is_char){
				return  $result['reason'] = array( 'spam' => wpcf7_get_message( 'spam' ) );
				exit();
			}
		}
		if ($contact_arabic_char == 'true'){
			//Spam ComCon Controller
			////////////////////////
			$SpamMasterComConController = new SpamMasterComConController;
			$is_char = $SpamMasterComConController->SpamMasterCharScan($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spam_master_page, $result_comment_content_clean, $comment_russian_char, $comment_chinese_char, $comment_asian_char, $comment_arabic_char, $comment_spam_char, $contact_russian_char, $contact_chinese_char, $contact_asian_char, $contact_arabic_char, $contact_spam_char);
			if($is_char){
				return  $result['reason'] = array( 'spam' => wpcf7_get_message( 'spam' ) );
				exit();
			}
		}
		if ($contact_spam_char == 'true'){
			//Spam ComCon Controller
			////////////////////////
			$SpamMasterComConController = new SpamMasterComConController;
			$is_char = $SpamMasterComConController->SpamMasterCharScan($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spam_master_page, $result_comment_content_clean, $comment_russian_char, $comment_chinese_char, $comment_asian_char, $comment_arabic_char, $comment_spam_char, $contact_russian_char, $contact_chinese_char, $contact_asian_char, $contact_arabic_char, $contact_spam_char);
			if($is_char){
				return  $result['reason'] = array( 'spam' => wpcf7_get_message( 'spam' ) );
				exit();
			}
		}

		//Spam ComCon Controller
		////////////////////////
		$SpamMasterComConController = new SpamMasterComConController;
		$is_comcon = $SpamMasterComConController->SpamMasterComConScan($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spam_master_page, $result_comment_content_clean);
		if($is_comcon){
			return  $result['reason'] = array( 'spam' => wpcf7_get_message( 'spam' ) );
			exit();
		}
		else{
			return false;
		}
	//end function
	}
//end valid
}
?>
