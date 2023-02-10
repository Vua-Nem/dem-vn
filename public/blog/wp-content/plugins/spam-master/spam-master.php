<?php
/**
Plugin Name: Spam Master
Plugin URI: https://www.spammaster.org
Version: 6.7.4
Author: TechGasp
Author URI: https://www.techgasp.com
Text Domain: spam-master
Description: Spam Master is the Ultimate Spam Protection plugin that blocks new user registrations and post comments with Real Time anti-spam lists.
License: GPL2 or later
*/
/*  Copyright 2013 TechGasp  (email : info@techgasp.com)
	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as 
	published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
if(!class_exists('spam_master')) :
///////DEFINE///////
define( 'SPAM_MASTER_VERSION', '6.7.4' );
define( 'SPAM_MASTER_NAME', 'Spam Master' );
define( 'SPAM_MASTER_DOMAIN', 'SpamMaster.org' );

class spam_master {
	public static function content_with_quote($content){
		$quote = '<p>' . get_option('tsm_quote') . '</p>';
		return $content . $quote;
	}
	//SETTINGS LINK IN PLUGIN MANAGER
	public static function spam_master_links( $links, $file ) {
		if ( $file == plugin_basename( dirname(__FILE__).'/spam-master.php' ) ) {
			if( is_network_admin() ){
				$techgasp_plugin_url = network_admin_url( 'options-general.php?page=spam-master' );
			}
			else {
				$techgasp_plugin_url = admin_url( 'options-general.php?page=spam-master' );
			}
		$links[] = '<a href="' . $techgasp_plugin_url . '">'.__( 'Settings', 'spam_master' ).'</a>';
		}
		return $links;
	}
//END CLASS
}
add_filter('the_content', array('spam_master', 'content_with_quote'));
add_filter('plugin_action_links', array('spam_master', 'spam_master_links'), 10, 2);
endif;

//First time installs add settings wide options
global $wpdb, $blog_id;

//HOOK classes.
require_once( WP_PLUGIN_DIR . '/spam-master/includes/controllers/spam-master-classes.php');

if( is_multisite() ){
//Load Signup Styles
add_action('signup_extra_fields', 'spam_master_css');
}
else{
//Load Login Styles
add_action('login_enqueue_scripts', 'spam_master_css');
}

//Load Admin Admin Pages Styles
add_action( 'admin_enqueue_scripts', 'spam_master_css' );
add_action('wp_enqueue_scripts', 'spam_master_css' );
function spam_master_css(){
	$spam_master_version = constant('SPAM_MASTER_VERSION');
	wp_register_style( 'spam_master', plugins_url('css/spam-master.css',  __FILE__), array(), $spam_master_version );
	wp_enqueue_style( 'spam_master' );
}
//END CSS

//////DATABASE VERSION//////
global $spam_master_keys_db_version;
$spam_master_keys_db_version = "2.4";
////////////////////////////
////////DATABASE HOOKS//////
////////////////////////////
function spam_master_keys_db_table(){
global $wpdb, $blog_id, $spam_master_keys_db_version;
	if( is_multisite() ){
		$blogs = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs;" );
		foreach ( $blogs as $id ) {
			$techgasp_keys_db_installed_ver = get_blog_option($id, 'spam_master_keys_db_version');
			if($techgasp_keys_db_installed_ver != $spam_master_keys_db_version){
				$table_name = $wpdb->get_blog_prefix($id)."spam_master_keys";
				$charset_collate = $wpdb->get_charset_collate();
				$sql = "CREATE TABLE $table_name (
						id INT NOT NULL AUTO_INCREMENT,
						time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
						spamkey VARCHAR( 64 ) NOT NULL,
						spamtype LONGTEXT NOT NULL,
						spamy LONGTEXT NOT NULL,
						spamvalue LONGTEXT NOT NULL,
						PRIMARY KEY (id)
						) $charset_collate; ";
				require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
				dbDelta($sql);
				update_blog_option($id, 'spam_master_keys_db_version', $spam_master_keys_db_version );
			}
		}
	}
	else{
		$techgasp_keys_db_installed_ver = get_option( 'spam_master_keys_db_version' );
		if($techgasp_keys_db_installed_ver != $spam_master_keys_db_version){
			$table_name = $wpdb->prefix."spam_master_keys";
			$charset_collate = $wpdb->get_charset_collate();
				$sql = "CREATE TABLE $table_name (
						id INT NOT NULL AUTO_INCREMENT,
						time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
						spamkey VARCHAR( 64 ) NOT NULL,
						spamtype LONGTEXT NOT NULL,
						spamy LONGTEXT NOT NULL,
						spamvalue LONGTEXT NOT NULL,
						PRIMARY KEY (id)
						) $charset_collate; ";
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
			update_option( 'spam_master_keys_db_version' , $spam_master_keys_db_version );
		}
	}
}
register_activation_hook( __FILE__, 'spam_master_keys_db_table' );

///////////////////////////////
/// UPGRADE ACTIVATION TO * ///
///////////////////////////////
function spam_master_activate_upgrade() {
	global $wpdb, $spam_master_keys_db_version;
	
	if( is_multisite() ) {
		$blogs = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs;" );
		foreach ( $blogs as $id ) {
			$spam_master_keys_db_installed_ver = get_blog_option( $id, 'spam_master_keys_db_version' );

			$spam_master_upgrade_to_6 = get_blog_option( $id, 'spam_master_upgrade_to_6');
			$spam_master_upgrade_to_6_6_0 = get_blog_option( $id, 'spam_master_upgrade_to_6_6_0' );
			$spam_master_upgrade_to_6_6_1 = get_blog_option( $id, 'spam_master_upgrade_to_6_6_1' );
			$spam_master_upgrade_to_6_6_2 = get_blog_option( $id, 'spam_master_upgrade_to_6_6_2' );
			$spam_master_upgrade_to_6_6_3 = get_blog_option( $id, 'spam_master_upgrade_to_6_6_3' );
			$spam_master_upgrade_to_6_6_5 = get_blog_option( $id, 'spam_master_upgrade_to_6_6_5' );
			$spam_master_upgrade_to_6_6_6 = get_blog_option( $id, 'spam_master_upgrade_to_6_6_6' );
			$spam_master_upgrade_to_6_6_19 = get_blog_option( $id, 'spam_master_upgrade_to_6_6_19' );
			$spam_master_upgrade_to_6_7_0 = get_blog_option( $id, 'spam_master_upgrade_to_6_7_0' );
			$spam_master_upgrade_to_6_7_2 = get_blog_option( $id, 'spam_master_upgrade_to_6_7_2' );

			$spam_master_connection = get_blog_option( $id, 'spam_master_connection' );
		}
	}
	else{
		$spam_master_keys_db_installed_ver = get_option( 'spam_master_keys_db_version' );

		$spam_master_upgrade_to_6 = get_option( 'spam_master_upgrade_to_6');
		$spam_master_upgrade_to_6_6_0 = get_option( 'spam_master_upgrade_to_6_6_0' );
		$spam_master_upgrade_to_6_6_1 = get_option( 'spam_master_upgrade_to_6_6_1' );
		$spam_master_upgrade_to_6_6_2 = get_option( 'spam_master_upgrade_to_6_6_2' );
		$spam_master_upgrade_to_6_6_3 = get_option( 'spam_master_upgrade_to_6_6_3' );
		$spam_master_upgrade_to_6_6_5 = get_option( 'spam_master_upgrade_to_6_6_5' );
		$spam_master_upgrade_to_6_6_6 = get_option( 'spam_master_upgrade_to_6_6_6' );
		$spam_master_upgrade_to_6_6_19 = get_option( 'spam_master_upgrade_to_6_6_19' );
		$spam_master_upgrade_to_6_7_0 = get_option( 'spam_master_upgrade_to_6_7_0' );
		$spam_master_upgrade_to_6_7_2 = get_option( 'spam_master_upgrade_to_6_7_2' );

		$spam_master_connection = get_option( 'spam_master_connection' );
	}
	//Databases
	if ( $spam_master_keys_db_installed_ver != $spam_master_keys_db_version ) {
		spam_master_keys_db_table();
	}
	//File to upgrade legacy versions inferior to 6
	if( $spam_master_upgrade_to_6 != '1' ) {
		require_once( WP_PLUGIN_DIR . '/spam-master/includes/admin/spam-master-admin-upgrade-to-6.php' );
	}
	//Files to upgrade to current latest stable
	if( $spam_master_upgrade_to_6_6_0 != '1' && $spam_master_keys_db_installed_ver == '2.4' ) {
		require_once( WP_PLUGIN_DIR . '/spam-master/includes/admin/spam-master-admin-upgrade-to-6-6-0.php' );
	}
	if( $spam_master_upgrade_to_6_6_1 != '1' && $spam_master_keys_db_installed_ver == '2.4' ) {
		require_once( WP_PLUGIN_DIR . '/spam-master/includes/admin/spam-master-admin-upgrade-to-6-6-1.php' );
	}
	if( $spam_master_upgrade_to_6_6_2 != '1' && $spam_master_keys_db_installed_ver == '2.4' ) {
		require_once( WP_PLUGIN_DIR . '/spam-master/includes/admin/spam-master-admin-upgrade-to-6-6-2.php' );
	}
	if( $spam_master_upgrade_to_6_6_3 != '1' && $spam_master_keys_db_installed_ver == '2.4' ) {
		require_once( WP_PLUGIN_DIR . '/spam-master/includes/admin/spam-master-admin-upgrade-to-6-6-3.php' );
	}
	if( $spam_master_upgrade_to_6_6_5 != '1' && $spam_master_keys_db_installed_ver == '2.4' ) {
		require_once( WP_PLUGIN_DIR . '/spam-master/includes/admin/spam-master-admin-upgrade-to-6-6-5.php' );
	}
	if( $spam_master_upgrade_to_6_6_6 != '1' && $spam_master_keys_db_installed_ver == '2.4' ) {
		require_once( WP_PLUGIN_DIR . '/spam-master/includes/admin/spam-master-admin-upgrade-to-6-6-6.php' );
	}
	if( $spam_master_upgrade_to_6_6_19 != '1' && $spam_master_keys_db_installed_ver == '2.4' ) {
		require_once( WP_PLUGIN_DIR . '/spam-master/includes/admin/spam-master-admin-upgrade-to-6-6-19.php' );
	}
	if( $spam_master_upgrade_to_6_7_0 != '1' && $spam_master_keys_db_installed_ver == '2.4' ) {
		require_once( WP_PLUGIN_DIR . '/spam-master/includes/admin/spam-master-admin-upgrade-to-6-7-0.php' );
	}
	if( $spam_master_upgrade_to_6_7_2 != '1' && $spam_master_keys_db_installed_ver == '2.4' ) {
		require_once( WP_PLUGIN_DIR . '/spam-master/includes/admin/spam-master-admin-upgrade-to-6-7-2.php' );
	}

	// HOOK CONNECTION
	if( is_multisite() ){
	}
	else{
		if( !isset( $spam_master_connection ) || empty( $spam_master_connection ) && $spam_master_keys_db_installed_ver == '2.4' ) {
			require_once( WP_PLUGIN_DIR . '/spam-master/includes/admin/spam-master-admin-connection-sender.php' );
		}
	}
}
add_action( 'plugins_loaded', 'spam_master_activate_upgrade' );

// HOOK ADMIN & SETTINGS
require_once( WP_PLUGIN_DIR . '/spam-master/includes/admin/spam-master-admin.php');

//Add Table & Load Spam Master Options
if(is_multisite()){
	$spam_master_keys_db_installed_ver = get_blog_option($blog_id, 'spam_master_keys_db_version');
	$spam_master_keys = $wpdb->get_blog_prefix($blog_id)."spam_master_keys";
}
else{
	$spam_master_keys_db_installed_ver = get_option('spam_master_keys_db_version');
	$spam_master_keys = $wpdb->prefix."spam_master_keys";
}
//IS DB UP-TO-DATE
if ($spam_master_keys_db_installed_ver == $spam_master_keys_db_version) {
$spam_master_status = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_status'");
$spam_master_type = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_type'");
$spam_master_honeypot_timetrap = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_honeypot_timetrap'");
$spam_master_widget_heads_up = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_widget_heads_up'");
$spam_master_widget_statistics = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_widget_statistics'");
$spam_master_widget_firewall = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_widget_firewall'");
$spam_master_widget_dashboard_status = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_widget_dashboard_status'");
$spam_master_widget_dashboard_statistics = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_widget_dashboard_statistics'");
$spam_master_shortcodes_total_count = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_shortcodes_total_count'");
$spam_master_integrations_contact_form_7 = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_integrations_contact_form_7'");
$spam_master_integrations_woocommerce = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_integrations_woocommerce'");
$spam_master_widget_top_menu_firewall = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_widget_top_menu_firewall'");
$spam_master_auto_update = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_auto_update'");
$spam_master_expires = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_expires'");
$spam_master_emails_weekly_email = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_emails_weekly_email'");
$spam_master_trial_expired_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_trial_expired_date'");
$spam_master_trial_expired_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_trial_expired_notice'");
$spam_master_free_expired_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_free_expired_date'");
$spam_master_free_expired_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_free_expired_notice'");
$spam_master_full_expired_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_full_expired_date'");
$spam_master_full_expired_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_full_expired_notice'");
$spam_master_free_rate_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_free_rate_notice'");
$spam_master_full_install_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_full_install_notice'");
$spam_master_free_unstable_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_free_unstable_date'");
$spam_master_free_unstable_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_free_unstable_notice'");
$spam_master_full_inactive_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_full_inactive_date'");
$spam_master_full_inactive_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_full_inactive_notice'");
$spam_master_malfunction_1_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_malfunction_1_date'");
$spam_master_malfunction_1_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_malfunction_1_notice'");
$spam_master_malfunction_2_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_malfunction_2_date'");
$spam_master_malfunction_2_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_malfunction_2_notice'");
$spam_master_malfunction_6_date = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_malfunction_6_date'");
$spam_master_malfunction_6_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_malfunction_6_notice'");

//HOOK LEARNING FIREWALL
require_once( WP_PLUGIN_DIR . '/spam-master/includes/protection/spam-master-firewall.php');
//HOOK LEARNING HONEY
if($spam_master_honeypot_timetrap == 'true'){
require_once( WP_PLUGIN_DIR . '/spam-master/includes/protection/spam-master-honeypot.php');
}
//HOOK LEARNING REG
require_once( WP_PLUGIN_DIR . '/spam-master/includes/protection/spam-master-registration.php');
//HOOK LEARNING COM
require_once( WP_PLUGIN_DIR . '/spam-master/includes/protection/spam-master-comment.php');
//HOOK LEARNING ACTION
require_once( WP_PLUGIN_DIR . '/spam-master/includes/protection/spam-master-action.php');
//HOOK SIGNATURES
require_once( WP_PLUGIN_DIR . '/spam-master/includes/protection/spam-master-signatures.php');
// HOOK WIDGETS & SHORTCODES wp-options dependent pages
if($spam_master_widget_heads_up == 'true'){
}
if($spam_master_widget_statistics == 'true'){
}
if($spam_master_widget_firewall == 'true'){
}
if($spam_master_widget_dashboard_status == 'true'){
}
if($spam_master_widget_dashboard_statistics == 'true'){
}
if($spam_master_shortcodes_total_count == 'true'){
	require_once( WP_PLUGIN_DIR . '/spam-master/includes/protection/spam-master-shortcodes.php');
}
if($spam_master_integrations_contact_form_7 == 'true'){
	require_once( WP_PLUGIN_DIR . '/spam-master/includes/protection/spam-master-contact-form-7.php');
}
if($spam_master_integrations_woocommerce == 'true'){
	require_once( WP_PLUGIN_DIR . '/spam-master/includes/protection/spam-master-woocommerce-sig.php');
	require_once( WP_PLUGIN_DIR . '/spam-master/includes/protection/spam-master-woocommerce-reg.php');
}
require_once( WP_PLUGIN_DIR . '/spam-master/includes/protection/spam-master-widget-top-menu-firewall.php');
if($spam_master_auto_update == 'true'){
	require_once( WP_PLUGIN_DIR . '/spam-master/includes/protection/spam-master-auto-update.php');
}

add_action('admin_notices', 'spam_master_admin_notices');
function spam_master_admin_notices() {
global $wpdb, $blog_id;

	//Add Table & Load Spam Master Options
	if(is_multisite()){
		$spam_master_keys = $wpdb->get_blog_prefix($blog_id)."spam_master_keys";
		$admin_email = get_blog_option($blog_id, 'admin_email');
	}
	else{
		$spam_master_keys = $wpdb->prefix."spam_master_keys";
		$admin_email = get_option('admin_email');
	}
	$spam_master_status = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_status'");
	$spam_master_type = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_type'");
	$spam_master_invitation_full_wide_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_invitation_full_wide_notice'");
	$spam_master_invitation_free_wide_notice = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_invitation_free_wide_notice'");
	$spam_master_expires = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_expires'");
	$spam_master_attached = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_attached'");

	$spam_master_current_date = current_time('Y-m-d');
	$spam_master_invitation_notice_plus_7 = date('Y-m-d', strtotime('+7 days', strtotime($spam_master_expires)) );
	$spam_master_invitation_notice_minus_333 = date('Y-m-d', strtotime('-333 days', strtotime($spam_master_expires)) );
	//Courtesy Link
	if(empty($spam_master_type) || $spam_master_type == 'EMPTY'){
		add_filter('admin_footer_text', 'spam_master_footer_empty_admin');
		function spam_master_footer_empty_admin($default){
			$screen = get_current_screen();
			if(in_array($screen->id, array( 'settings_page_spam-master'))){
				echo '<span id="footer-thankyou">'.__('Thank you for using', 'spam_master').' <a class="spam-master-admin-link-decor" href="https://www.spammaster.org" title="'.__('Spam Master', 'spam_master').'" target="_blank">'.__('Spam Master', 'spam_master').'</a>. '.__('Click Generate Connection Key to automatically start your protection', 'spam_master').'.</span>';
			}
		}
	}
	if($spam_master_status == 'VALID'){
		add_filter('admin_footer_text', 'spam_master_footer_courtesy');
		function spam_master_footer_courtesy($default){
			$screen = get_current_screen();
			if(in_array($screen->id, array( 'settings_page_spam-master'))){
				echo '<span id="footer-thankyou">'.__('Please Rate', 'spam_master').' <strong>'.__('Spam Master', 'spam_master').'</strong> <a class="spam-master-admin-link-decor" href="https://www.wordpress.org/plugins/spam-master/" title="'.__('Rate Us on Wordpress.org', 'spam_master').'" target="_blank"><span class="dashicons dashicons-star-filled spam-master-top-admin-f-yellow spam-master-top-admin-shadow-orangina"></span><span class="dashicons dashicons-star-filled spam-master-top-admin-f-yellow spam-master-top-admin-shadow-orangina"></span><span class="dashicons dashicons-star-filled spam-master-top-admin-f-yellow spam-master-top-admin-shadow-orangina"></span><span class="dashicons dashicons-star-filled spam-master-top-admin-f-yellow spam-master-top-admin-shadow-orangina"></span><span class="dashicons dashicons-star-filled spam-master-top-admin-f-yellow spam-master-top-admin-shadow-orangina"></span></a> '.__('on', 'spam_master').' <a class="spam-master-admin-link-decor" href="https://www.wordpress.org/plugins/spam-master/" title="'.__('Rate Us on Wordpress.org', 'spam_master').'" target="_blank"><strong>'.__('Wordpress.org', 'spam_master').'</strong></a> '.__('to help us spread the word', 'spam_master').'.</span>';
			}
		}
	}

	//STATUS VALID
	if ($spam_master_status == 'VALID'){
		$spam_master_screen = get_current_screen();
		if( $spam_master_screen->id != 'settings_page_spam-master' ){
			$path = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
			$current_url = wp_nonce_url($path, 'save-spam_master_dismissal');
			if($spam_master_type == 'TRIAL' || $spam_master_type == 'FREE'){
				if($spam_master_current_date >= $spam_master_invitation_notice_plus_7 && $spam_master_invitation_free_wide_notice != '1'){
					?>
					<div class="notice notice-success">
					<p><span class="dashicons dashicons-admin-post"></span> <?php echo __('Thank you for using Spam Master Free for some time now. We humbly ask you to take a few minutes to let us know what you think and rate us ', 'spam_master').' <a class="spam-master-admin-link-decor" href="https://wordpress.org/plugins/spam-master/" title="'.__('Let us know what you think, we value your input.', 'spam_master').'" target="_blank"><span class="dashicons dashicons-star-filled spam-master-top-admin-f-yellow spam-master-top-admin-shadow-orangina"></span><span class="dashicons dashicons-star-filled spam-master-top-admin-f-yellow spam-master-top-admin-shadow-orangina"></span><span class="dashicons dashicons-star-filled spam-master-top-admin-f-yellow spam-master-top-admin-shadow-orangina"></span><span class="dashicons dashicons-star-filled spam-master-top-admin-f-yellow spam-master-top-admin-shadow-orangina"></span><span class="dashicons dashicons-star-filled spam-master-top-admin-f-yellow spam-master-top-admin-shadow-orangina"></span> '.__('wordpress.org', 'spam_master').'</a>.'; ?> <?php echo '<a class="spam-master-admin-link-decor" href="'.$current_url.'&spammasterdisfrwide=1"><span class="dashicons dashicons-dismiss spam-master-top-admin-f-red spam-master-top-admin-shadow-orange spam-master-admin-float-r" title="'.__('Dismiss', 'spam_master').'"></span></a>'; ?></p>
					</div>
					<?php
				}
			}
			if($spam_master_type == 'FULL'){
				if($spam_master_current_date >= $spam_master_invitation_notice_minus_333 && $spam_master_invitation_full_wide_notice != '1'){
					?>
					<div class="notice notice-success">
					<p><span class="dashicons dashicons-admin-post"></span> <?php echo __('Thank you for using Spam Master Pro for some time now. If you haven\'t done so, we humbly ask you to take a few minutes to let us know what you think and rate us ', 'spam_master').' <a class="spam-master-admin-link-decor" href="https://wordpress.org/plugins/spam-master/" title="'.__('Let us know what you think, we value your input.', 'spam_master').'" target="_blank"><span class="dashicons dashicons-star-filled spam-master-top-admin-f-yellow spam-master-top-admin-shadow-orangina"></span><span class="dashicons dashicons-star-filled spam-master-top-admin-f-yellow spam-master-top-admin-shadow-orangina"></span><span class="dashicons dashicons-star-filled spam-master-top-admin-f-yellow spam-master-top-admin-shadow-orangina"></span><span class="dashicons dashicons-star-filled spam-master-top-admin-f-yellow spam-master-top-admin-shadow-orangina"></span><span class="dashicons dashicons-star-filled spam-master-top-admin-f-yellow spam-master-top-admin-shadow-orangina"></span> '.__('wordpress.org', 'spam_master').'</a>.'; ?> <?php echo '<a class="spam-master-admin-link-decor" href="'.$current_url.'&spammasterdisfuwide=1"><span class="dashicons dashicons-dismiss spam-master-top-admin-f-red spam-master-top-admin-shadow-orange spam-master-admin-float-r" title="'.__('Dismiss', 'spam_master').'"></span></a>'; ?></p>
					</div>
					<?php
				}
			}
		}
	}
	//STATUS UNSTABLE
	if ($spam_master_status == 'UNSTABLE'){
		?>
		<div class="notice notice-warning is-dismissible">
		<p><strong><?php echo __('Spam Master Free RBL Server connection is Unstable.', 'spam_master'); ?></strong>. <?php echo __('We apologize for that, there\'s probably a high demand of spam checks in our free servers at this point, please check the RBL server status', 'spam_master'); ?> <a class="spam-master-admin-link-decor" href="https://www.spammaster.org" title="<?php echo __('Free Server Cluster Status', 'spam_master'); ?>" target="_blank"><strong><em><?php echo __('here', 'spam_master'); ?></strong></em></a>. <?php echo __('If you want to avoid these issues in the future you might want to consider a', 'spam_master'); ?> <a class="spam-master-admin-link-decor" href="https://www.techgasp.com/downloads/spam-master-license/" title="<?php echo __('Pro Connection Key', 'spam_master'); ?>" target="_blank"><span class="dashicons dashicons-database-add spam-master-top-admin-f-green"></span> <strong><em><?php echo __('Pro Connection Key', 'spam_master'); ?></strong></em></a>... <?php echo __('It costs peanuts', 'spam_master'); ?>.</p>
		</div>
		<?php
	}
	//STATUS MALFUNCTION_1
	if ($spam_master_status == 'MALFUNCTION_1'){
		?>
		<div class="notice notice-warning is-dismissible">
		<p><strong><?php echo __('Spam Master Malfunction 1. Please Update Spam Master', 'spam_master'); ?></strong>. <?php echo __('Your Key is Valid and your Protection is Active & Online, not to worry. Please update, upgrade Spam Master to the latest available version in your plugins administrator page. Once Spam Master is up-to-date press RE-SYNCHRONIZE CONNECTION button in Spam Master', 'spam_master'); ?> <a class="spam-master-admin-link-decor" href="<?php echo admin_url('options-general.php?page=spam-master'); ?>" title="<?php echo __('Settings', 'spam_master'); ?>"><strong><em><?php echo __('Settings', 'spam_master'); ?></strong></em></a>.</p>
		</div>
		<?php
	}
	//STATUS MALFUNCTION_2
	if ($spam_master_status == 'MALFUNCTION_2'){
		?>
		<div class="notice notice-warning is-dismissible">
		<p><strong><?php echo __('Spam Master Malfunction 2!!!', 'spam_master'); ?></strong>. <?php echo __('You are still protected but you are using the same license key in more than one website. Your Connection Key might get UNSTABLE or with a MALFUNCTION that will affect all websites. Go to', 'spam_master'); ?> <a class="spam-master-admin-link-decor" href="https://www.spammaster.org" title="<?php echo __('www.spammaster.org', 'spam_master'); ?>" target="_blank"><strong><em><?php echo __('www.spammaster.org', 'spam_master'); ?></strong></em></a> <?php echo __('register or login with', 'spam_master'); ?> <strong><?php echo $spam_master_attached; ?></strong>, <?php echo __('go to the licenses page and detach all websites using this key except for one, create more unique keys to be used by other websites. One key per website.', 'spam_master'); ?>.</p>
		</div>
		<?php
	}
	//STATUS MALFUNCTION_3
	if ($spam_master_status == 'MALFUNCTION_3'){
		?>
		<div class="notice notice-error is-dismissible">
		<p><strong><?php echo __('Spam Master Malfunction 3', 'spam_master'); ?></strong> <?php echo __('Warning!!! Your Key is', 'spam_master'); ?> <strong><em><?php echo __('INACTIVE & OFFLINE', 'spam_master'); ?></em></strong>, <?php echo __('Malfunction 3 was detected. More about malfunction 3', 'spam_master'); ?> <a class="spam-master-admin-link-decor" href="https://www.spammaster.org/documentation/" target="_blank" title="<?php echo __('more about malfunction 3', 'spam_master'); ?>"><em><?php echo __('click here', 'spam_master'); ?></em></a>. <?php echo __('Please get in touch with us via', 'spam_master'); ?> <a class="spam-master-admin-link-decor" href="https://www.techgasp.com/support/" target="_blank" title="<?php echo __('Support Ticket', 'spam_master'); ?>"><strong><em><?php echo __('Support Ticket', 'spam_master'); ?></strong></em></a> <?php echo __('and refer malfunction 3.', 'spam_master'); ?></p>
		</div>
		<?php
		//Update Alert Levels
		$data_spam1 = array('spamvalue' => '');
		$where_spam1 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_alert_level');
		$wpdb->update( $spam_master_keys, $data_spam1, $where_spam1 );
		$data_spam2 = array('spamvalue' => '');
		$where_spam2 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_alert_level_date');
		$wpdb->update( $spam_master_keys, $data_spam2, $where_spam2 );
	}
	//STATUS MALFUNCTION_4
	if ($spam_master_status == 'MALFUNCTION_4'){
		if(empty($admin_email)){
			$admin_email = 'empty';
		}
		?>
		<div class="notice notice-warning is-dismissible">
		<p><strong><?php echo __('Spam Master Malfunction 4!!!', 'spam_master'); ?></strong>. <?php echo __('Not able to automatically Generate a FREE Connection Key on your server, most likely reason is the Settings > General > Administration Email Address:', 'spam_master'); ?> <strong><?php echo $admin_email; ?></strong>. <?php echo __('It was either empty or already in use. Not to worry, you can check the connection key in use by this email or get a new connection key at', 'spam_master'); ?> <a class="spam-master-admin-link-decor" href="https://www.spammaster.org" title="<?php echo __('Free Connection', 'spam_master'); ?>" target="_blank"><strong><em><?php echo __('www.spammaster.org', 'spam_master'); ?></strong></em></a>.</p>
		</div>
		<?php
	}
	//STATUS MALFUNCTION_5
	if ($spam_master_status == 'MALFUNCTION_5'){
		?>
		<div class="notice notice-warning is-dismissible">
		<p><strong><?php echo __('Spam Master Malfunction 5!!!', 'spam_master'); ?></strong>. <?php echo __('Not able to Generate a FREE Connection Key because the daily limit of free keys was exceeded. Please try again tomorrow or', 'spam_master'); ?> <a class="spam-master-admin-link-decor" href="https://www.techgasp.com/downloads/spam-master-license/" target="_blank" title="<?php echo __('get pro key', 'spam_master'); ?>"><em><?php echo __('get pro key', 'spam_master'); ?></em></a>.</p>
		</div>
		<?php
	}
	//STATUS MALFUNCTION_6
	if ($spam_master_status == 'MALFUNCTION_6'){
		?>
		<div class="notice notice-warning is-dismissible">
		<p><strong><?php echo __('Spam Master Malfunction 6!!!', 'spam_master'); ?></strong>. <?php echo __('Not able to connect to the online RBL servers with that key. Key already use in another website. Please visit', 'spam_master'); ?> <a class="spam-master-admin-link-decor" href="https://www.spammaster.org" title="<?php echo __('Check Keys', 'spam_master'); ?>" target="_blank"><strong><em><?php echo __('www.spammaster.org', 'spam_master'); ?></strong></em></a> <?php echo __('to check your keys or get a new key', 'spam_master'); ?>.</p>
		</div>
		<?php
	}
	//STATUS EXPIRED
	if ($spam_master_status == 'EXPIRED'){
		if($spam_master_type == 'TRIAL'){
			?>
			<div class="notice notice-error is-dismissible">
			<p><strong><?php echo __('Spam Master', 'spam_master'); ?></strong> <?php echo __('Warning!!! Your Trial Key', 'spam_master'); ?> <strong><em><?php echo __('EXPIRED', 'spam_master'); ?></em></strong>. <?php echo __('You can get a FREE connection key at', 'spam_master'); ?> <a class="spam-master-admin-link-decor" href="https://www.spammaster.org" target="_blank" title="<?php echo __('www.spammaster.org', 'spam_master'); ?>"><em><?php echo __('www.spammaster.org', 'spam_master'); ?></em></a>.</p>
			</div>
			<?php
		}
		if($spam_master_type == 'FULL'){
			?>
			<div class="notice notice-error is-dismissible">
			<p><strong><?php echo __('Spam Master', 'spam_master'); ?></strong> <?php echo __('Warning!!! Your Key', 'spam_master'); ?><strong><em><?php echo __('EXPIRED', 'spam_master'); ?></em></strong>. <?php echo __('Hope you have enjoyed 1 year of bombastic spam protection provided by Spam Master. Your website is now unprotected and may be subjected to thousands of spam threats & exploits. Not to worry! If you enjoyed the protection you can quickly get another key, it costs peanuts per year,', 'spam_master'); ?> <a class="spam-master-admin-link-decor" href="https://www.techgasp.com/downloads/spam-master-license/" target="_blank" title="<?php echo __('get pro key', 'spam_master'); ?>"><em><?php echo __('get pro key', 'spam_master'); ?></em></a>.</p>
			</div>
			<?php
		}
		//Update Alert Levels
		$data_spam1 = array('spamvalue' => '');
		$where_spam1 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_alert_level');
		$wpdb->update( $spam_master_keys, $data_spam1, $where_spam1 );
		$data_spam2 = array('spamvalue' => '');
		$where_spam2 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_alert_level_date');
		$wpdb->update( $spam_master_keys, $data_spam2, $where_spam2 );
	}
	//STATUS INACTIVE, NO KEY SENT YET
	if ($spam_master_status == 'INACTIVE'){
		$spam_master_screen = get_current_screen();
		if( $spam_master_screen->id != 'settings_page_spam-master' ){
			if($spam_master_type == 'TRIAL' || $spam_master_type == 'FREE' || $spam_master_type == 'FULL'){
				?>
				<div class="notice notice-error is-dismissible">
				<p><strong><?php echo __('Spam Master', 'spam_master'); ?></strong> <?php echo __('Warning!!! Your Key is', 'spam_master'); ?> <strong><?php echo __('INACTIVE & OFFLINE!!!', 'spam_master'); ?></strong>. <?php echo __('You haven\'t updated, upgraded Spam Master "for a very long time". Not to worry, please update Spam Master to the latest version and re-activate your connection', 'spam_master'); ?>.</p>
				</div>
				<?php
			}
		}
		//Update Alert Levels
		$data_spam1 = array('spamvalue' => '');
		$where_spam1 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_alert_level');
		$wpdb->update( $spam_master_keys, $data_spam1, $where_spam1 );
		$data_spam2 = array('spamvalue' => '');
		$where_spam2 = array('spamkey' => 'Option', 'spamtype' => 'spam_master_alert_level_date');
		$wpdb->update( $spam_master_keys, $data_spam2, $where_spam2 );
	}
//END FUNC ADIM NOTICES
}

//////////////////////////
////////CRON HOOKS////////
//////////////////////////
//sets the cron time
function spam_master_key_cron( $schedules ) {
	$schedules['daily'] = array(
		'interval' => 86400,
		'display' => __( 'Once Daily', 'spam_master' )
	);
  return $schedules;
}
add_filter( 'cron_schedules', 'spam_master_key_cron' );

//sets the updater page
function spam_master_key_load_cron(){
	require_once( WP_PLUGIN_DIR . '/spam-master/includes/admin/spam-master-admin-key-sender.php');
}

if ( ! wp_next_scheduled( 'spam_master_key_load' ) ) {
  wp_schedule_event( time(), 'daily', 'spam_master_key_load' );
}
add_action( 'spam_master_key_load', 'spam_master_key_load_cron' );

//registers deactivation if plugin uninstalled
function spam_master_remove_key_cron_schedule(){
  wp_clear_scheduled_hook( 'spam_master_key_load' );
}
register_deactivation_hook( __FILE__, 'spam_master_remove_key_cron_schedule' );

//Tasks Crons
function spam_master_tasks_cron( $schedules ) {
	// set our 1 hours, units in seconds
	$period = 1*3600;
	$schedules['hourly'] = array(
		'interval' => $period,
		'display' => 'Once Hourly'
	);
	return $schedules;
}
add_filter( 'cron_schedules', 'spam_master_tasks_cron' );

//sets the updater page
function spam_master_tasks_load_cron(){
	require_once( WP_PLUGIN_DIR . '/spam-master/includes/admin/spam-master-tasks.php');
}

if ( ! wp_next_scheduled( 'spam_master_tasks_load' ) ) {
  wp_schedule_event( time(), 'hourly', 'spam_master_tasks_load' );
}
add_action( 'spam_master_tasks_load', 'spam_master_tasks_load_cron' );

//registers deactivation if plugin uninstalled
function spam_master_remove_tasks_cron_schedule(){
  wp_clear_scheduled_hook( 'spam_master_tasks_load' );
}
register_deactivation_hook( __FILE__, 'spam_master_remove_tasks_cron_schedule' );

//set emails outside admin scope including weekly email cron
$spam_master_emails_current_date = current_time('Y-m-d');
if($spam_master_status == 'EXPIRED'){
	if($spam_master_type == 'TRIAL'){
		if($spam_master_emails_current_date != $spam_master_trial_expired_date && $spam_master_trial_expired_notice != '1' ) {

			// Spam email controller runs after wp_loaded for dependent wp_mail
			////////////////////////
			function SpamMasterTrialExpNotifyLoad() {
				$spammail = true;
				$SpamMasterEmailController = new SpamMasterEmailController;
				$is_deact = $SpamMasterEmailController->SpamMasterTrialExpNotify( $spammail );
			}
			add_action( 'wp_loaded', 'SpamMasterTrialExpNotifyLoad' );

		}
	}
	if($spam_master_type == 'FREE'){
		if($spam_master_emails_current_date != $spam_master_free_expired_date && $spam_master_free_expired_notice != '1' ) {

			// Spam email controller runs after wp_loaded for dependent wp_mail
			////////////////////////
			function SpamMasterFreeExpNotifyLoad() {
				$spammail = true;
				$SpamMasterEmailController = new SpamMasterEmailController;
				$is_deact = $SpamMasterEmailController->SpamMasterFreeExpNotify( $spammail );
			}
			add_action( 'wp_loaded', 'SpamMasterFreeExpNotifyLoad' );

		}
	}
	if( $spam_master_type == 'FULL' ) {
		if( $spam_master_emails_current_date != $spam_master_full_expired_date && $spam_master_full_expired_notice != '1' ) {

			// Spam email controller runs after wp_loaded for dependent wp_mail
			////////////////////////
			function SpamMasterFullExpNotifyLoad() {
				$spammail = true;
				$SpamMasterEmailController = new SpamMasterEmailController;
				$is_deact = $SpamMasterEmailController->SpamMasterFullExpNotify( $spammail );
			}
			add_action( 'wp_loaded', 'SpamMasterFullExpNotifyLoad' );

		}
	}
}
if($spam_master_status == 'INACTIVE'){
	if($spam_master_type == 'FULL'){
		if($spam_master_emails_current_date >= $spam_master_full_inactive_date && $spam_master_full_inactive_notice != '1' ) {

			// Spam email controller runs after wp_loaded for dependent wp_mail
			////////////////////////
			function SpamMasterFullInactNotifyLoad() {
				$spammail = true;
				$SpamMasterEmailController = new SpamMasterEmailController;
				$is_deact = $SpamMasterEmailController->SpamMasterFullInactNotify( $spammail );
			}
			add_action( 'wp_loaded', 'SpamMasterFullInactNotifyLoad' );

		}
	}
}
if($spam_master_status == 'UNSTABLE'){
	if($spam_master_emails_current_date >= $spam_master_free_unstable_date && $spam_master_free_unstable_notice != '1'){

		// Spam email controller runs after wp_loaded for dependent wp_mail
		////////////////////////
		function SpamMasterUnstableNotifyLoad() {
			$spammail = true;
			$SpamMasterEmailController = new SpamMasterEmailController;
			$is_deact = $SpamMasterEmailController->SpamMasterUnstableNotify( $spammail );
		}
		add_action( 'wp_loaded', 'SpamMasterUnstableNotifyLoad' );

	}
}
if( $spam_master_status == 'MALFUNCTION_1' ) {
	if($spam_master_emails_current_date >= $spam_master_malfunction_1_date && $spam_master_malfunction_1_notice != '1'){

		// Spam email controller runs after wp_loaded for dependent wp_mail
		////////////////////////
		function SpamMasterMailfunction1NotifyLoad() {
			$spammail = true;
			$SpamMasterEmailController = new SpamMasterEmailController;
			$is_malfunction1 = $SpamMasterEmailController->SpamMasterMalfunction1Notify( $spammail );
		}
		add_action( 'wp_loaded', 'SpamMasterMailfunction1NotifyLoad' );

	}
}
if( $spam_master_status == 'MALFUNCTION_2' ) {
	if($spam_master_emails_current_date >= $spam_master_malfunction_2_date && $spam_master_malfunction_2_notice != '1'){

		// Spam email controller runs after wp_loaded for dependent wp_mail
		////////////////////////
		function SpamMasterMailfunction2NotifyLoad() {
			$spammail = true;
			$SpamMasterEmailController = new SpamMasterEmailController;
			$is_malfunction2 = $SpamMasterEmailController->SpamMasterMalfunction2Notify( $spammail );
		}
		add_action( 'wp_loaded', 'SpamMasterMailfunction2NotifyLoad' );

	}
}
if( $spam_master_status == 'MALFUNCTION_6' ) {
	if($spam_master_emails_current_date >= $spam_master_malfunction_6_date && $spam_master_malfunction_6_notice != '1'){

		// Spam email controller runs after wp_loaded for dependent wp_mail
		////////////////////////
		function SpamMasterMailfunction6NotifyLoad() {
			$spammail = true;
			$SpamMasterEmailController = new SpamMasterEmailController;
			$is_malfunction6 = $SpamMasterEmailController->SpamMasterMalfunction6Notify( $spammail );
		}
		add_action( 'wp_loaded', 'SpamMasterMailfunction6NotifyLoad' );

	}
}
if($spam_master_status == 'VALID'){
	if($spam_master_type == 'FULL'){
		if( $spam_master_full_install_notice != '1' ) {

			// Spam email controller runs after wp_loaded for dependent wp_mail
			////////////////////////
			function SpamMasterFullNotifyLoad() {
				$spammail = true;
				$SpamMasterEmailController = new SpamMasterEmailController;
				$is_deact = $SpamMasterEmailController->SpamMasterFullNotify( $spammail );
			}
			add_action( 'wp_loaded', 'SpamMasterFullNotifyLoad' );

		}
	}
	if($spam_master_type == 'FREE'){
		$spam_master_free_notice_plus_7 = date( 'Y-m-d', strtotime( '+7 days', strtotime( $spam_master_expires ) ) );
		if($spam_master_emails_current_date >= $spam_master_free_notice_plus_7 && $spam_master_free_rate_notice != '1'){

			// Spam email controller runs after wp_loaded for dependent wp_mail
			////////////////////////
			function SpamMasterFreeNotifyLoad() {
				$spammail = true;
				$SpamMasterEmailController = new SpamMasterEmailController;
				$is_deact = $SpamMasterEmailController->SpamMasterFreeNotify( $spammail );
			}
			add_action( 'wp_loaded', 'SpamMasterFreeNotifyLoad' );

		}
	}
	//set 6 days report email if active
	if($spam_master_emails_weekly_email == 'true'){
		function spam_master_weekly_report_cron( $schedules ) {
			$schedules['6days'] = array(
			'interval' => 518400,
			'display' => __( '6 Days', 'spam_master' )
			);
		 return $schedules;
		}
		add_filter( 'cron_schedules', 'spam_master_weekly_report_cron' );

		//sets the updater page
		function spam_master_weekly_report_load_cron(){
		global $wpdb, $blog_id;

			// Spam email controller
			////////////////////////
			$spammail = true;
			$SpamMasterEmailController = new SpamMasterEmailController;
			$is_deact = $SpamMasterEmailController->SpamMasterWeeklyReport( $spammail );

			//Add Table & Load Spam Master Options
			if(is_multisite()){
				$spam_master_keys = $wpdb->get_blog_prefix($blog_id)."spam_master_keys";
			}
			else{
				$spam_master_keys = $wpdb->prefix."spam_master_keys";
			}
			$spam_master_emails_weekly_stats = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_emails_weekly_stats'");
			if($spam_master_emails_weekly_stats == 'true'){

				// Spam email controller
				////////////////////////
				$spammail = true;
				$SpamMasterEmailController = new SpamMasterEmailController;
				$is_deact = $SpamMasterEmailController->SpamMasterWeeklyStatsReport( $spammail );

			}
		}

		if ( ! wp_next_scheduled( 'spam_master_weekly_report_load' ) ) {
		  wp_schedule_event( time(), '6days', 'spam_master_weekly_report_load' );
		}
		add_action( 'spam_master_weekly_report_load', 'spam_master_weekly_report_load_cron' );

		//registers deactivation if plugin uninstalled
		function spam_master_remove_weekly_report_cron_schedule(){
		  wp_clear_scheduled_hook( 'spam_master_weekly_report_load' );
		}
		register_deactivation_hook( __FILE__, 'spam_master_remove_weekly_report_cron_schedule' );
	}
	else{
		//registers deactivation if plugin uninstalled
		function spam_master_remove_weekly_report_cron_schedule(){
		  wp_clear_scheduled_hook( 'spam_master_weekly_report_load' );
		}
		register_deactivation_hook( __FILE__, 'spam_master_remove_weekly_report_cron_schedule' );
	}
}

function spam_master_dismiss(){
	global $wpdb, $blog_id;

	//Add Table & Load Spam Master Options
	if(is_multisite()){
		$spam_master_keys = $wpdb->get_blog_prefix($blog_id)."spam_master_keys";
		$blogname = substr(get_blog_option($blog_id, 'blogname'),0,256);
	}
	else{
		$spam_master_keys = $wpdb->prefix."spam_master_keys";
		$blogname = substr(get_option('blogname'),0,256);
	}
	if(empty($blogname)){
		$blogname = 'empty blog name';
	}
	$spam_license_key = esc_html(substr($wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_license_key'"),0,64));
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

	if(isset($_REQUEST['spammasterdisfr']) && $_REQUEST['spammasterdisfr'] == '1'){
		$is_type = 'Invitation Free Local';
		$is_set_local_free = true;
		//Update Invitation
		$data_spam = array('spamvalue' => '1');
		$where_spam = array('spamkey' => 'Option', 'spamtype' => 'spam_master_invitation_free_notice');
		$wpdb->update( $spam_master_keys, $data_spam, $where_spam );
	}
	else{
		$is_set_local_free = false;
	}
	if(isset($_REQUEST['spammasterdisfu']) && $_REQUEST['spammasterdisfu'] == '1'){
		$is_type = 'Invitation Pro Local';
		$is_set_local_pro = true;
		//Update Invitation
		$data_spam = array('spamvalue' => '1');
		$where_spam = array('spamkey' => 'Option', 'spamtype' => 'spam_master_invitation_full_notice');
		$wpdb->update( $spam_master_keys, $data_spam, $where_spam );
	}
	else{
		$is_set_local_pro = false;
	}
	if(isset($_REQUEST['spammasterdisfrwide']) && $_REQUEST['spammasterdisfrwide'] == '1'){
		$is_type = 'Invitation Free Wide';
		$is_set_wide_free = true;
		//Update Invitation
		$data_spam = array('spamvalue' => '1');
		$where_spam = array('spamkey' => 'Option', 'spamtype' => 'spam_master_invitation_free_wide_notice');
		$wpdb->update( $spam_master_keys, $data_spam, $where_spam );
	}
	else{
		$is_set_wide_free = false;
	}
	if(isset($_REQUEST['spammasterdisfuwide']) && $_REQUEST['spammasterdisfuwide'] == '1'){
		$is_type = 'Invitation Pro Wide';
		$is_set_wide_pro = true;
		//Update Invitation
		$data_spam = array('spamvalue' => '1');
		$where_spam = array('spamkey' => 'Option', 'spamtype' => 'spam_master_invitation_full_wide_notice');
		$wpdb->update( $spam_master_keys, $data_spam, $where_spam );
	}
	else{
		$is_set_wide_pro = false;
	}
	if($is_set_local_free || $is_set_local_pro || $is_set_wide_free || $is_set_wide_pro ){

		//Log InUp Controller
		$spamtype = 'Invitation';
		$spamvalue = 'Dismissal '.$is_type;
		$cache = '7D';
		$SpamMasterLogController = new SpamMasterLogController;
		$is_log = $SpamMasterLogController->SpamMasterLog($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spamtype, $spamvalue, $cache);

?>
<div id="message" class="updated">
<p><?php echo __('Invitation Dismissed.', 'spam_master'); ?></p>
</div>
<?php
	}
}
add_action( 'admin_notices', 'spam_master_dismiss' );

//DB CHECK
}

/**
 * Adds Spam Master Version to the <head> tag
 *
 * @since 6.6.20
 * @return void
*/
function spam_master_version_in_header(){
	$spam_master_name = constant('SPAM_MASTER_NAME');
	$spam_master_version = constant('SPAM_MASTER_VERSION');
	echo '<meta name="generator" content="' . $spam_master_name . ' ' . $spam_master_version . __(' - Real-time WordPress Protection With Firewall Security.' ) . '" />' . "\n";
}
add_action( 'wp_head', 'spam_master_version_in_header' );

/**
 * Deactivation hook.
 * @return void
*/
function spam_master_deactivate() {

	// Spam email controller
	////////////////////////
	$spammail = true;
	$SpamMasterEmailController = new SpamMasterEmailController;
	$is_deact = $SpamMasterEmailController->SpamMasterDeactEmail( $spammail );

}
register_deactivation_hook( __FILE__, 'spam_master_deactivate' );

/**
 * Uninstall hook.
 * @return void
*/
function spam_master_uninstall() {
	require_once( WP_PLUGIN_DIR . '/spam-master/uninstall.php' );
}
register_uninstall_hook( __FILE__, 'spam_master_uninstall' );
?>
