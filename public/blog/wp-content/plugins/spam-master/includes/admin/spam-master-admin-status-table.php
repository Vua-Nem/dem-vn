<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php' );
global $wpdb, $blog_id;

$plugin_master_name = constant('SPAM_MASTER_NAME');
$plugin_master_domain = constant('SPAM_MASTER_DOMAIN');

$platform = "Wordpress";
$spam_master_alert_level_date_set = date('Y-m-d H:i:s');
$spam_master_alert_level_date_auto = date('Y-m-d');
$wordpress = substr(get_bloginfo('version'),0,12);
$address = substr(get_site_url(),0,360);
$spam_master_version = constant('SPAM_MASTER_VERSION');
@$spam_master_server_ip = substr($_SERVER['SERVER_ADDR'],0,48);
//if empty ip
if(empty($spam_master_server_ip) || $spam_master_server_ip == '0' || $spam_master_server_ip == '127.0.0.1'){
	@$spam_master_ip_gethostbyname = gethostbyname($_SERVER['SERVER_NAME']);
	@$spam_master_server_ip = substr($spam_master_ip_gethostbyname,0,48);
	if(empty($spam_master_ip_gethostbyname) || $spam_master_ip_gethostbyname == '0'){
		@$spam_master_urlparts = parse_url($web_address);
		@$spam_master_hostname = $spam_master_urlparts['host'];
		@$spam_master_result = dns_get_record($spam_master_hostname, DNS_A);
		@$spam_master_server_ip = substr($spam_master_result[0]['ip'],0,48);
	}
}
@$spam_master_server_hostname = substr(gethostbyaddr($_SERVER['SERVER_ADDR']),0,256);
//if empty host
if(empty($spam_master_server_hostname) || $spam_master_server_hostname == '0' || $spam_master_server_hostname == '127.0.0.1'){
	@$spam_master_ho_gethostbyname = gethostbyname($_SERVER['SERVER_NAME']);
	@$spam_master_server_hostname = substr($spam_master_ho_gethostbyname,0,256);
	if(empty($spam_master_ho_gethostbyname) || $spam_master_ho_gethostbyname == '0'){
		@$spam_master_urlparts = parse_url($web_address);
		@$spam_master_hostname = $spam_master_urlparts['host'];
		@$spam_master_result = dns_get_record($spam_master_hostname, DNS_A);
		@$spam_master_server_hostname = substr($spam_master_result[0]['ip'],0,256);
	}
}
//Add Table & Load Spam Master Options
if(is_multisite()){
	$spam_master_keys = $wpdb->get_blog_prefix($blog_id)."spam_master_keys";
}
else{
	$spam_master_keys = $wpdb->prefix."spam_master_keys";
}
$spam_master_status = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_status'");
$spam_license_key = substr($wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_license_key'"),0,64);
$spam_license_key_old = substr($wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_license_key_old'"),0,64);
$spam_master_alert_level = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_alert_level'");
$spam_master_expires = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_expires'");
$spam_master_protection_total_number = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_protection_total_number'");
$spam_master_emails_alert_3_email = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_emails_alert_3_email'");
$spam_master_emails_alert_email = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_emails_alert_email'");
$spam_master_attached = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_attached'");
$spam_master_type = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_type'");
$spam_master_auto_update = substr($wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_auto_update'"),0,5);
$spam_master_db_protection_hash = substr($wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_db_protection_hash'"),0,64);
$spam_master_key_health = $wpdb->get_var("SELECT time FROM {$spam_master_keys} WHERE spamkey = 'System' AND spamtype = 'Cron: Key sender run.' ORDER BY id DESC LIMIT 1");
// Get Counts.
$spam_master_buffer_count = $wpdb->get_var("SELECT COUNT(*) FROM {$spam_master_keys} WHERE spamkey = 'Buffer'");
if ( empty( $spam_master_buffer_count ) ) {
	$spam_master_buffer_count = '0';
}
$spam_master_white_count = $wpdb->get_var("SELECT COUNT(*) FROM {$spam_master_keys} WHERE spamkey = 'White'");
if ( empty( $spam_master_white_count ) ) {
	$spam_master_white_count = '0';
}
$spam_master_logs_count = $wpdb->get_var("SELECT COUNT(*) FROM {$spam_master_keys}");
if ( empty( $spam_master_logs_count ) ) {
	$spam_master_logs_count = '0';
}
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
		$blog_threat_email = 'none';
	}
	$spam_avatar = get_avatar( $current_user_id, 64, '', $current_user_id, array('scheme' => 'https', 'force_display' => true));
	$spamuser = array('ID' => $current_user_id, 'username' => $spam_username, 'avatar' => $spam_avatar);
}
else{
	$spamuser = array('ID' => 'none');
	$blog_threat_email = 'none';
}
$spamuserA = json_encode($spamuser, true);

if( is_multisite() ){
	$admin_email = substr(get_blog_option($blog_id, 'admin_email'),0,128);
	$blog = substr(get_blog_option($blog_id, 'blogname'),0,256);
	if(empty($blog)){
		$blog = 'Wp multi';
	}
	$spam_master_multisite = "YES";
	$spam_master_multisite_number = get_blog_count();
	$spam_master_multisite_joined = substr($spam_master_multisite . ' - ' . $spam_master_multisite_number,0,11);
}
else{
	$admin_email = substr(get_option('admin_email'),0,128);
	$blog = substr(get_option('blogname'),0,256);
		if(empty($blog)){
			$blog = 'Wp single';
		}
	$spam_master_multisite = "NO";
	$spam_master_multisite_number = "0";
	$spam_master_multisite_joined = substr($spam_master_multisite . ' - ' . $spam_master_multisite_number,0,11);
}
if(empty($admin_email)){
	$admin_email = 'weird-no-email@'.date('YmdHis').'.wp';
}


//RE-SYNC if it matches
if( 
	$spam_master_type == 'FULL' && $spam_master_status == 'INACTIVE' || $spam_master_type == 'FULL' && $spam_master_status == 'MALFUNCTION_1' || $spam_master_type == 'FULL' && $spam_master_status == 'MALFUNCTION_2' || $spam_master_type == 'FULL' && $spam_master_status == 'MALFUNCTION_3' || $spam_master_type == 'FULL' && $spam_master_status == 'EXPIRED' || 
	$spam_master_type == 'FREE' && $spam_master_status == 'UNSTABLE' || $spam_master_type == 'FREE' && $spam_master_status == 'MALFUNCTION_1' || $spam_master_type == 'FREE' && $spam_master_status == 'MALFUNCTION_2' 
) {
	//creates button
	$spam_master_resync = '<button type="submit" name="resync_license" id="resync_license" class="btn-spammaster blue roundedspam" href="#" title="'.__('RE-SYNCHRONIZE CONNECTION', 'spam_master').'">'.__('RE-SYNCHRONIZE CONNECTION', 'spam_master').'</button>';

	//post button
	if(isset($_POST['resync_license'])){
		check_admin_referer( 'save-settings_update_license' );
		$spam_master_cron = "RESYN";
		$data_address = array('spamvalue' => $address);
		$where_address = array('spamkey' => 'Option', 'spamtype' => 'spam_master_address');
		$wpdb->update( $spam_master_keys, $data_address, $where_address );
		$data_ip = array('spamvalue' => $spam_master_server_ip);
		$where_ip = array('spamkey' => 'Option', 'spamtype' => 'spam_master_ip');
		$wpdb->update( $spam_master_keys, $data_ip, $where_ip );
		
		if(!empty($spam_license_key)){
			//remote post and response
			$spam_master_license_sync = array(
												'spam_license_key' => $spam_license_key,
												'platform' => $platform,
												'platform_version' => $wordpress,
												'platform_type' => $spam_master_multisite_joined,
												'spam_master_version' => $spam_master_version,
												'spam_master_type' => $spam_master_type,
												'blog_name' => $blog,
												'blog_address' => $address,
												'blog_email' => $admin_email,
												'blog_hostname' => $spam_master_server_hostname,
												'blog_ip' => $spam_master_server_ip,
												'blog_up' => $spam_master_auto_update,
												'spam_master_db' => $spam_master_db_protection_hash,
												'spam_master_buffer' => $spam_master_buffer_count,
												'spam_master_white' => $spam_master_white_count,
												'spam_master_logs' => $spam_master_logs_count,
												'spam_master_cron' => $spam_master_cron
			);
			$spam_master_license_url = 'aHR0cHM6Ly93d3cuc3BhbW1hc3Rlci5vcmcvd3AtY29udGVudC9wbHVnaW5zL3NwYW0tbWFzdGVyLWFkbWluaXN0cmF0b3IvaW5jbHVkZXMvbGljZW5zZS9nZXRfc3luYy5waHA=';
			$response = wp_remote_post( base64_decode($spam_master_license_url), array(
																						'method' => 'POST',
																						'timeout' => 90,
																						'body' => $spam_master_license_sync
			));
			if ( is_wp_error( $response ) ) {
				$error_message = $response->get_error_message();
				echo __('Something went wrong, please get in touch with Spam master Support: ', 'spam_master').$error_message;
			}
			else{
				$data = json_decode( wp_remote_retrieve_body( $response ), true );
				if(empty($data)){
				}
				else{
					$data_spam1 = array('spamvalue' => $data['type']);
					$where_spam1 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_type');
					$wpdb->update( $spam_master_keys, $data_spam1, $where_spam1 );
					$data_spam2 = array('spamvalue' => $data['status']);
					$where_spam2 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_status');
					$wpdb->update( $spam_master_keys, $data_spam2, $where_spam2 );
					$data_spam3 = array('spamvalue' => $data['attached']);
					$where_spam3 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_attached');
					$wpdb->update( $spam_master_keys, $data_spam3, $where_spam3 );
					$data_spam4 = array('spamvalue' => $data['expires']);
					$where_spam4 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_expires');
					$wpdb->update( $spam_master_keys, $data_spam4, $where_spam4 );
					$data_spam5 = array('spamvalue' => $data['threats']);
					$where_spam5 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_protection_total_number');
					$wpdb->update( $spam_master_keys, $data_spam5, $where_spam5 );
					$data_spam6 = array('spamvalue' => $data['alert']);
					$where_spam6 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_alert_level');
					$wpdb->update( $spam_master_keys, $data_spam6, $where_spam6 );
					$data_spam7 = array('spamvalue' => $spam_master_alert_level_date_set);
					$where_spam7 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_alert_level_date');
					$wpdb->update( $spam_master_keys, $data_spam7, $where_spam7 );
					$data_spam8 = array('spamvalue' => $data['percent']);
					$where_spam8 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_alert_level_p_text');
					$wpdb->update( $spam_master_keys, $data_spam8, $where_spam8 );
					//Start Alert Emails
					if($spam_master_emails_alert_3_email == 'true'){
						if($data['alert'] == 'ALERT_3'){

							// Spam email controller
							////////////////////////
							$spammail = true;
							$SpamMasterEmailController = new SpamMasterEmailController;
							$is_deact = $SpamMasterEmailController->SpamMasterAlert3( $spammail );

						}
					}
					if($spam_master_emails_alert_email == 'true'){
						if($data['alert'] == 'ALERT_2' || $data['alert'] == 'ALERT_1' || $data['alert'] == 'ALERT_0'){

							// Spam email controller
							////////////////////////
							$spammail = true;
							$SpamMasterEmailController = new SpamMasterEmailController;
							$is_deact = $SpamMasterEmailController->SpamMasterAlert( $spammail );

						}
					}

					//Log InUp Controller
					$spamtype = 'Key Re-Sync';
					$spamvalue = 'Successfully run with status: '.$data['status'];
					$cache = '4H';
					$SpamMasterLogController = new SpamMasterLogController;
					$is_log = $SpamMasterLogController->SpamMasterLog($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype, $spamvalue, $cache);

					$spama = $data['a'];
					if($spama == '1'){
						//Spam Action Controller
						////////////////////////
						$SpamMasterActionController = new SpamMasterActionController;
						$is_action = $SpamMasterActionController->SpamMasterAct($spama);
					}
				}
			}
			?>
			<div id="message" class="updated fade">
			<p><?php echo __('Key RE-SYNC Done. Please wait refreshing in 5 seconds.', 'spam_master'); ?></p>
			</div>
			<?php
		}
		else{
			?>
			<div class="notice notice-warning is-dismissible">
			<p><?php echo __('Your Key is empty, insert a valid key, press Save & Refresh. Please wait refreshing in 5 seconds.', 'spam_master'); ?></p>
			</div>
			<?php
		}
		echo '<META HTTP-EQUIV="REFRESH" CONTENT="5">';
	//END POST
	}
}
else{
	$spam_master_resync = false;
}

//Key Update post in wordpress
if (isset($_POST['update_license'])){
	
	check_admin_referer( 'save-settings_update_license' );
	$spam_master_cron = "MAN";
	if (!empty($_POST['spam_master_new_license'])){
		$spam_master_new_license = sanitize_text_field($_POST['spam_master_new_license']);
		$data_address = array('spamvalue' => $address);
		$where_address = array('spamkey' => 'Option', 'spamtype' => 'spam_master_address');
		$wpdb->update( $spam_master_keys, $data_address, $where_address );
		$data_ip = array('spamvalue' => $spam_master_server_ip);
		$where_ip = array('spamkey' => 'Option', 'spamtype' => 'spam_master_ip');
		$wpdb->update( $spam_master_keys, $data_ip, $where_ip );
		//ONLY IF KEY IS DIFFERENT
		if ($spam_license_key_old !== $spam_master_new_license){
			$data_spam1 = array('spamvalue' => substr($spam_master_new_license,0,64));
			$where_spam1 = array('spamkey' => 'Option', 'spamtype' => 'spam_license_key_old');
			$wpdb->update( $spam_master_keys, $data_spam1, $where_spam1 );
			$data_spam2 = array('spamvalue' => substr($spam_master_new_license,0,64));
			$where_spam2 = array('spamkey' => 'Option', 'spamtype' => 'spam_license_key');
			$wpdb->update( $spam_master_keys, $data_spam2, $where_spam2 );
			//remote post and response
			$spam_master_license_post = array(
												'spam_license_key' => $spam_master_new_license,
												'platform' => $platform,
												'platform_version' => $wordpress,
												'platform_type' => $spam_master_multisite_joined,
												'spam_master_version' => $spam_master_version,
												'spam_master_type' => $spam_master_type,
												'blog_name' => $blog,
												'blog_address' => $address,
												'blog_email' => $admin_email,
												'blog_hostname' => $spam_master_server_hostname,
												'blog_ip' => $spam_master_server_ip,
												'blog_up' => $spam_master_auto_update,
												'spam_master_db' => $spam_master_db_protection_hash,
												'spam_master_buffer' => $spam_master_buffer_count,
												'spam_master_white' => $spam_master_white_count,
												'spam_master_logs' => $spam_master_logs_count,
												'spam_master_cron' => $spam_master_cron
			);
			$spam_master_license_url = 'aHR0cHM6Ly93d3cuc3BhbW1hc3Rlci5vcmcvd3AtY29udGVudC9wbHVnaW5zL3NwYW0tbWFzdGVyLWFkbWluaXN0cmF0b3IvaW5jbHVkZXMvbGljZW5zZS9nZXRfbGljLnBocA==';
			$response = wp_remote_post( base64_decode($spam_master_license_url), array(
																					'method' => 'POST',
																					'timeout' => 90,
																					'body' => $spam_master_license_post
			));
			if ( is_wp_error( $response ) ) {
				$error_message = $response->get_error_message();
				echo __('Something went wrong, please get in touch with Spam master Support: ', 'spam_master').$error_message;
			}
			else {
				$data = json_decode( wp_remote_retrieve_body( $response ), true );
				if(empty($data)){
				}
				else{
					$data_spam1 = array('spamvalue' => $data['type']);
					$where_spam1 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_type');
					$wpdb->update( $spam_master_keys, $data_spam1, $where_spam1 );
					$data_spam2 = array('spamvalue' => $data['status']);
					$where_spam2 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_status');
					$wpdb->update( $spam_master_keys, $data_spam2, $where_spam2 );
					$data_spam3 = array('spamvalue' => $data['attached']);
					$where_spam3 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_attached');
					$wpdb->update( $spam_master_keys, $data_spam3, $where_spam3 );
					$data_spam4 = array('spamvalue' => $data['expires']);
					$where_spam4 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_expires');
					$wpdb->update( $spam_master_keys, $data_spam4, $where_spam4 );
					$data_spam5 = array('spamvalue' => $data['threats']);
					$where_spam5 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_protection_total_number');
					$wpdb->update( $spam_master_keys, $data_spam5, $where_spam5 );
					$data_spam6 = array('spamvalue' => $data['alert']);
					$where_spam6 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_alert_level');
					$wpdb->update( $spam_master_keys, $data_spam6, $where_spam6 );
					$data_spam7 = array('spamvalue' => $spam_master_alert_level_date_set);
					$where_spam7 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_alert_level_date');
					$wpdb->update( $spam_master_keys, $data_spam7, $where_spam7 );
					$data_spam8 = array('spamvalue' => $data['percent']);
					$where_spam8 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_alert_level_p_text');
					$wpdb->update( $spam_master_keys, $data_spam8, $where_spam8 );
					//Start Alert Emails
					if($spam_master_emails_alert_3_email == 'true'){
						if($data['alert'] == 'ALERT_3'){

							// Spam email controller
							////////////////////////
							$spammail = true;
							$SpamMasterEmailController = new SpamMasterEmailController;
							$is_deact = $SpamMasterEmailController->SpamMasterAlert3( $spammail );

						}
					}
					if($spam_master_emails_alert_email == 'true'){
						if($data['alert'] == 'ALERT_2' || $data['alert'] == 'ALERT_1' || $data['alert'] == 'ALERT_0'){

							// Spam email controller
							////////////////////////
							$spammail = true;
							$SpamMasterEmailController = new SpamMasterEmailController;
							$is_deact = $SpamMasterEmailController->SpamMasterAlert( $spammail );

						}
					}

					//Log InUp Controller
					$spamtype = 'Key Change';
					$spamvalue = 'Successfully run with status: '.$data['status'];
					$cache = '1H';
					$SpamMasterLogController = new SpamMasterLogController;
					$is_log = $SpamMasterLogController->SpamMasterLog($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype, $spamvalue, $cache);

					$spama = $data['a'];
					if($spama == '1'){
						//Spam Action Controller
						////////////////////////
						$SpamMasterActionController = new SpamMasterActionController;
						$is_action = $SpamMasterActionController->SpamMasterAct($spama);
					}
				}
			}
		}
		?>
		<div id="message" class="updated fade">
		<p><?php echo __('Key Saved. Please wait refreshing in 5 seconds.', 'spam_master'); ?></p>
		</div>
		<?php
	}
	else{
		?>
		<div class="notice notice-warning is-dismissible">
		<p><?php echo __('Your Key is empty, insert a valid key. Please wait refreshing in 5 seconds.', 'spam_master'); ?></p>
		</div>
		<?php
	}
	echo '<META HTTP-EQUIV="REFRESH" CONTENT="5">';
//END POST
}

//STATUS VALID
if ($spam_master_status == 'VALID'){
	if($spam_master_type == 'FULL'){
		$spam_master_type_display = $spam_master_type.' > ';
	}
	else{
		$spam_master_type_display = false;
	}
	$spam_master_protection_selection = $spam_master_type_display.__('ACTIVE > ONLINE', 'spam_master');
	$spam_master_protection_bgcolor= 'spam-master-top-admin-green';
	$license_color = 'spam-master-top-admin-green';
	$license_status = __('VALID KEY', 'spam_master');
	$spam_license_status_icon = '<span class="dashicons dashicons-yes-alt"></span>';
	$spam_license_connection_status = __('SERVER CONNECTION > OPTIMAL', 'spam_master');
	$protection_total_number_text = ' > '.number_format($spam_master_protection_total_number).' Threats & Exploits.';
}
//STATUS EXPIRED
if ($spam_master_status == 'EXPIRED'){
	$spam_master_protection_selection = __('EXPIRED > OFFLINE', 'spam_master');
	$spam_master_protection_bgcolor= 'spam-master-top-admin-red';
	$license_color = 'spam-master-top-admin-red';
	$license_status = __('EXPIRED KEY', 'spam_master');
	$spam_license_status_icon = '<span class="dashicons dashicons-dismiss"></span>';
	$protection_total_number_text = __('0 Threats & Exploits - EXPIRED > OFFLINE.', 'spam_master');
	$spam_license_connection_status = '';
}
//STATUS MALFUNCTION_1
if ($spam_master_status == 'MALFUNCTION_1'){
	$spam_master_protection_selection = __('MALFUNCTION 1 > ACTIVE > ONLINE', 'spam_master');
	$spam_master_protection_bgcolor= 'spam-master-top-admin-orange';
	$license_color = 'spam-master-top-admin-orange';
	$license_status = __('VALID KEY', 'spam_master');
	$spam_license_status_icon = '<span class="dashicons dashicons-warning"></span>';
	$spam_license_connection_status = __('SERVER CONNECTION > MALFUNCTION_1', 'spam_master');
	$protection_total_number_text = ' > '.number_format($spam_master_protection_total_number).' Threats & Exploits.';
}
//STATUS MALFUNCTION_2
if ($spam_master_status == 'MALFUNCTION_2'){
	$spam_master_protection_selection = __('MALFUNCTION 2 > ACTIVE > ONLINE', 'spam_master');
	$spam_master_protection_bgcolor= 'spam-master-top-admin-orangina';
	$license_color = 'spam-master-top-admin-orangina';
	$license_status = __('VALID KEY', 'spam_master');
	$spam_license_status_icon = '<span class="dashicons dashicons-warning"></span>';
	$spam_license_connection_status = __('SERVER CONNECTION > MALFUNCTION_2', 'spam_master');
	$protection_total_number_text = ' > '.number_format($spam_master_protection_total_number).' Threats & Exploits.';
}
//STATUS MALFUNCTION_3
if ($spam_master_status == 'MALFUNCTION_3'){
	$spam_master_protection_selection = __('MALFUNCTION 3 > INACTIVE > OFFLINE', 'spam_master');
	$spam_master_protection_bgcolor= 'spam-master-top-admin-red';
	$license_color = 'spam-master-top-admin-red';
	$license_status = __('MALFUNCTION 3 > OFFLINE', 'spam_master');
	$spam_license_status_icon = '<span class="dashicons dashicons-dismiss"></span>';
	$protection_total_number_text = __('0 Threats & Exploits - MALFUNCTION 3 > OFFLINE.', 'spam_master');
	$spam_license_connection_status = false;
	
}
//STATUS MALFUNCTION_4
if ($spam_master_status == 'MALFUNCTION_4'){
	$spam_master_protection_selection = __('MALFUNCTION 4 > INACTIVE > OFFLINE', 'spam_master');
	$spam_master_protection_bgcolor= 'spam-master-top-admin-yellow';
	$license_color = 'spam-master-top-admin-yellow';
	$license_status = __('MALFUNCTION 4 > KEY NOT AUTO GENERATED', 'spam_master');
	$spam_license_status_icon = '<span class="dashicons dashicons-warning"></span>';
	$protection_total_number_text = __('0 Threats & Exploits - MALFUNCTION 4 > OFFLINE.', 'spam_master');
	$spam_license_connection_status = false;
	
}
//STATUS MALFUNCTION_5
if ($spam_master_status == 'MALFUNCTION_5'){
	$spam_master_protection_selection = __('MALFUNCTION 5 > INACTIVE > OFFLINE', 'spam_master');
	$spam_master_protection_bgcolor= 'spam-master-top-admin-yellow';
	$license_color = 'spam-master-top-admin-yellow';
	$license_status = __('MALFUNCTION 5 > KEY NOT GENERATED', 'spam_master');
	$spam_license_status_icon = '<span class="dashicons dashicons-warning"></span>';
	$protection_total_number_text = __('0 Threats & Exploits - MALFUNCTION 5 > OFFLINE.', 'spam_master');
	$spam_license_connection_status = false;
	
}
//STATUS MALFUNCTION_6
if ($spam_master_status == 'MALFUNCTION_6'){
	$spam_master_protection_selection = __('MALFUNCTION 6 > INACTIVE > OFFLINE', 'spam_master');
	$spam_master_protection_bgcolor= 'spam-master-top-admin-yellow';
	$license_color = 'spam-master-top-admin-yellow';
	$license_status = __('MALFUNCTION 6 > 1 KEY PER WEBSITE', 'spam_master');
	$spam_license_status_icon = '<span class="dashicons dashicons-warning"></span>';
	$protection_total_number_text = __('0 Threats & Exploits - MALFUNCTION 6 > OFFLINE.', 'spam_master');
	$spam_license_connection_status = false;
	
}
//STATUS DISCONNECTED
if ($spam_master_status == 'DISCONNECTED'){
	$spam_master_protection_selection = __('DISCONNECTED > INACTIVE > OFFLINE', 'spam_master');
	$spam_master_protection_bgcolor= 'spam-master-top-admin-yellow';
	$license_color = 'spam-master-top-admin-yellow';
	$license_status = __('DISCONNECTED > COULD NOT CONNECT', 'spam_master');
	$spam_license_status_icon = '<span class="dashicons dashicons-warning"></span>';
	$protection_total_number_text = __('0 Threats & Exploits - DISCONNECTED > OFFLINE.', 'spam_master');
	$spam_license_connection_status = false;
	
}
//STATUS UNSTABLE
if ($spam_master_status == 'UNSTABLE'){
	$spam_master_protection_selection = __('UNSTABLE > WARNING', 'spam_master');
	$spam_master_protection_bgcolor= 'spam-master-top-admin-yellow';
	$license_color = 'spam-master-top-admin-yellow';
	$license_status = __('UNSTABLE > WARNING', 'spam_master');
	$spam_license_status_icon = '<span class="dashicons dashicons-warning"></span>';
	$protection_total_number_text = __('0 Threats & Exploits - UNSTABLE > WARNING.', 'spam_master');
	$spam_license_connection_status = false;
	
}
//STATUS INACTIVE, NO KEY SENT YET
if ($spam_master_status == 'INACTIVE'){
	$spam_master_protection_selection = __('INACTIVE > OFFLINE', 'spam_master');
	$spam_master_protection_bgcolor= 'spam-master-top-admin-yellow';
	$license_color = 'spam-master-top-admin-yellow';
	$license_status = __('INACTIVE KEY', 'spam_master');
	$spam_license_status_icon = '<span class="dashicons dashicons-warning"></span>';
	if($spam_master_type == 'TRIAL' || $spam_master_type == 'FREE' || $spam_master_type == 'EMPTY'){
		$spam_license_connection_status = __('SERVER CONNECTION > INACTIVE > OFFLINE', 'spam_master');
	}
	if($spam_master_type == 'FULL'){
		$spam_license_connection_status = false;
	}	
	$protection_total_number_text = false;
}
//Lest check status from logs
$timenow = current_time( 'mysql' );
$today_minus_days = date( 'Y-m-d H:i:s', strtotime( $timenow . ' - 3 days' ) ); 
if ( empty( $spam_master_key_health  ) ) {

	$spam_master_key_health_display = ' - <span class="dashicons dashicons-warning"></span> Cron check: 0000-00-00 00:00:00 (allow 24h for this value to populate)';

	if ( $today_minus_days >= $spam_master_expires ) {

		// Spam email controller
		////////////////////////
		$spammail = true;
		$SpamMasterEmailController = new SpamMasterEmailController;
		$is_deact = $SpamMasterEmailController->SpamMasterCronAlert( $spammail );

	}

} else {
	if ( $spam_master_key_health <= $today_minus_days ) {
		$spam_master_key_health_display = ' - <span class="dashicons dashicons-dismiss"></span> Cron check: ' . $spam_master_key_health . ' (Warning, last check was more than 48h ago)';

		// Spam email controller
		////////////////////////
		$spammail = true;
		$SpamMasterEmailController = new SpamMasterEmailController;
		$is_deact = $SpamMasterEmailController->SpamMasterCronAlert( $spammail );

	} else {
		$spam_master_key_health_display = ' - <span class="dashicons dashicons-yes-alt"></span> Cron check: ' . $spam_master_key_health;
	}
}

if(empty($spam_master_expires)){
	$spam_master_expires = '0000-00-00 00:00:00';
}

?>
<form method="post" width='1'>
<fieldset class="options">
<?php $sec_nonce = wp_nonce_field( 'save-settings_update_license' ); ?>
<table class="wp-list-table widefat fixed striped table-view-list" cellspacing="0">
	<thead>
		<tr>
			<th colspan="2"><h2><img class="spam-master-admin-img" src="<?php echo plugins_url('../images/spammaster-logo.png', dirname(__FILE__)); ?>" /><?php echo __('&nbsp;') . $plugin_master_domain . __('&nbsp;Protection Status', 'spam_master'); ?></h2></th>
		</tr>
	</thead>

	<tfoot>
		<tr>
			<th>
				<button type="submit" name="update_license" id="update_license" class="btn-spammaster blue roundedspam" href="#" title="<?php echo __('Save & Refresh', 'spam_master'); ?>"><?php echo __('Save & Refresh', 'spam_master'); ?></button>
			</th>
			<th>
				<?php echo $spam_master_resync; ?>
			</th>
		</tr>
	</tfoot>

	<tbody>
		<tr class="alternate">
			<td class="spam-master-middle-20"><?php echo __('Connection Key:', 'spam_master'); ?></td>
			<td class="spam-master-middle-p spam-master-flex"><input class="spam-master-100" id="spam_master_new_license" name="spam_master_new_license" type="text" value="<?php echo $spam_license_key; ?>">
			</td>
		</tr>
		<tr class="alternate">
			<td class="spam-master-middle-20"><?php echo __('Key Status:', 'spam_master'); ?></td>
			<td class="spam-master-middle <?php echo $license_color; ?>"><font color="white"><b><?php echo $spam_license_status_icon; ?>&nbsp;&nbsp;<?php echo $license_status. $spam_master_key_health_display; ?></b></font></td>
		</tr>
		
		<tr class="alternate">
			<td class="spam-master-middle-20" nowrap><?php echo __('Protection Status:', 'spam_master'); ?></td>
			<td class="spam-master-middle <?php echo $spam_master_protection_bgcolor; ?>"><font color="white"><b><?php echo $spam_license_status_icon; ?>&nbsp;&nbsp;<?php echo $spam_master_protection_selection; ?></b></td>
		</tr>
		<?php
		if($spam_master_type == 'FULL'){
		?>
		<tr class="alternate">
			<td class="spam-master-middle-20" nowrap><?php echo __('Protection Renews:', 'spam_master'); ?></td>
			<td class="spam-master-middle <?php echo $spam_master_protection_bgcolor; ?>"><font color="white"><b><?php echo $spam_license_status_icon; ?>&nbsp;&nbsp;<?php echo $spam_master_expires; ?></b></td>
		</tr>
		<?php
		}
		if($spam_master_type == 'FREE'){
		?>
		<tr class="alternate">
			<td class="spam-master-middle-20" nowrap><?php echo __('Server Connection Status:', 'spam_master'); ?></td>
			<td class="spam-master-middle <?php echo $spam_master_protection_bgcolor; ?>"><font color="white"><b><?php echo $spam_license_status_icon; ?>&nbsp;&nbsp;<?php echo $spam_license_connection_status; ?></b></td>
		</tr>
		<?php
		}
		if($spam_master_type == 'TRIAL' || $spam_master_type == 'FREE'){
		?>
		<tr class="alternate">
			<td colspan="2" class="spam-master-middle">
				<?php
				$spam_master_invitation_notice_plus_15 = date('Y-m-d', strtotime('+15 days', strtotime($spam_master_expires)) );
				if($spam_master_alert_level_date_auto >= $spam_master_invitation_notice_plus_15){
				}
				?>
				<a class="btn-spammaster green roundedspam" href="https://www.techgasp.com/downloads/spam-master-license/" target="_blank" title="<?php echo __('Premium Server Connection for peanuts', 'spam_master'); ?>"><?php echo __('Need a Pro Key?', 'spam_master'); ?></a> 
				<a class="btn-spammaster green roundedspam" href="https://www.spammaster.org/rbl-servers-status/" target="_blank" title="<?php echo __('Server Cluster Status', 'spam_master'); ?>"><?php echo __('Server Cluster Status', 'spam_master'); ?></a>
			</td>
		</tr>
		<?php
		}
		if($spam_master_type == 'FULL' && $spam_master_status == 'EXPIRED'){
		?>
		<tr class="alternate">
			<td colspan="2" class="spam-master-middle">
				<a class="btn-spammaster green roundedspam" href="https://www.techgasp.com/downloads/spam-master-license/" target="_blank" title="<?php echo __('Premium Server Connection for peanuts', 'spam_master'); ?>"><?php echo __('Renew Pro Key', 'spam_master'); ?></a> 
			</td>
		</tr>
		<?php
		}
		?>
	</tbody>
</table>
</fieldset>
</form>
