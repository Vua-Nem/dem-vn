<?php
global $wpdb, $blog_id;

if( is_multisite() ){
	$blogs = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs;" );
	foreach ( $blogs as $id ) {
		//Update DB
		$spam_master_keys = $wpdb->get_blog_prefix($id)."spam_master_keys";
		$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Buffer'" );

		//Update
		update_blog_option($id, 'spam_master_upgrade_to_6_6_3', '1');
	}
}
else{
	//Update DB
	$spam_master_keys = $wpdb->prefix."spam_master_keys";
	$wpdb->query( "DELETE FROM $spam_master_keys WHERE spamkey = 'Buffer'" );

	//Update
	update_option('spam_master_upgrade_to_6_6_3', '1');
}
?>
