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
		$this->_path = 'api/contoh/';
		$this->_table = 'contoh';	// Nama tabel
		//=========================================================//

		$this->load->model($this->_path . 'Contoh_model', 'contoh');
	}

	/**
	 * Halaman index
	 *
	 */
	public function index()
	{
		method('get');
		//=========================================================//

		$data = $this->contoh->all();
		response([
			'message' => 'Sukses',
			'data' => $data
		]);
	}
}

/* End of file Contoh.php */
