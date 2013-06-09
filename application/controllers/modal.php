<?php

class Modal extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('modal_model');
		$this->load->model('main_m');
	}

	public function open_modal_window()
	{
		if ( $this->input->post('type') === "add_task" )
		{
			$this->data['modal_title'] = 'Add new task';
			$this->data['form_action'] = 'task_action/add_task';
			$this->data['structure'] = $this->main_m->get_data('structure');
			$this->data['division'] = $this->main_m->get_data('division');
			$this->data['worker']	= $this->main_m->get_data('worker');
			$this->data['type'] = 'add';

			echo $this->load->view( 'pages/helpers/modal_view', $this->data, TRUE );
			exit();
		}
		if ( $this->input->post('type') === "edit_task" )
		{
			// $this->modal_model->get_task_data_by_id();
			$this->data['modal_title'] = 'Edit new task';
			$this->data['form_action'] = 'task_action_modal/task_edit';
			$this->data['structure_id'] = $this->modal_model->get_task_data_by_id('structure_id');
			$this->data['structure'] = $this->main_m->get_data('structure');
			$this->data['division'] = $this->main_m->get_data('division');
			$this->data['worker']	= $this->main_m->get_data('worker');
			$this->data['division_id'] = $this->modal_model->get_task_data_by_id('division_id');
			$this->data['worker_id']	= $this->modal_model->get_task_data_by_id('task_responsible_worker');
			$this->data['task_importance']	= $this->modal_model->get_task_data_by_id('task_importance');
			$this->data['task_controle_worker']	= $this->modal_model->get_task_data_by_id('task_controle_worker');
			$this->data['task_performer_worker']	= $this->modal_model->get_task_data_by_id('task_performer_worker');
			$this->data['task_name']	= $this->modal_model->get_task_data_by_id('task_name');
			$this->data['task_description']	= $this->modal_model->get_task_data_by_id('task_description');
			$this->data['task_start_date']	= $this->modal_model->get_task_data_by_id('task_start_date');
			$this->data['task_control_date']	= $this->modal_model->get_task_data_by_id('task_control_date');
			$this->data['task_deadline']	= $this->modal_model->get_task_data_by_id('task_deadline');
			$this->data['task_made']	= $this->modal_model->get_task_data_by_id('task_made');
			$this->data['type'] = 'edit';
			$this->data['task_id'] = $this->input->post('id');

			echo $this->load->view( 'pages/helpers/modal_view', $this->data, TRUE );
			exit();
		}
	}
}
