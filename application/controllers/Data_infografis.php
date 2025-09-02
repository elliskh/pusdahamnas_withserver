<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Data_infografis extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->_auth();
		$this->_path = 'data_infografis/';
		$this->_table = '';
		$this->link = base_url('data_infografis');
		//=========================================================//

		$this->load->model('menu/Menu_model', 'menu');
		$this->load->model('data_infografis/tb_data_infografis', 'tb_data_infografis');
	}

	public function index($menu_id = null)
	{
		method('get');
		checkPermission($this->_path, $menu_id, 1);

		$config 			= [
			'title' 		=> 'Data Infografis',
			'menu_id' 		=> $menu_id,
			'link' 			=> $this->link.'/tambah',
			'menu_active' 	=> 'Data Infografis',
			'menu_open' 	=> null,
			'path' 			=> $this->_path,
			'contents' 		=> $this->_path . 'index',
			'script_js' 		=> $this->_path . 'js',
			//=========================================================//
			'breadcrumb' 	=> [
				'Utama', 'Data Infografis', 'index'
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
        $list = $this->tb_data_infografis->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $row) {
            $no++;
			$aksi = "";
            $isi = array();
            $isi[] = $no;
            $isi[] = '<b>'.$row->judul.'</b>';
            $isi[] = $row->deskripsi;
			$aksi .= '<a class="btn btn-sm btn-primary btn-block" href="'.base_url('data_infografis/edit/'.encode_id($row->id)).'/'.$menu_id.'"> <i class="fa fa-edit"></i> Edit</a>';
			$aksi .= '<a class="btn btn-sm btn-danger btn-block" href="javascript:;" onclick="hapus(\''.encode_id($row->id).'\')"> <i class="fa fa-trash"></i> Hapus</a>'; 
			
			$isi[] = $aksi;


            $data[] = $isi;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->tb_data_infografis->count_all(),
            "recordsFiltered" => $this->tb_data_infografis->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

	public function tambah($menu_id = null)
	{
		method('get');
		checkPermission($this->_path, $menu_id, 2);
		$hak = $this->db->get('ref_infografis_dokumen')->result();
		$jenis = $this->db->get('ref_infografis_jenis_dokumen')->result();
		$media = $this->db->get('ref_infografis_media_dokumen')->result();
		$status = $this->db->get('ref_infografis_status_dokumen')->result();
		$subyek = $this->db->get('ref_infografis_subyek_dokumen')->result();
        
        if ($this->session->userdata('id_lembaga')>0)
        {
            $this->db->where('id',$this->session->userdata('id_lembaga'));
        }
		$lembaga = $this->db->get('ref_lembaga')->result();
		$config 			= [
			'hak' 		=> $hak,
			'lembaga' 		=> $lembaga,
			'jenis' 		=> $jenis,
			'media' 		=> $media,
			'status' 		=> $status,
			'subyek' 		=> $subyek,
			'title' 		=> 'Tambah Data Infografis',
			'menu_id' 		=> $menu_id,
			'link' 			=> $this->link,
			'menu_active' 	=> 'Data Infografis',
			'menu_open' 	=> null,
			'path' 			=> $this->_path,
			'contents' 		=> $this->_path . 'tambah',
			'script_js' 		=> $this->_path . 'tambah_js',
			//=========================================================//
			'breadcrumb' 	=> [
				'Utama', 'Data Infografis', 'index'
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
		$data = $this->db->from('tb_infografis')->where('id',$id)->get()->row();
		$hak = $this->db->get('ref_infografis_dokumen')->result();
		$jenis = $this->db->get('ref_infografis_jenis_dokumen')->result();
		$media = $this->db->get('ref_infografis_media_dokumen')->result();
		$status = $this->db->get('ref_infografis_status_dokumen')->result();
		$subyek = $this->db->get('ref_infografis_subyek_dokumen')->result();
		$lembaga = $this->db->get('ref_infografis')->result();
		$config 			= [
			'data' => $data,
			'hak' 		=> $hak,
			'lembaga' 		=> $lembaga,
			'jenis' 		=> $jenis,
			'media' 		=> $media,
			'status' 		=> $status,
			'subyek' 		=> $subyek,
			'title' 		=> 'Update Data Infografis',
			'menu_id' 		=> $menu_id,
			'link' 			=> $this->link,
			'menu_active' 	=> 'Data Infografis',
			'menu_open' 	=> null,
			'path' 			=> $this->_path,
			'contents' 		=> $this->_path . 'tambah',
			'script_js' 		=> $this->_path . 'tambah_js',
			//=========================================================//
			'breadcrumb' 	=> [
				'Utama', 'Data Infografis', 'index'
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
		$menu_id = $this->input->post('menu_id', true);
		$id = decode_id($this->input->post('id', true));
		$id_infografis = 0;
		
		method('post');
		$insert = [
			'judul' => $this->input->post('judul', true),
			'deskripsi' => $this->input->post('deskripsi', true),
			'link_video' => $this->input->post('link_video', true),	
			'is_active' => '1'
		];
		$cek = $this->db->from('tb_infografis')->where('id', $id)->get();
		if ($cek->num_rows() > 0) {
			$this->db->where('id', $id)->update('tb_infografis', $insert);
			$id_infografis = $id;
		} else {
			$this->db->insert('tb_infografis', $insert);
			$id = $this->db->insert_id();
			$id_infografis = $this->db->insert_id();
		}
	
		// Mendapatkan array dari file yang diupload
		$files = $_FILES['poster'];
	
		$dir = './uploads/infografis';
		if (!is_dir($dir)) {
			mkdir($dir, 0755, TRUE);
		}
	
		// Proses upload untuk setiap file dalam array
		$uploadedFilesData = [];
		foreach ($files['name'] as $key => $value) {
			$_FILES['userfile']['name'] = $files['name'][$key];
			$_FILES['userfile']['type'] = $files['type'][$key];
			$_FILES['userfile']['tmp_name'] = $files['tmp_name'][$key];
			$_FILES['userfile']['error'] = $files['error'][$key];
			$_FILES['userfile']['size'] = $files['size'][$key];

			$this->upload->initialize(array(
				"upload_path" => $dir,
				"allowed_types" => 'png|jpg|jpeg|webp',
				"max_size" => '2000',
				"encrypt_name" => true
			));

			if ($this->upload->do_upload('userfile')) {
				$uploadedFilesData[] = $this->upload->data();
			} else {
				$error = $this->upload->display_errors();

				var_dump($error);
				// Handle error jika ada
			}
		}

		//var_dump($uploadedFilesData);

		// Proses penyimpanan data file ke dalam tabel 'gambarinfografis'
		$infografis_id = $id_infografis;
		foreach ($uploadedFilesData as $fileData) { 
			
			$data_insert_gambar = [
				'infografis_id' => $infografis_id, // ID infografis dari tabel 'tb_infografis'
				'nama_file' => $fileData['file_name'],
			];

			$this->db->insert("image_infografis", $data_insert_gambar);
		}

	
		// Redirect sesuai kebutuhan setelah selesai pemrosesan file
		$this->session->set_flashdata('success', 'Berhasil diperbaharui.');
		redirect(base_url('data_infografis/index/' . $menu_id));
	}
	

	// public function simpan(){
    //     $this->load->library('upload');
	// 	$menu_id = $this->input->post('menu_id',true);
	// 	$id = decode_id($this->input->post('id',true));
		
	// 	method('post');
	// 	$insert = 
	// 	[
	// 		'judul' => $this->input->post('judul',true),
	// 		'deskripsi' =>  ($this->input->post('deskripsi',true)),
	// 		'is_active' => '1'
	// 	];
	// 	$cek = $this->db->from('tb_infografis')->where('id',$id)->get();
	// 	if ($cek->num_rows()> 0) {
	// 		$this->db->where('id',$id)->update('tb_infografis',$insert);
	// 	}else{
	// 		$this->db->insert('tb_infografis',$insert);
	// 		// echo $this->db->last_query();
	// 		// exit();
	// 		$id = $this->db->insert_id();
	// 	}

	// 	if ($_FILES['poster']['size'] != 0 && $_FILES['poster']['error'] == 0)
	// 		{
	// 			$dir = './uploads/poster';
	// 			if (!is_dir($dir)) {
	// 				mkdir($dir, 0755, TRUE);
	// 			}
	// 			$this->upload->initialize(array(
	// 				"upload_path"	=> $dir,
	// 				"allowed_types" => 'png|jpg|jpeg',
	// 				"max_size" => '2000',
	// 				"encrypt_name" => true
	// 			));
	
	// 			if(@$this->upload->do_upload('poster')) {
	// 				$uploaded = $this->upload->data();
	// 						$file_name = $this->upload->data('file_name');
	// 						$orig_name = $this->upload->data('orig_name');
	// 						$file_path = $this->upload->data('file_path');
	// 						$file_size = $this->upload->data('file_size');
	// 						$data_insert_doc = [
	// 								'file_name' => $file_name,
	// 								'poster' => $file_name,
	// 								'orig_name' => $orig_name,
	// 								'file_path' => $file_path,
	// 								'file_size' => $file_size
	// 						];
	// 						$this->db->where('id_event',$id)->update("tb_event", $data_insert_doc);
						
	// 				if($this->db->affected_rows()>0){
	// 					$this->session->set_flashdata('success', 'Berhasil menambahkan.');
	// 					redirect(base_url('data_event/index/'.$menu_id));
	// 				} else{
	// 					$this->session->set_flashdata('failed', 'Something went wrong.');
	// 					redirect(base_url('data_event/index/'.$menu_id));
	// 				}
	// 			}else{
	// 				echo $this->upload->display_errors();die;
	// 			}
	// 		}
			
	// 		$this->session->set_flashdata('success', 'Berhasil diperbaharui.');
	// 		redirect(base_url('data_infografis/index/'.$menu_id));
	// }

	public function hapus($menu_id){
		method('get');
		$id=decode_id($this->input->get('id'));
		$this->db->where('id',$id)->update("tb_infografis", ['deleted_at'=> date("Y-m-d H:i:s")]);
		if($this->db->affected_rows()>0){
			$this->session->set_flashdata('success', 'Berhasil menghapus.');
			echo json_encode([
				'status' => true
			]);
		}else{
			echo json_encode([
				'status' => false,
				'message' => $id
			]);
		}

	}
}

/* End of file Utama.php */
