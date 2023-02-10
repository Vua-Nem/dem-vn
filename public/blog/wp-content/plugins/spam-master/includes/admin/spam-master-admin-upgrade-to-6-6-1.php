<?php
global $wpdb, $blog_id;

if( is_multisite() ){
	$blogs = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs;" );
	foreach ( $blogs as $id ) {
		//Delete Unused Columns
		$table_keys_col = $wpdb->get_blog_prefix($id)."spam_master_keys";
		$wpdb->query("ALTER TABLE {$table_keys_col} DROP COLUMN IF EXISTS spamip");
		$wpdb->query("ALTER TABLE {$table_keys_col} DROP COLUMN IF EXISTS spamco");
		$wpdb->query("ALTER TABLE {$table_keys_col} DROP COLUMN IF EXISTS spamco");
		$wpdb->query("ALTER TABLE {$table_keys_col} DROP COLUMN IF EXISTS spamcou");
		$wpdb->query("ALTER TABLE {$table_keys_col} DROP COLUMN IF EXISTS spamrefe");
		$wpdb->query("ALTER TABLE {$table_keys_col} DROP COLUMN IF EXISTS spamdest");
		$wpdb->query("ALTER TABLE {$table_keys_col} DROP COLUMN IF EXISTS spamagen");
		$wpdb->query("ALTER TABLE {$table_keys_col} DROP COLUMN IF EXISTS spamuser");
		$wpdb->query("ALTER TABLE {$table_keys_col} MODIFY spamvalue LONGTEXT NOT NULL AFTER spamy");
		$is_meltdown = $wpdb->get_var("SELECT spamvalue FROM {$table_keys_col} WHERE spamkey = 'Option' AND spamtype = 'spam_master_russian_char_set'");
		if(empty($is_meltdown)){
			update_blog_option($id, 'spam_master_upgrade_to_6_6_0', '0');
		}
		//Install plugin options
		$spam_master_keys = $wpdb->get_blog_prefix($id)."spam_master_keys";
		$is_there = $wpdb->get_var("SELECT spamvalue FROM {$table_keys_col} WHERE spamkey = 'Option' AND spamtype = 'spam_master_new_options'");
		if(empty($is_there)){
			$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_new_options', 'spamy' => 'localhost', 'spamvalue' => '1'));
		}
		//Delete Duplicate
		$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_spam_char_set' AND spamy = 'localhost' AND spamvalue = 'false'" );
		//Delete legacy
		$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_recaptcha_ampoff'" );
		$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_recaptcha_preview'" );
		$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_recaptcha_version'" );
		$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_recaptcha_public_key'" );
		$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_recaptcha_secret_key'" );
		$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_recaptcha_theme'" );
		$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_recaptcha_registration'" );
		$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_recaptcha_login'" );
		$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_recaptcha_comments'" );
		// Flush Buffer
		$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Buffer'" );
		//Update
		update_blog_option($id, 'spam_master_upgrade_to_6_6_1', '1');
	}
}
else{
	//Delete Unused Columns
	$table_keys_col = $wpdb->prefix."spam_master_keys";
	$wpdb->query("ALTER TABLE {$table_keys_col} DROP COLUMN IF EXISTS spamip");
	$wpdb->query("ALTER TABLE {$table_keys_col} DROP COLUMN IF EXISTS spamco");
	$wpdb->query("ALTER TABLE {$table_keys_col} DROP COLUMN IF EXISTS spamco");
	$wpdb->query("ALTER TABLE {$table_keys_col} DROP COLUMN IF EXISTS spamcou");
	$wpdb->query("ALTER TABLE {$table_keys_col} DROP COLUMN IF EXISTS spamrefe");
	$wpdb->query("ALTER TABLE {$table_keys_col} DROP COLUMN IF EXISTS spamdest");
	$wpdb->query("ALTER TABLE {$table_keys_col} DROP COLUMN IF EXISTS spamagen");
	$wpdb->query("ALTER TABLE {$table_keys_col} DROP COLUMN IF EXISTS spamuser");
	$wpdb->query("ALTER TABLE {$table_keys_col} MODIFY spamvalue LONGTEXT NOT NULL AFTER spamy");
	$is_meltdown = $wpdb->get_var("SELECT spamvalue FROM {$table_keys_col} WHERE spamkey = 'Option' AND spamtype = 'spam_master_russian_char_set'");
	if(empty($is_meltdown)){
		update_option('spam_master_upgrade_to_6_6_0', '0');
	}
	//Install plugin options
	$spam_master_keys = $wpdb->prefix."spam_master_keys";
	$is_there = $wpdb->get_var("SELECT spamvalue FROM {$table_keys_col} WHERE spamkey = 'Option' AND spamtype = 'spam_master_new_options'");
	if(empty($is_there)){
		$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_new_options', 'spamy' => 'localhost', 'spamvalue' => '1'));
	}
	//Delete Duplicate
	$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_spam_char_set' AND spamy = 'localhost' AND spamvalue = 'false'" );
	//Delete legacy
	$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_recaptcha_ampoff'" );
	$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_recaptcha_preview'" );
	$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_recaptcha_version'" );
	$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_recaptcha_public_key'" );
	$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_recaptcha_secret_key'" );
	$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_recaptcha_theme'" );
	$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_recaptcha_registration'" );
	$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_recaptcha_login'" );
	$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_recaptcha_comments'" );
	// Flush Buffer
	$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Buffer'" );
	//Update
	update_option('spam_master_upgrade_to_6_6_1', '1');
}
?>
