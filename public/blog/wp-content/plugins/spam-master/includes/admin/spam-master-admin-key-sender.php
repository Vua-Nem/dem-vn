<?php
// Daily health check. Read this Note.
// Messing with this file may cause failure.
// To free up space in spammaster.org data is deleted after 7 days without the health check.
// It's assumed the plugin is no longer installed.

include_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
global $wpdb, $blog_id;
//Prepare Key stuff
$platform = "Wordpress";
$spam_master_cron = "TRUE";
$spam_master_alert_level_date_set = current_time( 'mysql' );
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
	//If last check fails or ip does not revert to dns, lic gets deleted
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
$spam_master_emails_alert_3_email = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_emails_alert_3_email'");
$spam_master_emails_alert_email = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_emails_alert_email'");
$spam_master_type = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_type'");
$spam_master_auto_update = substr($wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_auto_update'"),0,5);
$spam_master_db_protection_hash = substr($wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_db_protection_hash'"),0,64);
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
$data_address = array('spamvalue' => $address);
$where_address = array('spamkey' => 'Option', 'spamtype' => 'spam_master_address');
$wpdb->update( $spam_master_keys, $data_address, $where_address );
$data_ip = array('spamvalue' => $spam_master_server_ip);
$where_ip = array('spamkey' => 'Option', 'spamtype' => 'spam_master_ip');
$wpdb->update( $spam_master_keys, $data_ip, $where_ip );
@$result = dns_get_record( $_SERVER['SERVER_NAME'] );
if ( !empty( $result[0]["ip"] ) ) {
	$anotherIp = $result[0]["ip"];
	$data_ip2 = array('spamvalue' => $anotherIp);
	$where_ip2 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_ip2');
	$wpdb->update( $spam_master_keys, $data_ip2, $where_ip2 );
} else {
	$data_ip2 = array('spamvalue' => 'localhost');
	$where_ip2 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_ip2');
	$wpdb->update( $spam_master_keys, $data_ip2, $where_ip2 );
}

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
//Set malfunctions as VALID
if($spam_master_status == 'VALID' || $spam_master_status == 'MALFUNCTION_1' || $spam_master_status == 'MALFUNCTION_2'){
	//remote post and response
	$spam_master_license_post = array(
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

					//Spam Email Controller
					////////////////////////
					$spammail = true;
					$SpamMasterEmailController = new SpamMasterEmailController;
					$is_deact = $SpamMasterEmailController->SpamMasterAlert3( $spammail );

				}
			}
			if($spam_master_emails_alert_email == 'true'){
				if($data['alert'] == 'ALERT_2' || $data['alert'] == 'ALERT_1' || $data['alert'] == 'ALERT_0'){

					//Spam Email Controller
					////////////////////////
					$spammail = true;
					$SpamMasterEmailController = new SpamMasterEmailController;
					$is_deact = $SpamMasterEmailController->SpamMasterAlert( $spammail );

				}
			}

			//Log InUp Controller
			$remote_ip = $spam_master_server_ip;
			$blog_threat_email = 'localhost';
			$remote_referer = 'localhost';
			$dest_url = 'localhost';
			$remote_agent = 'localhost';
			$spamuser = array('ID' => 'none',);
			$spamuserA = json_encode($spamuser, true);
			$spamtype = 'Key Health';
			$spamvalue = 'Successfully run with status: '.$data['status'];
			$cache = '4H';
			$SpamMasterLogController = new SpamMasterLogController;
			$is_log = $SpamMasterLogController->SpamMasterLog($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype, $spamvalue, $cache);

			// Bypass log post to rbl based on cache and log.
			$wpdb->insert( $spam_master_keys, array(
													'time' => current_time( 'mysql' ),
													'spamkey' => 'System',
													'spamtype' => 'Cron: Key sender run.',
													'spamy' => $remote_ip,
													'spamvalue' => '7D'
			));

			$spama = $data['a'];
			if($spama == '1'){
				//Spam Action Controller
				////////////////////////
				$SpamMasterActionController = new SpamMasterActionController;
				$is_action = $SpamMasterActionController->SpamMasterAct($spama);
			}
		}
	}
//End valid
}
?>
