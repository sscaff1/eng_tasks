<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Edit Profile'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('role_id', array('label' => 'Job Function', 'empty' => '--'));
		echo $this->Form->input('first_name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('username', array('label' => 'email'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
