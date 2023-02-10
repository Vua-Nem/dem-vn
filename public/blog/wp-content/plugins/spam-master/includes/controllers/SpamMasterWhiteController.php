<?php
class SpamMasterWhiteController {

	protected $remote_ip;
	protected $blog_threat_email;
	protected $remote_referer;
	protected $dest_url;
	protected $remote_agent;
	protected $spamuserA;
	protected $spamtype;

	public function SpamMasterWhiteSearch($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype) {
		global $wpdb, $blog_id;

		//Add Table & Load Spam Master Options
		if(is_multisite()){
			$spam_master_keys = $wpdb->get_blog_prefix($blog_id)."spam_master_keys";
		}
		else{
			$spam_master_keys = $wpdb->prefix."spam_master_keys";
		}

		if(!empty($remote_ip)){
			$is_white = $wpdb->get_var(
							$wpdb->prepare(
											"SELECT id FROM $spam_master_keys WHERE spamkey = 'White' AND spamy = %s",
											$remote_ip
			));
			if(!empty($is_white)){

				if ( ! is_admin() ) {

					//Log InUp Controller
					$spamvalue = 'Whitelist Ip';
					$cache = '3M';
					$SpamMasterLogController = new SpamMasterLogController;
					$is_log = $SpamMasterLogController->SpamMasterLog($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype, $spamvalue, $cache);

				}

				return "WHITE";
			}
		}
		if(!empty($blog_threat_email)){
			$is_white = $wpdb->get_var(
							$wpdb->prepare(
											"SELECT id FROM $spam_master_keys WHERE spamkey = 'White' AND spamy = %s",
											$blog_threat_email
			));
			if(!empty($is_white)){

				if ( ! is_admin() ) {

					//Log InUp Controller
					$spamvalue = 'Whitelist Email';
					$cache = '3M';
					$SpamMasterLogController = new SpamMasterLogController;
					$is_log = $SpamMasterLogController->SpamMasterLog($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype, $spamvalue, $cache);

				}

				return "WHITE";
			}
		}
	}

	public function SpamMasterWhiteAdmin($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype) {
		global $wpdb, $blog_id;

		if( current_user_can( 'administrator' ) OR current_user_can( 'editor' ) OR current_user_can( 'author' ) OR current_user_can( 'contributor' ) OR current_user_can('super_admin')){
			
			if ( ! is_admin() ) {

				//Log InUp Controller
				$spamvalue = 'Whitelist Administrator';
				$cache = '3M';
				$SpamMasterLogController = new SpamMasterLogController;
				$is_log = $SpamMasterLogController->SpamMasterLog($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype, $spamvalue, $cache);

			}

			return "ISADMIN";
		}
	}

	public function SpamMasterWhiteEmpat($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype) {
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
				$is_white = $wpdb->get_var(
								$wpdb->prepare(
												"SELECT id FROM $spam_master_keys WHERE spamkey = 'White' AND spamy = %s",
												$remote_ip
				));
				if(empty($is_white)){

					if ( ! is_admin() ) {
						$is_empath = $wpdb->get_var($wpdb->prepare("SELECT id FROM {$spam_master_keys} WHERE spamkey = 'White' AND spamy = %s", $remote_ip));
						if(empty($is_empath)){
							$wpdb->insert( $spam_master_keys, array( 'time' => current_time( 'mysql' ), 'spamkey' => 'White', 'spamtype' => 'Cache', 'spamy' => $remote_ip, 'spamvalue' => '4H' ));

							return "EMPATH";
						}
					}
				}
			}
			if(!empty($blog_threat_email)){
				$is_white = $wpdb->get_var(
								$wpdb->prepare(
												"SELECT id FROM $spam_master_keys WHERE spamkey = 'White' AND spamy = %s",
												$blog_threat_email
				));
				if(empty($is_white)){

					if ( ! is_admin() ) {
						$is_empath = $wpdb->get_var($wpdb->prepare("SELECT id FROM {$spam_master_keys} WHERE spamkey = 'White' AND spamy = %s", $remote_ip));
						if(empty($is_empath)){
							$wpdb->insert( $spam_master_keys, array( 'time' => current_time( 'mysql' ), 'spamkey' => 'White', 'spamtype' => 'Cache', 'spamy' => $blog_threat_email, 'spamvalue' => '4H' ));

							return "EMPATH";
						}
					}
				}
			}
		}
	}

}
?>
