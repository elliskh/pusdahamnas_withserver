<?php

defined('BASEPATH') or exit('No direct script access allowed');

class GeneratorData extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function generateData()
	{
		$actions = $this->generateActions();
		$roles = $this->generateDummyRole();
		$users = $this->generateDummyUser();
		$userToRoles = $this->generateRoleToUser();
		$menus = $this->generateMenu();
		$menuToRoles = $this->generateMenuRole();

		response([
			'actions' => $actions,
			'roles' => $roles,
			'users' => $users,
			'userToRoles' => $userToRoles,
			'menus' => $menus,
			'menuToRoles' => $menuToRoles,
		]);
	}

	private function truncateTable($table)
	{
		$this->db->from($table)->truncate();
	}

	private function generateActions()
	{
		$this->truncateTable('actions');
		$data = ['lihat', 'tambah', 'ubah', 'hapus'];

		$affected = 0;
		foreach ($data as $value) {
			$this->db->insert('actions', [
				'uuid' => uuid(),
				'nama' => $value,
				'is_active' => 1,
			]);

			$affected += $this->db->affected_rows();
		}

		return $affected;
	}

	private function generateDummyRole()
	{
		$this->truncateTable('roles');

		$data = [
			[
				'uuid' => uuid(),
				'nama' => 'administrator'
			],
			[
				'uuid' => uuid(),
				'nama' => 'operator'
			]
		];

		$this->db->insert_batch('roles', $data);

		return $this->db->affected_rows();
	}

	private function generateDummyUser()
	{
		$this->truncateTable('users');

		$data = [
			[
				'uuid' => uuid(),
				'username' => 'admin',
				'password' => generatePassword('password'),
				'nama' => 'Administrator',
				'email' => 'admin@email.com'
			], [
				'uuid' => uuid(),
				'username' => 'operator',
				'password' => generatePassword('password'),
				'nama' => 'Operator',
				'email' => 'operator@email.com'
			]
		];

		$this->db->insert_batch('users', $data);

		return $this->db->affected_rows();
	}

	private function generateRoleToUser()
	{
		$this->truncateTable('user_role');

		$data = [
			[
				'role_id' => 1,
				'user_id' => 1
			],
			[
				'role_id' => 2,
				'user_id' => 1
			],
			[
				'role_id' => 2,
				'user_id' => 2
			]
		];

		$this->db->insert_batch('user_role', $data);

		return $this->db->affected_rows();
	}

	private function generateMenu()
	{
		$this->truncateTable('menus');

		$data = [
			[ #1
				'uuid' => uuid(),
				'route' => 'dashboard/index',
				'nama' => 'Beranda',
				'icon' => 'bx bx-home-alt',
				'urutan' => '1'
			], [ #2
				'uuid' => uuid(),
				'route' => '',
				'nama' => 'Manajemen Menu',
				'icon' => 'bx bx-menu-alt-left',
				'urutan' => '2'
			], [ #3
				'uuid' => uuid(),
				'route' => 'menu/index',
				'nama' => 'Menu Utama',
				'parent_id' => '2',
				'urutan' => null,
			], [ #4
				'uuid' => uuid(),
				'route' => 'menu/sub',
				'nama' => 'Submenu',
				'parent_id' => '2',
				'urutan' => null,
			], [ #5
				'uuid' => uuid(),
				'route' => 'otoritas/index',
				'nama' => 'Otoritas',
				'icon' => 'bx bxs-user-detail',
				'urutan' => '3'
			], [ #6
				'uuid' => uuid(),
				'route' => 'users/index',
				'nama' => 'Pengguna',
				'icon' => 'bx bx-user',
				'urutan' => '4'
			]
		];

		$affected = 0;
		foreach ($data as $item) {
			$this->db->insert('menus', $item);

			$affected += $this->db->affected_rows();
		}

		return $this->db->affected_rows();
	}

	private function generateMenuRole()
	{
		$this->truncateTable('menu_role');

		$actions = $this->db->get('actions')->result();
		$menus = $this->db->get('menus')->result();
		$roles = 1;

		$data = [];
		foreach ($menus as $menu) {
			$menu_id = $menu->id;

			$count_child = $this->db->where('parent_id', $menu_id)->get('menus')->num_rows();

			if ($count_child > 0) {
				$data[] = [
					'role_id' => $roles,
					'menu_id' => $menu_id,
					'action_id' => '1',
				];
			} else {
				foreach ($actions as $action) {
					$action_id = $action->id;

					$data[] = [
						'role_id' => $roles,
						'menu_id' => $menu_id,
						'action_id' => $action_id,
					];
				}
			}
		}

		$this->db->insert_batch('menu_role', $data);

		return $this->db->affected_rows();
	}
}

/* End of file LoadDummyData.php */
