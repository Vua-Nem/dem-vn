<?php
class SpamMasterElusiveController {

	protected $spam_elusive;

	public function SpamMasterElusive($spam_elusive) {

		@$matches = preg_grep ("/[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})/i", $spam_elusive);
		if($matches){
			foreach ($matches as $key => $val){
				if (filter_var($val, FILTER_VALIDATE_EMAIL)) {
					return wp_strip_all_tags(substr($val,0,256));
				}
				else{
					return 'haf@'.rand(10000000, 99999999).'.wp';
				}
			}
		}
		else{
			return 'haf@'.rand(10000000, 99999999).'.wp';
		}
	}

}
?>
