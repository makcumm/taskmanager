<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * To change this template use File | Settings | File Templates.
 */
class Login_model extends CI_Model {

	function getUser( $user_logn = NULL, $user_password = NULL ) {
		$table = 'worker';

		$query = $this->db->select( 'worker_email, worker_password' ) ->
			get_where( $table, array( 'worker_email' => $user_logn, 'worker_password' => md5( $user_password ) ) );

		if ( $query->num_rows == 1 )
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

}

//EOF application/models/login_model.php
