<?php
global $wpdb, $blog_id;

$plugin_master_name = constant('SPAM_MASTER_NAME');
$plugin_master_domain = constant('SPAM_MASTER_DOMAIN');
?>

<div class="spam-master-pad-table"></div>

<table class="wp-list-table widefat fixed striped table-view-list" cellspacing="0">
	<thead>
		<tr>
			<th><h2><img class="spam-master-admin-img" src="<?php echo plugins_url('../images/spammaster-logo.png', dirname(__FILE__)); ?>" /><?php echo __('&nbsp;Firewall & Advanced Statistics', 'spam_master'); ?></h2></th>
		</tr>
	</thead>

	<tfoot>
		<tr>
			<th>
				<a class="btn-spammaster orange roundedspam spam-master-text-center" href="https://www.spammaster.org" target="_blank" title="<?php echo __('www.spammaster.org', 'spam_master'); ?>">
					<?php echo __('Register & Login: ', 'spam_master'); ?><strong><?php echo $spam_master_attached; ?></strong>
				</a>
			</th>
		</tr>
	</tfoot>

	<tbody>
		<tr class="alternate">
			<td>
				<span class="dashicons dashicons-info" title="Test Email To Be Used In Forms"></span> <?php echo __('Test your website spam submission on any form using the email', 'spam_master'); ?> <strong><?php echo __('spam_email@example.com', 'spam_master'); ?></strong>.
			</td>
		</tr>
		<tr class="alternate">
			<td>
				<span class="dashicons dashicons-info" title="Spam Master Info"></span> <?php echo __('You can interact with your Firewall, Tools & Statistics at', 'spam_master'); ?> <a href="https://www.spammaster.org" title="<?php echo __('Spam Master Website', 'spam_master'); ?>" target="_blank"><?php echo __('www.spammaster.org', 'spam_master'); ?></a>. <?php echo __('Use the email attached to your key to Register & Login', 'spam_master'); ?>. <span class="dashicons dashicons-email-alt" title="Email to use during Registration or Login"></span> <?php echo __('Attached Email:', 'spam_master'); ?> <strong><?php echo $spam_master_attached; ?></strong>. <?php echo __('You may also create an account with another email and transfer', 'spam_master'); ?> <span class="dashicons dashicons-randomize" title="Transfer key to another email"></span> <?php echo __('the key to it.', 'spam_master'); ?>
			</td>
		</tr>
	</tbody>
</table>
