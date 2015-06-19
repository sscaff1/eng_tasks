<?php
/**
 *
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 */

$cakeDescription = 'Engineering Tasks';
?>
<!doctype html>
<html lang="en">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->css('jquery-ui');
		echo $this->Html->css('jquery-ui.structure');
		echo $this->Html->css('jquery-ui.theme');
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('pure-min');
		echo $this->Html->css('jquery.datetimepicker');
		echo $this->Html->css('custom');
		echo $this->Html->script('jquery');
		echo $this->Html->script('jquery-ui');
		echo $this->Html->script('yui-min');
		echo $this->Html->script('jquery.datetimepicker');
		echo $this->Html->script('custom');
		echo $scripts_for_layout;
		echo $this->Html->meta('icon');		

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		
	?>
</head>
<body style="margin:1em;">
	<div id="container">
		<div id="header">
			<h1><?php echo $cakeDescription; ?></h1>
		</div>
		<div style="position: absolute;top: 1em;right: 1em;"><?php if ($logged_in == false) {
					echo $this->Html->link('Register', 
						array('controller' => 'users', 'action' => 'register')).' or '.
					$this->Html->link('Login',
						array('controller' => 'users', 'action' => 'login'));
				} else {
					echo 'Welcome '.$current_user['first_name'].', '.
							$this->Html->link('Logout', 
							array('controller' => 'users', 'action' => 'logout'))
							."<br>".$this->Html->link(' (Change Password)',
							array('controller' => 'users', 'action' => 'change_password'));
				}
			?></div>
		<div id="content">
<?php if ($logged_in) { ?>			
	<?php echo $this->element('main_site_menu'); ?>
    <?php } ?>
    	<div id="form_content">
        	<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
		</div>	
	</div>
	<hr />
		<div id="footer" style="float:right; text-decoration:bold">
			Created and Designed by Tela Edge, LLC
		</div>
	</div>
	<?php //echo $this->element('sql_dump'); ?>
	    <?php 
		echo $this->Js->writeBuffer();
	?>
</body>
</html>
