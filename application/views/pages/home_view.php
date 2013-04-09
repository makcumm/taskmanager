<?php
/**
 * To change this template use File | Settings | File Templates.
 */

?>

<div class="container">
	<section>
		<div class="page-header">
			<h1>Менеджер задач для предприятия</h1>
			<button type="button" id="create-user" class="btn" data-toggle="modal" href="#example" />New task</button>
		</div>
	</section>

	<?php echo $this->load->view('pages/helpers/see_tasks_view'); ?>
	<?php echo $this->load->view('pages/helpers/create_task_view'); ?>
	<?php echo $this->load->view('pages/helpers/edit_task_view'); ?>

<div>
