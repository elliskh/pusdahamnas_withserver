<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Komunitasham extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->_auth();
		$this->_path = 'komunitasham/';
		$this->_table = 'tb_komunitasham';
        $this->link = base_url('komunitasham');
		//=========================================================//

		$this->load->model($this->_path . 'Komunitasham_model', 'user');
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
			'title' => 'Komunitas HAM',
			'menu_id' => $menu_id,
			'link' 			=> $this->link.'/tambah',
			'menu_active' => 'Komunitas HAM',
			'menu_open' => null,
			'path' => $this->_path,
			'contents' =>  $this->_path . 'index',
			'script_js' 		=> $this->_path . 'js',
			//=========================================================//
		///	'roles' => $roles,
			//=========================================================//
			'breadcrumb' => ['Dashboard', 'Komunitas HAM', 'index'],
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
        $xhr = TRUE; // if we decide to use XHR ajax
    	
    	// Saving new data
    	if ($xhr) {
    		header( 'Content-type: text/html; charset=utf-8' );
			
    	}
		method('post');
		///checkAccessAjax($this->_path, $menu_id, 2);
 
		$judul        = $this->security->xss_clean(post('judul'));
		$deskripsi    = $this->security->xss_clean(post('deskripsi'));
		$penulis      = $this->security->xss_clean(post('penulis'));
		$editor       = $this->security->xss_clean(post('editor'));
		$sumber_data  = $this->security->xss_clean(post('sumber_data'));
		$jenis_konten = decode_id($this->security->xss_clean(post('jenis_konten')));
		$cover        = $this->security->xss_clean(post('cover'));
		$jumlah_paragraf = $this->security->xss_clean(post('jumlah_paragraf'));
		$isi_konten   = $this->security->xss_clean(post('isi_konten'));
        
            $config = array( 
                             'upload_path' => './uploads/cover_konten',
                             'allowed_types' => "jpg|png|jpeg",
    					     'max_size' => '20000',
    					     'encrypt_name' => true,
                             'overwrite' => FALSE,                              
                             );
            $this->load->library('upload', $config);
        $file_name = '';
        if($this->upload->do_upload('cover')) {
    						$file_name = $this->upload->data('file_name');
							$orig_name = $this->upload->data('orig_name');
							$file_path = $this->upload->data('file_path');
							$file_size = $this->upload->data('file_size');
            
        }    
		$insert = $this->db->insert('tb_komunitasham', [
			'id_user'        => decrypt($this->session->userdata('id')),
			'judul'          => $judul,
			'deskripsi'      => $deskripsi,
			'penulis'        => $this->session->userdata('nama'),//$penulis,
			'editor'         => $editor,
			'sumber_data'    => $sumber_data,
			'jenis_konten'   => $jenis_konten,
			'cover'          => $file_name,
			'jumlah_paragraf'=> $jumlah_paragraf,
			'isi_konten'     => $isi_konten,
			'created_at'     => date ("Y-m-d H:i:s"),
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
        echo json_encode($response); 
	}

	public function buat_konten($menu_id = null)
	{
 
        method('get');
        $jenis['jenis'] = $this->db->get('tb_dataisuprioritas')->result();
		$view = [
            'title' => "Form Konten",
            'content' => 'contents/komunitasham/buat_konten',
            'js' => 'contents/komunitasham/buat_konten_js',
        ];
        //$this->session->set_flashdata('success_messages', '');
        $this->template->display_front($view, $jenis);
	}

	public function tambah($menu_id = null)
	{
		method('get');
	//	checkPermission($this->_path, $menu_id, 2);
		$jenis = $this->db->get('tb_dataisuprioritas')->result();
        
		$config 			= [
			'title' 		=> 'Tambah Data Konten',
			'menu_id' 		=> $menu_id,
			'link' 			=> $this->link,
			'jenis' 		=> $jenis,
			'menu_active' 	=> 'Konten',
			'menu_open' 	=> null,
			'path' 			=> $this->_path,
			'contents' 		=> $this->_path . 'tambah',
			'script_js' 	=> $this->_path . 'tambah_js',
			//=========================================================//
			'breadcrumb' 	=> [
				'Dashboard', 'Konten', 'index'
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
		$jenis = $this->db->get('tb_dataisuprioritas')->result();
        $id = decrypt($this->uri->segment(3));

        if ($id==null)
			redirect(base_url());
        $data = [
        	'id' => $id,
        ];
        $data['detail'] = $this->db->select('a.id as idkonten, a.judul, a.deskripsi, a.penulis, a.editor, a.sumber_data, a.jenis_konten, a.cover, a.jumlah_paragraf, a.isi_konten, b.*')->where('a.id', $id)->join('tb_dataisuprioritas b', 'a.jenis_konten=b.id', 'left')->get('tb_komunitasham a')->row_array();

        
		$config 			= [
			'title' 		=> 'Edit Data Konten',
			'menu_id' 		=> $menu_id,
			'link' 			=> $this->link,
			'jenis' 		=> $jenis,
            'data'          => $data,
			'menu_active' 	=> 'Konten',
			'menu_open' 	=> null,
			'path' 			=> $this->_path,
			'contents' 		=> $this->_path . 'ubah',
			'script_js' 	=> $this->_path . 'ubah_js',
			//=========================================================//
			'breadcrumb' 	=> [
				'Dashboard', 'Konten', 'index'
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

		$id = post('idkonten');
 
		if (empty($id)) {
			response([
				'status' => false,
				'mssg' => 'Data tidak ditemukan'
			]);
		}

		$id = decode_id($id);
		$judul = post('judul');
		$deskripsi = post('deskripsi');
		$penulis = post('penulis');
		$editor = post('editor');
		$sumber_data = post('sumber_data');
		$jenis_konten = decode_id(post('jenis_konten'));
		$cover = post('cover');
		$jumlah_paragraf = post('jumlah_paragraf');
		$isi_konten = post('isi_konten');
            
            $config = array( 
                             'upload_path' => './uploads/cover_konten',
                             'allowed_types' => "jpg|png|jpeg",
    					     'max_size' => '20000',
    					     'encrypt_name' => true,
                             'overwrite' => FALSE,                              
                             );
            $this->load->library('upload', $config);
        $file_name = '';
        if($this->upload->do_upload('cover')) {
    						$file_name = $this->upload->data('file_name');
							$orig_name = $this->upload->data('orig_name');
							$file_path = $this->upload->data('file_path');
							$file_size = $this->upload->data('file_size');
            
        }    
		$this->db->where('id', $id);
        if($file_name==''){
    		$this->db->update('tb_komunitasham', [
    			'id_user'        => decrypt($this->session->userdata('id')),
    			'judul'          => $judul,
    			'deskripsi'      => $deskripsi,
    			'penulis'        => $penulis,
    			'editor'         => $editor,
    			'sumber_data'    => $sumber_data,
    			'jenis_konten'   => $jenis_konten,
    			'jumlah_paragraf'=> $jumlah_paragraf,
    			'isi_konten'     => $isi_konten,
    		]);   
        }else{  
    		$this->db->update('tb_komunitasham', [
    			'id_user'        => decrypt($this->session->userdata('id')),
    			'judul'          => $judul,
    			'deskripsi'      => $deskripsi,
    			'penulis'        => $penulis,
    			'editor'         => $editor,
    			'sumber_data'    => $sumber_data,
    			'jenis_konten'   => $jenis_konten,
    			'cover'          => $file_name,
    			'jumlah_paragraf'=> $jumlah_paragraf,
    			'isi_konten'     => $isi_konten,
    		]);
        }
        
		response([
			'status' => 'sukses',
			'message' => 'Data berhasil disimpan'
		]);
	}

	public function changeKontenActive($menu_id = null)
	{
        $xhr = TRUE; // if we decide to use XHR ajax
    	
    	// Saving new data
    	if ($xhr) {
    		header( 'Content-type: text/html; charset=utf-8' );
			
    	}
        
		method('post');
		///checkAccessAjax($this->_path, $menu_id, 3);
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
    	$update = $this->db->update('tb_komunitasham', [
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
				'id' => $id,
    			'message' => 'Data gagal disimpan',
    		]);		  
		  
		}

	}


	public function deleteKonten($menu_id = null)
	{
	///	checkAccessAjax($this->_path, $menu_id, 4);

		$id = post('id');

		if (empty($id)) {
			response([
				'status' => false,
			], 404);

			return false;
		}

		$konten_id = decrypt($id);

		$this->db->where('id', $konten_id);
		$this->db->update('tb_komunitasham', ['is_active' => '0','deleted_at' => date ("Y-m-d H:i:s")]);
		$this->db->where('id_konten', $konten_id);
		$this->db->update('tb_komunitasham_msg', ['is_active' => '0','deleted_at' => date ("Y-m-d H:i:s")]);

		response([
			'status' => true,
			'message' => 'Data berhasil dihapus'
		]);
	}
    
	public function deleteKontenUser($menu_id = null)
	{
	///	checkAccessAjax($this->_path, $menu_id, 4);

		$id = post('id');

		if (empty($id)) {
			response([
				'status' => false,
			], 404);

			return false;
		}

		$konten_id = decrypt($id);

		$this->db->where('id', $konten_id);
		$this->db->update('tb_komunitasham', ['is_active' => '0','deleted_at' => date ("Y-m-d H:i:s")]);
		$this->db->where('id_konten', $konten_id);
		$this->db->update('tb_komunitasham_msg', ['is_active' => '0','deleted_at' => date ("Y-m-d H:i:s")]);

		response([
			'status' => 'sukses',
			'message' => 'Data berhasil dihapus'
		]);
	}

}

/* End of file Rollisu.php */
