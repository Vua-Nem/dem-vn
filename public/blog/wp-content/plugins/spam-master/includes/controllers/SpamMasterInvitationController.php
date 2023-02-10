<?php
class SpamMasterInvitationController {

	public function SpamMasterInvitation() {
		global $wpdb, $blog_id;

		//Add Table & Load Spam Master Options
		if(is_multisite()){
			$spam_master_keys = $wpdb->get_blog_prefix($blog_id)."spam_master_keys";
		}
		else{
			$spam_master_keys = $wpdb->prefix."spam_master_keys";
		}
		$spam_master_type = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_type'");
		$spam_master_status = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_status'");
		$spam_master_expires = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_expires'");
		$spam_master_invitation_free_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_invitation_free_notice'");
		$spam_master_invitation_full_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_invitation_full_notice'");

		$spam_master_current_date = current_time('Y-m-d');
		if(empty($spam_master_expires) || $spam_master_expires == 'EMPTY' || $spam_master_expires == '0000-00-00 00:00:00'){
			$spam_master_expires = '2099-01-01 01:01:01';
		}
		$spam_master_invitation_notice_plus_7 = date('Y-m-d', strtotime('+7 days', strtotime($spam_master_expires)) );
		$spam_master_invitation_notice_plus_15 = date('Y-m-d', strtotime('+15 days', strtotime($spam_master_expires)) );
		$spam_master_invitation_notice_minus_333 = date('Y-m-d', strtotime('-333 days', strtotime($spam_master_expires)) );
		$path = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		$current_url = wp_nonce_url($path, 'save-spam_master_dismissal');
		if(empty($spam_master_type) || $spam_master_type == 'EMPTY'){
		}
		if($spam_master_type == 'FREE' && $spam_master_status == 'VALID'){
			if($spam_master_current_date >= $spam_master_invitation_notice_plus_7 && $spam_master_invitation_free_notice != '1'){
				return '<table class="wp-list-table widefat fixed " cellspacing="0">
<thead>
<tr class="spam-master-top-admin-green">
<th>
<span class="dashicons dashicons-admin-post"></span> '.__('If you haven\'t done so, Please Rate', 'spam_master').' <a class="spam-master-admin-link-decor" href="https://wordpress.org/plugins/spam-master/" title="'.__('Let us know what you think, we value your input.', 'spam_master').'" target="_blank"><span class="dashicons dashicons-star-filled spam-master-top-admin-f-yellow spam-master-top-admin-shadow-orangina"></span><span class="dashicons dashicons-star-filled spam-master-top-admin-f-yellow spam-master-top-admin-shadow-orangina"></span><span class="dashicons dashicons-star-filled spam-master-top-admin-f-yellow spam-master-top-admin-shadow-orangina"></span><span class="dashicons dashicons-star-filled spam-master-top-admin-f-yellow spam-master-top-admin-shadow-orangina"></span><span class="dashicons dashicons-star-filled spam-master-top-admin-f-yellow spam-master-top-admin-shadow-orangina"></span></a> '.__('on', 'spam_master').' <a class="spam-master-admin-link-decor" href="https://wordpress.org/plugins/spam-master/" title="'.__('Spread the Love.', 'spam_master').'" target="_blank"><strong>'.__('Wordpress.org', 'spam_master').'</strong></a> '.__('to help us spread the word', 'spam_master').'. 
<a class="spam-master-admin-link-decor" href="'.$current_url.'&spammasterdisfr=1"><span class="dashicons dashicons-dismiss spam-master-top-admin-f-red spam-master-top-admin-shadow-orange spam-master-admin-float-r" title="'.__('Dismiss', 'spam_master').'"></span></a>
</th>
</tr>
</thead>
</table>';
			}
			if($spam_master_current_date >= $spam_master_invitation_notice_plus_15){
				return '<table class="wp-list-table widefat fixed " cellspacing="0">
<thead>
<tr class="spam-master-top-admin-yellow">
<th>
<span class="dashicons dashicons-admin-post"></span> '.__('Thank you for using Spam Master. Please consider upgrading to a', 'spam_master').' <a href="https://www.techgasp.com/downloads/spam-master-license/" title="'.__('it costs peanuts per year', 'spam_master').'" target="_blank"><span class="dashicons dashicons-info-outline"></span> '.__('Pro Key', 'spam_master').'</a> '.__('for a huge connection boost to our Premium RBL Server Clusters, it costs peanuts per year.', 'spam_master').'
</th>
</tr>
</thead>
</table>';
			}
		}
		if($spam_master_type == 'FULL' && $spam_master_status == 'VALID'){
			if($spam_master_current_date >= $spam_master_invitation_notice_minus_333 && $spam_master_invitation_full_notice != '1'){
				return '<table class="wp-list-table widefat fixed " cellspacing="0">
<thead>
<tr class="spam-master-top-admin-green">
<th>
<span class="dashicons dashicons-admin-post"></span> '.__('If you haven\'t done so, Please Rate', 'spam_master').' <a class="spam-master-admin-link-decor" href="https://wordpress.org/plugins/spam-master/" title="'.__('Let us know what you think, we value your input.', 'spam_master').'" target="_blank"><span class="dashicons dashicons-star-filled spam-master-top-admin-f-yellow spam-master-top-admin-shadow-orangina"></span><span class="dashicons dashicons-star-filled spam-master-top-admin-f-yellow spam-master-top-admin-shadow-orangina"></span><span class="dashicons dashicons-star-filled spam-master-top-admin-f-yellow spam-master-top-admin-shadow-orangina"></span><span class="dashicons dashicons-star-filled spam-master-top-admin-f-yellow spam-master-top-admin-shadow-orangina"></span><span class="dashicons dashicons-star-filled spam-master-top-admin-f-yellow spam-master-top-admin-shadow-orangina"></span></a> '.__('on', 'spam_master').' <a class="spam-master-admin-link-decor" href="https://wordpress.org/plugins/spam-master/" title="'.__('Spread the Love.', 'spam_master').'" target="_blank"><strong>'.__('Wordpress.org', 'spam_master').'</strong></a> '.__('to help us spread the word', 'spam_master').'. 
<a class="spam-master-admin-link-decor" href="'.$current_url.'&spammasterdisfu=1"><span class="dashicons dashicons-dismiss spam-master-top-admin-f-red spam-master-top-admin-shadow-orange spam-master-admin-float-r" title="'.__('Dismiss', 'spam_master').'"></span></a>
</th>
</tr>
</thead>
</table>';
			}
		}
	}

}
?>
