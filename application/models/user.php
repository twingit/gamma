<?php

class User extends CI_Model {

	function create_user($post_params) {

		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('alias', 'Alias', 'trim|required|is_unique[users.alias]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|matches[password_confirmation]');
		$this->form_validation->set_rules('password_confirmation', 'Password Confirmation', 'trim|required');
		$this->form_validation->set_rules('dob', 'Date of Birth', 'trim|required');

		if ($this->form_validation->run() === FALSE) {
			
			// $errors = validation_errors(); // no need to store in a variable
			$this->session->set_flashdata('errors', validation_errors());
			// redirect('/'); // Not necessary? ... (Because can't redirect from model?)
			return false;

		} else {
			
			$query = "INSERT INTO users (name, alias, email, password, password_confirmation, dob, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
			$values = array($post_params['name'], $post_params['alias'], $post_params['email'], $post_params['password'], $post_params['password_confirmation'], $post_params['dob'], date("Y-m-d, H:i:s"), date("Y-m-d, H:i:s"));
			$this->db->query($query, $values); // Don't return here or you won't get to the flashdata!
			$this->session->set_flashdata('success', 'You have successfully registered!');
			// redirect('/'); // Not necessary? ... (Because can't redirect from model?)

		}

	}

	function get_user($user) {

		// return $this->db->query("SELECT * FROM users WHERE email = ?", array($user))->row_array();
		$query = "SELECT * FROM users WHERE email = ? AND password = ?";
		$values = array($user['email'], $user['password']);
		return $this->db->query($query, $values)->row_array();

	}

	function get_all_users() {

		return $this->db->query("SELECT * FROM users")->result_array();

	}
	
}

?>