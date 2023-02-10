<?php
class SpamMasterBufferController {

	protected $remote_ip;
	protected $blog_threat_email;
	protected $spamc;

	public function SpamMasterBufferSearch($remote_ip, $blog_threat_email) {
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
			if(!empty($remote_ip)){
				$is_buffer_threat = $wpdb->get_var(
										$wpdb->prepare( 
														"SELECT id 
														FROM $spam_master_keys
														WHERE spamkey = 'Buffer' AND spamy = %s", 
														$remote_ip
				));
				if(!empty($is_buffer_threat)){
					//Update Buffer if it keeps nagging
					$data_spam = array('time' => current_time( 'mysql' ));
					$where_spam = array('id' => $is_buffer_threat);
					$wpdb->update( $spam_master_keys, $data_spam, $where_spam );

					//Spam Buffer Controller
					////////////////////////
					$SpamMasterBufferController = new SpamMasterBufferController;
					$is_count = $SpamMasterBufferController->SpamMasterBufferCount();

					return "BUFFER";
				}
			}
			if(!empty($blog_threat_email)){
				$is_buffer_threat = $wpdb->get_var(
										$wpdb->prepare( 
														"SELECT id 
														FROM $spam_master_keys
														WHERE spamkey = 'Buffer' AND spamy = %s", 
														$blog_threat_email
				));
				if(!empty($is_buffer_threat)){
					//Update Buffer if it keeps nagging
					$data_spam = array('time' => current_time( 'mysql' ));
					$where_spam = array('id' => $is_buffer_threat);
					$wpdb->update( $spam_master_keys, $data_spam, $where_spam );

					//Spam Buffer Controller
					////////////////////////
					$SpamMasterBufferController = new SpamMasterBufferController;
					$is_count = $SpamMasterBufferController->SpamMasterBufferCount();

					return "BUFFER";
				}
			}
		}
	}

	public function SpamMasterBufferInsert($remote_ip, $blog_threat_email, $spamc) {
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

			if(!empty($remote_ip)){

				$is_buffer = $wpdb->get_var($wpdb->prepare("SELECT id FROM {$spam_master_keys} WHERE spamkey = 'Buffer' AND spamy = %s", $remote_ip));
				if(empty($is_buffer)){
					$wpdb->insert( $spam_master_keys, array( 'time' => current_time( 'mysql' ), 'spamkey' => 'Buffer', 'spamtype' => 'Cache', 'spamy' => $remote_ip, 'spamvalue' => $spamc ));
				}

				//Spam Buffer Controller
				////////////////////////
				$SpamMasterBufferController = new SpamMasterBufferController;
				$is_count = $SpamMasterBufferController->SpamMasterBufferCount();
			}
			if(!empty($blog_threat_email)){

				$is_buffer = $wpdb->get_var($wpdb->prepare("SELECT id FROM {$spam_master_keys} WHERE spamkey = 'Buffer' AND spamy = %s", $blog_threat_email));
				if(empty($is_buffer)){
					$wpdb->insert( $spam_master_keys, array( 'time' => current_time( 'mysql' ), 'spamkey' => 'Buffer', 'spamtype' => 'Cache', 'spamy' => $blog_threat_email, 'spamvalue' => $spamc ));
				}

				//Spam Buffer Controller
				////////////////////////
				$SpamMasterBufferController = new SpamMasterBufferController;
				$is_count = $SpamMasterBufferController->SpamMasterBufferCount();
			}
		}
	}

	public function SpamMasterBufferCount() {
		global $wpdb, $blog_id;

		//Add Table & Load Spam Master Options
		if(is_multisite()){
			$spam_master_keys = $wpdb->get_blog_prefix($blog_id)."spam_master_keys";
		}
		else{
			$spam_master_keys = $wpdb->prefix."spam_master_keys";
		}
		$spam_master_block_count_pre = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_block_count'");
		$spam_master_block_count = $spam_master_block_count_pre + 1;
		//Update Count
		$data_spam = array('spamvalue' => $spam_master_block_count);
		$where_spam = array('spamkey' => 'Option', 'spamtype' => 'spam_master_block_count');
		$wpdb->update( $spam_master_keys, $data_spam, $where_spam );
	}

}
?>
