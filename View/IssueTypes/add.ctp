<?php echo $this->Form->create('IssueType'); ?>
	<fieldset>
		<legend><?php echo __('Add Issue Type'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>