<?php
global $wpdb, $blog_id;

if( is_multisite() ){
	$blogs = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs;" );
	foreach ( $blogs as $id ) {
		//Update DB
		$spam_master_keys = $wpdb->get_blog_prefix($id)."spam_master_keys";
		//White Empath
		$is_there = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_white_empath'");
		if(empty($is_there)){
			$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_white_empath', 'spamy' => 'localhost', 'spamvalue' => 'false'));
		}
		$is_there1 = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_emails_weekly_stats_date'");
		if(empty($is_there1)){
			$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_emails_weekly_stats_date', 'spamy' => 'localhost', 'spamvalue' => '1970-01-01'));
		}

		//Update
		update_blog_option($id, 'spam_master_upgrade_to_6_6_5', '1');
	}
}
else{
	//Update DB
	$spam_master_keys = $wpdb->prefix."spam_master_keys";
	//White Empath
	$is_there = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_white_empath'");
	if(empty($is_there)){
		$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_white_empath', 'spamy' => 'localhost', 'spamvalue' => 'false'));
	}
	$is_there1 = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_emails_weekly_stats_date'");
	if(empty($is_there1)){
		$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_emails_weekly_stats_date', 'spamy' => 'localhost', 'spamvalue' => '1970-01-01'));
	}

	//Update
	update_option('spam_master_upgrade_to_6_6_5', '1');
}
?>
