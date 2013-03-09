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

<div class="row">

	<div class="span12">

		<div id="gallery" data-toggle="modal-gallery" data-target="#modal-gallery">

							<a href="http://taskmanager.loc/resources/images/gallery/001.png" rel="gallery">

					<img src="http://taskmanager.loc/resources/images/gallery/001.png">

				</a>

							<a href="http://taskmanager.loc/resources/images/gallery/002.png" rel="gallery">

					<img src="http://taskmanager.loc/resources/images/gallery/002.png">

				</a>

							<a href="http://taskmanager.loc/resources/images/gallery/003.png" rel="gallery">

					<img src="http://taskmanager.loc/resources/images/gallery/003.png">

				</a>

							<a href="http://taskmanager.loc/resources/images/gallery/004.png" rel="gallery">

					<img src="http://taskmanager.loc/resources/images/gallery/004.png">

				</a>

							<a href="http://taskmanager.loc/resources/images/gallery/005.png" rel="gallery">

					<img src="http://taskmanager.loc/resources/images/gallery/005.png">

				</a>

							<a href="http://taskmanager.loc/resources/images/gallery/006.png" rel="gallery">

					<img src="http://taskmanager.loc/resources/images/gallery/006.png">

				</a>

					</div>

	</div>

</div>

<!-- modal-gallery is the modal dialog used for the image gallery -->

<div id="modal-gallery" class="modal modal-gallery hide fade">

    <div class="modal-header">

        <a class="close" data-dismiss="modal">&times;</a>

        <h3 class="modal-title"></h3>

    </div>

    <div class="modal-body"><div class="modal-image"></div></div>

    <div class="modal-footer">

        <a class="btn btn-primary modal-next">Next <i class="icon-arrow-right icon-white"></i></a>

        <a class="btn btn-info modal-prev"><i class="icon-arrow-left icon-white"></i> Previous</a>

        <a class="btn btn-success modal-play modal-slideshow" data-slideshow="5000"><i class="icon-play icon-white"></i> Slideshow</a>

        <a class="btn modal-download" target="_blank"><i class="icon-download"></i> Download</a>

    </div>

</div>

</div>