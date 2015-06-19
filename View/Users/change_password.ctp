<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo 'Change Password for '.$current_user['username']; ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('current_password', array('type' => 'password'));
		echo $this->Form->input('password', array('label' => 'New Password'));
		echo $this->Form->input('confirm_password', array('label' => 'Confirm New Password', 'type' => 'password'));
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Change Password')); ?>