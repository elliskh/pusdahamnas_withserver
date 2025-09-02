<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Visualisasi extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->_auth();
		$this->_path = 'visualisasi/';
		$this->_table = 'tb_visualisasi';
        $this->link = base_url('visualisasi');
		//=========================================================//

		$this->load->model($this->_path . 'visualisasi_model', 'user');
	//	$this->load->model('otoritas/Otoritas_model', 'otoritas');
	}

	public function index($menu_id = null)
	{
		method('get');
		checkPermission($this->_path, $menu_id, 1);
		//=========================================================//

	//	$roles = $this->db->where([
	//		'is_active' => '1',
	//	])->get('roles')->result();

		$config = [
			'title' => 'Visualisasi Data',
			'menu_id' => $menu_id,
			'link' 			=> $this->link.'/tambah',
			'menu_active' => 'Visualisasi Data',
			'menu_open' => null,
			'path' => $this->_path,
			'contents' =>  $this->_path . 'index',
			'script_js' 		=> $this->_path . 'js',
			//=========================================================//
		///	'roles' => $roles,
			//=========================================================//
			'breadcrumb' => ['Dashboard', 'Visualisasi Data', 'index'],
			'modals' => [],
            /*'modals' => [
				$this->_path . 'modals/tambah',
				$this->_path . 'modals/ubah',
				//$this->_path . 'modals/otoritas',
			],*/
			'plugins' => [
				'datatable' => true,
				'swal' => true,
				'select2' => true,
				'jquery_validate' => true,
			]
		];

		render($config);
	}

	public function data($menu_id = null)
	{
		method('get');
	///	checkAccessAjax($this->_path, $menu_id, 1);

		$list = $this->user->get_datatables();

		$data = [];
		$no = $_GET['start'];

		foreach ($list as $field) {
			$no++;

			$field->no = $no;
			$field->id = encrypt($field->id);
            
			$data[] = $field;
		}         

		$output = [
			'draw' => $_GET['draw'],
			'recordsTotal' => $this->user->count_all(),
			'recordsFiltered' => $this->user->count_filtered(),
			'data' => $data,
		];

		response($output);
	}

	public function simpan()
	{
		method('post');
		///checkAccessAjax($this->_path, $menu_id, 2); 

        
        $xhr = TRUE; // if we decide to use XHR ajax
    	
    	// Saving new data
    	if ($xhr) {
    		header( 'Content-type: text/html; charset=utf-8' );
			
    	}

		$judul = post('judul');
		$looker_studio = post('looker_studio');
					$data = [
                			'judul'  => $judul,
                			'looker_studio'  => $looker_studio,
                			'created_at'     => date('Y-m-d H:i:s'),
					];

            	$insert = $this->db->insert("tb_visualisasi", $data);
              
           if($insert){     
                echo "<script>alert('Simpan data berhasil')</script>";
        		response([
        			'status' => 'sukses',
        			'message' => 'Data berhasil disimpan'
        		]); 
            } else { 
                echo "<script>alert('Simpan data gagal!')</script>";
               	response([
        			'status' => 'gagal',
        			'message' => 'Data gagal disimpan'
        		]); 
            } 

        
	}

	public function tambah($menu_id = null)
	{
		method('get');
	//	checkPermission($this->_path, $menu_id, 2);
        
		$config 			= [
			'title' 		=> 'Tambah Visualisasi data',
			'menu_id' 		=> $menu_id,
			'link' 			=> $this->link,
			'menu_active' 	=> 'Visualisasi Data',
			'menu_open' 	=> null,
			'path' 			=> $this->_path,
			'contents' 		=> $this->_path . 'tambah',
			'script_js' 	=> $this->_path . 'tambah_js',
			//=========================================================//
			'breadcrumb' 	=> [
				'Dashboard', 'Visualisasi Data', 'index'
			],
			'modals' 		=> [],
			'plugins' => [
				'select2' => true
			]
		];

		render($config);
	} 
 
	public function edit_konten($menu_id = null)
	{

		method('get');
		//checkPermission($this->_path, $menu_id, 2);
        $id = decrypt($this->uri->segment(3));

        if ($id==null)
			redirect(base_url());
        $data = [
        	'id' => $id,
        ];
        $data['detail'] = $this->db->select('a.id, a.judul, a.looker_studio, a.is_active')->where('a.id', $id)->get('tb_visualisasi a')->row_array();

        
		$config 			= [
			'title' 		=> 'Edit Visualisasi Data',
			'menu_id' 		=> $menu_id,
			'link' 			=> $this->link,
            'data'          => $data,
			'menu_active' 	=> 'Visualisasi Data',
			'menu_open' 	=> null,
			'path' 			=> $this->_path,
			'contents' 		=> $this->_path . 'ubah',
			'script_js' 	=> $this->_path . 'ubah_js',
			//=========================================================//
			'breadcrumb' 	=> [
				'Dashboard', 'Edit Looker studio', 'index'
			],
			'modals' 		=> [],
			'plugins' => [
				'select2' => true
			]
		];

		render($config);
	} 
 
	public function edit_update($menu_id = null)
	{	   
        $xhr = TRUE; // if we decide to use XHR ajax
    	
    	// Saving new data
    	if ($xhr) {
    		header( 'Content-type: text/html; charset=utf-8' );
			
    	}
		method('post');
	///	checkAccessAjax($this->_path, $menu_id, 3);

		$id = post('idkonten');
 
		if (empty($id)) {
			response([
				'status' => false,
				'mssg'   => 'Data tidak ditemukan'
			]);
		}

		$id            = decode_id($id);
		$judul = post('judul');
		$looker_studio = post('looker_studio');

			$data_update = [
            			'judul'  => $judul,
            			'looker_studio'  => $looker_studio,
				];

        	$update = $this->db->where('id',$id)->update("tb_visualisasi", $data_update);
      
            if($update) { 
        		response([
        			'status' => 'sukses',
        			'message' => 'Data berhasil disimpan'
        		]); 
            } else { 
               	response([
        			'status' => 'gagal',
        			'message' => 'Data berhasil disimpan'
        		]); 
            } 

	}

	public function changeKontenActive($menu_id = null)
	{
        $xhr = TRUE; // if we decide to use XHR ajax
    	
    	// Saving new data
    	if ($xhr) {
    		header( 'Content-type: text/html; charset=utf-8' );
			
    	}
        
		method('post');
		checkAccessAjax($this->_path, $menu_id, 3);

		$id = post('id');
        
		if (empty($id)) {
			response([
				'status' => false,
			], 404);
		}

		$id = decrypt($id);
		$val = post('val');
      
      ///  $check_actived = $this->user->checkKontenActive();

    	$this->db->where('id', $id);
    	$update = $this->db->update('tb_visualisasi', [
    			'is_active' => $val,
    		]);
        if($update){
    		response([
    			'status' => true,
    			'message' => 'Data berhasil disimpan',
    		]);		  
		}else{
    		response([
    			'status' => false,
    			'message' => 'Data gagal disimpan',
    		]);		  
		  
		}

	}


	public function deleteKonten($menu_id = null)
	{
		//checkAccessAjax($this->_path, $menu_id, 4);

		$id = post('id');

		if (empty($id)) {
			response([
				'status' => false,
			], 404);

			return false;
		}

		$id = decrypt($id);

		$this->db->where('id', $id);
		$this->db->update('tb_visualisasi', ['is_active' => '0','deleted_at' => date('Y-m-d H:i:s')]);

		response([
			'status' => true,
			'message' => 'Data berhasil dihapus'
		]);
	}

}

/* End of file Rollisu.php */
