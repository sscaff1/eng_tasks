<div class="machConfigs form">
<?php echo $this->Form->create('MachConfig'); ?>
	<fieldset>
		<legend><?php echo __('Add Mach Config'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Mach Configs'), array('action' => 'index')); ?></li>
	</ul>
</div>
