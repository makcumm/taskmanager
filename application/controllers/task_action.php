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
			$type = $this->input->post('type');
			$message = $this->task_action_model->task_validate($type);
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
}

//EOF application/controllers/task_action.php
