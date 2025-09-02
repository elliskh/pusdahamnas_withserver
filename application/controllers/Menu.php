<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->_auth();
		$this->_path = 'menu/';
		$this->_table = 'menus';
		//=========================================================//

		$this->load->model($this->_path . 'Menu_model', 'menu');
		$this->load->model($this->_path . 'Submenu_model', 'submenu');
	}

	public function index($menu_id = null)
	{
		method('get');
		checkPermission($this->_path, $menu_id, 1);

		$config = [
			'title' => 'Manajemen Menu - Menu Utama',
			'menu_id' => $menu_id,
			'menu_active' => 'Menu Utama',
			'menu_open' => 'Manajemen Menu',
			'path' => $this->_path,
			'contents' => $this->_path . 'main_menu',
			'script_js' 		=> $this->_path . 'js_main',
			// =================================================
			'breadcrumb' => ['Pengaturan', 'Manajemen Menu', 'Menu Utama', 'index'],
			'modals' => ['menu/modals/form_menu'],
			'plugins' => [
				'datatable' => true,
				'swal' => true,
				'select2' => true,
				'jquery_validate' => true
			]
		];

		render($config, 'menu/main_menu');
	}

	public function sub($menu_id = null)
	{

		method('get');
		checkPermission($this->_path, $menu_id, 1);

		$config = [
			'title' => 'Manajemen Menu - Sub Menu',
			'menu_id' => $menu_id,
			'menu_active' => 'Sub Menu',
			'menu_open' => 'Manajemen Menu',
			'path' => $this->_path,
			'contents' => $this->_path . 'sub_menu',
			'script_js' 		=> $this->_path . 'js_sub',
			// =================================================
			'breadcrumb' => ['Pengaturan', 'Manajemen Menu', 'Sub Menu', 'index'],
			'modals' => ['menu/modals/form_submenu'],
			'plugins' => [
				'datatable' => true,
				'swal' => true,
				'select2' => true,
				'jquery_validate' => true
			]
		];

		render($config, 'menu/sub_menu');
	}

	public function getMainMenu($menu_id = null)
	{
		method('get');
		checkAccessAjax($this->_path, $menu_id, 1);
		if (!get('ref_menu_group_id')) show_404();
		$ref_menu_group_id = get('ref_menu_group_id');
		$main_menu = $this->menu->getMainMenu($ref_menu_group_id);

		response([
			'status' => true,
			'data' => $main_menu
		]);
	}

	public function menuData($menu_id = null)
	{

		method('get');
		checkAccessAjax($this->_path, $menu_id, 1);

		$list = $this->menu->get_datatables();

		$data = [];
		$no = $_GET['start'];

		foreach ($list as $field) {
			$no++;

			$field->no = $no;
			$field->id = encrypt($field->id);

			$data[] = $field;
		}

		$output = [
			'draw' => @$_GET['draw'],
			'recordsTotal' => $this->menu->count_all(),
			'recordsFiltered' => $this->menu->count_filtered(),
			'data' => $data,
		];

		response($output);
	}

	private function _validator()
	{
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_message('required', '{field} tidak boleh kosong');

		// $this->form_validation->set_rules('parent_id', 'parent_id', 'required|trim');
		$this->form_validation->set_rules('nama', 'nama', 'required|trim');
		$this->form_validation->set_rules('route', 'route', 'required|trim');
		$this->form_validation->set_rules('urutan', 'urutan', 'required|trim');

		if (!$this->form_validation->run())
			response([
				'status' => false,
				'message' => 'Mohon periksa kembali inputan anda!',
				'errors' => $this->form_validation->error_array(),
			], 422);
	}

	public function storeMainMenu()
	{

		method('post', true);
		$menu_id = post('encrypted_menu_id');

		$this->_validator();

		$id = post('id');

		if (!$id) {
			checkAccessAjax($this->_path, $menu_id, 2);
			$row = [
				'uuid' => uuid(),
				'ref_menu_group_id' => post('ref_menu_group_id'),
				'nama' => post('nama'),
				'route' => post('route'),
				'path' => post('path'),
				'icon' => post('icon'),
				'urutan' => post('urutan') ?? '0'
			];

			$this->db->insert('menus', $row);
		} else {
			checkAccessAjax($this->_path, $menu_id, 3);
			$menu_id = decrypt($id);

			$row = [
				'uuid' => uuid(),
				'ref_menu_group_id' => post('ref_menu_group_id'),
				'nama' => post('nama'),
				'route' => post('route'),
				'path' => post('path'),
				'icon' => post('icon'),
				'urutan' => post('urutan') ?? '0'
			];

			$this->db->where('id', $menu_id);
			$this->db->update('menus', $row);
		}

		response([
			'status' => true,
			'message' => 'Berhasil menyimpan data'
		]);
	}

	public function deleteMainMenu()
	{
		method('post', true);
		$menu_id = post('encrypted_menu_id');
		checkAccessAjax($this->_path, $menu_id, 4);
		$id = post('id');

		if (!$id) {
			response([
				'status' => false,
				'message' => 'Data Tidak Ditemukan',
			], 404);
		}

		$menu_id = decrypt($id);

		$this->db->where('id', $menu_id);
		$this->db->update('menus', [
			'is_active' => 0,
			'deleted_at' => now()
		]);

		response([
			'status' => true,
			'message' => 'Berhasil menghapus data'
		]);
	}

	public function submenuData($menu_id = null)
	{
		method('get');
		checkAccessAjax($this->_path, $menu_id, 1);

		$list = $this->submenu->get_datatables();

		$data = [];
		$no = $_GET['start'];

		foreach ($list as $field) {
			$no++;

			$field->no = $no;
			$field->id = encrypt($field->id);

			$data[] = $field;
		}

		$output = [
			'draw' => $_GET['draw'],
			'recordsTotal' => $this->submenu->count_all(),
			'recordsFiltered' => $this->submenu->count_filtered(),
			'data' => $data,
		];

		response($output);
	}

	public function storeSubMenu()
	{
		method('post', true);
		$menu_id = post('encrypted_menu_id');
		$this->_validator();

		$id = post('id');

		if (!$id) {
			checkAccessAjax($this->_path, $menu_id, 2);
			$row = [
				'uuid' => uuid(),
				'parent_id' => post('parent_id'),
				'nama' => post('nama'),
				'route' => post('route'),
				'urutan' => post('urutan') ?? '0'
			];

			$this->db->insert('menus', $row);
		} else {
			checkAccessAjax($this->_path, $menu_id, 3);
			$menu_id = decrypt($id);

			$row = [
				'uuid' => uuid(),
				'parent_id' => post('parent_id'),
				'nama' => post('nama'),
				'route' => post('route'),
				'urutan' => post('urutan') ?? '0'
			];

			$this->db->where('id', $menu_id);
			$this->db->update('menus', $row);
		}

		response([
			'status' => true,
			'message' => 'Berhasil menyimpan data'
		]);
	}

	public function deleteSubMenu()
	{
		$menu_id = post('encrypted_menu_id');
		checkAccessAjax($this->_path, $menu_id, 4);
		$id = post('id');

		if (!$id) {
			response([
				'status' => false,
				'message' => 'Data Tidak Ditemukan',
			], 404);
		}

		$menu_id = decrypt($id);

		$this->db->where('id', $menu_id);
		$this->db->update('menus', [
			'is_active' => 0,
			'deleted_at' => now()
		]);

		response([
			'status' => true,
			'message' => 'Berhasil menghapus data'
		]);
	}
}

/* End of file Menu.php */
