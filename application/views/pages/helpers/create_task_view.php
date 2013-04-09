<?php
/**
 * To change this template use File | Settings | File Templates.
 */
// TODO: чтобы выводить добавленые задачи, в контроллере дописать в JSON данные из БД новой задачи, отрисовать их во viewe
?>

<div id="example" class="modal hide fade in" tabindex="-1" role="dialog" aria-hidden="true">

	<div class="modal-header">
		<a class="close" data-dismiss="modal">×</a>
		<h3>Add new task</h3>
	</div>

	<div class="modal-body">
		<div class="control-group">
			<?php echo form_label('Structure', 'structure'); ?>
			<div class="controls">
				<?php echo form_dropdown( 'structure', prep_key_value('structure_id', 'structure_name', $structure), '1', 'id=structure' );?>
			</div>
		</div>

		<div class="control-group">
			<?php echo form_label('Division', 'division'); ?>
			<div class="controls">
				<?php echo form_dropdown( 'division', prep_key_value('division_id', 'division_name', $division), '1', 'id=division' );?>
			</div>
		</div>

		<div class="control-group">
			<?php echo form_label('Priority', 'importance'); ?>
			<div class="controls">
				<?php $importance_arr = array('high' => 'high', 'normal' => 'normal', 'low' => 'low'); ?>
				<?php echo form_dropdown( 'importance', $importance_arr, '1', 'id=importance' ); ?>
			</div>
		</div>

		<div class="control-group">
			<?php echo form_label('Responsible', 'worker'); ?>
			<div class="controls">
				<?php echo form_dropdown( 'worker', prep_key_value('worker_id', 'worker_name', $worker), '1', 'id=worker' ); ?>
			</div>
		</div>

		<div class="control-group">
			<?php echo form_label('Task Name', 'task_name'); ?>
			<div class="controls">
				<?php echo form_input('task_name', "", 'id=task_name' ); ?>
			</div>
		</div>

		<?php
			$for_textarea = array(
				'name' => 'task_description',
				'cols' => '5',
				'rows' => '5',
				'id' => 'task_description'
			);
		?>

		<div class="control-group">
			<?php echo form_label('Description', 'task_description'); ?>
			<div class="controls">
				<?php echo form_textarea( $for_textarea ); ?>
			</div>
		</div>

		<div class="control-group">
			<?php echo form_label('End date', 'task_deadline'); ?>
			<div class="controls">
				<?php echo form_input('task_deadline', "2012-06-15", 'id=task_deadline' ); ?>
			</div>
		</div>

	</div>


	<div class="modal-footer">
		<a href="#" class="btn btn-success">Submit</a>
		<a href="#" class="btn" data-dismiss="modal">Close</a>
	</div>

</div>
