<?php
	$labels_attr = array('class' => 'control-label', );
	$form_open_attrs = array('class' => 'form-inline modal-form', );
	echo form_open($form_action, $form_open_attrs);
?>
<div class="modal-header">
	<a class="close" data-dismiss="modal">×</a>
	<h3><?php echo $modal_title; ?></h3>
</div>

<div class="modal-body">
	<section>
		<div class="row">
			<div class="span3">
				<div class="control-group">
					<?php echo form_label('Structure', 'structure', $labels_attr); ?>
					<div class="controls">
						<?php echo form_dropdown( 'structure', prep_key_value('structure_id', 'structure_name', $structure), '1', 'id=structure' );?>
					</div>
				</div>

				<div class="control-group">
					<?php echo form_label('Division', 'division', $labels_attr); ?>
					<div class="controls">
						<?php echo form_dropdown( 'division', prep_key_value('division_id', 'division_name', $division), '1', 'id=division' );?>
					</div>
				</div>

				<div class="control-group">
					<?php echo form_label('Responsible', 'worker', $labels_attr); ?>
					<div class="controls">
						<?php echo form_dropdown( 'worker', prep_key_value('worker_id', 'worker_name', $worker), '1', 'id=worker' ); ?>
					</div>
				</div>

			</div>
			<div class="span3">
				<div class="control-group">
					<?php echo form_label('Priority', 'importance', $labels_attr); ?>
					<div class="controls">
						<?php $importance_arr = array('high' => 'high', 'normal' => 'normal', 'low' => 'low'); ?>
						<?php echo form_dropdown( 'importance', $importance_arr, '1', 'id=importance' ); ?>
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
								'value' => ''

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
								'id' => 'task_description'
							);
							echo form_textarea( $for_textarea );
						?>
					</div>
				</div>

				<div class="control-group">
					<?php echo form_label('End date', 'task_deadline', $labels_attr); ?>
					<div class="controls">
						<?php echo form_input('task_deadline', "2012-06-15", 'id=task_deadline' ); ?>
					</div>
				</div>

			</div>
		</div>
	</section>
</div>

<div class="modal-footer">
	<?php echo form_submit(array('class' => 'btn btn-success modal-submit span3'), 'save'); ?>
	<a href="#" class="btn" data-dismiss="modal">Close</a>
</div>
