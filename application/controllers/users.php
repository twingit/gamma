<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	function __construct() {

		parent::__construct();
		$this->load->model('User');

	}

	function index() {

		$this->load->view('users/users');

	}

	function register() {

		// $post_params = array(

		// 	'name' => $this->input->post('name'),
		// 	'alias' => $this->input->post('alias'),
		// 	'email' => $this->input->post('email'),
		// 	'password' => $this->input->post('password'),
		// 	'password_confirmation' => $this->input->post('password_confirmation'),
		// 	'dob' => $this->input->post('dob')

		// );

		// Instead of the above, we can grab all the user post info in ONE LINE. (See below.)
		// So, the following says: grab all the user post info from the form and use the create_user function in the model to create user

		$this->User->create_user($this->input->post());
		redirect('/');

		// Moved form validations to User model (keeps the controller lean!)

	}

	function login() {

		$current_user = $this->User->get_user($this->input->post());
		
		if ($current_user) {
			
			$this->session->set_userdata('user_info', $current_user);
			redirect('/pokes');

		} else {
			
			$this->session->set_flashdata('login_error', 'Invalid email/password combination');
			redirect('/');

		}

	}

	function logout() {

		$this->session->sess_destroy();
		redirect('/'); // redirect(base_url('/'));

	}

}

?>