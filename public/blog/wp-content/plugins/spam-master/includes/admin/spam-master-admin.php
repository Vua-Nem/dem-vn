<?php
/**
 * Settings menu.
 */
function spam_master_settings_menu() {
	return add_options_page(
		__( 'Spam Master', 'spam_master' ),
		__( 'Spam Master', 'spam_master' ),
		'manage_options',
		'spam-master.php',
		'spam_master_admin'
	);
}

// Hook Menu.
if( is_multisite() ) {
	add_action( 'admin_menu', 'spam_master_settings_menu' );
}
else {
	add_action( 'admin_menu', 'spam_master_settings_menu' );
}

/**
 * Settings menu display.
 */
function spam_master_admin(){
global $wpdb, $blog_id;

$plugin_master_name = constant('SPAM_MASTER_NAME');
$plugin_master_domain = constant('SPAM_MASTER_DOMAIN');

//Add Table & Load Spam Master Options
if(is_multisite()){
	$spam_master_keys = $wpdb->get_blog_prefix($blog_id)."spam_master_keys";
}
else{
	$spam_master_keys = $wpdb->prefix."spam_master_keys";
}
$spam_master_status = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_status'");
?>
<div class="wrap">
	<h1 class="spam-master-hidden"></h1>
<?php
$SpamMasterInvitationController = new SpamMasterInvitationController;
$is_invited = $SpamMasterInvitationController->SpamMasterInvitation();
echo $is_invited;

if(!class_exists('spam_master_menu_table')){
	require_once( WP_PLUGIN_DIR . '/spam-master/includes/admin/spam-master-admin-menu-table.php');
}
//Prepare Table of elements
$wp_list_table = new spam_master_menu_table();
//Table of elements
$wp_list_table->display();


if($spam_master_status == 'INACTIVE'){
	if(!class_exists('spam_master_admin_table_inactive')){
		require_once( WP_PLUGIN_DIR . '/spam-master/includes/admin/spam-master-admin-table-inactive.php');
	}
	//Prepare Table of elements
	$wp_list_table = new spam_master_admin_table_inactive();
	//Table of elements
	$wp_list_table->display();

}

//Load Status Table
require_once( WP_PLUGIN_DIR . '/spam-master/includes/admin/spam-master-admin-status-table.php');

if($spam_master_status != 'INACTIVE'){
//Load Online Firewall & Stats Table
require_once( WP_PLUGIN_DIR . '/spam-master/includes/admin/spam-master-admin-online-table.php');
}

//Footer
require_once( WP_PLUGIN_DIR . '/spam-master/includes/admin/spam-master-admin-footer.php');
?>
</div>
<?php
}
