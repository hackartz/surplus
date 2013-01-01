<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chk_login extends CI_Session {

	public $is_login = false;

	public function __construct() {
		parent::__construct();
		$this->is_logged_in();
	}

	public function is_logged_in() {
		$login = $this->userdata('is_login');
		$this->is_login = ($login) ? true : false;
	}

}
