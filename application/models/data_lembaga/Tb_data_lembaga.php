<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tb_data_lembaga extends CI_Model
{
    var $column_order = array('','nama_lembaga','singkatan_lembaga'); //field yang ada di table user
    var $column_search = array('nama_lembaga', 'singkatan_lembaga', 'is_active', 'status'); //field yang diizin untuk pencarian 
    var $order = array('nama_lembaga' => 'asc'); // default order

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        $this->db->select('*');
        $this->db->from("tb_lembaga");
        // $this->db->join('ref_subyek_dokumen b','a.id_topik_subyek=b.id_subyek','left');
        // $this->db->join('ref_hak_dokumen c','a.id_topik_hak=c.id_hak','left');
        $this->db->where('deleted_at IS NULL',null);

        $i = 0;

        foreach ($this->column_search as $item) // looping awal
        {
            if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {

                if ($i === 0) // looping awal
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir'],false);
        } else{
            $this->db->order_by('nama_lembaga','asc');
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $this->db->count_all_results();
    }
}