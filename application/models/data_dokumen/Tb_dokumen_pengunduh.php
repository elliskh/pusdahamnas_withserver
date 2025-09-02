<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tb_dokumen_pengunduh extends CI_Model
{
    var $column_order = array(null); //field yang ada di table user
    var $column_search = array('nama','email','tujuan','nama_dokumen','instansi'); //field yang diizin untuk pencarian 
    var $order = array('b.created_at' => 'desc'); // default order

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        // $this->db->from("v_tb_dokumen a");
        $this->db->from("tb_dokumen a");
        $this->db->join("tb_dokumen_pengunduh b", "a.id=b.id_dokumen");
        if ($this->session->userdata('id_lembaga')>0)
        {
            $this->db->where('a.id_lembaga',$this->session->userdata('id_lembaga'));
        }
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
            $this->db->order_by('b.created_at','desc');
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
