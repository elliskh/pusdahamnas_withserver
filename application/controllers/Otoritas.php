<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Otoritas extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->_auth();
		$this->_path = 'otoritas/';
		$this->_table = 'roles';
		//=========================================================//

		$this->load->model($this->_path . 'Otoritas_model', 'otoritas');
		$this->load->model($this->_path . 'Hak_akses_model', 'hak_akses');
		$this->load->model('menu/Menu_model', 'menu');
	}

	public function index($menu_id = null)
	{
		method('get');
		checkPermission($this->_path, $menu_id, 1);

		$config = [
			'title' => 'Otoritas - Daftar Otoritas',
			'menu_id' => $menu_id,
			'menu_active' => 'Otoritas',
			'menu_open' => null,
			'path' => $this->_path,
			'contents' => $this->_path . 'index',
			'script_js' 		=> $this->_path . 'js',
			// =================================================
			'breadcrumb' => ['Pengaturan', 'Otoritas', 'index'],
			'modals' => [
				$this->_path . 'modals/form_otoritas',
			],
			'plugins' => [
				'datatable' => true,
				'swal' => true,
				'jquery_validate' => true
			]
		];

		render($config);
	}

	public function data($menu_id = null)
	{
		method('get');
		checkAccessAjax($this->_path, $menu_id, 1);

		$list = $this->otoritas->get_datatables();

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
			'recordsTotal' => $this->otoritas->count_all(),
			'recordsFiltered' => $this->otoritas->count_filtered(),
			'data' => $data,
		];

		response($output);
	}

	private function _validator()
	{
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_message('required', '{field} tidak boleh kosong');

		$this->form_validation->set_rules('nama', 'nama', 'required|trim');

		if (!$this->form_validation->run())
			response([
				'status' => false,
				'message' => 'Mohon periksa kembali inputan anda!',
				'errors' => $this->form_validation->error_array(),
			], 422);
	}

	public function store()
	{
		method('post', true);
		$this->_validator();

		$menu_id = post('encrypted_menu_id');
		$id = post('id');

		if (!$id) {
			checkAccessAjax($this->_path, $menu_id, 2);
			$row = [
				'uuid' => uuid(),
				'nama' => post('nama'),
			];

			$this->db->insert('roles', $row);
		} else {
			checkAccessAjax($this->_path, $menu_id, 3);
			$role_id = decrypt($id);

			$row = [
				'uuid' => uuid(),
				'nama' => post('nama'),
			];

			$this->db->where('id', $role_id);
			$this->db->update('roles', $row);
		}

		response([
			'status' => true,
			'message' => 'Berhasil menyimpan data'
		]);
	}

	public function delete()
	{
		method('post', true);

		$menu_id = post('encrypted_menu_id');
		checkAccessAjax($this->_path, $menu_id, 4);
		$id = post('id');

		if (!$id) {
			response([
				'status' => false,
				'message' => 'Data tidak ditemukan'
			], 404);
		}

		$role_id = decrypt($id);

		$this->db->where('id', $role_id);
		$this->db->update('roles', [
			'is_active' => '0',
			'deleted_at' => now()
		]);

		response([
			'status' => true,
			'message' => 'Berhasil menghapus data'
		]);
	}

	public function hakAkses($menu_id = null, $encrypted_role_id = null)
	{
		checkPermission($this->_path, $menu_id, 3);

		if (!$encrypted_role_id) redirect('otoritas/index/' . $menu_id);

		$role_id = decrypt($encrypted_role_id);
		$role_data = $this->db->where('id', $role_id)->where([
			'deleted_at' => null,
			'is_active' => '1'
		])->get('roles')->row();

		$actions = $this->db->where('is_active', '1')->get('actions')->result();

		$main_menu = $this->hak_akses->getMainMenuOfRole($role_id)->result();


		$list_menu = [];

		foreach ($main_menu as $menu) {
			$item_menu = [
				'id' => $menu->id,
				'parent_id' => $menu->parent_id,
				'nama' => $menu->nama,
				'role_id' => empty($menu->role_id) ? $role_id : $menu->role_id,
				'route' => $menu->route,
				'actions' => $menu->actions,
				'active' => $menu->menu_role_active
			];

			$sub_menu = $this->hak_akses->getSubMenuOfRole($role_id, $menu->id);

			if ($sub_menu->num_rows() > 0) {
				$list_sub_menu = [];
				foreach ($sub_menu->result() as $sub) {
					$list_sub_menu[] = [
						'id' => $sub->id,
						'parent_id' => $sub->parent_id,
						'nama' => $sub->nama,
						'role_id' => empty($sub->role_id) ? $role_id : $sub->role_id,
						'route' => $sub->route,
						'actions' => $sub->actions,
						'active' => $sub->menu_role_active
					];
				}
				$item_menu['child'] = $list_sub_menu;
			} else {
				$item_menu['child'] = null;
			}

			$list_menu[] = $item_menu;
		}

		$config = [
			'title' => 'Otoritas - Hak Akses Otoritas <b>"' . strtoupper($role_data->nama) . '</b>"',
			'menu_id' => $menu_id,
			'menu_active' => 'Otoritas',
			'menu_open' => null,
			'path' => $this->_path,
			'contents' => $this->_path . 'hak_akses',
			// =================================================
			'actions' => $actions,
			'list_menu' => $list_menu,
			'role_id' => encrypt($role_id),
			// =================================================
			'breadcrumb' => ['Pengaturan', 'Otoritas', 'Hak Akses'],
			'modals' => [],
			'plugins' => [
				'datatable' => true,
				'swal' => true,
			]
		];

		render($config);
	}

	public function updateHakAkses($menu_id = null)
	{
		method('post');

		checkPermission($this->_path, $menu_id, 2);

		$list_all_menus = $this->menu->getAllMenu();
		$list_all_actions = $this->db->where('is_active', '1')->get('actions')->result();
		$id = post('role_id');

		$role_id = decrypt($id);

		$affected = 0;

		foreach ($list_all_menus as $menu) {
			foreach ($list_all_actions as $action) {
				if (!empty(post($menu->id . '_' . $role_id . '_' . $action->id))) {
					$affected += $this->hak_akses->updateHakAkses($role_id, $menu->id, $action->id, '1');
				} else {
					$affected += $this->hak_akses->updateHakAkses($role_id, $menu->id, $action->id, '0');
				}
			}
		}

		$this->session->set_flashdata('update-hak-akses', $affected);

		redirect('otoritas/hakAkses/' . $menu_id . '/' . encrypt($role_id));
	}
}

/* End of file Otoritas.php */
