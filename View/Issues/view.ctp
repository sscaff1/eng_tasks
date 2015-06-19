<div class="issues view">
<h2><?php echo __('Issue'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($issue['Issue']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Task'); ?></dt>
		<dd>
			<?php echo $this->Html->link($issue['Task']['name'], array('controller' => 'tasks', 'action' => 'view', $issue['Task']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Issue Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($issue['IssueType']['name'], array('controller' => 'issue_types', 'action' => 'view', $issue['IssueType']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($issue['Issue']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comments'); ?></dt>
		<dd>
			<?php echo h($issue['Issue']['comments']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($issue['Issue']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($issue['Issue']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Issue'), array('action' => 'edit', $issue['Issue']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Issue'), array('action' => 'delete', $issue['Issue']['id']), array(), __('Are you sure you want to delete # %s?', $issue['Issue']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Issues'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Issue'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tasks'), array('controller' => 'tasks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Task'), array('controller' => 'tasks', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Issue Types'), array('controller' => 'issue_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Issue Type'), array('controller' => 'issue_types', 'action' => 'add')); ?> </li>
	</ul>
</div>
