<?php
if(!class_exists('WP_List_Table')){
	require_once( get_home_path() . 'wp-admin/includes/class-wp-list-table.php' );
}
class spam_master_admin_table_inactive extends WP_List_Table {
	/**
	 * Display the rows of records in the table
	 * @return string, echo the markup of the rows
	 */
function display() {
global $wpdb, $blog_id;

$plugin_master_name = constant('SPAM_MASTER_NAME');
$plugin_master_domain = constant('SPAM_MASTER_DOMAIN');

if(isset($_POST['generate_free_spam_master_license'])){
	check_admin_referer( 'save-settings_generate_free_spam_master_license' );

	//Remote Ip
	$remote_ip = substr($_SERVER['REMOTE_ADDR'],0,48);
	//Remote Agent
	if(isset($_SERVER['HTTP_USER_AGENT'])){
		$remote_agent = substr($_SERVER['HTTP_USER_AGENT'],0,360);
	}
	else{
		$remote_agent = 'Sniffer';
	}
	// Remote Referer
	if(isset($_SERVER['HTTP_REFERER'])){
		$remote_referer = substr($_SERVER['HTTP_REFERER'],0,360);
	}
	else{
		$remote_referer = 'Direct';
	}
	// DEST URL
	if(isset($_SERVER['REQUEST_URI'])){
		$dest_url = substr($_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'],0,360);
	}
	else{
		$dest_url = 'Weird';
	}
	//exempt admins from check
	if(!function_exists('wp_get_current_user')) {
		include(ABSPATH . "wp-includes/pluggable.php"); 
	}
	// Current User
	$current_user_id = get_current_user_id();
	if(!empty($current_user_id) && $current_user_id != '0'){
		$spam_new_user = get_userdata($current_user_id);
		if(!empty($spam_new_user)){
			$spam_username = $spam_new_user->user_login;
			$blog_threat_email = $spam_new_user->user_email;
		}
		else{
			$spam_username = 'none';
			$blog_threat_email = 'none';
		}
		$spam_avatar = get_avatar( $current_user_id, 64, '', $current_user_id, array('scheme' => 'https', 'force_display' => true));
		$spamuser = array('ID' => $current_user_id, 'username' => $spam_username, 'avatar' => $spam_avatar);
	}
	else{
		$spamuser = array('ID' => 'none');
		$blog_threat_email = 'none';
	}
	$spamuserA = json_encode($spamuser, true);
	//Add Table & Load Spam Master Options
	if(is_multisite()){
		$spam_master_keys = $wpdb->get_blog_prefix($blog_id)."spam_master_keys";
		$spam_master_multisite = "YES";
		$spam_master_multisite_number = get_blog_count();
		$spam_master_multisite_joined = substr($spam_master_multisite . ' - ' . $spam_master_multisite_number,0,11);
		$blog = substr(get_blog_option($blog_id, 'blogname'),0,256);
		if(empty($blog)){
			$blog = 'Wp multi';
		}
		$admin_email = substr(get_blog_option($blog_id, 'admin_email'),0,128);
		if(empty($admin_email)){
			$admin_email = 'weird-no-email@'.date('YmdHis').'.wp';
		}
	}
	else{
		$spam_master_keys = $wpdb->prefix."spam_master_keys";
		$spam_master_multisite = "NO";
		$spam_master_multisite_number = "0";
		$spam_master_multisite_joined = substr($spam_master_multisite . ' - ' . $spam_master_multisite_number,0,11);
		$blog = substr(get_option('blogname'),0,256);
		if(empty($blog)){
			$blog = 'Wp single';
		}
		$admin_email = substr(get_option('admin_email'),0,128);
		if(empty($admin_email)){
			$admin_email = 'weird-no-email@'.date('YmdHis').'.wp';
		}
	}
	$spam_master_status = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_status'");
	$spam_master_auto_update = substr($wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_auto_update'"),0,5);
	$spam_master_db_protection_hash = substr($wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_db_protection_hash'"),0,64);
	// Get Counts.
	$spam_master_buffer_count = $wpdb->get_var("SELECT COUNT(*) FROM {$spam_master_keys} WHERE spamkey = 'Buffer'");
	if ( empty( $spam_master_buffer_count ) ) {
		$spam_master_buffer_count = '0';
	}
	$spam_master_white_count = $wpdb->get_var("SELECT COUNT(*) FROM {$spam_master_keys} WHERE spamkey = 'White'");
	if ( empty( $spam_master_white_count ) ) {
		$spam_master_white_count = '0';
	}
	$spam_master_logs_count = $wpdb->get_var("SELECT COUNT(*) FROM {$spam_master_keys}");
	if ( empty( $spam_master_logs_count ) ) {
		$spam_master_logs_count = '0';
	}
	$spam_master_cron = "AUT";
	$platform = "Wordpress";
	$spam_master_version = constant('SPAM_MASTER_VERSION');
	$spam_master_type_set = "FREE";
	$wordpress = substr(get_bloginfo('version'),0,12);
	//create lic hash
	$spam_master_lic_hash = substr(md5(uniqid(mt_rand(), true)),0,64);
	if(empty($spam_master_lic_hash)){
		$spam_master_lic_hash = 'md5-'.date('YmdHis');
	}
	$data_spam = array('spamvalue' => substr($spam_master_lic_hash,0,64));
	$where_spam = array('spamkey' => 'Option', 'spamtype' => 'spam_license_key');
	$wpdb->update( $spam_master_keys, $data_spam, $where_spam );
	$address = substr(get_site_url(),0,360);
	$data_address = array('spamvalue' => $address);
	$where_address = array('spamkey' => 'Option', 'spamtype' => 'spam_master_address');
	$wpdb->update( $spam_master_keys, $data_address, $where_address );
	@$spam_master_server_ip = substr($_SERVER['SERVER_ADDR'],0,48);
	if(empty($spam_master_server_ip) || $spam_master_server_ip == '0'){
		@$spam_master_server_ip = substr(gethostbyname($_SERVER['SERVER_NAME']),0,48);
	}
	$data_ip = array('spamvalue' => $spam_master_server_ip);
	$where_ip = array('spamkey' => 'Option', 'spamtype' => 'spam_master_ip');
	$wpdb->update( $spam_master_keys, $data_ip, $where_ip );
	@$spam_master_server_hostname = substr(gethostbyaddr($_SERVER['SERVER_ADDR']),0,256);
	if(empty($spam_master_server_hostname) || $spam_master_server_hostname == '0'){
		@$spam_master_server_hostname = substr(gethostbyname($_SERVER['SERVER_NAME']),0,256);
	}
	$spam_master_alert_level_date_set = date('Y-m-d H:i:s');
	$spam_my_nounce = 'PW9pdXNkbmVXMndzUw==';
	//remote post and response
	$spam_master_license_post = array(
										'spam_license_key' => $spam_master_lic_hash,
										'spam_trial_nounce' => $spam_my_nounce,
										'platform' => $platform,
										'platform_version' => $wordpress,
										'platform_type' => $spam_master_multisite_joined,
										'spam_master_version' => $spam_master_version,
										'spam_master_type' => $spam_master_type_set,
										'blog_name' => $blog,
										'blog_address' => $address,
										'blog_email' => $admin_email,
										'blog_hostname' => $spam_master_server_hostname,
										'blog_ip' => $spam_master_server_ip,
										'blog_up' => $spam_master_auto_update,
										'spam_master_db' => $spam_master_db_protection_hash,
										'spam_master_buffer' => $spam_master_buffer_count,
										'spam_master_white' => $spam_master_white_count,
										'spam_master_logs' => $spam_master_logs_count,
										'spam_master_cron' => $spam_master_cron
	);
	$spam_master_license_url = 'aHR0cHM6Ly93d3cuc3BhbW1hc3Rlci5vcmcvd3AtY29udGVudC9wbHVnaW5zL3NwYW0tbWFzdGVyLWFkbWluaXN0cmF0b3IvaW5jbHVkZXMvbGljZW5zZS9saWNfdHJpYWwucGhw';
	$response = wp_remote_post( base64_decode($spam_master_license_url), array(
																				'method' => 'POST',
																				'timeout' => 90,
																				'body' => $spam_master_license_post
	));
	if ( is_wp_error( $response ) ) {
		$error_message = $response->get_error_message();
		echo __('Something went wrong, please get in touch with Spam master Support: ', 'spam_master').$error_message;
	}
	else {
		$data = json_decode( wp_remote_retrieve_body( $response ), true );
		if(empty($data)){
			$data_spam1 = array('spamvalue' => 'EMPTY');
			$where_spam1 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_type');
			$wpdb->update( $spam_master_keys, $data_spam1, $where_spam1 );
			$data_spam2 = array('spamvalue' => 'INACTIVE');
			$where_spam2 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_status');
			$wpdb->update( $spam_master_keys, $data_spam2, $where_spam2 );
			$data_spam3 = array('spamvalue' => '');
			$where_spam3 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_attached');
			$wpdb->update( $spam_master_keys, $data_spam3, $where_spam3 );
			$data_spam4 = array('spamvalue' => '');
			$where_spam4 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_expires');
			$wpdb->update( $spam_master_keys, $data_spam4, $where_spam4 );
			$data_spam5 = array('spamvalue' => '0');
			$where_spam5 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_protection_total_number');
			$wpdb->update( $spam_master_keys, $data_spam5, $where_spam5 );
			$data_spam6 = array('spamvalue' => '');
			$where_spam6 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_alert_level');
			$wpdb->update( $spam_master_keys, $data_spam6, $where_spam6 );
			$data_spam7 = array('spamvalue' => '');
			$where_spam7 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_alert_level_date');
			$wpdb->update( $spam_master_keys, $data_spam7, $where_spam7 );
			$data_spam8 = array('spamvalue' => '');
			$where_spam8 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_alert_level_p_text');
			$wpdb->update( $spam_master_keys, $data_spam8, $where_spam8 );
		}
		else{
			$spam_master_status = $data['status'];
			if($spam_master_status == 'MALFUNCTION_4'){
				$data_spam1 = array('spamvalue' => 'EMPTY');
				$where_spam1 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_type');
				$wpdb->update( $spam_master_keys, $data_spam1, $where_spam1 );
				$data_spam2 = array('spamvalue' => $spam_master_status);
				$where_spam2 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_status');
				$wpdb->update( $spam_master_keys, $data_spam2, $where_spam2 );
				$data_spam3 = array('spamvalue' => '');
				$where_spam3 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_attached');
				$wpdb->update( $spam_master_keys, $data_spam3, $where_spam3 );
				$data_spam4 = array('spamvalue' => '');
				$where_spam4 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_expires');
				$wpdb->update( $spam_master_keys, $data_spam4, $where_spam4 );
				$data_spam5 = array('spamvalue' => '0');
				$where_spam5 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_protection_total_number');
				$wpdb->update( $spam_master_keys, $data_spam5, $where_spam5 );
				$data_spam6 = array('spamvalue' => '');
				$where_spam6 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_alert_level');
				$wpdb->update( $spam_master_keys, $data_spam6, $where_spam6 );
				$data_spam7 = array('spamvalue' => '');
				$where_spam7 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_alert_level_date');
				$wpdb->update( $spam_master_keys, $data_spam7, $where_spam7 );
				$data_spam8 = array('spamvalue' => '');
				$where_spam8 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_alert_level_p_text');
				$wpdb->update( $spam_master_keys, $data_spam8, $where_spam8 );
			}
			if($spam_master_status == 'VALID'){
				$data_spam1 = array('spamvalue' => $data['type']);
				$where_spam1 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_type');
				$wpdb->update( $spam_master_keys, $data_spam1, $where_spam1 );
				$data_spam2 = array('spamvalue' => $spam_master_status);
				$where_spam2 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_status');
				$wpdb->update( $spam_master_keys, $data_spam2, $where_spam2 );
				$data_spam3 = array('spamvalue' => $data['attached']);
				$where_spam3 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_attached');
				$wpdb->update( $spam_master_keys, $data_spam3, $where_spam3 );
				$data_spam4 = array('spamvalue' => $data['expires']);
				$where_spam4 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_expires');
				$wpdb->update( $spam_master_keys, $data_spam4, $where_spam4 );
				$data_spam5 = array('spamvalue' => $data['threats']);
				$where_spam5 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_protection_total_number');
				$wpdb->update( $spam_master_keys, $data_spam5, $where_spam5 );
				$data_spam6 = array('spamvalue' => $data['alert']);
				$where_spam6 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_alert_level');
				$wpdb->update( $spam_master_keys, $data_spam6, $where_spam6 );
				$data_spam7 = array('spamvalue' => $spam_master_alert_level_date_set);
				$where_spam7 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_alert_level_date');
				$wpdb->update( $spam_master_keys, $data_spam7, $where_spam7 );
				$data_spam8 = array('spamvalue' => $data['percent']);
				$where_spam8 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_alert_level_p_text');
				$wpdb->update( $spam_master_keys, $data_spam8, $where_spam8 );

				//Spam Email Controller
				////////////////////////
				$spammail = true;
				$SpamMasterEmailController = new SpamMasterEmailController;
				$is_deact = $SpamMasterEmailController->SpamMasterAutoFree( $spammail );

				//Log InUp Controller
				$spamtype = 'Key Inactive';
				$spamvalue = 'Successfully run with status: '.$data['status'];
				$cache = '4H';
				$SpamMasterLogController = new SpamMasterLogController;
				$is_log = $SpamMasterLogController->SpamMasterLog($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype, $spamvalue, $cache);

				$spama = $data['a'];
				if($spama == '1'){
					//Spam Action Controller
					////////////////////////
					$SpamMasterActionController = new SpamMasterActionController;
					$is_action = $SpamMasterActionController->SpamMasterAct($spama);
				}
?>
<div id="message" class="updated fade">
<p><?php echo __('Congratulations! Automatic Key Generated. Please wait refreshing...', 'spam_master'); ?></p>
</div>
<?php
echo '<META HTTP-EQUIV="REFRESH" CONTENT="3">';
			}
		}
	}
}
?>
<table class="wp-list-table widefat fixed striped table-view-list" cellspacing="0">
	<thead>
		<tr>
			<th colspan="3"><img src="<?php echo plugins_url('../images/spammaster-wp-plugin-internal-banner.jpg', dirname(__FILE__)); ?>" alt="<?php echo $plugin_master_name; ?>" align="left" width="100%" /></th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td class="spam-master-text-center" colspan="3">
<h2><?php echo __('Spam Master munches, feeds and grows on spam ip’s, emails, domains and words. Join one of the top 5 world-wide, real-time online spam checking databases', 'spam_master'); ?> <a href="https://www.spammaster.org" target="_blank" title="<?php echo $plugin_master_domain; ?>"><?php echo $plugin_master_domain; ?></a>.</h2>
			</td>
		</tr>
		<tr class="alternate">
			<td></td>
			<td class="spam-master-text-jcenter">
				<div>
					<div style="display: inline-block;">
						<form method="post" id="generate_free_spam_master_license" width="1">
							<fieldset class="options">
								<?php $sec_nonce = wp_nonce_field( 'save-settings_generate_free_spam_master_license' ); ?>
								<div class="spam-master-card spam-master-free-card">
									<div class="spam-master-overlay"></div>
									<div class="spam-master-circle">
										<span class="dashicons dashicons-database spam-master-admin-f70y"></span>
									</div>
									<p><?php echo __('Free Server Cluster', 'spam_master'); ?></p>
									<p><?php echo __('Free RBL Server Connection', 'spam_master'); ?></p>
									<p><?php echo __('Auto Generates Key', 'spam_master'); ?></p>
									<p><span class="dashicons dashicons-admin-post"></span> <?php echo __('Full Functionality', 'spam_master'); ?></p>
									<p><button type="submit" name="generate_free_spam_master_license" id="generate_free_spam_master_license" href="#" class="btn-spammaster orange roundedspam"><?php echo __('Generate Key', 'spam_master'); ?></button></p>
								</div>
							</fieldset>
						</form>
					</div>
					<div style="display: inline-block;">
						<div class="spam-master-card spam-master-pro-card">
							<div class="spam-master-overlay"></div>
							<div class="spam-master-circle">
								<span class="dashicons dashicons-database-add spam-master-admin-f70g"></span>
							</div>
							<p><?php echo __('Business Server Cluster', 'spam_master'); ?></p>
							<p><?php echo __('Premium RBL Server Connection', 'spam_master'); ?></p>
							<p><?php echo __('24/7 Support', 'spam_master'); ?></p>
							<p><span class="dashicons dashicons-admin-post"></span> <?php echo __('Full Functionality', 'spam_master'); ?></p>
							<p><a href="https://www.techgasp.com/downloads/spam-master-license/" target="_blank" class="btn-spammaster green roundedspam"><?php echo __('Buy Pro Key', 'spam_master'); ?></a></p>
						</div>
					</div>
				</div>
			</td>
			<td></td>
		</tr>
	</tbody>
</table>
<div class="spam-master-pad-table"></div>
<?php
		}
}
