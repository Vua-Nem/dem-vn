<?php
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
	add_filter('woocommerce_register_form_end', 'spam_master_woo_extra_register_field');
	function spam_master_woo_extra_register_field(){
	?>
		<div class="clear"></div>
		<p class="form-row form-row-wide">
		<label for="spam_master">Website Protected by <a href="https://www.spammaster.org/" target="_blank" title="Spam Master"><em>Spam Master</em></a></label>
		</p>
	  <?php
	}

	add_filter('woocommerce_login_form_end', 'spam_master_woo_extra_login_field');
	function spam_master_woo_extra_login_field(){
	?>
		<div class="clear"></div>
		<p class="form-row form-row-wide">
		<label for="spam_master">Website Protected by <a href="https://www.spammaster.org/" target="_blank" title="Spam Master"><em>Spam Master</em></a></label>
		</p>
	  <?php
	}
	
	add_filter('woocommerce_checkout_form_end', 'spam_master_woo_extra_checkout_field');
	function spam_master_woo_extra_checkout_field(){
	?>
		<div class="clear"></div>
		<p class="form-row form-row-wide">
		<label for="spam_master">Website Protected by <a href="https://www.spammaster.org/" target="_blank" title="Spam Master"><em>Spam Master</em></a></label>
		</p>
	  <?php
	}

	add_action('woocommerce_email_footer', 'spam_master_woo_extra_email_field');
	function spam_master_woo_extra_email_field($email) {
		?>
		<p></p>
		<p><?php printf( __( 'Website Protected by <b>Spam Master</b>', 'spam_master')); ?></p>
		<?php
	}
}
?>
