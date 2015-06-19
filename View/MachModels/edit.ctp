<div class="machModels form">
<?php echo $this->Form->create('MachModel'); ?>
	<fieldset>
		<legend><?php echo __('Edit Mach Model'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('MachModel.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('MachModel.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Mach Models'), array('action' => 'index')); ?></li>
	</ul>
</div>
