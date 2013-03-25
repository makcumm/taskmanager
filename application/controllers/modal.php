<?php

class Modal extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('modal_model');
	}

	public function open_modal_window()
	{
		if ( $this->input->post('open_window') )
		{
			echo $this->load->view( 'pages/helpers/modal_view' );
			exit();
		}
	}

	public function add_task()
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
				$this->modal_model->add_task();

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

			$data['modal_data'] = array(
				'message' => $message
			);
			// echo $this->load->view( 'pages/helpers/modal_view' );
		}
	}

	public function edit_task()
	{
		if ( $this->input->post( 'ajax' ) )
		{
			$task_id = $this->input->post( 'task_id' );

			if ( $this->modal_model->task_remove( $task_id ) )
			{
				echo json_encode( array( 'status' => 'ok' ) );
			}
			else
			{
				echo json_encode( array( 'status' => 'error' ) );
			}
		}
	}

}
