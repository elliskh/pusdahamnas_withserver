<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Image_slide extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->_auth();
		$this->_path = 'image_slide/';
		$this->_table = 'tb_image_slide';
        $this->link = base_url('image_slide');
		//=========================================================//

		$this->load->model($this->_path . 'Image_slide_model', 'user');
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
			'title' => 'Gambar Depan',
			'menu_id' => $menu_id,
			'link' 			=> $this->link.'/tambah',
			'menu_active' => 'Gambar Depan',
			'menu_open' => null,
			'path' => $this->_path,
			'contents' =>  $this->_path . 'index',
			'script_js' 		=> $this->_path . 'js',
			//=========================================================//
		///	'roles' => $roles,
			//=========================================================//
			'breadcrumb' => ['Dashboard', 'Gambar Depan', 'index'],
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
        /*$xhr = TRUE; // if we decide to use XHR ajax
    	
    	// Saving new data
    	if ($xhr) {
    		header( 'Content-type: text/html; charset=utf-8' );
			
    	}
		method('post');
		///checkAccessAjax($this->_path, $menu_id, 2); 
		$gambar       = $this->security->xss_clean(post('gambar'));
		$deskripsi    = $this->security->xss_clean(post('deskripsi'));
        
		$insert = $this->db->insert('tb_image_slide', [
			'id_user'        => decrypt($this->session->userdata('id')),
			'gambar'         => $gambar,
			'deskripsi'      => $deskripsi,
		]);
        if($insert){
    		response([
    			'status' => 'sukses',
    			'message' => 'Data berhasil disimpan'
    		]);
            //echo "<script>alert('Data berhasil disimpan');history.go(-2);</script>";
        }else{
    		response([
    			'status' => false,
    			'message' => 'Data gagal disimpan'
    		]);   
            echo "<script>alert('Data berhasil disimpan')</script>";
        }
        echo json_encode($response); */
        
        $xhr = TRUE; // if we decide to use XHR ajax
    	
    	// Saving new data
    	if ($xhr) {
    		header( 'Content-type: text/html; charset=utf-8' );
			
    	}
		method('post');
	///	checkAccessAjax($this->_path, $menu_id, 3);

		$gambar    = post('gambar');
		$deskripsi = post('deskripsi');
        chmod('./uploads/gambar_slide', 0777);
            $config = array( 
                             'upload_path' => './uploads/gambar_slide',
                             'allowed_types' => "jpg|png|jpeg",
    					     'max_size' => '20000',
    					     'encrypt_name' => true,
                             'overwrite' => FALSE,                              
                             );
            $this->load->library('upload', $config);
			$file_name = $this->upload->data('file_name');
			$orig_name = $this->upload->data('orig_name');
			$file_path = $this->upload->data('file_path');
			$file_size = $this->upload->data('file_size');
             
            if ( ! $this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
               // print_r($error);
					$data = [
                			'id_user'        => decrypt($this->session->userdata('id')),
                			'gambar'         => '$file_name',
                			'deskripsi'      => $deskripsi,
					];

            	//$insert = $this->db->insert("tb_image_slide", $data);
            } else {
                $arr_image = array('upload_data' => $this->upload->data());
                // print_r($arr_image);
					$data = [
                			'id_user'        => decrypt($this->session->userdata('id')),
                			'gambar'         => $file_name,
                			'deskripsi'      => $deskripsi,
					];

            	//$insert = $this->db->insert("tb_image_slide", $data);
            }       
            
            $this->load->library('upload', $this->config); 
            if($this->upload->do_upload('gambar')) { 
    						$file_name = $this->upload->data('file_name');
							$orig_name = $this->upload->data('orig_name');
							$file_path = $this->upload->data('file_path');
							$file_size = $this->upload->data('file_size');
    							$data = [
                            			'id_user'        => decrypt($this->session->userdata('id')),
                            			'gambar'         => $file_name,
                            			'deskripsi'      => $deskripsi,
    							];
	
                        	$insert = $this->db->insert("tb_image_slide", $data);
        						//$this->session->set_flashdata('success', 'Berhasil menambahkan.');
        						///redirect(base_url('image_slide/index/'.$menu_id));
                            if($insert){
                            		response([
                            			'status' => 'sukses',
                            			'message' => 'Data berhasil disimpan'
                            		]); 
                            }else{
                            		response([
                            			'status' => 'error',
                            			'message' => 'Data gagal disimpan'
                            		]);   
                            }        
            } else { 
                ///echo $this->upload->display_errors(); 
               	response([
        			'status' => 'error',
        			'message' => 'Data berhasil disimpan'
        		]); 
            } 

        
	}

	public function tambah($menu_id = null)
	{
		method('get');
	//	checkPermission($this->_path, $menu_id, 2);
        
		$config 			= [
			'title' 		=> 'Tambah Data Gambar',
			'menu_id' 		=> $menu_id,
			'link' 			=> $this->link,
			'menu_active' 	=> 'Gambar Depan',
			'menu_open' 	=> null,
			'path' 			=> $this->_path,
			'contents' 		=> $this->_path . 'tambah',
			'script_js' 	=> $this->_path . 'tambah_js',
			//=========================================================//
			'breadcrumb' 	=> [
				'Dashboard', 'Gambar Depan', 'index'
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
        $data['detail'] = $this->db->select('a.id, a.gambar, a.deskripsi, a.is_active')->where('a.id', $id)->get('tb_image_slide a')->row_array();

        
		$config 			= [
			'title' 		=> 'Edit Gambar',
			'menu_id' 		=> $menu_id,
			'link' 			=> $this->link,
            'data'          => $data,
			'menu_active' 	=> 'Edit Gambar',
			'menu_open' 	=> null,
			'path' 			=> $this->_path,
			'contents' 		=> $this->_path . 'ubah',
			'script_js' 	=> $this->_path . 'ubah_js',
			//=========================================================//
			'breadcrumb' 	=> [
				'Dashboard', 'Edit Gambar', 'index'
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

		$id        = decode_id($id);
		$gambar    = post('gambar');
		$deskripsi = post('deskripsi');
            $config = array( 
                             'upload_path' => './uploads/gambar_slide',
                             'allowed_types' => "jpg|png|jpeg",
    					     'max_size' => '20000',
    					     'encrypt_name' => true,
                             'overwrite' => FALSE,                              
                             );
             $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
               // print_r($error);
    							$data_update = [
                            			'id_user'        => decrypt($this->session->userdata('id')),
                            			'deskripsi'      => $deskripsi,
    							];
	
                        	$update = $this->db->where('id',$id)->update("tb_image_slide", $data_update);
            } else {
                $arr_image = array('upload_data' => $this->upload->data());
               // print_r($arr_image);
            }       
            $this->load->library('upload', $this->config); 
            if($this->upload->do_upload('gambar')) { 
    						$file_name = $this->upload->data('file_name');
							$orig_name = $this->upload->data('orig_name');
							$file_path = $this->upload->data('file_path');
							$file_size = $this->upload->data('file_size');
    							$data_update = [
                            			'id_user'        => decrypt($this->session->userdata('id')),
                            			'gambar'         => $file_name,
                            		//	'deskripsi'      => $deskripsi,
    							];
	
                        	$update = $this->db->where('id',$id)->update("tb_image_slide", $data_update);
        						//$this->session->set_flashdata('success', 'Berhasil menambahkan.');
        						///redirect(base_url('image_slide/index/'.$menu_id));
                            		response([
                            			'status' => 'sukses',
                            			'message' => 'Data berhasil disimpan'
                            		]); 
            } else { 
                ///echo $this->upload->display_errors(); 
               	response([
        			'status' => 'sukses',
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

		$konten_id = decrypt($id);
		$val = post('val');
      
      ///  $check_actived = $this->user->checkKontenActive();

    		$this->db->where('id', $konten_id);
    	$update = $this->db->update('tb_image_slide', [
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
		checkAccessAjax($this->_path, $menu_id, 4);

		$id = post('id');

		if (empty($id)) {
			response([
				'status' => false,
			], 404);

			return false;
		}

		$konten_id = decrypt($id);

		$this->db->where('id', $konten_id);
		$this->db->update('tb_image_slide', ['is_active' => '0','deleted_at' => 'Y']);

		response([
			'status' => true,
			'message' => 'Data berhasil dihapus'
		]);
	}

}

/* End of file Rollisu.php */
