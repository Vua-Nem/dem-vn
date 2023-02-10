<?php
global $wpdb, $blog_id;
//Add Table & Load Spam Master Options
if(is_multisite()){
	$spam_master_keys = $wpdb->get_blog_prefix($blog_id)."spam_master_keys";
}
else{
	$spam_master_keys = $wpdb->prefix."spam_master_keys";
}
$spam_master_status = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_status'");
$spam_master_type = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_type'");
$spam_master_comments_clean = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_comments_clean'");
$spam_master_free_unstable_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_free_unstable_date'");
$spam_master_free_unstable_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_free_unstable_notice'");
$spam_master_full_expired_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_full_expired_date'");
$spam_master_full_expired_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_full_expired_notice'");
$spam_master_full_inactive_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_full_inactive_date'");
$spam_master_full_inactive_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_full_inactive_notice'");
$spam_master_free_expired_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_free_expired_date'");
$spam_master_free_expired_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_free_expired_notice'");
$spam_master_trial_expired_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_trial_expired_date'");
$spam_master_trial_expired_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_trial_expired_notice'");
$spam_master_new_options = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_new_options'");
$spam_master_ip = substr($wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_ip'"),0,48);
$spam_master_ip2 = substr($wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_ip2'"),0,48);
$spam_master_cron_alert_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_cron_alert_date'");
$spam_master_cron_alert_date_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_cron_alert_date_notice'");
$spam_master_malfunction_1_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_malfunction_1_date'");
$spam_master_malfunction_1_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_malfunction_1_notice'");
$spam_master_malfunction_2_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_malfunction_2_date'");
$spam_master_malfunction_2_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_malfunction_2_notice'");
$spam_master_malfunction_6_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_malfunction_6_date'");
$spam_master_malfunction_6_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_malfunction_6_notice'");

//Time Frames
$current_time = current_time( 'mysql' );
$cache1H = date('Y-m-d h:i:s', strtotime("-1 hour", strtotime($current_time)));
$cache4H = date('Y-m-d h:i:s', strtotime("-4 hour", strtotime($current_time)));
// Above
$cache1D = date('Y-m-d h:i:s', strtotime("-1 day", strtotime($current_time)));
$cache7D = date('Y-m-d h:i:s', strtotime("-7 day", strtotime($current_time)));
$cache3M = date('Y-m-d h:i:s', strtotime("-3 months", strtotime($current_time)));
$cache12M = date('Y-m-d h:i:s', strtotime("-12 months", strtotime($current_time)));

//Clean Up Buffer cache1H
$wpdb->query( $wpdb->prepare( "DELETE FROM $spam_master_keys WHERE spamkey = 'Buffer' AND spamtype = 'Cache' AND spamvalue = '1H' AND time <= %s", $cache1H ));
//Clean Up Buffer cache4H
$wpdb->query( $wpdb->prepare( "DELETE FROM $spam_master_keys WHERE spamkey = 'Buffer' AND spamtype = 'Cache' AND spamvalue = '4H' AND time <= %s", $cache4H ));
//Clean Up Buffer cache1D
$wpdb->query( $wpdb->prepare( "DELETE FROM $spam_master_keys WHERE spamkey = 'Buffer' AND spamtype = 'Cache' AND spamvalue = '1D' AND time <= %s", $cache1D ));
//Clean Up Buffer cache7D
$wpdb->query( $wpdb->prepare( "DELETE FROM $spam_master_keys WHERE spamkey = 'Buffer' AND spamtype = 'Cache' AND spamvalue = '7D' AND time <= %s", $cache7D ));
//Clean Up Buffer cache3M
$wpdb->query( $wpdb->prepare( "DELETE FROM $spam_master_keys WHERE spamkey = 'Buffer' AND spamtype = 'Cache' AND spamvalue = '3M' AND time <= %s", $cache3M ));
//Clean Up Buffer cache12M
$wpdb->query( $wpdb->prepare( "DELETE FROM $spam_master_keys WHERE spamkey = 'Buffer' AND spamtype = 'Cache' AND spamvalue = '12M' AND time <= %s", $cache12M ));

//Clean Up White cache1H
$wpdb->query( $wpdb->prepare( "DELETE FROM $spam_master_keys WHERE spamkey = 'White' AND spamtype = 'Cache' AND spamvalue = '1H' AND time <= %s", $cache1H ));
//Clean Up White cache4H
$wpdb->query( $wpdb->prepare( "DELETE FROM $spam_master_keys WHERE spamkey = 'White' AND spamtype = 'Cache' AND spamvalue = '4H' AND time <= %s", $cache4H ));
//Clean Up White cache1D
$wpdb->query( $wpdb->prepare( "DELETE FROM $spam_master_keys WHERE spamkey = 'White' AND spamtype = 'Cache' AND spamvalue = '1D' AND time <= %s", $cache1D ));
//Clean Up White cache7D
$wpdb->query( $wpdb->prepare( "DELETE FROM $spam_master_keys WHERE spamkey = 'White' AND spamtype = 'Cache' AND spamvalue = '7D' AND time <= %s", $cache7D ));
//Clean Up White cache3M
$wpdb->query( $wpdb->prepare( "DELETE FROM $spam_master_keys WHERE spamkey = 'White' AND spamtype = 'Cache' AND spamvalue = '3M' AND time <= %s", $cache3M ));
//Clean Up White cache12M
$wpdb->query( $wpdb->prepare( "DELETE FROM $spam_master_keys WHERE spamkey = 'White' AND spamtype = 'Cache' AND spamvalue = '12M' AND time <= %s", $cache12M ));

//Clean Up System cache1H
$wpdb->query( $wpdb->prepare( "DELETE FROM $spam_master_keys WHERE spamkey = 'System' AND spamvalue = '1H' AND time <= %s", $cache1H ));
//Clean Up System cache4H
$wpdb->query( $wpdb->prepare( "DELETE FROM $spam_master_keys WHERE spamkey = 'System' AND spamvalue = '4H' AND time <= %s", $cache4H ));
//Clean Up System cache1D
$wpdb->query( $wpdb->prepare( "DELETE FROM $spam_master_keys WHERE spamkey = 'System' AND spamvalue = '1D' AND time <= %s", $cache1D ));
//Clean Up System cache7D
$wpdb->query( $wpdb->prepare( "DELETE FROM $spam_master_keys WHERE spamkey = 'System' AND spamvalue = '7D' AND time <= %s", $cache7D ));
//Clean Up System cache3M
$wpdb->query( $wpdb->prepare( "DELETE FROM $spam_master_keys WHERE spamkey = 'System' AND spamvalue = '3M' AND time <= %s", $cache3M ));
//Clean Up System cache12M
$wpdb->query( $wpdb->prepare( "DELETE FROM $spam_master_keys WHERE spamkey = 'System' AND spamvalue = '12M' AND time <= %s", $cache12M ));

// Delete server ip and whitelist if any
$wpdb->query( $wpdb->prepare( "DELETE FROM $spam_master_keys WHERE spamkey = 'Buffer' AND spamtype = 'Cache' AND spamy = %s", $spam_master_ip ));
$wpdb->query( $wpdb->prepare( "DELETE FROM $spam_master_keys WHERE spamkey = 'Buffer' AND spamtype = 'Cache' AND spamy = %s", $spam_master_ip2 ));

//Clean Up Comments & Clean-up Logs
if( is_multisite() ){
	if($spam_master_comments_clean == 'true'){
		$blog_prefix = $wpdb->get_blog_prefix();
		$result_comments_status = $wpdb->get_results("SELECT comment_ID,comment_author_IP,comment_author_email,comment_approved FROM {$blog_prefix}comments WHERE comment_approved = '0' OR comment_approved = '1' OR comment_approved = 'spam' OR comment_approved = 'trash'");
		foreach($result_comments_status as $status){
			$status_id = $status->comment_ID;
			$status_ip = $status->comment_author_IP;
			$status_email = $status->comment_author_email;
			$status_status = $status->comment_approved;

			$is_buffer_threat = $wpdb->get_results(
								$wpdb->prepare( 
												"SELECT spamy 
												FROM $spam_master_keys
												WHERE spamkey = 'Buffer' AND spamy = %s", 
												$status_ip
								));
			if(!empty($is_buffer_threat)){
				wp_delete_comment( $status_id, false );
			}
		}
		//Clean old trashed comments
		$wpdb->query( 
					$wpdb->prepare( 
									"DELETE FROM {$blog_prefix}comments
									WHERE 
									(comment_approved = '0' OR comment_approved = '1' OR comment_approved = 'spam' OR comment_approved = 'trash')
									AND
									comment_date <= %s",
									$cache3M
		));
	}
}
else{
	if($spam_master_comments_clean == 'true'){
	$table_prefix = $wpdb->base_prefix;
	$result_comments_status = $wpdb->get_results("SELECT comment_ID,comment_author_IP,comment_author_email,comment_approved FROM {$table_prefix}comments WHERE comment_approved = '0' OR comment_approved = '1' OR comment_approved = 'spam' OR comment_approved = 'trash'");
		foreach($result_comments_status as $status){
			$status_id = $status->comment_ID;
			$status_ip = $status->comment_author_IP;
			$status_email = $status->comment_author_email;
			$status_status = $status->comment_approved;

			$is_buffer_threat = $wpdb->get_results(
								$wpdb->prepare( 
												"SELECT spamy 
												FROM $spam_master_keys
												WHERE spamkey = 'Buffer' AND spamy = %s", 
												$status_ip
								));
			if(!empty($is_buffer_threat)){
				wp_delete_comment( $status_id, false );
			}
		}
		//Clean old trashed comments
		$wpdb->query( 
					$wpdb->prepare( 
									"DELETE FROM {$table_prefix}comments
									WHERE 
									(comment_approved = '0' OR comment_approved = '1' OR comment_approved = 'spam' OR comment_approved = 'trash')
									AND
									comment_date <= %s",
									$cache3M
		));
	}
}

//Need to make sure unstable notice is set to 0 to warn users
$spam_master_current_date = current_time('Y-m-d');
if($spam_master_current_date >= $spam_master_free_unstable_date && $spam_master_free_unstable_notice == '1'){
	//Update Notice
	$data_spam = array( 'spamvalue' => '0' );
	$where_spam = array('spamkey' => 'Option', 'spamtype' => 'spam_master_free_unstable_notice');
	$wpdb->update( $spam_master_keys, $data_spam, $where_spam );
}
if($spam_master_current_date >= $spam_master_malfunction_1_date && $spam_master_malfunction_1_notice == '1'){
	//Update Notice
	$data_spam = array( 'spamvalue' => '0' );
	$where_spam = array('spamkey' => 'Option', 'spamtype' => 'spam_master_malfunction_1_notice');
	$wpdb->update( $spam_master_keys, $data_spam, $where_spam );
}
if($spam_master_current_date >= $spam_master_malfunction_2_date && $spam_master_malfunction_2_notice == '1'){
	//Update Notice
	$data_spam = array( 'spamvalue' => '0' );
	$where_spam = array('spamkey' => 'Option', 'spamtype' => 'spam_master_malfunction_2_notice');
	$wpdb->update( $spam_master_keys, $data_spam, $where_spam );
}
if($spam_master_current_date >= $spam_master_malfunction_6_date && $spam_master_malfunction_6_notice == '1'){
	//Update Notice
	$data_spam = array( 'spamvalue' => '0' );
	$where_spam = array('spamkey' => 'Option', 'spamtype' => 'spam_master_malfunction_6_notice');
	$wpdb->update( $spam_master_keys, $data_spam, $where_spam );
}
if($spam_master_current_date >= $spam_master_cron_alert_date && $spam_master_cron_alert_date_notice == '1'){
	//Update Notice
	$data_spam = array( 'spamvalue' => '0' );
	$where_spam = array('spamkey' => 'Option', 'spamtype' => 'spam_master_cron_alert_date_notice');
	$wpdb->update( $spam_master_keys, $data_spam, $where_spam );
}
if( $spam_master_current_date >= $spam_master_full_expired_date && $spam_master_type == 'FULL' && $spam_master_full_expired_notice == '1' ) {
	//Update Notice
	$data_spam = array('spamvalue' => '0' );
	$where_spam = array('spamkey' => 'Option', 'spamtype' => 'spam_master_full_expired_notice');
	$wpdb->update( $spam_master_keys, $data_spam, $where_spam );
}
if( $spam_master_current_date >= $spam_master_full_inactive_date && $spam_master_type == 'FULL' && $spam_master_full_inactive_notice == '1' ) {
	//Update Notice
	$data_spam = array('spamvalue' => '0' );
	$where_spam = array('spamkey' => 'Option', 'spamtype' => 'spam_master_full_inactive_notice');
	$wpdb->update( $spam_master_keys, $data_spam, $where_spam );
}
if( $spam_master_current_date >= $spam_master_free_expired_date && $spam_master_type == 'FREE' && $spam_master_free_expired_notice == '1') {
	//Update Notice
	$data_spam = array('spamvalue' => '0' );
	$where_spam = array('spamkey' => 'Option', 'spamtype' => 'spam_master_free_expired_notice');
	$wpdb->update( $spam_master_keys, $data_spam, $where_spam );
}
if( $spam_master_current_date >= $spam_master_trial_expired_date && $spam_master_type == 'TRIAL' && $spam_master_trial_expired_notice == '1' ) {
	//Update Notice
	$data_spam = array('spamvalue' => '0' );
	$where_spam = array('spamkey' => 'Option', 'spamtype' => 'spam_master_trial_expired_notice');
	$wpdb->update( $spam_master_keys, $data_spam, $where_spam );
}

//Update Options
if($spam_master_status == 'VALID' || $spam_master_status == 'MALFUNCTION_1' || $spam_master_status == 'MALFUNCTION_2'){
	if($spam_master_new_options == '1'){
		//Spam Action Controller
		////////////////////////
		$SpamMasterActionController = new SpamMasterActionController;
		$is_act = $SpamMasterActionController->SpamMasterGetAct();
	}
}

//Log InUp Controller
$remote_ip = $spam_master_ip;
$blog_threat_email = 'localhost';
$remote_referer = 'localhost';
$dest_url = 'localhost';
$remote_agent = 'localhost';
$spamuser = array('ID' => 'none',);
$spamuserA = json_encode($spamuser, true);
$spamtype = 'Cron Tasks';
$spamvalue = 'Successfully run.';
$cache = '7D';
$SpamMasterLogController = new SpamMasterLogController;
$is_log = $SpamMasterLogController->SpamMasterLog($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype, $spamvalue, $cache);
?>
