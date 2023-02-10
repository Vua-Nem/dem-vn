<?php
global $wpdb, $blog_id;

if( is_multisite() ){
	$blogs = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs;" );
	foreach ( $blogs as $id ) {
		//Update DB
		$spam_master_keys = $wpdb->get_blog_prefix($id)."spam_master_keys";
		// Spam Master Firewall Page
		$is_spam_master_firewall_page = $wpdb->get_var( "SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_firewall_page'" );
		if( empty( $is_spam_master_firewall_page ) ) {
			$spam_master_temp_firewall_page = get_site_url() . '/wp-content/plugins/spam-master/includes/protection/spam-master-admin-other-protection-frontend-firewall.html';
			$wpdb->insert( $spam_master_keys, array( 'time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_firewall_page', 'spamy' => 'localhost', 'spamvalue' => $spam_master_temp_firewall_page ) );
		}

		//Update
		update_blog_option( $id, 'spam_master_upgrade_to_6_6_19', '1' );
	}
}
else{
	//Update DB
	$spam_master_keys = $wpdb->prefix."spam_master_keys";
	// Spam Master Firewall Page
	$is_spam_master_firewall_page = $wpdb->get_var( "SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_firewall_page'" );
	if( empty( $is_spam_master_firewall_page ) ) {
		$spam_master_temp_firewall_page = get_site_url() . '/wp-content/plugins/spam-master/includes/protection/spam-master-admin-other-protection-frontend-firewall.html';
		$wpdb->insert( $spam_master_keys, array( 'time' => current_time( 'mysql' ), 'spamkey' => 'Option', 'spamtype' => 'spam_master_firewall_page', 'spamy' => 'localhost', 'spamvalue' => $spam_master_temp_firewall_page ) );
	}

	//Update
	update_option('spam_master_upgrade_to_6_6_19', '1');
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

// Flush htaccess.
add_action('admin_init', 'spam_master_flush_rewrites');
function spam_master_flush_rewrites($wp_rewrite){
global $wp_rewrite;
	$wp_rewrite->flush_rules();
}
?>
