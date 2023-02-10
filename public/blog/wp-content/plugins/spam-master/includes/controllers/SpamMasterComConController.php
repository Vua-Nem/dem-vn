<?php
class SpamMasterComConController {

	protected $remote_ip;
	protected $blog_threat_email;
	protected $remote_referer;
	protected $dest_url;
	protected $remote_agent;
	protected $spamuserA;
	protected $spam_master_page;
	protected $result_comment_content_clean;
	protected $comment_russian_char;
	protected $comment_chinese_char;
	protected $comment_asian_char;	
	protected $comment_arabic_char;
	protected $comment_spam_char;
	protected $contact_russian_char;
	protected $contact_chinese_char;
	protected $contact_asian_char;	
	protected $contact_arabic_char;
	protected $contact_spam_char;


	public function SpamMasterCharScan($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spam_master_page, $result_comment_content_clean, $comment_russian_char, $comment_chinese_char, $comment_asian_char, $comment_arabic_char, $comment_spam_char, $contact_russian_char, $contact_chinese_char, $contact_asian_char, $contact_arabic_char, $contact_spam_char){
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
		$spam_master_address = substr($wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_address'"),0,256);
		$spam_master_ip = substr($wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_ip'"),0,48);
	
		if($spam_master_status == 'VALID' || $spam_master_status == 'MALFUNCTION_1' || $spam_master_status == 'MALFUNCTION_2'){

			//Prepare ComCon Chars & Exclude Tracks
			if($spam_master_page == 'Comment' || $spam_master_page == 'Contact Form'){

				$spam_master_leaning_url = 'aHR0cHM6Ly93d3cuc3BhbW1hc3Rlci5vcmcvd3AtY29udGVudC9wbHVnaW5zL3NwYW0tbWFzdGVyLWFkbWluaXN0cmF0b3IvaW5jbHVkZXMvbGVhcm5pbmcvZ2V0X2xlYXJuX2NvbV8yLnBocA==';

				if($comment_russian_char == true || $contact_russian_char == true){
					$spam_master_russian_char_set = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_russian_char_set'");

					$blacklist_russian_char_array = explode("\n", $spam_master_russian_char_set);
					$blacklist_russian_char_size = sizeof($blacklist_russian_char_array);
					for($i = 0; $i < $blacklist_russian_char_size; $i++){
						$blacklist_russian_char_current = trim($blacklist_russian_char_array[$i]);
						if(stripos($result_comment_content_clean, $blacklist_russian_char_current) !== false){
							$blog_threat_content = 'Cyrillic Char: '. $blacklist_russian_char_current . 'Text: ' .$result_comment_content_clean;
							$spam_master_learning_post = array(
																'blog_license_key' => $spam_license_key,
																'blog_threat_ip' => $remote_ip,
																'blog_threat_user' => $spamuserA,
																'blog_threat_type' => $spam_master_page,
																'blog_threat_email' => $blog_threat_email,
																'blog_threat_content' => $blog_threat_content,
																'blog_threat_agent' => $remote_agent,
																'blog_threat_refe' => $remote_referer,
																'blog_threat_dest' => $dest_url,
																'blog_web_adress' => $spam_master_address,
																'blog_server_ip' => $spam_master_ip
							);
							$response = wp_remote_post( base64_decode($spam_master_leaning_url), array(
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
								$spamc = '12M';

								//Spam Buffer Controller
								////////////////////////
								$blog_threat_email = false;
								$SpamMasterBufferController = new SpamMasterBufferController;
								$is_threat = $SpamMasterBufferController->SpamMasterBufferInsert($remote_ip, $blog_threat_email, $spamc);

								//Spam Buffer Controller
								////////////////////////
								$SpamMasterBufferController = new SpamMasterBufferController;
								$is_buffer_count = $SpamMasterBufferController->SpamMasterBufferCount();

							}
						return "IS_CHAR";
						}
					}
				}
				if($comment_chinese_char == true || $contact_chinese_char == true){
					$spam_master_chinese_char_set = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_chinese_char_set'");

					$blacklist_chinese_char_array = explode("\n", $spam_master_chinese_char_set);
					$blacklist_chinese_char_size = sizeof($blacklist_chinese_char_array);
					for($i = 0; $i < $blacklist_chinese_char_size; $i++){
						$blacklist_chinese_char_current = trim($blacklist_chinese_char_array[$i]);
						if(stripos($result_comment_content_clean, $blacklist_chinese_char_current) !== false){
							$blog_threat_content = 'Chinese Char: '. $blacklist_chinese_char_current . 'Text: ' .$result_comment_content_clean;
							$spam_master_learning_post = array(
																'blog_license_key' => $spam_license_key,
																'blog_threat_ip' => $remote_ip,
																'blog_threat_user' => $spamuserA,
																'blog_threat_type' => $spam_master_page,
																'blog_threat_email' => $blog_threat_email,
																'blog_threat_content' => $blog_threat_content,
																'blog_threat_agent' => $remote_agent,
																'blog_threat_refe' => $remote_referer,
																'blog_threat_dest' => $dest_url,
																'blog_web_adress' => $spam_master_address,
																'blog_server_ip' => $spam_master_ip
							);
							$response = wp_remote_post( base64_decode($spam_master_leaning_url), array(
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
								$spamc = '12M';

								//Spam Buffer Controller
								////////////////////////
								$blog_threat_email = false;
								$SpamMasterBufferController = new SpamMasterBufferController;
								$is_threat = $SpamMasterBufferController->SpamMasterBufferInsert($remote_ip, $blog_threat_email, $spamc);

								//Spam Buffer Controller
								////////////////////////
								$SpamMasterBufferController = new SpamMasterBufferController;
								$is_buffer_count = $SpamMasterBufferController->SpamMasterBufferCount();

							}
						return "IS_CHAR";
						}
					}
				}
				if($comment_asian_char == true || $contact_asian_char == true){
					$spam_master_asian_char_set = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_asian_char_set'");

					$blacklist_asian_char_array = explode("\n", $spam_master_asian_char_set);
					$blacklist_asian_char_size = sizeof($blacklist_asian_char_array);
					for($i = 0; $i < $blacklist_asian_char_size; $i++){
						$blacklist_asian_char_current = trim($blacklist_asian_char_array[$i]);
						if(stripos($result_comment_content_clean, $blacklist_asian_char_current) !== false){					
							$blog_threat_content = 'Asian Char: '. $blacklist_asian_char_current . 'Text: ' .$result_comment_content_clean;
							$spam_master_learning_post = array(
																'blog_license_key' => $spam_license_key,
																'blog_threat_ip' => $remote_ip,
																'blog_threat_user' => $spamuserA,
																'blog_threat_type' => $spam_master_page,
																'blog_threat_email' => $blog_threat_email,
																'blog_threat_content' => $blog_threat_content,
																'blog_threat_agent' => $remote_agent,
																'blog_threat_refe' => $remote_referer,
																'blog_threat_dest' => $dest_url,
																'blog_web_adress' => $spam_master_address,
																'blog_server_ip' => $spam_master_ip
							);
							$response = wp_remote_post( base64_decode($spam_master_leaning_url), array(
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
								$spamc = '12M';

								//Spam Buffer Controller
								////////////////////////
								$blog_threat_email = false;
								$SpamMasterBufferController = new SpamMasterBufferController;
								$is_threat = $SpamMasterBufferController->SpamMasterBufferInsert($remote_ip, $blog_threat_email, $spamc);

								//Spam Buffer Controller
								////////////////////////
								$SpamMasterBufferController = new SpamMasterBufferController;
								$is_buffer_count = $SpamMasterBufferController->SpamMasterBufferCount();

							}
						return "IS_CHAR";
						}
					}
				}
				if($comment_arabic_char == true || $contact_arabic_char == true){
					$spam_master_arabic_char_set = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_arabic_char_set'");

					$blacklist_arabic_char_array = explode("\n", $spam_master_arabic_char_set);
					$blacklist_arabic_char_size = sizeof($blacklist_arabic_char_array);
					for($i = 0; $i < $blacklist_arabic_char_size; $i++){
						$blacklist_arabic_char_current = trim($blacklist_arabic_char_array[$i]);
						if(stripos($result_comment_content_clean, $blacklist_arabic_char_current) !== false){
							$blog_threat_content = 'Arabic Char: '. $blacklist_arabic_char_current . 'Text: ' .$result_comment_content_clean;
							$spam_master_learning_post = array(
																'blog_license_key' => $spam_license_key,
																'blog_threat_ip' => $remote_ip,
																'blog_threat_user' => $spamuserA,
																'blog_threat_type' => $spam_master_page,
																'blog_threat_email' => $blog_threat_email,
																'blog_threat_content' => $blog_threat_content,
																'blog_threat_agent' => $remote_agent,
																'blog_threat_refe' => $remote_referer,
																'blog_threat_dest' => $dest_url,
																'blog_web_adress' => $spam_master_address,
																'blog_server_ip' => $spam_master_ip
							);
							$response = wp_remote_post( base64_decode($spam_master_leaning_url), array(
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
								$spamc = '12M';

								//Spam Buffer Controller
								////////////////////////
								$blog_threat_email = false;
								$SpamMasterBufferController = new SpamMasterBufferController;
								$is_threat = $SpamMasterBufferController->SpamMasterBufferInsert($remote_ip, $blog_threat_email, $spamc);

								//Spam Buffer Controller
								////////////////////////
								$SpamMasterBufferController = new SpamMasterBufferController;
								$is_buffer_count = $SpamMasterBufferController->SpamMasterBufferCount();

							}
						return "IS_CHAR";
						}
					}
				}
				if($comment_spam_char == true || $contact_spam_char == true){
					$spam_master_spam_char_set = $wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_spam_char_set'");

					$blacklist_spam_char_array = explode("\n", $spam_master_spam_char_set);
					$blacklist_spam_char_size = sizeof($blacklist_spam_char_array);
					for($i = 0; $i < $blacklist_spam_char_size; $i++){
						$blacklist_spam_char_current = trim($blacklist_spam_char_array[$i]);
						if(stripos($result_comment_content_clean, $blacklist_spam_char_current) !== false){
							$blog_threat_content = 'Spam Char: '. $blacklist_spam_char_current . 'Text: ' .$result_comment_content_clean;
							$spam_master_learning_post = array(
																'blog_license_key' => $spam_license_key,
																'blog_threat_ip' => $remote_ip,
																'blog_threat_user' => $spamuserA,
																'blog_threat_type' => $spam_master_page,
																'blog_threat_email' => $blog_threat_email,
																'blog_threat_content' => $blog_threat_content,
																'blog_threat_agent' => $remote_agent,
																'blog_threat_refe' => $remote_referer,
																'blog_threat_dest' => $dest_url,
																'blog_web_adress' => $spam_master_address,
																'blog_server_ip' => $spam_master_ip
							);
							$response = wp_remote_post( base64_decode($spam_master_leaning_url), array(
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
								$spamc = '12M';

								//Spam Buffer Controller
								////////////////////////
								$blog_threat_email = false;
								$SpamMasterBufferController = new SpamMasterBufferController;
								$is_threat = $SpamMasterBufferController->SpamMasterBufferInsert($remote_ip, $blog_threat_email, $spamc);

								//Spam Buffer Controller
								////////////////////////
								$SpamMasterBufferController = new SpamMasterBufferController;
								$is_buffer_count = $SpamMasterBufferController->SpamMasterBufferCount();

							}
						return "IS_CHAR";
						}
					}
				}
			}
		}
	}

	public function SpamMasterComConScan($remote_ip, $blog_threat_email, $remote_referer, $dest_url, $remote_agent, $spamuserA, $spam_master_page, $result_comment_content_clean){
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
		$spam_master_address = substr($wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_address'"),0,256);
		$spam_master_ip = substr($wpdb->get_var("SELECT spamvalue FROM {$spam_master_keys} WHERE spamkey = 'Option' AND spamtype = 'spam_master_ip'"),0,48);

		if($spam_master_status == 'VALID' || $spam_master_status == 'MALFUNCTION_1' || $spam_master_status == 'MALFUNCTION_2'){

			$spam_master_leaning_url = 'aHR0cHM6Ly93d3cuc3BhbW1hc3Rlci5vcmcvd3AtY29udGVudC9wbHVnaW5zL3NwYW0tbWFzdGVyLWFkbWluaXN0cmF0b3IvaW5jbHVkZXMvbGVhcm5pbmcvZ2V0X2xlYXJuX2NvbV8yLnBocA==';
			$spam_master_learning_post = array(
												'blog_license_key' => $spam_license_key,
												'blog_threat_ip' => $remote_ip,
												'blog_threat_user' => $spamuserA,
												'blog_threat_type' => $spam_master_page,
												'blog_threat_email' => $blog_threat_email,
												'blog_threat_content' => $result_comment_content_clean,
												'blog_threat_agent' => $remote_agent,
												'blog_threat_refe' => $remote_referer,
												'blog_threat_dest' => $dest_url,
												'blog_web_adress' => $spam_master_address,
												'blog_server_ip' => $spam_master_ip
			);
			$response = wp_remote_post( base64_decode($spam_master_leaning_url), array(
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

				if(empty($data['threat'])){
				}
				else{
					$remote_ip = $data['threat'];
					$spamc = $data['c'];

					//Spam Buffer Controller
					////////////////////////
					$blog_threat_email = false;
					$SpamMasterBufferController = new SpamMasterBufferController;
					$is_threat = $SpamMasterBufferController->SpamMasterBufferInsert($remote_ip, $blog_threat_email, $spamc);

					return "IS_COMCON";
				}
			}
		}
	}

}
?>
