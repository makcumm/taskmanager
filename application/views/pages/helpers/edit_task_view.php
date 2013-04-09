<?php
/**
 * To change this template use File | Settings | File Templates.
 */
?>
<section>
	<div id="dialog-form2" title="Изменить задачу" style="display: none;">
		<div>
			<div>
				<?php echo form_open(current_url(), 'class="form-horizontal"'); ?>
				<?php echo form_fieldset(); ?>


				<?php
					$label_attr = array('class' => 'control-label');
				?>
				<div class="control-group">
					<?php echo form_label('Структура', 'structure', $label_attr); ?>
					<div class="controls">
						<?php echo form_dropdown( 'structure', prep_key_value('structure_id', 'structure_name', $structure), '1', 'id=structure_edit' );?>
					</div>
				</div>

				<div class="control-group">
					<?php echo form_label('Подразделение', 'division', $label_attr); ?>
					<div class="controls">
						<?php echo form_dropdown( 'division', prep_key_value('division_id', 'division_name', $division), '1', 'id=division_edit' );?>
					</div>
				</div>

				<div class="control-group">
					<?php echo form_label('Приоритет', 'importance', $label_attr); ?>
					<div class="controls">
						<?php $importance_arr = array('high' => 'high', 'normal' => 'normal', 'low' => 'low'); ?>
						<?php echo form_dropdown( 'importance', $importance_arr, '1', 'id=importance_edit' ); ?>
					</div>
				</div>

				<div class="control-group">
					<?php echo form_label('Ответственный', 'worker', $label_attr); ?>
					<div class="controls">
						<?php echo form_dropdown( 'worker', prep_key_value('worker_id', 'worker_name', $worker), '1', 'id=worker_edit' ); ?>
					</div>
				</div>

				<div class="control-group">
					<?php echo form_label('Название', 'task_name', $label_attr); ?>
					<div class="controls">
						<?php echo form_input('task_name', "", 'id=task_edit_name' ); ?>
					</div>
				</div>


				<?php
								$for_textarea = array(
					'name' => 'task_description',
					'cols' => '5',
					'rows' => '5',
					'id' => 'task_edit_description'
				);
				?>
				<div class="control-group">
					<?php echo form_label('Описание задачи', 'task_description', $label_attr); ?>
					<div class="controls">
						<?php echo form_textarea( $for_textarea ); ?>
					</div>
				</div>

				<div class="control-group">
					<?php echo form_label('Дата окончания', 'task_deadline', $label_attr); ?>
					<div class="controls">
						<?php echo form_input('task_deadline', "2012-06-15", 'id=task_edit_deadline' ); ?>
					</div>
				</div>


				<?php echo form_submit( array( 'name' => 'task_edit', 'class' => 'btn btn-small', 'id' => 'submit_edit' ), 'Изменить задачу' ) ?>
				<?php echo form_fieldset_close(); ?>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</section>
