<?php echo $this->Form->create('Task'); ?>
	<fieldset>
		<legend><?php echo __('Create a New Task'); ?></legend>
	<?php
		echo $this->Form->input('com_id_num', array('label' => 'Customer Order ID Number'));
		echo $this->Form->input('oracle_proj_num', array('label' => 'Oracle Project Number'));
		echo $this->Form->input('par_id_num', array('label' => 'PAR ID Number'));
		echo $this->Form->input('msr_id_num', array('label' => 'MSR ID Number'));
		echo $this->Form->input('mach_model_id',
			array('label' => 'Machine Model',
					'empty' => '--',
					'after' => "If Applicable"));
		echo $this->Form->input('mach_config_id',
			array('label' => 'Machine Configuration',
					'empty' => '--',
					'after' => "If Applicable"));
		echo $this->Form->input('task_type_id',
				array('empty' => '--'));
		$user_options = array('class' => 'multi_select',
				'label' => false,
				'style' => 'width:400px',
				'multiple' => true,
				'default' => $current_user['id']);
		if ($current_user['Role']['name'] == 'Administrator') {
			echo $this->Form->input('User',
					$user_options);
		} else {
			$user_options = array_merge($user_options,array('type' => 'hidden'));
			echo $this->Form->input('User',
					$user_options);
			?><style>.ui-multiselect {display:none;} </style><?php 
		}
		echo $this->Form->input('active',
				array('options' => array(2 => 'Yes', 1 => 'Next Up', 0 => 'No'),
						'empty' => '--',
						'label' => 'Is this task active?'));
		echo $this->Form->input('name', array('label' => 'Task Name'));
		echo $this->Form->input('description',
				array('label' => 'Task Description/Scope'));
		echo $this->Form->input('due_date',
				array('type' => 'text',
				'class' => 'date_picker'));
		echo $this->Form->input('estimate',
				array('label' => 'Time Estimate',
					'after' => "Estimate total man-hours required for task. Please round to 2 decimal places."))
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>