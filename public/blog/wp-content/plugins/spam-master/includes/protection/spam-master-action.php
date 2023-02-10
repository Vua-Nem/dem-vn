<?php
/**
 * This is our callback function that embeds our resource in a WP_REST_Response
 */
function spam_master_private(WP_REST_Request $request) {
    global $wpdb, $blog_id;

	//Add Table & Load Spam Master Options
	if(is_multisite()){
		$spam_master_keys = $wpdb->get_blog_prefix($blog_id)."spam_master_keys";
	}
	else{
		$spam_master_keys = $wpdb->prefix."spam_master_keys";
	}

	$spam_master_status = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_status'");

	if($spam_master_status == 'VALID' || $spam_master_status == 'MALFUNCTION_1' || $spam_master_status == 'MALFUNCTION_2'){

		$data = json_decode($request->get_body(), true );

		// Restrict endpoint to only valid key and hash
		if(empty($request['k'])){
			return new WP_REST_Response(esc_html__( 'Silence is Golden. Request k.', 'spam_master' ), 401);
		}
		if(empty($request['h'])){
			return new WP_REST_Response(esc_html__( 'Silence is Golden. Request h.', 'spam_master' ), 401);
		}
		if (!empty($request['k']) && !empty($request['h'])) {
			$my_K = sanitize_text_field($request['k']);
			$my_H = sanitize_text_field($request['h']);
			$is_key = $wpdb->get_var($wpdb->prepare( "SELECT id FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_license_key' AND spamvalue = %s", $my_K));
			if(empty($is_key)){
				return new WP_REST_Response(esc_html__( 'Silence is Golden. K.', 'spam_master' ), 401);
			}
			$is_hash = $wpdb->get_var($wpdb->prepare( "SELECT id FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_db_protection_hash' AND spamvalue = %s", $my_H));
			if(empty($is_hash)){
				return new WP_REST_Response(esc_html__( 'Silence is Golden. H.', 'spam_master' ), 401);
			}
			if(!empty($is_key) && !empty($is_hash)){

				//Spam Action Controller
				////////////////////////
				$SpamMasterActionController = new SpamMasterActionController;
				$is_more = $SpamMasterActionController->SpamMasterGetAct();

				return new WP_REST_Response(esc_html__( 'Successful Transfer.', 'spam_master' ), 200);
			}
		}
	}
	else{
		return new WP_REST_Response(esc_html__( 'Silence is Golden. Status.', 'spam_master' ), 401);
	}
}

/**
 * This function is where we register our routes for our example endpoint.
 */
function prefix_register_spam_master_routes() {
	register_rest_route( 'spam-master/v1', '/action', array(
		'methods' => WP_REST_Server::CREATABLE,
		'callback' => 'spam_master_private',
		'args' => array(),
		'permission_callback' => function () {
			return true;
		}
	));
}
add_action( 'rest_api_init', 'prefix_register_spam_master_routes' );
?>
