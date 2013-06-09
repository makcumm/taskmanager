<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modal_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}

  public function get_task_data_by_id( $type )
  {
    $task_id  = $this->input->post( 'id' );
    $query = $this->db->get_where('task', array('task_id' => $task_id))->row_array();
    return $query[$type];
  }
}
