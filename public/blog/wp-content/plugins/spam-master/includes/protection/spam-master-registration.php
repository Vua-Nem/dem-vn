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

// Multisite Block
if( is_multisite()){
	//Set malfunctions as VALID
	//post data if license status is valid
	if($spam_master_status == 'VALID' || $spam_master_status == 'MALFUNCTION_1' || $spam_master_status == 'MALFUNCTION_2'){
		add_filter('wpmu_validate_user_signup', 'spam_master_registration_multi', 99);
		function spam_master_registration_multi($result){
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

			//Spam Master page
			$spam_master_page = 'Registration';

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
					$blog_threat_email = 'registration@'.rand(10000000, 99999999).'.wp';
				}
				$spam_avatar = get_avatar( $current_user_id, 64, '', $current_user_id, array('scheme' => 'https', 'force_display' => true));
				$spamuser = array('ID' => $current_user_id, 'username' => $spam_username, 'avatar' => $spam_avatar);
			}
			else{
				$spamuser = array('ID' => 'none');
				//Prepare Email
				if (!empty($result['user_email'])) {
					if (filter_var($result['user_email'], FILTER_VALIDATE_EMAIL)) {
						$blog_threat_email = wp_strip_all_tags(substr($result['user_email'],0,256));
					}
					else{
						$blog_threat_email = 'registration@'.rand(10000000, 99999999).'.wp';
					}
				}
				else{
					$blog_threat_email = 'registration@'.rand(10000000, 99999999).'.wp';
				}
			}
			$spamuserA = json_encode($spamuser, true);

			//Spam White Controller
			////////////////////////
			$spamtype = $spam_master_page;
			$SpamMasterWhiteController = new SpamMasterWhiteController;
			$is_spamadmin = $SpamMasterWhiteController->SpamMasterWhiteAdmin($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype);
			if(!empty($is_spamadmin)){
			}

			//Spam White Controller
			////////////////////////
			$spamtype = $spam_master_page;
			$SpamMasterWhiteController = new SpamMasterWhiteController;
			$is_white = $SpamMasterWhiteController->SpamMasterWhiteSearch($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype);
			if(!empty($is_white)){
			}

			//Spam Buffer Controller
			////////////////////////
			$SpamMasterBufferController = new SpamMasterBufferController;
			$is_buffer = $SpamMasterBufferController->SpamMasterBufferSearch($remote_ip, $blog_threat_email);
			if(!empty($is_buffer)){
				echo '<p class="error"><strong>SPAM MASTER</strong> '.$spam_master_message.'</p>';
				exit();
			}

			//Spam Registration Controller
			////////////////////////
			$SpamMasterRegistrationController = new SpamMasterRegistrationController;
			$is_register = $SpamMasterRegistrationController->SpamMasterRegister($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spam_master_page);
			if($is_register){
				echo '<p class="error"><strong>SPAM MASTER</strong> '.$spam_master_message.'</p>';
				exit();
			}

			return $result;
		//end func
		}
	//end valid
	}
//end multi
}
//SingleSite Block
else{
	//post data if license status is valid
	//Set malfunctions as VALID
	if($spam_master_status == 'VALID' || $spam_master_status == 'MALFUNCTION_1' || $spam_master_status == 'MALFUNCTION_2'){
		add_action( 'register_post', 'spam_master_registration', 11, 3 );
		function spam_master_registration($user_login, $user_email, $errors){
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

			//Spam Master page
			$spam_master_page = 'Registration';

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
					$blog_threat_email = 'registration@'.rand(10000000, 99999999).'.wp';
				}
				$spam_avatar = get_avatar( $current_user_id, 64, '', $current_user_id, array('scheme' => 'https', 'force_display' => true));
				$spamuser = array('ID' => $current_user_id, 'username' => $spam_username, 'avatar' => $spam_avatar);
			}
			else{
				$spamuser = array('ID' => 'none');
				//Prepare Email
				if (!empty($user_email)) {
					if (filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
						$blog_threat_email = wp_strip_all_tags(substr($user_email,0,256));
					}
					else{
						$blog_threat_email = 'registration@'.rand(10000000, 99999999).'.wp';
					}
				}
				else{
					$blog_threat_email = 'registration@'.rand(10000000, 99999999).'.wp';
				}
			}
			$spamuserA = json_encode($spamuser, true);

			//Spam White Controller
			////////////////////////
			$spamtype = $spam_master_page;
			$SpamMasterWhiteController = new SpamMasterWhiteController;
			$is_spamadmin = $SpamMasterWhiteController->SpamMasterWhiteAdmin($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype);
			if(!empty($is_spamadmin)){
				return;
			}

			//Spam White Controller
			////////////////////////
			$spamtype = $spam_master_page;
			$SpamMasterWhiteController = new SpamMasterWhiteController;
			$is_white = $SpamMasterWhiteController->SpamMasterWhiteSearch($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype);
			if(!empty($is_white)){
				return;
			}

			//Spam Buffer Controller
			////////////////////////
			$SpamMasterBufferController = new SpamMasterBufferController;
			$is_buffer = $SpamMasterBufferController->SpamMasterBufferSearch($remote_ip, $blog_threat_email);
			if(!empty($is_buffer)){
				$errors->add('invalid_email', '<strong>SPAM MASTER</strong> '.$spam_master_message );
				return;
			}

			//Spam Registration Controller
			////////////////////////
			$SpamMasterRegistrationController = new SpamMasterRegistrationController;
			$is_register = $SpamMasterRegistrationController->SpamMasterRegister($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spam_master_page);
			if($is_register){
				$errors->add('invalid_email', '<strong>SPAM MASTER</strong> '.$spam_master_message );
				return;
			}
		//end func
		}
	//end valid
	}
//end single
}
?>
