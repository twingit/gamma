<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pokes extends CI_Controller {

	function __construct() {

		parent::__construct();
		$this->load->model('User');
		$this->load->model('Poke');

	}

	function index() {

		$data['current_user'] = $this->session->userdata('user_info');
		// $this->load->view('/pokes/pokes', $data);
		// What's going on above:
		// $user = $this->session->userdata('user_info');
		// $this->load->view('/pokes/pokes', array('user' => $user));
		$data['users'] = $this->User->get_all_users();
		$data['poked_count'] = $this->Poke->count_people_poked();
		$data['poked_by_count'] = $this->Poke->count_people_poked_by();
		$data['pokers'] = $this->Poke->get_user_poker_counts();
		$data['pokeds'] = $this->Poke->get_user_poked_counts();
		$data['pokes'] = $this->Poke->get_all_poke_counts();
		$this->load->view('/pokes/pokes', $data);

	}

	function create($id) {

		$this->Poke->create_poke($id);
		redirect('pokes');

	}

}

?>