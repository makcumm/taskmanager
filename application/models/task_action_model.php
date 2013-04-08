<?php

class Task_action_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function add_task()
	{
		$data = array(
			'structure_id'              => $this->input->post( 'structure' ),
			'division_id'               => $this->input->post( 'division' ),
			'task_importance'           => $this->input->post( 'importance' ),
			'task_responsible_worker'   => $this->input->post( 'worker' ),
			'task_name'                 => $this->input->post( 'task_name' ),
			'task_description'          => $this->input->post( 'task_description' ),
			'task_deadline'             => $this->input->post( 'task_deadline' ),
			'task_start_date'           => date( 'Y-m-d' )
		);
		$this->db->insert( 'task', $data );
	}

	public function task_remove()
	{
		$task_id = $this->input->post( 'task_id' );

		if ( $this->db->delete( 'task', array( 'task_id' => $task_id ) ) )
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	public function task_made( $id, $status )
	{
		$query = $this->db->where( 'task_id', $id )->update( 'task', array( 'task_made' => $status ) );
		if ( $query )
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	public function task_edit()
	{
		$id = $this->input->post( 't_id' );

		$data = array(
			'structure_id'              => $this->input->post( 'structure' ),
			'division_id'               => $this->input->post( 'division' ),
			'task_importance'           => $this->input->post( 'importance' ),
			'task_responsible_worker'   => $this->input->post( 'worker' ),
			'task_name'                 => $this->input->post( 'task_name' ),
			'task_description'          => $this->input->post( 'task_description' ),
			'task_deadline'             => $this->input->post( 'task_deadline' ),
			'task_start_date'           => date( 'Y-m-d' )
		);

		$this->db->where( 'task_id', $id );
		$this->db->update( 'task', $data );
	}

	public function task_add_validate()
	{
		$validation_rules = array(
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

		$this->form_validation->set_rules( $validation_rules );

		$message = array();

		if ( $this->form_validation->run() == TRUE )
		{
			$this->add_task();

			$message = array(
				'status' => "ok",
				'message' => "Congratulation! New task added."
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

		return $message;
	}

}

//EOF application/models/task_action_model.php
