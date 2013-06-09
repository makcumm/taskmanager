<?php
	$labels_attr = array('class' => 'control-label', );
	$form_open_attrs = array('class' => 'form-inline modal-form', );
	$structure_id = !empty($structure_id) ? $structure_id : '1';
	$division_id = !empty($division_id) ? $division_id : '1';
	$worker_id = !empty($worker_id) ? $worker_id : '1';
	$task_importance = !empty($task_importance) ? $task_importance : '1';
	$task_name = !empty($task_name) ? $task_name : '';
	$task_description = !empty($task_description) ? $task_description : '';
	$task_deadline = !empty($task_deadline) ? $task_deadline : date( 'Y-m-d' );
	$task_id = !empty($task_id) ? $task_id : NULL;
	echo form_open($form_action, $form_open_attrs);
?>
<div class="modal-header">
	<a class="close" data-dismiss="modal">×</a>
	<h3><?php echo $modal_title; ?></h3>
</div>

<div class="modal-body" type="<?php echo $type; ?>" task_id="<?php echo $task_id; ?>">
	<section>
		<div class="row">
			<div class="span3">
				<div class="control-group">
					<?php echo form_label('Structure', 'structure', $labels_attr); ?>
					<div class="controls">
						<?php echo form_dropdown( 'structure', prep_key_value('structure_id', 'structure_name', $structure), $structure_id, 'id=structure' );?>
					</div>
				</div>

				<div class="control-group">
					<?php echo form_label('Division', 'division', $labels_attr); ?>
					<div class="controls">
						<?php echo form_dropdown( 'division', prep_key_value('division_id', 'division_name', $division), $division_id, 'id=division' );?>
					</div>
				</div>

				<div class="control-group">
					<?php echo form_label('Responsible', 'worker', $labels_attr); ?>
					<div class="controls">
						<?php echo form_dropdown( 'worker', prep_key_value('worker_id', 'worker_name', $worker), $worker_id, 'id=worker' ); ?>
					</div>
				</div>

			</div>
			<div class="span3">
				<div class="control-group">
					<?php echo form_label('Priority', 'importance', $labels_attr); ?>
					<div class="controls">
						<?php $importance_arr = array('high' => 'high', 'normal' => 'normal', 'low' => 'low'); ?>
						<?php echo form_dropdown( 'importance', $importance_arr, $task_importance, 'id=importance' ); ?>
					</div>
				</div>

				<div class="control-group">
					<?php echo form_label('Task Name', 'task_name', $labels_attr); ?>
					<div class="controls">
						<?php
							$form_input_conf = array(
								'name' => 'task_name',
								'placeholder' => 'Task name',
								'id' => 'task_name',
								'value' => $task_name
							);
							echo form_input($form_input_conf);
						?>
					</div>
				</div>

				<div class="control-group">
					<?php echo form_label('Description', 'task_description', $labels_attr); ?>
					<div class="controls">
						<?php
							$for_textarea = array(
								'name' => 'task_description',
								'cols' => '5',
								'rows' => '5',
								'id' => 'task_description',
								'value' => $task_description
							);
							echo form_textarea( $for_textarea );
						?>
					</div>
				</div>

				<div class="control-group">
					<?php echo form_label('End date', 'task_deadline', $labels_attr); ?>
					<div class="controls">
						<?php echo form_input('task_deadline',$task_deadline, 'id=task_deadline') ?>
					</div>
				</div>

			</div>
		</div>
	</section>
</div>

<div class="modal-footer">
	<?php
		$form_submit_conf = array(
			'class' => 'btn btn-success modal-submit span3',
			'id'    => 'add_edit_task'
		);
		echo form_submit($form_submit_conf, 'save');
	?>
	<a href="#" class="btn" data-dismiss="modal">Close</a>
</div>
