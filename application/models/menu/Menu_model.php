<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{

	var $table = 'menus';
	var $column_order = [null, null, 'nama', 'route', 'icon', null, null, 'created_at'];
	var $column_search = ['nama', 'route', 'icon'];
	var $order = ['urutan' => 'asc'];

	private function _get_datatables_query()
	{
		$this->db->select(
			'*, (SELECT b.nama FROM ref_menu_group AS b WHERE b.id = ref_menu_group_id) AS nama_group'
		);
		$this->db->from($this->table);
		$this->db->where([
			'deleted_at' => null,
			'is_active' => '1',
		]);

		$this->db->group_start();
		$this->db->where('parent_id is null');
		$this->db->or_where('parent_id', '');
		$this->db->group_end();

		$i = 0;

		foreach ($this->column_search as $item) { // looping awal
			if (@$_GET['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST

				if ($i === 0) // looping awal
				{
					$this->db->group_start();
					$this->db->like($item, @$_GET['search']['value']);
				} else {
					$this->db->or_like($item, @$_GET['search']['value']);
				}

				if (count($this->column_search) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}

		if (@$_GET['order']) {
			$this->db->order_by($this->column_order[@$_GET['order']['0']['column']], @$_GET['order']['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	public function get_datatables()
	{
		$this->_get_datatables_query();
		if (@$_GET['length'] != -1)
			$this->db->limit(@$_GET['length'], @$_GET['start']);
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
		$this->db->where('deleted_at is null');
		$this->db->where('is_active', '1');
		$this->db->group_start();
		$this->db->where('parent_id is null');
		$this->db->or_where('parent_id', '');
		$this->db->group_end();
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function getMainMenu($ref_menu_group_id = null, $role_id = null)
	{
		$this->db->from($this->table);
		$this->db->join('menu_role', 'menus.id = menu_role.menu_id', 'inner');

		if (!empty($role_id)) $this->db->where('menu_role.role_id', $role_id);

		$this->db->where([
			'menu_role.is_active' => '1',
			'menus.is_active' => '1',
		]);

		$this->db->group_start();
		$this->db->where('menus.parent_id is null');
		$this->db->or_where('menus.parent_id', '');
		$this->db->group_end();
		if ($ref_menu_group_id) $this->db->where('ref_menu_group_id', $ref_menu_group_id);

		$this->db->select('menus.*');

		$this->db->order_by('menus.urutan', 'asc');
		$this->db->group_by('menus.id');

		$data = $this->db->get();

		return $data->result();
	}

	public function getSubMenu($parent_id, $role_id)
	{
		$this->db->from($this->table);
		$this->db->join('menu_role', 'menus.id = menu_role.menu_id', 'inner');
		$this->db->where([
			'menus.is_active' => '1',
			'menus.parent_id' => $parent_id,
			'menu_role.role_id' => $role_id,
			'menu_role.is_active' => '1',
		]);

		$this->db->select('menus.*');

		$this->db->order_by('menus.urutan', 'asc');
		$this->db->group_by('menus.id');

		$data = $this->db->get();

		return $data->result();
	}

	public function getAllMenu()
	{
		$this->db->where('menus.is_active', '1');
		$this->db->where('menus.deleted_at is null');
		$this->db->from($this->table);

		$data = $this->db->get();

		return $data->result();
	}
}

/* End of file Menu_model.php */
