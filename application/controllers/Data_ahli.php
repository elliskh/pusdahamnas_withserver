<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Data_ahli extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->_auth();
		$this->_path = 'data_ahli/';
		$this->_table = '';
		$this->link = base_url('data_ahli');
		//=========================================================//

		$this->load->model('menu/Menu_model', 'menu');
		$this->load->model('data_ahli/tb_data_ahli', 'tb_data_ahli');
	}

	public function index($menu_id = null)
	{
		method('get');
		checkPermission($this->_path, $menu_id, 1);
        

		$config 			= [
			'title' 		=> 'Data Pegiat HAM',
			'menu_id' 		=> $menu_id,
			'link' 			=> $this->link.'/tambah',
			'menu_active' 	=> 'Data Pegiat HAM',
			'menu_open' 	=> null,
			'path' 			=> $this->_path,
			'contents' 		=> $this->_path . 'index',
			'script_js' 		=> $this->_path . 'js',
			//=========================================================//
			'breadcrumb' 	=> [
				'Utama', 'Data Pegiat HAM', 'index'
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
        $list = $this->tb_data_ahli->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $row) {
            $no++;
			$aksi = "";
            $isi = array();
            $isi[] = $no;
            $isi[] = $row->nama;
            $isi[] = $row->nama_hak;
            $isi[] = $row->nama_subyek;
			$aksi .= '<a class="btn btn-sm btn-primary btn-block" href="'.base_url('data_ahli/edit/'.encode_id($row->id)).'/'.$menu_id.'"> <i class="fa fa-edit"></i> Edit</a>'; 
			$aksi .= '<a class="btn btn-sm btn-danger btn-block" href="javascript:;" onclick="hapus(\''.encode_id($row->id).'\')"> <i class="fa fa-trash"></i> Hapus</a>'; 
			
			$isi[] = $aksi;


            $data[] = $isi;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->tb_data_ahli->count_all(),
            "recordsFiltered" => $this->tb_data_ahli->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
    
    public function coba($menu_id = null)
    {
        echo "tes";
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
			'title' 		=> 'Tambah Pegiat HAM',
			'menu_id' 		=> $menu_id,
			'link' 			=> $this->link,
			'menu_active' 	=> 'Data Pegiat HAM',
			'menu_open' 	=> null,
			'path' 			=> $this->_path,
			'contents' 		=> $this->_path . 'tambah',
			'script_js' 		=> $this->_path . 'tambah_js',
			//=========================================================//
			'breadcrumb' 	=> [
				'Utama', 'Data Pegiat HAM', 'index'
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
		$data = $this->db->from('tb_ahli_ham')->where('id',$id)->get()->row();
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
			'title' 		=> 'Edit Data Pegiat HAM',
			'menu_id' 		=> $menu_id,
			'link' 			=> $this->link,
			'menu_active' 	=> 'Data Pegiat HAM',
			'menu_open' 	=> null,
			'path' 			=> $this->_path,
			'contents' 		=> $this->_path . 'tambah',
			'script_js' 		=> $this->_path . 'tambah_js',
			//=========================================================//
			'breadcrumb' 	=> [
				'Utama', 'Data Pegiat HAM', 'index'
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
        $id_topik_subyek = $this->input->post('id_topik_subyek[]');
        $topik_subyek    = (implode(",",$id_topik_subyek));//add ","

		method('post');
		$insert = 
		[
			'nama' => strip_tags($this->input->post('nama',true)),
			'instansi' => strip_tags($this->input->post('instansi',true)),
			'email' => strip_tags($this->input->post('email',true)),
			'status_person' => strip_tags($this->input->post('status_person',true)),
			'pendidikan' => strip_tags($this->input->post('pendidikan',true)),
			'id_topik_hak' => decode_id($this->input->post('id_topik_hak',true)),
			'id_topik_subyek' => $topik_subyek///$this->input->post('id_topik_subyek[]',true)
		];
		$cek = $this->db->from('tb_ahli_ham')->where('id',$id)->get();
		if ($cek->num_rows()> 0) {
			$insert['updated_at']=date('Y-m-d H:i:s');
			$insert['updated_by']=$this->session->userdata('username');
			$this->db->where('id',$id)->update('tb_ahli_ham',$insert);
		}else{
			$insert['created_at']=date('Y-m-d H:i:s');
			$insert['created_by']=$this->session->userdata('username');
			$this->db->insert('tb_ahli_ham',$insert);
			$id = $this->db->insert_id();
		}

		if ($_FILES['foto']['size'] != 0 && $_FILES['foto']['error'] == 0)
			{
				$dir = './uploads/fotoahli/';
				if (!is_dir($dir)) {
					mkdir($dir, 0755, TRUE);
				}
				$this->upload->initialize(array(
					"upload_path"	=> $dir,
					"allowed_types" => 'jpg|jpeg|png',
					"max_size" => '2000',
					"encrypt_name" => true
				));
	
				if(@$this->upload->do_upload('foto')) {
					$uploaded = $this->upload->data();
							$file_name = $this->upload->data('file_name');
							
							$data_insert_doc = [
									'foto' => $file_name
							];
							$this->db->where('id',$id)->update("tb_ahli_ham", $data_insert_doc);
						
					if($this->db->affected_rows()>0){
						$this->session->set_flashdata('success', 'Berhasil menambahkan.');
						redirect(base_url('data_ahli/index/'.$menu_id));
					} else{
						$this->session->set_flashdata('failed', 'Something went wrong.');
						redirect(base_url('data_ahli/index/'.$menu_id));
					}
				}else{
					echo $this->upload->display_errors();die;
				}
			}
			
			$this->session->set_flashdata('success', 'Berhasil diperbaharui.');
			redirect(base_url('data_ahli/index/'.$menu_id));
	}

	public function hapus($menu_id){
		method('get');
		$id=decode_id($this->input->get('id'));
		$this->db->where('id',$id)->update("tb_ahli_ham", 
            [
            'deleted_at' => date("Y-m-d H:i:s"),
            'is_active' => 0
            
            ]);
            
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
