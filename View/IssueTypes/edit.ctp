<div class="issueTypes form">
<?php echo $this->Form->create('IssueType'); ?>
	<fieldset>
		<legend><?php echo __('Edit Issue Type'); ?></legend>
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('IssueType.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('IssueType.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Issue Types'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Issues'), array('controller' => 'issues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Issue'), array('controller' => 'issues', 'action' => 'add')); ?> </li>
	</ul>
</div>
