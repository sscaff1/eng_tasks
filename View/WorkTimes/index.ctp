<div class="workTimes index">
	<h2><?php echo __('Work Times'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('task_id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('start_time'); ?></th>
			<th><?php echo $this->Paginator->sort('end_time'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($workTimes as $workTime): ?>
	<tr>
		<td><?php echo h($workTime['WorkTime']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($workTime['Task']['name'], array('controller' => 'tasks', 'action' => 'view', $workTime['Task']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($workTime['User']['id'], array('controller' => 'users', 'action' => 'view', $workTime['User']['id'])); ?>
		</td>
		<td><?php echo h($workTime['WorkTime']['start_time']); ?>&nbsp;</td>
		<td><?php echo h($workTime['WorkTime']['end_time']); ?>&nbsp;</td>
		<td><?php echo h($workTime['WorkTime']['created']); ?>&nbsp;</td>
		<td><?php echo h($workTime['WorkTime']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $workTime['WorkTime']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $workTime['WorkTime']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $workTime['WorkTime']['id']), array(), __('Are you sure you want to delete # %s?', $workTime['WorkTime']['id'])); ?>
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
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Work Time'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Tasks'), array('controller' => 'tasks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Task'), array('controller' => 'tasks', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
