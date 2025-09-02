<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MX_Controller
{
	public function __construct(){
        parent::__construct();
        // $this->load->library('pagination');
    }

	public function index() {

        //
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        //	   
  //       $data = [];

		// $view = [
  //           'title' => "Beranda",
  //           'content' => 'front/index',
  //           'js' => 'front/js',
  //           'css' => 'front/css'
  //       ];

  //       $this->template->display_front($view, $data);
		redirect(base_url('home/data'));
	}

	public function about() {
        $data = [
        	'data' => $this->db->where('is_active', '1')->get('link_terkait a')->result_array(),
    	];
    	
		$view = [
            'title' => "Dataset Pusdahamnas",
            'content' => 'front/about',
        ];

        $this->template->display_front($view, $data);
	}

	public function ahli_ham($idd=null) {
		if (@$idd)
		{
			redirect(base_url('home/ahli_ham'));
		}
		else if (@$this->input->get())
		{
			redirect(base_url('home/ahli_ham'));
		}
		else
		{
	        $data = [
	        	'data' => $this->db->where('deleted_at is null')->join('ref_hak_dokumen b', 'a.id_topik_hak=b.id_hak', 'left')->join('ref_subyek_dokumen c', 'a.id_topik_subyek=c.id_subyek', 'left')->order_by('a.nama','asc')->get('tb_ahli_ham a')->result_array(),
	        	'ref_hak_dokumen' => $this->db->where('is_active', '1')->order_by('nama_hak','asc')->get('ref_hak_dokumen')->result_array(),
	        	'ref_subyek_dokumen' => $this->db->where('is_active', '1')->order_by('nama_subyek','asc')->get('ref_subyek_dokumen')->result_array(),
	        ];

			$view = [
	            'title' => "Dataset Ahli Ham",
	            'js' => "front/ahli_ham_js",
	            'content' => 'front/ahli_ham',
	        ];

	        $this->template->display_front($view, $data);
		}
	}

	public function detail_ahli_ham()
	{
		$id=$this->input->post('id',TRUE);
		if (@$id)
		{
			$dt=$this->db->query("SELECT a.*, b.nama_hak, c.nama_subyek FROM tb_ahli_ham a LEFT JOIN ref_hak_dokumen b ON a.id_topik_hak=b.id_hak LEFT JOIN ref_subyek_dokumen c ON a.id_topik_subyek=c.id_subyek WHERE a.id='".$id."'")->row_array();

			if ($dt['foto']=='')
			{
				$gambar="https://pusdahamnas.komnasham.go.id/assets/noimage.png";
			}
			else
			{
				$gambar=base_url('uploads/fotoahli/'.$dt['foto'].'');
			}
			echo "<center><h4>Detail Ahli HAM</h4></center>
				  <hr>
				  <table class='table table-bordered table-striped'>
				  	<tr>
				  		<td colspan='3'><center><img src='".$gambar."' class='img-responsive' style='width:25%'></center></td>
				  	</tr>
				  	<tr>
				  		<td style='width:23%'>Nama Ahli</td>
				  		<td style='width:2%'>:</td>
				  		<td>".$dt['nama']."</td>
				  	</tr>
				  	<tr>
				  		<td>Instansi</td>
				  		<td>:</td>
				  		<td>".$dt['instansi']."</td>
				  	</tr>
				  	<tr>
				  		<td>Topik Hak</td>
				  		<td>:</td>
				  		<td>".$dt['nama_hak']."</td>
				  	</tr>
				  	<tr>
				  		<td>Email</td>
				  		<td>:</td>
				  		<td>".$dt['email']."</td>
				  	</tr>
				  </table>";
		}
		else
		{
			redirect(base_url('home/ahli_ham'));
		}
	}

	public function ahli_ham_cari() {
		if ($this->input->post('id_hak', true)!='')
			$this->db->where('id_topik_hak', $this->input->post('id_hak', true));

		if ($this->input->post('id_subyek', true)!="")
			$this->db->where('id_topik_subyek', $this->input->post('id_subyek', true));

		if ($this->input->post('key', true)!="")
			$this->db->like('a.nama', $this->input->post('key', true));

		$data_ahli_ham = $this->db->where('deleted_at is null')->join('ref_hak_dokumen b', 'a.id_topik_hak=b.id_hak', 'left')->join('ref_subyek_dokumen c', 'a.id_topik_subyek=c.id_subyek', 'left')->order_by('a.nama','asc')->get('tb_ahli_ham a')->result_array();
        $data = [
        	'data' => $data_ahli_ham,
        ];

        $this->load->view('front/ahli_ham_hasil', $data);
	}

	public function set_data() {
		$this->session->set_userdata($this->input->post('key', true), $this->input->post('val', true));
		echo 'Berhasil';
	}

	public function data($id=null) {
		$max_per_page = 5;   //jumlah data maksimal per halaman berapa , kalau 5 ya brarti nanti jumlah page nya menyesuaikan jumlah data / 5
		if ($this->uri->segment(1)=='home')
			$base_url = 'data'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini
		else
			$base_url = 'home/data'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini

		/*$id_hak = $this->input->post('id_hak', true);
		$id_subyek = $this->input->post('id_subyek', true);
		$id_lembaga = $this->input->post('id_lembaga', true);
		$huruf = $this->input->post('huruf', true);
		$key = $this->input->post('key', true);*/

		$id_hak = @$this->input->post('id_hak', true)?$this->input->post('id_hak', true):$this->session->userdata('id_hak');
		$id_subyek = @$this->input->post('id_subyek', true)?$this->input->post('id_subyek', true):$this->session->userdata('id_subyek');
		$id_lembaga = @$this->input->post('id_lembaga', true)?$this->input->post('id_lembaga', true):$this->session->userdata('id_lembaga');
		$huruf = @$this->input->post('huruf', true)?$this->input->post('huruf', true):$this->session->userdata('huruf');
		$this->session->set_userdata('huruf', $huruf);
		$key = $this->session->userdata('key');

		if ($this->uri->segment(1)!='home') {
			$this->session->unset_userdata('id_hak');
			$this->session->unset_userdata('id_subyek');
			$this->session->unset_userdata('id_lembaga');
			$this->session->unset_userdata('huruf');
			$this->session->unset_userdata('key');
		}


		//GET TAMPIL PAGINATION
		if (isset($_GET['per_page'])) {
			$per_page = (int)$this->input->get('per_page');
			$this->db->limit($max_per_page, ($per_page - 1) * $max_per_page);
		} else {
			$per_page = 1;
			$this->db->limit($max_per_page);
		}


		if ($key!='') {
			$this->db->where('nama_dokumen like "%'.$key.'%"');
		}
		if ($id_hak!='') {
			$this->db->where('id_topik_hak', $id_hak);
		}
		if ($id_subyek!='') {
			$this->db->where('id_topik_subyek', $id_subyek);
		}
		if ($id_lembaga!='') {
			$this->db->where('id_lembaga', $id_lembaga);
		}
		if ($huruf!='' && $huruf!='Semua') {
			$this->db->where('substr(nama_dokumen,1,1)', $huruf);
		}
		$this->db->order_by('created_at','desc');
        $get_paging = '';// andiek
        if($this->db->get('v_tb_dokumen')){
		   $get_paging = $this->db->get('v_tb_dokumen');
        }

		//GET ALL JUMLAH DOKUMEN
		if ($key!='') {
			$this->db->where('nama_dokumen like "%'.$key.'%"');
		}
		if ($id_hak!='') {
			$this->db->where('id_topik_hak', $id_hak);
		}
		if ($id_subyek!='') {
			$this->db->where('id_topik_subyek', $id_subyek);
		}
		if ($id_lembaga!='') {
			$this->db->where('id_lembaga', $id_lembaga);
		}
		if ($huruf!='' && $huruf!='Semua') {
			$this->db->where('substr(nama_dokumen,1,1)', $huruf);
		}
        $total_data = '';//andiek
        if($this->db->get('v_tb_dokumen')){
		   ///$total_data = $this->db->count_all_results('v_tb_dokumen');
           $total_data = $this->db->get('v_tb_dokumen');
        }
       /// $data = [];
        if($get_paging){
    		$data = [
    			'id' => $id,
    			'list_dokumen' => $get_paging->result_array(),
    			'jum' => $get_paging->num_rows(),
    			'agenda' => $this->db->where('deleted_at IS NULL',null)->order_by('start','desc')->get('tb_event',3)->result(),
    			'glossary' => $this->db->order_by('judul','asc')->get('tb_glossari',3)->result(),
    			'id_hak' => $id_hak,
    			'id_subyek' => $id_subyek,
    			'id_lembaga' => $id_lembaga,
    			'huruf' => $huruf,
    			'key' => $key,
    			// 'cari_kata' => $cari_kata,
    			'all_huruf' => array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'),
    			// 'key' => (@$this->input->post('key') ? $this->input->post('key') : ''),
    			'pagging' => $this->pagging_data_dokumen($total_data, $max_per_page, $per_page, $base_url, TRUE),
            	'ref_hak_dokumen' => $this->db->select('a.*, count(b.id) as jml')->where('a.is_active', '1')->join('tb_dokumen b', 'a.id_hak=b.id_topik_hak and b.deleted_at is null', 'left')->order_by('a.nama_hak','asc')->group_by('a.id_hak')->get('ref_hak_dokumen a')->result_array(),
            	'ref_lembaga' => $this->db->select('a.*, count(b.id) as jml')->where('a.is_active', '1')->join('tb_dokumen b', 'a.id=b.id_lembaga and b.deleted_at is null', 'left')->group_by('a.id')->get('ref_lembaga a')->result_array(),
            	'ref_subyek_dokumen' => $this->db->select('a.*, count(b.id) as jml')->where('a.is_active', '1')->join('tb_dokumen b', 'a.id_subyek=b.id_topik_subyek and b.deleted_at is null', 'left')->group_by('a.id_subyek')->order_by('a.nama_subyek','asc')->get('ref_subyek_dokumen a')->result_array(),
            	// 'list_dokumen' => $this->db->get("v_tb_dokumen a")->result(),
            ];
        }else{
            $data = [
    			'id' => '',
    			'list_dokumen' => '',
    			'jum' => '',
    			'agenda' => '',
    			'glossary' => '',
    			'id_hak' => '',
    			'id_subyek' => '',
    			'id_lembaga' => '',
    			'huruf' => '',
    			'key' => '',
    			// 'cari_kata' => $cari_kata,
    			'all_huruf' => array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'),
    			// 'key' => (@$this->input->post('key') ? $this->input->post('key') : ''),
    			'pagging' => '',
            	'ref_hak_dokumen' => '',
            	'ref_lembaga' => '',
            	'ref_subyek_dokumen' => '',
            	// 'list_dokumen' => $this->db->get("v_tb_dokumen a")->result(),   
                ];
        }
        

		$view = [
            'title' => "Beranda",
            'content' => 'front/data',
            'js' => 'front/data_js',
            'css' => 'front/data_css'
        ];

        $this->template->display_front($view, $data);
	}

	public function data_cari() {
		$max_per_page = 5;   //jumlah data maksimal per halaman berapa , kalau 5 ya brarti nanti jumlah page nya menyesuaikan jumlah data / 5
		if ($this->uri->segment(2)=='data')
			$base_url = 'data'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini
		else
			$base_url = 'home/data'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini

		$id_hak = $this->session->userdata('id_hak');
		$id_subyek = $this->session->userdata('id_subyek');
		$id_lembaga = $this->session->userdata('id_lembaga');
		$huruf = $this->session->userdata('huruf');
		$key = $this->session->userdata('key');
		$key = $this->input->post('key', true);
		$this->session->set_userdata('key', $key);

		//GET TAMPIL PAGINATION
		if (isset($_GET['per_page'])) {
			$per_page = (int)$this->input->get('per_page');
			$this->db->limit($max_per_page, ($per_page - 1) * $max_per_page);
		} else {
			$per_page = 1;
			$this->db->limit($max_per_page);
		}

		if ($key!='') {
			$this->db->where('nama_dokumen like "%'.$key.'%"');
		}
		if ($id_hak!='') {
			$this->db->where('id_topik_hak', $id_hak);
		}
		if ($id_subyek!='') {
			$this->db->where('id_topik_subyek', $id_subyek);
		}
		if ($id_lembaga!='') {
			$this->db->where('id_lembaga', $id_lembaga);
		}
		if ($huruf!='' && $huruf!='Semua') {
			$this->db->where('substr(nama_dokumen,1,1)', $huruf);
		}
		$get_paging = $this->db->get('v_tb_dokumen');

		//GET ALL JUMLAH DOKUMEN
		if ($key!='') {
			$this->db->where('nama_dokumen like "%'.$key.'%"');
		}
		if ($id_hak!='') {
			$this->db->where('id_topik_hak', $id_hak);
		}
		if ($id_subyek!='') {
			$this->db->where('id_topik_subyek', $id_subyek);
		}
		if ($id_lembaga!='') {
			$this->db->where('id_lembaga', $id_lembaga);
		}
		if ($huruf!='' && $huruf!='Semua') {
			$this->db->where('substr(nama_dokumen,1,1)', $huruf);
		}
		$total_data = $this->db->count_all_results('v_tb_dokumen');

		$data = [
			'list_dokumen' => $get_paging->result_array(),
			'jum' => $get_paging->num_rows(),
			'id_hak' => $id_hak,
			'id_subyek' => $id_subyek,
			'id_lembaga' => $id_lembaga,
			'huruf' => $huruf,
			'key' => $key,
			'all_huruf' => array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'),
			'pagging' => $this->pagging_data_dokumen($total_data, $max_per_page, $per_page, $base_url, TRUE),
        	'ref_hak_dokumen' => $this->db->select('a.*, count(b.id) as jml')->where('a.is_active', '1')->join('tb_dokumen b', 'a.id_hak=b.id_topik_hak and b.deleted_at is null', 'left')->group_by('a.id_hak')->get('ref_hak_dokumen a')->result_array(),
        	'ref_lembaga' => $this->db->select('a.*, count(b.id) as jml')->where('a.is_active', '1')->join('tb_dokumen b', 'a.id=b.id_lembaga and b.deleted_at is null', 'left')->group_by('a.id')->get('ref_lembaga a')->result_array(),
        	'ref_subyek_dokumen' => $this->db->select('a.*, count(b.id) as jml')->where('a.is_active', '1')->join('tb_dokumen b', 'a.id_subyek=b.id_topik_subyek and b.deleted_at is null', 'left')->group_by('a.id_subyek')->get('ref_subyek_dokumen a')->result_array(),
        ];

		$this->load->view('front/hasil_cari', $data);
	}

	public function data_detail($id=null) {
		if ($id==null)
			redirect(base_url());
		
        $data = [
        	'id' => $id,
        	'detail' => $this->db->where('id', decode_id($id))->get('v_tb_dokumen')->row_array(),
        	'detail2' => $this->db->where('id', decode_id($id))->get('tb_dokumen')->row_array(),
        ];
        $data['terkait'] = $this->db->where('id_jenis_dokumen', $data['detail']['id_jenis_dokumen'])->order_by('rand()')->limit(8)->get('v_tb_dokumen')->result_array();

		$view = [
            'title' => "Dataset Pusdahamnas",
            'content' => 'front/data_detail',
            'js' => 'front/data_detail_js',
        ];

        $this->template->display_front($view, $data);
	}

	public function glossary($id=null) {

		$max_per_page = 10;   //jumlah data maksimal per halaman berapa , kalau 5 ya brarti nanti jumlah page nya menyesuaikan jumlah data / 5
		if ($this->uri->segment(1)=='home')
			$base_url = 'glossary'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini
		else
			$base_url = 'home/glossary'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini

		$huruf = @$this->input->post('huruf', true)?$this->input->post('huruf', true):$this->session->userdata('hurufglosari');
		$this->session->set_userdata('hurufglosari', $huruf);
		$key = $this->session->userdata('keyglosari');

		if ($this->uri->segment(1)!='home') {
			$this->session->unset_userdata('hurufglosari');
			$this->session->unset_userdata('keyglosari');
		}


		//GET TAMPIL PAGINATION
		if (isset($_GET['per_page'])) {
			$per_page = (int)$this->input->get('per_page');
			$this->db->limit($max_per_page, ($per_page - 1) * $max_per_page);
		} else {
			$per_page = 1;
			$this->db->limit($max_per_page);
		}


		if ($key!='') {
			$this->db->where('judul like "%'.$key.'%"');
		}
	
		if ($huruf!='' && $huruf!='Semua') {
			$this->db->where('substr(judul,1,1)', $huruf);
		}
        $this->db->where('deleted_at IS NULL',null);
		$this->db->order_by('judul','asc');
        
		$get_paging = $this->db->get('tb_glossari');

		//GET ALL JUMLAH DOKUMEN
		if ($key!='') {
			$this->db->where('judul like "%'.$key.'%"');
		}
		if ($huruf!='' && $huruf!='Semua') {
			$this->db->where('substr(judul,1,1)', $huruf);
		}
		$total_data = $this->db->count_all_results('tb_glossari');

		$data = [
			'id' => $id,
			'list_glossari' => $get_paging->result_array(),
			'jum' => $get_paging->num_rows(),
			'huruf' => $huruf,
			'key' => $key,
			// 'cari_kata' => $cari_kata,
			'all_huruf' => array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'),
			// 'key' => (@$this->input->post('key') ? $this->input->post('key') : ''),
			'pagging' => $this->pagging_data_dokumen($total_data, $max_per_page, $per_page, $base_url, TRUE)
        ];

		$view = [
            'title' => "Beranda",
            'content' => 'front/glossari',
            'js' => 'front/glossari_js',
            'css' => 'front/glossari_css'
        ];

        $this->template->display_front($view, $data);
	}

	public function save_download() {
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('instansi', 'Lembaga/Instansi', 'required');
		$this->form_validation->set_rules('email', 'Alamat Email', 'required');
		$this->form_validation->set_rules('tujuan', 'Tujuan Pengunduhan', 'required');
		$this->form_validation->set_rules('id_data', 'Dokumen Tidak Valid', 'required');

		if ($this->form_validation->run() == FALSE) {
			$response = [
				'status' => false,
				'message' => 'Data Harus Dilengkapi',
			];
		} else {
			$g_recaptcha_response = $this->security->xss_clean(post('g-recaptcha-response'));
			$check_captcha = $this->recaptcha->is_valid($g_recaptcha_response);
			if (!$g_recaptcha_response) {
				$response = [
					'status' => false,
					'message' => 'Captcha Wajib Dicentang',
				];
			}
			else if (!@$check_captcha['success']) {
				$response = [
					'status' => false,
					'message' => 'Silakan cek kembali pada captcha',
				];
			}
			else
			{
				$detail = $this->db->where('id', decode_id($this->input->post('id_data')))->get('v_tb_dokumen')->row_array();
				if ($detail['link']!=null && $detail['link']!='') {
					$link = $detail['link'];
				} else if ($detail['file_path']!=null && $detail['file_path']!='') {
					$link = link_file($detail['id'], 'tb_dokumen', 'd');
				} else {
					$link = '#';
				}

				$set_insert['id_dokumen'] = decode_id($this->input->post('id_data', true));
				$set_insert['nama'] = $this->input->post('nama', true);
				$set_insert['instansi'] = $this->input->post('instansi', true);
				$set_insert['email'] = $this->input->post('email', true);
				$set_insert['tujuan'] = $this->input->post('tujuan', true);
				$set_insert['created_at'] = date('Y-m-d H:i:s');
				$this->db->set($set_insert)->insert('tb_dokumen_pengunduh');
				if ($this->db->insert_id()>0) {
					$response = [
						'status' => true,
						'message' => 'Data Berhasil Tersimpan',
						'link' => $link
					];
				} else {
					$response = [
						'status' => false,
						'message' => 'Database Tidak Dapat Diakses. Ulangi Pengisian Form!',
					];
				}
			}
		}
		echo json_encode($response);
	}

	protected function pagging_data_dokumen($total_data, $max, $now_page, $base_url, $page_query_string)
	{
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = $base_url;
		$config['total_rows'] = $total_data;
		$config['per_page'] = $max;
		$config['num_links'] = 5;
		$config['use_page_numbers'] = TRUE;
		$config['page_query_string'] = $page_query_string;

		$config['full_tag_open'] = '<div class="col-12 text-center mt-4 mt-md-5">';
		$config['full_tag_close'] = '</div>';
		$config['full_tag_open'] = '<ul class="pagination justify-content-center mb-0">';
		$config['full_tag_close'] = '</ul>';
		$config['cur_tag_open'] = '<li class="page-item active" aria-current="page"><span class="page-link"> ';
		$config['cur_tag_close'] = "</span></li>";
		$config['next_tag_open'] = '<li class="page-item"> <span class="page-link b-radius-none"> ';
		$config['next_tag_close'] = "</span></li>";
		$config['prev_tag_open'] = '<li class="page-item"> <span class="page-link b-radius-none"> ';
		$config['prev_tag_close'] = "</span></li>";
		$config['num_tag_open'] = '<li class="page-item"> <span class="page-link b-radius-none"> ';
		$config['num_tag_close'] = '</span></li>';
		$config['first_tag_open'] = '<li class="page-item"> <span class="page-link b-radius-none"> ';
		$config['first_tag_close'] = "</span></li>";
		$config['last_tag_open'] = '<li class="page-item"> <span class="page-link b-radius-none"> ';
		$config['last_tag_close'] = "</span></li>";
		$config['display_pages'] = TRUE;
		$config['first_link'] = '« Awal';
		$config['last_link'] = 'Akhir »';
		$config['next_link'] = 'Selanjutnya >';
		$config['prev_link'] = '< Sebelumnya';
		$this->pagination->initialize($config);
	///	return $this->pagination->create_links(); //andiek
		//pagination end
	}
	public function agenda() {
        $data = [
			'agenda' => $this->db->where('deleted_at IS NULL',null)->order_by('start','desc')->from('tb_event')->get()->result()
		];

		$view = [
            'title' => "Agenda",
            'content' => 'front/agenda/index',
            'js' => 'front/agenda/js',
            'css' => 'front/css'
        ];

        $this->template->display_front($view, $data);
	}

	public function detail_agenda($id) {
        $data = [
			'data' => $this->db->from('tb_event')->where('id_event',decode_id($id))->get()->row(),
			'agenda' =>$this->db->from('tb_event')->where('deleted_at IS NULL',null)->order_by('id_event','desc')->limit(5)->get()->result()
		];

		$view = [
            'title' => "Detail Agenda",
            'content' => 'front/agenda/detail',
            'js' => 'front/agenda/js',
            'css' => 'front/css'
        ];

        $this->template->display_front($view, $data);
	}
	public function penggunaan() {
        $data = [
		];

		$view = [
            'title' => "Agenda",
            'content' => 'front/penggunaan',
            'js' => 'front/js',
            'css' => 'front/css'
        ];

        $this->template->display_front($view, $data);
	}
	public function kontak() {
        $data = [
		];

		$view = [
            'title' => "Agenda",
            'content' => 'front/kontak',
            'js' => 'front/js',
            'css' => 'front/css'
        ];

        $this->template->display_front($view, $data);
	}

	public function lembaga($id=null) {
		if (@$id)
		{
			$idd=substr($id,32);
			$data = [
				'detail' => $this->db->where('id_lembaga',$idd)->get('tb_lembaga')->row_array()
			];

			$view = [
	            'title' => "Data Detail Lembaga HAM",
	            'content' => 'front/lembaga_detail',
	            'js' => 'front/js',
	            'css' => 'front/css'
	        ];

	        $this->template->display_front($view, $data);
		}
		else
		{
	        $data = [
			];

			$view = [
	            'title' => "Data Lembaga HAM",
	            'content' => 'front/sebaran',
	            'js' => 'front/sebaran_js',
	            'css' => 'front/css'
	        ];

	        $this->template->display_front($view, $data);
	    }
	}

	public function angkaham($id=null) {
		if (@$id)
		{
			$idd=substr($id,32);
			$data = [
				'detail' => $this->db->where('id_lembaga',$idd)->get('tb_angka_ham')->row_array()
			];

			$view = [
	            'title' => "Data Angka HAM",
	            'content' => 'front/angkaham_detail',
	            'js' => 'front/js',
	            'css' => 'front/css'
	        ];

	        $this->template->display_front($view, $data);
		}
		else
		{
	        $data = [
			];

			$view = [
	            'title' => "Data Angka HAM",
	            'content' => 'front/angkaham',
	            'js' => 'front/angkaham_js',
	            'css' => 'front/css'
	        ];

	        $this->template->display_front($view, $data);
	    }
	}

	public function get_json() {
		$output=array();
		// $data['provinsi'] = $this->db->select('prop_lembaga, count(*) as jml')->where('deleted_at is null')->group_by('prop_lembaga')->get('tb_lembaga')->result_array();
		$provinsi = $this->db->select('prop_lembaga, count(*) as jml')->where('deleted_at is null')->group_by('prop_lembaga')->get('tb_lembaga')->result_array();
		$data['propinsi'] = array_column($provinsi, 'jml', 'prop_lembaga');

		$data['kota'] = array();
		foreach ($provinsi as $val) {
			$lembaga = $this->db->select('1 as awal, nama_lembaga, id_lembaga as akhir')->where('prop_lembaga', $val['prop_lembaga'])->where('deleted_at is null')->get('tb_lembaga')->result_array();
			foreach ($lembaga as $lbg) {
				$data['kota'][$val['prop_lembaga']][] = array_values($lbg);
			}
		}
	   $listprop=array(
            "11"=>"Aceh",
			"12"=>"Sumatera Utara",
			"13"=>"Sumatera Barat",
			"14"=>"Riau",
			"15"=>"Jambi",
			"21"=>"Sumatera Selatan",
			"22"=>"Bengkulu",
			"23"=>"Lampung",
			"24"=>"Kepulauan Bangka Belitung",
			"25"=>"Kepulauan Riau",
			"31"=>"DKI Jakarta",
			"32"=>"Jawa Barat",
			"33"=>"Jawa Tengah",
			"34"=>"DI Yogyakarta",
			"35"=>"Jawa Timur",
			"36"=>"Banten",
			"41"=>"Kalimantan Barat",
			"42"=>"Kalimantan Tengah",
			"43"=>"Kalimantan Selatan",
			"44"=>"Kalimantan Timur",
			"45"=>"Kalimantan Utara",
			"51"=>"Sulawesi Utara",
			"52"=>"Sulawesi Tengah",
			"53"=>"Sulawesi Selatan",
			"54"=>"Sulawesi Tenggara",
			"55"=>"Gorontalo",
			"56"=>"Sulawesi Barat",
			"61"=>"Bali",
			"62"=>"Nusa Tenggara Barat",
			"63"=>"Nusa Tenggara Timur",
			"71"=>"Maluku",
			"72"=>"Maluku Utara",
			"73"=>"Papua",
			"74"=>"Papua Barat",
			"91"=>"Luar Negeri",
			"92"=>"Hongkong",
			"101"=>"Arab Saudi",
			"102"=>"Belanda",
			"103"=>"Finlandia",
			"104"=>"Japan",
			"105"=>"Malaysia",
			"106"=>"Mesir",
			"107"=>"Myanmar",
			"108"=>"Rusia",
			"109"=>"Serbia",
			"110"=>"Singapura",
			"111"=>"Syria",
			"112"=>"Taiwan",
			"113"=>"Thailand",
			"114"=>"Brunei Darussalam",
			"115"=>"Cina\r\n",
			"116"=>"Filipina\r\n");
        $data['master']['propinsi']=$listprop;
		$output['data']=$data;
        echo json_encode($output,true);
	}
    
	public function infografis($id=null) {

		$max_per_page = 10;   //jumlah data maksimal per halaman berapa , kalau 5 ya brarti nanti jumlah page nya menyesuaikan jumlah data / 5
		if ($this->uri->segment(1)=='home')
			$base_url = 'infografis'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini
		else
			$base_url = 'home/infografis'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini

		$huruf = @$this->input->post('huruf', true)?$this->input->post('huruf', true):$this->session->userdata('hurufglosari');
		$this->session->set_userdata('hurufglosari', $huruf);
		$key = $this->session->userdata('keyglosari');

		if ($this->uri->segment(1)!='home') {
			$this->session->unset_userdata('hurufglosari');
			$this->session->unset_userdata('keyglosari');
		}


		//GET TAMPIL PAGINATION
		if (isset($_GET['per_page'])) {
			$per_page = (int)$this->input->get('per_page');
			$this->db->limit($max_per_page, ($per_page - 1) * $max_per_page);
		} else {
			$per_page = 1;
			$this->db->limit($max_per_page);
		}


		if ($key!='') {
			$this->db->where('judul like "%'.$key.'%"');
		}
	
		if ($huruf!='' && $huruf!='Semua') {
			$this->db->where('substr(judul,1,1)', $huruf);
		}
        $this->db->where('deleted_at IS NULL',null);
		$this->db->order_by('judul','asc');
        
		$get_paging = $this->db->get('tb_infografis');

		//GET ALL JUMLAH DOKUMEN
		if ($key!='') {
			$this->db->where('judul like "%'.$key.'%"');
		}
		if ($huruf!='' && $huruf!='Semua') {
			$this->db->where('substr(judul,1,1)', $huruf);
		}
		$total_data = $this->db->count_all_results('tb_infografis');
 
		$data = [
			'id' => $id,
			'list_infografis' => $get_paging->result_array(),
			'jum' => $get_paging->num_rows(),
			'huruf' => $huruf,
			'key' => $key,
			// 'cari_kata' => $cari_kata,
			'all_huruf' => array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'),
			// 'key' => (@$this->input->post('key') ? $this->input->post('key') : ''),
			'pagging' => $this->pagging_data_dokumen($total_data, $max_per_page, $per_page, $base_url, TRUE)
        ];

		$view = [
            'title' => "Beranda",
            'content' => 'front/infografis',
            'js' => 'front/infografis_js',
            'css' => 'front/infografis_css'
        ];

        $this->template->display_front($view, $data);
	}
    
	public function auditham($id=null) {

		$max_per_page = 10;   //jumlah data maksimal per halaman berapa , kalau 5 ya brarti nanti jumlah page nya menyesuaikan jumlah data / 5
		if ($this->uri->segment(1)=='home')
			$base_url = 'auditham'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini
		else
			$base_url = 'home/auditham'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini

		$huruf = @$this->input->post('huruf', true)?$this->input->post('huruf', true):$this->session->userdata('hurufglosari');
		$this->session->set_userdata('hurufglosari', $huruf);
		$key = $this->session->userdata('keyglosari');

		if ($this->uri->segment(1)!='home') {
			$this->session->unset_userdata('hurufglosari');
			$this->session->unset_userdata('keyglosari');
		}


		//GET TAMPIL PAGINATION
		if (isset($_GET['per_page'])) {
			$per_page = (int)$this->input->get('per_page');
			$this->db->limit($max_per_page, ($per_page - 1) * $max_per_page);
		} else {
			$per_page = 1;
			$this->db->limit($max_per_page);
		}


		if ($key!='') {
			$this->db->where('judul like "%'.$key.'%"');
		}
	
		if ($huruf!='' && $huruf!='Semua') {
			$this->db->where('substr(judul,1,1)', $huruf);
		}
        $this->db->where('deleted_at IS NULL',null);
		$this->db->order_by('judul','asc');
        
		$get_paging = $this->db->get('tb_auditham');

		//GET ALL JUMLAH DOKUMEN
		if ($key!='') {
			$this->db->where('judul like "%'.$key.'%"');
		}
		if ($huruf!='' && $huruf!='Semua') {
			$this->db->where('substr(judul,1,1)', $huruf);
		}
		$total_data = $this->db->count_all_results('tb_auditham');
 
		$data = [
			'id' => $id,
			'list_auditham' => $get_paging->result_array(),
			'jum' => $get_paging->num_rows(),
			'huruf' => $huruf,
			'key' => $key,
			// 'cari_kata' => $cari_kata,
			'all_huruf' => array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'),
			// 'key' => (@$this->input->post('key') ? $this->input->post('key') : ''),
			'pagging' => $this->pagging_data_dokumen($total_data, $max_per_page, $per_page, $base_url, TRUE)
        ];

		$view = [
            'title' => "Beranda",
            'content' => 'front/auditham',
            'js' => 'front/auditham_js',
            'css' => 'front/auditham_css'
        ];

        $this->template->display_front($view, $data);
	}
    
	public function anggaran($id=null) {

		$max_per_page = 10;   //jumlah data maksimal per halaman berapa , kalau 5 ya brarti nanti jumlah page nya menyesuaikan jumlah data / 5
		if ($this->uri->segment(1)=='home')
			$base_url = 'anggaran'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini
		else
			$base_url = 'home/anggaran'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini

		$huruf = @$this->input->post('huruf', true)?$this->input->post('huruf', true):$this->session->userdata('hurufglosari');
		$this->session->set_userdata('hurufglosari', $huruf);
		$key = $this->session->userdata('keyglosari');

		if ($this->uri->segment(1)!='home') {
			$this->session->unset_userdata('hurufglosari');
			$this->session->unset_userdata('keyglosari');
		}


		//GET TAMPIL PAGINATION
		if (isset($_GET['per_page'])) {
			$per_page = (int)$this->input->get('per_page');
			$this->db->limit($max_per_page, ($per_page - 1) * $max_per_page);
		} else {
			$per_page = 1;
			$this->db->limit($max_per_page);
		}


		if ($key!='') {
			$this->db->where('judul like "%'.$key.'%"');
		}
	
		if ($huruf!='' && $huruf!='Semua') {
			$this->db->where('substr(judul,1,1)', $huruf);
		}
        $this->db->where('deleted_at IS NULL',null);
		$this->db->order_by('judul','asc');
        
		$get_paging = $this->db->get('tb_anggaran');

		//GET ALL JUMLAH DOKUMEN
		if ($key!='') {
			$this->db->where('judul like "%'.$key.'%"');
		}
		if ($huruf!='' && $huruf!='Semua') {
			$this->db->where('substr(judul,1,1)', $huruf);
		}
		$total_data = $this->db->count_all_results('tb_anggaran');

		$data = [
			'id' => $id,
			'list_anggaran' => $get_paging->result_array(),
			'jum' => $get_paging->num_rows(),
			'huruf' => $huruf,
			'key' => $key,
			// 'cari_kata' => $cari_kata,
			'all_huruf' => array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'),
			// 'key' => (@$this->input->post('key') ? $this->input->post('key') : ''),
			'pagging' => $this->pagging_data_dokumen($total_data, $max_per_page, $per_page, $base_url, TRUE)
        ];

		$view = [
            'title' => "Beranda",
            'content' => 'front/anggaran',
            'js' => 'front/anggaran_js',
            'css' => 'front/anggaran_css'
        ];

        $this->template->display_front($view, $data);
	}
    
	public function indikator($id=null) {
		if (@$id)
		{
			$idd=substr($id,32);
			$data = [
				'detail' => $this->db->where('id_lembaga',$idd)->get('tb_indikator')->row_array()
			];

			$view = [
	            'title' => "Data Indikator HAM",
	            'content' => 'front/indikator_detail',
	            'js' => 'front/js',
	            'css' => 'front/css'
	        ];

	        $this->template->display_front($view, $data);
		}
		else
		{
	        $data = [
			];

			$view = [
	            'title' => "Data Indikator HAM",
	            'content' => 'front/indikator',
	            'js' => 'front/indikator_js',
	            'css' => 'front/css'
	        ];

	        $this->template->display_front($view, $data);
	    }
	}
    
}
