<?php
global $wpdb, $blog_id;

if( is_multisite() ){
	$blogs = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs;" );
	foreach ( $blogs as $id ) {
		//Update DB
		$spam_master_keys = $wpdb->get_blog_prefix($id)."spam_master_keys";
		//DB Protection hash
		$is_there = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_db_protection_hash'");
		if(empty($is_there)){
			$spam_master_db_protection_hash = substr(md5(uniqid(mt_rand(), true)),0,64);
			if(empty($spam_master_db_protection_hash)){
				$spam_master_db_protection_hash = 'md5-'.date('YmdHis');
			}
			$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_db_protection_hash', 'spamy' => 'localhost', 'spamvalue' => $spam_master_db_protection_hash));
		}

		//Update
		update_blog_option($id, 'spam_master_upgrade_to_6_6_2', '1');
	}
}
else{
	//Update DB
	$spam_master_keys = $wpdb->prefix."spam_master_keys";
	//DB Protection hash
	$is_there = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_db_protection_hash'");
	if(empty($is_there)){
		$spam_master_db_protection_hash = substr(md5(uniqid(mt_rand(), true)),0,64);
		if(empty($spam_master_db_protection_hash)){
			$spam_master_db_protection_hash = 'md5-'.date('YmdHis');
		}
		$wpdb->insert( $spam_master_keys, array('time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_db_protection_hash', 'spamy' => 'localhost', 'spamvalue' => $spam_master_db_protection_hash));
	}

	//Update
	update_option('spam_master_upgrade_to_6_6_2', '1');
}
?>
