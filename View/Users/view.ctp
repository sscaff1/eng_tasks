<h2><?php echo $user['User']['name']; ?></h2>
	<dl>
		<dt><?php echo __('Role'); ?></dt>
		<dd>
			<?php echo h($user['Role']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
		<dt>Active Tasks</dt>
		<dd>
			<?php if (array_key_exists($user['User']['id'], $active_tasks)) { ?>
				<?php echo $this->Number->format($active_tasks[$user['User']['id']], array('places' => '0', 'before' => '')); ?>
			<?php } ?>
			&nbsp;
		</dd>
		<dt>Completed Tasks</dt>
		<dd>
			<?php if (array_key_exists($user['User']['id'], $complete_tasks)) { ?>
				<?php echo $this->Number->format($complete_tasks[$user['User']['id']], array('places' => '0', 'before' => '')); ?>
			<?php } ?>
			&nbsp;
		</dd>
	</dl>
<div class="related">
<div class="accordion">
<?php if (!empty($report)): ?>
	<h3><?php echo __('Work Time Report'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Task Type'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Estimate')?></th>
		<th><?php echo __('Logged Time')?></th>
	</tr>
	<?php foreach ($report as $task): ?>
		<tr>
			<?php if (!empty($task['Task']['TaskType'])) { ?>
				<td><?php echo $task['Task']['TaskType']['name']; ?></td>
			<?php } else { ?>
				<td><i>No Task Type Selected</i></td>
			<?php } ?>
			<td><?php echo $task['Task']['name']; ?></td>
			<td><?php echo $task['Task']['estimate']; ?>
			<td><?php echo $this->Number->format($task['0']['logged_time'], array('places' => 2, 'before' => '')); ?></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
<?php if (!empty($user['Task'])): ?>
	<h3><?php echo __('Assigned Tasks'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Task Type'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Estimate')?></th>
		<th><?php echo 'Due Date'?></th>
		<th><?php echo 'Status'?></th>
	</tr>
	<?php foreach ($user['Task'] as $task): ?>
		<tr>
			<td><?php echo $task['TaskType']['name']; ?></td>
			<td><?php echo $this->Html->link($task['name'], array('controller' => 'tasks', 'action' => 'view', $task['id'])); ?></td>
			<td><?php echo $task['estimate']; ?></td>
			<td><?php echo $this->Time->format('m/j/y (D)', $task['due_date']);?></td>
			<td><?php echo $task['Status']['name']; ?></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
<?php if (!empty($user['WorkTime'])): ?>
	<h3><?php echo __('All Work Times'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Task Name'); ?></th>
		<th><?php echo __('Start Time'); ?></th>
		<th><?php echo __('End Time')?></th>
		<th class="actions"><?php echo 'Actions'?></th>
	</tr>
	<?php foreach ($user['WorkTime'] as $worktime): ?>
		<tr>
			<td><?php echo $this->Html->link($worktime['Task']['name'], array('controller' => 'tasks', 'action' => 'view', $worktime['Task']['id'])); ?></td>
			<td><?php echo $this->Time->format('m/j/Y h:mA', $worktime['start_time']); ?></td>
			<td><?php echo $this->Time->format('m/j/Y h:mA', $worktime['end_time']); ?></td>
			<td class="actions"><?php echo $this->Html->link('Edit', array('controller' => 'work_times', 'action' => 'edit', $worktime['id']))?></td>
			
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>
</div>
