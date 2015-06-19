<div id ="changing_table">
<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('role_id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('Email'); ?></th>
			<th><?php echo 'Active Tasks'; ?></th>
			<th><?php echo 'Completed Tasks'; ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($users as $user): ?>
	<tr>
		<td><?php echo h($user['Role']['name']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['name']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
		<?php if (array_key_exists($user['User']['id'], $active_tasks)) { ?>
			<td><?php echo $this->Number->format($active_tasks[$user['User']['id']], array('places' => '0', 'before' => '')); ?></td>
		<?php } else { ?>
			<td>No Active Tasks</td>
		<?php } ?>
		<?php if (array_key_exists($user['User']['id'], $complete_tasks)) { ?>
			<td><?php echo $this->Number->format($complete_tasks[$user['User']['id']], array('places' => '0', 'before' => '')); ?></td>
		<?php } else { ?>
			<td>No Completed Tasks</td>
		<?php } ?>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id'])); ?>
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
	<div>
</div>