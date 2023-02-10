<?php
/**
 * Load SpamMaster extension classes.
 */
if ( !class_exists( 'SpamMasterActionController' ) ) {
	require_once WP_PLUGIN_DIR . '/spam-master/includes/controllers/SpamMasterActionController.php';
}
if ( !class_exists( 'SpamMasterBufferController' ) ) {
	require_once WP_PLUGIN_DIR . '/spam-master/includes/controllers/SpamMasterBufferController.php';
}
if ( !class_exists( 'SpamMasterComConController' ) ) {
	require_once WP_PLUGIN_DIR . '/spam-master/includes/controllers/SpamMasterComConController.php';
}
if ( !class_exists( 'SpamMasterElusiveController' ) ) {
	require_once WP_PLUGIN_DIR . '/spam-master/includes/controllers/SpamMasterElusiveController.php';
}
if ( !class_exists( 'SpamMasterFloodController' ) ) {
	require_once WP_PLUGIN_DIR . '/spam-master/includes/controllers/SpamMasterFloodController.php';
}
if ( !class_exists( 'SpamMasterHAFController' ) ) {
	require_once WP_PLUGIN_DIR . '/spam-master/includes/controllers/SpamMasterHAFController.php';
}
if ( !class_exists( 'SpamMasterHoneyController' ) ) {
	require_once WP_PLUGIN_DIR . '/spam-master/includes/controllers/SpamMasterHoneyController.php';
}
if ( !class_exists( 'SpamMasterInvitationController' ) ) {
	require_once WP_PLUGIN_DIR . '/spam-master/includes/controllers/SpamMasterInvitationController.php';
}
if ( !class_exists( 'SpamMasterLogController' ) ) {
	require_once WP_PLUGIN_DIR . '/spam-master/includes/controllers/SpamMasterLogController.php';
}
if ( !class_exists( 'SpamMasterRegistrationController' ) ) {
	require_once WP_PLUGIN_DIR . '/spam-master/includes/controllers/SpamMasterRegistrationController.php';
}
if ( !class_exists( 'SpamMasterWhiteController' ) ) {
	require_once WP_PLUGIN_DIR . '/spam-master/includes/controllers/SpamMasterWhiteController.php';
}
if ( !class_exists( 'SpamMasterEmailController' ) ) {
	require_once WP_PLUGIN_DIR . '/spam-master/includes/controllers/SpamMasterEmailController.php';
}
