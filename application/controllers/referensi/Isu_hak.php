<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Isu_hak extends MY_Controller
{
	/**
	 * Isu_hak constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->_auth();
		$this->_path = 'referensi/isu_hak/';
		$this->_table = 'ref_hak_dokumen';
		//=========================================================//

		$this->load->model($this->_path . 'Isu_hak_model', 'isu_hak');
	}

	/**
	 * Halaman index
	 *
	 */
	public function index($menu_id = null)
	{
		method('get');
		//checkPermission($this->_path, $menu_id, 1);
		//=========================================================//

		$config 			= [
			'title' 		=> 'Isu Hak',
			'menu_id' 		=> $menu_id,
			'menu_active' 	=> 'Isu Hak',
			'menu_open' 	=> 'Referensi',
			'path' 			=> $this->_path,
			'contents' 		=> $this->_path . 'index',
			'script_js' 	=> $this->_path . 'js',
			// =================================================
			'breadcrumb' => ['Pengaturan', 'Referensi', 'Isu Hak', 'index'],
			'modals' => [
				$this->_path . 'modals/tambah',
				$this->_path . 'modals/ubah',
			],
			'plugins' => [
				'datatable' => true,
				'swal' => true,
				'select2' => true,
				'jquery_validate' => true,
			]
		];

		render($config);
	}

	//=============================================================//
	//======================== DATATABLES =========================//
	//=============================================================//

	/**
	 * Keperluan DataTables server-side
	 *
	 */
	public function data($menu_id = null)
	{
		method('post', true);
		checkAccessAjax($this->_path, $menu_id, 1);
		//=========================================================//

		$output = $this->isu_hak->datatables();
		response($output);
	}

	//=============================================================//
	//======================== VALIDATOR =========================//
	//=============================================================//

	/**
	 * Keperluan validasi server-side
	 */
	private function _validator()
	{
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_data(post());
		$this->form_validation->set_message('required', '{field} tidak boleh kosong');
		$this->form_validation->set_rules('nama', 'nama', 'required|trim');

		if (!$this->form_validation->run())
			response([
				'status' => false,
				'message' => 'Mohon periksa kembali inputan anda!',
				'errors' => $this->form_validation->error_array(),
			], 422);
	}

	//=============================================================//
	//=========================== CRUD ============================//
	//=============================================================//
	/**
	 * Keperluan CRUD tambah data
	 *
	 */
	public function store($menu_id = null)
	{
		method('post', true);

		checkAccessAjax($this->_path, $menu_id, 2);
		$this->_validator();
		//=========================================================//

		$insert 			= [
			'nama_hak' 	=> post('nama'),
		];

		$this->db->insert($this->_table, $insert);

		//=========================================================//
		response([
			'status' => true,
			'message' => 'Data berhasil disimpan',
			// "query" => $this->db->last_query(),
		]);
	}

	/**
	 * Keperluan CRUD ubah data
	 *
	 */
	public function update($menu_id = null)
	{
		method('post', true);
		checkAccessAjax($this->_path, $menu_id, 3);
		$this->_validator();
		$update 			=  [
			'nama_hak' 	=> post('nama'),
		];

		$where 				= [
			'id_hak' 	=> post('id'),
		];

		$this->db->update($this->_table, $update, $where);

		//=========================================================//
		response([
			'status' => true,
			'message' => 'Data berhasil disimpan',
			"query" => $this->db->last_query(),
		]);
	}

	/**
	 * Keperluan CRUD hapus data
	 *
	 */
	public function delete($menu_id = null)
	{
		method('post', true);
		checkAccessAjax($this->_path, $menu_id, 4);

		$delete = [
			'is_active' => '0'
		];

		$where = [
			'id_hak' => post('id_hak'),
		];

		$this->db->update($this->_table, $delete, $where);

		//=========================================================//
		response([
			'status' => true,
			'message' => 'Data berhasil dihapus',
			// "query" => $this->db->last_query(),
		]);
	}
}

/* End of file isu_hak.php */
