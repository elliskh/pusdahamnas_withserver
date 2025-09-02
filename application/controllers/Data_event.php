<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Data_event extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->_auth();
		$this->_path = 'data_event/';
		$this->_table = '';
		$this->link = base_url('data_event');
		//=========================================================//

		$this->load->model('menu/Menu_model', 'menu');
		$this->load->model('data_event/tb_data_event', 'tb_data_event');
	}

	public function index($menu_id = null)
	{
		method('get');
		checkPermission($this->_path, $menu_id, 1);

		$config 			= [
			'title' 		=> 'Data Agenda',
			'menu_id' 		=> $menu_id,
			'link' 			=> $this->link.'/tambah',
			'menu_active' 	=> 'Data Agenda',
			'menu_open' 	=> null,
			'path' 			=> $this->_path,
			'contents' 		=> $this->_path . 'index',
			'script_js' 		=> $this->_path . 'js',
			//=========================================================//
			'breadcrumb' 	=> [
				'Utama', 'Data Agenda', 'index'
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
        $list = $this->tb_data_event->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $row) {
            $no++;
			$aksi = "";
            $isi = array();
            $isi[] = $no;
            $isi[] = '<b>'.$row->judul.'</b><br>'.$row->sub_judul;
            $isi[] = $row->kat;
            $isi[] = $row->start.' s.d '.$row->end.' '.$row->zona;
            $isi[] = $row->format;
            $isi[] = $row->nama_hubung.'<br>'.$row->hp_hubung.'<br>';
            $isi[] = $row->pembawa_acara.'<br>'.$row->no_pembawa_acara.'<br>';
            $isi[] = $row->link_meet;
			$aksi .= '<a class="btn btn-sm btn-primary btn-block" href="'.base_url('data_event/edit/'.encode_id($row->id_event)).'/'.$menu_id.'"> <i class="fa fa-edit"></i> Edit</a>'; 
			$aksi .= '<a class="btn btn-sm btn-danger btn-block" href="javascript:;" onclick="hapus(\''.encode_id($row->id_event).'\')"> <i class="fa fa-trash"></i> Hapus</a>'; 
			
			$isi[] = $aksi;


            $data[] = $isi;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->tb_data_event->count_all(),
            "recordsFiltered" => $this->tb_data_event->count_filtered(),
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
			'title' 		=> 'Tambah Data Agenda',
			'menu_id' 		=> $menu_id,
			'link' 			=> $this->link,
			'menu_active' 	=> 'Data Agenda',
			'menu_open' 	=> null,
			'path' 			=> $this->_path,
			'contents' 		=> $this->_path . 'tambah',
			'script_js' 		=> $this->_path . 'tambah_js',
			//=========================================================//
			'breadcrumb' 	=> [
				'Utama', 'Data Agenda', 'index'
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
		$data = $this->db->from('tb_event')->where('id_event',$id)->get()->row();
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
			'title' 		=> 'Update Data Agenda',
			'menu_id' 		=> $menu_id,
			'link' 			=> $this->link,
			'menu_active' 	=> 'Data Agenda',
			'menu_open' 	=> null,
			'path' 			=> $this->_path,
			'contents' 		=> $this->_path . 'tambah',
			'script_js' 		=> $this->_path . 'tambah_js',
			//=========================================================//
			'breadcrumb' 	=> [
				'Utama', 'Data Agenda', 'index'
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
			'sub_judul' => $this->input->post('sub_judul',true),
			'kat' => $this->input->post('kategori',true),
			'format' => $this->input->post('format',true),
			'nama_hubung' => $this->input->post('nama_hubung',true),
			'hp_hubung' => $this->input->post('hp_hubung',true),
			'link_meet' => $this->input->post('link_meet',true),
			'start' => $this->input->post('waktu_mulai',true),
			'end' => $this->input->post('waktu_selesai',true),
			'zona' => 'WIB',
			'id_lembaga' =>  decode_id($this->input->post('id_lembaga',true)),
			'deskripsi' =>  ($this->input->post('deskripsi',true)),
			'created_at' => date('Y-m-d H:i:s')
		];
		$cek = $this->db->from('tb_event')->where('id_event',$id)->get();
		if ($cek->num_rows()> 0) {
			$insert['created_by']=$this->session->userdata('username');
			$this->db->where('id_event',$id)->update('tb_event',$insert);
		}else{
			$insert['created_by']=$this->session->userdata('username');
			$this->db->insert('tb_event',$insert);
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
			redirect(base_url('data_event/index/'.$menu_id));
	}

	public function hapus($menu_id){
		method('get');
		$id=decode_id($this->input->get('id'));
		$this->db->where('id_event',$id)->update("tb_event", ['deleted_at'=> date("Y-m-d H:i:s")]);
		if($this->db->affected_rows()>0){
			$this->session->set_flashdata('success', 'Berhasil menambahkan.');
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
