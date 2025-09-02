<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Data_basis extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->_auth();
		$this->_path = 'data_basis/';
		$this->_table = '';
		$this->link = base_url('data_basis');
		//=========================================================//

		$this->load->model('menu/Menu_model', 'menu');
		$this->load->model('data_basis/tb_data_dok', 'tb_data_dok');
	}

	public function index($menu_id = null)
	{
		method('get');
		checkPermission($this->_path, $menu_id, 1);
		$unit = $this->db->get('ref_unitkerja')->result();
		$hak = $this->db->get('ref_hak_dokumen')->result();
		$jenis = $this->db->get('ref_jenis_dokumen_internal')->result();
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
			'unit' 			=> $unit,
			'subyek' 		=> $subyek,
			'title' 		=> 'Database Internal',
			'menu_id' 		=> $menu_id,
			'link' 			=> $this->link.'/tambah',
			'menu_active' 	=> 'Database Internal',
			'menu_open' 	=> null,
			'path' 			=> $this->_path,
			'contents' 		=> $this->_path . 'index',
			'script_js' 		=> $this->_path . 'js',
			//=========================================================//
			'breadcrumb' 	=> [
				'Utama', 'Database Internal', 'index'
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
        $list = $this->tb_data_dok->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $row) {
            $no++;
			$aksi = "";
            $isi = array();
            $isi[] = $no;
            $isi[] = '<b>'.$row->nama_dokumen.'</b>';
            $isi[] = $row->unit_kerja;
            $isi[] = $row->no_dok;
            $isi[] = $row->tahun;
            $isi[] = $row->nama_media;
            $isi[] = $row->nama_jenis;
			$aksi .= '<a class="btn btn-sm btn-primary btn-block" href="'.base_url('data_basis/edit/'.encode_id($row->id)).'/'.$menu_id.'"> <i class="fa fa-edit"></i> Edit</a>'; 
			if ($row->file_path) {
				$aksi .= '<a class="btn btn-sm btn-info btn-block" download="'.$row->orig_name.'" href="'.link_file($row->id, 'tb_basisdata_internal', 'd').'"> <i class="fa fa-download"></i> Unduh</a>'; 
			}else{
				$aksi .= '<a class="btn btn-sm btn-info btn-block" href="'.$row->link.'"> <i class="fa fa-download"></i> Unduh</a>'; 
			}
			$aksi .= '<a class="btn btn-sm btn-danger btn-block" href="javascript:;" onclick="hapus(\''.encode_id($row->id).'\')"> <i class="fa fa-trash"></i> Hapus</a>'; 
			
			$isi[] = $aksi;


            $data[] = $isi;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->tb_data_dok->count_all(),
            "recordsFiltered" => $this->tb_data_dok->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

	public function tambah($menu_id = null)
	{
		method('get');
		checkPermission($this->_path, $menu_id, 2);
		$hak = $this->db->get('ref_hak_dokumen')->result();
		$jenis = $this->db->get('ref_jenis_dokumen_internal')->result();
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
			'title' 		=> 'Tambah Database Internal',
			'menu_id' 		=> $menu_id,
			'link' 			=> $this->link,
			'menu_active' 	=> 'Database Internal',
			'menu_open' 	=> null,
			'path' 			=> $this->_path,
			'contents' 		=> $this->_path . 'tambah',
			'script_js' 		=> $this->_path . 'tambah_js',
			//=========================================================//
			'breadcrumb' 	=> [
				'Utama', 'Database Internal', 'index'
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
		$data = $this->db->from('tb_basisdata_internal')->where('id',$id)->get()->row();
		$hak = $this->db->get('ref_hak_dokumen')->result();
		$jenis = $this->db->get('ref_jenis_dokumen_internal')->result();
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
			'title' 		=> 'Update Database Internal',
			'menu_id' 		=> $menu_id,
			'link' 			=> $this->link,
			'menu_active' 	=> 'Database Internal',
			'menu_open' 	=> null,
			'path' 			=> $this->_path,
			'contents' 		=> $this->_path . 'tambah',
			'script_js' 		=> $this->_path . 'tambah_js',
			//=========================================================//
			'breadcrumb' 	=> [
				'Utama', 'Database Internal', 'index'
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
			'unit_kerja' => $this->input->post('unit_kerja',true),
			'nama_dokumen' => $this->input->post('nama_dokumen',true),
			'no_dok' => $this->input->post('no_dok',true),
			'tahun' => $this->input->post('tahun',true),
			'id_media_dokumen' => decode_id($this->input->post('id_media_dokumen',true)),
			'id_jenis_dokumen' =>  decode_id($this->input->post('id_jenis_dokumen',true)),
			'id_topik_hak' =>  decode_id($this->input->post('id_topik_hak',true)),
			'id_topik_subyek' =>  decode_id($this->input->post('id_topik_subyek',true)),
			'pic_input' =>  $this->input->post('pic_input',true),
			'link' =>  $this->input->post('link',true),
			'katakunci' =>  str_replace(" ","",$this->input->post('katakunci',true)),
			'deskripsi' =>  ($this->input->post('deskripsi',true))
		];
		$cek = $this->db->from('tb_basisdata_internal')->where('id',$id)->get();
		if ($cek->num_rows()> 0) {
			if ($this->input->post('link',true)) {
				$insert['file_name'] = NULL;
				$insert['file_path'] = NULL;
				$insert['orig_name'] = NULL;
				$insert['file_size'] = NULL;
				$this->db->where('id',$id)->update('tb_basisdata_internal',$insert);
			}
			$this->db->where('id',$id)->update('tb_basisdata_internal',$insert);
		}else{
			$insert['created_at']=date("Y-m-d H:i:s");
			$insert['created_by']=$this->session->userdata('username');
			$this->db->insert('tb_basisdata_internal',$insert);
			$id = $this->db->insert_id();
		}

		if ($_FILES['dokumen']['size'] != 0 && $_FILES['dokumen']['error'] == 0)
			{
				$dir = './uploads/dokumen_internal/'.$id;
				if (!is_dir($dir)) {
					mkdir($dir, 0755, TRUE);
				}
				$this->upload->initialize(array(
					"upload_path"	=> $dir,
					"allowed_types" => 'pdf|doc|docx|png|jpg|jpeg|ppt|pptx',
					"max_size" => '20000',
					"encrypt_name" => true
				));
	
				if(@$this->upload->do_upload('dokumen')) {
					$uploaded = $this->upload->data();
							$file_name = $this->upload->data('file_name');
							$orig_name = $this->upload->data('orig_name');
							$file_path = $this->upload->data('file_path');
							$file_size = $this->upload->data('file_size');
							$data_insert_doc = [
									'file_name' => $file_name,
									'orig_name' => $orig_name,
									'file_path' => $file_path,
									'file_size' => $file_size,
									'created_at' => date("Y-m-d H:i:s")
							];
							$this->db->where('id',$id)->update("tb_basisdata_internal", $data_insert_doc);
						
					if($this->db->affected_rows()>0){
						$this->session->set_flashdata('success', 'Berhasil menambahkan.');
						redirect(base_url('data_basis/index/'.$menu_id));
					} else{
						$this->session->set_flashdata('failed', 'Something went wrong.');
						redirect(base_url('data_basis/index/'.$menu_id));
					}
				}else{
					echo $this->upload->display_errors();die;
				}
			}

		if ($_FILES['cover']['size'] != 0 && $_FILES['cover']['error'] == 0)
			{
				$dir = './uploads/cover_internal';
				if (!is_dir($dir)) {
					mkdir($dir, 0755, TRUE);
				}
				$this->upload->initialize(array(
					"upload_path"	=> $dir,
					"allowed_types" => 'png|jpg|jpeg',
					"max_size" => '2000',
					"encrypt_name" => true,
					"overwrite" => false
				));
	
				if(@$this->upload->do_upload('cover')) {
					$uploaded = $this->upload->data();
							$file_name2 = $this->upload->data('file_name');
							$data_insert_cov = [
									'gambar' => $file_name2
							];
							$this->db->where('id',$id)->update("tb_basisdata_internal", $data_insert_cov);
				}
			}
			
			$this->session->set_flashdata('success', 'Berhasil diperbaharui.');
			redirect(base_url('data_basis/index/'.$menu_id));
	}

	public function hapus($menu_id){
		method('get');
		$id=decode_id($this->input->get('id'));
		$this->db->where('id',$id)->update("tb_basisdata_internal", ['deleted_at'=> date("Y-m-d H:i:s")]);
		if($this->db->affected_rows()>0){
			$this->session->set_flashdata('success', 'Berhasil menambahkan.');
			echo json_encode([
				'status' => true
			]);
		}else{
			echo json_encode([
				'status' => false
			]);
		}

	}
}

/* End of file Utama.php */
