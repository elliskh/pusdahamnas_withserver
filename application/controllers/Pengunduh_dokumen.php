<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pengunduh_dokumen extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->_auth();
		$this->_path = 'pengunduh_dokumen/';
		$this->_table = '';
		$this->link = base_url('pengunduh_dokumen');
		//=========================================================//

		$this->load->model('menu/Menu_model', 'menu');
		$this->load->model('data_dok/tb_dokumen_pengunduh', 'tb_dokumen_pengunduh');
	}

	public function index($menu_id = null)
	{
		method('get');
		// checkPermission($this->_path, $menu_id, 1);

		$config 			= [
			'title' 		=> 'Pengunduh Dokumen',
			'menu_id' 		=> $menu_id,
			'menu_active' 	=> 'Pengunduh Dokumen',
			'menu_open' 	=> null,
			'path' 			=> $this->_path,
			'contents' 		=> $this->_path . 'index',
			'script_js' 	=> $this->_path . 'js',
			//=========================================================//
			'breadcrumb' 	=> [
				'Utama', 'Pengunduh Dokumen', 'index'
			],
			'modals' 		=> [],
			'plugins' 		=> [
				'select2' => true,
				'swal' => true
			]
		];
		render($config); 
	}

	function get_data($menu_id) {
		// method('post');
		// checkPermission($this->_path, $menu_id, 1);
        $list = $this->tb_dokumen_pengunduh->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $row) {
            $no++;
			$aksi = "";
            $isi = array();
            $isi[] = $no;
            $isi[] = '<b>'.$row->nama.'</b>';
            $isi[] = $row->email;
            $isi[] = $row->instansi;
            $isi[] = $row->nama_dokumen;
            $isi[] = $row->tujuan;
            $isi[] = $row->created_at;

            $data[] = $isi;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->tb_dokumen_pengunduh->count_all(),
            "recordsFiltered" => $this->tb_dokumen_pengunduh->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
}

/* End of file Utama.php */
