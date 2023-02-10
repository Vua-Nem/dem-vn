<?php
global $wpdb, $blog_id;

if( is_multisite() ){
	$blogs = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs;" );
	foreach ( $blogs as $id ) {
		//Update DB
		$spam_master_keys = $wpdb->get_blog_prefix($id)."spam_master_keys";
		//Delete Buffer emails
		$is_email = $wpdb->get_results("SELECT id FROM {$spam_master_keys} WHERE spamkey = 'Buffer' AND spamy LIKE '%@%'");
		if(!empty($is_email)){
			foreach($is_email as $emailid){
				$spam_email_id = $emailid->id;
				$wpdb->query( $wpdb->prepare( "DELETE FROM {$spam_master_keys} WHERE spamkey = 'Buffer' AND id = %s", $spam_email_id));
			}
		}

		//Update
		update_blog_option($id, 'spam_master_upgrade_to_6_6_6', '1');
	}
}
else{
	//Update DB
	$spam_master_keys = $wpdb->prefix."spam_master_keys";
	//Delete Buffer emails
	$is_email = $wpdb->get_results("SELECT id FROM {$spam_master_keys} WHERE spamkey = 'Buffer' AND spamy LIKE '%@%'");
	if(!empty($is_email)){
		foreach($is_email as $emailid){
			$spam_email_id = $emailid->id;
			$wpdb->query( $wpdb->prepare( "DELETE FROM {$spam_master_keys} WHERE spamkey = 'Buffer' AND id = %s", $spam_email_id));
		}
	}

	//Update
	update_option('spam_master_upgrade_to_6_6_6', '1');
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
