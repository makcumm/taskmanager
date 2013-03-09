<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Максим
 * Date: 17.06.12
 * Time: 19:28
 * To change this template use File | Settings | File Templates.
 */
class Calendar_model extends CI_Model {

	function get_calendar_data($year, $month) {

		$query = $this->db->select('task_deadline, task_name')->from('task')
			->like('task_deadline', "$year-$month", 'after')->get()->result_array();

		$cal_data = array();

		foreach ($query as $row) {
			$cal_data[substr($row['task_deadline'],8,2)] = $row['task_name'];
		}

		return $cal_data;

	}

	function add_calendar_data($date, $data) {

		if ($this->db->select('task_deadline')->from('task')
			->where('task_deadline', $date)->count_all_results()) {

			$this->db->where('task_deadline', $date)
				->update('task', array(
				                          'task_deadline' => $date,
				                          'task_name' => $data
				                     ));

		} else {

			$this->db->insert('task', array(
			                                   'task_deadline' => $date,
			                                   'task_name' => $data
			                              ));
		}
	exit( mysql_error() );
	}

}
