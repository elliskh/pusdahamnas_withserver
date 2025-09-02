<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Ras_etnis extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->_auth();
		$this->_path = 'snp/ras_etnis/';
		$this->_table = '';
		$this->link = base_url('snp/ras_etnis/');
		//=========================================================//

		$this->load->model('menu/Menu_model', 'menu');
		$this->load->model('snp/ras_etnis/Tb_data_rasetnis', 'Tb_data_rasetnis');
	}

	public function index($menu_id = null)
	{
		//method('get');
		//checkPermission($this->_path, $menu_id, 1);

		$config 			= [
			'title' 		=> 'Data Ras Etnis',
			'menu_id' 		=> $menu_id,
			'link' 			=> $this->link.'/tambah',
			'menu_active' 	=> 'Data Ras Etnis',
			'menu_open' 	=> null,
			'path' 			=> $this->_path,
			'contents' 		=> $this->_path . 'index',
			'script_js' 	=> $this->_path . 'js',
			//=========================================================//
			'breadcrumb' 	=> [
				'SNP', 'Ras Etnis', 'index'
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
	//	checkPermission($this->_path, $menu_id, 1);
        $list = $this->Tb_data_rasetnis->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $row) {
            $no++;
			$aksi = "";
            $isi = array();
            $isi[] = $no;
            $isi[] = '<b>'.$row->judul.'</b>';
            $isi[] = '<b>'.$row->jml_paragraf.'</b>';
            $isi[] = $row->deskripsi;
			$aksi .= '<a class="btn btn-sm btn-primary btn-block" href="'.base_url('snp/ras_etnis/edit/'.encode_id($row->id)).'/'.$menu_id.'"> <i class="fa fa-edit"></i> Edit</a>';
			$aksi .= '<a class="btn btn-sm btn-danger btn-block" href="javascript:;" onclick="hapus(\''.encode_id($row->id).'\')"> <i class="fa fa-trash"></i> Hapus</a>'; 
			
			$isi[] = $aksi;


            $data[] = $isi;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Tb_data_rasetnis->count_all(),
            "recordsFiltered" => $this->Tb_data_rasetnis->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

	public function tambah($menu_id = null)
	{
		method('get');
		//checkPermission($this->_path, $menu_id, 2);
		$hak = $this->db->get('ref_hak_dokumen')->result();
		$jenis = $this->db->get('ref_jenis_dokumen')->result();
		$media = $this->db->get('ref_media_dokumen')->result();
		$status = $this->db->get('ref_status_dokumen')->result();
		$subyek = $this->db->get('ref_subyek_dokumen')->result();
        
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
			'title' 		=> 'Tambah Data Ras Etnis',
			'menu_id' 		=> $menu_id,
			'link' 			=> $this->link,
			'menu_active' 	=> 'Data Ras Etnis',
			'menu_open' 	=> null,
			'path' 			=> $this->_path,
			'contents' 		=> $this->_path . 'tambah',
			'script_js' 		=> $this->_path . 'tambah_js',
			//=========================================================//
			'breadcrumb' 	=> [
				'SNP', 'Ras Etnis', 'index'
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
		//checkPermission($this->_path, $menu_id, 2);
		$id = decode_id($id);
		$data = $this->db->from('tb_snp_rasetnis')->where('id',$id)->get()->row();
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
			'title' 		=> 'Update Data Ras etnis',
			'menu_id' 		=> $menu_id,
			'link' 			=> $this->link,
			'menu_active' 	=> 'Data Ras Etnis',
			'menu_open' 	=> null,
			'path' 			=> $this->_path,
			'contents' 		=> $this->_path . 'tambah',
			'script_js' 		=> $this->_path . 'tambah_js',
			//=========================================================//
			'breadcrumb' 	=> [
				'Data HAM', 'Agraria', 'index'
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
			'judul' => $this->input->post('judul',true),
			'jml_paragraf' => $this->input->post('jml_paragraf',true),
			'deskripsi' =>  ($this->input->post('deskripsi',true)),
			'is_active' => '1'
		];
		$cek = $this->db->from('tb_snp_rasetnis')->where('id',$id)->get();
		if ($cek->num_rows()> 0) {
			$this->db->where('id',$id)->update('tb_snp_rasetnis',$insert);
		}else{
			$this->db->insert('tb_snp_rasetnis',$insert);
			// echo $this->db->last_query();
			// exit();
			$id = $this->db->insert_id();
		}

		if ($_FILES['poster']['size'] != 0 && $_FILES['poster']['error'] == 0)
			{
				$dir = './uploads/poster';
				if (!is_dir($dir)) {
					mkdir($dir, 0755, TRUE);
				}
				$this->upload->initialize(array(
					"upload_path"	=> $dir,
					"allowed_types" => 'png|jpg|jpeg',
					"max_size" => '2000',
					"encrypt_name" => true
				));
	
				if(@$this->upload->do_upload('poster')) {
					$uploaded = $this->upload->data();
							$file_name = $this->upload->data('file_name');
							$orig_name = $this->upload->data('orig_name');
							$file_path = $this->upload->data('file_path');
							$file_size = $this->upload->data('file_size');
							$data_insert_doc = [
									'file_name' => $file_name,
									'poster' => $file_name,
									'orig_name' => $orig_name,
									'file_path' => $file_path,
									'file_size' => $file_size
							];
							$this->db->where('id_event',$id)->update("tb_event", $data_insert_doc);
						
					if($this->db->affected_rows()>0){
						$this->session->set_flashdata('success', 'Berhasil menambahkan.');
						redirect(base_url('data_event/index/'.$menu_id));
					} else{
						$this->session->set_flashdata('failed', 'Something went wrong.');
						redirect(base_url('data_event/index/'.$menu_id));
					}
				}else{
					echo $this->upload->display_errors();die;
				}
			}
			
			$this->session->set_flashdata('success', 'Berhasil diperbaharui.');
			redirect(base_url('snp/ras_etnis/index/'.$menu_id));
	}

	public function hapus($menu_id){
		method('get');
		$id=decode_id($this->input->get('id'));
		$this->db->where('id',$id)->update("tb_snp_rasetnis", ['deleted_at'=> date("Y-m-d H:i:s")]);
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
