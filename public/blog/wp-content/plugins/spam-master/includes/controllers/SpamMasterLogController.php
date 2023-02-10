<?php
class SpamMasterLogController {

	protected $remote_ip;
	protected $blog_threat_email;
	protected $remote_referer;
	protected $dest_url;
	protected $remote_agent;
	protected $spamuserA;
	protected $spamtype;
	protected $spamvalue;
	protected $cache;

	public function SpamMasterLog($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype, $spamvalue, $cache) {
		global $wpdb, $blog_id;

		if(is_multisite()){
			$spam_master_keys = $wpdb->get_blog_prefix($blog_id)."spam_master_keys";
		}
		else{
			$spam_master_keys = $wpdb->prefix."spam_master_keys";
		}
		$spam_master_status = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_status'");

		if($spam_master_status == 'VALID' || $spam_master_status == 'MALFUNCTION_1' || $spam_master_status == 'MALFUNCTION_2'){

			//Time Frames
			$current_time = current_time( 'mysql' );
			if($cache == '1H'){
				$Setcache = '1';
			}
			if($cache == '4H'){
				$Setcache = '4';
			}
			if($cache == '1D'){
				$Setcache = '24';
			}
			if($cache == '7D'){
				$Setcache = '168';
			}
			if($cache == '3M'){
				$Setcache = '792';
			}
			if($cache == '12M'){
				$Setcache = '8784';
			}

			//Combine values
			$spam_combo = $spamtype.': '.$spamvalue;

			$is_log = $wpdb->get_var($wpdb->prepare( "SELECT id FROM $spam_master_keys WHERE spamkey = 'System' AND spamtype = %s AND spamy = %s AND time >= NOW() - INTERVAL %s HOUR", $spam_combo, $remote_ip, $Setcache));
			if(empty($is_log)){

				$spam_master_type = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_type'");
				$spam_license_key = substr($wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_license_key'"),0,64);
				$spam_master_address = substr($wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_address'"),0,256);
				$spam_master_ip = substr($wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_ip'"),0,48);

				$spam_master_log_url = 'aHR0cHM6Ly93d3cuc3BhbW1hc3Rlci5vcmcvd3AtY29udGVudC9wbHVnaW5zL3NwYW0tbWFzdGVyLWFkbWluaXN0cmF0b3IvaW5jbHVkZXMvbGVhcm5pbmcvZ2V0X2xlYXJuX3N5cy5waHA=';
				$spam_master_learning_post = array(
													'blog_license_key' => $spam_license_key,
													'blog_threat_ip' => $remote_ip,
													'blog_threat_user' => $spamuserA,
													'blog_threat_type' => 'System',
													'blog_threat_email' => $blog_threat_email,
													'blog_threat_content' => $spam_combo,
													'blog_threat_agent' => $remote_agent,
													'blog_threat_refe' => $remote_referer,
													'blog_threat_dest' => $dest_url,
													'blog_web_adress' => $spam_master_address,
													'blog_server_ip' => $spam_master_ip
				);
				$response = wp_remote_post( base64_decode($spam_master_log_url), array(
																						'method' => 'POST',
																						'timeout' => 90,
																						'body' => $spam_master_learning_post
				));
				if ( is_wp_error( $response ) ) {
					$error_message = $response->get_error_message();
					echo __('Something went wrong, please get in touch with Spam master Support: ', 'spam_master').$error_message;
				}

				$wpdb->insert( $spam_master_keys, array(
														'time' => current_time( 'mysql' ),
														'spamkey' => 'System',
														'spamtype' => $spam_combo,
														'spamy' => $remote_ip,
														'spamvalue' => $cache
				));

			}
		}
	}

	public function SpamMasterLogFlood($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype, $spamvalue, $cache) {
		global $wpdb, $blog_id;

		if(is_multisite()){
			$spam_master_keys = $wpdb->get_blog_prefix($blog_id)."spam_master_keys";
		}
		else{
			$spam_master_keys = $wpdb->prefix."spam_master_keys";
		}
		$spam_master_status = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_status'");

		if($spam_master_status == 'VALID' || $spam_master_status == 'MALFUNCTION_1' || $spam_master_status == 'MALFUNCTION_2'){

			//Combine values
			$spam_combo = $spamtype.': '.$spamvalue;

			$wpdb->insert( $spam_master_keys, array(
													'time' => current_time( 'mysql' ),
													'spamkey' => 'System',
													'spamtype' => $spam_combo,
													'spamy' => $remote_ip,
													'spamvalue' => $cache
			));

		}
	}

	public function SpamMasterLogFloodWarn($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype, $spamvalue, $cache) {
		global $wpdb, $blog_id;

		if(is_multisite()){
			$spam_master_keys = $wpdb->get_blog_prefix($blog_id)."spam_master_keys";
		}
		else{
			$spam_master_keys = $wpdb->prefix."spam_master_keys";
		}
		$spam_master_status = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_status'");

		if($spam_master_status == 'VALID' || $spam_master_status == 'MALFUNCTION_1' || $spam_master_status == 'MALFUNCTION_2'){

			//Time Frames
			$current_time = current_time( 'mysql' );
			if($cache == '1H'){
				$Setcache = '1';
			}
			if($cache == '4H'){
				$Setcache = '4';
			}
			if($cache == '1D'){
				$Setcache = '24';
			}
			if($cache == '7D'){
				$Setcache = '168';
			}
			if($cache == '3M'){
				$Setcache = '792';
			}
			if($cache == '12M'){
				$Setcache = '8784';
			}

			//Combine values
			$spam_combo = $spamtype.': '.$spamvalue;

			$is_log = $wpdb->get_var($wpdb->prepare( "SELECT id FROM $spam_master_keys WHERE spamkey = 'System' AND spamtype = %s AND spamy = %s AND time >= NOW() - INTERVAL %s HOUR", $spam_combo, $remote_ip, $Setcache));
			if(empty($is_log)){

				$spam_master_type = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_type'");
				$spam_license_key = substr($wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_license_key'"),0,64);
				$spam_master_address = substr($wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_address'"),0,256);
				$spam_master_ip = substr($wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_ip'"),0,48);

				$spam_master_log_url = 'aHR0cHM6Ly93d3cuc3BhbW1hc3Rlci5vcmcvd3AtY29udGVudC9wbHVnaW5zL3NwYW0tbWFzdGVyLWFkbWluaXN0cmF0b3IvaW5jbHVkZXMvbGVhcm5pbmcvZ2V0X2xlYXJuX2Zsb29kLnBocA==';
				$spam_master_learning_post = array(
													'blog_license_key' => $spam_license_key,
													'blog_threat_ip' => $remote_ip,
													'blog_threat_user' => $spamuserA,
													'blog_threat_type' => 'FLOOD',
													'blog_threat_email' => $blog_threat_email,
													'blog_threat_content' => $spamvalue,
													'blog_threat_agent' => $remote_agent,
													'blog_threat_refe' => $remote_referer,
													'blog_threat_dest' => $dest_url,
													'blog_web_adress' => $spam_master_address,
													'blog_server_ip' => $spam_master_ip
				);
				$response = wp_remote_post( base64_decode($spam_master_log_url), array(
																						'method' => 'POST',
																						'timeout' => 90,
																						'body' => $spam_master_learning_post
				));
				if ( is_wp_error( $response ) ) {
					$error_message = $response->get_error_message();
					echo __('Something went wrong, please get in touch with Spam master Support: ', 'spam_master').$error_message;
				}
			}
		}
	}

}
?>
