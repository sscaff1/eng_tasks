	<h2><?php echo __('All Tasks'); ?></h2>
	<?php echo $this->Form->input('searchTasks', array(
			'label' => false,
			'placeholder' => 'Search',
			'onkeyup' => 'getTasks(this.value)'
	)); ?>
	<?php echo $this->element('taskAllTable'); ?>
<script type="text/javascript">
	function getTasks(value) {
		$.post("/eng_tasks/eng_tasks/tasks/searchAllTasks", {partialTask:value}, function(data) {
			$("#changing_table").html(data);
			$.getScript("/eng_tasks/eng_tasks/js/custom.js");
		});
	}
</script>