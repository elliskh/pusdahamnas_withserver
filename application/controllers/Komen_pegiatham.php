<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Komen_pegiatham extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->_auth();
		$this->_path = 'komen_pegiatham/';
		$this->_table = 'tb_komunitasham_msg';
        $this->link = base_url('komen_pegiatham');
		//=========================================================//

		$this->load->model($this->_path . 'komen_pegiatham_model', 'user');
	//	$this->load->model('otoritas/Otoritas_model', 'otoritas');
	}

	public function index($menu_id = null)
	{
		method('get');
	///	checkPermission($this->_path, $menu_id, 1);
		//=========================================================//

	//	$roles = $this->db->where([
	//		'is_active' => '1',
	//	])->get('roles')->result();

		$config = [
			'title' => 'Komen Komunitas Pegiat HAM',
			'menu_id' => $menu_id,
			'link' 			=> $this->link.'/tambah',
			'menu_active' => 'Komen pegiat Komunitas HAM',
			'menu_open' => null,
			'path' => $this->_path,
			'contents' =>  $this->_path . 'index',
			'script_js' 		=> $this->_path . 'js',
			//=========================================================//
		///	'roles' => $roles,
			//=========================================================//
			'breadcrumb' => ['Dashboard', 'Komen Komunitas pegiat HAM', 'index'],
			'modals' => [],
            /*'modals' => [
				$this->_path . 'modals/tambah',
				$this->_path . 'modals/ubah',
				//$this->_path . 'modals/otoritas',
			],*/
			'plugins' => [
				'datatable' => true,
				'swal' => true,
				'select2' => true,
				'jquery_validate' => true,
			]
		];

		render($config);
	}

	public function data($menu_id = null)
	{
		method('get');
	///	checkAccessAjax($this->_path, $menu_id, 1);

		$list = $this->user->get_datatables();

		$data = [];
		$no = $_GET['start'];

		foreach ($list as $field) {
			$no++;

			$field->no = $no;
			$field->id = encrypt($field->id);
			$field->id_msg = encrypt($field->id_msg);

			$data[] = $field;
		}

		$output = [
			'draw' => $_GET['draw'],
			'recordsTotal' => $this->user->count_all(),
			'recordsFiltered' => $this->user->count_filtered(),
			'data' => $data,
		];

		response($output);
	}


	public function changeMsgActive($menu_id = null)
	{
        $xhr = TRUE; // if we decide to use XHR ajax
    	
    	// Saving new data
    	if ($xhr) {
    		header( 'Content-type: text/html; charset=utf-8' );
			
    	}
        
		method('post');
	///	checkAccessAjax($this->_path, $menu_id, 3);

		$id = post('id');
        
		if (empty($id)) {
			response([
				'status' => false,
			], 404);
		}

		$msg_id = decrypt($id);
		$val = post('val');
      
      ///  $check_actived = $this->user->checkKontenActive();

    		$this->db->where('id', $msg_id);
    	$update = $this->db->update('tb_komunitasham_msg', [
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

	public function deleteMsg($menu_id = null)
	{
	///	checkAccessAjax($this->_path, $menu_id, 4);

		$id = post('id_msg');

		if (empty($id)) {
			response([
				'status' => false,
			], 404);

			return false;
		}

		$id = decrypt($id);

		$this->db->where('id', $id);
		$this->db->update('tb_komunitasham_msg', ['is_active' => '0','deleted_at' => date ("Y-m-d H:i:s")]);

		response([
			'status' => true,
			'status_del' => 'sukses',
			'message' => 'Data berhasil dihapus'
		]);
	}
    
	public function deleteMsgUser($menu_id = null)
	{
	///	checkAccessAjax($this->_path, $menu_id, 4);

		$id = post('id_msg');

		if (empty($id)) {
			response([
				'status' => false,
			], 404);

			return false;
		}

		$id = decrypt($id);

		$this->db->where('id', $id);
		$this->db->update('tb_komunitasham_msg', ['is_active' => '0','deleted_at' => date ("Y-m-d H:i:s")]);

		response([
			'status' => 'sukses',
			'message' => 'Data berhasil dihapus'
		]);
	}

}

/* End of file Rollisu.php */
