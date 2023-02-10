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
$spam_master_honeypot_timetrap = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_honeypot_timetrap'");
$spam_master_honeypot_timetrap_speed = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_honeypot_timetrap_speed'");

if($spam_master_status == 'VALID' || $spam_master_status == 'MALFUNCTION_1' || $spam_master_status == 'MALFUNCTION_2'){

	if ($spam_master_honeypot_timetrap == 'true'){
		//MULTISITE HOOKS
		if(is_multisite()){
			add_action('signup_extra_fields', 'spam_master_honeypot_register_field', 20 );
			add_filter('wpmu_validate_user_signup', 'spam_master_honeypot_register_errors_multi', 20);
			add_action('comment_form_after_fields', 'spam_master_honeypot_register_field', 1);
			add_action('comment_form_logged_in_after', 'spam_master_honeypot_register_field', 1);
			add_filter('preprocess_comment', 'spam_master_verify_honey_comment_data', 10, 3 );
			add_filter('wpcf7_form_elements', 'spam_master_add_honeypot_to_form', 10, 1 );
			add_filter('wpcf7_spam', 'spam_master_contact_form_7_honeypot');
		}
		//SINGLE SITE HOOKS
		else{
			add_action('register_form', 'spam_master_honeypot_register_field' );
			add_action('login_form', 'spam_master_honeypot_register_field');
			add_action('comment_form_after_fields', 'spam_master_honeypot_register_field', 1);
			add_action('comment_form_logged_in_after', 'spam_master_honeypot_register_field', 1);
			add_filter('registration_errors', 'spam_master_honeypot_register_single_errors', 10, 3 );
			add_filter('login_errors', 'spam_master_honeypot_login_single_errors', 11, 1 );
			add_filter('preprocess_comment', 'spam_master_verify_honey_comment_data', 10, 3 );
			add_filter('wpcf7_form_elements', 'spam_master_add_honeypot_to_form', 10, 1 );
			add_filter('wpcf7_spam', 'spam_master_contact_form_7_honeypot');
			}

		//INSERT FIELD
		function spam_master_honeypot_register_field(){
			global $wpdb, $blog_id;

			//Reversed Ip
			$reverse_ip = strrev($_SERVER['REMOTE_ADDR']).'.'.bin2hex(random_bytes(12));

			?>
			<p class="spam-master-hidden">
			<label for="<?php echo $reverse_ip; ?>" class="spam-master-hidden"><?php echo $reverse_ip; ?><br>
			<input class="spam-master-hidden input" type="text" name="<?php echo $reverse_ip; ?>" id="<?php echo $reverse_ip; ?>" placeholder="<?php echo $reverse_ip; ?>" autocomplete="off" value="<?php echo $reverse_ip; ?>" />
			</label>
			</p>
			<noscript>
			<p class="spam-master-hidden">
			<label for="spammasterscript" class="spam-master-hidden">Js<br>
			<input class="input" type="text" name="spammasterscript" id="spammasterscript" placeholder="Spam Master Script" autocomplete="off" value="369golden" />
			</label>
			</p>
			</noscript>
			<p class="spam-master-hidden">
			<label for="mothers_name" class="spam-master-hidden"><?php _e( 'Mother Name', 'spam_master' ); ?><br>
			<input class="spam-master-hidden input" type="text" name="mothers_name" id="mothers_name" placeholder="Mother Name" autocomplete="off" value="" />
			</label>
			</p>
			<p class="spam-master-hidden">
			<label for="mothers_last_name" class="spam-master-hidden"><?php _e( 'Mother Last Name', 'spam_master' ); ?><br>
			<input class="spam-master-hidden input" type="text" name="mothers_last_name" id="mothers_last_name" placeholder="Mother Last Name" autocomplete="off" value="" />
			</label>
			</p>
			<?php
			if(isset($_SESSION["spam-master-token"]) && !empty($_SESSION["spam-master-token"])){
			?>
			<p class="spam-master-hidden">
			<label for="spam-master-token" class="spam-master-hidden"><?php _e( 'Spam Master Token', 'spam_master' ); ?><br>
			<input class="input" type="hidden" name="spam-master-token" id="spam-master-token" placeholder="Spam Master Token" autocomplete="off" value="<?php echo $_SESSION["spam-master-token"]; ?>" />
			</label>
			</p>
			<?php
			}
			if(isset($_COOKIE["spam-master-token"]) && !empty($_COOKIE["spam-master-token"])){
			?>
			<p class="spam-master-hidden">
			<label for="spam-master-token2" class="spam-master-hidden"><?php _e( 'Spam Master Token2', 'spam_master' ); ?><br>
			<input class="input" type="hidden" name="spam-master-token2" id="spam-master-token2" placeholder="Spam Master Token2" autocomplete="off" value="<?php echo $_COOKIE["spam-master-token"]; ?>" />
			</label>
			</p>
			<?php
			}
		//END FIELD
		}

		//START REGISTRATION ERRORS VALIDATION MULTI SITE
		function spam_master_honeypot_register_errors_multi($result){
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
					$blog_threat_email = 'honey_bot@'.rand(10000000, 99999999).'.wp';
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
						$blog_threat_email = 'honey_bot@'.rand(10000000, 99999999).'.wp';
					}
				}
				else{
					$blog_threat_email = 'honey_bot@'.rand(10000000, 99999999).'.wp';
				}
			}
			$spamuserA = json_encode($spamuser, true);

			//Spam Buffer Controller
			////////////////////////
			$SpamMasterBufferController = new SpamMasterBufferController;
			$is_buffer = $SpamMasterBufferController->SpamMasterBufferSearch($remote_ip, $blog_threat_email);
			if(!empty($is_buffer)){
				echo '<p class="error"><strong>SPAM MASTER</strong> '.$spam_master_message.'</p>';
				exit();
			}

			//Check Fields
			if(!empty($_POST['mothers_name']) || !empty($_POST['mothers_last_name'])){
				if(!isset($_POST['mothers_name']) || empty($_POST['mothers_name'])){
					$mothers_name = 'empty';
				}
				else{
					$mothers_name = $_POST['mothers_name'];
				}
				if(!isset($_POST['mothers_last_name']) || empty($_POST['mothers_last_name'])){
					$mothers_last_name = 'empty';
				}
				else{
					$mothers_last_name = $_POST['mothers_last_name'];
				}
				//Spam Honey Controller
				////////////////////////
				$SpamMasterHoneyController = new SpamMasterHoneyController;
				$is_honey = $SpamMasterHoneyController->SpamMasterHoney($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $mothers_name, $mothers_last_name, $spam_master_page);
				if($is_honey){
					echo '<p class="error"><strong>SPAM MASTER</strong> '.$spam_master_message.'</p>';
					exit();
				}
				else{
					echo '<p class="error"><strong>SPAM MASTER</strong> '.$spam_master_message.'</p>';
					exit();
				}
			}
			if(isset($_POST['spammasterscript']) && !empty($_POST['spammasterscript'])){
				$triggerJ = 'J';
			}
			else{
				$triggerJ = false;
			}
			if(!isset($_SESSION["spam-master-token"]) || empty($_SESSION["spam-master-token"]) || !isset($_POST['spam-master-token']) || empty($_POST['spam-master-token'])){
				$triggerS = 'S';
			}
			else{
				$triggerS = false;
			}
			if(!isset($_COOKIE["spam-master-token"]) || empty($_COOKIE["spam-master-token"]) || !isset($_POST['spam-master-token2']) || empty($_POST['spam-master-token2'])){
				$triggerC = 'C';
			}
			else{
				$triggerC = false;
			}
			if($triggerJ == 'J' || $triggerS == 'S' || $triggerC == 'C'){
				//Spam White Controller
				////////////////////////
				$spamtype = $spam_master_page;
				$SpamMasterWhiteController = new SpamMasterWhiteController;
				$is_spamadmin = $SpamMasterWhiteController->SpamMasterWhiteAdmin($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype);
				if(!empty($is_spamadmin)){
				}
				else{
					//Spam White Controller
					////////////////////////
					$spamtype = $spam_master_page;
					$SpamMasterWhiteController = new SpamMasterWhiteController;
					$is_white = $SpamMasterWhiteController->SpamMasterWhiteSearch($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype);
					if(!empty($is_white)){
					}
					else{
						//Spam Honey Controller
						////////////////////////
						$SpamMasterHoneyController = new SpamMasterHoneyController;
						$is_honey2 = $SpamMasterHoneyController->SpamMasterHoney2($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $triggerJ, $triggerS, $triggerC, $spam_master_page);
						if($is_honey2){
							echo '<p class="error"><strong>SPAM MASTER</strong> '.$spam_master_message.'</p>';
							exit();
						}
					}
				}
			}
			return $result;
		// End Honey multi validation.	
		}

		//START REGISTRATION ERRORS VALIDATION SINGLE SITE
		function spam_master_honeypot_register_single_errors($errors, $sanitized_user_login, $user_email){
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
					$blog_threat_email = 'honey_bot@'.rand(10000000, 99999999).'.wp';
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
						$blog_threat_email = 'honey_bot@'.rand(10000000, 99999999).'.wp';
					}
				}
				else{
					$blog_threat_email = 'honey_bot@'.rand(10000000, 99999999).'.wp';
				}
			}
			$spamuserA = json_encode($spamuser, true);

			//Spam Buffer Controller
			////////////////////////
			$SpamMasterBufferController = new SpamMasterBufferController;
			$is_buffer = $SpamMasterBufferController->SpamMasterBufferSearch($remote_ip, $blog_threat_email);
			if(!empty($is_buffer)){
				$errors->add('invalid_email', __('<strong>SPAM MASTER</strong>: ','spam_master').$spam_master_message);
				return $errors;
			}

			//Check Fields
			if(!empty($_POST['mothers_name']) || !empty($_POST['mothers_last_name'])){
				if(!isset($_POST['mothers_name']) || empty($_POST['mothers_name'])){
					$mothers_name = 'empty';
				}
				else{
					$mothers_name = $_POST['mothers_name'];
				}
				if(!isset($_POST['mothers_last_name']) || empty($_POST['mothers_last_name'])){
					$mothers_last_name = 'empty';
				}
				else{
					$mothers_last_name = $_POST['mothers_last_name'];
				}
				//Spam Honey Controller
				////////////////////////
				$SpamMasterHoneyController = new SpamMasterHoneyController;
				$is_honey = $SpamMasterHoneyController->SpamMasterHoney($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $mothers_name, $mothers_last_name, $spam_master_page);
				if($is_honey){
					$errors->add('invalid_email', __('<strong>SPAM MASTER</strong>: ','spam_master').$spam_master_message);
					return $errors;
				}
				else{
					$errors->add('invalid_email', __('<strong>SPAM MASTER</strong>: ','spam_master').$spam_master_message);
					return $errors;
				}
			}
			if(isset($_POST['spammasterscript']) && !empty($_POST['spammasterscript'])){
				$triggerJ = 'J';
			}
			else{
				$triggerJ = false;
			}
			if(!isset($_SESSION["spam-master-token"]) || empty($_SESSION["spam-master-token"]) || !isset($_POST['spam-master-token']) || empty($_POST['spam-master-token'])){
				$triggerS = 'S';
			}
			else{
				$triggerS = false;
			}
			if(!isset($_COOKIE["spam-master-token"]) || empty($_COOKIE["spam-master-token"]) || !isset($_POST['spam-master-token2']) || empty($_POST['spam-master-token2'])){
				$triggerC = 'C';
			}
			else{
				$triggerC = false;
			}
			if($triggerJ == 'J' || $triggerS == 'S' || $triggerC == 'C'){
				//Spam White Controller
				////////////////////////
				$spamtype = $spam_master_page;
				$SpamMasterWhiteController = new SpamMasterWhiteController;
				$is_spamadmin = $SpamMasterWhiteController->SpamMasterWhiteAdmin($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype);
				if(!empty($is_spamadmin)){
				}
				else{
					//Spam White Controller
					////////////////////////
					$spamtype = $spam_master_page;
					$SpamMasterWhiteController = new SpamMasterWhiteController;
					$is_white = $SpamMasterWhiteController->SpamMasterWhiteSearch($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype);
					if(!empty($is_white)){
					}
					else{
						//Spam Honey Controller
						////////////////////////
						$SpamMasterHoneyController = new SpamMasterHoneyController;
						$is_honey2 = $SpamMasterHoneyController->SpamMasterHoney2($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $triggerJ, $triggerS, $triggerC, $spam_master_page);
						if($is_honey2){
							$errors->add('invalid_email', __('<strong>SPAM MASTER</strong>: ','spam_master').$spam_master_message);
							return $errors;
						}
					}
				}
			}
		return $errors;
		// End Honey single validation.
		}

		//START LOGIN ERRORS VALIDATION SINGLE SITE
		function spam_master_honeypot_login_single_errors($error){
			global $wpdb, $blog_id, $errors, $user_email;
			$err_codes = $errors->get_error_codes();

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
			$spam_master_page = 'Login';

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
					$blog_threat_email = 'honey_bot@'.rand(10000000, 99999999).'.wp';
				}
				$spam_avatar = get_avatar( $current_user_id, 64, '', $current_user_id, array('scheme' => 'https', 'force_display' => true));
				$spamuser = array('ID' => $current_user_id, 'username' => $spam_username, 'avatar' => $spam_avatar);
			}
			else{
				$spamuser = array('ID' => 'none');
				//Prepare Email
				if(!empty($user_email)){
					if (filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
						$blog_threat_email = wp_strip_all_tags(substr($user_email,0,256));
					}
					else{
						$blog_threat_email = 'honey_bot@'.rand(10000000, 99999999).'.wp';
					}
				}
				else{
					if(!empty($_REQUEST['log'])){
						if (filter_var($_REQUEST['log'], FILTER_VALIDATE_EMAIL)) {
							$blog_threat_email = wp_strip_all_tags(substr($_REQUEST['log'],0,256));
						}
						else{
							$blog_threat_email = 'honey_bot@'.rand(10000000, 99999999).'.wp';
						}
					}
					else{
						$blog_threat_email = 'honey_bot@'.rand(10000000, 99999999).'.wp';
					}
				}
			}
			$spamuserA = json_encode($spamuser, true);

			//Spam Buffer Controller
			////////////////////////
			$SpamMasterBufferController = new SpamMasterBufferController;
			$is_buffer = $SpamMasterBufferController->SpamMasterBufferSearch($remote_ip, $blog_threat_email);
			if(!empty($is_buffer)){
				$error = '<strong>SPAM MASTER</strong>: '.$spam_master_message;
			}

			//Check Fields
			if(!empty($_POST['mothers_name']) || !empty($_POST['mothers_last_name'])){
				if(!isset($_POST['mothers_name']) || empty($_POST['mothers_name'])){
					$mothers_name = 'empty';
				}
				else{
					$mothers_name = $_POST['mothers_name'];
				}
				if(!isset($_POST['mothers_last_name']) || empty($_POST['mothers_last_name'])){
					$mothers_last_name = 'empty';
				}
				else{
					$mothers_last_name = $_POST['mothers_last_name'];
				}
				//Spam Honey Controller
				////////////////////////
				$SpamMasterHoneyController = new SpamMasterHoneyController;
				$is_honey = $SpamMasterHoneyController->SpamMasterHoney($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $mothers_name, $mothers_last_name, $spam_master_page);
				if($is_honey){
					$error = '<strong>SPAM MASTER</strong>: '.$spam_master_message;
				}
				else{
					$error = '<strong>SPAM MASTER</strong>: '.$spam_master_message;
				}
			}
			if(isset($_POST['spammasterscript']) && !empty($_POST['spammasterscript'])){
				$triggerJ = 'J';
			}
			else{
				$triggerJ = false;
			}
			if(!isset($_SESSION["spam-master-token"]) || empty($_SESSION["spam-master-token"]) || !isset($_POST['spam-master-token']) || empty($_POST['spam-master-token'])){
				$triggerS = 'S';
			}
			else{
				$triggerS = false;
			}
			if(!isset($_COOKIE["spam-master-token"]) || empty($_COOKIE["spam-master-token"]) || !isset($_POST['spam-master-token2']) || empty($_POST['spam-master-token2'])){
				$triggerC = 'C';
			}
			else{
				$triggerC = false;
			}
			if($triggerJ == 'J' || $triggerS == 'S' || $triggerC == 'C'){
				//Spam White Controller
				////////////////////////
				$spamtype = $spam_master_page;
				$SpamMasterWhiteController = new SpamMasterWhiteController;
				$is_spamadmin = $SpamMasterWhiteController->SpamMasterWhiteAdmin($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype);
				if(!empty($is_spamadmin)){
				}
				else{
					//Spam White Controller
					////////////////////////
					$spamtype = $spam_master_page;
					$SpamMasterWhiteController = new SpamMasterWhiteController;
					$is_white = $SpamMasterWhiteController->SpamMasterWhiteSearch($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype);
					if(!empty($is_white)){
					}
					else{
						//Spam Honey Controller
						////////////////////////
						$SpamMasterHoneyController = new SpamMasterHoneyController;
						$is_honey2 = $SpamMasterHoneyController->SpamMasterHoney2($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $triggerJ, $triggerS, $triggerC, $spam_master_page);
						if($is_honey2){
							$error = '<strong>SPAM MASTER</strong>: '.$spam_master_message;
						}
					}
				}
			}
		return $error;
		// End Honey single validation.
		}

		//COMMENT VERIFICATION
		function spam_master_verify_honey_comment_data($commentdata){
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
			$spam_master_page = 'Comment';

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
					$blog_threat_email = 'honey_bot@'.rand(10000000, 99999999).'.wp';
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
						$blog_threat_email = 'honey_bot@'.rand(10000000, 99999999).'.wp';
					}
				}
				else{
					$blog_threat_email = 'honey_bot@'.rand(10000000, 99999999).'.wp';
				}
			}
			$spamuserA = json_encode($spamuser, true);
			//Prepare Comment
			if (!empty($commentdata['comment_content'])) {
				$result_comment_content_trim = substr($commentdata['comment_content'],0,360);
				$result_comment_content_clean = wp_strip_all_tags(stripslashes_deep($result_comment_content_trim), true);
			}
			else{
				$result_comment_content_clean = 'empty';
			}

			//Spam Buffer Controller
			////////////////////////
			$SpamMasterBufferController = new SpamMasterBufferController;
			$is_buffer = $SpamMasterBufferController->SpamMasterBufferSearch($remote_ip, $blog_threat_email);
			if(!empty($is_buffer)){
				return wp_die( __( '<strong>SPAM MASTER</strong>: ','spam_master' ).$spam_master_message);
			}

			//Check Fields
			if(!empty($_POST['mothers_name']) || !empty($_POST['mothers_last_name'])){
				if(!isset($_POST['mothers_name']) || empty($_POST['mothers_name'])){
					$mothers_name = 'empty';
				}
				else{
					$mothers_name = $_POST['mothers_name'];
				}
				if(!isset($_POST['mothers_last_name']) || empty($_POST['mothers_last_name'])){
					$mothers_last_name = 'empty';
				}
				else{
					$mothers_last_name = $_POST['mothers_last_name'];
				}
				//Spam Honey Controller
				////////////////////////
				$SpamMasterHoneyController = new SpamMasterHoneyController;
				$is_honey = $SpamMasterHoneyController->SpamMasterHoney($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $mothers_name, $mothers_last_name, $spam_master_page);
				if($is_honey){
					return wp_die( __( '<strong>SPAM MASTER</strong>: ','spam_master' ).$spam_master_message);
				}
				else{
					return wp_die( __( '<strong>SPAM MASTER</strong>: ','spam_master' ).$spam_master_message);
				}
			}
			if(isset($_POST['spammasterscript']) && !empty($_POST['spammasterscript'])){
				$triggerJ = 'J';
			}
			else{
				$triggerJ = false;
			}
			if(!isset($_SESSION["spam-master-token"]) || empty($_SESSION["spam-master-token"]) || !isset($_POST['spam-master-token']) || empty($_POST['spam-master-token'])){
				$triggerS = 'S';
			}
			else{
				$triggerS = false;
			}
			if(!isset($_COOKIE["spam-master-token"]) || empty($_COOKIE["spam-master-token"]) || !isset($_POST['spam-master-token2']) || empty($_POST['spam-master-token2'])){
				$triggerC = 'C';
			}
			else{
				$triggerC = false;
			}
			if($triggerJ == 'J' || $triggerS == 'S' || $triggerC == 'C'){
				//Spam White Controller
				////////////////////////
				$spamtype = $spam_master_page;
				$SpamMasterWhiteController = new SpamMasterWhiteController;
				$is_spamadmin = $SpamMasterWhiteController->SpamMasterWhiteAdmin($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype);
				if(!empty($is_spamadmin)){
				}
				else{
					//Spam White Controller
					////////////////////////
					$spamtype = $spam_master_page;
					$SpamMasterWhiteController = new SpamMasterWhiteController;
					$is_white = $SpamMasterWhiteController->SpamMasterWhiteSearch($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype);
					if(!empty($is_white)){
					}
					else{
						//Spam Honey Controller
						////////////////////////
						$SpamMasterHoneyController = new SpamMasterHoneyController;
						$is_honey2 = $SpamMasterHoneyController->SpamMasterHoney2($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $triggerJ, $triggerS, $triggerC, $spam_master_page);
						if($is_honey2){
							return wp_die( __( '<strong>SPAM MASTER</strong>: ','spam_master' ).$spam_master_message);
						}
					}
				}
			}
			return $commentdata;
		}

		//Contact Form 7
		function spam_master_add_honeypot_to_form( $content ) {
			//Reversed Ip
			$reverse_ip = strrev($_SERVER['REMOTE_ADDR']).'.'.bin2hex(random_bytes(12));

			$content .= '<p class="spam-master-hidden">
						<label class="spam-master-hidden" for="'.$reverse_ip.'">'.$reverse_ip.'<br>
						<input class="spam-master-hidden input" type="text" name="'.$reverse_ip.'" id="'.$reverse_ip.'" autocomplete="off" value="'.$reverse_ip.'" />
						</label>
						</p>';
			$content .= '<p class="spam-master-hidden">
						<label class="spam-master-hidden" for="mothers_name">Mother Name<br>
						<input class="spam-master-hidden input" type="text" name="mothers_name" id="mothers_name" autocomplete="off" value="" />
						</label>
						</p>';
			$content .= '<p class="spam-master-hidden">
						<label class="spam-master-hidden" for="mothers_last_name">Mother Last Name<br>
						<input class="spam-master-hidden input" type="text" name="mothers_last_name" id="mothers_last_name" autocomplete="off" value="" />
						</label>
						</p>';
			$content .= '<noscript>
						<p class="spam-master-hidden">
						<label class="spam-master-hidden" for="spammasterscript">Js<br>
						<input class="spam-master-hidden input" type="text" name="spammasterscript" id="spammasterscript" autocomplete="off" value="369golden" />
						</label>
						</p>
						</noscript>';
			if(isset($_SESSION["spam-master-token"]) && !empty($_SESSION["spam-master-token"])){
				$content .= '<p class="spam-master-hidden">
							<label for="spam-master-token" class="spam-master-hidden">Spam Master Token<br>
							<input class="input" type="hidden" name="spam-master-token" id="spam-master-token" placeholder="Spam Master Token" autocomplete="off" value="'.$_SESSION["spam-master-token"].'" />
							</label>
							</p>';
			}
			if(isset($_COOKIE["spam-master-token"]) && !empty($_COOKIE["spam-master-token"])){
				$content .= '<p class="spam-master-hidden">
							<label for="spam-master-token2" class="spam-master-hidden">Spam Master Token2<br>
							<input class="input" type="hidden" name="spam-master-token2" id="spam-master-token2" placeholder="Spam Master Token2" autocomplete="off" value="'.$_COOKIE["spam-master-token"].'" />
							</label>
							</p>';
			}
			return $content;        
		}
		function spam_master_contact_form_7_honeypot($spam){
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
					$blog_threat_email = 'honey_bot@'.rand(10000000, 99999999).'.wp';
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
						$blog_threat_email = 'honey_bot@'.rand(10000000, 99999999).'.wp';
					}
				}
				else{
					$blog_threat_email = 'honey_bot@'.rand(10000000, 99999999).'.wp';
				}
			}
			$spamuserA = json_encode($spamuser, true);
			//Prepare Message
			if (!empty($_POST['your-message'])) {
				$result_comment_content_trim = substr($_POST['your-message'],0,360);
				$result_comment_content_clean = wp_strip_all_tags(stripslashes_deep($result_comment_content_trim), true);
			}
			else{
				$result_comment_content_clean = 'your-message';
			}

			//Spam Buffer Controller
			////////////////////////
			$SpamMasterBufferController = new SpamMasterBufferController;
			$is_buffer = $SpamMasterBufferController->SpamMasterBufferSearch($remote_ip, $blog_threat_email);
			if(!empty($is_buffer)){
				return  $result['reason'] = array( 'spam' => wpcf7_get_message( 'spam' ) );
				exit();
			}

			//Check Fields
			if(!empty($_POST['mothers_name']) || !empty($_POST['mothers_last_name'])){
				if(!isset($_POST['mothers_name']) || empty($_POST['mothers_name'])){
					$mothers_name = 'empty';
				}
				else{
					$mothers_name = $_POST['mothers_name'];
				}
				if(!isset($_POST['mothers_last_name']) || empty($_POST['mothers_last_name'])){
					$mothers_last_name = 'empty';
				}
				else{
					$mothers_last_name = $_POST['mothers_last_name'];
				}
				//Spam Honey Controller
				////////////////////////
				$SpamMasterHoneyController = new SpamMasterHoneyController;
				$is_honey = $SpamMasterHoneyController->SpamMasterHoney($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $mothers_name, $mothers_last_name, $spam_master_page);
				if($is_honey){
					return  $result['reason'] = array( 'spam' => wpcf7_get_message( 'spam' ) );
					exit();
				}
				else{
					return  $result['reason'] = array( 'spam' => wpcf7_get_message( 'spam' ) );
					exit();
				}
			}
			if(isset($_POST['spammasterscript']) && !empty($_POST['spammasterscript'])){
				$triggerJ = 'J';
			}
			else{
				$triggerJ = false;
			}
			if(!isset($_SESSION["spam-master-token"]) || empty($_SESSION["spam-master-token"]) || !isset($_POST['spam-master-token']) || empty($_POST['spam-master-token'])){
				$triggerS = 'S';
			}
			else{
				$triggerS = false;
			}
			if(!isset($_COOKIE["spam-master-token"]) || empty($_COOKIE["spam-master-token"]) || !isset($_POST['spam-master-token2']) || empty($_POST['spam-master-token2'])){
				$triggerC = 'C';
			}
			else{
				$triggerC = false;
			}
			if($triggerJ == 'J' || $triggerS == 'S' || $triggerC == 'C'){
				//Spam White Controller
				////////////////////////
				$spamtype = $spam_master_page;
				$SpamMasterWhiteController = new SpamMasterWhiteController;
				$is_spamadmin = $SpamMasterWhiteController->SpamMasterWhiteAdmin($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype);
				if(!empty($is_spamadmin)){
				}
				else{
					//Spam White Controller
					////////////////////////
					$spamtype = $spam_master_page;
					$SpamMasterWhiteController = new SpamMasterWhiteController;
					$is_white = $SpamMasterWhiteController->SpamMasterWhiteSearch($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype);
					if(!empty($is_white)){
					}
					else{
						//Spam Honey Controller
						////////////////////////
						$SpamMasterHoneyController = new SpamMasterHoneyController;
						$is_honey2 = $SpamMasterHoneyController->SpamMasterHoney2($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $triggerJ, $triggerS, $triggerC, $spam_master_page);
						if($is_honey2){
							return  $result['reason'] = array( 'spam' => wpcf7_get_message( 'spam' ) );
							exit();
						}
					}
				}
			}
		}

	//end honeypot true
	}
// end valid
}
?>
