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

	public function task_remove( $id )
	{
		if ( $this->db->delete( 'task', array( 'task_id' => $id ) ) )
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

}

//EOF application/models/task_action_model.php
