<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Status_komunitasham_model extends CI_Model
{ 
	public $table = 'users';
	public $column_order = [null, 'id','username','nama','status_approved', null, 'deleted_at'];
	public $column_search = ['username', 'nama'];
	public $order = ['id' => 'asc'];

	private function _get_datatables_query()
	{
      $this->db->select("a.id, a.username, a.nama, a.status_approved, a.deleted_at, a.tipe_daftar");
      $this->db->from('users a');      
      $check_ss = decrypt($this->session->userdata('id'));

    ///if($check_ss==30){ 
      $this->db->where(['a.deleted_at' => null,	'a.tipe_daftar' => 2]);
      //$this->db->join('users c', 'a.id_user = c.id');
    /*}else{
      $this->db->where(['a.deleted_at' => null,	'a.id' => $check_ss]);
      //$this->db->join('users c', "c.id = $check_ss");
    }*/
     /// $this->db->join('tb_dataisuprioritas b', 'a.jenis_konten = b.id');
      //$query = $this->db->get();
        
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

	public function checkKontenActive()
	{
		$this->db->from($this->table);
		///$this->db->where('nama', $nama);
		$this->db->where('status_approved =', 1);

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
