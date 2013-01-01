<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('dashboard_model');
	}

	public function index()
	{
		if ($this->chk_login->is_login) {
			$this->load->library('pagination');
			$config['base_url'] = base_url().'dashboard/index/';
			$config['total_rows'] = $this->db->count_all('surplus_konsumen');
			$config['per_page'] = 10;
			$config['num_links'] = 5;
			$config['next_link'] = 'Next';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['prev_link'] = 'Prev';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';
			$config['full_tag_open'] = '<ul>';
			$config['full_tag_close'] = '</ul>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li><a>';
			$config['cur_tag_close'] = '</a></li>';
			$this->pagination->initialize($config);
			$this->db->select("kode_konsumen,nama_konsumen,alamat,nama_kecamatan,nama_jenis,kebutuhan_air,okupansi");
			$this->db->from("surplus_konsumen");
			$this->db->join('kecamatan','surplus_konsumen.kode_kecamatan=kecamatan.kode_kecamatan');
			$this->db->join('jenis','surplus_konsumen.jenis=jenis.kode_jenis');
			$this->db->order_by("kode_konsumen","desc");
			$this->db->limit($config['per_page'], $this->uri->segment(3));
			$data['client_list'] = $this->db->get();
			$this->load->view('view_dashboard',$data);
		} else {
			redirect(base_url().'site');
		}
	}

	function logout() {
		$this->session->sess_destroy();
		redirect(base_url()."site");
	}

	function list_all_kecamatan() {
		$q = $this->dashboard_model->get_all_kecamatan();
		return $q;	
	}

	function list_all_jenis() {
		$q = $this->dashboard_model->get_all_jenis();
		return $q;	
	}

	function add() {
		if ($this->chk_login->is_login) {
			$data['kec_list'] = $this->list_all_kecamatan();
			$data['jenis_list'] = $this->list_all_jenis();
			$this->load->view('view_dashboard_add',$data);
		} else {
			redirect(base_url().'site');
		}
	}

	function save_client() {
		if ($this->chk_login->is_login) {
			$r = $this->dashboard_model->insert_client();
			if($r) {
				redirect(base_url());
			}
		} else {
			redirect(base_url().'site');
		}	
	}

	function edit_client($id) {
		if ($this->chk_login->is_login) {
			$data['kec_list'] = $this->list_all_kecamatan();
			$data['jenis_list'] = $this->list_all_jenis();
			$data['client'] = $this->dashboard_model->get_client($id);
			$this->load->view('view_dashboard_edit',$data);
		} else {
			redirect(base_url().'site');
		}
	}

	function save_updated_client($id) {
		if ($this->chk_login->is_login) {
			$r = $this->dashboard_model->update_client($id);
			if($r) {
				redirect(base_url());
			}
		} else {
			redirect(base_url().'site');
		}	
	}

	function del_client($id) {
		if ($this->chk_login->is_login) {
			$this->dashboard_model->delete_client($id);
			redirect(base_url());
		} else {
			redirect(base_url().'site');
		}
	}

	function tes() {
		echo "---------------------------------";
		echo "<br>";
		$q = $this->dashboard_model->fetch_kebutuhan_air();
		print_r($q);
		echo "<br>";
		$tot = $this->dashboard_model->get_total_kebair();
		echo $tot;
		echo "<br>";
		$q = $this->dashboard_model->kebair_per_kec();
		print_r($q);
		echo "<br>";
		echo "---------------------------------";
		echo "<br>";
		$q = $this->dashboard_model->fetch_okupansi();
		print_r($q);
		echo "<br>";
		$tot = $this->dashboard_model->get_total_okupansi();
		echo $tot;
		echo "<br>";
		$q = $this->dashboard_model->okupansi_per_kec();
		print_r($q);
		echo "<br>";
		echo "---------------------------------";
		echo "<br>";
		$q = $this->dashboard_model->fetch_jenis();
		print_r($q);
		echo "<br>";
		$tot = $this->dashboard_model->get_total_jenis();
		echo $tot;
		echo "<br>";
		$q = $this->dashboard_model->jenis_per_kec();
		print_r($q);
		echo "<br>";
	}

	function kalkulasi($step="") {
		if(!empty($step)) {
			if ($step == 1) {
				$this->session->set_userdata('okp', $this->input->post('okp'));
				$this->session->set_userdata('keba', $this->input->post('keba'));
				$this->session->set_userdata('jenis', $this->input->post('jenis'));
				$this->session->set_userdata('jmlsurplus', $this->input->post('jmlSp'));
				$data['jml_modal'] = $this->dashboard_model->jml_modal();
				$data['pv_modal'] = $this->dashboard_model->pv_modal();
				$data['l_modal'] = $this->dashboard_model->l_modal();
				$this->load->view('view_kalkulasi',$data);
			}

			if($step == 2) {
				//kalkulasi tahap 2
				
				$data['jml_okupansi'] = $this->dashboard_model->jml_okupansi();
				$data['pv_okupansi'] = $this->dashboard_model->pv_okupansi();
				$data['l_okupansi'] = $this->dashboard_model->l_okupansi();
				$this->load->view('view_kalkulasi_okp',$data);
			}

			if($step == 3) {
				//kalkulasi tahap 3
				$data['jml_keba'] = $this->dashboard_model->jml_keba();
				$data['pv_keba'] = $this->dashboard_model->pv_keba();
				$data['l_keba'] = $this->dashboard_model->l_keba();
				$this->load->view('view_kalkulasi_keba',$data);
			}

			if($step == 4) {
				//kalkulasi tahap 4
				$data['jml_jenis'] = $this->dashboard_model->jml_jenis();
				$data['pv_jenis'] = $this->dashboard_model->pv_jenis();
				$data['l_jenis'] = $this->dashboard_model->l_jenis();
				$this->load->view('view_kalkulasi_jenis',$data);
			}

			if($step == 5) {
				$data['pv_modal'] = $this->dashboard_model->pv_modal();
				$okp = $this->dashboard_model->pv_okupansi();
				$keba = $this->dashboard_model->pv_keba();
				$jenis = $this->dashboard_model->pv_jenis();
				$data['okp'] = $okp;
				$data['keba'] = $keba;
				$data['jenis'] = $jenis;
				$this->load->view('view_ocw',$data);
			}

			if($step == 6) {
				$data['list'] = $this->dashboard_model->get_percent();
				$this->load->view('view_final',$data);
			}

		} else {
			$array_sess = array('okp' => '', 'keba' => '', 'jenis' => '', 'jmlSp' => '');
			$this->session->unset_userdata($array_sess);
			$this->load->view('view_kalkulasi');
		}
	}

	function moretes() {
		$data = array(
			'banyumanik' => 700,
			'candisari' => 350,
			'gajahmungkur' => 30
			);

		foreach ($data as $key => $value) {
			echo $key."<br />";
		}
	}
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */