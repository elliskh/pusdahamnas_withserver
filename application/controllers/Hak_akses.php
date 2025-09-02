<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Hak_akses extends MY_Controller
{
	/**
	 * Hak_akses constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->_auth();
		$this->_path = 'hak_akses/';
		$this->_table = 'actions';
		//=========================================================//

		$this->load->model($this->_path . 'Hak_akses_model', 'hak_akses');
	}

	/**
	 * Halaman index
	 *
	 */
	public function index($menu_id = null)
	{
		method('get');
		checkPermission($this->_path, $menu_id, 1);
		//=========================================================//

		$config = [
			'title' => 'Hak Akses - Daftar Hak Akses',
			'menu_id' => $menu_id,
			'menu_active' => 'Hak Akses',
			'menu_open' => null,
			'path' => $this->_path,
			'contents' =>  $this->_path . 'index',
			'script_js' 		=> $this->_path . 'js',
			// =================================================
			'breadcrumb' => ['Pengaturan', 'Hak Akses', 'index'],
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

		$output = $this->hak_akses->datatables();
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

		$this->db->trans_begin();   // Begin transaction
		//=========================================================//

		$insert = [
			'uuid' => uuid(),
			'nama' => post('nama'),
		];

		$this->db->insert($this->_table, $insert);

		//=========================================================//
		if (!$this->db->trans_status()) {   // Check transaction status
			$this->db->trans_rollback();    // Rollback transaction
			response([
				'status' => false,
				'message' => 'Terjadi kesalahan di server',
				'errors' => $this->db->error(),
			], 500);
		}

		$this->db->trans_commit();  // Commit transaction

		response([
			'status' => true,
			'message' => 'Berhasil menambahkan data',
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

		$this->db->trans_begin();   // Begin transaction
		//=========================================================//

		$id = $this->hak_akses->check();

		$update =  [
			'uuid' => uuid(),
			'nama' => put('nama'),
		];

		$where = [
			'id' => $id
		];

		$this->db->update($this->_table, $update, $where);

		//=========================================================//
		if (!$this->db->trans_status()) {   // Check transaction status
			$this->db->trans_rollback();    // Rollback transaction
			response([
				'status' => false,
				'message' => 'Terjadi kesalahan di server',
				'errors' => $this->db->error(),
			], 500);
		}

		$this->db->trans_commit();  // Commit transaction

		response([
			'status' => true,
			'message' => 'Data berhasil disimpan',
			// "query" => $this->db->last_query(),
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

		$this->db->trans_begin();   // Begin transaction
		//=========================================================//

		$id = $this->hak_akses->check();

		$delete = [
			'deleted_at' => now(),
			'is_active' => 0
		];

		$where = [
			'id' => $id
		];

		$this->db->update($this->_table, $delete, $where);

		//=========================================================//
		if (!$this->db->trans_status()) {   // Check transaction status
			$this->db->trans_rollback();    // Rollback transaction
			response([
				'status' => false,
				'message' => 'Terjadi kesalahan di server',
				'errors' => $this->db->error(),
			], 500);
		}

		$this->db->trans_commit();  // Commit transaction

		response([
			'status' => true,
			'message' => 'Data berhasil dihapus',
			// "query" => $this->db->last_query(),
		]);
	}
}

/* End of file Hak_akses.php */
