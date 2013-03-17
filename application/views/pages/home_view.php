<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Максим
 * Date: 27.05.12
 * Time: 19:28
 * To change this template use File | Settings | File Templates.
 */

?>

<div class="container">
	<section>
		<div class="page-header">
			<h1>Менеджер задач для предприятия</h1>
			<button type="button" id="create-user" class="btn pull-right" />Добавить задачу</button>
		</div>
	</section>

	<?php echo $this->load->view('pages/helpers/see_tasks_view'); ?>
	<?php echo $this->load->view('pages/helpers/create_task_view'); ?>
<?php echo $this->load->view('pages/helpers/edit_task_view'); ?>
		<div class="container">

			<section>
