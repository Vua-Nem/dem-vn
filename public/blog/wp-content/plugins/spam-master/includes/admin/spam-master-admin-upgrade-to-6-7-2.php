<?php
global $wpdb, $blog_id;

if( is_multisite() ){
	$blogs = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs;" );
	foreach ( $blogs as $id ) {
		//Update DB
		$spam_master_keys = $wpdb->get_blog_prefix($id)."spam_master_keys";
		// New Options.
		$spam_master_malfunction_1_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_malfunction_1_date'");
		if( empty( $spam_master_malfunction_1_date ) ) {
			$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_malfunction_1_date', 'spamy' => 'localhost', 'spamvalue' => '1970-01-01'));
		}
		$spam_master_malfunction_1_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_malfunction_1_notice'");
		if( empty( $spam_master_malfunction_1_notice ) ) {
			$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_malfunction_1_notice', 'spamy' => 'localhost', 'spamvalue' => '0'));
		}
		$spam_master_malfunction_2_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_malfunction_2_date'");
		if( empty( $spam_master_malfunction_2_date ) ) {
			$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_malfunction_2_date', 'spamy' => 'localhost', 'spamvalue' => '1970-01-01'));
		}
		$spam_master_malfunction_2_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_malfunction_2_notice'");
		if( empty( $spam_master_malfunction_2_notice ) ) {
			$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_malfunction_2_notice', 'spamy' => 'localhost', 'spamvalue' => '0'));
		}
		$spam_master_malfunction_3_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_malfunction_3_date'");
		if( empty( $spam_master_malfunction_3_date ) ) {
			$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_malfunction_3_date', 'spamy' => 'localhost', 'spamvalue' => '1970-01-01'));
		}
		$spam_master_malfunction_3_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_malfunction_3_notice'");
		if( empty( $spam_master_malfunction_3_notice ) ) {
			$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_malfunction_3_notice', 'spamy' => 'localhost', 'spamvalue' => '0'));
		}
		$spam_master_malfunction_4_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_malfunction_4_date'");
		if( empty( $spam_master_malfunction_4_date ) ) {
			$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_malfunction_4_date', 'spamy' => 'localhost', 'spamvalue' => '1970-01-01'));
		}
		$spam_master_malfunction_4_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_malfunction_4_notice'");
		if( empty( $spam_master_malfunction_4_notice ) ) {
			$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_malfunction_4_notice', 'spamy' => 'localhost', 'spamvalue' => '0'));
		}
		$spam_master_malfunction_5_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_malfunction_5_date'");
		if( empty( $spam_master_malfunction_5_date ) ) {
			$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_malfunction_5_date', 'spamy' => 'localhost', 'spamvalue' => '1970-01-01'));
		}
		$spam_master_malfunction_5_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_malfunction_5_notice'");
		if( empty( $spam_master_malfunction_5_notice ) ) {
			$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_malfunction_5_notice', 'spamy' => 'localhost', 'spamvalue' => '0'));
		}
		$spam_master_malfunction_6_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_malfunction_6_date'");
		if( empty( $spam_master_malfunction_6_date ) ) {
			$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_malfunction_6_date', 'spamy' => 'localhost', 'spamvalue' => '1970-01-01'));
		}
		$spam_master_malfunction_6_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_malfunction_6_notice'");
		if( empty( $spam_master_malfunction_6_notice ) ) {
			$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_malfunction_6_notice', 'spamy' => 'localhost', 'spamvalue' => '0'));
		}

		//Update
		update_blog_option( $id, 'spam_master_upgrade_to_6_7_2', '1' );
	}
}
else{
	//Update DB
	$spam_master_keys = $wpdb->prefix."spam_master_keys";
	// New Options.
	$spam_master_malfunction_1_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_malfunction_1_date'");
	if( empty( $spam_master_malfunction_1_date ) ) {
		$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_malfunction_1_date', 'spamy' => 'localhost', 'spamvalue' => '1970-01-01'));
	}
	$spam_master_malfunction_1_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_malfunction_1_notice'");
	if( empty( $spam_master_malfunction_1_notice ) ) {
		$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_malfunction_1_notice', 'spamy' => 'localhost', 'spamvalue' => '0'));
	}
	$spam_master_malfunction_2_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_malfunction_2_date'");
	if( empty( $spam_master_malfunction_2_date ) ) {
		$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_malfunction_2_date', 'spamy' => 'localhost', 'spamvalue' => '1970-01-01'));
	}
	$spam_master_malfunction_2_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_malfunction_2_notice'");
	if( empty( $spam_master_malfunction_2_notice ) ) {
		$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_malfunction_2_notice', 'spamy' => 'localhost', 'spamvalue' => '0'));
	}
	$spam_master_malfunction_3_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_malfunction_3_date'");
	if( empty( $spam_master_malfunction_3_date ) ) {
		$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_malfunction_3_date', 'spamy' => 'localhost', 'spamvalue' => '1970-01-01'));
	}
	$spam_master_malfunction_3_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_malfunction_3_notice'");
	if( empty( $spam_master_malfunction_3_notice ) ) {
		$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_malfunction_3_notice', 'spamy' => 'localhost', 'spamvalue' => '0'));
	}
	$spam_master_malfunction_4_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_malfunction_4_date'");
	if( empty( $spam_master_malfunction_4_date ) ) {
		$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_malfunction_4_date', 'spamy' => 'localhost', 'spamvalue' => '1970-01-01'));
	}
	$spam_master_malfunction_4_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_malfunction_4_notice'");
	if( empty( $spam_master_malfunction_4_notice ) ) {
		$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_malfunction_4_notice', 'spamy' => 'localhost', 'spamvalue' => '0'));
	}
	$spam_master_malfunction_5_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_malfunction_5_date'");
	if( empty( $spam_master_malfunction_5_date ) ) {
		$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_malfunction_5_date', 'spamy' => 'localhost', 'spamvalue' => '1970-01-01'));
	}
	$spam_master_malfunction_5_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_malfunction_5_notice'");
	if( empty( $spam_master_malfunction_5_notice ) ) {
		$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_malfunction_5_notice', 'spamy' => 'localhost', 'spamvalue' => '0'));
	}
	$spam_master_malfunction_6_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_malfunction_6_date'");
	if( empty( $spam_master_malfunction_6_date ) ) {
		$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_malfunction_6_date', 'spamy' => 'localhost', 'spamvalue' => '1970-01-01'));
	}
	$spam_master_malfunction_6_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_malfunction_6_notice'");
	if( empty( $spam_master_malfunction_6_notice ) ) {
		$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_malfunction_6_notice', 'spamy' => 'localhost', 'spamvalue' => '0'));
	}

	//Update
	update_option('spam_master_upgrade_to_6_7_2', '1');
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
