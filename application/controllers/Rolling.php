<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Rolling extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->_auth();
		$this->_path = 'rolling/';
		$this->_table = 'tb_rolling';
		//=========================================================//

		$this->load->model($this->_path . 'Rolling_model', 'user');
	//	$this->load->model('otoritas/Otoritas_model', 'otoritas');
	}

	public function index($menu_id = null)
	{
		method('get');
		checkPermission($this->_path, $menu_id, 1);
		//=========================================================//

	//	$roles = $this->db->where([
	//		'is_active' => '1',
	//	])->get('roles')->result();

		$config = [
			'title' => 'Rolling',
			'menu_id' => $menu_id,
			'menu_active' => 'Rolling',
			'menu_open' => null,
			'path' => $this->_path,
			'contents' =>  $this->_path . 'index',
			'script_js' 		=> $this->_path . 'js',
			//=========================================================//
		///	'roles' => $roles,
			//=========================================================//
			'breadcrumb' => ['Pengaturan', 'Rolling', 'index'],
			'modals' => [
				$this->_path . 'modals/tambah',
				$this->_path . 'modals/ubah',
				$this->_path . 'modals/otoritas',
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

	public function data($menu_id = null)
	{
		method('get');
	///	checkAccessAjax($this->_path, $menu_id, 1);

		$list = $this->user->get_datatables();

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
			'recordsTotal' => $this->user->count_all(),
			'recordsFiltered' => $this->user->count_filtered(),
			'data' => $data,
		];

		response($output);
	}

	public function store($menu_id = null)
	{
		method('post', true);
		checkAccessAjax($this->_path, $menu_id, 2);

		//$username = post('username');
		//$password = post('password');
		$nama = post('nama');

		$hashed_password = generatePassword($password);

		$this->db->insert('tb_rolling', [
		//	'username' => $username,
		//	'password' => $hashed_password,
			'nama' => $nama
		]);

		response([
			'status' => true,
			'message' => 'Data berhasil disimpan'
		]);
	}

	public function update($menu_id = null)
	{
		method('post', true);
	///	checkAccessAjax($this->_path, $menu_id, 3);

		$id = post('id');

		if (empty($id)) {
			response([
				'status' => false,
				'mssg' => 'Data tidak ditemukan'
			]);
		}

		$user_id = decrypt($id);
		//$username = post('username');
		$nama = post('nama');

		/*$check_username = $this->user->checkUsername($user_id, $nama);

		if ($check_username != 0) {
			response([
				'status' => false,
				'mssg' => 'Data sudah ada'
			]);

			return false;
		}*/

		$this->db->where('id', $user_id);
		$this->db->update('tb_rolling', [
		//	'username' => $username,
			'nama' => $nama,
		]);

		response([
			'status' => true,
			'message' => 'Data berhasil disimpan'
		]);
	}

	public function changeUserActive($menu_id = null)
	{
		method('post', true);
		checkAccessAjax($this->_path, $menu_id, 3);

		$id = post('id');

		if (empty($id)) {
			response([
				'status' => false,
			], 404);
		}

		$user_id = decrypt($id);
		$val = post('val');
      
        $check_actived = $this->user->checkUsername();

		if ($check_actived != 0 && $val==1) {
			response([
				'status' => false,
				//'mssg' => 'Data sudah ada yang aktif, Silahkan non aktifkan!',
                'message' => 'Data sudah ada yang aktif, Silahkan non aktifkan!',
			]);

			return false;
		}else{
    		$this->db->where('id', $user_id);
    		$this->db->update('tb_rolling', [
    			'is_active' => $val,
    		]);
    
    		response([
    			'status' => true,
    			'message' => 'Data berhasil disimpan',
    		]);		  
		}

	}

	public function resetPassword($menu_id = null)
	{
		/*method('post', true);
		checkAccessAjax($this->_path, $menu_id, 3);

		$id = post('id');

		if (empty($id)) {
			response([
				'status' => false,
			], 404);

			return false;
		}

		$user_id = decrypt($id);

		$string_password = config_item('default_reset_password');
		$hashed_password = generatePassword($string_password);

		$this->db->where('id', $user_id);
		$this->db->update('users', ['password' => $hashed_password]);

		response([
			'status' => true,
			'message' => 'Password berhasil direset'
		]);*/
	}

	public function deleteUser($menu_id = null)
	{
		checkAccessAjax($this->_path, $menu_id, 4);

		$id = post('id');

		if (empty($id)) {
			response([
				'status' => false,
			], 404);

			return false;
		}

		$user_id = decrypt($id);

		$this->db->where('id', $user_id);
		$this->db->update('tb_rolling', ['is_active' => '0']);

		response([
			'status' => true,
			'message' => 'Data berhasil dihapus'
		]);
	}

	public function updateRole($menu_id = null)
	{
		/*checkAccessAjax($this->_path, $menu_id, 3);

		$id = post('id');

		if (empty($id)) {
			response([
				'status' => false,
			], 404);

			return false;
		}

		$user_id = decrypt($id);

		$roles = $this->db->where([
			'deleted_at' => null,
			'is_active' => '1',
		])->get('roles')->result();

		$affected = 0;

		foreach ($roles as $role) {
			$role_id = post('role_' . $role->id);

			if (!empty($role_id)) {
				$affected += $this->otoritas->updateRole($role->id, $user_id, '1');
			} else {
				$affected += $this->otoritas->updateRole($role->id, $user_id, '0');
			}
		}

		response([
			'status' => true,
			'message' => 'Data berhasil disimpan'
		]);*/
	}
}

/* End of file Rollisu.php */
