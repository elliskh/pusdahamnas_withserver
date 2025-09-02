<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Ras_etnis extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->_auth(); 
		$this->_path = 'snp/ras_etnis/';
		$this->_table = 'tb_snp';
        $this->link = base_url('snp/ras_etnis');
		//=========================================================//

		$this->load->model($this->_path . 'Rasetnis_model', 'user');
		$this->load->model($this->_path . 'Detail_rasetnis_model', 'detail');
	//	$this->load->model('otoritas/Otoritas_model', 'otoritas');
	}

	public function index($menu_id = null)
	{
		method('get');
		//checkPermission($this->_path, $menu_id, 1);
		//=========================================================//

	//	$roles = $this->db->where([
	//		'is_active' => '1',
	//	])->get('roles')->result();

		$config = [
			'title' => 'Data SNP',
			'menu_id' => $menu_id,
			'link' 			=> $this->link.'/tambah',
			'menu_active' => 'Data SNP',
			'menu_open' => null,
			'path' => $this->_path,
			'contents' =>  $this->_path . 'index',
			'script_js' 		=> $this->_path . 'js',
			//=========================================================//
		///	'roles' => $roles,
			//=========================================================//
			'breadcrumb' => ['Dashboard', 'Data SNP', 'index'],
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

		$list  = $this->user->get_datatables();
        $field = '';
		$data  = [];
		$no    = $_GET['start'];
      if($list){
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
       }else{
           $data[] = $field; 
           $data['data'] = [];  // jika data empty
    		$output = [
    			'draw' => $_GET['draw'],
    			'recordsTotal' => $this->user->count_all(),
    			'recordsFiltered' => $this->user->count_filtered(),
    			'data' => $data,
    		];
       } 

		response($output);
	}

	public function detail_rasetnis($menu_id = null) {
		method('get');
		///checkPermission($this->_path, $menu_id, 1);
		//=========================================================//
        $id = decrypt($this->uri->segment(4));
        $data['detail'] = $this->db->select('*')->where('id', $id)->get('tb_snp')->row_array();

	//	$roles = $this->db->where([
	//		'is_active' => '1',
	//	])->get('roles')->result();

		$config = [
			'title' => 'Detail Data SNP',
			'menu_id' => $menu_id,
			'link' 			=> $this->link.'/detail_tambah',
			'menu_active' => 'Detail Data SNP',
			'menu_open' => null,
			'path' => $this->_path,
            'data' => $data,
			'contents' =>  $this->_path . 'detail_rasetnis',
			'script_js' 		=> $this->_path . 'detail_rasetnis_js',
			//=========================================================//
		///	'roles' => $roles,
			//=========================================================//
			'breadcrumb' => ['Dashboard', 'Detail Data SNP', 'Detail'],
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

	public function detail_data($id=null)
	{
		method('get');
	///	checkAccessAjax($this->_path, $menu_id, 1);
    //  $id = decrypt($this->session->ss_detailAnggaran);//$this->uri->segment(3); 
        
		$list = $this->detail->get_datatables();

		$data = [];
		$no = $_GET['start'];
        $field = '';
        if(!empty($list)){
    		foreach ($list as $field) {
    			$no++;
    
    			$field->no = $no;
    			$field->id = encrypt($field->id);
    			$field->detail_id = encrypt($field->detail_id);
                
    			$data[] = $field;
    		}            
        }else{
           $data[] = $field; 
           $data['data'] = [];  // jika data empty
        }     

		$output = [
			'draw' => $_GET['draw'],
			'recordsTotal' => $this->detail->count_all(),
			'recordsFiltered' => $this->detail->count_filtered(),
			'data' => $data,
		];
    	response($output);
	}

	public function simpan()
	{
        $xhr = TRUE; // if we decide to use XHR ajax
    	
    	// Saving new data
    	if ($xhr) {
    		header( 'Content-type: text/html; charset=utf-8' );
			
    	}
		method('post');
		///checkAccessAjax($this->_path, $menu_id, 2);
 
		$judul     = $this->security->xss_clean(post('judul'));
		$deskripsi = $this->security->xss_clean(post('deskripsi'));
        
		/*$insert = $this->db->insert('tb_snp', [
			//'id_user'        => '50',///decrypt($this->session->userdata('id')),
			'judul'          => $judul,
			'deskripsi'      => $deskripsi,
			'is_active'      => '1',
		]);*/
        $data = [
			'judul'          => $judul,
			'deskripsi'      => $deskripsi,
			'is_active'      => '1',
        ];
        $insert        = $this->db->insert('tb_snp',$data);
        $insert_id     = $this->db->insert_id();
        /*$insert_detail = $this->db->insert('tb_snp_detail', [
			'id_snp'         => $insert_id,
			'is_active'      => '1',
		    ]);*/
        
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
            echo "<script>alert('Data gagal disimpan')</script>";
        }
        echo json_encode($response); 
	}

	public function tambah($menu_id = null)
	{
		method('get');
	//	checkPermission($this->_path, $menu_id, 2);
        
		$config 			= [
			'title' 		=> 'Tambah Data SNP',
			'menu_id' 		=> $menu_id,
			'link' 			=> $this->link,
			'menu_active' 	=> 'Tambah Data SNP',
			'menu_open' 	=> null,
			'path' 			=> $this->_path,
			'contents' 		=> $this->_path . 'tambah',
			'script_js' 	=> $this->_path . 'tambah_js',
			//=========================================================//
			'breadcrumb' 	=> [
				'Dashboard', 'Tambah Data SNP', 'index'
			],
			'modals' 		=> [],
			'plugins' => [
				'select2' => true
			]
		];

		render($config);
	} 

	public function detail_simpan()
	{
        $xhr = TRUE; // if we decide to use XHR ajax
    	
    	// Saving new data
    	if ($xhr) {
    		header( 'Content-type: text/html; charset=utf-8' );
			
    	}
		method('post');
		///checkAccessAjax($this->_path, $menu_id, 2);
        $id        = $this->security->xss_clean(post('id'));
		$bab       = $this->security->xss_clean(post('bab'));
		$halaman   = $this->security->xss_clean(post('nomor_halaman'));
		$paragraf  = $this->security->xss_clean(post('nomor_paragraf'));
		$deskripsi = $this->security->xss_clean(post('deskripsi'));
        
		 if ($_FILES['dokumen']['size'] != 0 && $_FILES['dokumen']['error'] == 0)
		 	{
		 		$dir = './uploads/dokumen_snp';
		 		if (!is_dir($dir)) {
		 			mkdir($dir, 0777, TRUE);
		 		}

            $config = array( 
                             'upload_path' => './uploads/dokumen_snp',
                             'allowed_types' => "pdf|doc|docx|xls|xlsx|jpg|png|jpeg",
    					     'max_size' => '20000',
    					     'encrypt_name' => true,
                             'overwrite' => FALSE,                              
                             );
            $this->load->library('upload', $config);
	
		 		if($this->upload->do_upload('dokumen')) {
		 			$uploaded = $this->upload->data();
		 					$file_name = $this->upload->data('file_name');
		 					$orig_name = $this->upload->data('orig_name');
		 					$file_path = $this->upload->data('file_path');
		 					$file_size = $this->upload->data('file_size');
            		$insert = $this->db->insert('tb_snp_detail', [
            			'id_snp'         => decrypt($id),
            			'bab'            => $bab,
            			'nomor_halaman'  => $halaman,
            			'nomor_paragraf' => $paragraf,
            			'deskripsi'      => $deskripsi,
            			'dokumen'        => $file_name,
            			'is_active'      => '1',
            		]);	
						
		 			if($this->db->affected_rows()>0){
		 				//$this->session->set_flashdata('success', 'Berhasil menambahkan.');
		 				//redirect(base_url('data_ahli/index/'.$menu_id));
		 			} else{
		 				//$this->session->set_flashdata('failed', 'Simpan data gagal');
		 				//redirect(base_url('data_ahli/index/'.$menu_id));
		 			}
		 		}else{
		 			//echo $this->upload->display_errors();die;
		 		}
		 	}else{        
            		$insert = $this->db->insert('tb_snp_detail', [
            			'id_snp'         => decrypt($id),
            			'bab'            => $bab,
            			'nomor_halaman'  => $halaman,
            			'nomor_paragraf' => $paragraf,
            			'deskripsi'      => $deskripsi,
            			'is_active'      => '1',
            		]);		 	    
		 	} 
        
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
            echo "<script>alert('Data gagal disimpan')</script>";
        }
        echo json_encode($response); 
	}

	public function detail_tambah($menu_id = null)
	{
		method('get');
	//	checkPermission($this->_path, $menu_id, 2);
        
		$config 			= [
			'title' 		=> 'Tambah Data Detail',
			'menu_id' 		=> $menu_id,
			'link' 			=> $this->link,
			'menu_active' 	=> 'Detail SNP',
			'menu_open' 	=> null,
			'path' 			=> $this->_path,
			'contents' 		=> $this->_path . 'detail_tambah',
			'script_js' 	=> $this->_path . 'detail_tambah_js',
			//=========================================================//
			'breadcrumb' 	=> [
				'Dashboard', 'Detail SNP', 'index'
			],
			'modals' 		=> [],
			'plugins' => [
				'select2' => true
			]
		];

		render($config);
	} 
 
	public function edit_rasetnis($menu_id = null)
	{

		method('get');
		//checkPermission($this->_path, $menu_id, 2);
        $id = decrypt($this->uri->segment(4));

        if ($id==null)
			redirect(base_url());
        $data = [
        	'id' => $id,
        ];
        $data['detail'] = $this->db->select('*')->where('id', $id)->get('tb_snp')->row_array();

        
		$config 			= [
			'title' 		=> 'Edit Data SNP',
			'menu_id' 		=> $menu_id,
			'link' 			=> $this->link,
			//'jenis' 		=> $jenis,
            'data'          => $data,
			'menu_active' 	=> 'Data SNP',
			'menu_open' 	=> null,
			'path' 			=> $this->_path,
			'contents' 		=> $this->_path . 'ubah',
			'script_js' 	=> $this->_path . 'ubah_js',
			//=========================================================//
			'breadcrumb' 	=> [
				'Dashboard', 'Data SNP', 'index'
			],
			'modals' 		=> [],
			'plugins' => [
				'select2' => true
			]
		];

		render($config);
	} 
 
	public function update($menu_id = null)
	{
        $xhr = TRUE; // if we decide to use XHR ajax
    	
    	// Saving new data
    	if ($xhr) {
    		header( 'Content-type: text/html; charset=utf-8' );
			
    	}
		method('post', true);
	///	checkAccessAjax($this->_path, $menu_id, 3);

		$id = post('id');
 
		if (empty($id)) {
			response([
				'status' => false,
				'mssg' => 'Data tidak ditemukan'
			]);
		}

		$id     = decode_id($id);//decrypt($id);
		$judul  = post('judul');
		$deskripsi = post('deskripsi');

		$this->db->where('id', $id);
		$this->db->update('tb_snp', [
		///	'id_user'        => decrypt($this->session->userdata('id')),
            'judul'       => $judul,
			'deskripsi'   => $deskripsi,
		]);

		response([
			'status' => 'sukses',
			'message' => 'Data berhasil disimpan'
		]);
	}

	public function detail_edit_rasetnis($menu_id = null)
	{
		method('get');
		//checkPermission($this->_path, $menu_id, 2);
        $id = decrypt($this->uri->segment(4));

        if ($id==null)
			redirect(base_url());
        $data = [
        	'id' => $id,
        ];
        $data['detail'] = $this->db->select('*')->where('id', $id)->get('tb_snp_detail')->row_array();
        
		$config 			= [
			'title' 		=> 'Edit Data Detail SNP',
			'menu_id' 		=> $menu_id,
			'link' 			=> $this->link,
			//'jenis' 		=> $jenis,
            'data'          => $data,
			'menu_active' 	=> 'Data Detail SNP',
			'menu_open' 	=> null,
			'path' 			=> $this->_path,
			'contents' 		=> $this->_path . 'detail_ubah',
			'script_js' 	=> $this->_path . 'detail_ubah_js',
			//=========================================================//
			'breadcrumb' 	=> [
				'Dashboard', 'Detail SNP', 'index'
			],
			'modals' 		=> [],
			'plugins' => [
				'select2' => true
			]
		];

		render($config);
	} 

	public function detail_update($menu_id = null)
	{
        $xhr = TRUE; // if we decide to use XHR ajax
    	
    	// Saving new data 
    	if ($xhr) {
    		header( 'Content-type: text/html; charset=utf-8' );
			
    	}
		method('post', true);
	///	checkAccessAjax($this->_path, $menu_id, 3);
        //$id = decrypt($this->uri->segment(4));
   
		$id = decode_id(post('id'));    
        //$id = decrypt($this->uri->segment(4));
 
		if (empty($id)) {
			response([
				'status' => false,
				'mssg' => 'Data tidak ditemukan'
			]);
		}

		$id        = $id;
		$bab       = post('bab');
		$halaman   = post('nomor_halaman');
		$paragraf  = post('nomor_paragraf');
		$deskripsi = post('deskripsi');

		$this->db->where('id', $id);
		$this->db->update('tb_snp_detail', [
		///	'id_user'        => decrypt($this->session->userdata('id')),
            'bab'            => $bab,
            'nomor_halaman'  => $halaman,
            'nomor_paragraf' => $paragraf,
			'deskripsi'      => $deskripsi,
		]);

		response([
			'status' => 'sukses',
			'message' => 'Data berhasil disimpan'
		]);
	}

	public function changeAnggaranHamActive($menu_id = null)
	{
        $xhr = TRUE; // if we decide to use XHR ajax
    	
    	// Saving new data
    	if ($xhr) {
    		header( 'Content-type: text/html; charset=utf-8' );
			
    	}
        
		method('post');
		//checkAccessAjax($this->_path, $menu_id, 3);

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
    	$update = $this->db->update('tb_snp', [
    			'is_active' => $val,
    		]);
        if($update){
    		response([
    			'status' => 'sukses',
    			'message' => 'Data berhasil disimpan',
    		]);		  
		}else{
    		response([
    			'status' => false,
    			'message' => 'Data gagal disimpan',
    		]);		  
		  
		}

	}

	public function changeDetailYaTidak($menu_id = null)
	{
        $xhr = TRUE; // if we decide to use XHR ajax
    	
    	// Saving new data
    	if ($xhr) {
    		header( 'Content-type: text/html; charset=utf-8' );
			
    	}
        
		method('post');
	//	checkAccessAjax($this->_path, $menu_id, 3);

		$id = post('id');
        
		if (empty($id)) {
			response([
				'status' => false,
			], 404);
		}
		$detail_id = decrypt($id);
		$val = post('val');
      
    		$this->db->where('id', $detail_id);
            $update = $this->db->update('tb_snp_detail', [
    			'ya_tidak' => $val,
    		]);
        if($update){
    		response([
    			'status' => 'Sukses',
    			'message' => 'Data berhasil disimpan',
    		]);		  
		}else{
    		response([
    			'status' => false,
    			'message' => 'Data gagal disimpan',
    		]);		  
		  
		}

	}
    
	public function changeDetailActivePublic($menu_id = null)
	{
        $xhr = TRUE; // if we decide to use XHR ajax
    	
    	// Saving new data
    	if ($xhr) {
    		header( 'Content-type: text/html; charset=utf-8' );
			
    	}
        
		method('post');
	//	checkAccessAjax($this->_path, $menu_id, 3);

		$id = post('id');
        
		if (empty($id)) {
			response([
				'status' => false,
			], 404);
		}
		$detail_id = decrypt($id);
		$val = post('val');
      
    		$this->db->where('id', $detail_id);
    	    $is_active = '0';
            if($val==1){
    	       $is_active = '1';
    	    }else{
    	       $is_active = '0';
    	    }
            $update = $this->db->update('tb_snp_detail', [
                'is_active' => $is_active,
    		]);
        if($update){
    		response([
    			'status' => 'Sukses',
    			'message' => 'Data berhasil disimpan',
    		]);		  
		}else{
    		response([
    			'status' => false,
    			'message' => 'Data gagal disimpan',
    		]);		  
		  
		}

	}


	public function deleteAnggaranHam($menu_id = null)
	{
	//	checkAccessAjax($this->_path, $menu_id, 4);
        method('post');
		$id = post('id');

		if (empty($id)) {
			response([
				'status' => false,
			], 404);

			return false;
		}

		$id = decrypt($id);

		$this->db->where('id', $id);
		$this->db->update('tb_snp', ['is_active' => '0','deleted_at' => 'Y']);

		response([
			'status' => true,
			'message' => 'Data berhasil dihapus'
		]);
	}
    
	public function deleteDetailAnggaran($menu_id = null)
	{
	//	checkAccessAjax($this->_path, $menu_id, 4);
        method('post');
		$id = post('detail_id');
        //$id = post('detail_id');

		if (empty($id)) {
			response([
				'status' => false,
			], 404);

			return false;
		}

		$id = decrypt($id);

		$this->db->where('id', $id);
		$this->db->update('tb_snp_detail', ['is_active' => '0','deleted_at' => 'Y']);

		response([
			'status' => true,
			'message' => 'Data berhasil dihapus'
		]);
	}

}

/* End of file Rollisu.php */
