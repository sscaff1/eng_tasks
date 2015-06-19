<?php echo $this->Form->create('Task'); ?>
	<fieldset>
		<legend><?php echo __('Create a New Report'); ?></legend>
	<?php echo $this->Form->input('start_date', array('class' => 'date_picker'))?>
	<?php echo $this->Form->input('end_date', array('class' => 'date_picker'))?>
	</fieldset>
<?php echo $this->Form->end(__('Create Report')); ?>
<?php if (!empty($work_times)) { ?>
<h2>By Date</h2>
<table class="report_table">
  <tr>
  	<th>Day of the Week</th>
  	<th>Date</th>
    <th>Logged Time</th>
  </tr>
  <?php foreach ($work_times_d as $i => $wt) { ?>
	  <tr>
	  	<td><?php echo $this->Time->format('l', $wt['0']['start_date']); ?>
	  	<td><?php echo $this->Time->format('m/d/Y', $wt['0']['start_date']); ?>
	    <td><?php echo $this->Number->format($wt['0']['logged_time'], 
	    		array('places' => '2', 'before' => null)); ?></td>
	  </tr>
  <?php } ?>
</table>
<h2>By Date & Task</h2>
<table class="report_table">
  <tr>
  	<th>Day of the Week</th>
  	<th>Date</th>
    <th>Task Type</th>
    <th>Oracle Project Number</th>
    <th>Task Name</th>
    <th>Logged Time</th>
    <th>Due Date</th>
    <th>Final Status</th>
  </tr>
  <?php foreach ($work_times as $i => $wt) { ?>
	  <tr>
	  	<td><?php echo $this->Time->format('l', $wt['0']['start_date']); ?>
	  	<td><?php echo $this->Time->format('m/d/Y', $wt['0']['start_date']); ?>
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
<?php } ?>
