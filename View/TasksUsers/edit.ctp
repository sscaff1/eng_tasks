<div class="tasksUsers form">
<?php echo $this->Form->create('TasksUser'); ?>
	<fieldset>
		<legend><?php echo __('Edit Tasks User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('task_id');
		echo $this->Form->input('user_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('TasksUser.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('TasksUser.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Tasks Users'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Tasks'), array('controller' => 'tasks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Task'), array('controller' => 'tasks', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
