<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * To change this template use File | Settings | File Templates.
 */
class Login extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		//debug
		// $this->output->enable_profiler(TRUE);

		//load model
		$this->load->model('login_model');
	}

	function index()
	{
		$this->_render('pages/login_view');
	}

	function sign_in()
	{
		$error = FALSE;
		$success = FALSE;

		if ($this->input->post('submit'))
		{
			$validation_rules = array(
				array(
					'field' => 'email',
					'label' => 'Email',
					'rules' => 'trim|required|valid_email'
				),
				array(
					'field' => 'password',
					'label' => 'Password',
					'rules' => 'trim|required'
				)
			);

			$this->form_validation->set_rules($validation_rules);

			if ($this->form_validation->run())
			{
				$email = $this->input->post( 'email' );
				$password = $this->input->post( 'password' );

				if ( $this->login_model->getUser( $email, $password ) )
				{
					$success = 'Вы успешно вошли';
					$session_data = array(
						'user_email' => $email,
						'is_logged_in' => TRUE

					);

					$this->session->set_userdata( $session_data );
					redirect( 'main/' );
				}
				else
				{
					$error = "Неверный логин или пароль";
				}

			}
			else
			{
				$error = validation_errors();
			}
		}

		$this->data = array(
			'error' => $error,
			'success' => $success
		);

		$this->_render( 'pages/login_view' );

	}

	function user_exit()
	{
		$this->session->sess_destroy();
		redirect( 'login/sign_in' );
	}

}


//EOF application/controllers/login.php
