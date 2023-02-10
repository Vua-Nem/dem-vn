<?php
global $wpdb, $blog_id;
////////////////////////////////////
//AMP CHECK FUNCTION FOR RECAPTCHA//
////////////////////////////////////

//Add Table & Load Spam Master Options
if(is_multisite()){
	$spam_master_keys = $wpdb->get_blog_prefix($blog_id)."spam_master_keys";
}
else{
	$spam_master_keys = $wpdb->prefix."spam_master_keys";
}
$spam_master_amp_check_fun = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_amp_check_fun'");

if ($spam_master_amp_check_fun == 'true'){
	function spam_master_amp_check() {
		if (function_exists( 'is_amp_endpoint' ) && is_amp_endpoint () ) {
			return 'true';
		}
		else{
			return 'false';
		}
	}
}
else {
	function spam_master_amp_check() {
		return 'false';
	}
}
?>
