<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Contoh extends MY_Controller
{
	/**
	 * Contoh constructor
	 */
	public function __construct()
	{
		parent::__construct();
		auth();
		$this->_path = 'contoh/';
		$this->_table = 'contoh';	// Nama tabel
		//=========================================================//

		$this->load->model($this->_path . 'Contoh_model', 'contoh');
	}

	/**
	 * Halaman index
	 *
	 */
	public function index($menu_id = null)
	{
		method('get');
		checkPermission($this->_path, $menu_id, 1);	// hak akses lihat
		//=========================================================//

		$config = [
			'title' => 'Contoh',
			'menu_id' => $menu_id,
			'menu_active' => 'Contoh',
			'menu_open' => null,
			'path' => $this->_path,
			'contents' =>  $this->_path . 'index',
			// =================================================
			'breadcrumb' => ['Utama', 'Contoh', 'index'],
			'modals' => [
				$this->_path . 'modals/tambah',
				$this->_path . 'modals/ubah',
			],
			'plugins' => [
				'datatable' => true,
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
		checkAccessAjax($this->_path, $menu_id, 1);	// hak akses lihat
		//=========================================================//

		$output = $this->contoh->datatables();
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
		$this->form_validation->set_rules('kolom_1', 'kolom_1', 'required|trim');
		$this->form_validation->set_rules('kolom_2', 'kolom_2', 'required|trim');
		$this->form_validation->set_rules('kolom_3', 'kolom_3', 'required|trim');

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

		checkAccessAjax($this->_path, $menu_id, 2);	// hak akses tambah
		$this->_validator();

		$this->db->trans_begin();   // Begin transaction
		//=========================================================//

		$insert = [
			'uuid' => uuid(),
			'kolom_1' => post('kolom_1'),
			'kolom_2' => post('kolom_2'),
			'kolom_3' => post('kolom_3'),
			'created_at' => now(),
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
			'message' => 'Berhasil menyimpan data',
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

		checkAccessAjax($this->_path, $menu_id, 3);	// hak akses ubah
		$this->_validator();

		$this->db->trans_begin();   // Begin transaction
		//=========================================================//

		$id = $this->contoh->check();	// Cek data

		$update =  [
			'uuid' => uuid(),
			'kolom_1' => post('kolom_1'),
			'kolom_2' => post('kolom_2'),
			'kolom_3' => post('kolom_3'),
			'updated_at' => now(),
		];

		$where = [
			'id' => $id
		];

		$this->db->update('contoh', $update, $where);

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
			'message' => 'Berhasil menyimpan data',
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
		checkAccessAjax($this->_path, $menu_id, 4);	// hak akses hapus

		$this->db->trans_begin();   // Begin transaction
		//=========================================================//

		$id = $this->contoh->check();	// Cek data

		$delete = [
			'deleted_at' => now(),
			'is_active' => '0'
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
			'message' => 'Berhasil menghapus data',
			// "query" => $this->db->last_query(),
		]);
	}
}

/* End of file Contoh.php */
