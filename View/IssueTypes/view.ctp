<div class="issueTypes view">
<h2><?php echo __('Issue Type'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($issueType['IssueType']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($issueType['IssueType']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($issueType['IssueType']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($issueType['IssueType']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Issue Type'), array('action' => 'edit', $issueType['IssueType']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Issue Type'), array('action' => 'delete', $issueType['IssueType']['id']), array(), __('Are you sure you want to delete # %s?', $issueType['IssueType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Issue Types'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Issue Type'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Issues'), array('controller' => 'issues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Issue'), array('controller' => 'issues', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Issues'); ?></h3>
	<?php if (!empty($issueType['Issue'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Issue Type Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Comments'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($issueType['Issue'] as $issue): ?>
		<tr>
			<td><?php echo $issue['id']; ?></td>
			<td><?php echo $issue['issue_type_id']; ?></td>
			<td><?php echo $issue['name']; ?></td>
			<td><?php echo $issue['comments']; ?></td>
			<td><?php echo $issue['created']; ?></td>
			<td><?php echo $issue['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'issues', 'action' => 'view', $issue['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'issues', 'action' => 'edit', $issue['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'issues', 'action' => 'delete', $issue['id']), array(), __('Are you sure you want to delete # %s?', $issue['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Issue'), array('controller' => 'issues', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
