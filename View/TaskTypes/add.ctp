<?php echo $this->Form->create('TaskType'); ?>
	<fieldset>
		<legend><?php echo __('Add Task Type'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
