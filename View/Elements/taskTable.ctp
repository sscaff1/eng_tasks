<div id="changing_table">
<table>
	<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('name', 'Task Name'); ?></th>
			<th><?php echo $this->Paginator->sort('status_id'); ?></th>
			<th><?php echo $this->Paginator->sort('due_date'); ?></th>
			<th><?php echo $this->Paginator->sort('active'); ?></th>
			<th>Logged Time</th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
	</thead>
	<tbody>
	<?php
	
foreach ( $tasks as $task ) {
		if (! empty ( $task ['WorkTime'] )) {
			$jobbed_on = 1;
		}
	}
	?>
	<?php foreach ($tasks as $task): ?>
	<tr
			<?php if (!empty($task['WorkTime'])) { echo 'style="background:yellow"'; } ?>>
			<td><?php echo h($task['Task']['name']); ?>&nbsp;</td>
			<td><?php echo h($task['Status']['name']); ?>&nbsp;</td>
			<td><?php echo $this->Time->format('m/j/y (D)', $task['Task']['due_date']); ?>&nbsp;</td>
		<?php if ($task['Task']['active'] == 2) { ?>
			<td>Yes</td>
		<?php } elseif ($task['Task']['active'] == 1) { ?>
			<td>Next Up</td>
		<?php } else { ?>
			<td>No</td>
		<?php } ?>
		<td>
			<?php if (array_key_exists($task['Task']['id'],$tot_log)) {?>
				<?php echo $this->Number->format($tot_log[$task['Task']['id']], array('places' => '2', 'before' => '')); ?>
			<?php } else { ?>
				<i>No Time Logged</i>
			<?php } ?>
		</td>
			<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $task['Task']['id'])); ?>
			<?php if ($task['Status']['name'] != 'Completed') { ?>
				<?php if (empty($task['WorkTime'])) { ?>
					<?php if (!isset($jobbed_on)) { ?>
						<?php echo $this->Html->link('Job On', array('controller' => 'work_times', 'action' => 'job_on', $task['Task']['id'])); ?>
						<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $task['Task']['id'])); ?>
						
					<?php } ?>	
				<?php } else { ?>
					<?php echo $this->Html->link('Job Off', array('controller' => 'work_times', 'action' => 'job_off', $task['Task']['id'])); ?>
					<?php echo $this->Html->link('Complete Task', array('controller' => 'tasks', 'action' => 'complete', $task['Task']['id']), array(), 'Once you complete this task, it will be marked as complete and you will be unable to job onto it again. Are you sure you want to complete?'); ?>
					<?php echo $this->Html->link('Record Issue', array('controller' => 'issues', 'action' => 'add',$task['Task']['id']))?>	
				<?php } ?>
			<?php } ?>			
		</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>
<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>