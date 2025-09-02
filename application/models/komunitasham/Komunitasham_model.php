<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Komunitasham_model extends CI_Model
{ 
	public $table = 'tb_komunitasham';
	public $column_order = [null, 'jenis_konten','judul','isi_konten','deskripsi','editor','penulis','sumber_data','cover','is_active', null, 'deleted_at'];
	public $column_search = ['judul', 'is_active'];
	public $order = ['id' => 'asc'];

	private function _get_datatables_query()
	{
	//	$this->db->select('id, id_user, jenis_konten, judul, isi_konten, deskripsi, editor, penulis, sumber_data, cover, is_active, deleted_at');
	//	$this->db->where(['deleted_at' => null,	]);
	//	$this->db->from($this->table);

     $this->db->select("a.*, c.id as user_id, c.username, c.nama, c.tipe_daftar, c.is_active as user_is_active");
     $this->db->from('tb_komunitasham a');
     $check_ss = decrypt($this->session->userdata('id'));
   //s if($check_ss==30){ //remove
      //$where = "a.deleted_at' => null"; 
      $this->db->where(['a.deleted_at' => null,	]);
      $this->db->join('users c', 'c.id = a.id_user');
    /*}else{
      $this->db->where(['a.deleted_at' => null,	'a.id_user' => $check_ss]);
      $this->db->join('users c', 'c.id = a.id_user');
    }*/
      $this->db->order_by("a.id", "desc");
     ///$this->db->join('tb_dataisuprioritas b', 'a.jenis_konten = b.id');
     ///$query = $this->db->get();
        
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
