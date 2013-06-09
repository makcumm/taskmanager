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
}

/*
*END of Main_m class
*EOF main_m.php
*Loaction: ./application/models/main_m.php
*/
