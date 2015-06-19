<h2><?php echo $task['Task']['name']; ?>
<?php $owned = false; ?>
<?php foreach ($task['User'] as $user) { ?>
	<?php if ($user['id'] == $current_user['id'] || $current_user['Role']['name'] == 'Administrator') { ?>
		<?php $owned = true; ?>
	<?php } ?>
<?php } ?>
<?php if ($owned == true) { ?>
	<?php echo $this->Html->link('Edit', 
		array('controller' => 'tasks', 'action' => 'edit', $task['Task']['id']), array('class' => 'actions')); ?>
<?php }?>
</h2>
	<dl>
		<dt><?php echo 'COM ID Number'?></dt>
		<dd>
			<?php echo $this->Html->link($task['Task']['com_id_num'],'http://lm-portal/Lists/Customer%20Order%20Projects/DispForm.aspx?ID='.$task['Task']['com_id_num'], array('target' => 'blank'));?>
			&nbsp;
		</dd>
		<dt><?php echo 'PAR ID Number'?></dt>
		<dd>
			<?php echo $this->Html->link($task['Task']['par_id_num'],'http://lm-portal/Lists/Positive%20Action%20Request/PARDisplayRequest.aspx?ID='.substr($task['Task']['par_id_num'],1), array('target' => 'blank'));?>
			&nbsp;
		</dd>
		<dt><?php echo 'MSR ID Number'?></dt>
		<dd>
			<?php echo $this->Html->link($task['Task']['msr_id_num'],'http://lm-portal/Lists/Machinery%20Service%20Request%20New/DispForm.aspx?ID='.$task['Task']['msr_id_num'], array('target' => 'blank'));?>
			&nbsp;
		</dd>
		<dt>Assigned</dt>
		<dd>
			<?php $last = count($task['User']) - 1;?>
			<?php foreach ($task['User'] as $i => $user) { ?>
				<?php if ($i == $last) { ?>
					<?php if ($user['id'] == $current_user['id']) { ?>
						<?php echo $this->Html->link($user['name'], array('action' => 'my_tasks')); ?>
					<?php } else { ?>
						<?php echo $this->Html->link($user['name'], array('controller' => 'users', 'action' => 'view', $user['id']));?>
					<?php } ?>
				<?php } else { ?>
					<?php if ($user['id'] == $current_user['id']) { ?>
						<?php echo $this->Html->link($user['name'], array('action' => 'my_tasks')).','; ?>
					<?php } else { ?>
						<?php echo $this->Html->link($user['name'], array('controller' => 'users', 'action' => 'view', $user['id'])).',';?>
					<?php } ?>
				<?php } ?>
			<?php } ?>
			&nbsp;
		</dd>
		<dt><?php echo 'Machine'; ?></dt>
		<dd>
			<?php echo h($task['MachModel']['name'].'-'.$task['MachConfig']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Task Type'); ?></dt>
		<dd>
			<?php echo $task['TaskType']['name']?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo $task['Status']['name']; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Due Date'); ?></dt>
		<dd>
			<?php echo $this->Time->format('l, M jS, Y', $task['Task']['due_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Complete Date'); ?></dt>
		<dd>
			<?php if (empty($task['Task']['complete_date'])) { ?>
				<i>Not Complete</i>
			<?php } else { ?>
				<?php echo $this->Time->format('l, M jS, Y', $task['Task']['complete_date']); ?>
			<?php } ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php if ($task['Task']['active'] == 2) { ?>
				Yes
			<?php } elseif ($task['Task']['active'] == 1) { ?>
				Next Up
			<?php } else { ?>
				No
			<?php } ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Estimated Time'); ?></dt>
		<dd>
			<?php echo $task['Task']['estimate'].' hrs'; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo $task['Task']['description']; ?>
			&nbsp;
		</dd>
	</dl>
<div class="related">
<div class = "accordion">
<?php if (!empty($report)) { ?>
	<h3>Time Logged Report</h3>
	<table>
	<tr>
		<th>Job Function</th>
		<th>Engineer</th>
		<th>Logged Time</th>
	</tr>
	<?php foreach ($report as $r) { ?>
	<tr>
		<td><?php echo $r['User']['Role']['name']; ?></td>
		<td><?php echo $r['0']['name']; ?></td>
		<td><?php echo $this->Number->format($r['0']['logged_time'], array('before' => '', 'places' => 2)); ?></td>
	</tr>
	<?php } ?>
	
	</table>
<?php } ?>
<?php if (!empty($task['WorkTime'])): ?>
	<h3><?php echo __('All Work Times'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo 'Designer'; ?></th>
		<th><?php echo __('Start Time'); ?></th>
		<th><?php echo __('End Time'); ?></th>
		<th>Cummulative Work</th>
	</tr>
	<?php $i = 0; ?>
	<?php foreach ($task['WorkTime'] as $workTime): ?>
		<tr>
			<td><?php echo $workTime['User']['name'];?></td>
			<td><?php echo $this->Time->format('M jS, y h:i A', $workTime['start_time']); ?></td>
			<?php if (!empty($workTime['end_time'])) { ?>
				<td><?php echo $this->Time->format('M jS, y h:i A', $workTime['end_time']); ?></td>
				<td>
					<?php 
					$st = strtotime($workTime['start_time']);
					$et = strtotime($workTime['end_time']);
					$i = $i + ($et-$st)/3600; 
					echo $this->Number->format($i,array('before' => '', 'places' => '2'));?>
				</td>
			<?php } else { ?>
				<td>Currently Jobbed On</td>
				<td>N/A</td>
			<?php } ?>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
<?php if (!empty($task['Issue'])): ?>
	<h3><?php echo __('All Issues'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th>Issue Name</th>
		<th>Description</th>
	</tr>
	<?php foreach ($task['Issue'] as $issue): ?>
		<tr>
			<td><?php echo $issue['name']; ?></td>
			<td><?php echo $issue['comments']; ?></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
<?php if (!empty($my_workTimes)) { ?>
	<h3>My Work Times</h3>
	<table>
		<tr>
			<th>Start Time</th>
			<th>End Time</th>
			<th>Cummulative Work</th>
			<th class="actions">Action</th>
		</tr>
		<?php $i = 0;?>
		<?php foreach ($my_workTimes as $workTime) { ?>
			<?php $workTime = $workTime['WorkTime'];?>
			<tr>
			<td><?php echo $this->Time->format('M jS, y h:i A', $workTime['start_time']); ?></td>
			<?php if (!empty($workTime['end_time'])) { ?>
				<td><?php echo $this->Time->format('M jS, y h:i A', $workTime['end_time']); ?></td>
				<td>
					<?php 
					$st = strtotime($workTime['start_time']);
					$et = strtotime($workTime['end_time']);
					$i = $i + ($et-$st)/3600; 
					echo $this->Number->format($i,array('before' => '', 'places' => '2'));?>
				</td>
			<?php } else { ?>
				<td>Currently Jobbed On</td>
				<td>N/A</td>
			<?php } ?>
			<td class="actions"><?php echo $this->Html->link('Edit', array('controller' => 'work_times', 'action' => 'edit', $workTime['id'])); ?></td>
		</tr>
		<?php } ?>
	</table>
<?php } ?>
</div>
</div>
