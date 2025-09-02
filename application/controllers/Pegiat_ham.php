<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pegiat_ham extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->_auth();
		$this->_path = 'pegiat_ham/';
		$this->_table = '';
		$this->link = base_url('pegiat_ham/tambah');
		//=========================================================//

		$this->load->model('menu/Menu_model', 'menu');
	}

	public function index($menu_id = null)
	{
		method('get');
		checkPermission($this->_path, $menu_id, 1);

		$config 			= [
			'title' 		=> 'Pegiat Ham',
			'menu_id' 		=> $menu_id,
			'link' 			=> $this->link,
			'menu_active' 	=> 'Pegiat HAM',
			'menu_open' 	=> null,
			'path' 			=> $this->_path,
			'contents' 		=> $this->_path . 'index',
			//=========================================================//
			'breadcrumb' 	=> [
				'Dashboard', 'Pegiat HAM', 'index'
			],
			'modals' 		=> [],
			'plugins' 		=> []
		];

		render($config);
	}

	public function tambah($menu_id = null)
	{
		method('get');
		checkPermission($this->_path, $menu_id, 2);
		$config 			= [
			'title' 		=> 'Tambah Pegiat Ham',
			'menu_id' 		=> $menu_id,
			'link' 			=> $this->link,
			'menu_active' 	=> 'Pegiat HAM',
			'menu_open' 	=> null,
			'path' 			=> $this->_path,
			'contents' 		=> $this->_path . 'tambah',
			//=========================================================//
			'breadcrumb' 	=> [
				'Dashboard', 'Pegiat HAM', 'index'
			],
			'modals' 		=> [],
			'plugins' 		=> []
		];

		render($config);
	}

	public function edit($menu_id = null, $id = null)
	{
		method('get');
		checkPermission($this->_path, $menu_id, 2);
		echo "<h1> Edit </h1>";
	}
}

/* End of file Dashboard.php */
