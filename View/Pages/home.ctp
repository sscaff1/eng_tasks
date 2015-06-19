<center>
<h2>Engineering Tasks</h2>
<?php if ($logged_in) { ?>
	<?php echo 'Welcome '.$current_user['first_name'].'.'?><br />
	<?php echo $this->Html->link('Click here to go to your tasks.', array('controller' => 'tasks', 'action' => 'my_tasks')); ?>
<?php } else {?>
	<?php echo 'Please '.$this->Html->link('Login',
			array('controller' => 'Users', 'action' => 'login')).' or '.
			$this->Html->link('Register', array('controller' => 'Users', 'action' => 'register')).
			' to begin.'; ?>
<?php } ?>
</center>