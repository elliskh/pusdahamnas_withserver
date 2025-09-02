<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->_auth();
		$this->_path = 'dashboard/';
		$this->_table = '';
		//=========================================================//

		$this->load->model('menu/Menu_model', 'menu');
	}

	public function index($menu_id = null)
	{
		method('get');
		if ($this->session->userdata('nama_role')=='Operator Internal')
		{
			$this->internal($menu_id);
		}
		else
		{
			// checkPermission($this->_path, $menu_id, 1);
			$data_mitra = $this->db->select('a.id, singkatan_lembaga as nama, count(*) as jumlah')->join('tb_dokumen b', 'a.id=b.id_lembaga')->group_by('a.id')->get('ref_lembaga a')->result_array();
			$data_hak = $this->db->select('a.id_hak, nama_hak as nama, count(*) as jumlah')->join('tb_dokumen b', 'a.id_hak=b.id_topik_hak')->group_by('a.id_hak')->order_by('jumlah', 'desc')->limit(5)->get('ref_hak_dokumen a')->result_array();
			$data_subyek = $this->db->select('a.id_subyek, nama_subyek as nama, count(*) as jumlah')->join('tb_dokumen b', 'a.id_subyek=b.id_topik_subyek')->group_by('a.id_subyek')->order_by('jumlah', 'desc')->get('ref_subyek_dokumen a')->result_array();
			$total_unduh = $this->db->count_all_results('tb_dokumen_pengunduh a');
			$unduh_terbanyak = $this->db->select('nama_dokumen, count(*) as jumlah')->join('tb_dokumen_pengunduh b', 'a.id=b.id_dokumen')->group_by('a.id')->order_by('jumlah', 'desc')->limit(3)->get('tb_dokumen a')->result_array();

			$config = [
				'title' => 'Selamat Datang',
				'menu_id' => $menu_id,
				'menu_active' => 'Beranda',
				'menu_open' => null,
				'data_mitra' => json_encode($data_mitra),
				'data_hak' => json_encode($data_hak),
				'data_subyek' => json_encode($data_subyek),
				'total_unduh' => $total_unduh,
				'unduh_terbanyak' => $unduh_terbanyak,
				'path' => $this->_path,
				'contents' => $this->_path . 'home',
				'script_js' => $this->_path . 'js',
				//=========================================================//
				'breadcrumb' => [
					'Dashboard', 'Beranda', 'index'
				],
				'modals' => [],
				'plugins' => []
			];

			render($config);
		}
	}

	public function internal($menu_id = null)
	{
		method('get');
		// var_dump($this->session->userdata());
		// checkPermission($this->_path, $menu_id, 1);
		$data_tahun = $this->db->select('a.tahun, count(*) as jumlah')->group_by('a.tahun')->where('deleted_at IS NULL',null)->get('tb_basisdata_internal a')->result_array();
		$data_unit = $this->db->select('a.unit_kerja as nama, count(*) as jumlah')->where('deleted_at IS NULL',null)->group_by('a.unit_kerja')->order_by('jumlah', 'desc')->limit(5)->get('tb_basisdata_internal a')->result_array();
		$data_jenis = $this->db->select('a.id_jenis, nama_jenis as nama, count(*) as jumlah')->join('tb_basisdata_internal b', 'a.id_jenis=b.id_jenis_dokumen')->group_by('a.id_jenis')->order_by('jumlah', 'desc')->get('ref_jenis_dokumen_internal a')->result_array();
		$total_unduh = $this->db->count_all_results('tb_dokumen_pengunduh a');
		$unduh_terbanyak = $this->db->select('nama_dokumen, count(*) as jumlah')->join('tb_dokumen_pengunduh b', 'a.id=b.id_dokumen')->group_by('a.id')->order_by('jumlah', 'desc')->limit(3)->get('tb_dokumen a')->result_array();

		$config = [
			'title' => 'Selamat Datang',
			'menu_id' => $menu_id,
			'menu_active' => 'Beranda',
			'menu_open' => null,
			'data_tahun' => json_encode($data_tahun),
			'data_unit' => json_encode($data_unit),
			'data_jenis' => json_encode($data_jenis),
			'total_unduh' => $total_unduh,
			'unduh_terbanyak' => $unduh_terbanyak,
			'path' => $this->_path,
			'contents' => $this->_path . 'home_internal',
			'script_js' => $this->_path . 'js',
			//=========================================================//
			'breadcrumb' => [
				'Dashboard', 'Beranda', 'index'
			],
			'modals' => [],
			'plugins' => []
		];

		render($config);
	}
}

/* End of file Dashboard.php */
