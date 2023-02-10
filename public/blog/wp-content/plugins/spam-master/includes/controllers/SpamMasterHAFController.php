<?php
class SpamMasterHAFController {

	protected $remote_ip;
	protected $blog_threat_email;
	protected $remote_referer;
	protected $dest_url;
	protected $remote_agent;
	protected $spamuserA;

	public function SpamMasterHAF($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA) {
		global $wpdb, $blog_id;

		//Add Table & Load Spam Master Options
		if(is_multisite()){
			$spam_master_keys = $wpdb->get_blog_prefix($blog_id)."spam_master_keys";
		}
		else{
			$spam_master_keys = $wpdb->prefix."spam_master_keys";
		}
		$spam_master_status = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_status'");
		$spam_license_key = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_license_key'");
		$spam_master_address = substr($wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_address'"),0,256);
		$spam_master_ip = substr($wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_ip'"),0,48);
		$spam_master_white_empath = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_white_empath'");
		$spam_master_firewall_page = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_firewall_page'");

		if($spam_master_status == 'VALID' || $spam_master_status == 'MALFUNCTION_1' || $spam_master_status == 'MALFUNCTION_2'){

			$spam_master_learn_haf_url = 'aHR0cHM6Ly93d3cuc3BhbW1hc3Rlci5vcmcvd3AtY29udGVudC9wbHVnaW5zL3NwYW0tbWFzdGVyLWFkbWluaXN0cmF0b3IvaW5jbHVkZXMvbGVhcm5pbmcvZ2V0X2xlYXJuX2hhZi5waHA=';
			$spam_master_learning_post = array(
												'blog_license_key' => $spam_license_key,
												'blog_threat_ip' => $remote_ip,
												'blog_threat_email' => $blog_threat_email,
												'blog_threat_user' => $spamuserA,
												'blog_threat_content' => 'HAF',
												'blog_threat_agent' => $remote_agent,
												'blog_threat_refe' => $remote_referer,
												'blog_threat_dest' => $dest_url,
												'blog_web_adress' => $spam_master_address,
												'blog_server_ip' => $spam_master_ip
			);
			$response = wp_remote_post( base64_decode($spam_master_learn_haf_url), array(
																						'method' => 'POST',
																						'timeout' => 90,
																						'body' => $spam_master_learning_post
			));
			if ( is_wp_error( $response ) ) {
				$error_message = $response->get_error_message();
				echo __('Something went wrong, please get in touch with Spam master Support: ', 'spam_master').$error_message;
			}
			else{
				$data = json_decode( wp_remote_retrieve_body( $response ), true );

				if(empty($data['threat'])){
					if($spam_master_white_empath == 'true'){

						//Spam White Controller
						////////////////////////
						$spamtype = 'HAF';
						$SpamMasterWhiteController = new SpamMasterWhiteController;
						$is_pre_white = $SpamMasterWhiteController->SpamMasterWhiteEmpat($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype);
					}
				}
				else{
					$remote_ip = $data['threat'];
					$spamc = $data['c'];

					//Spam Buffer Controller
					////////////////////////
					$blog_threat_email = false;
					$SpamMasterBufferController = new SpamMasterBufferController;
					$is_threat = $SpamMasterBufferController->SpamMasterBufferInsert($remote_ip, $blog_threat_email, $spamc);

					//Firewall Page
					wp_safe_redirect($spam_master_firewall_page);
					exit();
				}
			}
		}
	}

}
?>
