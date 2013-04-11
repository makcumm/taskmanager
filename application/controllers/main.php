<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * To change this template use File | Settings | File Templates.
*/
class Main extends MY_Controller {

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
			$this->data['error'] = "You haven't access permissions." . anchor('login/', 'Log in please!');

			$this->_render( 'pages/helpers/strickt_access' );

      redirect('login');
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

}

//EOF application/controllers/main.php
