<?php
//////////////////////////
//GET FRONTEND VARIABLES//
//////////////////////////
global $wpdb, $blog_id;

//Add Table & Load Spam Master Options
if( is_multisite() ) {
	$spam_master_keys = $wpdb->get_blog_prefix( $blog_id ).'spam_master_keys';
}
else{
	$spam_master_keys = $wpdb->prefix.'spam_master_keys';
}
$spam_master_signature_registration = $wpdb->get_var( "SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_signature_registration'" );
$spam_master_signature_login = $wpdb->get_var( "SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_signature_login'" );
$spam_master_signature_comments = $wpdb->get_var( "SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_signature_comments'" );
$spam_master_signature_email = $wpdb->get_var( "SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_signature_email'" );
$spam_master_status = $wpdb->get_var( "SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_status'" );

/////////////////////////////////
//IMPLEMENT SIGNATURES FRONTEND//
/////////////////////////////////
if ( $spam_master_signature_registration == 'true' ) {
	if ( $spam_master_status == 'VALID' || $spam_master_status == 'MALFUNCTION_1' || $spam_master_status == 'MALFUNCTION_2' ) {
		//MULTISITE HOOKS
		if(is_multisite()){
		add_action( 'signup_extra_fields', 'spam_master_signature_registration_field' );
		}
		//SINGLE SITE HOOKS
		else{
		add_action( 'register_form', 'spam_master_signature_registration_field' );
		}
		//INSERT FIELD
		function spam_master_signature_registration_field() {
		global $wpdb, $blog_id;
		?>
		<p>
		<?php echo __( 'Website Protected by ', 'spam_master' ); ?>
		<a href="https://www.spammaster.org/" target="_blank" title="Spam Master"><em>Spam Master</em></a>
		</p>
		<br>
		<?php
		}
	}
}
if ( $spam_master_signature_login == 'true' ) {
	if ( $spam_master_status == 'VALID' || $spam_master_status == 'MALFUNCTION_1' || $spam_master_status == 'MALFUNCTION_2' ) {
		if(is_multisite()){
		add_action( 'login_form', 'spam_master_signature_login_field' );
		}
		//SINGLE SITE HOOKS
		else{
		add_action( 'login_form', 'spam_master_signature_login_field' );
		}

		//INSERT FIELD
		function spam_master_signature_login_field() {
		global $wpdb, $blog_id;
			echo '<p>Website Protected by <a href="https://www.spammaster.org/" target="_blank" title="Spam Master"><em>Spam Master</em></a></p><br>';
		}
	}
}
	
if ( $spam_master_signature_comments == 'true' ){
	if ( $spam_master_status == 'VALID' || $spam_master_status == 'MALFUNCTION_1' || $spam_master_status == 'MALFUNCTION_2' ) {
		//MULTISITE HOOKS
		if( is_multisite() ){
		add_action( 'comment_form_after_fields', 'spam_master_signature_comments_field', 1 );
		}
		//SINGLE SITE HOOKS
		else{
		add_action( 'comment_form_after_fields', 'spam_master_signature_comments_field', 1 );
		}
		function spam_master_signature_comments_field() {
		global $wpdb, $blog_id;
			echo '<p>Website Protected by <a href="https://www.spammaster.org/" target="_blank" title="Spam Master"><em>Spam Master</em></a></p><br>';
		}
	}
}
if ( $spam_master_signature_email == 'true' ) {
	if ( $spam_master_status == 'VALID' || $spam_master_status == 'MALFUNCTION_1' || $spam_master_status == 'MALFUNCTION_2' ) {
		if( is_multisite() ) {
		//wpmu_signup_user_notification & wpmu_activate_signup
		//https://core.trac.wordpress.org/browser/tags/4.5.3/src/wp-includes/ms-functions.php#L0
		//END MULTI SITE
		}
		//SINGLE SITE HOOKS
		else{
		//Password change email
		if ( !function_exists( 'wp_password_change_notification' ) ) :
		function wp_password_change_notification( $user ) {
		global $wpdb;
			// send a copy of password change notification to the admin
			// but check to see if it's the admin whose password we're changing, and skip this
			if ( 0 !== strcasecmp( $user->user_email, get_option( 'admin_email' ) ) ) {
				// The blogname option is escaped with esc_html on the way into the database in sanitize_option
				// we want to reverse this for the plain text arena of emails.
				$blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
				/* translators: %s: user name */
				$message = sprintf( __( 'Password changed for user: %s' ), $user->user_login ) . "\r\n\r\n";
				$message .= $blogname. __(' is protected by Spam Master') . "\r\n";
				/* translators: %s: site title */
				wp_mail( get_option( 'admin_email' ), sprintf( __( '[%s] Password Changed' ), $blogname ), $message );
			}
		}
		endif;
		//New Registrations email
		if ( !function_exists('wp_new_user_notification') ) :
		function wp_new_user_notification( $user_id, $deprecated = null, $notify = '' ) {
			if ( $deprecated !== null ) {
				_deprecated_argument( __FUNCTION__, '4.3.1' );
			}
			global $wpdb, $wp_hasher;
			$user = get_userdata( $user_id );
			// The blogname option is escaped with esc_html on the way into the database in sanitize_option
			// we want to reverse this for the plain text arena of emails.
			$blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
			if ( 'user' !== $notify ) {
				$message  = sprintf( __( 'New user registration on your site %s:' ), $blogname ) . "\r\n\r\n";
				$message .= sprintf( __( 'Username: %s' ), $user->user_login ) . "\r\n\r\n";
				$message .= sprintf( __( 'Email: %s' ), $user->user_email ) . "\r\n\r\n";
				$message .= $blogname. __(' is protected by Spam Master') . "\r\n\r\n";
				@wp_mail( get_option( 'admin_email' ), sprintf( __( '[%s] New User Registration' ), $blogname ), $message );
			}
			// `$deprecated was pre-4.3 `$plaintext_pass`. An empty `$plaintext_pass` didn't sent a user notifcation.
			if ( 'admin' === $notify || ( empty( $deprecated ) && empty( $notify ) ) ) {
				return;
			}
			// Generate something random for a password reset key.
			$key = wp_generate_password( 20, false );
			/** This action is documented in wp-login.php */
			do_action( 'retrieve_password_key', $user->user_login, $key );
			// Now insert the key, hashed, into the DB.
			if ( empty( $wp_hasher ) ) {
				$wp_hasher = new PasswordHash( 8, true );
			}
			$hashed = time() . ':' . $wp_hasher->HashPassword( $key );
			$wpdb->update( $wpdb->users, array( 'user_activation_key' => $hashed ), array( 'user_login' => $user->user_login ) );
			$message = sprintf(__('Username: %s'), $user->user_login) . "\r\n\r\n";
			$message .= __('To set your password, visit the following address:') . "\r\n\r\n";
			$message .= '<' . network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user->user_login), 'login') . ">\r\n\r\n";
			$message .= wp_login_url() . "\r\n\r\n";
			$message .= $blogname. __(' is protected by Spam Master') . "\r\n";
			wp_mail($user->user_email, sprintf(__('[%s] Your username and password info'), $blogname), $message);
		//END FUNCTION
		}
		//END IF
		endif;
		//END SINGLE SITE
		}
	}
//END SIGNATURE TRUE
}
