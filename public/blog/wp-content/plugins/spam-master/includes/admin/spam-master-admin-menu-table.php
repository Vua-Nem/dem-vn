<?php
if(!class_exists('WP_List_Table')){
	require_once( get_home_path() . 'wp-admin/includes/class-wp-list-table.php' );
}
class spam_master_menu_table extends WP_List_Table {

function display(){
global $wpdb, $blog_id;

//Add Table & Load Spam Master Options
if(is_multisite()){
	$spam_master_keys = $wpdb->get_blog_prefix($blog_id)."spam_master_keys";
}
else{
	$spam_master_keys = $wpdb->prefix."spam_master_keys";
}
$spam_master_status = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_status'");
$spam_master_block_count = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_block_count'");
$spam_master_buffer = $wpdb->get_var("SELECT COUNT(*) FROM {$spam_master_keys}");
$spam_master_protection_total_number = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_protection_total_number'");

//Get Menu
if(isset($_GET['m'])){
	$selected_menu = $_GET['m'];
}
else{
	$selected_menu = '';
}
//prepare Menus
if($selected_menu == 'settings'){
	$selected_menu_bold_sett = '<strong>'.__('Settings', 'spam_master').'</strong>';
	$selected_active_sett = 'active';
}
else{
	$selected_menu_bold_sett = __('Settings', 'spam_master');
	$selected_active_sett = false;
}

//Prepare Settings bubble
$spam_master_about_bubble = false;
if(empty($spam_master_status) || $spam_master_status == 'EMPTY'){
	$spam_master_settings_bubble = '<span class="spam-master-top-admin-bar-bubble spam-master-top-admin-yellow" title="Please click Generate Key."><span>1</span></span>';
}
if(empty($spam_master_status) || $spam_master_status == 'INACTIVE'){
	$spam_master_settings_bubble = '<span class="spam-master-top-admin-bar-bubble spam-master-top-admin-yellow" title="Please click Generate Key."><span>1</span></span>';
}
if($spam_master_status == 'VALID'){
	$spam_master_settings_bubble = '<span class="spam-master-top-admin-bar-bubble spam-master-top-admin-green" title="Congratulations, your connection is Optimal and your website is protected against millions of threats."><span>0</span></span>';
}
if($spam_master_status == 'MALFUNCTION_1'){
	$spam_master_settings_bubble = '<span class="spam-master-top-admin-bar-bubble spam-master-top-admin-orange" title="Please update Spam Master to the latest version."><span>1</span></span>';
}
if($spam_master_status == 'MALFUNCTION_2'){
	$spam_master_settings_bubble = '<span class="spam-master-top-admin-bar-bubble spam-master-top-admin-orange" title="Your key is being used in several websites. Please use 1 key per website. Go online to get more keys."><span>1</span></span>';
}
if($spam_master_status == 'MALFUNCTION_3'){
	$spam_master_settings_bubble = '<span class="spam-master-top-admin-bar-bubble" title="Malfunction 3 detected. Please get in touch with Spam Master support."><span>1</span></span>';
}
if($spam_master_status == 'MALFUNCTION_4'){
	$spam_master_settings_bubble = '<span class="spam-master-top-admin-bar-bubble spam-master-top-admin-orangina" title="Spam Master was not able to generate a connection key. Not to worry, get a free connection key at www.spammaster.org."><span>1</span></span>';
}
if($spam_master_status == 'MALFUNCTION_5'){
	$spam_master_settings_bubble = '<span class="spam-master-top-admin-bar-bubble spam-master-top-admin-orangina" title="Spam Master was not able to generate a connection key because the daily limit of free keys was exceeded. Please try again tomorrow or get pro key."><span>1</span></span>';
}
if($spam_master_status == 'MALFUNCTION_6'){
	$spam_master_settings_bubble = '<span class="spam-master-top-admin-bar-bubble spam-master-top-admin-orangina" title="This Key is assign to another website please go to spammaster.org to verify your keys and or add a new key."><span>1</span></span>';
}
if($spam_master_status == 'DISCONNECTED'){
	$spam_master_settings_bubble = '<span class="spam-master-top-admin-bar-bubble"><span>1</span></span>';
}
if($spam_master_status == 'EXPIRED'){
	$spam_master_settings_bubble = '<span class="spam-master-top-admin-bar-bubble" title="Your key is expired, please renew or get a new key at www.spammaster.org."><span>1</span></span>';
}
if($spam_master_status == 'UNSTABLE'){
	$spam_master_settings_bubble = '<span class="spam-master-top-admin-bar-bubble" title="Spam Master free service is unstable, we apologize for that. Please check the RBL service status at www.spammaster.org."><span>1</span></span>';
}

if($spam_master_status == 'VALID' || $spam_master_status == 'MALFUNCTION_1' || $spam_master_status == 'MALFUNCTION_2'){
?>
<table class="wp-list-table widefat fixed striped table-view-list" cellspacing="0">
	<thead>
		<tr>
			<th></th>
		</tr>
	</thead>

	<tfoot>
		<tr>
			<th></th>
		</tr>
	</tfoot>

	<tbody>
		<tr class="spam-master-menu-table-bk">
			<td>
				<div class="spam-master-menu-table spam-master-center">
					<p><span class="dashicons dashicons-heart spam-master-admin-f48 spam-master-admin-red spam-master-middle"></span> <span class="spam-master-middle"><?php echo __('Spam Master real-time scans firewall is ', 'spam_master'); ?> <strong><?php echo __('On, ', 'spam_master'); ?></strong> <?php echo __('you are protected against ', 'spam_master'); ?><strong><?php echo number_format( $spam_master_protection_total_number ); ?></strong> <?php echo __(' million threats.', 'spam_master'); ?><span class="dashicons dashicons-shield spam-master-admin-f48 spam-master-admin-green spam-master-middle"></span> <?php echo __('Spam Master buffer contains ', 'spam_master'); ?> <strong><?php echo number_format($spam_master_buffer); ?></strong> <?php echo __('entries.', 'spam_master'); ?></span></p>
				</div>
			</td>
		</tr>
		<tr class="spam-master-menu-table-bk">
			<td>
				<div class="spam-master-menu-table">
					<?php echo __('Protected:', 'spam_master'); ?> 
					<span class="dashicons dashicons-yes-alt spam-master-admin-green" title="Spam Master Info"></span> <?php echo __('Registration Forms', 'spam_master'); ?> 
					<span class="dashicons dashicons-yes-alt spam-master-admin-green" title="Spam Master Info"></span> <?php echo __('Login Forms', 'spam_master'); ?> 
					<span class="dashicons dashicons-yes-alt spam-master-admin-green" title="Spam Master Info"></span> <?php echo __('Comment Forms', 'spam_master'); ?> 
					<span class="dashicons dashicons-yes-alt spam-master-admin-green" title="Spam Master Info"></span> <?php echo __('Contact Forms', 'spam_master'); ?>.
				</div>
			</td>
		</tr>
	</tbody>
</table>

<div class="spam-master-pad-table"></div>

<?php
		}
	}
}
?>
