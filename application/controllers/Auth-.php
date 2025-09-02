<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_model', 'auth');
	}

	public function index()
	{
		// $this->login();
		show_404();
	}

	public function login()
	{
		method('get');

		if (segment(totalSegments() - 1) !== '~') redirect('~/login' . (count($_GET) ? '?' . http_build_query($_GET) : ''));
		if (session('id')) redirect('dashboard');
		view('auth/login');
	}

	public function register()
	{
		method('get');

		if (segment(totalSegments() - 1) !== '~') redirect('~/register' . (count($_GET) ? '?' . http_build_query($_GET) : ''));
		if (session('id')) redirect('dashboard');
		view('auth/register');
	}

	public function register_pengunjung() 
	{
		method('get');

		if (segment(totalSegments() - 1) !== '~') redirect('~/pendaftaran_pengunjung' . (count($_GET) ? '?' . http_build_query($_GET) : ''));
		if (session('id')) redirect('dashboard');
		view('auth/register_pengunjung');
	}
    
	public function register_komham()
	{
		method('get');

		if (segment(totalSegments() - 1) !== '~') redirect('~/pendaftaran_komham' . (count($_GET) ? '?' . http_build_query($_GET) : ''));
		if (session('id')) redirect('dashboard');
		view('auth/register_komham');
	}

	public function process()
	{
		method('post');

		$data = $this->auth->validate();
		$this->_changeSession($data);
	}

	public function processReg()
	{
		method('post');
        $username = $this->security->xss_clean(post('username'));
        $email    = $this->security->xss_clean(post('email'));
        
        $this->db->select('username');
        $this->db->from('users');
        $this->db->where('username', $username);
        $query = $this->db->get();
        $countUser = $query->row_array();
        //$countUser = $result['COUNT(*)'];
        
        $this->db->select('email');
        $this->db->from('users');
        $this->db->where('email', $email);
        $query = $this->db->get();
        $countEmail = $query->row_array();
        //$countEmail = $result['COUNT(*)'];
        
		//$check_username = $this->auth->checkUsername($username);
		//$check_email    = $this->auth->checkEmailname($email);

		if ($countUser['username'] == $username) {  
            //echo "<script>alert('Username sudah dipergunakan');history.go(-1);</script>";
    		/*response([
    			'status' => 'adauser',
    			'message' => 'Data Username sudah ada!'
    		]);*/
          $response["status"] = 'adauser';
          $response["message"] = "Data Username sudah ada!";
            //echo json_encode($response);
		}elseif($countEmail['email'] == $email){
          $response["status"] = 'adaemail';
          $response["message"] = "Data Email sudah ada!";
            //echo json_encode($response);
	  
		}else{ 
            $data = $this->auth->validateReg();
    		/*response([
    			'status' => 'sukses',
    			'message' => 'Data berhasil disimpan'
    		]);*/
          //$response["status"] = 'sukses';
          //$response["message"] = "Data berhasil disimpan";
          //  $this->session->set_flashdata('success_messages', 'Proses pendaftaran Berhasil');
          //  echo json_encode($response); 
		  
		}        
        echo json_encode($response);  
	}

	private function _changeSession($data = [])
	{
		$person = $data['data'];

		$this->session->set_userdata([
			'id' => encrypt($person->id),
			'nama' => $person->nama, 
			'username' => $person->username,
			'id_lembaga' => $person->id_lembaga, 
            'tipe_daftar' => $person->tipe_daftar
		]);

		$this->db->select('b.*, a.role_id, a.user_id');
		$this->db->where([
			'a.user_id' => $person->id,
			'a.is_active' => '1',
			'b.is_active' => '1'
		]);
		$this->db->join('roles b', 'b.id = a.role_id');
		$query = $this->db->get('user_role a');

		$role_count = $query->num_rows();

		if ($role_count > 0) {
			if ($role_count === 1) {
				$role_data = $query->row();

				$session = [
					'role_id' => encrypt($role_data->role_id),
					'nama_role' => $role_data->nama,
					'multirole' => false,
					'mode' => 'light',
					'sidebar' => 'vertical',
					'bulan' => (int) date('m'),
					'tahun' => (int) date('Y'),
					'logged_in' => true
				];

				$this->session->set_userdata($session);
				redirect('dashboard');
			}else{
			    redirect('auth/chooseRole/' . encrypt($person->id) . (count($_GET) ? '?' . http_build_query($_GET) : ''));
            } 
		} else {
			$this->session->set_flashdata('error_messages', 'Pengguna "<b>' . $person->nama . '</b>" tidak memiliki hak akses di dalam aplikasi');
			redirect(base_url('~/login'));
		}
	}

	public function chooseRole($user_id = null)
	{
		method('get');

		$user_id = decrypt($user_id);

		if (!session('id')) {
			$this->session->set_flashdata('error_messages', 'Anda belum login!');
			redirect(base_url('~/login'));
		}

		if (!$user_id) show_404();
		if ($user_id !== decrypt(session('id'))) show_404();

		$this->db->select('id, nama');
		$this->db->where('id', $user_id);
		$user_data = $this->db->get('users')->row();

		$this->db->select('a.*, b.nama');
		$this->db->join('roles b', 'a.role_id = b.id', 'left');
		$this->db->where([
			'b.deleted_at' => null,
			'a.user_id' => $user_id,
			'a.is_active' => '1'
		]);
		$roles = $this->db->get('user_role a')->result();
 
			 if($this->session->tipe_daftar==1){
			     //redirect(base_url());
                 redirect(base_url());
			 }else{
        		view('auth/chooseRole', [
        			'user_data' => $user_data,
        			'roles' => $roles,
        		]);
        }
	}

	public function choose()
	{
		method('post');

		$role_id = decrypt(post('role_id'));
		$user_id = decrypt(post('user_id'));

		if (session('role_id')) $this->session->unset_userdata('role_id');
		if ($user_id !== decrypt(session('id'))) {
			$this->session->set_flashdata('error_messages', 'Id pengguna tidak sesuai');
			redirect(base_url('~/login'));
		}

		$this->db->where([
			'id' => $role_id,
			'deleted_at' => null
		]);
		$role_data = $this->db->get('roles')->row();

		$session = [
			'role_id' => encrypt($role_id),
			'nama_role' => $role_data->nama,
			'multirole' => true,
			'mode' => 'light',
			'sidebar' => 'vertical',
			'bulan' => (int) date('m'),
			'tahun' => (int) date('Y'),
			'logged_in' => true
		];

		$this->session->set_userdata($session);
		redirect('dashboard');
	}

	public function logout($teks = null)
	{
		method('get');

		$this->session->sess_destroy();
		if (@$teks) redirect('~/login/' . $teks);
		redirect('~/login');
	}
   
	public function logout_front($teks = null)
	{
		method('get');

		$this->session->sess_destroy();
		///if (@$teks) redirect('' . $teks);
        if (@$teks) redirect('~/login/' . $teks);
		redirect('~/login');
	} 
    
}

/* End of file Auth.php */
