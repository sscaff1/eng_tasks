<div class="pure-menu pure-menu-open pure-menu-horizontal" id="main_site_menu">
	<ul id="std-menu-items">
		<li><?php echo $this->Html->link('My Tasks', array('controller' => 'tasks', 'action' => 'my_tasks')); ?></li>
		<li><a href="#">List Data</a>
			<ul>
				<li><?php echo $this->Html->link('List All Tasks', array('controller' => 'tasks', 'action' => 'index')); ?></li>
				<?php if ($current_user['Role']['name'] == 'Administrator') { ?>
					<li><?php echo $this->Html->link('List All Users', array('controller' => 'users', 'action' => 'index')); ?></li>
				<?php } ?>
			</ul>
         </li>
         <li><a href="#">Add New</a>
			<ul>
				<li><?php echo $this->Html->link('Add New Task', array('controller' => 'tasks', 'action' => 'add')); ?></li>
				<?php if ($current_user['Role']['name'] == 'Administrator') { ?>
					<li><?php echo $this->Html->link('Add New User', array('controller' => 'users', 'action' => 'add')); ?></li>
				<?php } ?>
            </ul>
         </li>
         <li><?php echo $this->Html->link('My Reports', array('controller' => 'tasks', 'action' => 'my_reports')); ?></li>
         <?php if ($current_user['Role']['name'] == 'Administrator') { ?>
         <li><a href="#">Administrator Add</a>
         	<ul>
				<li><?php echo $this->Html->link('Add New Task Type', array('controller' => 'task_types', 'action' => 'add')); ?></li>
				<li><?php echo $this->Html->link('Add New Job Function', array('controller' => 'roles', 'action' => 'add')); ?></li>
			</ul>
         </li>
         <li><?php echo $this->Html->link('Report', array('controller' => 'tasks', 'action' => 'reports')); ?></li>
         <?php } ?>
         <li><?php echo $this->Html->link('Update Profile', array('controller' => 'users', 'action' => 'edit_profile')); ?></li>
    </ul>
</div>