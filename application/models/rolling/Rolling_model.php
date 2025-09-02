<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Rolling_model extends CI_Model
{
	public $table = 'tb_rolling';
	public $column_order = [null, 'editor','nama', 'is_active', null, 'deleted_at'];
	public $column_search = ['nama', 'is_active'];
	public $order = ['id' => 'asc'];

	private function _get_datatables_query()
	{
		$this->db->select('id, editor, nama, is_active, deleted_at');
		$this->db->where(['deleted_at' => null,	]);
		$this->db->from($this->table);
		///$this->db->join('(SELECT GROUP_CONCAT( user_role.role_id ) AS roles, user_id FROM user_role WHERE user_role.is_active = "1" GROUP BY user_role.user_id) as user_role', 'users.id = user_role.user_id', 'left');

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
		]);
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function checkUsername()
	{
		$this->db->from($this->table);
		///$this->db->where('nama', $nama);
		$this->db->where('is_active =', 1);

		$data = $this->db->get();

		return (int) $data->num_rows();
	}

	public function check()
	{
	/*	$id = decrypt(post('id'));
		if (!$id) show_404();

		$data = $this->db->get_where('tb_rolling', ['id' => $id])->row();
		if (!$data) show_404();

		return $id;*/
	}
}

/* End of file User_model.php */
