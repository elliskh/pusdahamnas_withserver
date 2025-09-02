<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MX_Controller
{

	function showStackTraceWithTime()
	{
		$backtrace = debug_backtrace();
		$startTime = microtime(true);

		foreach ($backtrace as $trace) {
			$currentTime = microtime(true);
			$timeSpent = $currentTime - $startTime;
			$startTime = $currentTime;

			if (isset($trace['file']) && isset($trace['line']) && isset($trace['function'])) {
				echo "File: {$trace['file']}<br />";
				echo "Line: {$trace['line']}<br />";
				echo "Function: {$trace['function']}<br />";
				echo "Time Spent: {$timeSpent} seconds<br /><br />";
			}
		}
	}

	public function __construct()
	{
		parent::__construct();
		// $this->load->library('pagination');
	}

	public function index()
	{
		$max_per_page = 5;
		$xhr = TRUE; // if we decide to use XHR ajax	

		// Saving new data
		if ($xhr) {
			header('Content-type: text/html; charset=utf-8');
		}

		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		$countdokumen = $this->db->from('v_tb_dokumen')->count_all_results();
		$countsnp = $this->db->from('tb_snp')->count_all_results();
		$countglossarium = $this->db->from('tb_glossari')->count_all_results();
		$countlembaga = $this->db->from('tb_lembaga')->count_all_results();
		$countpegiatham = $this->db->from('tb_ahli_ham')->count_all_results();
		$countmitra = $this->db->query('SELECT * FROM link_terkait where is_active=2')->num_rows();
		$get_paging = $this->db->select('v_tb_dokumen.*, COUNT(tb_dokumen_pengunduh.id_dokumen) as jumlah_unduhan')
			->from('v_tb_dokumen')
			->join('tb_dokumen_pengunduh', 'tb_dokumen_pengunduh.id_dokumen = v_tb_dokumen.id', 'left')
			->group_by('v_tb_dokumen.id')
			->order_by('jumlah_unduhan', 'desc')
			->limit(4)
			->get();

		$get_paging3 = $this->db->select('*')
			->from('v_tb_dokumen')
			->order_by('created_at', 'desc')
			->limit(4)
			->get();

		$get_paging2 = $this->db->get('tb_dokumen', 8);

		//GET TAMPIL PAGINATION
		if (isset($_GET['per_page'])) {
			$per_page = (int)$this->input->get('per_page');
			$this->db->limit($max_per_page, ($per_page - 1) * $max_per_page);
		} else {
			$per_page = 1;
			$this->db->limit($max_per_page);
		}

		//searching data 
		$key_search = $this->input->post('key_search', true);
		$key_data   = $this->input->post('key_data', true);
		$this->session->unset_userdata('key_search');
		$this->session->unset_userdata('key_data');
		$get_paging_src = '';
		$get_paging_src_array = '';
		$get_paging_src_rows = '';


		//GET ALL JUMLAH DOKUMEN
		$base_url   = 'home';
		$total_data = '';
		$pagg_data  = '';
		if ($key_search != '' && $key_data != '') {
			$this->db->where('judul like "%' . $key_search . '%" OR deskripsi like "%' . $key_search . '%"');
			$total_data = $this->db->count_all_results('v_tb_glossari');
			$pagg_data  = $this->pagging_data_dokumen($total_data, $max_per_page, $base_url, $per_page, TRUE);
		}

		$get_paging_infografis = $this->db->get('tb_infografis');
		//end searching

		$data = [
			'total_dokumen' => $countdokumen,
			'total_snp' => $countsnp,
			'total_glosarium' => $countglossarium,
			'total_lembaga' => $countlembaga,
			'agenda' => $this->db->where('deleted_at IS NULL', null)->order_by('start', 'desc')->get('tb_event', 15)->result(),
			'total_pegiatham' => $countpegiatham,
			'total_mitra' => $countmitra,
			'list_infografis' => $get_paging_infografis->result_array(),
			'list_dokumen' => $get_paging->result_array(),
			'list_dokumen_terbaru' => $get_paging3->result_array(),
			'list_dokumen2' => $get_paging2->result_array(),
			'list_infografiss' => $get_paging->result_array(),
			//key_search
			'key_search' => $key_search,
			'key_data'   => $key_data,
			//glossari                    
			'list_glossari' => $get_paging_src_array, //$get_paging_src->result_array(),
			'list_rasetnis' => '',
			'list_dokumen_src'  => '',
			'list_dokumen2_src' => '',
			'list_agenda_src'   => '',
			'jum' => $get_paging_src_rows, //$get_paging_src->num_rows(),
			'pagging_src' => $pagg_data, //$this->pagging_data_dokumen($total_data, $max_per_page, $per_page, TRUE)
			//list Infografis


		];

		$view = [
			'title' => "Beranda",
			'content' => 'front/index',
		];
		// $this->showStackTraceWithTime();
		$this->template->display_front($view, $data);
		// redirect(base_url('home/data'));

	}

	public function home_glossari_cari()
	{
		$max_per_page = 5;   //jumlah data maksimal per halaman berapa , kalau 5 ya brarti nanti jumlah page nya menyesuaikan jumlah data / 5
		if ($this->uri->segment(1) == 'home')
			$base_url = 'home'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini
		else
			$base_url = 'home'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini

		$key      = $this->session->userdata('key');
		$key_data = $this->session->userdata('key_data');
		$key      = $this->security->xss_clean(post('key'));
		$key_data = $this->security->xss_clean(post('key_data'));
		$this->session->set_userdata('key', $key);
		$this->session->set_userdata('key_data', $key_data);

		if ($this->uri->segment(1) != 'home') {
			$this->session->unset_userdata('keyglosarium');
		}


		//GET TAMPIL PAGINATION
		if (isset($_GET['per_page'])) {
			$per_page = (int)$this->input->get('per_page');
			$this->db->limit($max_per_page, ($per_page - 1) * $max_per_page);
		} else {
			$per_page = 1;
			$this->db->limit($max_per_page);
		}


		if ($key != '') {
			//$this->db->where('judul like "%'.$key.'%"');
			$this->db->where('judul like "%' . $key . '%" OR deskripsi like "%' . $key . '%"');
		}

		$this->db->where('deleted_at IS NULL', null);
		$this->db->order_by('judul', 'asc');

		$get_paging = $this->db->get('v_tb_glossari');

		//GET ALL JUMLAH DOKUMEN
		if ($key != '') {
			///$this->db->where('judul like "%'.$key.'%"');
			$this->db->where('judul like "%' . $key . '%" OR deskripsi like "%' . $key . '%"');
		}

		$total_data = $this->db->count_all_results('v_tb_glossari');

		$data = [
			'list_glossari' => $get_paging->result_array(),
			'jum' => $get_paging->num_rows(),
			'key' => $key,
			'key_data' => $key_data,
			//'cari_kata' => $cari_kata,
			///'all_huruf' => array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'),
			'key' => (@$this->input->post('key') ? $this->input->post('key') : ''),
			'key_data' => (@$this->input->post('key_data') ? $this->input->post('key_data') : ''),
			'pagging' => $this->pagging_data_dokumen($total_data, $max_per_page, $per_page, $base_url, TRUE)
		];

		/*$view = [
            'title' => "Beranda",
            'content' => 'front/glossari',
            'js' => 'front/glossari_js',
            'css' => 'front/glossari_css'
        ]; 
        $this->template->display_front($view, $data);  */
		$this->load->view('front/home_glos_hasil_cari', $data); //andiek 
	}

	public function home_snp_cari()
	{
		$max_per_page = 5;   //jumlah data maksimal per halaman berapa , kalau 5 ya brarti nanti jumlah page nya menyesuaikan jumlah data / 5
		if ($this->uri->segment(1) == 'home')
			$base_url = 'home'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini
		else
			$base_url = 'home'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini

		$key      = $this->session->userdata('key');
		$key_data = $this->session->userdata('key_data');
		$key      = $this->security->xss_clean(post('key'));
		$key_data = $this->security->xss_clean(post('key_data'));
		$this->session->set_userdata('key', $key);
		$this->session->set_userdata('key_data', $key_data);

		if ($this->uri->segment(1) != 'home') {
			$this->session->unset_userdata('keysnp');
		}



		//GET TAMPIL PAGINATION
		if (isset($_GET['per_page'])) {
			$per_page = (int)$this->input->get('per_page');
			$this->db->limit($max_per_page, ($per_page - 1) * $max_per_page);
		} else {
			$per_page = 1;
			$this->db->limit($max_per_page);
		}


		//get data snp all
		if ($key != '') {
			$this->db->where('(bab like "%' . $key . '%" OR deskripsi like "%' . $key . '%")');
			//$this->db->where('(deskripsi like "%'.$key_snp.'%")');
			$this->db->where("is_active = '1'");
		} else {
			$this->db->where("bab !='' AND is_active = '1'");
		}

		$this->db->order_by('bab', 'asc');
		$this->db->group_by('bab');
		$get_paging = $this->db->get('v_tb_rasetnis');

		//GET ALL JUMLAH DOKUMEN
		if ($key != '') {
			$this->db->where('(bab like "%' . $key . '%" OR deskripsi like "%' . $key . '%")');
			///$this->db->where('(deskripsi like "%'.$key_snp.'%")'); 
			$this->db->where("is_active = '1'");
			$this->db->group_by('bab');
		} else {
			$this->db->where("bab !=''");
			$this->db->where("is_active = '1'");
			$this->db->group_by('bab');
		}
		$total_data = $this->db->count_all_results('v_tb_rasetnis');

		$data = [
			'list_rasetnis' => $get_paging->result_array(),
			'jum' => $get_paging->num_rows(),
			'key' => $key,
			'key_data' => $key_data,
			'key' => (@$this->input->post('key') ? $this->input->post('key') : ''),
			'key_data' => (@$this->input->post('key_data') ? $this->input->post('key_data') : ''),
			'pagging' => $this->pagging_data_dokumen($total_data, $max_per_page, $per_page, $base_url, TRUE)
		];

		$this->load->view('front/home_snp_hasil_cari', $data); //andiek 
	}

	public function home_dokumen_cari()
	{
		$max_per_page = 5;   //jumlah data maksimal per halaman berapa , kalau 5 ya brarti nanti jumlah page nya menyesuaikan jumlah data / 5
		if ($this->uri->segment(2) == 'data')
			$base_url = 'data'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini
		else
			$base_url = 'home/dokumen'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini
		//var_dump($this->uri->segment(1));
		$id_hak = @$this->input->post('id_hak', true) ? $this->input->post('id_hak', true) : $this->session->userdata('id_hak');
		$id_subyek = @$this->input->post('id_subyek', true) ? $this->input->post('id_subyek', true) : $this->session->userdata('id_subyek');
		$id_lembaga = @$this->input->post('id_lembaga', true) ? $this->input->post('id_lembaga', true) : $this->session->userdata('id_lembaga');
		$tahun     = @$this->input->post('tahun', true) ? $this->input->post('tahun', true) : $this->session->userdata('tahun');

		$key      = $this->session->userdata('key');
		$key_data = $this->session->userdata('key_data');
		$key      = $this->security->xss_clean(post('key'));
		$key_data = $this->security->xss_clean(post('key_data'));
		$this->session->set_userdata('key', $key);
		$this->session->set_userdata('key_data', $key_data);

		//GET TAMPIL PAGINATION
		if (isset($_GET['per_page'])) {
			$per_page = (int)$this->input->get('per_page');
			$this->db->limit($max_per_page, ($per_page - 1) * $max_per_page);
		} else {
			$per_page = 1;
			$this->db->limit($max_per_page);
		}

		if ($key != '') {
			///$this->db->where('nama_dokumen like "%'.$key.'%"');
			$this->db->where('nama_dokumen like "%' . $key . '%" OR deskripsi like "%' . $key . '%"');
		}
		if ($id_hak != '') {
			$this->db->where_in('id_topik_hak', $id_hak);
		}
		if ($id_subyek != '') {
			$this->db->where_in('id_topik_subyek', $id_subyek);
		}
		if ($id_lembaga != '') {
			$this->db->where_in('id_lembaga', $id_lembaga);
		}
		if ($tahun != '') {
			$this->db->where_in('tahun', $tahun);
		}

		$get_paging = $this->db->get('v_tb_dokumen');
		$get_paging2 = $this->db->get('tb_dokumen');

		//GET ALL JUMLAH DOKUMEN
		if ($key != '') {
			///$this->db->where('nama_dokumen like "%'.$key.'%"');
			$this->db->where('nama_dokumen like "%' . $key . '%" OR deskripsi like "%' . $key . '%"');
		}
		if ($id_hak != '') {
			$this->db->where_in('id_topik_hak', $id_hak);
		}
		if ($id_subyek != '') {
			$this->db->where_in('id_topik_subyek', $id_subyek);
		}
		if ($id_lembaga != '') {
			$this->db->where_in('id_lembaga', $id_lembaga);
		}
		if ($tahun != '') {
			$this->db->where_in('tahun', $tahun);
		}

		$total_data = $this->db->count_all_results('v_tb_dokumen');

		$data = [
			'list_dokumen_src' => $get_paging->result_array(),
			'list_dokumen2_src' => $get_paging->result_array(),
			///'agenda' => $this->db->where('deleted_at IS NULL',null)->order_by('start','desc')->get('tb_event', 15)->result(),
			'jum' => $get_paging->num_rows(),
			'id_hak' => $id_hak,
			'id_subyek' => $id_subyek,
			'id_lembaga' => $id_lembaga,
			'tahun' => $tahun,
			//'huruf' => $huruf,
			'key' => $key,
			'key_data' => $key_data,
			'key' => (@$this->input->post('key') ? $this->input->post('key') : ''),
			'key_data' => (@$this->input->post('key_data') ? $this->input->post('key_data') : ''),
			///	'all_huruf' => array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'),
			'pagging' => $this->pagging_data_dokumen($total_data, $max_per_page, $per_page, $base_url, TRUE),
			'ref_hak_dokumen_src' => $this->db->select('a.*, count(b.id) as jml')->where('a.is_active', '1')->join('tb_dokumen b', 'a.id_hak=b.id_topik_hak and b.deleted_at is null', 'left')->group_by('a.id_hak')->get('ref_hak_dokumen a')->result_array(),
			'ref_lembaga_src' => $this->db->select('a.*, count(b.id) as jml')->where('a.is_active', '1')->join('tb_dokumen b', 'a.id=b.id_lembaga and b.deleted_at is null', 'left')->group_by('a.id')->get('ref_lembaga a')->result_array(),
			'ref_subyek_dokumen_src' => $this->db->select('a.*, count(b.id) as jml')->where('a.is_active', '1')->join('tb_dokumen b', 'a.id_subyek=b.id_topik_subyek and b.deleted_at is null', 'left')->group_by('a.id_subyek')->get('ref_subyek_dokumen a')->result_array(),
		];

		/*$view = [
					'title' => "Beranda",
					'content' => 'front/dokumen',
					'js' => 'front/dokumen_js',
					'css' => 'front/dokumen_css'
			];

			$this->template->display_front($view, $data);*/
		$this->load->view('front/home_dok_hasil_cari', $data); //andiek
	}

	public function home_agenda_cari()
	{
		$max_per_page = 5;   //jumlah data maksimal per halaman berapa , kalau 5 ya brarti nanti jumlah page nya menyesuaikan jumlah data / 5
		if ($this->uri->segment(1) == 'home')
			$base_url = 'home'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini
		else
			$base_url = 'home'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini

		$key      = $this->session->userdata('key');
		$key_data = $this->session->userdata('key_data');
		$key      = $this->security->xss_clean(post('key'));
		$key_data = $this->security->xss_clean(post('key_data'));
		$this->session->set_userdata('key', $key);
		$this->session->set_userdata('key_data', $key_data);

		if ($this->uri->segment(1) != 'home') {
			$this->session->unset_userdata('keyagenda');
		}


		//GET TAMPIL PAGINATION
		if (isset($_GET['per_page'])) {
			$per_page = (int)$this->input->get('per_page');
			$this->db->limit($max_per_page, ($per_page - 1) * $max_per_page);
		} else {
			$per_page = 1;
			$this->db->limit($max_per_page);
		}


		if ($key != '') {
			//$this->db->where('judul like "%'.$key.'%"');
			$this->db->where('judul like "%' . $key . '%" OR deskripsi like "%' . $key . '%"');
		}

		$this->db->where('deleted_at IS NULL', null);
		$this->db->order_by('judul', 'asc');

		$get_paging = $this->db->get('v_tb_event');

		//GET ALL JUMLAH DOKUMEN
		if ($key != '') {
			///$this->db->where('judul like "%'.$key.'%"');
			$this->db->where('judul like "%' . $key . '%" OR deskripsi like "%' . $key . '%"');
		}
		$this->db->get();
		$total_data = $this->db->count_all_results('v_tb_event');

		$data = [
			'list_agenda_src' => $get_paging->result_array(),
			'jum' => $get_paging->num_rows(),
			'key' => $key,
			'key_data' => $key_data,
			//'cari_kata' => $cari_kata,
			///'all_huruf' => array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'),
			'key' => (@$this->input->post('key') ? $this->input->post('key') : ''),
			///'key_data' => (@$this->input->post('key_data') ? $this->input->post('key_data') : ''),
			'pagging' => $this->pagging_data_dokumen($total_data, $max_per_page, $per_page, $base_url, TRUE)
		];

		$this->load->view('front/home_agenda_hasil_cari', $data); //andiek 
	}

	public function dokumen($id = null)
	{
		//$this->session->set_userdata('key', ''); 
		$max_per_page = 8;
		$key1 = '';
		$key2 = '';
		// if ($this->uri->segment(1) == 'home') {
		// 	$base_url = 'dokumen';
		// } else {
		// 	$base_url = 'home/dokumen';
		// }

		$base_url = '';
		if ($this->uri->segment(3) == 'key') { //pencarian dari home
			///$key = urldecode($this->uri->segment(4));//$this->input->post('key', true);
			$key = str_replace("%20", " ", $this->uri->segment(4));
			$key1 = explode(' ', $key, 0);
			$key2 = explode(' ', $key, 1);
			$this->session->set_userdata('key', $key);
		} else {
			$id_hak = $this->input->post('id_hak', true);
			$id_subyek = $this->input->post('id_subyek', true);
			$id_lembaga = $this->input->post('id_lembaga', true);
			$huruf = $this->input->post('huruf', true);
			$key = $this->input->post('key', true);
		}
		// if ($this->uri->segment(2) == 'dokumen') {
		// 	$this->session->unset_userdata('id_hak');
		// 	$this->session->unset_userdata('id_subyek');
		// 	$this->session->unset_userdata('id_lembaga');
		// 	$this->session->unset_userdata('tahun');
		// 	$this->session->set_userdata('key', $key);
		// }

		// $id_hak = @$this->input->post('id_hak', true)?'':$this->session->userdata('id_hak');
		// $id_subyek = @$this->input->post('id_subyek', true)?'':$this->session->userdata('id_subyek');
		// $id_lembaga = @$this->input->post('id_lembaga', true)?'':$this->session->userdata('id_lembaga');
		$id_hak     = @$this->input->post('id_hak', true) ? $this->input->post('id_hak', true) : $this->session->userdata('id_hak');
		$id_subyek  = @$this->input->post('id_subyek', true) ? $this->input->post('id_subyek', true) : $this->session->userdata('id_subyek');
		$id_lembaga = @$this->input->post('id_lembaga', true) ? $this->input->post('id_lembaga', true) : $this->session->userdata('id_lembaga');
		$tahun      = @$this->input->post('tahun', true) ? $this->input->post('tahun', true) : $this->session->userdata('tahun');
		$huruf      = @$this->input->post('huruf', true) ? $this->input->post('huruf', true) : $this->session->userdata('huruf');
		$this->session->set_userdata('huruf', $huruf);
		$key        = $this->session->userdata('key');

		if ($this->uri->segment(1) != 'home') {
			$this->session->unset_userdata('id_hak');
			$this->session->unset_userdata('id_subyek');
			$this->session->unset_userdata('id_lembaga');
			$this->session->unset_userdata('tahun');
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

		$this->db->select('a.*, GROUP_CONCAT(DISTINCT c.id_topik_hak) as topik_hak_ids, GROUP_CONCAT(DISTINCT d.id_topik_subyek) as topik_subyek_ids, GROUP_CONCAT(DISTINCT e.id_lembaga) as lembaga_ids');
		// $this->db->from("v_tb_dokumen a");
		$this->db->join('tb_dokumen_topik_hak c', 'a.id = c.id_dokumen', 'left');
		$this->db->join('tb_dokumen_topik_subyek d', 'a.id = d.id_dokumen', 'left');
		$this->db->join('tb_dokumen_lembaga e', 'a.id = e.id_dokumen', 'left');
		$this->db->join('tb_dokumen_sumber f', 'a.id = f.id_dokumen', 'left');
		$this->db->group_by('a.id');


		if ($key != '') {
			///$this->db->where('nama_dokumen like "%'.$key.'%"');
			$this->db->where('nama_dokumen like "%' . $key . '%" OR deskripsi like "%' . $key . '%"'); // OR deskripsi like "%'.$key1.'%" OR deskripsi like "%'.$key2.'%"');
		}
		if ($id_hak != '') {
			$this->db->where_in('c.id_topik_hak', $id_hak);
		}
		if ($id_subyek != '') {
			$this->db->where_in('d.id_topik_subyek', $id_subyek);
		}
		if ($id_lembaga != '') {
			$this->db->where_in('e.id_lembaga', $id_lembaga);
		}
		if ($tahun != '') {
			$this->db->where_in('tahun', $tahun);
		}
		if ($huruf != '' && $huruf != 'Semua') {
			$this->db->where_in('substr(nama_dokumen,1,1)', $huruf);
		}
		$this->db->order_by('created_at', 'desc');
		$raw_query = $this->db->get_compiled_select('v_tb_dokumen a', FALSE);

		// Execute the query
		$get_paging = $this->db->get();
		$get_paging2 = $this->db->get('tb_dokumen a');

		//GET ALL JUMLAH DOKUMEN

		$this->db->select('a.*, GROUP_CONCAT(DISTINCT c.id_topik_hak) as topik_hak_ids, GROUP_CONCAT(DISTINCT d.id_topik_subyek) as topik_subyek_ids, GROUP_CONCAT(DISTINCT e.id_lembaga) as lembaga_ids');
		// $this->db->from("v_tb_dokumen a");
		$this->db->join('tb_dokumen_topik_hak c', 'a.id = c.id_dokumen', 'left');
		$this->db->join('tb_dokumen_topik_subyek d', 'a.id = d.id_dokumen', 'left');
		$this->db->join('tb_dokumen_lembaga e', 'a.id = e.id_dokumen', 'left');
		$this->db->join('tb_dokumen_sumber f', 'a.id = f.id_dokumen', 'left');
		$this->db->group_by('a.id');

		if ($key != '') {
			///$this->db->where('nama_dokumen like "%'.$key.'%"');
			$this->db->where('nama_dokumen like "%' . $key . '%" OR deskripsi like "%' . $key . '%"'); // OR deskripsi like "%'.$key1.'%" OR deskripsi like "%'.$key2.'%"');
			//judul like '%norma%' OR deskripsi like '%norma%' OR judul like '%ras%' OR deskripsi like '%ras%'
			//$this->db->where("(deskripsi LIKE '%".$key1."%' OR deskripsi LIKE '%".$key2."%')", NULL, FALSE);
		}
		if ($id_hak != '') {
			$this->db->where_in('c.id_topik_hak', $id_hak);
		}
		if ($id_subyek != '') {
			$this->db->where_in('d.id_topik_subyek', $id_subyek);
		}
		if ($id_lembaga != '') {
			$this->db->where_in('e.id_lembaga', $id_lembaga);
		}
		if ($tahun != '') {
			$this->db->where_in('tahun', $tahun);
		}
		if ($huruf != '' && $huruf != 'Semua') {
			$this->db->where('substr(nama_dokumen,1,1)', $huruf);
		}
		$total_data = $this->db->count_all_results('v_tb_dokumen a');

		// add feature
		$data_mitra = $this->db->select('a.id, singkatan_lembaga as nama, count(*) as jumlah')->join('tb_dokumen b', 'a.id=b.id_lembaga')->group_by('a.id')->get('ref_lembaga a')->result_array();
		$data_hak = $this->db->select('a.id_hak, nama_hak as nama, count(*) as jumlah')->join('tb_dokumen b', 'a.id_hak=b.id_topik_hak')->group_by('a.id_hak')->order_by('jumlah', 'desc')->limit(5)->get('ref_hak_dokumen a')->result_array();
		$data_subyek = $this->db->select('a.id_subyek, nama_subyek as nama, count(*) as jumlah')->join('tb_dokumen b', 'a.id_subyek=b.id_topik_subyek')->group_by('a.id_subyek')->order_by('jumlah', 'desc')->get('ref_subyek_dokumen a')->result_array();
		$jenis_dok = $this->db->select('a.id_jenis, nama_jenis ')->join('tb_dokumen b', 'a.id_jenis=b.id_jenis_dokumen')->order_by('id', 'desc')->get('ref_jenis_dokumen a')->result_array();
		$total_unduh = $this->db->count_all_results('tb_dokumen_pengunduh a');
		$unduh_terbanyak = $this->db->select('nama_dokumen, count(*) as jumlah')->join('tb_dokumen_pengunduh b', 'a.id=b.id_dokumen')->group_by('a.id')->order_by('jumlah', 'desc')->limit(3)->get('tb_dokumen a')->result_array();
		// 

		$data = [
			'id' => $id,
			'list_dokumen' => $get_paging->result_array(),
			'list_dokumen2' => $get_paging2->result_array(),
			'jum' => $get_paging->num_rows(),
			'agenda' => $this->db->where('deleted_at IS NULL', null)->order_by('start', 'desc')->get('tb_event', 15)->result(),
			'glossary' => $this->db->order_by('judul', 'asc')->get('tb_glossari', 3)->result(),
			'id_hak' => $id_hak,
			'id_subyek' => $id_subyek,
			'id_lembaga' => $id_lembaga,
			'huruf' => $huruf,
			'key' => $key,
			// 'cari_kata' => $cari_kata,
			///		'all_huruf' => array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'),
			// 'key' => (@$this->input->post('key') ? $this->input->post('key') : ''),
			'pagging' => $this->pagging_data_dokumen($total_data, $max_per_page, $per_page, $base_url, TRUE),
			'ref_hak_dokumen' => $this->db->select('a.*, count(DISTINCT b.id) as jml')
				->where('a.is_active', '1')
				->join('tb_dokumen_topik_hak c', 'a.id_hak = c.id_topik_hak', 'left')
				->join('tb_dokumen b', 'c.id_dokumen = b.id and b.deleted_at is null', 'left')
				->order_by('a.nama_hak', 'asc')
				->group_by('a.id_hak')
				->get('ref_hak_dokumen a')
				->result_array(),
			'ref_lembaga' => $this->db->select('a.*, count(b.id) as jml')
				->where('a.is_active', '1')
				->join('tb_dokumen_lembaga c', 'a.id = c.id_lembaga', 'left')
				->join('tb_dokumen b', 'c.id_dokumen = b.id and b.deleted_at is null', 'left')
				->group_by('a.id')
				->get('ref_lembaga a')
				->result_array(),
			'ref_subyek_dokumen' => $this->db->select('a.*, count(DISTINCT b.id) as jml')
				->where('a.is_active', '1')
				->join('tb_dokumen_topik_subyek c', 'a.id_subyek = c.id_topik_subyek', 'left')
				->join('tb_dokumen b', 'c.id_dokumen = b.id and b.deleted_at is null', 'left')
				->group_by('a.id_subyek')
				->order_by('a.nama_subyek', 'asc')
				->get('ref_subyek_dokumen a')
				->result_array(),
			// 'list_dokumen' => $this->db->get("v_tb_dokumen a")->result(),            
			'tahun' => $this->db->distinct()->select('tahun')->where('deleted_at IS NULL', null)->order_by('tahun', 'desc')->get('tb_dokumen')->result_array(),
			'tahun_selected' => $tahun,
			'data_mitra' => json_encode($data_mitra),
			'data_hak' => json_encode($data_hak),
			'data_subyek' => json_encode($data_subyek),
			'jenis_dok' => json_encode($jenis_dok),
			'total_unduh' => $total_unduh,
			'unduh_terbanyak' => $unduh_terbanyak,
		];

		$view = [
			'title' => "Dokumen",
			'content' => 'front/dokumen',
			'js' => 'front/dokumen_js',
			'css' => 'front/dokumen_css',
		];

		$this->template->display_front($view, $data);
	}

	public function dokumen_cari()
	{
		$this->session->set_userdata('key', '');
		$this->session->set_userdata('id_hak', '');
		$this->session->set_userdata('id_subyek', '');
		$this->session->set_userdata('id_lembahga', '');
		$this->session->set_userdata('tahun', '');

		$max_per_page = 8;   //jumlah data maksimal per halaman berapa , kalau 5 ya brarti nanti jumlah page nya menyesuaikan jumlah data / 5		


		//var_dump($this->uri->segment(1));
		$session_key = @$this->input->post('key', true) ? $this->input->post('key', true) : $this->session->userdata('key');
		$id_hak = @$this->input->post('id_hak', true) ? $this->input->post('id_hak', true) : $this->session->userdata('id_hak');
		$id_subyek = @$this->input->post('id_subyek', true) ? $this->input->post('id_subyek', true) : $this->session->userdata('id_subyek');
		$id_lembaga = @$this->input->post('id_lembaga', true) ? $this->input->post('id_lembaga', true) : $this->session->userdata('id_lembaga');
		$tahun = @$this->input->post('tahun', true) ? $this->input->post('tahun', true) : $this->session->userdata('tahun');
		$huruf = $this->session->userdata('huruf');
		if ($this->session->userdata('key') == '') {
			$key = strtolower($this->input->post('key', true));
		}
		if ($this->session->username == 'adminadhyamitra' && $this->input->post('key')) {
			$ss_key      = $this->security->xss_clean(post('key'));
			$key_ss = $this->session->set_userdata('ss_key', $ss_key);
			// echo "<script>alert('$key_ss')</script>";
		}
		//var_dump($this->input->post('key', true));

		//Set Session
		$key = $this->input->post('key', true);
		$id_hak = $this->input->post('id_hak', true);
		$id_subyek = $this->input->post('id_subyek', true);
		$id_lembaga = $this->input->post('id_lembaga', true);
		$tahun = $this->input->post('tahun', true);

		if ($this->uri->segment(2) == 'data') {
			$base_url = 'data'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini
		} 
		else {
			$base_url = '/home/dokumen/key/' . $key; // kalau tidak ada ? get ataupun yang lain maka base url nya ini
		}

		// print_r($id_hak);

		//Menyimpan Session Yang Login
		$this->session->set_userdata('key', $key);
		$this->session->set_userdata('id_hak', $id_hak);
		$this->session->set_userdata('id_subyek', $id_subyek);
		$this->session->set_userdata('id_lembaga', $id_lembaga);
		$this->session->set_userdata('tahun', $tahun);

		//GET TAMPIL PAGINATION
		if (isset($_GET['per_page'])) {
			$per_page = (int)$this->input->get('per_page');
			$this->db->limit($max_per_page, ($per_page - 1) * $max_per_page);
		} else {
			$per_page = 1;
			$this->db->limit($max_per_page);
		}

		$this->db->select('a.*, GROUP_CONCAT(DISTINCT c.id_topik_hak) as topik_hak_ids, GROUP_CONCAT(DISTINCT d.id_topik_subyek) as topik_subyek_ids, GROUP_CONCAT(DISTINCT e.id_lembaga) as lembaga_ids');
		// $this->db->from("v_tb_dokumen a");
		$this->db->join('tb_dokumen_topik_hak c', 'a.id = c.id_dokumen', 'left');
		$this->db->join('tb_dokumen_topik_subyek d', 'a.id = d.id_dokumen', 'left');
		$this->db->join('tb_dokumen_lembaga e', 'a.id = e.id_dokumen', 'left');
		$this->db->join('tb_dokumen_sumber f', 'a.id = f.id_dokumen', 'left');
		$this->db->group_by('a.id');


		if ($key != '') {
			///$this->db->where('nama_dokumen like "%'.$key.'%"');
			$this->db->where('nama_dokumen like "%' . $key . '%" OR deskripsi like "%' . $key . '%"');
		}
		if ($id_hak != '') {
			$this->db->where_in('c.id_topik_hak', $id_hak);
		}
		if ($id_subyek != '') {
			$this->db->where_in('d.id_topik_subyek', $id_subyek);
		}
		if ($id_lembaga != '') {
			$this->db->where_in('e.id_lembaga', $id_lembaga);
		}

		if ($tahun != '') {

			$this->db->where_in('tahun', $tahun);
		}

		if ($huruf != '' && $huruf != 'Semua') {

			$this->db->where('substr(nama_dokumen,1,1)', $huruf);
		}

       // Get the compiled SQL query
	   $raw_query = $this->db->get_compiled_select('v_tb_dokumen a', FALSE);

	   // Execute the query
	   $get_paging = $this->db->get();

   
		// $get_paging2 = $this->db->get('tb_dokumen a');


		//GET ALL JUMLAH DOKUMEN
		$this->db->select('a.*, GROUP_CONCAT(DISTINCT c.id_topik_hak) as topik_hak_ids, GROUP_CONCAT(DISTINCT d.id_topik_subyek) as topik_subyek_ids, GROUP_CONCAT(DISTINCT e.id_lembaga) as lembaga_ids');
		// $this->db->from("v_tb_dokumen a");
		$this->db->join('tb_dokumen_topik_hak c', 'a.id = c.id_dokumen', 'left');
		$this->db->join('tb_dokumen_topik_subyek d', 'a.id = d.id_dokumen', 'left');
		$this->db->join('tb_dokumen_lembaga e', 'a.id = e.id_dokumen', 'left');
		$this->db->join('tb_dokumen_sumber f', 'a.id = f.id_dokumen', 'left');
		$this->db->group_by('a.id');


		if ($key != '') {
			///$this->db->where('nama_dokumen like "%'.$key.'%"');
			$this->db->where('nama_dokumen like "%' . $key . '%" OR deskripsi like "%' . $key . '%"');
		}
		if ($id_hak != '') {
			$this->db->where_in('c.id_topik_hak', $id_hak);
		}
		if ($id_subyek != '') {
			$this->db->where_in('d.id_topik_subyek', $id_subyek);
		}
		if ($id_lembaga != '') {
			$this->db->where_in('e.id_lembaga', $id_lembaga);
		}

		if ($tahun != '') {

			$this->db->where_in('tahun', $tahun);
		}

		if ($huruf != '' && $huruf != 'Semua') {

			$this->db->where('substr(nama_dokumen,1,1)', $huruf);
		}
		$this->db->order_by('created_at', 'desc');
		$total_data = $this->db->count_all_results('v_tb_dokumen a');

		$data = [
			'list_dokumen' => $get_paging->result_array(),
			'list_dokumen2' => $get_paging->result_array(),
			'agenda' => $this->db->where('deleted_at IS NULL', null)->order_by('start', 'desc')->get('tb_event', 15)->result(),
			'jum' => $get_paging->num_rows(),
			'id_hak' => $id_hak,
			'id_subyek' => $id_subyek,
			'id_lembaga' => $id_lembaga,
			'huruf' => $huruf,
			'key' => $key,
			///	'all_huruf' => array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'),
			'pagging' => $this->pagging_data_dokumen($total_data, $max_per_page, $per_page, $base_url, TRUE),
		'ref_hak_dokumen' => $this->db->select('a.*, count(DISTINCT b.id) as jml')
				->where('a.is_active', '1')
				->join('tb_dokumen_topik_hak c', 'a.id_hak = c.id_topik_hak', 'left')
				->join('tb_dokumen b', 'c.id_dokumen = b.id and b.deleted_at is null', 'left')
				->order_by('a.nama_hak', 'asc')
				->group_by('a.id_hak')
				->get('ref_hak_dokumen a')
				->result_array(),
			'ref_lembaga' => $this->db->select('a.*, count(b.id) as jml')
				->where('a.is_active', '1')
				->join('tb_dokumen_lembaga c', 'a.id = c.id_lembaga', 'left')
				->join('tb_dokumen b', 'c.id_dokumen = b.id and b.deleted_at is null', 'left')
				->group_by('a.id')
				->get('ref_lembaga a')
				->result_array(),
			'ref_subyek_dokumen' => $this->db->select('a.*, count(DISTINCT b.id) as jml')
				->where('a.is_active', '1')
				->join('tb_dokumen_topik_subyek c', 'a.id_subyek = c.id_topik_subyek', 'left')
				->join('tb_dokumen b', 'c.id_dokumen = b.id and b.deleted_at is null', 'left')
				->group_by('a.id_subyek')
				->order_by('a.nama_subyek', 'asc')
				->get('ref_subyek_dokumen a')
				->result_array(),
			'tahun' => $this->db->distinct()->select('tahun')->where('deleted_at IS NULL', null)->order_by('tahun', 'desc')->get('tb_dokumen')->result_array(),
		];

		/*$view = [
					'title' => "Beranda",
					'content' => 'front/dokumen',
					'js' => 'front/dokumen_js',
					'css' => 'front/dokumen_css'
			];

			$this->template->display_front($view, $data);*/
		$this->load->view('front/dokumen_hasil_cari', $data); //andiek
	}

	public function dokumen_detail($id = null)
	{
		if ($id == null)
			redirect(base_url());

		$data = [
			'id' => $id,
			'detail' => $this->db->where('id', decode_id($id))->get('v_tb_dokumen')->row_array(),
			'detail2' => $this->db->where('id', decode_id($id))->get('tb_dokumen')->row_array(),
		];
		$data['terkait'] = $this->db->where('id_jenis_dokumen', $data['detail']['id_jenis_dokumen'])->order_by('rand()')->limit(8)->get('v_tb_dokumen')->result_array();

		$view = [
			'title' => "Dataset Pusdahamnas",
			'content' => 'front/dokumen_detail',
			'js' => 'front/dokumen_detail_js',
		];

		$this->template->display_front($view, $data);
	}

	public function about()
	{
		$data = [
			'data' => $this->db->where('is_active', '1')->get('link_terkait a')->result_array(),
		];

		$view = [
			'title' => "Dataset Pusdahamnas",
			'content' => 'front/about',
		];

		$this->template->display_front($view, $data);
	}

	public function pegiat_ham($idd = null)
	{
		//pagintaion
		$key = $this->session->set_userdata('key', '');
		$max_per_page = 8;
		if ($this->uri->segment(1) === 'pegiat_ham')
			$base_url = 'pegiat_ham';
		else
			$base_url = 'pegiat_ham';

		/*if (@$idd)
		{
			redirect(base_url('home/pegiat_ham'));
		}
		else if (@$this->input->get())
		{
			redirect(base_url('home/pegiat_ham'));
		}
		else
		{*/
		if ($key != '') {
			///$this->db->where('nama_dokumen like "%'.$key.'%"');
			$this->db->where('nama like "%' . $key . '%" OR instansi like "%' . $key . '%"');
		}

		$total_data = $this->db->where('is_active', 1)->count_all_results('tb_ahli_ham'); //$this->db->count_all_results('tb_ahli_ham');            

		if (isset($_GET['per_page'])) {
			$per_page = (int)$this->input->get('per_page');
			$this->db->limit($max_per_page, ($per_page - 1) * $max_per_page);
		} else {
			$per_page = 1;
			$this->db->limit($max_per_page);
		}
		$this->db->where('is_active', 1);
		$this->db->order_by('created_at', 'desc');
		$get_paging = $this->db->where('is_active', 1)->get('tb_ahli_ham'); //$this->db->get('tb_ahli_ham');

		$data = [
			'list_pegiat_ham' => $get_paging->result_array(),
			'pagging' => $this->pagging_data_dokumen($total_data, $max_per_page, $per_page, $base_url, TRUE),
			'data' => $this->db->where('deleted_at is null')->join('ref_hak_dokumen b', 'a.id_topik_hak=b.id_hak', 'left')->join('ref_subyek_dokumen c', ' a.id_topik_hak = c.id_subyek ', 'left')->order_by('a.nama', 'asc')->get('tb_ahli_ham a')->result_array(),
			'ref_hak_dokumen' => $this->db->where('is_active', '1')->order_by('nama_hak', 'asc')->get('ref_hak_dokumen')->result_array(),
			'ref_subyek_dokumen' => $this->db->where('is_active', '1')->order_by('nama_subyek', 'asc')->get('ref_subyek_dokumen')->result_array(),
			'data_komham' => $this->db->where('is_active', 1)->order_by('id', 'desc')->get('tb_komunitasham', 15)->result(),
			'key' => $key,
			// 'key' => (@$this->input->post('key') ? $this->input->post('key') : ''),
		];

		$view = [
			'title' => "Dataset Pegiat Ham",
			'js' => "front/pegiat_ham_js",
			'content' => 'front/pegiat_ham',
		];

		$this->template->display_front($view, $data);
		//Tampil Paginasi
		//GET TAMPIL PAGINATION
		//}
	}

	public function detail_pegiat_ham()
	{
		$id = $this->input->post('id', TRUE);
		if (@$id) {
			$dt = $this->db->query("SELECT a.*, b.nama_hak, c.nama_subyek FROM tb_ahli_ham a LEFT JOIN ref_hak_dokumen b ON a.id_topik_hak=b.id_hak LEFT JOIN ref_subyek_dokumen c ON a.id_topik_subyek=c.id_subyek WHERE a.id='" . $id . "'")->row_array();

			if ($dt['foto'] == '') {
				$gambar = "https://dataham.komnasham.go.id/assets/noimage.png";
			} else {
				$gambar = base_url('uploads/fotoahli/' . $dt['foto'] . '');
			}
			echo "<center><h4>Detail Ahli HAM</h4></center>
				  <hr>
				  <table class='table table-bordered table-striped'>
				  	<tr>
				  		<td colspan='3'><center><img src='" . $gambar . "' class='img-responsive' style='width:25%'></center></td>
				  	</tr>
				  	<tr>
				  		<td style='width:23%'>Nama Ahli</td>
				  		<td style='width:2%'>:</td>
				  		<td>" . $dt['nama'] . "</td>
				  	</tr>
				  	<tr>
				  		<td>Instansi</td>
				  		<td>:</td>
				  		<td>" . $dt['instansi'] . "</td>
				  	</tr>
				  	<tr>
				  		<td>Topik Hak</td>
				  		<td>:</td>
				  		<td>" . $dt['nama_hak'] . "</td>
				  	</tr>
				  	<tr>
				  		<td>Email</td>
				  		<td>:</td>
				  		<td>" . $dt['email'] . "</td>
				  	</tr>
				  </table>";
		} else {
			redirect(base_url('home/pegiat_ham'));
		}
		echo json_encode($dt);
	}

	public function pegiat_ham_cari()
	{

		if ($this->input->post('id_hak', true) != '')
			$this->db->where('id_topik_hak', $this->input->post('id_hak', true));

		if ($this->input->post('id_subyek', true) != "")
			$this->db->where('id_topik_subyek', $this->input->post('id_subyek', true));

		if ($this->input->post('key', true) != "")
			$this->db->like('a.nama', $this->input->post('key', true));

		$data_ahli_ham = $this->db->where('deleted_at is null')->join('ref_hak_dokumen b', 'a.id_topik_hak=b.id_hak', 'left')->join('ref_subyek_dokumen c', 'a.id_topik_subyek=c.id_subyek', 'left')->order_by('a.nama', 'asc')->get('tb_ahli_ham a')->result_array();
		$data = [
			'data' => $data_ahli_ham,
		];

		$this->load->view('front/pegiat_ham_hasil', $data);
	}
	public function pegiat_ham_detil()
	{
		$id = $this->input->post('id');
		//$data []= 'xxxxxx';
		if (!empty($id)) {
			$data = $this->db->where('id', $id)->join('ref_hak_dokumen b', 'a.id_topik_hak=b.id_hak', 'left')->join('ref_subyek_dokumen c', 'a.id_topik_subyek=c.id_subyek', 'left')->order_by('a.nama', 'asc')->get('tb_ahli_ham a')->result();
			//$data = $this->db->where('id',$id)->get('tb_ahli_ham a')->result();

		}
		//print_r($data);
		echo json_encode($data);
	}

	public function set_data()
	{
		$this->session->set_userdata($this->input->post('key', true), $this->input->post('val', true));
		echo 'Berhasil';
	}

	public function media_analisis($idd = null)
	{
		if (@$idd) {
			redirect(base_url('home/media_analisis'));
		} else if (@$this->input->get()) {
			redirect(base_url('home/media_analisis'));
		} else {
			$data = [
				'data' => $this->db->where('deleted_at is null')->join('ref_mediaanalisis_hak_dokumen b', 'a.id_topik_hak=b.id_hak', 'left')->join('ref_mediaanalisis_subyek_dokumen c', 'a.id_topik_subyek=c.id_subyek', 'left')->order_by('a.nama', 'asc')->get('tb_media_analisis a')->result_array(),
				'ref_mediaanalisis_hak_dokumen' => $this->db->where('is_active', '1')->order_by('nama_hak', 'asc')->get('ref_mediaanalisis_hak_dokumen')->result_array(),
				'ref_mediaanalisis_subyek_dokumen' => $this->db->where('is_active', '1')->order_by('nama_subyek', 'asc')->get('ref_mediaanalisis_subyek_dokumen')->result_array(),
			];

			$view = [
				'title' => "Dataset Media analisis",
				'js' => "front/media_analisis_js",
				'content' => 'front/media_analisis',
			];

			$this->template->display_front($view, $data);
		}
	}

	public function snp($idd = null)
	{
		if (@$idd) {
			redirect(base_url('home/snp'));
		} else if (@$this->input->get()) {
			redirect(base_url('home/sno'));
		} else {
			$data = [
				'data' => $this->db->where('deleted_at is null')->join('ref_mediaanalisis_hak_dokumen b', 'a.id_topik_hak=b.id_hak', 'left')->join('ref_mediaanalisis_subyek_dokumen c', 'a.id_topik_subyek=c.id_subyek', 'left')->order_by('a.nama', 'asc')->get('tb_media_analisis a')->result_array(),
				'ref_mediaanalisis_hak_dokumen' => $this->db->where('is_active', '1')->order_by('nama_hak', 'asc')->get('ref_mediaanalisis_hak_dokumen')->result_array(),
				'ref_mediaanalisis_subyek_dokumen' => $this->db->where('is_active', '1')->order_by('nama_subyek', 'asc')->get('ref_mediaanalisis_subyek_dokumen')->result_array(),
			];

			$view = [
				'title' => "Standar Norma Dan Pengaturan",
				// 'js' => "front/snp_js",
				'content' => 'front/snp',
			];

			$this->template->display_front($view, $data);
		}
	}

	public function media_audio($idd = null)
	{
		if (@$idd) {
			redirect(base_url('home/media_audio'));
		} else if (@$this->input->get()) {
			redirect(base_url('home/media_audio'));
		} else {
			$data = [
				'data' => $this->db->where('deleted_at is null')->join('ref_mediaaudio_hak_dokumen b', 'a.id_topik_hak=b.id_hak', 'left')->join('ref_mediaaudio_subyek_dokumen c', 'a.id_topik_subyek=c.id_subyek', 'left')->order_by('a.nama', 'asc')->get('tb_media_audio a')->result_array(),
				'ref_mediaaudio_hak_dokumen' => $this->db->where('is_active', '1')->order_by('nama_hak', 'asc')->get('ref_mediaaudio_hak_dokumen')->result_array(),
				'ref_mediaaudio_subyek_dokumen' => $this->db->where('is_active', '1')->order_by('nama_subyek', 'asc')->get('ref_mediaaudio_subyek_dokumen')->result_array(),
			];

			$view = [
				'title' => "Dataset Media Audio",
				'js' => "front/media_audio_js",
				'content' => 'front/media_audio',
			];

			$this->template->display_front($view, $data);
		}
	}

	public function detail_media_audio()
	{
		$id = $this->input->post('id', TRUE);
		if (@$id) {
			$dt = $this->db->query("SELECT a.*, b.nama_hak, c.nama_subyek FROM tb_media_audio a LEFT JOIN ref_media_audio_hak_dokumen b ON a.id_topik_hak=b.id_hak LEFT JOIN ref_media_audio_subyek_dokumen c ON a.id_topik_subyek=c.id_subyek WHERE a.id='" . $id . "'")->row_array();

			if ($dt['foto'] == '') {
				$gambar = "https://pusdahamnas.komnasham.go.id/assets/noimage.png";
			} else {
				$gambar = base_url('uploads/fotoahli/' . $dt['foto'] . '');
			}
			echo "<center><h4>Detail Media Audio</h4></center>
				  <hr>
				  <table class='table table-bordered table-striped'>
				  	<tr>
				  		<td colspan='3'><center><img src='" . $gambar . "' class='img-responsive' style='width:25%'></center></td>
				  	</tr>
				  	<tr>
				  		<td style='width:23%'>Nama Media</td>
				  		<td style='width:2%'>:</td>
				  		<td>" . $dt['nama'] . "</td>
				  	</tr>
				  	<tr>
				  		<td>Instansi</td>
				  		<td>:</td>
				  		<td>" . $dt['instansi'] . "</td>
				  	</tr>
				  	<tr>
				  		<td>Topik Hak</td>
				  		<td>:</td>
				  		<td>" . $dt['nama_hak'] . "</td>
				  	</tr>
				  	<tr>
				  		<td>Email</td>
				  		<td>:</td>
				  		<td>" . $dt['email'] . "</td>
				  	</tr>
				  </table>";
		} else {
			redirect(base_url('home/media_audio'));
		}
	}

	public function media_audio_cari()
	{
		if ($this->input->post('id_hak', true) != '')
			$this->db->where('id_topik_hak', $this->input->post('id_hak', true));

		if ($this->input->post('id_subyek', true) != "")
			$this->db->where('id_topik_subyek', $this->input->post('id_subyek', true));

		if ($this->input->post('key', true) != "")
			$this->db->like('a.nama', $this->input->post('key', true));

		$data_mediaaudio = $this->db->where('deleted_at is null')->join('ref_mediaaudio_hak_dokumen b', 'a.id_topik_hak=b.id_hak', 'left')->join('ref_mediaaudio_subyek_dokumen c', 'a.id_topik_subyek=c.id_subyek', 'left')->order_by('a.nama', 'asc')->get('tb_media_audio a')->result_array();
		$data = [
			'data' => $data_mediaaudio,
		];

		$this->load->view('front/media_audio_hasil', $data);
	}

	public function data($id = null)
	{
		$max_per_page = 5;   //jumlah data maksimal per halaman berapa , kalau 5 ya brarti nanti jumlah page nya menyesuaikan jumlah data / 5
		if ($this->uri->segment(1) == 'home')
			$base_url = 'data'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini
		else
			$base_url = 'home/data'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini

		/*$id_hak = $this->input->post('id_hak', true);
		$id_subyek = $this->input->post('id_subyek', true);
		$id_lembaga = $this->input->post('id_lembaga', true);
		$huruf = $this->input->post('huruf', true);
		$key = $this->input->post('key', true);*/

		$id_hak = @$this->input->post('id_hak', true) ? $this->input->post('id_hak', true) : $this->session->userdata('id_hak');
		$id_subyek = @$this->input->post('id_subyek', true) ? $this->input->post('id_subyek', true) : $this->session->userdata('id_subyek');
		$id_lembaga = @$this->input->post('id_lembaga', true) ? $this->input->post('id_lembaga', true) : $this->session->userdata('id_lembaga');
		$huruf = @$this->input->post('huruf', true) ? $this->input->post('huruf', true) : $this->session->userdata('huruf');
		$this->session->set_userdata('huruf', $huruf);
		$key = $this->session->userdata('key');

		if ($this->uri->segment(1) != 'home') {
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


		if ($key != '') {
			$this->db->where('nama_dokumen like "%' . $key . '%"');
		}
		if ($id_hak != '') {
			$this->db->where_in('id_topik_hak', $id_hak);
		}
		if ($id_subyek != '') {
			$this->db->where_in('id_topik_subyek', $id_subyek);
		}
		if ($id_lembaga != '') {
			$this->db->where_in('id_lembaga', $id_lembaga);
		}
		if ($huruf != '' && $huruf != 'Semua') {
			$this->db->where('substr(nama_dokumen,1,1)', $huruf);
		}
		$this->db->order_by('created_at', 'desc');
		$get_paging = $this->db->get('v_tb_dokumen');

		//GET ALL JUMLAH DOKUMEN
		if ($key != '') {
			$this->db->where('nama_dokumen like "%' . $key . '%"');
		}
		if ($id_hak != '') {
			$this->db->where_in('id_topik_hak', $id_hak);
		}
		if ($id_subyek != '') {
			$this->db->where_in('id_topik_subyek', $id_subyek);
		}
		if ($id_lembaga != '') {
			$this->db->where_in('id_lembaga', $id_lembaga);
		}
		if ($huruf != '' && $huruf != 'Semua') {
			$this->db->where('substr(nama_dokumen,1,1)', $huruf);
		}
		$total_data = $this->db->count_all_results('v_tb_dokumen');

		$data = [
			'id' => $id,
			'list_dokumen' => $get_paging->result_array(),
			'jum' => $get_paging->num_rows(),
			'agenda' => $this->db->where('deleted_at IS NULL', null)->order_by('start', 'desc')->get('tb_event', 3)->result(),
			'glossary' => $this->db->order_by('judul', 'asc')->get('tb_glossari', 3)->result(),
			'id_hak' => $id_hak,
			'id_subyek' => $id_subyek,
			'id_lembaga' => $id_lembaga,
			'huruf' => $huruf,
			'key' => $key,
			// 'cari_kata' => $cari_kata,
			'all_huruf' => array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'),
			// 'key' => (@$this->input->post('key') ? $this->input->post('key') : ''),
			'pagging' => $this->pagging_data_dokumen($total_data, $max_per_page, $per_page, $base_url, TRUE),
			'ref_hak_dokumen' => $this->db->select('a.*, count(b.id) as jml')->where('a.is_active', '1')->join('tb_dokumen b', 'a.id_hak=b.id_topik_hak and b.deleted_at is null', 'left')->order_by('a.nama_hak', 'asc')->group_by('a.id_hak')->get('ref_hak_dokumen a')->result_array(),
			'ref_lembaga' => $this->db->select('a.*, count(b.id) as jml')->where('a.is_active', '1')->join('tb_dokumen b', 'a.id=b.id_lembaga and b.deleted_at is null', 'left')->group_by('a.id')->get('ref_lembaga a')->result_array(),
			'ref_subyek_dokumen' => $this->db->select('a.*, count(b.id) as jml')->where('a.is_active', '1')->join('tb_dokumen b', 'a.id_subyek=b.id_topik_subyek and b.deleted_at is null', 'left')->group_by('a.id_subyek')->order_by('a.nama_subyek', 'asc')->get('ref_subyek_dokumen a')->result_array(),
			// 'list_dokumen' => $this->db->get("v_tb_dokumen a")->result(),
		];

		$view = [
			'title' => "Beranda",
			'content' => 'front/data',
			'js' => 'front/data_js',
			'css' => 'front/data_css'
		];

		$this->template->display_front($view, $data);
	}

	public function visualisasi_data($id = null)
	{
		$max_per_page = 5;   //jumlah data maksimal per halaman berapa , kalau 5 ya brarti nanti jumlah page nya menyesuaikan jumlah data / 5
		if ($this->uri->segment(1) == 'home')
			$base_url = 'data'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini
		else
			$base_url = 'home/data'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini

		/*$id_hak = $this->input->post('id_hak', true);
		$id_subyek = $this->input->post('id_subyek', true);
		$id_lembaga = $this->input->post('id_lembaga', true);
		$huruf = $this->input->post('huruf', true);
		$key = $this->input->post('key', true);*/

		$id_hak = @$this->input->post('id_hak', true) ? $this->input->post('id_hak', true) : $this->session->userdata('id_hak');
		$id_subyek = @$this->input->post('id_subyek', true) ? $this->input->post('id_subyek', true) : $this->session->userdata('id_subyek');
		$id_lembaga = @$this->input->post('id_lembaga', true) ? $this->input->post('id_lembaga', true) : $this->session->userdata('id_lembaga');
		$huruf = @$this->input->post('huruf', true) ? $this->input->post('huruf', true) : $this->session->userdata('huruf');
		$this->session->set_userdata('huruf', $huruf);
		$key = $this->session->userdata('key');

		if ($this->uri->segment(1) != 'home') {
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


		if ($key != '') {
			$this->db->where('nama_dokumen like "%' . $key . '%"');
		}
		if ($id_hak != '') {
			$this->db->where_in('id_topik_hak', $id_hak);
		}
		if ($id_subyek != '') {
			$this->db->where_in('id_topik_subyek', $id_subyek);
		}
		if ($id_lembaga != '') {
			$this->db->where_in('id_lembaga', $id_lembaga);
		}
		if ($huruf != '' && $huruf != 'Semua') {
			$this->db->where('substr(nama_dokumen,1,1)', $huruf);
		}
		$this->db->order_by('created_at', 'desc');
		$get_paging = $this->db->get('v_tb_dokumen');

		//GET ALL JUMLAH DOKUMEN
		if ($key != '') {
			$this->db->where('nama_dokumen like "%' . $key . '%"');
		}
		if ($id_hak != '') {
			$this->db->where_in('id_topik_hak', $id_hak);
		}
		if ($id_subyek != '') {
			$this->db->where_in('id_topik_subyek', $id_subyek);
		}
		if ($id_lembaga != '') {
			$this->db->where_in('id_lembaga', $id_lembaga);
		}
		if ($huruf != '' && $huruf != 'Semua') {
			$this->db->where('substr(nama_dokumen,1,1)', $huruf);
		}
		$total_data = $this->db->count_all_results('v_tb_dokumen');

		$data = [
			'id' => $id,
			'list_dokumen' => $get_paging->result_array(),
			'jum' => $get_paging->num_rows(),
			'agenda' => $this->db->where('deleted_at IS NULL', null)->order_by('start', 'desc')->get('tb_event', 3)->result(),
			'glossary' => $this->db->order_by('judul', 'asc')->get('tb_glossari', 3)->result(),
			'id_hak' => $id_hak,
			'id_subyek' => $id_subyek,
			'id_lembaga' => $id_lembaga,
			'huruf' => $huruf,
			'key' => $key,
			// 'cari_kata' => $cari_kata,
			'all_huruf' => array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'),
			// 'key' => (@$this->input->post('key') ? $this->input->post('key') : ''),
			'pagging' => $this->pagging_data_dokumen($total_data, $max_per_page, $per_page, $base_url, TRUE),
			'ref_hak_dokumen' => $this->db->select('a.*, count(b.id) as jml')->where('a.is_active', '1')->join('tb_dokumen b', 'a.id_hak=b.id_topik_hak and b.deleted_at is null', 'left')->order_by('a.nama_hak', 'asc')->group_by('a.id_hak')->get('ref_hak_dokumen a')->result_array(),
			'ref_lembaga' => $this->db->select('a.*, count(b.id) as jml')->where('a.is_active', '1')->join('tb_dokumen b', 'a.id=b.id_lembaga and b.deleted_at is null', 'left')->group_by('a.id')->get('ref_lembaga a')->result_array(),
			'ref_subyek_dokumen' => $this->db->select('a.*, count(b.id) as jml')->where('a.is_active', '1')->join('tb_dokumen b', 'a.id_subyek=b.id_topik_subyek and b.deleted_at is null', 'left')->group_by('a.id_subyek')->order_by('a.nama_subyek', 'asc')->get('ref_subyek_dokumen a')->result_array(),
			// 'list_dokumen' => $this->db->get("v_tb_dokumen a")->result(),
		];

		$view = [
			'title' => "Beranda",
			'content' => 'front/data',
			'js' => 'front/data_js',
			'css' => 'front/data_css'
		];

		$this->template->display_front($view, $data);
	}

	public function data_cari()
	{
		$max_per_page = 5;
		// if ($this->uri->segment(2)=='data')
		// 	$base_url = 'data'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini
		// else
		// 	$base_url = 'home/data'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini

		// if ($this->uri->segment(3)){
		// 	$base_url = 'home/data_cari/'.$this->uri->segment(3);
		// }
		// else{
		// 	$base_url = 'home/data_cari';
		// }

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

		if ($key != '') {
			///$this->db->where('nama_dokumen like "%'.$key.'%"');
			$this->db->where('nama_dokumen like "%' . $key . '%" OR deskripsi like "%' . $key . '%"');
		}
		if ($id_hak != '') {
			$this->db->where('id_topik_hak', $id_hak);
		}
		if ($id_subyek != '') {
			$this->db->where('id_topik_subyek', $id_subyek);
		}
		if ($id_lembaga != '') {
			$this->db->where('id_lembaga', $id_lembaga);
		}
		if ($huruf != '' && $huruf != 'Semua') {
			$this->db->where('substr(nama_dokumen,1,1)', $huruf);
		}
		$get_paging = $this->db->get('v_tb_dokumen');

		//GET ALL JUMLAH DOKUMEN
		if ($key != '') {
			///$this->db->where('nama_dokumen like "%'.$key.'%"');
			$this->db->where('nama_dokumen like "%' . $key . '%" OR deskripsi like "%' . $key . '%"');
		}
		if ($id_hak != '') {
			$this->db->where('id_topik_hak', $id_hak);
		}
		if ($id_subyek != '') {
			$this->db->where('id_topik_subyek', $id_subyek);
		}
		if ($id_lembaga != '') {
			$this->db->where('id_lembaga', $id_lembaga);
		}
		if ($huruf != '' && $huruf != 'Semua') {
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
			///	'all_huruf' => array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'),
			'pagging' => $this->pagging_data_dokumen($total_data, $max_per_page, $per_page, $base_url, TRUE),
			'ref_hak_dokumen' => $this->db->select('a.*, count(b.id) as jml')->where('a.is_active', '1')->join('tb_dokumen b', 'a.id_hak=b.id_topik_hak and b.deleted_at is null', 'left')->group_by('a.id_hak')->get('ref_hak_dokumen a')->result_array(),
			'ref_lembaga' => $this->db->select('a.*, count(b.id) as jml')->where('a.is_active', '1')->join('tb_dokumen b', 'a.id=b.id_lembaga and b.deleted_at is null', 'left')->group_by('a.id')->get('ref_lembaga a')->result_array(),
			'ref_subyek_dokumen' => $this->db->select('a.*, count(b.id) as jml')->where('a.is_active', '1')->join('tb_dokumen b', 'a.id_subyek=b.id_topik_subyek and b.deleted_at is null', 'left')->group_by('a.id_subyek')->get('ref_subyek_dokumen a')->result_array(),
		];

		$this->load->view('front/hasil_cari', $data);
	}

	public function data_detail($id = null)
	{
		if ($id == null)
			redirect(base_url());

		$data = [
			'id' => $id,
			'detail' => $this->db->where('id', decode_id($id))->get('v_tb_dokumen')->row_array(),
			'detail2' => $this->db->where('id', decode_id($id))->get('tb_dokumen')->row_array(),
		];
		if ($data['detail']) {
			$data['terkait'] = $this->db->where('id_jenis_dokumen', $data['detail']['id_jenis_dokumen'])->order_by('rand()')->limit(8)->get('v_tb_dokumen')->result_array();

			// Fetch related data
			// $data['nama_subyek'] = $this->db->select('nama_subyek')->where('id_subyek', $data['detail']['id_topik_subyek'])->get('ref_subyek_dokumen')->row()->nama_subyek;
			// $data['nama_lembaga'] = $this->db->select('nama')->where('id', $data['detail']['id_lembaga'])->get('ref_lembaga')->row()->nama;
			// $data['nama_sumber'] = $this->db->select('nama_sumber')->where('id', $data['detail']['id_sumber'])->get('tb_dokumen_sumber')->row()->nama_sumber;
		} else {
			$data['terkait'] = '';
		}

		$data['nama_hak'] = $this->db->select('rhd.nama_hak')
			->from('tb_dokumen_topik_hak tdth')
			->join('ref_hak_dokumen rhd', 'tdth.id_topik_hak = rhd.id_hak')
			->where('tdth.id_dokumen', decode_id($id))
			->get()
			->result_array();

		$data['nama_subyek'] = $this->db->select('rhd.nama_subyek')
			->from('tb_dokumen_topik_subyek tdth')
			->join('ref_subyek_dokumen rhd', 'tdth.id_topik_subyek = rhd.id_subyek')
			->where('tdth.id_dokumen', decode_id($id))
			->get()
			->result_array();

		$data['nama_lembaga'] = $this->db->select('rhd.nama_lembaga')
			->from('tb_dokumen_lembaga tdth')
			->join('ref_lembaga rhd', 'tdth.id_lembaga = rhd.id')
			->where('tdth.id_dokumen', decode_id($id))
			->get()
			->result_array();

		$data['nama_sumber'] = $this->db->select('rhd.nama_sumber')
			->from('tb_dokumen_sumber tdth')
			->join('ref_sumber_dokumen rhd', 'tdth.id_sumber = rhd.id')
			->where('tdth.id_dokumen', decode_id($id))
			->get()
			->result_array();

		$view = [
			'title' => "Dataset Pusdahamnas",
			'content' => 'front/data_detail',
			'js' => 'front/data_detail_js',
		];

		$this->template->display_front($view, $data);
	}

	public function visualisasi($id = null)
	{
		$max_per_page = 5;   //jumlah data maksimal per halaman berapa , kalau 5 ya brarti nanti jumlah page nya menyesuaikan jumlah data / 5
		if ($this->uri->segment(1) == 'home')
			$base_url = 'data'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini
		else
			$base_url = 'home/data'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini

		/*$id_hak = $this->input->post('id_hak', true);
		$id_subyek = $this->input->post('id_subyek', true);
		$id_lembaga = $this->input->post('id_lembaga', true);
		$huruf = $this->input->post('huruf', true);
		$key = $this->input->post('key', true);*/

		$id_hak = @$this->input->post('id_hak', true) ? $this->input->post('id_hak', true) : $this->session->userdata('id_hak');
		$id_subyek = @$this->input->post('id_subyek', true) ? $this->input->post('id_subyek', true) : $this->session->userdata('id_subyek');
		$id_lembaga = @$this->input->post('id_lembaga', true) ? $this->input->post('id_lembaga', true) : $this->session->userdata('id_lembaga');
		$huruf = @$this->input->post('huruf', true) ? $this->input->post('huruf', true) : $this->session->userdata('huruf');
		$this->session->set_userdata('huruf', $huruf);
		$key = $this->session->userdata('key');

		if ($this->uri->segment(1) != 'home') {
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


		if ($key != '') {
			///$this->db->where('nama_dokumen like "%'.$key.'%"');
			$this->db->where('nama_dokumen like "%' . $key . '%" OR deskripsi like "%' . $key . '%"');
		}
		if ($id_hak != '') {
			$this->db->where('id_topik_hak', $id_hak);
		}
		if ($id_subyek != '') {
			$this->db->where('id_topik_subyek', $id_subyek);
		}
		if ($id_lembaga != '') {
			$this->db->where('id_lembaga', $id_lembaga);
		}
		if ($huruf != '' && $huruf != 'Semua') {
			$this->db->where('substr(nama_dokumen,1,1)', $huruf);
		}
		$this->db->order_by('created_at', 'desc');
		$get_paging = ''; // andiek
		if ($this->db->get('v_tb_dokumen')) {
			$get_paging = $this->db->get('v_tb_dokumen');
		}

		//GET ALL JUMLAH DOKUMEN
		if ($key != '') {
			///$this->db->where('nama_dokumen like "%'.$key.'%"');
			$this->db->where('nama_dokumen like "%' . $key . '%" OR deskripsi like "%' . $key . '%"');
		}
		if ($id_hak != '') {
			$this->db->where('id_topik_hak', $id_hak);
		}
		if ($id_subyek != '') {
			$this->db->where('id_topik_subyek', $id_subyek);
		}
		if ($id_lembaga != '') {
			$this->db->where('id_lembaga', $id_lembaga);
		}
		if ($huruf != '' && $huruf != 'Semua') {
			$this->db->where('substr(nama_dokumen,1,1)', $huruf);
		}
		$total_data = ''; //andiek
		if ($this->db->get('v_tb_dokumen')) {
			///$total_data = $this->db->count_all_results('v_tb_dokumen');
			$total_data = $this->db->get('v_tb_dokumen');
		}
		/// $data = [];
		if ($get_paging) {
			$data = [
				'id' => $id,
				'list_dokumen' => $get_paging->result_array(),
				'jum' => $get_paging->num_rows(),
				'agenda' => $this->db->where('deleted_at IS NULL', null)->order_by('start', 'desc')->get('tb_event', 3)->result(),
				'glossary' => $this->db->order_by('judul', 'asc')->get('tb_glossari', 3)->result(),
				'id_hak' => $id_hak,
				'id_subyek' => $id_subyek,
				'id_lembaga' => $id_lembaga,
				'huruf' => $huruf,
				'key' => $key,
				// 'cari_kata' => $cari_kata,
				///		'all_huruf' => array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'),
				// 'key' => (@$this->input->post('key') ? $this->input->post('key') : ''),
				///		'pagging' => $this->pagging_data_dokumen($total_data, $max_per_page, $per_page, $base_url, TRUE),
				'ref_hak_dokumen' => $this->db->select('a.*, count(b.id) as jml')->where('a.is_active', '1')->join('tb_dokumen b', 'a.id_hak=b.id_topik_hak and b.deleted_at is null', 'left')->order_by('a.nama_hak', 'asc')->group_by('a.id_hak')->get('ref_hak_dokumen a')->result_array(),
				'ref_lembaga' => $this->db->select('a.*, count(b.id) as jml')->where('a.is_active', '1')->join('tb_dokumen b', 'a.id=b.id_lembaga and b.deleted_at is null', 'left')->group_by('a.id')->get('ref_lembaga a')->result_array(),
				'ref_subyek_dokumen' => $this->db->select('a.*, count(b.id) as jml')->where('a.is_active', '1')->join('tb_dokumen b', 'a.id_subyek=b.id_topik_subyek and b.deleted_at is null', 'left')->group_by('a.id_subyek')->order_by('a.nama_subyek', 'asc')->get('ref_subyek_dokumen a')->result_array(),
				// 'list_dokumen' => $this->db->get("v_tb_dokumen a")->result(),
			];
		} else {
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
				///			'all_huruf' => array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'),
				// 'key' => (@$this->input->post('key') ? $this->input->post('key') : ''),
				'pagging' => '',
				'ref_hak_dokumen' => '',
				'ref_lembaga' => '',
				'ref_subyek_dokumen' => '',
				// 'list_dokumen' => $this->db->get("v_tb_dokumen a")->result(),   
			];
		}


		$view = [
			'title' => "Visualisasi",
			'content' => 'front/visualisasi',
			'js' => 'front/visualisasi_js',
			'css' => 'front/visualisasi_css'
		];

		$this->template->display_front($view, $data);
	}

	public function konflik_agraria($id = null)
	{
		$max_per_page = 5;   //jumlah data maksimal per halaman berapa , kalau 5 ya brarti nanti jumlah page nya menyesuaikan jumlah data / 5
		if ($this->uri->segment(1) == 'home')
			$base_url = 'data'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini
		else
			$base_url = 'home/data'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini

		/*$id_hak = $this->input->post('id_hak', true);
		$id_subyek = $this->input->post('id_subyek', true);
		$id_lembaga = $this->input->post('id_lembaga', true);
		$huruf = $this->input->post('huruf', true);
		$key = $this->input->post('key', true);*/

		$id_hak = @$this->input->post('id_hak', true) ? $this->input->post('id_hak', true) : $this->session->userdata('id_hak');
		$id_subyek = @$this->input->post('id_subyek', true) ? $this->input->post('id_subyek', true) : $this->session->userdata('id_subyek');
		$id_lembaga = @$this->input->post('id_lembaga', true) ? $this->input->post('id_lembaga', true) : $this->session->userdata('id_lembaga');
		$huruf = @$this->input->post('huruf', true) ? $this->input->post('huruf', true) : $this->session->userdata('huruf');
		$this->session->set_userdata('huruf', $huruf);
		$key = $this->session->userdata('key');

		if ($this->uri->segment(1) != 'home') {
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


		if ($key != '') {
			///$this->db->where('nama_dokumen like "%'.$key.'%"');
			$this->db->where('nama_dokumen like "%' . $key . '%" OR deskripsi like "%' . $key . '%"');
		}
		if ($id_hak != '') {
			$this->db->where('id_topik_hak', $id_hak);
		}
		if ($id_subyek != '') {
			$this->db->where('id_topik_subyek', $id_subyek);
		}
		if ($id_lembaga != '') {
			$this->db->where('id_lembaga', $id_lembaga);
		}
		if ($huruf != '' && $huruf != 'Semua') {
			$this->db->where('substr(nama_dokumen,1,1)', $huruf);
		}
		$this->db->order_by('created_at', 'desc');
		$get_paging = ''; // andiek
		if ($this->db->get('v_tb_dokumen')) {
			$get_paging = $this->db->get('v_tb_dokumen');
		}

		//GET ALL JUMLAH DOKUMEN
		if ($key != '') {
			///$this->db->where('nama_dokumen like "%'.$key.'%"');
			$this->db->where('nama_dokumen like "%' . $key . '%" OR deskripsi like "%' . $key . '%"');
		}
		if ($id_hak != '') {
			$this->db->where('id_topik_hak', $id_hak);
		}
		if ($id_subyek != '') {
			$this->db->where('id_topik_subyek', $id_subyek);
		}
		if ($id_lembaga != '') {
			$this->db->where('id_lembaga', $id_lembaga);
		}
		if ($huruf != '' && $huruf != 'Semua') {
			$this->db->where('substr(nama_dokumen,1,1)', $huruf);
		}
		$total_data = ''; //andiek
		if ($this->db->get('v_tb_dokumen')) {
			///$total_data = $this->db->count_all_results('v_tb_dokumen');
			$total_data = $this->db->get('v_tb_dokumen');
		}
		/// $data = [];
		if ($get_paging) {
			$data = [
				'id' => $id,
				'list_dokumen' => $get_paging->result_array(),
				'jum' => $get_paging->num_rows(),
				'agenda' => $this->db->where('deleted_at IS NULL', null)->order_by('start', 'desc')->get('tb_event', 3)->result(),
				'glossary' => $this->db->order_by('judul', 'asc')->get('tb_glossari', 3)->result(),
				'id_hak' => $id_hak,
				'id_subyek' => $id_subyek,
				'id_lembaga' => $id_lembaga,
				'huruf' => $huruf,
				'key' => $key,
				// 'cari_kata' => $cari_kata,
				///		'all_huruf' => array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'),
				// 'key' => (@$this->input->post('key') ? $this->input->post('key') : ''),
				///		'pagging' => $this->pagging_data_dokumen($total_data, $max_per_page, $per_page, $base_url, TRUE),
				'ref_hak_dokumen' => $this->db->select('a.*, count(b.id) as jml')->where('a.is_active', '1')->join('tb_dokumen b', 'a.id_hak=b.id_topik_hak and b.deleted_at is null', 'left')->order_by('a.nama_hak', 'asc')->group_by('a.id_hak')->get('ref_hak_dokumen a')->result_array(),
				'ref_lembaga' => $this->db->select('a.*, count(b.id) as jml')->where('a.is_active', '1')->join('tb_dokumen b', 'a.id=b.id_lembaga and b.deleted_at is null', 'left')->group_by('a.id')->get('ref_lembaga a')->result_array(),
				'ref_subyek_dokumen' => $this->db->select('a.*, count(b.id) as jml')->where('a.is_active', '1')->join('tb_dokumen b', 'a.id_subyek=b.id_topik_subyek and b.deleted_at is null', 'left')->group_by('a.id_subyek')->order_by('a.nama_subyek', 'asc')->get('ref_subyek_dokumen a')->result_array(),
				// 'list_dokumen' => $this->db->get("v_tb_dokumen a")->result(),
			];
		} else {
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
				///			'all_huruf' => array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'),
				// 'key' => (@$this->input->post('key') ? $this->input->post('key') : ''),
				'pagging' => '',
				'ref_hak_dokumen' => '',
				'ref_lembaga' => '',
				'ref_subyek_dokumen' => '',
				// 'list_dokumen' => $this->db->get("v_tb_dokumen a")->result(),   
			];
		}


		$view = [
			'title' => "Konflik Agraria",
			'content' => 'front/konflik_agraria',
			'js' => 'front/konflik_agraria_js',
			'css' => 'front/konflik_agraria_css'
		];

		$this->template->display_front($view, $data);
	}

	public function kelompok_marginal($id = null)
	{
		$max_per_page = 5;   //jumlah data maksimal per halaman berapa , kalau 5 ya brarti nanti jumlah page nya menyesuaikan jumlah data / 5
		if ($this->uri->segment(1) == 'home')
			$base_url = 'data'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini
		else
			$base_url = 'home/data'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini

		/*$id_hak = $this->input->post('id_hak', true);
		$id_subyek = $this->input->post('id_subyek', true);
		$id_lembaga = $this->input->post('id_lembaga', true);
		$huruf = $this->input->post('huruf', true);
		$key = $this->input->post('key', true);*/

		$id_hak = @$this->input->post('id_hak', true) ? $this->input->post('id_hak', true) : $this->session->userdata('id_hak');
		$id_subyek = @$this->input->post('id_subyek', true) ? $this->input->post('id_subyek', true) : $this->session->userdata('id_subyek');
		$id_lembaga = @$this->input->post('id_lembaga', true) ? $this->input->post('id_lembaga', true) : $this->session->userdata('id_lembaga');
		$huruf = @$this->input->post('huruf', true) ? $this->input->post('huruf', true) : $this->session->userdata('huruf');
		$this->session->set_userdata('huruf', $huruf);
		$key = $this->session->userdata('key');

		if ($this->uri->segment(1) != 'home') {
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


		if ($key != '') {
			///$this->db->where('nama_dokumen like "%'.$key.'%"');
			$this->db->where('nama_dokumen like "%' . $key . '%" OR deskripsi like "%' . $key . '%"');
		}
		if ($id_hak != '') {
			$this->db->where('id_topik_hak', $id_hak);
		}
		if ($id_subyek != '') {
			$this->db->where('id_topik_subyek', $id_subyek);
		}
		if ($id_lembaga != '') {
			$this->db->where('id_lembaga', $id_lembaga);
		}
		if ($huruf != '' && $huruf != 'Semua') {
			$this->db->where('substr(nama_dokumen,1,1)', $huruf);
		}
		$this->db->order_by('created_at', 'desc');
		$get_paging = ''; // andiek
		if ($this->db->get('v_tb_dokumen')) {
			$get_paging = $this->db->get('v_tb_dokumen');
		}

		//GET ALL JUMLAH DOKUMEN
		if ($key != '') {
			///$this->db->where('nama_dokumen like "%'.$key.'%"');
			$this->db->where('nama_dokumen like "%' . $key . '%" OR deskripsi like "%' . $key . '%"');
		}
		if ($id_hak != '') {
			$this->db->where('id_topik_hak', $id_hak);
		}
		if ($id_subyek != '') {
			$this->db->where('id_topik_subyek', $id_subyek);
		}
		if ($id_lembaga != '') {
			$this->db->where('id_lembaga', $id_lembaga);
		}
		if ($huruf != '' && $huruf != 'Semua') {
			$this->db->where('substr(nama_dokumen,1,1)', $huruf);
		}
		$total_data = ''; //andiek
		if ($this->db->get('v_tb_dokumen')) {
			///$total_data = $this->db->count_all_results('v_tb_dokumen');
			$total_data = $this->db->get('v_tb_dokumen');
		}
		/// $data = [];
		if ($get_paging) {
			$data = [
				'id' => $id,
				'list_dokumen' => $get_paging->result_array(),
				'jum' => $get_paging->num_rows(),
				'agenda' => $this->db->where('deleted_at IS NULL', null)->order_by('start', 'desc')->get('tb_event', 3)->result(),
				'glossary' => $this->db->order_by('judul', 'asc')->get('tb_glossari', 3)->result(),
				'id_hak' => $id_hak,
				'id_subyek' => $id_subyek,
				'id_lembaga' => $id_lembaga,
				'huruf' => $huruf,
				'key' => $key,
				// 'cari_kata' => $cari_kata,
				///		'all_huruf' => array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'),
				// 'key' => (@$this->input->post('key') ? $this->input->post('key') : ''),
				///		'pagging' => $this->pagging_data_dokumen($total_data, $max_per_page, $per_page, $base_url, TRUE),
				'ref_hak_dokumen' => $this->db->select('a.*, count(b.id) as jml')->where('a.is_active', '1')->join('tb_dokumen b', 'a.id_hak=b.id_topik_hak and b.deleted_at is null', 'left')->order_by('a.nama_hak', 'asc')->group_by('a.id_hak')->get('ref_hak_dokumen a')->result_array(),
				'ref_lembaga' => $this->db->select('a.*, count(b.id) as jml')->where('a.is_active', '1')->join('tb_dokumen b', 'a.id=b.id_lembaga and b.deleted_at is null', 'left')->group_by('a.id')->get('ref_lembaga a')->result_array(),
				'ref_subyek_dokumen' => $this->db->select('a.*, count(b.id) as jml')->where('a.is_active', '1')->join('tb_dokumen b', 'a.id_subyek=b.id_topik_subyek and b.deleted_at is null', 'left')->group_by('a.id_subyek')->order_by('a.nama_subyek', 'asc')->get('ref_subyek_dokumen a')->result_array(),
				// 'list_dokumen' => $this->db->get("v_tb_dokumen a")->result(),
			];
		} else {
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
				///			'all_huruf' => array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'),
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
			'content' => 'front/kelompok_marginal',
			'js' => 'front/kelompok_marginal_js',
			'css' => 'front/kelompok_marginal_css'
		];

		$this->template->display_front($view, $data);
	}

	public function antisipasi_pemilu($id = null)
	{
		$max_per_page = 5;   //jumlah data maksimal per halaman berapa , kalau 5 ya brarti nanti jumlah page nya menyesuaikan jumlah data / 5
		if ($this->uri->segment(1) == 'home')
			$base_url = 'data'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini
		else
			$base_url = 'home/data'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini

		/*$id_hak = $this->input->post('id_hak', true);
		$id_subyek = $this->input->post('id_subyek', true);
		$id_lembaga = $this->input->post('id_lembaga', true);
		$huruf = $this->input->post('huruf', true);
		$key = $this->input->post('key', true);*/

		$id_hak = @$this->input->post('id_hak', true) ? $this->input->post('id_hak', true) : $this->session->userdata('id_hak');
		$id_subyek = @$this->input->post('id_subyek', true) ? $this->input->post('id_subyek', true) : $this->session->userdata('id_subyek');
		$id_lembaga = @$this->input->post('id_lembaga', true) ? $this->input->post('id_lembaga', true) : $this->session->userdata('id_lembaga');
		$huruf = @$this->input->post('huruf', true) ? $this->input->post('huruf', true) : $this->session->userdata('huruf');
		$this->session->set_userdata('huruf', $huruf);
		$key = $this->session->userdata('key');

		if ($this->uri->segment(1) != 'home') {
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


		if ($key != '') {
			///$this->db->where('nama_dokumen like "%'.$key.'%"');
			$this->db->where('nama_dokumen like "%' . $key . '%" OR deskripsi like "%' . $key . '%"');
		}
		if ($id_hak != '') {
			$this->db->where('id_topik_hak', $id_hak);
		}
		if ($id_subyek != '') {
			$this->db->where('id_topik_subyek', $id_subyek);
		}
		if ($id_lembaga != '') {
			$this->db->where('id_lembaga', $id_lembaga);
		}
		if ($huruf != '' && $huruf != 'Semua') {
			$this->db->where('substr(nama_dokumen,1,1)', $huruf);
		}
		$this->db->order_by('created_at', 'desc');
		$get_paging = ''; // andiek
		if ($this->db->get('v_tb_dokumen')) {
			$get_paging = $this->db->get('v_tb_dokumen');
		}

		//GET ALL JUMLAH DOKUMEN
		if ($key != '') {
			///$this->db->where('nama_dokumen like "%'.$key.'%"');
			$this->db->where('nama_dokumen like "%' . $key . '%" OR deskripsi like "%' . $key . '%"');
		}
		if ($id_hak != '') {
			$this->db->where('id_topik_hak', $id_hak);
		}
		if ($id_subyek != '') {
			$this->db->where('id_topik_subyek', $id_subyek);
		}
		if ($id_lembaga != '') {
			$this->db->where('id_lembaga', $id_lembaga);
		}
		if ($huruf != '' && $huruf != 'Semua') {
			$this->db->where('substr(nama_dokumen,1,1)', $huruf);
		}
		$total_data = ''; //andiek
		if ($this->db->get('v_tb_dokumen')) {
			///$total_data = $this->db->count_all_results('v_tb_dokumen');
			$total_data = $this->db->get('v_tb_dokumen');
		}
		/// $data = [];
		if ($get_paging) {
			$data = [
				'id' => $id,
				'list_dokumen' => $get_paging->result_array(),
				'jum' => $get_paging->num_rows(),
				'agenda' => $this->db->where('deleted_at IS NULL', null)->order_by('start', 'desc')->get('tb_event', 3)->result(),
				'glossary' => $this->db->order_by('judul', 'asc')->get('tb_glossari', 3)->result(),
				'id_hak' => $id_hak,
				'id_subyek' => $id_subyek,
				'id_lembaga' => $id_lembaga,
				'huruf' => $huruf,
				'key' => $key,
				// 'cari_kata' => $cari_kata,
				///		'all_huruf' => array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'),
				// 'key' => (@$this->input->post('key') ? $this->input->post('key') : ''),
				///		'pagging' => $this->pagging_data_dokumen($total_data, $max_per_page, $per_page, $base_url, TRUE),
				'ref_hak_dokumen' => $this->db->select('a.*, count(b.id) as jml')->where('a.is_active', '1')->join('tb_dokumen b', 'a.id_hak=b.id_topik_hak and b.deleted_at is null', 'left')->order_by('a.nama_hak', 'asc')->group_by('a.id_hak')->get('ref_hak_dokumen a')->result_array(),
				'ref_lembaga' => $this->db->select('a.*, count(b.id) as jml')->where('a.is_active', '1')->join('tb_dokumen b', 'a.id=b.id_lembaga and b.deleted_at is null', 'left')->group_by('a.id')->get('ref_lembaga a')->result_array(),
				'ref_subyek_dokumen' => $this->db->select('a.*, count(b.id) as jml')->where('a.is_active', '1')->join('tb_dokumen b', 'a.id_subyek=b.id_topik_subyek and b.deleted_at is null', 'left')->group_by('a.id_subyek')->order_by('a.nama_subyek', 'asc')->get('ref_subyek_dokumen a')->result_array(),
				// 'list_dokumen' => $this->db->get("v_tb_dokumen a")->result(),
			];
		} else {
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
				///			'all_huruf' => array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'),
				// 'key' => (@$this->input->post('key') ? $this->input->post('key') : ''),
				'pagging' => '',
				'ref_hak_dokumen' => '',
				'ref_lembaga' => '',
				'ref_subyek_dokumen' => '',
				// 'list_dokumen' => $this->db->get("v_tb_dokumen a")->result(),   
			];
		}


		$view = [
			'title' => "Antisipasi Pemilu",
			'content' => 'front/antisipasi_pemilu',
			'js' => 'front/antisipasi_pemilu_js',
			'css' => 'front/antisipasi_pemilu_css'
		];

		$this->template->display_front($view, $data);
	}

	public function mitra($id = null)
	{
		$max_per_page = 10;   //jumlah data maksimal per halaman berapa , kalau 5 ya brarti nanti jumlah page nya menyesuaikan jumlah data / 5
		if ($this->uri->segment(1) == 'home')
			$base_url = 'mitra'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini
		else
			$base_url = 'home/mitra'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini

		$huruf = @$this->input->post('huruf', true) ? $this->input->post('huruf', true) : $this->session->userdata('hurufglosari');
		$this->session->set_userdata('hurufglosari', $huruf);
		$key = $this->session->userdata('keyglosari');

		if ($this->uri->segment(3) == 'key') { //pencarian dari home
			$key = str_replace("%20", " ", $this->uri->segment(4)); //$this->input->post('key', true);
			if (!empty($key)) {
				$this->session->set_userdata('key', $key);
			}
		}
		if ($this->uri->segment(1) != 'home') {
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


		if ($key != '') {
			$this->db->where('judul like "%' . $key . '%" OR link like "%' . $key . '%"');
		}

		$this->db->where('is_active', 2);
		$this->db->order_by('judul', 'asc');

		$get_paging = $this->db->get('link_terkait');

		//GET ALL JUMLAH DOKUMEN
		$this->db->where('is_active', 2);
		if ($key != '') {
			$this->db->where('judul like "%' . $key . '%" OR link like "%' . $key . '%"');
		}

		$total_data = $this->db->count_all_results('link_terkait');

		$data = [
			'id' => $id,
			'list_mitra' => $get_paging->result_array(),
			'jum' => $get_paging->num_rows(),
			'huruf' => $huruf,
			'key' => $key,
			//'cari_kata' => $cari_kata,
			//	'all_huruf' => array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'),
			///'key' => (@$this->input->post('key') ? $this->input->post('key') : ''),
			'pagging' => $this->pagging_data_dokumen($total_data, $max_per_page, $per_page, $base_url, TRUE)
		];

		$view = [
			'title' => "Mitra",
			'content' => 'front/mitra',
			'js' => 'front/mitra_js',
			'css' => 'front/mitra_css'
		];

		$this->template->display_front($view, $data);
	}

	public function glossary($id = null)
	{

		$max_per_page = 10;   //jumlah data maksimal per halaman berapa , kalau 5 ya brarti nanti jumlah page nya menyesuaikan jumlah data / 5
		if ($this->uri->segment(1) == 'home')
			$base_url = 'glossary'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini
		else
			$base_url = 'home/glossary'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini

		$huruf = @$this->input->post('huruf', true) ? $this->input->post('huruf', true) : $this->session->userdata('hurufglosari');
		$this->session->set_userdata('hurufglosari', $huruf);
		$key = $this->session->userdata('keyglosari');
		if ($this->uri->segment(3) == 'key') { //pencarian dari home
			$key = str_replace("%20", " ", $this->uri->segment(4)); //$this->input->post('key', true);
			if (!empty($key)) {
				$this->session->set_userdata('key', $key);
			}
		}
		if ($this->uri->segment(1) != 'home') {
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

		if ($key != '') {
			$this->db->where('judul like "%' . $key . '%" OR deskripsi like "%' . $key . '%"');
		}

		if ($huruf != '' && $huruf != 'Semua') {
			$this->db->where('substr(judul,1,1)', $huruf);
		}
		$this->db->where('deleted_at IS NULL', null);
		$this->db->order_by('judul', 'asc');

		$get_paging = $this->db->get('tb_glossari');

		//GET ALL JUMLAH DOKUMEN
		if ($key != '') {
			$this->db->where('judul like "%' . $key . '%" OR deskripsi like "%' . $key . '%"');
		}
		if ($huruf != '' && $huruf != 'Semua') {
			$this->db->where('substr(judul,1,1)', $huruf);
		}
		$total_data = $this->db->count_all_results('tb_glossari');

		$data = [
			'id' => $id,
			'list_glossari' => $get_paging->result_array(),
			'jum' => $get_paging->num_rows(),
			'huruf' => $huruf,
			'key' => $key,
			//'cari_kata' => $cari_kata,
			'all_huruf' => array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'),
			///'key' => (@$this->input->post('key') ? $this->input->post('key') : ''),
			'pagging' => $this->pagging_data_dokumen($total_data, $max_per_page, $per_page, $base_url, TRUE)
		];

		$view = [
			'title' => "Glossarium",
			'content' => 'front/glossari',
			'js' => 'front/glossari_js',
			'css' => 'front/glossari_css'
		];

		$this->template->display_front($view, $data);
	}

	public function glossari_cari()
	{
		$max_per_page = 10;   //jumlah data maksimal per halaman berapa , kalau 5 ya brarti nanti jumlah page nya menyesuaikan jumlah data / 5
		if ($this->uri->segment(1) == 'home')
			$base_url = 'glossary'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini
		else
			$base_url = 'home/glossary'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini

		$huruf = @$this->input->post('huruf', true) ? $this->input->post('huruf', true) : $this->session->userdata('hurufglosari');
		$this->session->set_userdata('hurufglosari', $huruf);
		$key = $this->session->userdata('key');
		$key = $this->input->post('key', true);
		$this->session->set_userdata('key', $key);

		if ($this->uri->segment(1) != 'home') {
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


		if ($key != '') {
			//$this->db->where('judul like "%'.$key.'%"');
			$this->db->where('judul like "%' . $key . '%" OR deskripsi like "%' . $key . '%"');
		}

		if ($huruf != '' && $huruf != 'Semua') {
			$this->db->where('substr(judul,1,1)', $huruf);
		}
		$this->db->where('deleted_at IS NULL', null);
		$this->db->order_by('judul', 'asc');

		$get_paging = $this->db->get('v_tb_glossari');

		//GET ALL JUMLAH DOKUMEN
		if ($key != '') {
			///$this->db->where('judul like "%'.$key.'%"');
			$this->db->where('judul like "%' . $key . '%" OR deskripsi like "%' . $key . '%"');
		}
		if ($huruf != '' && $huruf != 'Semua') {
			$this->db->where('substr(judul,1,1)', $huruf);
		}
		$this->db->where('deleted_at IS NULL', null);
		$this->db->order_by('judul', 'asc');
		$total_data = $this->db->count_all_results('v_tb_glossari');

		$data = [
			'list_glossari' => $get_paging->result_array(),
			'jum' => $get_paging->num_rows(),
			'huruf' => $huruf,
			'key' => $key,
			//'cari_kata' => $cari_kata,
			///'all_huruf' => array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'),
			'key' => (@$this->input->post('key') ? $this->input->post('key') : ''),
			'pagging' => $this->pagging_data_dokumen($total_data, $max_per_page, $per_page, $base_url, TRUE)
		];

		/*$view = [
            'title' => "Beranda",
            'content' => 'front/glossari',
            'js' => 'front/glossari_js',
            'css' => 'front/glossari_css'
        ]; 
        $this->template->display_front($view, $data);  */
		$this->load->view('front/glossari_hasil_cari', $data); //andiek 
	}

	public function save_download()
	{
		if ($this->session->tipe_daftar || $this->session->nama) {
			$g_recaptcha_response = $this->security->xss_clean(post('g-recaptcha-response'));
			$check_captcha = $this->recaptcha->is_valid($g_recaptcha_response);
			if (!$g_recaptcha_response) {
				$response = [
					'status' => false,
					'message' => 'Captcha Wajib Dicentang',
				];
			} else if (!@$check_captcha['success']) {
				$response = [
					'status' => false,
					'message' => 'Silakan cek kembali pada captcha',
				];
			} else {
				$this->form_validation->set_rules('tujuan', 'Tujuan', 'required', array(
					'required' => 'Kolom %s harus diisi.',
					'alpha_spaces' => 'Kolom %s hanya boleh diisi huruf.'
				));
				$this->form_validation->set_rules('id_data', 'ID Data', 'required', array(
					'required' => 'Kolom %s harus diisi.'
				));

				if ($this->form_validation->run() == FALSE) {
					$error_messages = $this->form_validation->error_array();
					$formatted_error_messages = [];

					foreach ($error_messages as $field => $message) {
						$formatted_error_messages[] = $message;
					}

					$response = [
						'status' => false,
						'message' => $formatted_error_messages,
					];
				} else {
					$detail = $this->db->where('id', decode_id($this->input->post('id_data')))->get('v_tb_dokumen')->row_array();
					if ($detail['link'] != null && $detail['link'] != '') {
						$link = $detail['link'];
					} else if ($detail['file_path'] != null && $detail['file_path'] != '') {
						$link = link_file($detail['id'], 'tb_dokumen', 'd');
					} else {
						$link = '#';
					}
					if ($this->session->tipe_daftar || $this->session->nama) {
						$data_user = $this->db->where('id', decrypt($this->session->id))->get('users')->row_array();
						if (count($data_user) > 0) {
							$set_insert['id_user'] = decrypt($this->session->id);
							$set_insert['id_dokumen'] = decode_id($this->input->post('id_data', true));
							$set_insert['instansi'] = $data_user['reglembaga_reginstansi'];
							$set_insert['nama'] = $data_user['nama'];
							$set_insert['email'] = $data_user['email'];
							$set_insert['tujuan'] = $this->input->post('tujuan', true);
							$set_insert['created_at'] = date('Y-m-d H:i:s');

							$this->db->set($set_insert)->insert('tb_dokumen_pengunduh');

							$datalogs = array(
								'user_id' => decrypt($this->session->id),
								'activity' => 'Download Dokumen ' . $detail['nama_dokumen'],
								'ip_address' => $_SERVER['REMOTE_ADDR'],
							);

							$this->db->insert('logs', $datalogs);

							if ($this->db->insert_id() > 0) {
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
						} else {
							$response = [
								'status' => false,
								'message' => 'Data User Tidak Ditemukan',
							];
						}
					} else {
						/*$set_insert['id_dokumen'] = decode_id($this->input->post('id_data', true));
						$set_insert['nama'] = $this->input->post('nama', true);
						$set_insert['instansi'] = $this->input->post('instansi', true);
						$set_insert['email'] = $this->input->post('email', true);
						$set_insert['tujuan'] = $this->input->post('tujuan', true);
						$set_insert['created_at'] = date('Y-m-d H:i:s');*/
						$response = [
							'status' => false,
							'message' => 'Silahkan masuk / daftar terlebih dahulu sebelum download dokumen!',
						];
					}
				}
			}
		} else {

			$response = [
				'status' => false,
				'message' => 'Silahkan melakukan masuk / daftar terlebih dahulu sebelum download dokumen!',
			];
		}

		echo json_encode($response);
	}

	public function save_downloads()
	{
		if ($this->session->tipe_daftar || $this->session->nama) {
			$this->form_validation->set_rules('tujuan', 'Tujuan Pengunduhan', 'required|callback_alpha_space');
			$this->form_validation->set_rules('id_data', 'Dokumen Tidak Valid', 'required|callback_numeric');
		} else {
			echo "<script>alert('Anda belum login, Untuk download dokumen!');history.go(-1);</script>";
		}

		if ($this->form_validation->run() == FALSE) {
			$response = [
				'status' => false,
				'message' => 'Data Harus Dilengkapi',
			];
		} else {
			$g_recaptcha_response = $this->security->xss_clean(post('g-recaptcha-response'));
			$check_captcha = $this->recaptcha->is_valid($g_recaptcha_response);
			/*if (!$g_recaptcha_response) {
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
			{*/
			$detail = $this->db->where('id', decode_id($this->input->post('id_data')))->get('v_tb_dokumen')->row_array();
			if ($detail['link'] != null && $detail['link'] != '') {
				$link = $detail['link'];
			} else if ($detail['file_path'] != null && $detail['file_path'] != '') {
				$link = link_file($detail['id'], 'tb_dokumen', 'd');
			} else {
				$link = '#';
			}
			if ($this->session->tipe_daftar || $this->session->nama) {
				$data_user = $this->db->where('id', decrypt($this->session->id))->get('users')->row_array();
				$set_insert['id_user'] = decrypt($this->session->id);
				$set_insert['id_dokumen'] = decode_id($this->input->post('id_data', true));
				$set_insert['instansi'] = $data_user['reglembaga_reginstansi'];
				$set_insert['nama'] = $data_user['nama'];
				$set_insert['email'] = $data_user['email'];
				$set_insert['tujuan'] = $this->input->post('tujuan', true);
				$set_insert['created_at'] = date('Y-m-d H:i:s');
			} else {
				/*$set_insert['id_dokumen'] = decode_id($this->input->post('id_data', true));
    				$set_insert['nama'] = $this->input->post('nama', true);
    				$set_insert['instansi'] = $this->input->post('instansi', true);
    				$set_insert['email'] = $this->input->post('email', true);
    				$set_insert['tujuan'] = $this->input->post('tujuan', true);
    				$set_insert['created_at'] = date('Y-m-d H:i:s');*/
				$response = [
					'status' => false,
					'message' => 'Silahkan melakukan pendaftaran sebelum download dokumen!',
				];
			}
			$this->db->set($set_insert)->insert('tb_dokumen_pengunduh');
			if ($this->db->insert_id() > 0) {
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
			//}
		}
		echo json_encode($response);
	}

	public function alpha_spaces($str)
	{
		return (bool) preg_match('/^[a-zA-Z\s]+$/', $str);
	}


	public function numeric($str)
	{
		if (!preg_match('/^[0-9]+$/', $str)) {
			$this->form_validation->set_message('numeric', 'Kolom {field} hanya boleh diisi angka');
			return FALSE;
		} else {
			return TRUE;
		}
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
		$config['full_tag_open'] = '<ul class="pagination justify-content-center mb-0 text-primary">';
		$config['full_tag_close'] = '</ul>';
		$config['cur_tag_open'] = '<li class="page-item active" aria-current="page"><span class="page-link text-white"> ';
		$config['cur_tag_close'] = "</span></li>";
		$config['next_tag_open'] = '<li class="page-item text-primary"> <span class="page-link b-radius-none "> ';
		$config['next_tag_close'] = "</span></li>";
		$config['prev_tag_open'] = '<li class="page-item text-primary"> <span class="page-link b-radius-none text-primary"> ';
		$config['prev_tag_close'] = "</span></li>";
		$config['num_tag_open'] = '<li class="page-item text-primary"> <span class="page-link b-radius-none text-primary"> ';
		$config['num_tag_close'] = '</span></li>';
		$config['first_tag_open'] = '<li class="page-item text-primary"> <span class="page-link b-radius-none text-primary"> ';
		$config['first_tag_close'] = "</span></li>";
		$config['last_tag_open'] = '<li class="page-item text-primary"> <span class="page-link b-radius-none text-primary"> ';
		$config['last_tag_close'] = "</span></li>";
		$config['display_pages'] = TRUE;
		$config['first_link'] = '« Awal';
		$config['last_link'] = 'Akhir »';
		$config['next_link'] = 'Selanjutnya >';
		$config['prev_link'] = '< Sebelumnya';
		$this->pagination->initialize($config);
		return $this->pagination->create_links();
		//pagination end
	}

	public function agenda()
	{
		$data = [
			'agenda' => $this->db->where('deleted_at IS NULL', null)->order_by('start', 'desc')->from('tb_event')->get()->result()
		];

		$view = [
			'title' => "Agenda",
			'content' => 'front/agenda/index',
			'js' => 'front/agenda/js',
			'css' => 'front/css'
		];

		$this->template->display_front($view, $data);
	}

	public function semua_agenda($id = null)
	{

		$max_per_page = 10;   //jumlah data maksimal per halaman berapa , kalau 5 ya brarti nanti jumlah page nya menyesuaikan jumlah data / 5
		if ($this->uri->segment(1) == 'home')
			$base_url = 'semua_agenda'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini
		else
			$base_url = 'home/semua_agenda'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini

		$huruf = @$this->input->post('huruf', true) ? $this->input->post('huruf', true) : $this->session->userdata('hurufglosari');
		$this->session->set_userdata('hurufglosari', $huruf);
		$key = $this->session->userdata('keyglosari');
		//print_r($this->uri->segment(3));
		if ($this->uri->segment(3) == 'key') { //pencarian dari home
			$key = str_replace("%20", " ", $this->uri->segment(4)); //$this->input->post('key', true);
			if (!empty($key)) {
				$this->session->set_userdata('key', $key);
			}
		}
		if ($this->uri->segment(1) != 'home') {
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


		if ($key != '') {
			$this->db->where('judul like "%' . $key . '%" OR deskripsi like "%' . $key . '%" OR deskripsi like "%' . $key . '%" OR deskripsi like "%' . $key . '%"');
		}

		if ($huruf != '' && $huruf != 'Semua') {
			$this->db->where('substr(judul,1,1)', $huruf);
		}
		$this->db->where('deleted_at IS NULL', null);
		$this->db->order_by('judul', 'asc');

		$get_paging = $this->db->get('tb_event');

		//GET ALL JUMLAH DOKUMEN
		if ($key != '') {
			$this->db->where('judul like "%' . $key . '%" OR deskripsi like "%' . $key . '%" OR deskripsi like "%' . $key . '%" OR deskripsi like "%' . $key . '%"');
		}
		if ($huruf != '' && $huruf != 'Semua') {
			$this->db->where('substr(judul,1,1)', $huruf);
		}
		$total_data = $this->db->count_all_results('tb_event');

		$data = [
			'id' => $id,
			'list_glossari' => $get_paging->result_array(),
			'jum' => $get_paging->num_rows(),
			'huruf' => $huruf,
			'key' => $key,
			///'agenda_cari_kata' => $cari_kata,
			//	'all_huruf' => array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'),
			///	'key' => (@$this->input->post('key') ? $this->input->post('key') : ''),
			'pagging' => $this->pagging_data_dokumen($total_data, $max_per_page, $per_page, $base_url, TRUE)
		];
		//print_r($data);
		$view = [
			'title' => "Beranda",
			'content' => 'front/semua_agenda',
			'js' => 'front/semua_agenda_js',
			'css' => 'front/semua_agenda_css'
		];

		$this->template->display_front($view, $data);
	}

	public function detail_agenda($id)
	{
		$data = [
			'data' => $this->db->from('tb_event')->where('id_event', decode_id($id))->get()->row(),
			'agenda' => $this->db->from('tb_event')->where('deleted_at IS NULL', null)->order_by('id_event', 'desc')->limit(5)->get()->result()
		];

		$view = [
			'title' => "Detail Agenda",
			'content' => 'front/agenda/detail',
			'js' => 'front/agenda/js',
			'css' => 'front/css'
		];

		$this->template->display_front($view, $data);
	}

	public function komham_cari()
	{
		$max_per_page = 10;   //jumlah data maksimal per halaman berapa , kalau 5 ya brarti nanti jumlah page nya menyesuaikan jumlah data / 5
		if ($this->uri->segment(1) == 'home')
			$base_url = 'semua_komham'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini
		else
			$base_url = 'home/semua_komham'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini

		$huruf = @$this->input->post('huruf', true) ? $this->input->post('huruf', true) : $this->session->userdata('hurufglosari');
		$this->session->set_userdata('hurufglosari', $huruf);
		$key = $this->session->userdata('key');
		$key = $this->input->post('key', true);
		$this->session->set_userdata('key', $key);

		if ($this->uri->segment(1) != 'home') {
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


		if ($key != '') {
			//$this->db->where('judul like "%'.$key.'%"');
			$this->db->where('judul like "%' . $key . '%" OR deskripsi like "%' . $key . '%" OR isi_konten like "%' . $key . '%"');
		} else {
			//$this->db->where('judul like "%'.$key.'%"');
			$this->db->where("judul !='' OR deskripsi != ''");
		}

		if ($huruf != '' && $huruf != 'Semua') {
			$this->db->where('substr(judul,1,1)', $huruf);
		}
		$this->db->where('deleted_at IS NULL', null);
		$this->db->order_by('judul', 'asc');

		$get_paging = $this->db->get('v_tb_komunitasham');

		//GET ALL JUMLAH DOKUMEN
		if ($key != '') {
			///$this->db->where('judul like "%'.$key.'%"');
			$this->db->where('judul like "%' . $key . '%" OR deskripsi like "%' . $key . '%" OR isi_konten like "%' . $key . '%"');
		} else {
			//$this->db->where('judul like "%'.$key.'%"');
			$this->db->where("judul !='' OR deskripsi != ''");
		}
		if ($huruf != '' && $huruf != 'Semua') {
			$this->db->where('substr(judul,1,1)', $huruf);
		}
		$total_data = $this->db->count_all_results('v_tb_komunitasham');

		$data = [
			'list_komham' => $get_paging->result_array(),
			'jum' => $get_paging->num_rows(),
			'huruf' => $huruf,
			'key' => $key,
			//'cari_kata' => $cari_kata,
			///'all_huruf' => array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'),
			'key' => (@$this->input->post('key') ? $this->input->post('key') : ''),
			'pagging' => $this->pagging_data_dokumen($total_data, $max_per_page, $per_page, $base_url, TRUE),
			'data_komham' => $this->db->where('deleted_at IS NULL', null)->where("(is_active='1' OR is_active>'0')")->order_by('id', 'desc')->get('tb_komunitasham', 15)->result()
		];

		$this->load->view('front/komham_hasil_cari', $data); //andiek 
	}

	public function semua_komham()
	{
		$max_per_page = 10;   //jumlah data maksimal per halaman berapa , kalau 5 ya brarti nanti jumlah page nya menyesuaikan jumlah data / 5
		if ($this->uri->segment(1) == 'home')
			$base_url = 'semua_komham'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini
		else
			$base_url = 'home/semua_komham'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini

		$huruf = @$this->input->post('huruf', true) ? $this->input->post('huruf', true) : $this->session->userdata('hurufglosari');
		$this->session->set_userdata('hurufglosari', $huruf);
		$key = $this->session->userdata('keyglosari');

		if ($this->uri->segment(1) != 'home') {
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


		if ($key != '') {
			//$this->db->where('judul like "%'.$key.'%"');
			$this->db->where('judul like "%' . $key . '%" OR deskripsi like "%' . $key . '%"');
		}

		$this->db->where('is_active', 1);
		//$this->db->where('deleted_at', null);
		$this->db->order_by('judul', 'asc');

		$get_paging = $this->db->get('tb_komunitasham');

		//GET ALL JUMLAH DOKUMEN
		if ($key != '') {
			///$this->db->where('judul like "%'.$key.'%"');
			$this->db->where('judul like "%' . $key . '%" OR deskripsi like "%' . $key . '%"');
		}

		$this->db->where('is_active', 1);
		$total_data = $this->db->count_all_results('tb_komunitasham');

		$data = [
			//'id' => $id,
			'list_komham' => $get_paging->result_array(),
			'jum' => $get_paging->num_rows(),
			//'huruf' => $huruf,
			'key' => $key,
			//'cari_kata' => $cari_kata,
			///'all_huruf' => array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'),
			'key' => (@$this->input->post('key') ? $this->input->post('key') : ''),
			'pagging' => $this->pagging_data_dokumen($total_data, $max_per_page, $per_page, $base_url, TRUE),
			'data_komham' => $this->db->where("(is_active='1')")->order_by('id', 'desc')->get('tb_komunitasham', 15)->result()
		];

		$view = [
			'title' => "Komunitas pegiat HAM",
			'content' => 'front/komham',
			'js' => 'front/komham_js',
			'css' => 'front/komham_css'
		];

		$this->template->display_front($view, $data);
	}

	public function komham()
	{

		$data = [
			'data_komham' => $this->db->where('is_active', '1')->order_by('id', 'desc')->from('tb_komunitasham')->get()->result()
		];

		$view = [
			'title' => "Komunitas HAM",
			'content' => 'front/komunitasham/index',
			'js' => 'front/komunitasham/js',
			'css' => 'front/css'
		];

		$this->template->display_front($view, $data);
	}

	public function detail_back_komham($id)
	{
		if ($id == null)
			redirect(base_url());

		$data = [
			'id' => $id,
			///'detail' => $this->db->where('id', decrypt($id))->get('tb_komunitasham')->row_array(),
		];
		$data['detail'] = $this->db->select('a.*, b.nama')->where('a.id', decrypt($id))->join('tb_dataisuprioritas b', 'a.jenis_konten=b.id and a.deleted_at is null', 'left')->get('tb_komunitasham a')->row_array();
		$data['terkait'] = $this->db->where('is_active', '1')->order_by('rand()')->limit(8)->get('tb_komunitasham')->result_array();
		$data['data_pesan'] = $this->db->select('a.id, c.id_konten, c.id_user, c.pesan, d.username')
			->join('tb_komunitasham_msg c', 'c.id_konten = a.id and a.deleted_at is null', 'left')
			->join('users d', 'd.id = c.id_user and a.deleted_at is null', 'left')
			->where('a.id', decrypt($id))->order_by('c.id', 'asc')
			->get('tb_komunitasham a')->result();

		$view = [
			'title' => "Komunitas HAM",
			'content' => 'front/komham_detail',
			'js' => 'front/komham_detail_js',
		];

		$this->template->display_front($view, $data);
	}

	public function detail_komham($id)
	{
		if ($id == null)
			redirect(base_url());

		$data = [
			'id' => $id,
			///'detail' => $this->db->where('id', decode_id($id))->get('tb_komunitasham')->row_array(),
		];
		$data['detail'] = $this->db->select('a.*, b.nama')->where('a.id', decode_id($id))->join('tb_dataisuprioritas b', 'a.jenis_konten=b.id and a.deleted_at is null', 'left')->get('tb_komunitasham a')->row_array();
		/*$data['detail']    = $this->db->select('a.*, b.nama, d.username')->where('a.id', decode_id($id)) 
                        ->join('tb_dataisuprioritas b', 'a.jenis_konten = b.id and a.deleted_at is null', 'left') 
                        ->join('tb_komunitasham_msg c', 'c.id_konten = a.id and a.deleted_at is null', 'left') 
                        ->join('users d', 'd.id = c.id_user and a.deleted_at is null', 'left') 
                        ->get('tb_komunitasham a')->row_array();*/
		$where = 'c.is_active = 1 AND a.id=' . decode_id($id);
		$data['data_pesan'] = $this->db->select('a.id, c.id as id_pesan, c.id_konten, c.id_user, c.pesan, d.username')
			->join('tb_komunitasham_msg c', 'c.id_konten = a.id and a.deleted_at is null', 'left')
			->join('users d', 'd.id = c.id_user and a.deleted_at is null', 'left')
			->where($where)->order_by('c.id', 'asc')
			->get('tb_komunitasham a')->result();
		$data['terkait'] = $this->db->where('is_active', '1')->order_by('rand()')->limit(8)->get('tb_komunitasham')->result_array();

		$view = [
			'title' => "Komunitas Pegiat HAM",
			'content' => 'front/komham_detail',
			'js' => 'front/komham_detail_js',
		];

		$this->template->display_front($view, $data);
	}

	public function save_komen()
	{
		$xhr = TRUE; // if we decide to use XHR ajax

		// Saving new data
		if ($xhr) {
			header('Content-type: text/html; charset=utf-8');
		}

		method('post');
		//checkAccessAjax($this->_path, $menu_id, 2);

		$id_konten = decode_id(post('id_konten')); //decode_id($this->security->xss_clean(post('id_konten')));
		$id_user   = decrypt($this->session->id); //$this->security->xss_clean(post('id_user'));
		$pesan     = post('pesan'); //$this->security->xss_clean(post('pesan'));


		$insert = $this->db->insert('tb_komunitasham_msg', [
			'id_konten' => $id_konten,
			'id_user'   => $id_user,
			'pesan'     => $pesan,
			'is_active' => 1,
			'created_at' => date("Y-m-d H:i:s")
		]);
		if ($this->session->tipe_daftar == 1 || $this->session->tipe_daftar == 'P') {
			response([
				'status' => 'akses',
				'message' => 'Data berhasil disimpan'
			]);
		} else {
			if ($insert) {
				response([
					'status' => 'sukses',
					'message' => 'Data berhasil disimpan'
				]);
			} else {
				response([
					'status' => false,
					'message' => 'Data Gagal disimpan'
				]);
			}
		}
		echo json_encode($response);
		///redirect(base_url('home/detail_komham/'.encode_id($id_konten)));
	}

	public function penggunaan()
	{
		$data = [];

		$view = [
			'title' => "Agenda",
			'content' => 'front/penggunaan',
			'js' => 'front/js',
			'css' => 'front/css'
		];

		$this->template->display_front($view, $data);
	}
	public function kontak()
	{
		$data = [];

		$view = [
			'title' => "Agenda",
			'content' => 'front/kontak',
			'js' => 'front/js',
			'css' => 'front/css'
		];

		$this->template->display_front($view, $data);
	}

	public function lembaga($id = null)
	{
		if (@$id) {
			$idd = substr($id, 32);
			$data = [
				'detail' => $this->db->where('id_lembaga', $idd)->get('tb_lembaga')->row_array()
			];

			$view = [
				'title' => "Data Detail Lembaga HAM",
				'content' => 'front/lembaga_detail',
				'js' => 'front/js',
				'css' => 'front/css'
			];

			$this->template->display_front($view, $data);
		} else {
			$data = [];

			$view = [
				'title' => "Data Lembaga HAM",
				'content' => 'front/sebaran',
				'js' => 'front/sebaran_js',
				'css' => 'front/css'
			];

			$this->template->display_front($view, $data);
		}
	}

	public function angkaham($id = null)
	{
		if (@$id) {
			$idd = substr($id, 32);
			$data = [
				'detail' => $this->db->where('id_lembaga', $idd)->get('tb_angka_ham')->row_array()
			];

			$view = [
				'title' => "Data Angka HAM",
				'content' => 'front/angkaham_detail',
				'js' => 'front/js',
				'css' => 'front/css'
			];

			$this->template->display_front($view, $data);
		} else {
			$data = [];

			$view = [
				'title' => "Data Angka HAM",
				'content' => 'front/angkaham',
				'js' => 'front/angkaham_js',
				'css' => 'front/css'
			];

			$this->template->display_front($view, $data);
		}
	}

	public function get_json()
	{
		$output = array();
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
		$listprop = array(
			"11" => "Aceh",
			"12" => "Sumatera Utara",
			"13" => "Sumatera Barat",
			"14" => "Riau",
			"15" => "Jambi",
			"21" => "Sumatera Selatan",
			"22" => "Bengkulu",
			"23" => "Lampung",
			"24" => "Kepulauan Bangka Belitung",
			"25" => "Kepulauan Riau",
			"31" => "DKI Jakarta",
			"32" => "Jawa Barat",
			"33" => "Jawa Tengah",
			"34" => "DI Yogyakarta",
			"35" => "Jawa Timur",
			"36" => "Banten",
			"41" => "Kalimantan Barat",
			"42" => "Kalimantan Tengah",
			"43" => "Kalimantan Selatan",
			"44" => "Kalimantan Timur",
			"45" => "Kalimantan Utara",
			"51" => "Sulawesi Utara",
			"52" => "Sulawesi Tengah",
			"53" => "Sulawesi Selatan",
			"54" => "Sulawesi Tenggara",
			"55" => "Gorontalo",
			"56" => "Sulawesi Barat",
			"61" => "Bali",
			"62" => "Nusa Tenggara Barat",
			"63" => "Nusa Tenggara Timur",
			"71" => "Maluku",
			"72" => "Maluku Utara",
			"73" => "Papua",
			"74" => "Papua Barat",
			"91" => "Luar Negeri",
			"92" => "Hongkong",
			"101" => "Arab Saudi",
			"102" => "Belanda",
			"103" => "Finlandia",
			"104" => "Japan",
			"105" => "Malaysia",
			"106" => "Mesir",
			"107" => "Myanmar",
			"108" => "Rusia",
			"109" => "Serbia",
			"110" => "Singapura",
			"111" => "Syria",
			"112" => "Taiwan",
			"113" => "Thailand",
			"114" => "Brunei Darussalam",
			"115" => "Cina\r\n",
			"116" => "Filipina\r\n"
		);
		$data['master']['propinsi'] = $listprop;
		$output['data'] = $data;
		echo json_encode($output, true);
	}

	public function infografis($id = null)
	{

		$max_per_page = 5;   //jumlah data maksimal per halaman berapa , kalau 5 ya brarti nanti jumlah page nya menyesuaikan jumlah data / 5
		if ($this->uri->segment(1) == 'home')
			$base_url = 'infografis'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini
		else
			$base_url = 'home/infografis'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini


		//GET TAMPIL PAGINATION
		if (isset($_GET['per_page'])) {
			$per_page = (int)$this->input->get('per_page');
			$this->db->limit($max_per_page, ($per_page - 1) * $max_per_page);
		} else {
			$per_page = 1;
			$this->db->limit($max_per_page);
		}



		$this->db->where('deleted_at IS NULL', null);
		$this->db->where('is_active IS NULL', null);
		$this->db->order_by('judul', 'asc');
		$this->db->where('id', decode_id($id))->get('tb_infografis')->row_array();

		$get_paging = $this->db->get_where('tb_infografis');

		$total_data = $this->db->count_all_results('tb_infografis');

		$data = [
			'id' => $id,
			'list_infografis' => $get_paging->result_array(),
			'jum' => $get_paging->num_rows(),
			// 'cari_kata' => $cari_kata,
			///	'all_huruf' => array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'),
			// 'key' => (@$this->input->post('key') ? $this->input->post('key') : ''),
			'pagging' => $this->pagging_data_dokumen($total_data, $max_per_page, $per_page, $base_url, TRUE)
		];

		$view = [
			'title' => "Infografis",
			'content' => 'front/infografis',
			'js' => 'front/infografis_js',
			'css' => 'front/infografis_css'
		];

		$this->template->display_front($view, $data);
	}

	public function infografis_detail($id = null)
	{
		if ($id == null)
			redirect(base_url());

		$data = [
			'id' => $id,
			'detail' => $this->db->where('id', decode_id($id))->get('tb_infografis')->row_array(),
		];
		$view = [
			'title' => "Detail Pusdahamnas",
			'content' => 'front/infografis_detail',
			'js' => 'front/infografis_detail_js',
		];

		$this->template->display_front($view, $data);
	}

	public function auditham($id = null)
	{

		$max_per_page = 10;   //jumlah data maksimal per halaman berapa , kalau 5 ya brarti nanti jumlah page nya menyesuaikan jumlah data / 5
		if ($this->uri->segment(1) == 'home')
			$base_url = 'auditham'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini
		else
			$base_url = 'home/auditham'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini

		$huruf = @$this->input->post('huruf', true) ? $this->input->post('huruf', true) : $this->session->userdata('hurufglosari');
		$this->session->set_userdata('hurufglosari', $huruf);
		$key = $this->session->userdata('keyglosari');

		if ($this->uri->segment(1) != 'home') {
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


		if ($key != '') {
			$this->db->where('judul like "%' . $key . '%"');
		}

		if ($huruf != '' && $huruf != 'Semua') {
			$this->db->where('substr(judul,1,1)', $huruf);
		}
		$this->db->where('deleted_at IS NULL', null);
		$this->db->order_by('judul', 'asc');

		$get_paging = $this->db->get('tb_auditham');

		//GET ALL JUMLAH DOKUMEN
		if ($key != '') {
			$this->db->where('judul like "%' . $key . '%"');
		}
		if ($huruf != '' && $huruf != 'Semua') {
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
			///	'all_huruf' => array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'),
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

	public function anggaran($id = null)
	{

		$max_per_page = 10;   //jumlah data maksimal per halaman berapa , kalau 5 ya brarti nanti jumlah page nya menyesuaikan jumlah data / 5
		if ($this->uri->segment(1) == 'home')
			$base_url = 'anggaran'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini
		else
			$base_url = 'home/anggaran'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini

		$huruf = @$this->input->post('huruf', true) ? $this->input->post('huruf', true) : $this->session->userdata('hurufglosari');
		$this->session->set_userdata('hurufglosari', $huruf);
		$key = $this->session->userdata('keyglosari');

		if ($this->uri->segment(1) != 'home') {
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


		if ($key != '') {
			$this->db->where('judul like "%' . $key . '%"');
		}

		if ($huruf != '' && $huruf != 'Semua') {
			$this->db->where('substr(judul,1,1)', $huruf);
		}
		$this->db->where('deleted_at IS NULL', null);
		$this->db->order_by('judul', 'asc');

		$get_paging = $this->db->get('tb_anggaran');

		//GET ALL JUMLAH DOKUMEN
		if ($key != '') {
			$this->db->where('judul like "%' . $key . '%"');
		}
		if ($huruf != '' && $huruf != 'Semua') {
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
			///		'all_huruf' => array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'),
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

	public function indikator($id = null)
	{
		if (@$id) {
			$idd = substr($id, 32);
			$data = [
				'detail' => $this->db->where('id_lembaga', $idd)->get('tb_indikator')->row_array()
			];

			$view = [
				'title' => "Data Indikator HAM",
				'content' => 'front/indikator_detail',
				'js' => 'front/js',
				'css' => 'front/css'
			];

			$this->template->display_front($view, $data);
		} else {
			$data = [];

			$view = [
				'title' => "Data Indikator HAM",
				'content' => 'front/indikator',
				'js' => 'front/indikator_js',
				'css' => 'front/css'
			];

			$this->template->display_front($view, $data);
		}
	}

	// snp 
	public function snp_rasetnis_cari()
	{
		method('post');
		///$this->session->set_userdata('key_snp', '');
		$max_per_page = 5;   //jumlah data maksimal per halaman berapa , kalau 5 ya brarti nanti jumlah page nya menyesuaikan jumlah data / 5
		if ($this->uri->segment(1) == 'home')
			$base_url = 'data_snp'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini
		else
			$base_url = 'home/data_snp'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini

		///$huruf = @$this->input->post('huruf', true)?$this->input->post('huruf', true):$this->session->userdata('hurufglosari');
		///$this->session->set_userdata('hurufglosari', $huruf);
		//	$key_snp = $this->session->userdata('key_snp');
		///$key = post('key');
		//$this->session->set_userdata('key', $key);
		$key = $this->input->post('key_snp');
		$this->session->set_userdata('key_snp', $key);
		$key_snp = $this->session->key_snp;
		if ($this->uri->segment(1) != 'home') {
			$this->session->unset_userdata('hurufglosari');
			$this->session->unset_userdata('keyglosari');
		}

		//GET TAMPIL PAGINATION
		if (isset($_POST['per_page']) || isset($_GET['per_page'])) {
			$per_page = (int)$this->input->get('per_page');
			$this->db->limit($max_per_page, ($per_page - 1) * $max_per_page);
		} else {
			$per_page = 1;
			$this->db->limit($max_per_page);
		}

		$key = $this->input->post('key_snp');
		//get data snp all
		if ($key != '') {
			$this->db->where("(t1.is_active='1' AND t1.is_active='1')", NULL, FALSE);
			///$this->db->or_where("(t2.deskripsi like '%$key%' or t1.judul like '%$key%' order by t1.id asc)", NULL, FALSE);
			//$where = '';
			$where = "t2.deskripsi like '%$key%' or t1.judul like '%$key%' order by t1.id asc";
		} else {
			$this->db->where("(t1.is_active='1' AND t1.is_active='1')", NULL, FALSE);
			$where = "t2.deskripsi <>'' or t1.judul <> '' order by t1.id asc";
		}

		$result =  $this->db->select('t1.*,t2.*')
			->from('tb_snp t1')
			->join('tb_snp_detail t2', 't2.id_snp = t1.id')
			->where($where)
			///->limit($per_page, $limit)
			//->order_by("t2.id", "asc")
			->get()
			->result_array();

		if ($result) {
			$get_paging = $result; //->result_array();//->result();
			//return $query->result_array();
		} else {
			return false;
		}

		//GET ALL JUMLAH DOKUMEN
		/*if ($key!='') {
		  $this->db->where("(t1.is_active='1' AND t1.is_active='1')", NULL, FALSE);
          $where = "t2.deskripsi like '%$key%' or t1.judul like '%$key%' order by t1.id asc";
		}else{
		  $this->db->where("(t1.is_active='1' AND t1.is_active='1')", NULL, FALSE);
		  $where = "t2.deskripsi <> '' or t1.judul <> '' order by t1.id asc";
		}*/
		if ($key != '') {
			$this->db->where("(t1.is_active='1' AND t1.is_active='1')", NULL, FALSE);
			//$this->db->or_where("(t2.deskripsi like '%$key%' or t1.judul like '%$key%' order by t1.id asc)", NULL, FALSE);
			//$where = '';
			$where = "t2.deskripsi like '%$key%' or t1.judul like '%$key%' order by t1.id asc";
		} else {
			$this->db->where("(t1.is_active='1' AND t1.is_active='1')", NULL, FALSE);
			$where = "t2.deskripsi <> '' or t1.judul <> '' order by t1.id asc";
		}

		$this->db->select('t1.*, t2.*');
		$this->db->from("tb_snp t1");
		$this->db->join('tb_snp_detail t2', "t2.id_snp = t1.id");
		$this->db->where($where);
		//$this->db->order_by("t2.id", "asc");
		$total_data  = $this->db->count_all_results();

		$this->load->library('pagination');
		$config['base_url'] = $base_url; //'http://example.com/index.php/test/page/';
		$config['total_rows'] = $total_data;
		$config['uri_segment']  = 3;
		$config['per_page'] = 5;
		$config['page_query_string'] = TRUE;
		$this->pagination->initialize($config);

		$data = [
			'link' => $this->pagination->create_links(),
			'list_rasetnis' => $get_paging, //->result_array(),
			'jum' => $get_paging, //->num_rows(),
			'key_snp' => $key_snp,
			'total'   => $total_data,
			'key' => (@$this->input->post('key') ? $this->input->post('key') : ''),
			'pagging' => $this->pagging_data_dokumen($total_data, $max_per_page, $per_page, $base_url, TRUE)
		];

		$this->load->view('front/snp_rasetnis_hasil_cari', $data); //andiek 
	}

	public function data_snp($id = false)
	{
		//$this->session->set_userdata('key_snp', '');  
		$max_per_page = 5;   //jumlah data maksimal per halaman berapa , kalau 5 ya brarti nanti jumlah page nya menyesuaikan jumlah data / 5
		if ($this->uri->segment(1) == 'home') {
			$base_url = 'data_snp'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini
		} else {
			$base_url = 'home/data_snp'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini
		}

		$cek_key_session = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
		$newstring = substr($cek_key_session, -8);
		$exp  = explode("?", $cek_key_session);
		$exp1 = '';
		$exp2 = '';
		if ($newstring == 'data_snp') {
			$this->session->unset_userdata('key_snp');
			$this->session->unset_userdata('key');
		} else {
			if ($exp) {
				$exp1 = $exp[0];
				if(count($exp)>1){
					$exp2 = $exp[1];
				}
				//echo "<script>alert('$newstring-exp-$exp1--$exp2')</script>";
				if ($this->uri->segment(2) == 'data_snp' && $this->session->key_snp != '' && $exp2 != 'data_snp') {
					if ($this->uri->segment(2) == 'data_snp' && $exp1 != '' && $exp2 != '') {
						//echo "<script>alert('clear NO')</script>";        
					} else {
						$this->session->unset_userdata('key_snp');
						$this->session->unset_userdata('key');
					}
				} else {
					$this->session->unset_userdata('key_snp');
					$this->session->unset_userdata('key');
				}
			}
		}

		if ($this->session->key_snp) {
			$key =  $this->session->key_snp;
			$key_snp =  $this->session->key_snp;
		} else {
			$key = $this->input->post('key', true);
			$key_snp =  $key;
		}
		//$this->session->set_userdata('key_snp', $key);
		//$huruf = @$this->input->post('huruf', true)?$this->input->post('huruf', true):$this->session->userdata('hurufglosari');
		//$this->session->set_userdata('hurufglosari', $huruf);
		//$key = $this->session->userdata('keyglosari');

		if ($this->uri->segment(1) != 'home') {
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
		//get data snp all
		if ($key != '') {
			//	$this->db->where('b.deskripsi like "%'.$key.'%" OR a.judul like "%'.$key.'%"');
			$this->db->where("(t1.is_active='1' AND t1.is_active='1')", NULL, FALSE);
			$where = "t2.deskripsi like '%$key%' or t1.judul like '%$key%' order by t1.id asc";
		} else {
			$this->db->where("(t1.is_active='1' AND t1.is_active='1')", NULL, FALSE);
			$where = "t2.deskripsi <> '' or t1.judul <> '' order by t1.id asc";
		}
		$result =  $this->db->select('t1.*,t2.*')
			->from('tb_snp t1')
			->join('tb_snp_detail t2', 't2.id_snp = t1.id')
			->where($where)
			///->limit($per_page, $limit)
			//->order_by("t2.id", "asc")
			->get()
			->result_array();
		if ($result) {
			$get_paging = $result; //->result_array();//->result();
			//return $query->result_array();
		} else {
			return false;
		}
		//GET ALL JUMLAH DOKUMEN
		if ($key != '') {
			//$this->db->where('b.deskripsi like "%'.$key.'%" OR a.judul like "%'.$key.'%"');
			$this->db->where("(t1.is_active='1' AND t1.is_active='1')", NULL, FALSE);
			$where = "t2.deskripsi like '%$key%' or t1.judul like '%$key%' order by t1.id asc";
		} else {
			$this->db->where("(t1.is_active='1' AND t1.is_active='1')", NULL, FALSE);
			$where = "t2.deskripsi <> '' or t1.judul <> '' order by t1.id asc";
		}

		$this->db->select('t1.*, t2.*');
		$this->db->from("tb_snp t1");
		$this->db->join('tb_snp_detail t2', "t2.id_snp = t1.id");
		$this->db->where($where);
		//$this->db->order_by("t2.id", "asc");
		$total_data  = $this->db->count_all_results();
		$data = [
			//	'id' => $id,
			'list_rasetnis' => $get_paging, //->result_array(),
			'jum' => $get_paging, //->num_rows(),
			//	'huruf' => $huruf,
			'key_snp' => $key_snp,
			'total'   => $total_data,
			// 'cari_kata' => $cari_kata,
			///	'all_huruf' => array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'),
			//	'key' => (@$this->input->post('key') ? $this->input->post('key') : ''),
			'pagging' => $this->pagging_data_dokumen($total_data, $max_per_page, $per_page, $base_url, TRUE)
		];

		$view = [
			'title' => "Data SNP",
			'content' => 'front/snp_rasetnis',
			'js' => 'front/snp_rasetnis_js',
			'css' => 'front/snp_rasetnis_css'
		];

		$this->template->display_front($view, $data);
	}
	public function snp_rasetnis_cari_()
	{
		$this->session->set_userdata('key_snp', '');
		$max_per_page = 5;   //jumlah data maksimal per halaman berapa , kalau 5 ya brarti nanti jumlah page nya menyesuaikan jumlah data / 5
		if ($this->uri->segment(1) == 'home')
			$base_url = 'data_snp'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini
		else
			$base_url = 'home/data_snp'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini

		///$huruf = @$this->input->post('huruf', true)?$this->input->post('huruf', true):$this->session->userdata('hurufglosari');
		///$this->session->set_userdata('hurufglosari', $huruf);
		$key_snp = $this->session->userdata('key_snp');
		$key_snp = $this->input->post('key_snp', true);
		$this->session->set_userdata('key_snp', $key_snp);

		if ($this->uri->segment(1) != 'home') {
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


		//get data snp all
		if ($key_snp != '') {
			///$this->db->where('(bab like "%'.$key.'%" OR deskripsi like "%'.$key.'%")');
			$this->db->where('(deskripsi like "%' . $key_snp . '%")');
			$this->db->where("is_active = '1'");
		} else {
			$this->db->where("bab !='' AND is_active = '1'");
		}

		$this->db->order_by('bab', 'asc');
		$this->db->group_by('bab');
		$get_paging = $this->db->get('v_tb_rasetnis');

		//GET ALL JUMLAH DOKUMEN
		if ($key_snp != '') {
			///$this->db->where('(bab like "%'.$key.'%" OR deskripsi like "%'.$key.'%")');
			$this->db->where('(deskripsi like "%' . $key_snp . '%")');
			$this->db->where("is_active = '1'");
			$this->db->group_by('bab');
		} else {
			$this->db->where("bab !=''");
			$this->db->where("is_active = '1'");
			$this->db->group_by('bab');
		}
		$total_data = $this->db->count_all_results('v_tb_rasetnis');

		$data = [
			'list_rasetnis' => $get_paging->result_array(),
			'jum' => $get_paging->num_rows(),
			'key_snp' => $key_snp,
			//'key_snp' => (@$this->input->post('key_snp') ? $this->input->post('key_snp') : ''),
			'pagging' => $this->pagging_data_dokumen($total_data, $max_per_page, $per_page, $base_url, TRUE)
		];

		$this->load->view('front/snp_rasetnis_hasil_cari', $data); //andiek 
	}

	public function data_snps($id = false)
	{
		$max_per_page = 5;   //jumlah data maksimal per halaman berapa , kalau 5 ya brarti nanti jumlah page nya menyesuaikan jumlah data / 5
		if ($this->uri->segment(1) == 'home')
			$base_url = 'data_snp'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini
		else
			$base_url = 'home/data_snp'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini

		$huruf = @$this->input->post('huruf', true) ? $this->input->post('huruf', true) : $this->session->userdata('hurufglosari');
		$this->session->set_userdata('hurufglosari', $huruf);
		$key_snp = $this->session->userdata('keyglosari');
		if ($this->uri->segment(2) == 'data_snp') { //pencarian dari home
			$key_snp = $this->uri->segment(3); //$this->input->post('key', true);
			if (!empty($key_snp)) {
				$this->session->set_userdata('key_snp', $key_snp);
			}
		}

		// var_dump($key_snp);

		if ($this->uri->segment(1) != 'home') {
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

		//get data snp all
		$this->db->select('a.*,b.*');
		$this->db->from('tb_snp a');
		$this->db->join('tb_snp_detail b', 'a.id=b.id_snp', 'left');
		//$this->db->where("(a.id='1' AND b.is_active='1')", NULL, FALSE);
		$this->db->where("(a.id!='0' AND b.is_active='1')", NULL, FALSE);
		$this->db->group_by('b.bab');
		$this->db->order_by('b.id', 'asc');
		$query = $this->db->get();
		if ($query->num_rows() != 0) {
			$get_paging = $query->result_array();
			//return $query->result_array();
		} else {
			return false;
		}

		//GET ALL JUMLAH DOKUMEN
		if ($key_snp != '') {

			$this->db->where('judul like "%' . $key_snp . '%" OR deskripsi like "%' . $key_snp . '%"');
			$this->db->group_by('bab');
		} else {
			///$where = "id_snp = 1 AND deleted_at is null";
			$where = "id_snp != 0 AND deleted_at is null";
			$this->db->where($where);

			$this->db->group_by('bab');
		}
		$this->db->get();
		$total_data = $this->db->count_all_results('tb_snp_detail');

		$data = [
			'list_rasetnis' => $get_paging, ///->result_array(),
			'jum' => $get_paging, //->num_rows(),
			'key_snp' => $key_snp,
			//'key_snp' => (@$this->input->post('key_snp') ? $this->input->post('key_snp') : ''),
			'pagging' => $this->pagging_data_dokumen($total_data, $max_per_page, $per_page, $base_url, TRUE)
		];

		$view = [
			'title' => "Penghapusan diskriminasi ras & etnis",
			'content' => 'front/snp_rasetnis',
			'js' => 'front/snp_rasetnis_js',
			'css' => 'front/snp_rasetnis_css'
		];

		$this->template->display_front($view, $data);
	}

	public function data_snp_($id = false)
	{
		$this->session->set_userdata('key_snp', '');

		$max_per_page = 5;
		if ($this->uri->segment(1) == 'home')
			$base_url = 'data_snp'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini
		else
			$base_url = 'home/data_snp'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini

		///$huruf = @$this->input->post('huruf', true)?$this->input->post('huruf', true):$this->session->userdata('hurufglosari');
		///$this->session->set_userdata('hurufglosari', $huruf);
		$key_snp = $this->session->userdata('key_snp');
		$key_snp = $this->input->post('key_snp', true);
		if ($this->uri->segment(2) == 'data_snp') { //pencarian dari home
			$key_snp = urldecode($this->uri->segment(3)); //$this->input->post('key', true);
			if (!empty($key_snp)) {
				$this->session->set_userdata('key_snp', $key_snp);
			}
		}

		// $this->session->set_userdata('key_snp', $key_snp);

		if ($this->uri->segment(1) != 'home') {
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


		//get data snp all
		if ($key_snp != '') {
			///$this->db->where('(bab like "%'.$key.'%" OR deskripsi like "%'.$key.'%")');
			$this->db->where('(deskripsi like "%' . $key_snp . '%")');
			$this->db->where("is_active = '1'");
		} else {
			$this->db->where("bab !='' AND is_active = '1'");
		}

		$this->db->group_by('bab');
		$this->db->order_by('id_snp', 'asc');
		$get_paging = $this->db->get('v_tb_rasetnis');

		//GET ALL JUMLAH DOKUMEN
		if ($key_snp != '') {
			///$this->db->where('(bab like "%'.$key.'%" OR deskripsi like "%'.$key.'%")');
			$this->db->where('(deskripsi like "%' . $key_snp . '%")');
			$this->db->where("is_active = '1'");
			$this->db->group_by('bab');
			$this->db->order_by('id_snp', 'asc');
		} else {
			$this->db->where("bab !=''");
			$this->db->where("is_active = '1'");
			$this->db->group_by('bab');
			$this->db->order_by('id_snp', 'asc');
		}
		$total_data = $this->db->count_all_results('v_tb_rasetnis');

		$data = [
			'list_rasetnis' => $get_paging->result_array(),
			'jum' => $get_paging->num_rows(),
			'key_snp' => (@$this->input->post('key_snp') ? $this->input->post('key_snp') : $key_snp),
			'pagging' => $this->pagging_data_dokumen($total_data, $max_per_page, $per_page, $base_url, TRUE)
		];

		$view = [
			'title' => "Penghapusan diskriminasi ras & etnis",
			'content' => 'front/snp_rasetnis',
			'js' => 'front/snp_rasetnis_js',
			'css' => 'front/snp_rasetnis_css'
		];

		$this->template->display_front($view, $data);
	}

	//aggaran ham
	public function anggaran_ham_cari()
	{
		$max_per_page = 10;   //jumlah data maksimal per halaman berapa , kalau 5 ya brarti nanti jumlah page nya menyesuaikan jumlah data / 5
		if ($this->uri->segment(1) == 'home')
			$base_url = 'anggaran_ham'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini
		else
			$base_url = 'home/anggaran_ham'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini

		///$huruf = @$this->input->post('huruf', true)?$this->input->post('huruf', true):$this->session->userdata('hurufglosari');
		///$this->session->set_userdata('hurufglosari', $huruf);
		$key = $this->session->userdata('key');
		$key = $this->input->post('key', true);
		$this->session->set_userdata('key', $key);

		if ($this->uri->segment(1) != 'home') {
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


		//get data snp all
		if ($key != '') {
			$this->db->where('(deskripsi like "%' . $key . '%")');
			$this->db->where("is_active = '1'");
		} else {
			$this->db->where("bab !='' AND is_active = '1'");
		}

		$this->db->order_by('id', 'asc');
		$this->db->group_by('bab');
		$get_paging = $this->db->get('v_tb_anggaran');

		//GET ALL JUMLAH DOKUMEN
		if ($key != '') {
			$this->db->where('(deskripsi like "%' . $key . '%")');
			$this->db->where("is_active = '1'");
		} else {
			$this->db->where("is_active = 1");
		}
		$total_data = $this->db->count_all_results('v_tb_anggaran');

		$data = [
			'list_rasetnis' => $get_paging->result_array(),
			'jum' => $get_paging->num_rows(),
			'key' => $key,
			'key' => (@$this->input->post('key') ? $this->input->post('key') : ''),
			'pagging' => $this->pagging_data_dokumen($total_data, $max_per_page, $per_page, $base_url, TRUE)
		];

		$this->load->view('front/anggaran_ham_hasil_cari', $data); //andiek 
	}

	public function anggaran_ham($id = false)
	{
		$max_per_page = 5;   //jumlah data maksimal per halaman berapa , kalau 5 ya brarti nanti jumlah page nya menyesuaikan jumlah data / 5
		if ($this->uri->segment(1) == 'home')
			$base_url = 'anggaran_ham'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini
		else
			$base_url = 'home/anggaran_ham'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini

		$huruf = @$this->input->post('huruf', true) ? $this->input->post('huruf', true) : $this->session->userdata('hurufglosari');
		$this->session->set_userdata('hurufglosari', $huruf);
		$key = $this->session->userdata('keyglosari');

		if ($this->uri->segment(1) != 'home') {
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

		//get data anggaran_ham all
		$this->db->select('a.*,b.*');
		$this->db->from('tb_anggaran_ham a');
		$this->db->join('tb_anggaran_ham_detail b', 'a.id=b.id_anggaran', 'left');
		$this->db->where("(b.is_active='1')", NULL, FALSE);
		$this->db->group_by('b.id_anggaran');
		$this->db->order_by('b.id', 'asc');
		$query = $this->db->get();
		if ($query->num_rows() != 0) {
			$get_paging = $query->result_array();
			//return $query->result_array();
		} else {
			return false;
		}

		//GET ALL JUMLAH DOKUMEN
		if ($key != '') {
			$this->db->where('deskripsi like "%' . $key . '%"');
		} else {
			$where = "deleted_at is null";
			$this->db->where($where);
			$this->db->group_by('id_anggaran');
		}
		$total_data = $this->db->count_all_results('tb_anggaran_ham_detail');

		$data = [
			'list_anggaranham' => $get_paging, ///->result_array(),
			'jum' => $get_paging, //->num_rows(),
			'key' => $key,
			'key' => (@$this->input->post('key') ? $this->input->post('key') : ''),
			'pagging' => $this->pagging_data_dokumen($total_data, $max_per_page, $per_page, $base_url, TRUE)
		];

		$view = [
			'title' => "Anggaran Ramah HAM",
			'content' => 'front/anggaran_ham',
			'js' => 'front/anggaran_ham_js',
			'css' => 'front/anggaran_ham_css'
		];

		$this->template->display_front($view, $data);
	}

	public function audit_ham_cari()
	{
		$max_per_page = 10;   //jumlah data maksimal per halaman berapa , kalau 5 ya brarti nanti jumlah page nya menyesuaikan jumlah data / 5
		if ($this->uri->segment(1) == 'home')
			$base_url = 'audit_ham'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini
		else
			$base_url = 'home/audit_ham'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini

		///$huruf = @$this->input->post('huruf', true)?$this->input->post('huruf', true):$this->session->userdata('hurufglosari');
		///$this->session->set_userdata('hurufglosari', $huruf);
		$key = $this->session->userdata('key');
		$key = $this->input->post('key', true);
		$this->session->set_userdata('key', $key);

		if ($this->uri->segment(1) != 'home') {
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


		//get data snp all
		if ($key != '') {
			$this->db->where('(deskripsi like "%' . $key . '%")');
			$this->db->where("is_active = '1'");
		} else {
			$this->db->where("bab !='' AND is_active = '1'");
		}

		$this->db->order_by('id', 'asc');
		$this->db->group_by('bab');
		$get_paging = $this->db->get('v_tb_audit_ham');

		//GET ALL JUMLAH DOKUMEN
		if ($key != '') {
			$this->db->where('(deskripsi like "%' . $key . '%")');
			$this->db->where("is_active = '1'");
		} else {
			$this->db->where("is_active = 1");
		}
		$total_data = $this->db->count_all_results('v_tb_audit_ham');

		$data = [
			'list_auditham' => $get_paging->result_array(),
			'jum' => $get_paging->num_rows(),
			'key' => $key,
			'key' => (@$this->input->post('key') ? $this->input->post('key') : ''),
			'pagging' => $this->pagging_data_dokumen($total_data, $max_per_page, $per_page, $base_url, TRUE)
		];

		$this->load->view('front/audit_ham_hasil_cari', $data); //andiek 
	}

	public function audit_ham($id = false)
	{
		$max_per_page = 5;   //jumlah data maksimal per halaman berapa , kalau 5 ya brarti nanti jumlah page nya menyesuaikan jumlah data / 5
		if ($this->uri->segment(1) == 'home')
			$base_url = 'audit_ham'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini
		else
			$base_url = 'home/audit_ham'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini

		$key = $this->session->userdata('keyglosari');

		if ($this->uri->segment(1) != 'home') {
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

		//get data anggaran_ham all
		$this->db->select('a.*,b.*');
		$this->db->from('tb_audit_ham a');
		$this->db->join('tb_audit_ham_detail b', 'a.id=b.id_audit');
		//$this->db->where('b.is_active=1');
		//$this->db->where("(b.is_active='1')", NULL, FALSE);
		//$this->db->group_by('b.id_audit');
		//$this->db->order_by('b.id', 'asc');
		$query = $this->db->get();
		if($query!=FALSE){
			if ($query->num_rows() > 0) {
				$get_paging = $query->result_array(); 
			} else {
				echo "Terjadi Kesalahan: ".$this->db->_error_message();
				return false;
			}
		}else{
			echo "Terjadi Kesalahan: ".$this->db->_error_message();
		}

		//print($query);

		//GET ALL JUMLAH DOKUMEN
		if ($key != '') {
			$this->db->where('deskripsi like "%' . $key . '%"');
		} else {
			$where = "deleted_at is null";
			$this->db->where($where);
			$this->db->group_by('id_audit');
		}
		//$total_data = $this->db->count_all_results('tb_audit_ham_detail');
		
		//DIRUBAH MUKHLIS, ASLINYA YANG DIATAS.
		$total_data = 0;
		//

		$data = [
			'list_auditham' => $get_paging, ///->result_array(),
			'jum' => $get_paging, //->num_rows(),
			'key' => $key,
			'key' => (@$this->input->post('key') ? $this->input->post('key') : ''),
			'pagging' => $this->pagging_data_dokumen($total_data, $max_per_page, $per_page, $base_url, TRUE)
		];

		$view = [
			'title' => "Audit HAM",
			'content' => 'front/audit_ham',
			'js' => 'front/audit_ham_js',
			'css' => 'front/audit_ham_css'
		];

		$this->template->display_front($view, $data);
	}

	public function anggaranham_auditham($id = false)
	{
		$max_per_page = 5;   //jumlah data maksimal per halaman berapa , kalau 5 ya brarti nanti jumlah page nya menyesuaikan jumlah data / 5
		if ($this->uri->segment(1) == 'home')
			$base_url = 'anggaranham_auditham'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini
		else
			$base_url = 'home/anggaranham_auditham'; // kalau tidak ada ? get ataupun yang lain maka base url nya ini

		$huruf = @$this->input->post('huruf', true) ? $this->input->post('huruf', true) : $this->session->userdata('hurufglosari');
		$this->session->set_userdata('hurufglosari', $huruf);
		$key = $this->session->userdata('keyglosari');

		if ($this->uri->segment(1) != 'home') {
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

		//get data anggaran_ham all
		$this->db->select('a.*,b.*');
		$this->db->from('tb_anggaran_ham a');
		$this->db->join('tb_anggaran_ham_detail b', 'a.id=b.id_anggaran', 'left');
		$this->db->where("(b.is_active='1')", NULL, FALSE);
		$this->db->group_by('b.id_anggaran');
		$this->db->order_by('b.id', 'asc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$get_paging = $query->result_array();
			return $get_paging;
			//return $query->result_array();
		} else {
			echo "Terjadi Kesalahan: ".$this->db->error()['message'];
			return false;
		}

		//GET ALL JUMLAH DOKUMEN
		if ($key != '') {
			$this->db->where('deskripsi like "%' . $key . '%"');
		} else {
			$where = "deleted_at is null";
			$this->db->where($where);
			$this->db->group_by('id_anggaran');
		}
		$total_data = $this->db->count_all_results('tb_anggaran_ham_detail');

		$data = [
			'list_anggaranham' => $get_paging, ///->result_array(),
			'jum' => $get_paging, //->num_rows(),
			'key' => $key,
			'key' => (@$this->input->post('key') ? $this->input->post('key') : ''),
			'pagging' => $this->pagging_data_dokumen($total_data, $max_per_page, $per_page, $base_url, TRUE)
		];

		$view = [
			'title' => "Anggaran Ramah HAM | Audit HAM",
			'content' => 'front/anggaranham_auditham',
			'js' => 'front/anggaranham_auditham_js',
			'css' => 'front/anggaranham_auditham_css'
		];

		$this->template->display_front($view, $data);
	}

	public function login($menu_id = null)
	{

		method('get');

		if ($this->session->userdata('nama')) {
			redirect('/');
		} else {
			$view = [
				'title' => "Form Login",
				'content' => 'auth/login_user',
				'js' => 'auth/login_user_js',
			];
			//$this->session->set_flashdata('success_messages', '');
			$this->template->display_front($view);
		}
	}

	public function forgot($menu_id = null)
	{

		method('get');

		if ($this->session->userdata('nama')) {
			redirect('/');
		} else {
			$view = [
				'title' => "Form Lupa Sandi",
				'content' => 'auth/forgot',
				'js' => 'auth/forgot_js',
			];
			//$this->session->set_flashdata('success_messages', '');
			$this->template->display_front($view);
		}
	}

	public function reset_password($menu_id = null)
	{
		method('get');

		if ($this->session->userdata('nama')) {
			redirect('/');
		} else {
			$view = [
				'title' => "Form Ganti Password",
				'content' => 'auth/verifikasi_password',
				'js' => 'auth/verifikasi_password_js',
			];
			//$this->session->set_flashdata('success_messages', '');
			$this->template->display_front($view);
		}
	}

	public function pendaftaran_pengunjung($menu_id = null)
	{

		method('get');

		if ($this->session->userdata('nama')) {
			redirect('/');
		} else {
			$view = [
				'title' => "Form Register",
				'content' => 'auth/register_pengunjung',
				'js' => 'auth/register_pengunjung_js',
			];
			//$this->session->set_flashdata('success_messages', '');
		$this->session->set_userdata('tipe_daftar', 1); // Ellis; bad idea but works =)) 1 = pengunjung
			$this->template->display_front($view);
		}
	}

	public function pendaftaran_komunitasham($menu_id = null)
	{

		method('get');

		if ($this->session->userdata('nama')) {
			redirect('/');
		} else {
			$view = [
				'title' => "Form Register",
				'content' => 'auth/register_komunitasham',
				'js' => 'auth/register_komunitasham_js',
			];
			//$this->session->set_flashdata('success_messages', '');
		$this->session->set_userdata('tipe_daftar', 2); // Ellis; bad idea but works =)) 1 = komunitasham
			$this->template->display_front($view);
		}
	}

	public function upgradeTo_komunitasham($menu_id = null)
	{
		method('get');

		$view = [
			'title' => "Form Upgrade Komunitas HAM",
			'content' => 'auth/upgrade_komunitasham',
			'js' => 'auth/upgrade_komunitasham_js',
		];
		//$this->session->set_flashdata('success_messages', '');
		$this->template->display_front($view);
	}

	public function verifikasi_email($menu_id = null)
	{

		method('get');

		$view = [
			'title' => "Veriifikasi Email",
			'content' => 'auth/verifikasi_email',
			'js' => 'auth/verifikasi_email_js',
		];
		//$this->session->set_flashdata('success_messages', '');
		$this->template->display_front($view);
	}

	public function pendaftaran($menu_id = null)
	{

		method('get');

		if ($this->session->userdata('nama')) {
			redirect('/');
		} else {
			$view = [
				'title' => "Form Register",
				'content' => 'auth/register',
				//'js' => 'auth/register_js',
			];
			//$this->session->set_flashdata('success_messages', '');
			$this->template->display_front($view);
		}
	}

	public function pendaftaran_lembaga($menu_id = null)
	{

		method('get');

		$lembaga = $this->db->get('ref_lembaga')->result();

		$data = [
			'data' => $lembaga,
		];

		$view = [
			'title' => "Pendaftaran lembaga",
			'content' => 'contents/data_lembaga/register_lembaga',
			'js' => 'contents/data_lembaga/register_lembaga_js',
		];

		$this->template->display_front($view, $data);
	}

	public function getkab()
	{
		$xhr = TRUE; // if we decide to use XHR ajax

		// Saving new data
		if ($xhr) {
			header('Content-type: text/html; charset=utf-8');
		}
		method('get');

		$idprop = $this->input->get('idprop');
		if ($idprop) {
			foreach ($this->db->where('provinceid', $idprop)->get('ref_kabupaten')->result_array() as $kab) {
				echo '<option value="' . $kab['id'] . '">' . $kab['name'] . '</option>';
			}
		} else {
		}
	}

	public function simpan_lembaga($menu_id = null)
	{
		$xhr = TRUE; // if we decide to use XHR ajax

		// Saving new data
		if ($xhr) {
			header('Content-type: text/html; charset=utf-8');
		}

		$this->load->library('upload');
		$menu_id = $this->input->post('menu_id', true);
		$id = decode_id($this->input->post('id', true));
		$addData = '';
		method('post');

		$config = array(
			'upload_path' => 'assets/photo', //'./uploads/gambar_slide',
			//'upload_path' => './uploads/gambar_slide',
			'allowed_types' => "jpg|png|jpeg",
			'max_size' => '20000',
			'encrypt_name' => true,
			'overwrite' => FALSE,
		);

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('gambar')) {
			$file_name = $this->upload->data('file_name');
			$orig_name = $this->upload->data('orig_name');
			$file_path = $this->upload->data('file_path');
			$file_size = $this->upload->data('file_size');

			$gambar  = $file_name;
		} else {
			$gambar  = '';
		}

		$insert =
			[
				'nama_pendaftar' => $this->input->post('nama_pendaftar', true),
				'nama_lembaga'   => $this->input->post('nama_lembaga', true),
				'fokus_lembaga'  => $this->input->post('kabkota', true),
				'alamat_lembaga' => $this->input->post('alamat', true),
				'expand_lembaga' => $this->input->post('email', true),
				'url_lembaga'    => $this->input->post('telepon', true),
				'keterangan'     => $this->input->post('keterangan', true),
				'gambar'         => $gambar
			];

		if ($this->input->post('propinsi', true) != "") {
			$insert['prop_lembaga'] = $this->db->where('id', $this->input->post('propinsi', true))->get('ref_propinsi')->row_array()['code'];
			$insert['singkatan_lembaga'] = $this->db->where('id', $this->input->post('propinsi', true))->get('ref_propinsi')->row_array()['name'];
		}

		if ($this->input->post('kabkota', true) != "") {
			$insert['youtube_lembaga'] = $this->db->where('id', $this->input->post('kabkota', true))->get('ref_kabupaten')->row_array()['name'];
		}

		$cek = $this->db->from('tb_lembaga')->where('id_lembaga', $id)->get();
		if ($cek->num_rows() > 0) {
			$insert['updated_at'] = date('Y-m-d H:i:s');
			$this->db->where('id_lembaga', $id)->update('tb_lembaga', $insert);
		} else {
			$insert['created_at'] = date('Y-m-d H:i:s');
			$addData =	$this->db->insert('tb_lembaga', $insert);
			$id   = $this->db->insert_id();
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
		//echo "<script>alert('Terima kasih telah mendaftarkan Lembaga Anda, Sedang dalam proses peninjauan');history.go(-1)</script>";
		///$this->session->set_flashdata('success', 'Proses daftar lembaga berhasil');
		//	redirect(base_url('home/lembaga'));
		if ($addData) {
			response([
				'status' => 'sukses',
				'message' => 'Data berhasil disimpan'
			]);
			//echo "<script>alert('Data berhasil disimpan');history.go(-2);</script>";
		} else {
			response([
				'status' => false,
				'message' => 'Data gagal disimpan'
			]);
			echo "<script>alert('Data berhasil disimpan')</script>";
		}
		echo json_encode($response);
	}
}

