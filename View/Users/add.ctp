<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Adminstrator Add User'); ?></legend>
	<?php
		echo $this->Form->input('role_id', array('label' => 'Job Function', 'empty' => '--'));
		echo $this->Form->input('first_name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('username', array(
			'label' => 'Email'
		));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Add User')); ?><br />
Password will be set to task123 by default.
