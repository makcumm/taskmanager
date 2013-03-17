<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * To change this template use File | Settings | File Templates.
*/
class main extends MY_Controller {

	private $error = FALSE;
	private $success = FALSE;

	private $page = FALSE;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('main_m');//load my MODEL main_m
	}

	public function index()
	{
		if ( $this->is_logged_in() === FALSE )
		{
			$this->data['error'] = "У вас нет прав для просмотра данной страницы." . anchor('login/', 'Войдите!');

			$this->_render( 'pages/helpers/strickt_access' );
		}
		else
		{
			$this->data['title'] = 'Task manager';
			$this->data['tasks'] = $this->main_m->get_tasks();
			$this->data['structure'] = $this->main_m->get_data('structure');
			$this->data['division'] = $this->main_m->get_data('division');
			$this->data['worker']	= $this->main_m->get_data('worker');

			$this->_render('pages/home_view');
		}
	}

	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');

		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	function add_task()
	{
		if ( $this->input->post( 'ajax' ) )
		{
			$validation_rules = array(
				array(
					'field' => 'structure',
					'label' => 'Структура',
					'rules' => 'required|numeric'
				),
				array(
					'field' => 'division',
					'label' => 'Подразделение',
					'rules' => 'required|numeric'
				),
				array(
					'field' => 'importance',
					'label' => 'Приоритет',
					'rules' => 'trim'
				),
				array(
					'field' => 'worker',
					'label' => 'Ответственный',
					'rules' => 'required|numeric'
				),
				array(
					'field' => 'task_name',
					'label' => 'Название задачи',
					'rules' => 'required|trim|xss_clean'
				),
				array(
					'field' => 'task_description',
					'label' => 'Описание задачи',
					'rules' => ''
				),
				array(
					'field' => 'task_deadline',
					'label' => 'Дата окончания',
					'rules' => ''
				)
			);

			$this->form_validation->set_rules( $validation_rules );

			$message = array();

			if ( $this->form_validation->run() == TRUE )
			{
				$this->main_m->add_task();

				$message = array(
					'status' => "ok",
					'message' => "Задача добавлена"
				);
			}
			else
			{
				$message = array(
					'status' => "error",
					'structure' => form_error( 'structure', '<p class="alert alert-error">', '</p>' ),
					'division' => form_error( 'division', '<p class="alert alert-error">', '</p>' ),
					'importance' => form_error( 'importance', '<p class="alert alert-error">', '</p>' ),
					'worker' => form_error( 'worker', '<p class="alert alert-error">', '</p>' ),
					'task_name' => form_error( 'task_name', '<p class="alert alert-error">', '</p>' ),
					'task_description' => form_error( 'task_description', '<p class="alert alert-error">', '</p>' ),
					'task_deadline' => form_error( 'task_deadline', '<p class="alert alert-error">', '</p>' )
				);
			}
			echo json_encode( $message );
		}
	}

	function task_remove()
	{
		if ( $this->input->post( 'ajax' ) )
		{
			$task_id = $this->input->post( 'task_id' );

			if ( $this->main_m->task_remove( $task_id ) )
			{
				echo json_encode( array( 'status' => 'ok' ) );
			}
			else
			{
				echo json_encode( array( 'status' => 'error' ) );
			}
		}
	}

	function task_made()
	{
		if ( $this->input->post( 'ajax' ) )
		{
			$task_id = $this->input->post( 'task_id' );
			$status = $this->input->post( 'status' );

			if ( $this->main_m->task_made( $task_id, $status ) )
			{
				echo json_encode( array( 'status' => 'ok' ) );
			}
			else
			{
				echo json_encode( array( 'status' => 'error' ) );
			}
		}
	}

	function task_edit()
	{
//		$this->output->enable_profiler(TRUE);
		if ( $this->input->post( 'ajax' ) )
		{
			$valid_rules = array(
				array(
					'field' => 'structure',
					'label' => 'Структура',
					'rules' => 'required|numeric'
				),
				array(
					'field' => 'division',
					'label' => 'Подразделение',
					'rules' => 'required|numeric'
				),
				array(
					'field' => 'importance',
					'label' => 'Приоритет',
					'rules' => 'trim'
				),
				array(
					'field' => 'worker',
					'label' => 'Ответственный',
					'rules' => 'required|numeric'
				),
				array(
					'field' => 'task_name',
					'label' => 'Название задачи',
					'rules' => 'required|trim|xss_clean'
				),
				array(
					'field' => 'task_description',
					'label' => 'Описание задачи',
					'rules' => ''
				),
				array(
					'field' => 'task_deadline',
					'label' => 'Дата окончания',
					'rules' => ''
				)
			);

			$this->form_validation->set_rules( $valid_rules );

			$message = array();

			if ( $this->form_validation->run() == TRUE )
			{
				$this->main_m->task_edit();

				$message = array(
					'status' => "ok",
					'message' => "Задача иземнена"
				);
//				redirect( 'main' );
			}
			else
			{
				$message = array(
					'status' => "error",
					'structure' => form_error( 'structure', '<p class="alert alert-error">', '</p>' ),
					'division' => form_error( 'division', '<p class="alert alert-error">', '</p>' ),
					'importance' => form_error( 'importance', '<p class="alert alert-error">', '</p>' ),
					'worker' => form_error( 'worker', '<p class="alert alert-error">', '</p>' ),
					'task_name' => form_error( 'task_name', '<p class="alert alert-error">', '</p>' ),
					'task_description' => form_error( 'task_description', '<p class="alert alert-error">', '</p>' ),
					'task_deadline' => form_error( 'task_deadline', '<p class="alert alert-error">', '</p>' )
				);
			}
			echo json_encode( $message );
		}
	}

	/*function load_template()
	{
		$this->data['template_data'] = $this->error;
		$this->_render( $this->page );

//		exit();
	}*/

}

//EOF application/controllers/main.php
