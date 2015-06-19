<div class="workTimes view">
<h2><?php echo __('Work Time'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($workTime['WorkTime']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Task'); ?></dt>
		<dd>
			<?php echo $this->Html->link($workTime['Task']['name'], array('controller' => 'tasks', 'action' => 'view', $workTime['Task']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($workTime['User']['id'], array('controller' => 'users', 'action' => 'view', $workTime['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Start Time'); ?></dt>
		<dd>
			<?php echo h($workTime['WorkTime']['start_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('End Time'); ?></dt>
		<dd>
			<?php echo h($workTime['WorkTime']['end_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($workTime['WorkTime']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($workTime['WorkTime']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Work Time'), array('action' => 'edit', $workTime['WorkTime']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Work Time'), array('action' => 'delete', $workTime['WorkTime']['id']), array(), __('Are you sure you want to delete # %s?', $workTime['WorkTime']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Work Times'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Work Time'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tasks'), array('controller' => 'tasks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Task'), array('controller' => 'tasks', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
