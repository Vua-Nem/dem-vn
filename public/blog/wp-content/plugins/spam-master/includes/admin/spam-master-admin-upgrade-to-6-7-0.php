<?php
global $wpdb, $blog_id;

if( is_multisite() ){
	$blogs = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs;" );
	foreach ( $blogs as $id ) {
		//Update DB
		$spam_master_keys = $wpdb->get_blog_prefix($id)."spam_master_keys";
		// Delete conflicting.
		$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_trial_expired'" );
		$spam_master_trial_expired_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_trial_expired_date'");
		if( empty( $spam_master_trial_expired_date ) ) {
			$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_trial_expired_date', 'spamy' => 'localhost', 'spamvalue' => '1970-01-01'));
		}
		$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_trial_expired_notice'" );
		$spam_master_trial_expired_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_trial_expired_notice'");
		if( empty( $spam_master_trial_expired_notice ) ) {
			$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_trial_expired_notice', 'spamy' => 'localhost', 'spamvalue' => '0'));
		}
		$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_free_expired'" );
		$spam_master_free_expired_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_free_expired_date'");
		if( empty( $spam_master_free_expired_date ) ) {
			$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_free_expired_date', 'spamy' => 'localhost', 'spamvalue' => '1970-01-01'));
		}
		$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_free_expired_notice'" );
		$spam_master_free_expired_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_free_expired_notice'");
		if( empty( $spam_master_free_expired_notice ) ) {
			$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_free_expired_notice', 'spamy' => 'localhost', 'spamvalue' => '0'));
		}
		$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_full_expired'" );
		$spam_master_full_expired_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_full_expired_date'");
		if( empty( $spam_master_full_expired_date ) ) {
			$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_full_expired_date', 'spamy' => 'localhost', 'spamvalue' => '1970-01-01'));
		}
		$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_full_expired_notice'" );
		$spam_master_full_expired_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_full_expired_notice'");
		if( empty( $spam_master_full_expired_notice ) ) {
			$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_full_expired_notice', 'spamy' => 'localhost', 'spamvalue' => '0'));
		}
		$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_full_inactive'" );
		$spam_master_full_inactive_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_full_inactive_date'");
		if( empty( $spam_master_full_inactive_date ) ) {
			$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_full_inactive_date', 'spamy' => 'localhost', 'spamvalue' => '1970-01-01'));
		}
		$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_full_inactive_notice'" );
		$spam_master_full_inactive_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_full_inactive_notice'");
		if( empty( $spam_master_full_inactive_notice ) ) {
			$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_full_inactive_notice', 'spamy' => 'localhost', 'spamvalue' => '0'));
		}
		$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_free_unstable'" );
		$spam_master_free_unstable_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_free_unstable_date'");
		if( empty( $spam_master_free_unstable_date ) ) {
			$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_free_unstable_date', 'spamy' => 'localhost', 'spamvalue' => '1970-01-01'));
		}
		$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_unstable_notice'" );
		$spam_master_free_unstable_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_free_unstable_notice'");
		if( empty( $spam_master_free_unstable_notice ) ) {
			$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_free_unstable_notice', 'spamy' => 'localhost', 'spamvalue' => '0'));
		}
		$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_full_notice'" );
		$spam_master_full_install_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_full_install_notice'");
		if( empty( $spam_master_full_install_notice ) ) {
			$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_full_install_notice', 'spamy' => 'localhost', 'spamvalue' => '0'));
		}
		$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_free_notice'" );
		$spam_master_free_rate_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_free_rate_notice'");
		if( empty( $spam_master_free_rate_notice ) ) {
			$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_free_rate_notice', 'spamy' => 'localhost', 'spamvalue' => '0'));
		}
		$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_emails_weekly_email_date'" );
		$spam_master_emails_weekly_email_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_emails_weekly_email_date'");
		if( empty( $spam_master_emails_weekly_email_date ) ) {
			$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_emails_weekly_email_date', 'spamy' => 'localhost', 'spamvalue' => '1970-01-01'));
		}
		$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_emails_weekly_stats_date'" );
		$spam_master_emails_weekly_stats_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_emails_weekly_stats_date'");
		if( empty( $spam_master_emails_weekly_stats_date ) ) {
			$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_emails_weekly_stats_date', 'spamy' => 'localhost', 'spamvalue' => '1970-01-01'));
		}
		$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_ip2'" );
		$spam_master_ip2 = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_ip2'");
		if( empty( $spam_master_ip2 ) ) {
			@$result = dns_get_record( $_SERVER['SERVER_NAME'] );
			if ( !empty( $result[0]["ip"] ) ) {
				$anotherIp = $result[0]["ip"];
				$wpdb->insert( $spam_master_keys, array( 'time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_ip2', 'spamy' => 'localhost', 'spamvalue' => $anotherIp ) );
			} else {
				$wpdb->insert( $spam_master_keys, array( 'time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_ip2', 'spamy' => 'localhost', 'spamvalue' => 'localhost' ) );
			}
		}
		$spam_master_cron_alert_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_cron_alert_date'");
		if( empty( $spam_master_cron_alert_date ) ) {
			$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_cron_alert_date', 'spamy' => 'localhost', 'spamvalue' => '1970-01-01'));
		}
		$spam_master_cron_alert_date_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_cron_alert_date_notice'");
		if( empty( $spam_master_cron_alert_date_notice ) ) {
			$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_cron_alert_date_notice', 'spamy' => 'localhost', 'spamvalue' => '0'));
		}
		$spam_master_cron_alert_date_admin_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_cron_alert_date_admin_notice'");
		if( empty( $spam_master_cron_alert_date_admin_notice ) ) {
			$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_cron_alert_date_admin_notice', 'spamy' => 'localhost', 'spamvalue' => '0'));
		}

		//Update
		update_blog_option( $id, 'spam_master_upgrade_to_6_7_0', '1' );
	}
}
else{
	//Update DB
	$spam_master_keys = $wpdb->prefix."spam_master_keys";
	// Delete conflicting.
	$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_trial_expired'" );
	$spam_master_trial_expired_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_trial_expired_date'");
	if( empty( $spam_master_trial_expired_date ) ) {
		$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_trial_expired_date', 'spamy' => 'localhost', 'spamvalue' => '1970-01-01'));
	}
	$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_trial_expired_notice'" );
	$spam_master_trial_expired_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_trial_expired_notice'");
	if( empty( $spam_master_trial_expired_notice ) ) {
		$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_trial_expired_notice', 'spamy' => 'localhost', 'spamvalue' => '0'));
	}
	$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_free_expired'" );
	$spam_master_free_expired_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_free_expired_date'");
	if( empty( $spam_master_free_expired_date ) ) {
		$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_free_expired_date', 'spamy' => 'localhost', 'spamvalue' => '1970-01-01'));
	}
	$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_free_expired_notice'" );
	$spam_master_free_expired_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_free_expired_notice'");
	if( empty( $spam_master_free_expired_notice ) ) {
		$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_free_expired_notice', 'spamy' => 'localhost', 'spamvalue' => '0'));
	}
	$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_full_expired'" );
	$spam_master_full_expired_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_full_expired_date'");
	if( empty( $spam_master_full_expired_date ) ) {
		$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_full_expired_date', 'spamy' => 'localhost', 'spamvalue' => '1970-01-01'));
	}
	$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_full_expired_notice'" );
	$spam_master_full_expired_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_full_expired_notice'");
	if( empty( $spam_master_full_expired_notice ) ) {
		$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_full_expired_notice', 'spamy' => 'localhost', 'spamvalue' => '0'));
	}
	$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_full_inactive'" );
	$spam_master_full_inactive_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_full_inactive_date'");
	if( empty( $spam_master_full_inactive_date ) ) {
		$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_full_inactive_date', 'spamy' => 'localhost', 'spamvalue' => '1970-01-01'));
	}
	$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_full_inactive_notice'" );
	$spam_master_full_inactive_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_full_inactive_notice'");
	if( empty( $spam_master_full_inactive_notice ) ) {
		$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_full_inactive_notice', 'spamy' => 'localhost', 'spamvalue' => '0'));
	}
	$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_free_unstable'" );
	$spam_master_free_unstable_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_free_unstable_date'");
	if( empty( $spam_master_free_unstable_date ) ) {
		$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_free_unstable_date', 'spamy' => 'localhost', 'spamvalue' => '1970-01-01'));
	}
	$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_unstable_notice'" );
	$spam_master_unstable_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_unstable_notice'");
	if( empty( $spam_master_unstable_notice ) ) {
		$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_unstable_notice', 'spamy' => 'localhost', 'spamvalue' => '0'));
	}
	$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_full_notice'" );
	$spam_master_full_install_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_full_install_notice'");
	if( empty( $spam_master_full_install_notice ) ) {
		$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_full_install_notice', 'spamy' => 'localhost', 'spamvalue' => '0'));
	}
	$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_free_notice'" );
	$spam_master_free_rate_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_free_rate_notice'");
	if( empty( $spam_master_free_rate_notice ) ) {
		$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_free_rate_notice', 'spamy' => 'localhost', 'spamvalue' => '0'));
	}
	$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_emails_weekly_email_date'" );
	$spam_master_emails_weekly_email_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_emails_weekly_email_date'");
	if( empty( $spam_master_emails_weekly_email_date ) ) {
		$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_emails_weekly_email_date', 'spamy' => 'localhost', 'spamvalue' => '1970-01-01'));
	}
	$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_emails_weekly_stats_date'" );
	$spam_master_emails_weekly_stats_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_emails_weekly_stats_date'");
	if( empty( $spam_master_emails_weekly_stats_date ) ) {
		$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_emails_weekly_stats_date', 'spamy' => 'localhost', 'spamvalue' => '1970-01-01'));
	}
	$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_ip2'" );
	$spam_master_ip2 = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_ip2'");
	if( empty( $spam_master_ip2 ) ) {
		@$result = dns_get_record( $_SERVER['SERVER_NAME'] );
		if ( !empty( $result[0]["ip"] ) ) {
			$anotherIp = $result[0]["ip"];
			$wpdb->insert( $spam_master_keys, array( 'time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_ip2', 'spamy' => 'localhost', 'spamvalue' => $anotherIp ) );
		} else {
			$wpdb->insert( $spam_master_keys, array( 'time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_ip2', 'spamy' => 'localhost', 'spamvalue' => 'localhost' ) );
		}
	}
	$spam_master_cron_alert_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_cron_alert_date'");
	if( empty( $spam_master_cron_alert_date ) ) {
		$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_cron_alert_date', 'spamy' => 'localhost', 'spamvalue' => '1970-01-01'));
	}
	$spam_master_cron_alert_date_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_cron_alert_date_notice'");
	if( empty( $spam_master_cron_alert_date_notice ) ) {
		$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_cron_alert_date_notice', 'spamy' => 'localhost', 'spamvalue' => '0'));
	}
	$spam_master_cron_alert_date_admin_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_cron_alert_date_admin_notice'");
	if( empty( $spam_master_cron_alert_date_admin_notice ) ) {
		$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_cron_alert_date_admin_notice', 'spamy' => 'localhost', 'spamvalue' => '0'));
	}

	//Update
	update_option('spam_master_upgrade_to_6_7_0', '1');
}

$spam_master_ip = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_ip'");

//Log InUp Controller
$remote_ip = $spam_master_ip;
$blog_threat_email = 'localhost';
$remote_referer = 'localhost';
$dest_url = 'localhost';
$remote_agent = 'localhost';
$spamuser = array('ID' => 'none',);
$spamuserA = json_encode($spamuser, true);
$spamtype = 'Upgraded';
$spamvalue = 'Plugin Install or Upgrade Tasks Done.';
$cache = '4H';
$SpamMasterLogController = new SpamMasterLogController;
$is_log = $SpamMasterLogController->SpamMasterLog($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype, $spamvalue, $cache);
?>
