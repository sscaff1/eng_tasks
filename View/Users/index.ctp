	<h2><?php echo __('All Users'); ?></h2>
	<?php echo $this->Form->input('Search', array('label' => false, 'placeholder' => 'Search', 'onkeyup' => 'getUsers(this.value)')); ?>
	<?php echo $this->element('usersIndex'); ?>
	<script type="text/javascript">
		function getUsers(value) {
			$.post("/eng_tasks/users/searchUsers", {partialUser:value}, function(data) {
				$("#changing_table").html(data);
				$.getScript("/../eng_tasks/js/custom.js");
			});
		}
	</script>
