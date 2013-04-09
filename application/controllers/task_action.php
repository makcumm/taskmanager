<?php

class Task_action extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('task_action_model');
	}

	function add_task()
	{
		if ( $this->input->post( 'ajax' ) )
		{
			$message = $this->task_action_model->task_add_validate();
			echo json_encode( $message );
		}
	}

	function task_remove()
	{
		if ( $this->input->post( 'ajax' ) )
		{
			if ( $this->task_action_model->task_remove() )
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
			if ($this->task_action_model->task_made())
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
					'label' => 'Structure',
					'rules' => 'required|numeric'
				),
				array(
					'field' => 'division',
					'label' => 'Division',
					'rules' => 'required|numeric'
				),
				array(
					'field' => 'importance',
					'label' => 'Priority',
					'rules' => 'trim'
				),
				array(
					'field' => 'worker',
					'label' => 'Responsible',
					'rules' => 'required|numeric'
				),
				array(
					'field' => 'task_name',
					'label' => 'Task Name',
					'rules' => 'required|trim|xss_clean'
				),
				array(
					'field' => 'task_description',
					'label' => 'Description',
					'rules' => ''
				),
				array(
					'field' => 'task_deadline',
					'label' => 'End date',
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
					'message' => "Task updated."
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

}

//EOF application/controllers/task_action.php
