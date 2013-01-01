<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if ($this->chk_login->is_login) {
			redirect(base_url().'dashboard');
		}
		else {
			$this->load->view('view_login');
		}
	}

	function login() {
		$this->load->model('login_model');
		$result = $this
					->login_model
					->verify_admin($this->input->post('username'),
						$this->input->post('password')
				);
		if ($result) {
			//valid member
			$username = $this->input->post('username');
			$this->db->query("UPDATE surplus_admin SET last_login_time=now() WHERE username='$username'");

			$session_data = array(
				'admin' => $this->input->post('username'),
				'is_login' => true
			);
			$this->session->set_userdata($session_data);
			redirect(base_url().'dashboard');
		} else {
			$this->index();
		}
	}

}

/* End of file site.php */
/* Location: ./application/controllers/site.php */