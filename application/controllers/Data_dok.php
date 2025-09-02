<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Data_dok extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->_auth();
		$this->_path = 'data_dok/';
		$this->_table = '';
		$this->link = base_url('data_dok');
		//=========================================================//

		$this->load->model('menu/Menu_model', 'menu');
		$this->load->model('data_dok/tb_data_dok', 'tb_data_dok');
	}

	public function index($menu_id = null)
	{
		method('get');
		checkPermission($this->_path, $menu_id, 1);
		$hak = $this->db->where('is_active', '1')->get('ref_hak_dokumen')->result();
		$jenis = $this->db->where('is_active', '1')->get('ref_jenis_dokumen')->result();
		$media = $this->db->get('ref_media_dokumen')->result();
		$status = $this->db->get('ref_status_dokumen')->result();
		$subyek = $this->db->where('is_active', '1')->get('ref_subyek_dokumen')->result();
		$sumber = $this->db->where('is_active', '1')->get('ref_sumber_dokumen')->result();


		if ($this->session->userdata('id_lembaga') > 0) {
			$this->db->where('id', $this->session->userdata('id_lembaga'));
		}
		$lembaga = $this->db->get('ref_lembaga')->result();

		$config 			= [
			'hak' 		=> $hak,
			'lembaga' 		=> $lembaga,
			'sumber' => $sumber,
			'jenis' 		=> $jenis,
			'media' 		=> $media,
			'status' 		=> $status,
			'subyek' 		=> $subyek,
			'title' 		=> 'Data Dokumen',
			'menu_id' 		=> $menu_id,
			'link' 			=> $this->link . '/tambah',
			'menu_active' 	=> 'Data Dokumen',
			'menu_open' 	=> null,
			'path' 			=> $this->_path,
			'contents' 		=> $this->_path . 'index',
			'script_js' 		=> $this->_path . 'js',
			//=========================================================//
			'breadcrumb' 	=> [
				'Utama',
				'Data Dokumen',
				'index'
			],
			'modals' 		=> [],
			'plugins' 		=> [
				'select2' => true,
				'swal' => true
			]
		];
		render($config);
	}

	function get_data($menu_id)
	{
		// method('post');
		checkPermission($this->_path, $menu_id, 1);

		// Get filter values for id_topik_hak and id_topik_subyek
		$id_topik_hak_filter = $this->input->post('id_topik_hak');
		$id_topik_subyek_filter = $this->input->post('id_topik_subyek');

		$list = $this->tb_data_dok->get_datatables($id_topik_hak_filter, $id_topik_subyek_filter);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $row) {
			$no++;
			$aksi = "";
			$isi = array();
			$isi[] = $no;
			$isi[] = '<b>' . $row->nama_dokumen . '</b>';
			$isi[] = $row->unit_kerja;
			$isi[] = $row->no_dok;
			$isi[] = $row->tahun;
			$isi[] = $row->nama_media;
			$isi[] = $row->nama_jenis;

			// Fetch related hak from tb_dokumen_topik_hak
			$hak_list = $this->tb_data_dok->get_topik_hak($row->id);
			$isi[] = implode(', ', array_column($hak_list, 'nama_hak'));

			// Fetch related subyek from tb_dokumen_topik_subyek
			$subyek_list = $this->tb_data_dok->get_topik_subyek($row->id);
			$isi[] = implode(', ', array_column($subyek_list, 'nama_subyek'));

			// // Fetch related lembaga from tb_dokumen_lembaga
			// $lembaga_list = $this->tb_data_dok->get_lembaga($row->id);
			// $isi[] = implode(', ', array_column($lembaga_list, 'nama_lembaga'));

			$isi[] = $row->nama_status;
			$isi[] = $row->orig_name;
			$aksi .= '<a class="btn btn-sm btn-primary btn-block" href="' . base_url('data_dok/edit/' . encode_id($row->id)) . '/' . $menu_id . '"> <i class="fa fa-edit"></i> Edit</a>';
			if ($row->file_path) {
				$aksi .= '<a class="btn btn-sm btn-info btn-block" download="' . $row->orig_name . '" href="' . link_file($row->id, 'tb_dokumen', 'd') . '"> <i class="fa fa-download"></i> Unduh</a>';
			} else {
				$aksi .= '<a class="btn btn-sm btn-info btn-block" href="' . $row->link . '"> <i class="fa fa-download"></i> Unduh</a>';
			}
			$aksi .= '<a class="btn btn-sm btn-danger btn-block" href="javascript:;" onclick="hapus(\'' . encode_id($row->id) . '\')"> <i class="fa fa-trash"></i> Hapus</a>';

			$isi[] = $aksi;

			$data[] = $isi;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->tb_data_dok->count_all(),
			"recordsFiltered" => $this->tb_data_dok->count_filtered($id_topik_hak_filter, $id_topik_subyek_filter),
			"data" => $data,
		);
		echo json_encode($output);
	}
	public function tambah($menu_id = null)
	{
		method('get');
		checkPermission($this->_path, $menu_id, 2);
		$hak = $this->db->where('is_active', '1')->get('ref_hak_dokumen')->result();
		$jenis = $this->db->where('is_active', '1')->get('ref_jenis_dokumen')->result();
		$media = $this->db->get('ref_media_dokumen')->result();
		$status = $this->db->get('ref_status_dokumen')->result();
		$subyek = $this->db->where('is_active', '1')->get('ref_subyek_dokumen')->result();
		$sumber = $this->db->where('is_active', '1')->get('ref_sumber_dokumen')->result();
		$bahasa = $this->db->where('is_active', '1')->get('ref_bahasa_dokumen')->result();


		if ($this->session->userdata('id_lembaga') > 0) {
			$this->db->where('id', $this->session->userdata('id_lembaga'));
		}
		$lembaga = $this->db->get('ref_lembaga')->result();
		$config 			= [
			'hak' 		=> $hak,
			'lembaga' 		=> $lembaga,
			'sumber' => $sumber,
			'bahasa' => $bahasa,
			'jenis' 		=> $jenis,
			'media' 		=> $media,
			'status' 		=> $status,
			'subyek' 		=> $subyek,
			'title' 		=> 'Tambah Data Dokumen',
			'menu_id' 		=> $menu_id,
			'link' 			=> $this->link,
			'menu_active' 	=> 'Data Dokumen',
			'menu_open' 	=> null,
			'path' 			=> $this->_path,
			'contents' 		=> $this->_path . 'tambah',
			'script_js' 		=> $this->_path . 'tambah_js',
			//=========================================================//
			'breadcrumb' 	=> [
				'Utama',
				'Data Dokumen',
				'index'
			],
			'modals' 		=> [],
			'plugins' => [
				'select2' => true
			]
		];

		render($config);
	}


	public function edit($id, $menu_id = null)
	{
		method('get');
		checkPermission($this->_path, $menu_id, 2);
		$id = decode_id($id);
		$data = $this->db->from('tb_dokumen')->where('id', $id)->get()->row();

		// Fetch id_topik_hak from the relation table
		$id_topik_hak = $this->db->select('id_topik_hak')
			->from('tb_dokumen_topik_hak')
			->where('id_dokumen', $id)
			->get()
			->result_array();
		$data->id_topik_hak = array_column($id_topik_hak, 'id_topik_hak');

		// Fetch id_topik_subyek from the relation table
		$id_topik_subyek = $this->db->select('id_topik_subyek')
			->from('tb_dokumen_topik_subyek')
			->where('id_dokumen', $id)
			->get()
			->result_array();
		$data->id_topik_subyek = array_column($id_topik_subyek, 'id_topik_subyek');

		// Fetch id_lembaga from tb_dokumen_lembaga
		$id_lembaga = $this->db->select('id_lembaga')
			->from('tb_dokumen_lembaga')
			->where('id_dokumen', $id)
			->get()
			->result_array();
		$data->id_lembaga = array_column($id_lembaga, 'id_lembaga');

		// Fetch id_sumber from tb_dokumen_sumber
		$id_sumber = $this->db->select('id_sumber')
			->from('tb_dokumen_sumber')
			->where('id_dokumen', $id)
			->get()
			->result_array();
		$data->id_sumber = array_column($id_sumber, 'id_sumber');

		$hak = $this->db->where('is_active', '1')->get('ref_hak_dokumen')->result();
		$jenis = $this->db->where('is_active', '1')->get('ref_jenis_dokumen')->result();
		$media = $this->db->get('ref_media_dokumen')->result();
		$status = $this->db->get('ref_status_dokumen')->result();
		$subyek = $this->db->where('is_active', '1')->get('ref_subyek_dokumen')->result();
		$sumber = $this->db->where('is_active', '1')->get('ref_sumber_dokumen')->result();
		$bahasa = $this->db->where('is_active', '1')->get('ref_bahasa_dokumen')->result();


		if ($this->session->userdata('id_lembaga') > 0) {
			$this->db->where('id', $this->session->userdata('id_lembaga'));
		}
		$lembaga = $this->db->get('ref_lembaga')->result();
		$config             = [
			'data' => $data,
			'hak'       => $hak,
			'lembaga'       => $lembaga,
			'jenis'         => $jenis,
			'media'         => $media,
			'status'        => $status,
			'subyek'        => $subyek,
			'sumber'        => $sumber,
			'bahasa'        => $bahasa,
			'title'         => 'Edit Data Dokumen',
			'menu_id'       => $menu_id,
			'link'          => $this->link,
			'menu_active'   => 'Data Dokumen',
			'menu_open'     => null,
			'path'          => $this->_path,
			'contents'      => $this->_path . 'tambah',
			'script_js'         => $this->_path . 'tambah_js',
			//=========================================================//
			'breadcrumb'    => [
				'Utama',
				'Data Dokumen',
				'index'
			],
			'modals'        => [],
			'plugins' => [
				'select2' => true
			]
		];

		render($config);
	}



	public function simpan()
	{
		$this->load->library('upload');
		$menu_id = $this->input->post('menu_id', true);
		$id = decode_id($this->input->post('id', true));

		method('post');
		$insert =
			[
				'unit_kerja' => $this->input->post('unit_kerja', true),
				'nama_dokumen' => $this->input->post('nama_dokumen', true),
				'no_dok' => $this->input->post('no_dok', true),
				'tahun' => $this->input->post('tahun', true),
				'id_media_dokumen' => decode_id($this->input->post('id_media_dokumen', true)),
				'penulis' => $this->input->post('penulis', true),
				'id_bahasa' => decode_id($this->input->post('id_bahasa', true)),
				'id_jenis_dokumen' =>  decode_id($this->input->post('id_jenis_dokumen', true)),
				'id_status_dokumen' =>  decode_id($this->input->post('id_status_dokumen', true)),
				'link' =>  $this->input->post('link', true),
				'katakunci' =>  str_replace(" ", "", $this->input->post('katakunci', true)),
				'deskripsi' => ($this->input->post('deskripsi', true)),
				'created_at' => date('Y-m-d H:i:s')
			];
		$cek = $this->db->from('tb_dokumen')->where('id', $id)->get();
		if ($cek->num_rows() > 0) {
			if ($this->input->post('link', true)) {
				$insert['file_name'] = NULL;
				$insert['file_path'] = NULL;
				$insert['orig_name'] = NULL;
				$insert['file_size'] = NULL;
				$this->db->where('id', $id)->update('tb_dokumen', $insert);
			}
			$this->db->where('id', $id)->update('tb_dokumen', $insert);
		} else {
			$this->db->insert('tb_dokumen', $insert);
			$id = $this->db->insert_id();
		}

		// Handle tb_dokumen_lembaga
		$id_lembaga_array = $this->input->post('id_lembaga', true);
		if ($id_lembaga_array) {
			// First, delete existing relations
			$this->db->where('id_dokumen', $id)->delete('tb_dokumen_lembaga');

			// Then insert new relations
			foreach ($id_lembaga_array as $id_lembaga) {
				$this->db->insert('tb_dokumen_lembaga', [
					'id_dokumen' => $id,
					'id_lembaga' => decode_id($id_lembaga)
				]);
			}
		}

		$id_topik_hak_array = $this->input->post('id_topik_hak', true);
		if ($id_topik_hak_array) {
			// First, delete existing relations
			$this->db->where('id_dokumen', $id)->delete('tb_dokumen_topik_hak');

			// Then insert new relations
			foreach ($id_topik_hak_array as $id_topik_hak) {
				$this->db->insert('tb_dokumen_topik_hak', [
					'id_dokumen' => $id,
					'id_topik_hak' => decode_id($id_topik_hak)
				]);
			}
		}

		$id_topik_subyek_array = $this->input->post('id_topik_subyek', true);
		if ($id_topik_subyek_array) {
			// First, delete existing relations
			$this->db->where('id_dokumen', $id)->delete('tb_dokumen_topik_subyek');

			// Then insert new relations
			foreach ($id_topik_subyek_array as $id_topik_subyek) {
				$this->db->insert('tb_dokumen_topik_subyek', [
					'id_dokumen' => $id,
					'id_topik_subyek' => decode_id($id_topik_subyek)
				]);
			}
		}

		// Handle tb_dokumen_sumber
		$id_sumber_array = $this->input->post('id_sumber', true);
		if ($id_sumber_array) {
			// First, delete existing relations
			$this->db->where('id_dokumen', $id)->delete('tb_dokumen_sumber');

			// Then insert new relations
			foreach ($id_sumber_array as $id_sumber) {
				$this->db->insert('tb_dokumen_sumber', [
					'id_dokumen' => $id,
					'id_sumber' => decode_id($id_sumber)
				]);
			}
		}

		if ($_FILES['dokumen']['size'] != 0 && $_FILES['dokumen']['error'] == 0) {
			$dir = './uploads/dokumen/' . $id;
			if (!is_dir($dir)) {
				mkdir($dir, 0755, TRUE);
			}
			$this->upload->initialize(array(
				"upload_path"	=> $dir,
				"allowed_types" => 'pdf|doc|docx',
				"max_size" => '20000',
				"encrypt_name" => true
			));

			if (@$this->upload->do_upload('dokumen')) {
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
				$this->db->where('id', $id)->update("tb_dokumen", $data_insert_doc);

				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('success', 'Berhasil menambahkan.');
					redirect(base_url('data_dok/index/' . $menu_id));
				} else {
					$this->session->set_flashdata('failed', 'Something went wrong.');
					redirect(base_url('data_dok/index/' . $menu_id));
				}
			} else {
				echo $this->upload->display_errors();
				die;
			}
		}

		if ($_FILES['cover']['size'] != 0 && $_FILES['cover']['error'] == 0) {
			$dir = './uploads/cover';
			//if (!is_dir($dir)) {
			//	mkdir($dir, 0755, TRUE);
			//}
			$this->upload->initialize(array(
				"upload_path"	=> $dir,
				"allowed_types" => 'png|jpg|jpeg',
				"max_size" => '50000',
				"encrypt_name" => true,
				"overwrite" => false
			));

			if (@$this->upload->do_upload('cover')) {
				$uploaded = $this->upload->data();
				$file_name2 = $this->upload->data('file_name');
				$data_insert_cov = [
					'gambar' => $file_name2
				];
				$this->db->where('id', $id)->update("tb_dokumen", $data_insert_cov);
			}
		}

		$this->session->set_flashdata('success', 'Berhasil diperbaharui.');
		redirect(base_url('data_dok/index/' . $menu_id));
	}

	public function hapus($menu_id)
	{
		method('get');
		$id = decode_id($this->input->get('id'));
		$this->db->where('id', $id)->update("tb_dokumen", ['deleted_at' => date("Y-m-d H:i:s")]);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Berhasil menambahkan.');
			echo json_encode([
				'status' => true
			]);
		} else {
			echo json_encode([
				'status' => false
			]);
		}
	}
}

/* End of file Utama.php */
