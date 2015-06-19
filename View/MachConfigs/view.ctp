<div class="machConfigs view">
<h2><?php echo __('Mach Config'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($machConfig['MachConfig']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($machConfig['MachConfig']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($machConfig['MachConfig']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($machConfig['MachConfig']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Mach Config'), array('action' => 'edit', $machConfig['MachConfig']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Mach Config'), array('action' => 'delete', $machConfig['MachConfig']['id']), array(), __('Are you sure you want to delete # %s?', $machConfig['MachConfig']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Mach Configs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mach Config'), array('action' => 'add')); ?> </li>
	</ul>
</div>
