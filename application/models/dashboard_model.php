<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

	public $okp;
	public $keba;
	public $jenis;

	public function __construct()
	{
		parent::__construct();
		
	}

	function get_all_kecamatan() {
		$query = $this->db->get('kecamatan');
		return $query;
	}

	function get_all_jenis() {
		$query = $this->db->get('jenis');
		return $query;
	}

	function get_client($kode_konsumen) {
		$this->db->where('kode_konsumen',$kode_konsumen);
		$query = $this->db->get('surplus_konsumen',1);
		return $query;
	}

	/* ------------------------------------- Manage data konsumen ------------------------------------- */

	function insert_client() {
		$nama_konsumen = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$kecamatan = $this->input->post('kecamatan');
		$jenis = $this->input->post('jenis');
		$kebutuhan_air = $this->input->post('kebair');
		$okupansi = $this->input->post('okupansi');
		$data = array(
			'nama_konsumen' => $nama_konsumen,
			'alamat' => $alamat,
			'kode_kecamatan' => $kecamatan,
			'jenis' => $jenis,
			'kebutuhan_air' => $kebutuhan_air,
			'okupansi' => $okupansi
		);

		$res = $this->db->insert('surplus_konsumen',$data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	function update_client($kode_konsumen) {
		$nama_konsumen = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$kecamatan = $this->input->post('kecamatan');
		$jenis = $this->input->post('jenis');
		$kebutuhan_air = $this->input->post('kebair');
		$okupansi = $this->input->post('okupansi');
		$data = array(
			'nama_konsumen' => $nama_konsumen,
			'alamat' => $alamat,
			'kode_kecamatan' => $kecamatan,
			'jenis' => $jenis,
			'kebutuhan_air' => $kebutuhan_air,
			'okupansi' => $okupansi
		);
		$this->db->where('kode_konsumen',$kode_konsumen);
		$res = $this->db->update('surplus_konsumen',$data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	function delete_client($id) {
		$this->db->delete('surplus_konsumen',array('kode_konsumen'=>$id));
	}

	/* ------------------------------------- start calculation ------------------------------------- */
	//kebutuhan air
	function fetch_kebutuhan_air() {
		$this->db->select('nama_kecamatan');
		$this->db->select_sum('kebutuhan_air');
		$this->db->from('surplus_konsumen');
		$this->db->join('kecamatan','surplus_konsumen.kode_kecamatan=kecamatan.kode_kecamatan');
		$this->db->group_by('surplus_konsumen.kode_kecamatan');
		$list = $this->db->get();
		
		foreach ($list->result() as $row) {
			$kec[$row->nama_kecamatan] = $row->kebutuhan_air;
		}
		return $kec;
	}

	function get_total_kebair() {
		$total = 0;
		$q = $this->fetch_kebutuhan_air();
		foreach ($q as $key=>$value) {
			$total = $total + $value;
		}
		return $total;
	}

	function kebair_per_kec() {
		$total = $this->get_total_kebair();
		$kec = $this->fetch_kebutuhan_air();
		foreach ($kec as $key=>$value) {
			$kk[$key] = number_format(($value * 100) / $total,2);
		}
		return $kk;
	}
	//okupansi
	function fetch_okupansi() {
		$this->db->select('nama_kecamatan');
		$this->db->select_sum('okupansi');
		$this->db->from('surplus_konsumen');
		$this->db->join('kecamatan','surplus_konsumen.kode_kecamatan=kecamatan.kode_kecamatan');
		$this->db->group_by('surplus_konsumen.kode_kecamatan');
		//$this->db->limit('5');
		$list = $this->db->get();
		
		foreach ($list->result() as $row) {
			$kec[$row->nama_kecamatan] = $row->okupansi;
		}
		return $kec;
	}

	function get_total_okupansi() {
		$total = 0;
		$q = $this->fetch_okupansi();
		foreach ($q as $key=>$value) {
			$total = $total + $value;
		}
		return $total;
	}

	function okupansi_per_kec() {
		$total = $this->get_total_okupansi();
		$kec = $this->fetch_okupansi();
		foreach ($kec as $key=>$value) {
			$ok[$key] = number_format(($value * 100) / $total,2);
		}
		return $ok;
	}
	//jenis
	function fetch_jenis() {
		$this->db->select('nama_kecamatan');
		$this->db->select_sum('jenis');
		$this->db->from('surplus_konsumen');
		$this->db->join('kecamatan','surplus_konsumen.kode_kecamatan=kecamatan.kode_kecamatan');
		$this->db->join('jenis','surplus_konsumen.jenis=jenis.kode_jenis');
		$this->db->group_by('surplus_konsumen.kode_kecamatan');
		$list = $this->db->get();
		
		foreach ($list->result() as $row) {
			$kec[$row->nama_kecamatan] = $row->jenis;
		}
		return $kec;
	}

	function get_total_jenis() {
		$total = 0;
		$q = $this->fetch_jenis();
		foreach ($q as $key=>$value) {
			$total = $total + number_format((1/$value),2);
		}
		return $total;
	}

	function jenis_per_kec() {
		$total = $this->get_total_jenis();
		$kec = $this->fetch_jenis();
		foreach ($kec as $key=>$value) {
			$jk[$key] = number_format(((1/$value) * 100) / $total,2);
		}
		return $jk;
	}

	/* ------------------------------------- start main calculation ------------------------------------- */

	/*function set_global() {
		$okp = $this->okp;
		$keba = $this->keba;
		$jenis = $this->jenis;
	}*/

	function jml_modal() {
		error_reporting(0);
		$data['okupansi'] = $this->session->userdata('okp');
		$data['kebutuhan_air'] = $this->session->userdata('keba');
		$data['jenis'] = $this->session->userdata('jenis');

		foreach ($data as $key1 => $value1) {
			foreach ($data as $key2 => $value2) {
				$jml[$key1] = $jml[$key1] + ($value1/$value2);
			}			
		}
		return $jml;
	}

	function pv_modal() {
		error_reporting(0);
		$data['okupansi'] = $this->session->userdata('okp');
		$data['kebutuhan_air'] = $this->session->userdata('keba');
		$data['jenis'] = $this->session->userdata('jenis');
		$jml = $this->jml_modal();
		foreach ($data as $key1 => $value1) {
			foreach ($data as $key2 => $value2) {
				$tmp[$key1] = $tmp[$key1] + ($value2/$value1)/$jml[$key2]." ";
			}
			$pv[$key1] = ($tmp[$key1] /3);
		}
		return $pv;
	}

	function l_modal() {
		error_reporting(0);
		$data['okupansi'] = $this->session->userdata('okp');
		$data['kebutuhan_air'] = $this->session->userdata('keba');
		$data['jenis'] = $this->session->userdata('jenis');
		return $data;
	}

	function jml_okupansi() {
		error_reporting(0);
		$data = $this->okupansi_per_kec();
		foreach ($data as $key1 => $value1) {
			foreach ($data as $key2 => $value2) {
				$jml[$key1] = $jml[$key1] + ($value1/$value2);
			}			
		}
		return $jml;
	}

	function pv_okupansi() {
		error_reporting(0);
		$jml = $this->jml_okupansi();
		$data = $this->okupansi_per_kec();
		foreach ($data as $key1 => $value1) {
			foreach ($data as $key2 => $value2) {
				$tmp[$key1] = $tmp[$key1] + ($value2/$value1)/$jml[$key2]." ";
			}
			$pv[$key1] = ($tmp[$key1] /3);
		}
		return $pv;
	}

	function l_okupansi() {
		error_reporting(0);
		$data = $this->okupansi_per_kec();
		return $data;
	}

	function jml_keba() {
		error_reporting(0);
		$data = $this->kebair_per_kec();
		foreach ($data as $key1 => $value1) {
			foreach ($data as $key2 => $value2) {
				$jml[$key1] = $jml[$key1] + ($value1/$value2);
			}			
		}
		return $jml;
	}

	function pv_keba() {
		error_reporting(0);
		$jml = $this->jml_keba();
		$data = $this->kebair_per_kec();
		foreach ($data as $key1 => $value1) {
			foreach ($data as $key2 => $value2) {
				$tmp[$key1] = $tmp[$key1] + ($value2/$value1)/$jml[$key2]." ";
			}
			$pv[$key1] = ($tmp[$key1] /3);
		}
		return $pv;
	}

	function l_keba() {
		error_reporting(0);
		$data = $this->kebair_per_kec();
		return $data;
	}

	function jml_jenis() {
		error_reporting(0);
		$data = $this->jenis_per_kec();
		foreach ($data as $key1 => $value1) {
			foreach ($data as $key2 => $value2) {
				$jml[$key1] = $jml[$key1] + ($value1/$value2);
			}			
		}
		return $jml;
	}

	function pv_jenis() {
		error_reporting(0);
		$jml = $this->jml_jenis();
		$data = $this->jenis_per_kec();
		foreach ($data as $key1 => $value1) {
			foreach ($data as $key2 => $value2) {
				$tmp[$key1] = $tmp[$key1] + ($value2/$value1)/$jml[$key2]." ";
			}
			$pv[$key1] = ($tmp[$key1] /3);
		}
		return $pv;
	}

	function l_jenis() {
		error_reporting(0);
		$data = $this->jenis_per_kec();
		return $data;
	}

	/* ------------------------------------- start ocw ------------------------------------- */

	function get_percent() {
		$jmlSurplus = $this->session->userdata('jmlSp');
		$pv_modal= $this->pv_modal();
		$okp = $this->pv_okupansi();
		$keba = $this->pv_keba();
		$jenis = $this->pv_jenis();
		$pv['okupansi'] = $okp;
		$pv['kebutuhan_air'] = $keba;
		$pv['jenis'] = $jenis;

		foreach ($pv_modal as $key => $value) {
			foreach ($pv[$key] as $key1 => $value1) {
				$ocw[$key1] = $ocw[$key1]+($value * $value1);
			}
		}

		foreach ($ocw as $key => $value) {
			$total_ocw = $total_ocw + $value;
		}

		foreach ($ocw as $key => $value) {
			$final[$key] = number_format(($value /$total_ocw) * 100,2);
		}

		return $final;
	}

}

/* End of file dashboard_model.php */
/* Location: ./application/models/dashboard_model.php */