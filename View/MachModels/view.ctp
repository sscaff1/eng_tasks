<div class="machModels view">
<h2><?php echo __('Mach Model'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($machModel['MachModel']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($machModel['MachModel']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($machModel['MachModel']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($machModel['MachModel']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Mach Model'), array('action' => 'edit', $machModel['MachModel']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Mach Model'), array('action' => 'delete', $machModel['MachModel']['id']), array(), __('Are you sure you want to delete # %s?', $machModel['MachModel']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Mach Models'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mach Model'), array('action' => 'add')); ?> </li>
	</ul>
</div>
