<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Otoritas_model extends CI_Model
{

	var $table = 'roles';
	var $column_order = [null, 'nama', null, 'created_at'];
	var $column_search = ['nama'];
	var $order = ['created_at' => 'desc'];


	public function __construct()
	{
		parent::__construct();
	}

	private function _get_datatables_query()
	{
		$this->db->select('*');
		$this->db->where([
			'deleted_at' => null,
			'is_active' => '1',
		]);
		$this->db->from($this->table);

		$i = 0;

		foreach ($this->column_search as $item) { // looping awal
			if ($_GET['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST

				if ($i === 0) // looping awal
				{
					$this->db->group_start();
					$this->db->like($item, $_GET['search']['value']);
				} else {
					$this->db->or_like($item, $_GET['search']['value']);
				}

				if (count($this->column_search) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}

		if ($_GET['order']) {
			$this->db->order_by($this->column_order[$_GET['order']['0']['column']], $_GET['order']['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	public function get_datatables()
	{
		$this->_get_datatables_query();
		if ($_GET['length'] != -1)
			$this->db->limit($_GET['length'], $_GET['start']);
		$query = $this->db->get();
		return $query->result();
	}

	public function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->where([
			'deleted_at' => null,
			'is_active' => '1',
		]);
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function updateRole($role_id, $user_id, $val)
	{
		$check = $this->checkUserRoleExist($role_id, $user_id);

		if ($check->num_rows() == 0) {
			if ($val == 1) {
				$this->db->insert('user_role', [
					'user_id' => $user_id,
					'role_id' => $role_id,
					'is_active' => $val,
				]);
			}
		} else {
			$this->db->where([
				'user_id' => $user_id,
				'role_id' => $role_id,
			]);
			$this->db->update('user_role', ['is_active' => $val]);
		}

		return $this->db->affected_rows();
	}

	public function checkUserRoleExist($role_id, $user_id)
	{
		$this->db->where([
			'user_id' => $user_id,
			'role_id' => $role_id,
		]);

		$this->db->from('user_role');
		$row = $this->db->get();

		return $row;
	}

	public function getRoleOfUser($user_id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where([
			'user_id' => $user_id,
			'is_active' => '1'
		]);
		$roles = $this->db->get()->result();

		return $roles;
	}
}

/* End of file Otoritas_model.php */
