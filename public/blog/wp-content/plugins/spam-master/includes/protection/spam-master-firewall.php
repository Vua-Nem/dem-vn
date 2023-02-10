<?php
global $wpdb, $blog_id;
if(is_multisite()){
	$spam_master_keys = $wpdb->get_blog_prefix($blog_id)."spam_master_keys";
}
else{
	$spam_master_keys = $wpdb->prefix."spam_master_keys";
}
$spam_master_status = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_status'");
$spam_master_cache_proxie = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_cache_proxie'");

if($spam_master_status == 'VALID' || $spam_master_status == 'MALFUNCTION_1' || $spam_master_status == 'MALFUNCTION_2'){

	///////////////////////////////
	//IMPLEMENT FIREWALL FRONTEND//
	///////////////////////////////
	add_action('init', 'spam_master_frontend_firewall', 1);
	function spam_master_frontend_firewall(){
	global $wpdb, $blog_id;

		if(is_multisite()){
			$spam_master_keys = $wpdb->get_blog_prefix($blog_id)."spam_master_keys";
		}
		else{
			$spam_master_keys = $wpdb->prefix."spam_master_keys";
		}
		$spam_master_firewall_on = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_firewall_on'");
		$spam_master_alert_level = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_alert_level'");
		$spam_master_firewall_page = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_firewall_page'");

		//Spam Master page
		$spam_master_page = 'HAF';
		//Spam Type
		$spamtype = 'HAF';

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
				$blog_threat_email = 'haf@'.rand(10000000, 99999999).'.wp';
			}
			$spam_avatar = get_avatar( $current_user_id, 64, '', $current_user_id, array('scheme' => 'https', 'force_display' => true));
			$spamuser = array('ID' => $current_user_id, 'username' => $spam_username, 'avatar' => $spam_avatar);
		}
		else{
			$spamuser = array('ID' => 'none');
			$blog_threat_email = 'haf@'.rand(10000000, 99999999).'.wp';
		}
		$spamuserA = json_encode($spamuser, true);

		//Spam White Controller
		////////////////////////
		$SpamMasterWhiteController = new SpamMasterWhiteController;
		$is_spamadmin = $SpamMasterWhiteController->SpamMasterWhiteAdmin($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype);
		if(!empty($is_spamadmin)){
		}
		else{
			//Spam White Controller
			////////////////////////
			$SpamMasterWhiteController = new SpamMasterWhiteController;
			$is_white = $SpamMasterWhiteController->SpamMasterWhiteSearch($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype);
			if(!empty($is_white)){
			}
			else{
				//Spam Buffer Controller
				////////////////////////
				$SpamMasterBufferController = new SpamMasterBufferController;
				$is_buffer = $SpamMasterBufferController->SpamMasterBufferSearch($remote_ip, $blog_threat_email);
				if(!empty($is_buffer)){

					if ($spam_master_firewall_on == 'true'){

						//Firewall Page
						wp_safe_redirect($spam_master_firewall_page);
						exit();

					}
				}
				else{
					//Token
					$pam_master_length = 25;
					$spam_master_token = bin2hex(random_bytes($pam_master_length));
					//Session
					if ( !isset( $_SESSION ) ) { 
						session_start();
					}
					if(isset($_SESSION["spam-master-token"])){
					}
					else{
						$_SESSION["spam-master-token"] = $spam_master_token;
					}
					//Cookie
					if(isset($_COOKIE["spam-master-token"])) {
					}
					else{
						$cookie_options = array(
												'expires' => time() + 3600,
												'path' => '/',
												'domain' => '.'.$_SERVER['SERVER_NAME'],
												'secure' => true,
												'httponly' => false,
												'samesite' => 'None'
						);
						setcookie("spam-master-token", $spam_master_token, $cookie_options);
					}
					if(!empty($_POST) && !is_user_logged_in()){
						//Spam Elusive Controller
						////////////////////////
						$spam_elusive = $_POST;
						$SpamMasterElusiveController = new SpamMasterElusiveController;
						$is_elusive = $SpamMasterElusiveController->SpamMasterElusive($spam_elusive);
						if($is_elusive){
							$blog_threat_email = $is_elusive;
						}
						else{
							$blog_threat_email = 'haf@'.rand(10000000, 99999999).'.wp';
						}
						//Spam HAF Controller
						////////////////////////
						$SpamMasterHAFController = new SpamMasterHAFController;
						$is_haf = $SpamMasterHAFController->SpamMasterHAF($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA);
					}
				}
			}
		}
	}

	////////////////////////////
	//IMPLEMENT PROXY FRONTEND//
	////////////////////////////
	if($spam_master_cache_proxie == 'true'){
		//Cache Control
		add_action( 'init', 'spam_master_no_cache', 0 );
		function spam_master_no_cache() {
		global $wpdb, $blog_id;

			session_cache_limiter("");
			header("Cache-Control: no-store");
			if( !session_id() ){
				session_start();
			}
		}
	}

// End Valid
}
?>
