<div class="issues form">
<?php echo $this->Form->create('Issue'); ?>
	<fieldset>
		<legend><?php echo __('Edit Issue'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('task_id');
		echo $this->Form->input('issue_type_id');
		echo $this->Form->input('name');
		echo $this->Form->input('comments');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Issue.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Issue.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Issues'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Tasks'), array('controller' => 'tasks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Task'), array('controller' => 'tasks', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Issue Types'), array('controller' => 'issue_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Issue Type'), array('controller' => 'issue_types', 'action' => 'add')); ?> </li>
	</ul>
</div>
