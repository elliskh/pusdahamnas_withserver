<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Media_analisis extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->_auth();
		$this->_path = 'media_analisis';
		$this->_table = '';
		$this->link = base_url('media_analisis');
		//=========================================================//

		$this->load->model('menu/Menu_model', 'menu');
	}

	public function index($menu_id = null)
	{
		method('get');
		// checkPermission($this->_path, $menu_id, 1);
		$username = session('username');

		$config 			= [
			'title' 		=> 'Media Analisis',
			'menu_id' 		=> $menu_id,
			'menu_active' 	=> 'Media Analisis',
			'menu_open' 	=> null,
			'path' 			=> $this->_path,
			'contents' 		=> $this->_path . '/index',
			'script_js' 	=> $this->_path . 'js',
			//=========================================================//
			'breadcrumb' 	=> [
				'Statistik', 'Media Analisis', 'index'
			],
			'modals' 		=> [],
			'plugins' 		=> [
				'select2' => true,
				'swal' => true
			],
			'asoca_key' => $this->generateAsocaKey($username)
		];
		render($config); 
	}

	private function generateAsocaKey($username)
	{
		$this->load->library('encryption');
		$key = 'K2YmSCkKzhspXHfVqJvo2mriOWnAlIm6';
		$token = $this->encrypt($username);
		return sprintf(
			'%s.%s',
			$key,
			$token
		);
	}

	private function encrypt($plaintext)
	{
		$cipherMethod = 'AES-128-ECB';
		$key = $this->config->item('encryption_key');
		$encrypted = openssl_encrypt($plaintext, $cipherMethod, $key, OPENSSL_RAW_DATA);
		return base64_encode($encrypted);
	}

}
/* End of file Utama.php */
