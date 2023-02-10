<?php
global $wpdb, $blog_id;

$plugin_master_name = constant('SPAM_MASTER_NAME');
$plugin_master_domain = constant('SPAM_MASTER_DOMAIN');
?>
<div class="spam-master-pad-table"></div>
<p>
<a class="btn-spammaster blue roundedspam" href="https://www.spammaster.org" target="_blank" title="<?php echo $plugin_master_domain; ?>"><?php echo $plugin_master_domain; ?></a>
<a class="btn-spammaster blue roundedspam" href="https://www.spammaster.org/documentation/" target="_blank" title="<?php echo $plugin_master_domain; ?>"><?php echo $plugin_master_name; ?> <?php echo __('Documentation', 'spam_master'); ?></a>
<?php
//Add Table & Load Spam Master Options
if(is_multisite()){
	$spam_master_keys = $wpdb->get_blog_prefix($blog_id)."spam_master_keys";
}
else{
	$spam_master_keys = $wpdb->prefix."spam_master_keys";
}
$spam_master_status = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_status'");
$spam_master_type = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_type'");
$spam_master_invitation_free_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_invitation_free_notice'");
$spam_master_invitation_full_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_invitation_full_notice'");
$spam_master_expires = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_expires'");

if(empty($spam_master_expires) || $spam_master_expires == 'EMPTY' || $spam_master_expires == '0000-00-00 00:00:00'){
	$spam_master_expires = '2099-01-01 01:01:01';
}
$spam_master_current_date = current_time('Y-m-d');
$spam_master_invitation_notice_plus_7 = date('Y-m-d', strtotime('+7 days', strtotime($spam_master_expires)) );
$spam_master_invitation_notice_minus_350 = date('Y-m-d', strtotime('-333 days', strtotime($spam_master_expires)) );

if($spam_master_status == 'VALID'){
	if($spam_master_type == 'FREE' || $spam_master_type == 'TRIAL'){
		if($spam_master_current_date >= $spam_master_invitation_notice_plus_7 && $spam_master_invitation_free_notice != '1'){
?>
<a class="btn-spammaster green roundedspam" href="https://wordpress.org/plugins/spam-master/" target="_blank" title="<?php echo __('Rate Us on Wordpress.org', 'spam_master'); ?>"><?php echo __('Rate us', 'spam_master'); ?> <span class="dashicons dashicons-star-filled spam-master-top-admin-f-yellow spam-master-top-admin-shadow-orangina"></span><span class="dashicons dashicons-star-filled spam-master-top-admin-f-yellow spam-master-top-admin-shadow-orangina"></span><span class="dashicons dashicons-star-filled spam-master-top-admin-f-yellow spam-master-top-admin-shadow-orangina"></span><span class="dashicons dashicons-star-filled spam-master-top-admin-f-yellow spam-master-top-admin-shadow-orangina"></span><span class="dashicons dashicons-star-filled spam-master-top-admin-f-yellow spam-master-top-admin-shadow-orangina"></span></a>
<?php
		}
	}
	if($spam_master_type == 'FULL'){
		if($spam_master_current_date >= $spam_master_invitation_notice_minus_350 && $spam_master_invitation_full_notice != '1'){
?>
<a class="btn-spammaster green roundedspam" href="https://wordpress.org/plugins/spam-master/" target="_blank" title="<?php echo __('Rate Us on Wordpress.org', 'spam_master'); ?>"><?php echo __('Rate us', 'spam_master'); ?> <span class="dashicons dashicons-star-filled spam-master-top-admin-f-yellow spam-master-top-admin-shadow-orangina"></span><span class="dashicons dashicons-star-filled spam-master-top-admin-f-yellow spam-master-top-admin-shadow-orangina"></span><span class="dashicons dashicons-star-filled spam-master-top-admin-f-yellow spam-master-top-admin-shadow-orangina"></span><span class="dashicons dashicons-star-filled spam-master-top-admin-f-yellow spam-master-top-admin-shadow-orangina"></span><span class="dashicons dashicons-star-filled spam-master-top-admin-f-yellow spam-master-top-admin-shadow-orangina"></span></a>
<?php
		}
	}
}
?>
</p>
