<?php
/**
 * To change this template use File | Settings | File Templates.
 */
?>
<section>
	<div class="row">
		<div class="span12">
			<h2>Задачи</h2>
			<div id="msg-success" style="display: none;" class="alert alert-success"></div>
			<div id="msg-error" style="display: none;" class="alert alert-error"></div>
			<div id="task">
				<table class="table">
					<thead> <!-- otput table header -->
					<tr>
						<th class="sort" rel="structure">Структура</th>
						<th class="sort" rel="division">Подразделение</th>
						<th><!--Приоритет--></th>
						<th class="sort" rel="worker_name">Ответственный</th>
						<th class="sort" rel="task_name">Название</th>
						<th class="sort" rel="task_description">Описание</th>
						<th class="sort" rel="task_deadline">Дата окончания</th>
						<th>
							 <input type="text" class="search" placeholder="Искать" />
						</th>
					</tr>
					</thead>
					<tbody class="list"> <!-- otput table body -->
					<?php foreach ($tasks as $task_value) : ?>
						<?php
						switch ( $task_value['task_importance'] )
						{

							case 'high':
								$style = ' class="icon-arrow-up"';
								break;

							case 'normal':
								$style = ' class="icon-minus"';
								break;

							case 'low':
								$style = ' class="icon-arrow-down"';
								break;

						}
						?>

						<?php if ( $task_value['task_made'] == "yes" ) : ?>
							<tr class="task_made">
						<?php else : ?>
							<tr>
						<?php endif; ?>

						<td class="structure" style="width: 70px;">
							<?=$task_value['structure_name']?>
						</td>

						<td class="division" style="width: 100px;">
							<?=$task_value['division_name']?>
						</td>

						<td style="width: 15px;">
							<i <?php echo $style; ?>></i>
						</td>

						<td class="worker_name" style="width: 100px;">
							<?=$task_value['worker_name'] . " " . $task_value['worker_sure_name']?>
						</td>

							<td class="task_name" task_name="<?php echo $task_value['task_id']; ?>" style="width: 150px;">
								<?=$task_value['task_name']?>
							</td>

						<td class="task_description" style="width: 200px;" task_description="<?php echo $task_value['task_id']; ?>">
							<?=$task_value['task_description']?>
						</td>

						<td class="task_deadline" style="width: 100px;">
							<?=date("d.m.Y", strtotime($task_value['task_deadline']))?>
						</td>

						<td style="width: 80px;">
							<ul>
								<li id="task_edit" task_id="<?php echo $task_value['task_id']; ?>" class="icon-pencil" title="Изменить" style="cursor: pointer;" onclick="task_edit(<?php echo $task_value['task_id']; ?>);"></li>
								<li task_id="<?php echo $task_value['task_id']; ?>" class="icon-ok" title="Выполнено" style="cursor: pointer;"></li>
								<li task_id="<?php echo $task_value['task_id']; ?>" class="icon-remove" title="Удалить" style="cursor: pointer;"></li>
							</ul>
						</td>
					</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	/*
		  * CONTACT LIST
		  */

	// Define value names
	var templates = {
		valueNames: [ 'structure', 'division', 'worker_name', 'task_name', 'task_description', 'task_deadline' ]
	};

	// Init list
	var contactList = new List('task', templates);

//	var structureField = $('#structure-field'),
//		divisionField = $('#division-field'),
//		workernameField = $('#workername-field'),
//		tasknameField = $('#taskname-field'),
//		taskdescriptionField = $('#taskdescription-field'),
//		taskdeadlineField = $('#taskdeadline-field');
</script>
