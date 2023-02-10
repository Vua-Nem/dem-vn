<?php
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}
if(!function_exists('wp_get_current_user')) {
	include(ABSPATH . "wp-includes/pluggable.php"); 
}
global $wpdb, $blog_id, $current_user;
if ((is_user_logged_in()) && (current_user_can( 'administrator' ))){
	if( is_multisite() ){
		//Delete Spam Master Table & Options
		$blogs = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs;" );
		foreach ( $blogs as $id ) {
			$table_keys = $wpdb->get_blog_prefix($id)."spam_master_keys";
			$wpdb->query( "DROP TABLE IF EXISTS $table_keys" );
			delete_blog_option($id, 'spam_master_upgrade_to_6');
			delete_blog_option($id, 'spam_master_upgrade_to_6_6_0');
			delete_blog_option($id, 'spam_master_upgrade_to_6_6_1');
			delete_blog_option($id, 'spam_master_upgrade_to_6_6_2');
			delete_blog_option($id, 'spam_master_upgrade_to_6_6_3');
			delete_blog_option($id, 'spam_master_upgrade_to_6_6_5');
			delete_blog_option($id, 'spam_master_upgrade_to_6_6_6');
			delete_blog_option($id, 'spam_master_upgrade_to_6_6_19');
			delete_blog_option($id, 'spam_master_upgrade_to_6_7_0');
			delete_blog_option($id, 'spam_master_upgrade_to_6_7_2');
			delete_blog_option($id, 'spam_master_keys_db_version');
			delete_blog_option($id, 'spam_master_connection');
		}
	}
	else{
		//Delete Spam Master Table & Options
		$table_keys = $wpdb->prefix."spam_master_keys";
		$wpdb->query( "DROP TABLE IF EXISTS $table_keys" );
		delete_option('spam_master_upgrade_to_6');
		delete_option('spam_master_upgrade_to_6_6_0');
		delete_option('spam_master_upgrade_to_6_6_1');
		delete_option('spam_master_upgrade_to_6_6_2');
		delete_option('spam_master_upgrade_to_6_6_3');
		delete_option('spam_master_upgrade_to_6_6_5');
		delete_option('spam_master_upgrade_to_6_6_6');
		delete_option('spam_master_upgrade_to_6_6_19');
		delete_option('spam_master_upgrade_to_6_7_0');
		delete_option('spam_master_upgrade_to_6_7_2');
		delete_option('spam_master_keys_db_version');
		delete_option('spam_master_connection');
	}
}
?>
