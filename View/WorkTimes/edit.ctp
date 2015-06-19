<?php echo $this->Form->create('WorkTime'); ?>
	<fieldset>
		<legend><?php echo __('Edit Work Time'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('start_time', array('class' => 'datetimepicker',
		'type' => 'text',
		'value' => date('Y-m-d h:i A', strtotime($this->request->data['WorkTime']['start_time']))));
		echo $this->Form->input('end_time', array('class' => 'datetimepicker',
		'type' => 'text',
		'value' => date('Y-m-d h:i A', strtotime($this->request->data['WorkTime']['end_time']))));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>

