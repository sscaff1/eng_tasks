<style>
.error-message {
	display: none;
}
</style>
<h2><?php echo __('My Tasks'); ?></h2>
<i style="position: relative; top: -10px;">Only Active Tasks Shown 
	<?php echo $this->Html->link('(Click Here to See All Your Tasks)', array('action' => 'all_my_tasks'));?></i>
<h3 style='margin: 0; font-style: italic;'>Add Time to Task</h3>
<?php if (!empty($this->validationErrors['WorkTime'])) { ?>
<h4
	style="color: red; background: yellow; border: 2px solid; border-radius: 10px; padding: 5px; display: inline-block;">You
	must fill in all fields and select a date in the past (or today).</h4>
<br />
<?php } ?>
	<?php echo $this->Form->create('WorkTime', 
			array('inputDefaults' => array(
						'div' => false,
						'label' => false,
						'style' => 'display:inline-block;'),
					'style' => 'border:2px solid;padding: 2px 3px; margin: 2px 0;border-radius:10px;')); ?>
		<?php echo $this->Form->input('task_id', 
				array('empty' => '--Select Task--',
				'options' => $task_names,
				'label' => false)); ?>
		<?php echo $this->Form->input('start_time', array(
			'class' => 'date_picker', 
				'label' => false,
				'type' => 'text',
				'placeholder' => 'Pick Date')); ?>
		<?php echo $this->Form->input('hours', array(
					'empty' => '--Select # of Hours--',
				'options' => array_combine(range(0.5, 10, 0.5), range(0.5, 10, 0.5))
		)); ?>
	<?php echo $this->Form->end(array('label' => 'Add Time', 'div' => false)); ?><br />
	<?php echo $this->Form->input('searchTasks', array(
			'label' => false,
			'placeholder' => 'Search',
			'onkeyup' => 'getTasks(this.value)'
	)); ?>
	<?php echo $this->element('taskTable'); ?>
<script type="text/javascript">
	function getTasks(value) {
		$.post("/eng_tasks/eng_tasks/tasks/searchTasks", {partialTask:value}, function(data) {
			$("#changing_table").html(data);
			$.getScript("/eng_tasks/eng_tasks/js/custom.js");
		});
	}
</script>