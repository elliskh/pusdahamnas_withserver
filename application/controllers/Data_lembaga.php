<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Data_lembaga extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->_auth();
		$this->_path = 'data_lembaga/';
		$this->_table = '';
		$this->link = base_url('data_lembaga');
		//=========================================================//

		$this->load->model('menu/Menu_model', 'menu');
		$this->load->model('data_lembaga/tb_data_lembaga', 'tb_data_lembaga');
	}

	public function index($menu_id = null)
	{
		method('get');
		checkPermission($this->_path, $menu_id, 1);

		$config 			= [
			'title' 		=> 'Data Lembaga HAM',
			'menu_id' 		=> $menu_id,
			'link' 			=> $this->link.'/tambah',
			'menu_active' 	=> 'Data Lembaga HAM',
			'menu_open' 	=> null,
			'path' 			=> $this->_path,
			'contents' 		=> $this->_path . 'index',
			'script_js' 		=> $this->_path . 'js',
			//=========================================================//
			'breadcrumb' 	=> [
				'Utama', 'Data Lembaga HAM', 'index'
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
		checkPermission($this->_path, $menu_id, 1);
        $list = $this->tb_data_lembaga->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $row) {
            $no++;
			$aksi = "";
            $status = "";
            if($row->is_active==1){
                //$status = "Aktif";
                $id_lembaga = encrypt($row->id_lembaga);
                $status = "<div class='custom-control custom-switch mb-3' dir='ltr'>
                    <input type='checkbox' class='custom-control-input change-active' name='active-$id_lembaga' id='active-$id_lembaga' data-user_id='$id_lembaga' checked>
                    <label class='custom-control-label' for='active-$id_lembaga'>Aktif</label>
                </div>";
            }else{
                //$status = "Non Aktif";
                $id_lembaga = encrypt($row->id_lembaga);
                $status = "<div class='custom-control custom-switch mb-3' dir='ltr'>
                    <input type='checkbox' class='custom-control-input change-active' name='active-$id_lembaga' id='active-$id_lembaga' data-user_id='$id_lembaga'>
                    <label class='custom-control-label' for='active-$id_lembaga'>Non Aktif</label>
                </div>";
            }
            $isi = array();
            $isi[] = $no;
            $isi[] = $row->nama_lembaga;
            $isi[] = $row->singkatan_lembaga;
            $isi[] = $row->youtube_lembaga;
            $isi[] = $row->expand_lembaga."<br><font color='blue'>Telp. ".$row->url_lembaga."</font>";
            $isi[] = $status;
			$aksi .= '<a class="btn btn-sm btn-primary btn-block" href="'.base_url('data_lembaga/edit/'.encode_id($row->id_lembaga)).'/'.$menu_id.'"> <i class="fa fa-edit"></i> Edit</a>'; 
			$aksi .= '<a class="btn btn-sm btn-danger btn-block" href="javascript:;" onclick="hapus(\''.encode_id($row->id_lembaga).'\')"> <i class="fa fa-trash"></i> Hapus</a>'; 
			
			$isi[] = $aksi;


            $data[] = $isi;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->tb_data_lembaga->count_all(),
            "recordsFiltered" => $this->tb_data_lembaga->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

	public function tambah($menu_id = null)
	{
		method('get');
		checkPermission($this->_path, $menu_id, 2);
		$hak = $this->db->get('ref_hak_dokumen')->result();
		$jenis = $this->db->get('ref_jenis_dokumen')->result();
		$media = $this->db->get('ref_media_dokumen')->result();
		$status = $this->db->get('ref_status_dokumen')->result();
		$subyek = $this->db->get('ref_subyek_dokumen')->result();
		$lembaga = $this->db->get('ref_lembaga')->result();
		$config 			= [
			'hak' 		=> $hak,
			'lembaga' 		=> $lembaga,
			'jenis' 		=> $jenis,
			'media' 		=> $media,
			'status' 		=> $status,
			'subyek' 		=> $subyek,
			'title' 		=> 'Tambah Data Lembaga HAM',
			'menu_id' 		=> $menu_id,
			'link' 			=> $this->link,
			'menu_active' 	=> 'Data Lembaga HAM',
			'menu_open' 	=> null,
			'path' 			=> $this->_path,
			'contents' 		=> $this->_path . 'tambah',
			'script_js' 		=> $this->_path . 'tambah_js',
			//=========================================================//
			'breadcrumb' 	=> [
				'Utama', 'Data Lembaga HAM', 'index'
			],
			'modals' 		=> [],
			'plugins' => [
				'select2' => true
			]
		];

		render($config);
	}
	

	public function edit($id,$menu_id = null)
	{
		method('get');
		checkPermission($this->_path, $menu_id, 2);
		$id = decode_id($id);
		$data = $this->db->from('tb_lembaga')->where('id_lembaga',$id)->get()->row();
		$hak = $this->db->get('ref_hak_dokumen')->result();
		$jenis = $this->db->get('ref_jenis_dokumen')->result();
		$media = $this->db->get('ref_media_dokumen')->result();
		$status = $this->db->get('ref_status_dokumen')->result();
		$subyek = $this->db->get('ref_subyek_dokumen')->result();
		$lembaga = $this->db->get('ref_lembaga')->result();
		$config 			= [
			'data' => $data,
			'hak' 		=> $hak,
			'lembaga' 		=> $lembaga,
			'jenis' 		=> $jenis,
			'media' 		=> $media,
			'status' 		=> $status,
			'subyek' 		=> $subyek,
			'title' 		=> 'Tambah Data Lembaga HAM',
			'menu_id' 		=> $menu_id,
			'link' 			=> $this->link,
			'menu_active' 	=> 'Data Lembaga HAM',
			'menu_open' 	=> null,
			'path' 			=> $this->_path,
			'contents' 		=> $this->_path . 'tambah',
			'script_js' 		=> $this->_path . 'tambah_js',
			//=========================================================//
			'breadcrumb' 	=> [
				'Utama', 'Data Lembaga HAM', 'index'
			],
			'modals' 		=> [],
			'plugins' => [
				'select2' => true
			]
		];

		render($config);
	}

	

	public function simpan(){
        $this->load->library('upload');
		$menu_id = $this->input->post('menu_id',true);
		$id = decode_id($this->input->post('id',true));
		
		method('post');
		$insert = 
		[
			'nama_lembaga' => $this->input->post('nama',true),
			'fokus_lembaga' => $this->input->post('kabkota',true),
			'alamat_lembaga' => $this->input->post('alamat',true),
			'expand_lembaga' => $this->input->post('email',true),
			'url_lembaga' => $this->input->post('telepon',true)
		];

		if ($this->input->post('propinsi',true)!="")
		{
			$insert['prop_lembaga']=$this->db->where('id',$this->input->post('propinsi',true))->get('ref_propinsi')->row_array()['code'];
			$insert['singkatan_lembaga']=$this->db->where('id',$this->input->post('propinsi',true))->get('ref_propinsi')->row_array()['name'];
		}

		if ($this->input->post('kabkota',true)!="")
		{
			$insert['youtube_lembaga']=$this->db->where('id',$this->input->post('kabkota',true))->get('ref_kabupaten')->row_array()['name'];
		}

		$cek = $this->db->from('tb_lembaga')->where('id_lembaga',$id)->get();
		if ($cek->num_rows()> 0) {
			$insert['updated_at']=date('Y-m-d H:i:s');
			$this->db->where('id_lembaga',$id)->update('tb_lembaga',$insert);
		}else{
			$insert['created_at']=date('Y-m-d H:i:s');
			$this->db->insert('tb_lembaga',$insert);
			$id = $this->db->insert_id();
		}

		// if ($_FILES['dokumen']['size'] != 0 && $_FILES['dokumen']['error'] == 0)
		// 	{
		// 		$dir = './uploads/dokumen/'.$id;
		// 		if (!is_dir($dir)) {
		// 			mkdir($dir, 0755, TRUE);
		// 		}
		// 		$this->upload->initialize(array(
		// 			"upload_path"	=> $dir,
		// 			"allowed_types" => 'pdf|doc|docx',
		// 			"max_size" => '20000',
		// 			"encrypt_name" => true
		// 		));
	
		// 		if(@$this->upload->do_upload('dokumen')) {
		// 			$uploaded = $this->upload->data();
		// 					$file_name = $this->upload->data('file_name');
		// 					$orig_name = $this->upload->data('orig_name');
		// 					$file_path = $this->upload->data('file_path');
		// 					$file_size = $this->upload->data('file_size');
		// 					$data_insert_doc = [
		// 							'file_name' => $file_name,
		// 							'orig_name' => $orig_name,
		// 							'file_path' => $file_path,
		// 							'file_size' => $file_size,
		// 							'created_at' => date("Y-m-d H:i:s")
		// 					];
		// 					$this->db->where('id',$id)->update("tb_dokumen", $data_insert_doc);
						
		// 			if($this->db->affected_rows()>0){
		// 				$this->session->set_flashdata('success', 'Berhasil menambahkan.');
		// 				redirect(base_url('data_ahli/index/'.$menu_id));
		// 			} else{
		// 				$this->session->set_flashdata('failed', 'Something went wrong.');
		// 				redirect(base_url('data_ahli/index/'.$menu_id));
		// 			}
		// 		}else{
		// 			echo $this->upload->display_errors();die;
		// 		}
		// 	}
			
			$this->session->set_flashdata('success', 'Berhasil diperbaharui.');
			redirect(base_url('data_lembaga/index/'.$menu_id));
	}

	public function hapus($menu_id){
		method('get');
		$id=decode_id($this->input->get('id'));
		$this->db->where('id_lembaga',$id)->update("tb_lembaga", ['deleted_at'=> date("Y-m-d H:i:s")]);
		if($this->db->affected_rows()>0){
			$this->session->set_flashdata('success', 'Berhasil dihapus.');
			echo json_encode([
				'status' => true
			]);
		}else{
			echo json_encode([
				'status' => false
			]);
		}

	}

	public function getkab()
	{
		$idprop=$this->input->post('idprop',TRUE);
		if (@$idprop)
		{
			foreach ($this->db->where('provinceid',$idprop)->get('ref_kabupaten')->result_array() as $kab)
			{
				echo '<option value="'.$kab['id'].'">'.$kab['name'].'</option>';
			}
		}
		else
		{

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
		//checkAccessAjax($this->_path, $menu_id, 3);

		$id = $this->input->post('id');//post('id');
        
		if (empty($id)) {
			response([
				'status' => false,
			], 404);
		}

		$id  = decrypt($id);
		$val = $this->input->post('val');//post('val');
 
      ///  $check_actived = $this->user->checkKontenActive();

    	$this->db->where('id_lembaga', $id);
    	$update = $this->db->update('tb_lembaga', [
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
    
}

/* End of file Utama.php */
