<?php
class SpamMasterFloodController {

	protected $remote_ip;
	protected $blog_threat_email;
	protected $remote_referer;
	protected $dest_url;
	protected $remote_agent;
	protected $spamuserA;
	protected $spamtype;

	public function SpamMasterAlert3($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype) {
		global $wpdb, $blog_id;

		if(is_multisite()){
			$spam_master_keys = $wpdb->get_blog_prefix($blog_id)."spam_master_keys";
		}
		else{
			$spam_master_keys = $wpdb->prefix."spam_master_keys";
		}
		$spam_master_status = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_status'");

		if($spam_master_status == 'VALID' || $spam_master_status == 'MALFUNCTION_1' || $spam_master_status == 'MALFUNCTION_2'){
			$spam_master_last_honey =  $wpdb->get_var(
											$wpdb->prepare( 
															"SELECT time FROM $spam_master_keys WHERE spamy = %s ORDER BY time DESC LIMIT 1",
															$remote_ip
			));

			$flood_date_plus_3 = date('Y-m-d H:i:s', strtotime($spam_master_last_honey . '+ 3 minute'));
			$flood_date = current_time('mysql');

			if($flood_date_plus_3 >= $flood_date){

				//Spam Log Controller
				////////////////////////
				$spamvalue = 'Flood Alert 3';
				$cache = '1D';
				$SpamMasterLogController = new SpamMasterLogController;
				$is_log = $SpamMasterLogController->SpamMasterLog($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype, $spamvalue, $cache);

				//Spam Buffer Controller
				////////////////////////
				$SpamMasterBufferController = new SpamMasterBufferController;
				$is_buffer_count = $SpamMasterBufferController->SpamMasterBufferCount();

				return "ALERT_3";
			}
		}
	}

	public function SpamMasterFlood($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype) {
		global $wpdb, $blog_id;

		if(is_multisite()){
			$spam_master_keys = $wpdb->get_blog_prefix($blog_id)."spam_master_keys";
		}
		else{
			$spam_master_keys = $wpdb->prefix."spam_master_keys";
		}
		$spam_master_status = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_status'");

		if($spam_master_status == 'VALID' || $spam_master_status == 'MALFUNCTION_1' || $spam_master_status == 'MALFUNCTION_2'){

			//Wp Login
			if(!strncmp($_SERVER['REQUEST_URI'], '/wp-login.php', strlen('/wp-login.php')) || !strncmp($_SERVER['REQUEST_URI'], '//wp-login.php', strlen('//wp-login.php'))){
				$is_count =  $wpdb->get_var(
											$wpdb->prepare( 
															"SELECT COUNT(*) FROM $spam_master_keys WHERE spamkey = 'System' AND spamtype = 'HAF: Flood Login Check.' OR spamtype = 'honeypot 2: Flood Login Check.' AND spamy = %s AND time > DATE_SUB(NOW(), INTERVAL 1 HOUR)",
															$remote_ip
				));

				//Per hour login page
				if($is_count >= '600'){

					//Spam Buffer Controller
					////////////////////////
					$SpamMasterBufferController = new SpamMasterBufferController;
					$is_buffer_count = $SpamMasterBufferController->SpamMasterBufferCount();

					$spamc = '12M';
					//Spam Buffer Controller
					////////////////////////
					$SpamMasterBufferController = new SpamMasterBufferController;
					$is_threat = $SpamMasterBufferController->SpamMasterBufferInsert($remote_ip, $blog_threat_email, $spamc);

					return $is_count;
				}
				if($is_count >= '391'){

					$spamvalue = 'Flood Login Count Exceeded, '.$is_count.' per Hour.';
					$cache = '1H';

					//Spam Log Controller
					////////////////////////
					$SpamMasterLogController = new SpamMasterLogController;
					$is_log_warn = $SpamMasterLogController->SpamMasterLogFloodWarn($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype, $spamvalue, $cache);

					//Spam Log Controller
					////////////////////////
					$SpamMasterLogController = new SpamMasterLogController;
					$is_log = $SpamMasterLogController->SpamMasterLogFlood($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype, $spamvalue, $cache);

					//Spam Buffer Controller
					////////////////////////
					$SpamMasterBufferController = new SpamMasterBufferController;
					$is_buffer_count = $SpamMasterBufferController->SpamMasterBufferCount();

					$spamc = '12M';
					//Spam Buffer Controller
					////////////////////////
					$SpamMasterBufferController = new SpamMasterBufferController;
					$is_threat = $SpamMasterBufferController->SpamMasterBufferInsert($remote_ip, $blog_threat_email, $spamc);

					return $is_count;
				}
			}
			else{
				$is_count =  $wpdb->get_var(
											$wpdb->prepare( 
															"SELECT COUNT(*) FROM $spam_master_keys WHERE spamkey = 'System' AND spamtype = 'Flood Check.' AND spamy = %s AND time > DATE_SUB(NOW(), INTERVAL 1 MINUTE)",
															$remote_ip
				));

				//Per minute any page
				if($is_count >= '391'){

					$spamvalue = 'Flood Count Exceeded, '.$is_count.' per minute.';
					$cache = '1H';

					//Spam Log Controller
					////////////////////////
					$SpamMasterLogController = new SpamMasterLogController;
					$is_log_warn = $SpamMasterLogController->SpamMasterLogFloodWarn($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype, $spamvalue, $cache);

					//Spam Log Controller
					////////////////////////
					$SpamMasterLogController = new SpamMasterLogController;
					$is_log = $SpamMasterLogController->SpamMasterLogFlood($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype, $spamvalue, $cache);

					//Spam Buffer Controller
					////////////////////////
					$SpamMasterBufferController = new SpamMasterBufferController;
					$is_buffer_count = $SpamMasterBufferController->SpamMasterBufferCount();

					return $is_count;
				}
			}
		}
	}

}
?>
