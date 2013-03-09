<?php

/**
*
*/
class Main_m extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
// Выборка из БД по таблице имя которой приходит
	public function get_data($table)
	{
		// $this->db->select($column)->from($table);
		return $this->db->get($table)->result_array();
	}
// Выборка из БД по задачам
	public function get_tasks()
	{
		return $this->db->query(
								'	SELECT t.task_id,
									       t.structure_id,
									       t.division_id,
									       t.task_importance,
									       t.task_responsible_worker,
									       t.task_name,
									       t.task_description,
									       t.task_deadline,
									       t.task_made,
									       w.worker_name,
									       w.worker_sure_name,
									       s.structure_name,
									       d.division_name
									FROM task AS t
									LEFT JOIN worker AS w ON t.task_responsible_worker = w.worker_id
									LEFT JOIN structure AS s ON t.structure_id = s.structure_id
									LEFT JOIN division AS d ON t.division_id = d.division_id '
								)->result_array();
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

/*
*END of Main_m class
*EOF main_m.php
*Loaction: ./application/models/main_m.php
*/
