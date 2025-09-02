<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Anggaran_ham extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->_auth(); 
		$this->_path = 'anggaran_ham/';
		$this->_table = 'tb_anggaran_ham';
        $this->link = base_url('anggaran_ham');
		//=========================================================//

		$this->load->model($this->_path . 'Anggaranham_model', 'user');
		$this->load->model($this->_path . 'Detail_anggaranham_model', 'detail');
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
			'title' => 'Anggaran ramah HAM',
			'menu_id' => $menu_id,
			'link' 			=> $this->link.'/tambah',
			'menu_active' => 'Anggaran ramah HAM',
			'menu_open' => null,
			'path' => $this->_path,
			'contents' =>  $this->_path . 'index',
			'script_js' 		=> $this->_path . 'js',
			//=========================================================//
		///	'roles' => $roles,
			//=========================================================//
			'breadcrumb' => ['Dashboard', 'Anggaran ramah HAM', 'index'],
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

	public function detail_anggaranham($menu_id = null) {
		method('get');
		///checkPermission($this->_path, $menu_id, 1);
		//=========================================================//
        $id = decrypt($this->uri->segment(3));
        $data['detail'] = $this->db->select('*')->where('id', $id)->get('tb_anggaran_ham')->row_array();
    
	//	$roles = $this->db->where([
	//		'is_active' => '1',
	//	])->get('roles')->result();

		$config = [
			'title' => 'Detail Anggaran ramah HAM',
			'menu_id' => $menu_id,
			'link' 			=> $this->link.'/detail_tambah',
			'menu_active' => 'Detail Anggaran ramah HAM',
			'menu_open' => null,
			'path' => $this->_path,
            'data' => $data,
			'contents' =>  $this->_path . 'detail_anggaranham',
			'script_js' 		=> $this->_path . 'detail_anggaranham_js',
			//=========================================================//
		///	'roles' => $roles,
			//=========================================================//
			'breadcrumb' => ['Dashboard', 'Detail Anggaran ramah HAM', 'Detail'],
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
 
		$instansi     = $this->security->xss_clean(post('instansi'));
		$nama_anggaran= $this->security->xss_clean(post('nama_anggaran'));
		$deskripsi    = $this->security->xss_clean(post('deskripsi'));
        
		$insert = $this->db->insert('tb_anggaran_ham', [
			'id_user'        => '50',///decrypt($this->session->userdata('id')),
			'instansi'       => $instansi,
			'nama_anggaran'  => $nama_anggaran,
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
            echo "<script>alert('Data gagal disimpan')</script>";
        }
        echo json_encode($response); 
	}

	public function tambah($menu_id = null)
	{
		method('get');
	//	checkPermission($this->_path, $menu_id, 2);
        
		$config 			= [
			'title' 		=> 'Tambah Data Konten',
			'menu_id' 		=> $menu_id,
			'link' 			=> $this->link,
			'menu_active' 	=> 'Data Komunitas Pegiat HAM',
			'menu_open' 	=> null,
			'path' 			=> $this->_path,
			'contents' 		=> $this->_path . 'tambah',
			'script_js' 	=> $this->_path . 'tambah_js',
			//=========================================================//
			'breadcrumb' 	=> [
				'Dashboard', 'Komunitas Pegiat HAM', 'index'
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
		$deskripsi = $this->security->xss_clean(post('deskripsi'));
        
		$insert = $this->db->insert('tb_anggaran_ham_detail', [
			'id_anggaran'    => decrypt($id),
			'bab'            => $bab,
			'deskripsi'      => $deskripsi,
			'ya_tidak'       => '0',
			'is_active'      => '1',
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
			'menu_active' 	=> 'Detail Anggaran Ramah HAM',
			'menu_open' 	=> null,
			'path' 			=> $this->_path,
			'contents' 		=> $this->_path . 'detail_tambah',
			'script_js' 	=> $this->_path . 'detail_tambah_js',
			//=========================================================//
			'breadcrumb' 	=> [
				'Dashboard', 'Detail Anggaran Ramah HAM', 'index'
			],
			'modals' 		=> [],
			'plugins' => [
				'select2' => true
			]
		];

		render($config);
	} 
 
	public function edit_anggaranham($menu_id = null)
	{

		method('get');
		//checkPermission($this->_path, $menu_id, 2);
        $id = decrypt($this->uri->segment(3));

        if ($id==null)
			redirect(base_url());
        $data = [
        	'id' => $id,
        ];
        $data['detail'] = $this->db->select('*')->where('id', $id)->get('tb_anggaran_ham')->row_array();

        
		$config 			= [
			'title' 		=> 'Edit Data Anggaran HAM',
			'menu_id' 		=> $menu_id,
			'link' 			=> $this->link,
			'jenis' 		=> $jenis,
            'data'          => $data,
			'menu_active' 	=> 'Data Anggran HAM',
			'menu_open' 	=> null,
			'path' 			=> $this->_path,
			'contents' 		=> $this->_path . 'ubah',
			'script_js' 	=> $this->_path . 'ubah_js',
			//=========================================================//
			'breadcrumb' 	=> [
				'Dashboard', 'Anggaran Ramah HAM', 'index'
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

		$id        = decrypt($id);
		$instansi  = post('instansi');
		$nama_anggaran = post('nama_anggaran');
		$deskripsi = post('deskripsi');

		$this->db->where('id', $id);
		$this->db->update('tb_anggaran_ham', [
		///	'id_user'        => decrypt($this->session->userdata('id')),
            'instansi'       => $instansi,
			'nama_anggaran'  => $nama_anggaran,
			'deskripsi'      => $deskripsi,
		]);

		response([
			'status' => 'sukses',
			'message' => 'Data berhasil disimpan'
		]);
	}

	public function detail_edit_anggaranham($menu_id = null)
	{
		method('get');
		//checkPermission($this->_path, $menu_id, 2);
        $id = decrypt($this->uri->segment(3));

        if ($id==null)
			redirect(base_url());
        $data = [
        	'id' => $id,
        ];
        $data['detail'] = $this->db->select('*')->where('id', $id)->get('tb_anggaran_ham_detail')->row_array();
        
		$config 			= [
			'title' 		=> 'Edit Data Detail Anggaran HAM',
			'menu_id' 		=> $menu_id,
			'link' 			=> $this->link,
			'jenis' 		=> $jenis,
            'data'          => $data,
			'menu_active' 	=> 'Data Detail Anggaran HAM',
			'menu_open' 	=> null,
			'path' 			=> $this->_path,
			'contents' 		=> $this->_path . 'detail_ubah',
			'script_js' 	=> $this->_path . 'detail_ubah_js',
			//=========================================================//
			'breadcrumb' 	=> [
				'Dashboard', 'Detail Anggaran HAM', 'index'
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

		$id = post('id');
 
		if (empty($id)) {
			response([
				'status' => false,
				'mssg' => 'Data tidak ditemukan'
			]);
		}
 
		$id        = decode_id($id);
		$bab       = post('bab');
		$deskripsi = post('deskripsi');

		$this->db->where('id', $id);
		$this->db->update('tb_anggaran_ham_detail', [
		///	'id_user'        => decrypt($this->session->userdata('id')),
            'bab'            => $bab,
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
    	$update = $this->db->update('tb_anggaran_ham', [
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
            $update = $this->db->update('tb_anggaran_ham_detail', [
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
            $update = $this->db->update('tb_anggaran_ham_detail', [
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

		$id = post('id');

		if (empty($id)) {
			response([
				'status' => false,
			], 404);

			return false;
		}

		$id = decrypt($id);

		$this->db->where('id', $id);
		$this->db->update('tb_anggaran_ham', ['is_active' => '0','deleted_at' => 'Y']);

		response([
			'status' => true,
			'message' => 'Data berhasil dihapus'
		]);
	}
    
	public function deleteDetailAnggaran($menu_id = null)
	{
	//	checkAccessAjax($this->_path, $menu_id, 4);

		$id = post('id');

		if (empty($id)) {
			response([
				'status' => false,
			], 404);

			return false;
		}

		$id = decrypt($id);

		$this->db->where('id', $id);
		$this->db->update('tb_anggaran_ham_detail', ['is_active' => '0','deleted_at' => 'Y']);

		response([
			'status' => true,
			'message' => 'Data berhasil dihapus'
		]);
	}

}

/* End of file Rollisu.php */
