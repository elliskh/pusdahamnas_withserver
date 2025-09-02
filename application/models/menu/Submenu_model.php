<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Submenu_model extends CI_Model
{

	public $table = 'menus';
	public $column_order = [null, 'menus.nama', 'menus.route', 'parent.parent_id', null, 'created_at'];
	public $column_search = ['menus.nama', 'menus.route', 'parent.nama'];
	public $order = ['menus.urutan' => 'asc'];

	private function _get_datatables_query()
	{
		$this->db->select('menus.*, parent.ref_menu_group_id, parent.nama as parent_name, (SELECT b.nama FROM ref_menu_group AS b WHERE b.id = parent.ref_menu_group_id) AS nama_group');
		$this->db->from($this->table);
		$this->db->join('menus parent', 'menus.parent_id = parent.id', 'inner');
		$this->db->where([
			'menus.deleted_at' => null,
			'menus.is_active' => '1',
		]);
		$this->db->where('menus.parent_id is not null');

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
		$this->db->where([
			'deleted_at' => null,
			'is_active' => '1',
		]);
		$this->db->where('parent_id is not null');
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}
}

/* End of file Submenu_model.php */
