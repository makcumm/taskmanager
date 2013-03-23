<?php
/**
 * To change this template use File | Settings | File Templates.
 */
// TODO: чтобы выводить добавленые задачи, в контроллере дописать в JSON данные из БД новой задачи, отрисовать их во viewe
?>

<script type="text/javascript">
	$(document).ready( function() {
		var task_description = $( "#task_description" ),
			task_name = $( "#task_name" ),
			task_deadline = $( "#task_deadline" )
		allFields = $( [] ).add( task_description ).add( task_name).add( task_deadline );


		$( ".btn-success").click( function () {
			var task_data = {
				structure: $( "#structure").val(),
				division: $( "#division").val(),
				importance: $( "#importance").val(),
				worker: $( "#worker").val(),
				task_name: $( "#task_name").val(),
				task_description: $( "#task_description").val(),
				task_deadline: $( "#task_deadline").val(),
				ajax: '1'
			};

			$.ajax( {
				url: "<?php echo site_url( 'main/add_task' )?>",
				type: 'POST',
				data: task_data,
				dataType: "json",
				success: function( response ) {
					if ( response.status == "ok" )
					{
						$("#msg").removeAttr('style').html( '<button class="close" data-dismiss="alert">x</button>' + response.message );
						$( "#dialog-form").dialog( "close" );
						window.location.href="<?php site_url( 'main' )?>";
					}
					else
					{
						$( response.structure ).insertAfter( "#structure" );
						$( response.division ).insertAfter( "#division" );
						$( response.importance ).insertAfter( "#importance" );
						$( response.worker ).insertAfter( "#worker" );
						$( response.task_name ).insertAfter( "#task_name" );
						$( response.task_description ).insertAfter( "#task_description" );
						$( response.task_deadline ).insertAfter( "#task_deadline" );
					}
				}
			} );

			return false;
		} );
	} );
</script>


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

<!--
<section>
	<div id="dialog-form2" title="Изменить задачу">
		<div>
			<div>
				<?php /*echo form_open(current_url(), 'class="form-horizontal"'); */?>
				<?php /*echo form_fieldset(); */?>


				<?php
/*				$label_attr = array(
					'class' => 'control-label'
				);
				*/?>
				<div class="control-group">
					<?php /*echo form_label('Структура', 'structure', $label_attr); */?>
					<div class="controls">
						<?php /*echo form_dropdown( 'structure', prep_key_value('structure_id', 'structure_name', $structure), '1', 'id=structure' );*/?>
					</div>
				</div>

				<div class="control-group">
					<?php /*echo form_label('Подразделение', 'division', $label_attr); */?>
					<div class="controls">
						<?php /*echo form_dropdown( 'division', prep_key_value('division_id', 'division_name', $division), '1', 'id=division' );*/?>
					</div>
				</div>

				<div class="control-group">
					<?php /*echo form_label('Приоритет', 'importance', $label_attr); */?>
					<div class="controls">
						<?php /*$importance_arr = array('high' => 'high', 'normal' => 'normal', 'low' => 'low'); */?>
						<?php /*echo form_dropdown( 'importance', $importance_arr, '1', 'id=importance' ); */?>
					</div>
				</div>

				<div class="control-group">
					<?php /*echo form_label('Ответственный', 'worker', $label_attr); */?>
					<div class="controls">
						<?php /*echo form_dropdown( 'worker', prep_key_value('worker_id', 'worker_name', $worker), '1', 'id=worker' ); */?>
					</div>
				</div>

				<div class="control-group">
					<?php /*echo form_label('Название', 'task_name', $label_attr); */?>
					<div class="controls">
						<?php /*echo form_input('task_name', "", 'id=task_name' ); */?>
					</div>
				</div>


				<?php
/*				$for_textarea = array(
					'name' => 'task_description',
					'cols' => '5',
					'rows' => '5',
					'id' => 'task_description'
				);
				*/?>
				<div class="control-group">
					<?php /*echo form_label('Описание задачи', 'task_description', $label_attr); */?>
					<div class="controls">
						<?php /*echo form_textarea( $for_textarea ); */?>
					</div>
				</div>

				<div class="control-group">
					<?php /*echo form_label('Дата окончания', 'task_deadline', $label_attr); */?>
					<div class="controls">
						<?php /*echo form_input('task_deadline', "2012-06-15", 'id=task_deadline' ); */?>
					</div>
				</div>


				<?php /*echo form_submit( array( 'name' => 'task_edit', 'class' => 'btn btn-small', 'id' => 'submit_edit' ), 'Добавить задачу' ) */?>
				<?php /*echo form_fieldset_close(); */?>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</section>-->
