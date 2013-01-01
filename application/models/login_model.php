<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	function verify_admin($username,$password) {
		$salt = base64_encode('secret');
		$hash_password = hash('sha256',$salt.$password);
		$query = $this
					->db
					->where('username',$username)
					->where('password',$hash_password)
					->limit(1)
					->get('surplus_admin');
		if ($query->num_rows > 0) {
			return true;
		}
	}

}

/* End of file login_model.php */
/* Location: ./application/models/login_model.php */