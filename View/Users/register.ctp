<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Register'); ?></legend>
	<?php
		echo $this->Form->input('role_id',array(
				'empty' => '--',
				'label' => 'Job Function'
		));
		echo $this->Form->input('first_name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('username',
			array(
			'label' => 'Email',
			'after' => '<br />Please use your email address.'
		));
		echo $this->Form->input('password');
		echo $this->Form->input('confirm_password',
			array('type' => 'password')
		);
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
