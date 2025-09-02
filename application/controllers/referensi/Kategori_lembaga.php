<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_lembaga extends MY_Controller
{
	/**
	 * Kategori_lembaga constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->_auth();
		$this->_path = 'referensi/kategori_lembaga/';
		$this->_table = 'ref_kategori_lembaga';
		//=========================================================//

		$this->load->model($this->_path . 'Kategori_lembaga_model', 'kategori_lembaga');
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
			'title' 		=> 'Kategori Lembaga',
			'menu_id' 		=> $menu_id,
			'menu_active' 	=> 'Kategori Lembaga',
			'menu_open' 	=> 'Referensi',
			'path' 			=> $this->_path,
			'contents' 		=>  $this->_path . 'index',
			'script_js' 	=> $this->_path . 'js',
			// =================================================
			'breadcrumb' => ['Pengaturan', 'Referensi', 'Kategori Lembaga', 'index'],
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

		$output = $this->kategori_lembaga->datatables();
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
			'nama_kategori' 	=> post('nama'),
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
			'nama_kategori' 	=> post('nama'),
		];

		$where 				= [
			'id_kategori' 	=> post('id'),
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
			'id_kategori' => post('id_kategori'),
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

/* End of file kategori_lembaga.php */
