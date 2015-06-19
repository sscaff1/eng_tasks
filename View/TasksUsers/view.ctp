<div class="tasksUsers view">
<h2><?php echo __('Tasks User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($tasksUser['TasksUser']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Task'); ?></dt>
		<dd>
			<?php echo $this->Html->link($tasksUser['Task']['name'], array('controller' => 'tasks', 'action' => 'view', $tasksUser['Task']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($tasksUser['User']['id'], array('controller' => 'users', 'action' => 'view', $tasksUser['User']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Tasks User'), array('action' => 'edit', $tasksUser['TasksUser']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Tasks User'), array('action' => 'delete', $tasksUser['TasksUser']['id']), array(), __('Are you sure you want to delete # %s?', $tasksUser['TasksUser']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Tasks Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tasks User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tasks'), array('controller' => 'tasks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Task'), array('controller' => 'tasks', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
