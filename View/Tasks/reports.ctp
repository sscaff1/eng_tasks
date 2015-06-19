<?php echo $this->Form->create('Task'); ?>
	<fieldset>
		<legend><?php echo __('Create a New Report'); ?></legend>
	<?php echo $this->Form->input('start_date', array('class' => 'date_picker'))?>
	<?php echo $this->Form->input('end_date', array('class' => 'date_picker'))?>
	</fieldset>
<?php echo $this->Form->end(__('Create Report')); ?>
<?php if (!empty($work_times)) { ?>
<br />
<!-- <div style="border:2px solid black; border-radius:10px;display:inline-block; padding:5px;background-color:black;margin-left:10px;margin-bottom:10px;margin-top:10px;">
<?php echo $this->Html->link('Export to CSV', array('controller' => 'tasks', 'action' => 'export_csv'), array('onclick' => 'exportCsv()')); ?> -->
</div>
<table class="report_table">
  <tr>
    <th>User</th>
    <th>Task Type</th>
    <th>Oracle Project Number</th>
    <th>Task Name</th>
    <th>Logged Time</th>
    <th>Due Date</th>
    <th>Final Status</th>
  </tr>
  <?php foreach ($work_times as $i => $wt) { ?>
	  <tr>
	  	<td><?php echo $wt['0']['name']; ?></td>
	  	<td><?php echo $wt['task_types']['type_name']?></td>
	  	<td><?php echo $wt['tasks']['oracle']?></td>
	    <td><?php echo $wt['tasks']['task_name']; ?></td>
	    <td><?php echo $this->Number->format($wt['0']['logged_time'], 
	    		array('places' => '2', 'before' => null)); ?></td>
	    <td <?php if ((strtotime($wt['0']['due_date']) < strtotime("NOW -1 day")) && 
	    				($wt['statuses']['status_name'] != "Completed")) { 
							echo 'style="color: red"'; 
						} ?>>
						<?php echo $this->Time->format('m/j/Y', $wt['0']['due_date']); ?>
		</td>
	    <td><?php echo $wt['statuses']['status_name']; ?></td>
	  </tr>
  <?php } ?>
</table>
<!-- <div id="workTimes"><?php echo json_encode(array('workTimes' => $work_times)); ?></div> -->
<?php } ?>
<script type="text/javascript">
	function exportCsv() {
	$.ajax({
		url: "/eng_tasks/tasks/export_csv", 
		dataType: 'json',
		success: function(data) {
			$('#workTimes').html(data.workTimes).serialize();
		}
	}); 
	}
</script>