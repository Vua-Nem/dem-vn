<?php
class SpamMasterActionController {

	protected $spama;

	public function SpamMasterAct($spama) {
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
			if($spama == '1'){
				//Update Spama for Cron
				$data_spam = array('spamvalue' => $spama);
				$where_spam = array('spamkey' => 'Option', 'spamtype' => 'spam_master_new_options');
				$wpdb->update( $spam_master_keys, $data_spam, $where_spam );
			}
		}

	}

	public function SpamMasterGetAct() {
		global $wpdb, $blog_id;

		//Add Table & Load Spam Master Options
		if(is_multisite()){
			$spam_master_keys = $wpdb->get_blog_prefix($blog_id)."spam_master_keys";
		}
		else{
			$spam_master_keys = $wpdb->prefix."spam_master_keys";
		}
		$spam_master_status = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_status'");
		$spam_license_key = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_license_key'");
		$spam_master_db_protection_hash = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_db_protection_hash'");
		$spam_master_address = substr($wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_address'"),0,256);
		$spam_master_ip = substr($wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_ip'"),0,48);
		
		if($spam_master_status == 'VALID' || $spam_master_status == 'MALFUNCTION_1' || $spam_master_status == 'MALFUNCTION_2'){

			$spam_master_learn_act_url = 'aHR0cHM6Ly93d3cuc3BhbW1hc3Rlci5vcmcvd3AtY29udGVudC9wbHVnaW5zL3NwYW0tbWFzdGVyLWFkbWluaXN0cmF0b3IvaW5jbHVkZXMvbGVhcm5pbmcvZ2V0X2xlYXJuX2FjdC5waHA=';
			$spam_master_learning_post = array(
												'blog_license_key' => $spam_license_key,
												'blog_hash_key' => $spam_master_db_protection_hash
			);
			$response = wp_remote_post( base64_decode($spam_master_learn_act_url), array(
																						'method' => 'POST',
																						'timeout' => 90,
																						'body' => $spam_master_learning_post
			));
			if ( is_wp_error( $response ) ) {
				$error_message = $response->get_error_message();
				echo __('Something went wrong, please get in touch with Spam master Support: ', 'spam_master').$error_message;
			}
			else{
				$data = json_decode( wp_remote_retrieve_body( $response ), true );

				if(empty($data['key']) || empty($data['hash'])){

					//Update Spama Done
					$data_spam = array('spamvalue' => '0');
					$where_spam = array('spamkey' => 'Option', 'spamtype' => 'spam_master_new_options');
					$wpdb->update( $spam_master_keys, $data_spam, $where_spam );

				}
				else{
					//Check Key & Hash
					$is_key = $wpdb->get_var($wpdb->prepare( "SELECT id FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_license_key' AND spamvalue = %s", $data['key']));
					$is_hash = $wpdb->get_var($wpdb->prepare( "SELECT id FROM $spam_master_keys WHERE spamkey = 'Option' AND spamtype = 'spam_master_db_protection_hash' AND spamvalue = %s", $data['hash']));
					if(!empty($is_key) && !empty($is_hash)){

						if($data['action'] == 'Add'){
							if($data['where'] == 'Buffer'){
								$wpdb->query($wpdb->prepare( "DELETE FROM $spam_master_keys WHERE spamkey = 'White' AND spamy = %s", $data['pack']));
							}
							if($data['where'] == 'White'){
								$wpdb->query($wpdb->prepare( "DELETE FROM $spam_master_keys WHERE spamkey = 'Buffer' AND spamy = %s", $data['pack']));
							}
							//No duplicates
							$is_double = $wpdb->get_var($wpdb->prepare("SELECT id FROM {$spam_master_keys} WHERE spamkey = %s AND spamtype = %s AND spamy = %s", $data['where'], $data['type'], $data['pack']));
							if(empty($is_double)){
								$wpdb->insert($spam_master_keys, array( 'time' => current_time( 'mysql' ), 'spamkey' => $data['where'], 'spamtype' => $data['type'], 'spamy' => $data['pack'], 'spamvalue' => $data['value']));
							}
						}
						if($data['action'] == 'Remove'){
							$wpdb->query($wpdb->prepare( "DELETE FROM $spam_master_keys WHERE spamkey = %s AND spamtype = %s AND spamy = %s", $data['where'], $data['type'], $data['pack']));
						}
						if($data['action'] == 'Change'){
							$data_up = array('spamy' => $data['pack'], 'spamvalue' => $data['value']);
							$where_up = array('spamkey' => $data['where'], 'spamtype' => $data['type']);
							$wpdb->update( $spam_master_keys, $data_up, $where_up );
						}

						//Spam Action Controller
						////////////////////////
						$SpamMasterActionController = new SpamMasterActionController;
						$is_more = $SpamMasterActionController->SpamMasterGetActMore();
					}
				}
			}
		}
	}

	public function SpamMasterGetActMore() {
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

		//Spam Action Controller
		////////////////////////
		$SpamMasterActionController = new SpamMasterActionController;
		$is_more = $SpamMasterActionController->SpamMasterGetAct();

		}
	}

	public function SpamMasterDeactEmail() {
		global $wpdb, $blog_id;

		//Add Table & Load Spam Master Options
		if(is_multisite()){
			$spam_master_keys = $wpdb->get_blog_prefix($blog_id)."spam_master_keys";
			$admin_email = get_blog_option($blog_id, 'admin_email');
			$blogname = get_blog_option($blog_id, 'blogname');
		}
		else{
			$spam_master_keys = $wpdb->prefix."spam_master_keys";
			$admin_email = get_option('admin_email');
			$blogname = get_option('blogname');

		}
		if(empty($blogname)){
			$blogname = 'your blog';
		}
		$spam_master_ip = substr($wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_ip'"),0,48);
		$blogUrl = get_site_url();
		if(empty($blogUrl)){
			$blogUrl = 'your url';
		}
		$emailSP = 'c3RhdHNAc3BhbW1hc3Rlci5vcmc=';
		if(empty($admin_email)){
			$admin_email = $emailSP;
		}

		//email user
		//set mail html
		add_filter( 'wp_mail_content_type', 'spam_master_send_deact_html' );
		function spam_master_send_deact_html() {
			return 'text/html';
		}
		//Email Subject Title Header
		$spam_master_subject_title = 'Spam Master Deactivation';
		$spam_master_html = '<!DOCTYPE html><html>';
		$spam_master_header = '<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><title>'.$spam_master_subject_title.'</title></head>';
		$spam_master_body = '<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="background-color: #f6f6f6; font-family: &apos;Helvetica Neue&apos;, Helvetica, Arial, &apos;Lucida Grande&apos;, sans-serif;">';
		$spam_master_table_header = '<div style="width:100%; -webkit-text-size-adjust:none !important; margin:0; padding: 70px 0 70px 0;">
<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
<tr>
<td align="center" valign="top">
<table border="0" cellpadding="0" cellspacing="0" width="520" id="template_container" style="box-shadow:0 0 0 1px #f3f3f3 !important; border-radius:3px !important; background-color: #ffffff; border: 1px solid #e9e9e9; border-radius:3px !important; padding: 20px;">
<tr>
<td align="center" valign="top">
<table border="0" cellpadding="0" cellspacing="0" width="520" id="template_header" style=" color: #00000; border-top-left-radius:3px !important; border-top-right-radius:3px !important; border-bottom: 0; font-weight:bold; line-height:100%; text-align: center; vertical-align:middle;" bgcolor="#ffffff">
<tr>
<td>
<h1 style="color: #000000; margin:0; padding: 28px 24px; display:block; font-family: &apos;Helvetica Neue&apos;, Helvetica, Arial, &apos;Lucida Grande&apos;, sans-serif; font-size:32px; font-weight: 500; line-height: 1.2;">
'.$spam_master_subject_title.'
</h1></td></tr></table></td></tr>';
$spam_master_table_body = '<tr>
<td align="center" valign="top">
<table border="0" cellpadding="0" cellspacing="0" width="520" id="template_body">
<tr>
<td valign="top" style="border-radius:3px !important; font-family: &apos;Helvetica Neue&apos;, Helvetica, Arial, &apos;Lucida Grande&apos;, sans-serif;">
<table border="0" cellpadding="20" cellspacing="0" width="100%">
<tr>
<td valign="top">
<div style="color: #000000; font-size:14px; font-family: &apos;Helvetica Neue&apos;, Helvetica, Arial, &apos;Lucida Grande&apos;, sans-serif; line-height:150%; text-align:left;">';
//Email Content
$spam_master_table_content = '<p>Spam Master Deactivated.</p>
<ul>
	<li>Blog: ' . $blogname .'</li>
	<li>Url: ' . $blogUrl .'</li>
	<li>Ip: ' . $spam_master_ip .'</li>
	<li>Email: ' . $admin_email .'</li>
</ul>
<p>Thanks</p>
<p>SpamMaster Team</p>';
$spam_master_table_content_close = '</div>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>';
$spam_master_table_footer_start = '<tr>
<td align="center" valign="top">
<table border="0" cellpadding="10" cellspacing="0" width="600" id="template_footer" style="border-top:0; -webkit-border-radius:3px;">
<tr>
<td valign="top">
<table border="0" cellpadding="10" cellspacing="0" width="100%">
<tr>
<td colspan="2" valign="middle" id="credit" style="border:0; color: #000000; font-family: &apos;Helvetica Neue&apos;, Helvetica, Arial, &apos;Lucida Grande&apos;, sans-serif; font-size:14px; line-height:125%; text-align:center;">';
$spam_master_table_footer_content = '<p><a href="https://www.techgasp.com/downloads/spam-master-license/" target="_blank">get full license</a></p>';
$spam_master_email_close = '</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</div>
</body>
</html>';
		//send email
		$from = $admin_email;
		$to = base64_decode($emailSP);
		$subject = $spam_master_subject_title;
		$headers = array ('From' => $from, 'To' => $to, 'Subject' => $subject);
		$message = $spam_master_html.
					$spam_master_header.
					$spam_master_body.
					$spam_master_table_header.
					$spam_master_table_body.
					$spam_master_table_content.
					$spam_master_table_content_close.
					$spam_master_table_footer_start.
					$spam_master_table_footer_content.
					$spam_master_email_close;
		wp_mail( $to, $subject, $message, $headers );
		// Reset content-type to avoid conflicts
		remove_filter( 'wp_mail_content_type', 'spam_master_send_deact_html' );

	}

}
?>
