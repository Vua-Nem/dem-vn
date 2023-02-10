<?php
///////////////////////////////////////////////////
//warning, fiddling here can cause trouble......///
///////////////////////////////////////////////////
global $wpdb, $blog_id;
if( is_multisite() ){
}
else{
	//Add Table & Load Spam Master Options
	$spam_master_connection = get_option('spam_master_connection');
	$spam_master_keys = $wpdb->prefix."spam_master_keys";
	$spam_master_status = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_status'");
	$spam_master_type = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_type'");
	$spam_license_key = substr($wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_license_key'"),0,64);
	$spam_master_auto_update = substr($wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_auto_update'"),0,5);
	$spam_master_db_protection_hash = substr($wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_db_protection_hash'"),0,64);

	if(empty($spam_master_connection) && empty($spam_license_key) && $spam_master_status == 'INACTIVE' && $spam_master_type == 'EMPTY'){
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
		//Prepare Connection
		$platform = 'Wordpress';
		$spam_master_cron = 'AUT';
		$spam_master_lic_nounce = 'PW9pdXNkbmVXMndzUw==';
		$spam_master_type_set = 'FREE';
		$spam_master_alert_level_date_set = date('Y-m-d H:i:s');
		$spam_master_version = constant('SPAM_MASTER_VERSION');
		$wordpress = substr(get_bloginfo('version'),0,12);
		$spam_master_multisite = 'NO';
		$spam_master_multisite_number = '0';
		$spam_master_multisite_joined = substr($spam_master_multisite . ' - ' . $spam_master_multisite_number,0,11);
		$blog = substr(get_option('blogname'),0,256);
		if(empty($blog)){
			$blog = 'Wp empty';
		}
		$admin_email = substr(get_option('admin_email'),0,128);
		if(empty($admin_email)){
			$admin_email = 'weird-no-email@'.date('YmdHis').'.wp';
		}
		$address = substr(get_site_url(),0,360);
		$data_address = array('spamvalue' => $address);
		$where_address = array('spamkey' => 'Option', 'spamtype' => 'spam_master_address');
		$wpdb->update( $spam_master_keys, $data_address, $where_address );
		@$spam_master_server_ip = substr($_SERVER['SERVER_ADDR'],0,48);
		if(empty($spam_master_server_ip) || $spam_master_server_ip == '0'){
			@$spam_master_server_ip = substr(gethostbyname($_SERVER['SERVER_NAME']),0,48);
		}
		$data_ip = array('spamvalue' => $spam_master_server_ip);
		$where_ip = array('spamkey' => 'Option', 'spamtype' => 'spam_master_ip');
		$wpdb->update( $spam_master_keys, $data_ip, $where_ip );
		@$spam_master_server_hostname = substr(gethostbyaddr($_SERVER['SERVER_ADDR']),0,256);
		if(empty($spam_master_server_hostname) || $spam_master_server_hostname == '0'){
			@$spam_master_server_hostname = substr(gethostbyname($_SERVER['SERVER_NAME']),0,256);
		}
		//create lic hash
		$spam_master_lic_hash = substr(md5(uniqid(mt_rand(), true)),0,64);
		if(empty($spam_master_lic_hash)){
			$spam_master_lic_hash = 'md5-'.date('YmdHis');
		}
		//Update Key
		$data_spam1 = array('spamvalue' => $spam_master_lic_hash);
		$where_spam1 = array('spamkey' => 'Option', 'spamtype' => 'spam_license_key');
		$wpdb->update( $spam_master_keys, $data_spam1, $where_spam1 );
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
		//remote post and response
		$spam_master_license_post = array(
									'spam_license_key' => $spam_master_lic_hash,
									'spam_trial_nounce' => $spam_master_lic_nounce,
									'platform' => $platform,
									'platform_version' => $wordpress,
									'platform_type' => $spam_master_multisite_joined,
									'spam_master_version' => $spam_master_version,
									'spam_master_type' => $spam_master_type_set,
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
		$spam_master_license_url = 'aHR0cHM6Ly93d3cuc3BhbW1hc3Rlci5vcmcvd3AtY29udGVudC9wbHVnaW5zL3NwYW0tbWFzdGVyLWFkbWluaXN0cmF0b3IvaW5jbHVkZXMvbGljZW5zZS9saWNfdHJpYWwucGhw';
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
				$spam_master_status = $data['status'];
				if($spam_master_status == 'VALID'){
					$data_spam1 = array('spamvalue' => $data['type']);
					$where_spam1 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_type');
					$wpdb->update( $spam_master_keys, $data_spam1, $where_spam1 );
					$data_spam2 = array('spamvalue' => $spam_master_status);
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

					//Spam Email Controller
					////////////////////////
					$spammail = true;
					$SpamMasterEmailController = new SpamMasterEmailController;
					$is_deact = $SpamMasterEmailController->SpamMasterAutoFree( $spammail );

				}
				else{
					$data_spam = array('spamvalue' => '');
					$where_spam = array('spamkey' => 'Option', 'spamtype' => 'spam_license_key');
					$wpdb->update( $spam_master_keys, $data_spam, $where_spam );
					update_option('spam_master_connection', 'checked-exists');
				}

				//Log InUp Controller
				$remote_ip = $spam_master_server_ip;
				$blog_threat_email = 'localhost';
				$remote_referer = 'localhost';
				$dest_url = 'localhost';
				$remote_agent = 'localhost';
				$spamuser = array('ID' => 'none',);
				$spamuserA = json_encode($spamuser, true);
				$spamtype = 'Connection';
				$spamvalue = 'Successfully run with status: '.$spam_master_status;
				$cache = '12M';
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
	else{
		//This is a WP Option
		update_option('spam_master_connection', 'exists');
	}
}
?>
