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

		if (segment(totalSegments() - 1) !== 'home')
			redirect('home/login' . (count($_GET) ? '?' . http_build_query($_GET) : ''));
		if (session('id'))
			redirect('dashboard');
		view('auth/login');
	}

	public function register()
	{
		method('get');

		if (segment(totalSegments() - 1) !== 'home')
			redirect('home/register' . (count($_GET) ? '?' . http_build_query($_GET) : ''));
		if (session('id'))
			redirect('dashboard');
		view('auth/register');
	}

	public function register_pengunjung()
	{
		method('get');

		if (segment(totalSegments() - 1) !== 'home')
			redirect('home/pendaftaran_pengunjung' . (count($_GET) ? '?' . http_build_query($_GET) : ''));
		if (session('id'))
			redirect('dashboard');

		view('auth/register_pengunjung');
	}

	public function register_komunitasham()
	{
		method('get');

		if (segment(totalSegments() - 1) !== 'home')
			redirect('home/pendaftaran_komunitasham' . (count($_GET) ? '?' . http_build_query($_GET) : ''));
		if (session('id'))
			redirect('dashboard');

		view('auth/register_komunitasham');
	}

	public function process()
	{
		method('post');

		$data = $this->auth->validate();
		$this->_changeSession($data);

	}

	// Ellis: disable processReg, use Api instead
	// public function processReg()
	// {
	// 	method('post');
	// 	$username = $this->security->xss_clean(post('username'));
	// 	$email = $this->security->xss_clean(post('email'));

	// 	$this->db->select('username');
	// 	$this->db->from('users');
	// 	$this->db->where('username', $username);
	// 	$query = $this->db->get();
	// 	$countUser = $query->row_array();
	// 	//$countUser = $result['COUNT(*)'];

	// 	$this->db->select('email');
	// 	$this->db->from('users');
	// 	$this->db->where('email', $email);
	// 	$query = $this->db->get();
	// 	$countEmail = $query->row_array();
	// 	//$countEmail = $result['COUNT(*)'];

	// 	$check_username = $this->auth->checkUsername($username);
	// 	$check_email = $this->auth->checkEmail($email);

	// 	//if ($countUser['username'] == $username) {
	// 	if ($check_username != 0) {
	// 		$response["status"] = 'adauser';
	// 		$response["message"] = "Data Username sudah ada!";

	// 		// echo json_encode($response);
	// 	} elseif ($check_email != 0) {
	// 		$response["status"] = 'adaemail';
	// 		$response["message"] = "Data Email sudah ada!";
	// 		// echo json_encode($response);	  

	// 		$this->session->set_flashdata('success_messages', 'Data Email sudah ada');
	// 		redirect(base_url('home/login'));
	// 	} else {
	// 		$data = $this->auth->validateReg();

	// 		$response["status"] = 'sukses';
	// 		$response["message"] = "Data berhasil disimpan";
	// 		//  $this->session->set_flashdata('success_messages', 'Proses pendaftaran Berhasil');
	// 		// echo json_encode($response);
	// 		$this->session->set_flashdata('success_messages', 'Proses pendaftaran Berhasil');
	// 		redirect(base_url('home/login'));
	// 	}

	// }

	public function upgradeToKomham()
	{
		method('post');

		$xhr = TRUE; // if we decide to use XHR ajax

		// Saving new data
		if ($xhr) {
			header('Content-type: text/html; charset=utf-8');

		}

		$name = post('name');
		$email = post('email');
		//$username  = $this->security->xss_clean(get('username')); 
		//$password  = $this->security->xss_clean(get('password'));
		//$password2 = $this->security->xss_clean(get('password2'));
		$tipe_daftar = post('tipe_daftar');
		$lembaga_instansi = post('lembaga_instansi');
		$status_person = post('status_person');
		$pendidikan = post('pendidikan');
		$g_recaptcha_response = post('g-recaptcha-response');

		/*if (!$username || !$password) {
			$this->session->set_flashdata('error_messages', 'Username dan kata sandi tidak boleh kosong');
			redirect(base_url('home/register'));
		}*/

		/* andiek disable google capcha
		  if (!$g_recaptcha_response) {
			  $this->session->set_flashdata('error_messages', 'Captcha wajib dicentang');
			  redirect(base_url('~/register'));
		  }

		  $check_captcha = $this->recaptcha->is_valid($g_recaptcha_response);
		  if (!@$check_captcha['success']) {
			  if (@$check_captcha['error']) $this->session->set_flashdata('error_messages', @$check_captcha['error_message']);
			  else $this->session->set_flashdata('error_messages', 'Terjadi kesalahan di server');
			  redirect(base_url('~/register'));
		  }
		  */

		$config = array(
			//'upload_path' => ('assets/photo'),//'./uploads/gambar_slide',
			'upload_path' => './uploads/gambar_slide',
			'allowed_types' => "jpg|png|jpeg",
			'max_size' => '20000',
			'encrypt_name' => true,
			'overwrite' => FALSE,
		);
		$this->load->library('upload', $config);
		$file_name = '';
		if ($this->upload->do_upload('gambar')) {
			$file_name = $this->upload->data('file_name');
			$orig_name = $this->upload->data('orig_name');
			$file_path = $this->upload->data('file_path');
			$file_size = $this->upload->data('file_size');

		}

		$id = post('user_id');
		$username = post('username');

		if (empty($id)) {
			response([
				'status' => false,
			], 404);

			return false;
		}

		$id = decrypt($id);
		//update user_role
		$update1 = $this->db->where('user_id', $id)
			->update('user_role', ['role_id' => '16', 'is_active' => '1']);
		//update users
		$update2 = $this->db->where('id', $id)
			->update('users', ['is_active' => '1', 'status_approved' => '0', 'tipe_daftar' => $tipe_daftar, 'status_upgrade' => '1', 'status_person' => $status_person, 'pendidikan' => $pendidikan, 'reglembaga_reginstansi' => $lembaga_instansi, 'photo' => $file_name]);
		//update user mobile
		$update3 = $this->db->where('username', $this->session->username)
			->update('users_mobile', ['role_id' => '16', 'image_foto' => $file_name]);

		if (!$update1 && !$update2 && !$update3) {
			///$this->session->set_flashdata('error_messages', 'Proses pendaftaran gagal!');
			///redirect(base_url('home/register'));		  
			response([
				'status' => false,
				'message' => 'Terjadi kesalahan di server',
				//	'errors' => $this->db->error(),
			]);
		} else {
			response([
				'status' => 'sukses',
				'message' => 'Data berhasil disimpan',
				// "query" => $this->db->last_query(),
			]);
		}

	}

	// we missing this on server.
	public function processForgot()
	{
		method('post');
		//var_dump(post());

		$url = base_url() . 'v1/api/auth/ForgotRequest';
		$postData = array(
			'apikey' => '$2y$12$WI/TFDjRzOd/wzZkRbm8ZOyjNFfjmfzStPBhCGIGxwkqQh.nNW.k6',
			'email' => post('email'),
		);

		$ch = curl_init($url);

		// Set konfigurasi cURL untuk POST
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));

		// Lakukan permintaan POST
		$response = curl_exec($ch);

		$result = json_decode($response, true);
		// Cek jika permintaan berhasil
		if ($response === false) {
			$error = curl_error($ch);

			echo json_encode($result);

		} else {
			// Lakukan sesuatu dengan data yang diperole	h
			$data = json_decode($response, true);
			if ($data['error'] == false) {
				var_dump($data['results']);
				var_dump($data['results']['verification_code']);

				$this->session->set_userdata([
					'email' => encrypt(post('email')),
					'forgot_code' => encrypt($data['results']['verification_code']),
				]);

				$responses["status"] = 'sukses';
				$responses["message"] = "Data berhasil disimpan";
				//  $this->session->set_flashdata('success_messages', 'Proses pendaftaran Berhasil');
				echo json_encode($responses);
				$this->session->set_flashdata('success_messages', 'Data sedang diproses');
				redirect(base_url('home/login'));
			} else {
				if (isset($data['message']['username']) || isset($data['message']['email'])) {
					$messages = [];

					if (isset($data['message']['username'])) {
						$messages['username'] = $data['message']['username'];
						$responses["status"] = 'adauser';
						$responses["message"] = "Data Username sudah ada!";
						echo json_encode($responses);

						// redirect(base_url('home/login'));
					}

					if (isset($data['message']['email'])) {
						$messages['email'] = $data['message']['email'];
						$responses["status"] = 'adaemail';
						$responses["message"] = "Data Email sudah ada!";
						echo json_encode($responses);

						// redirect(base_url('home/login'));
					}


				} else {
					// $responses["status"] = 'terjadikesalahan';
					// $responses["message"] = "Terjadi Kesalahan!";

					echo json_encode($data);

					// $this->session->set_flashdata('success_messages', 'Data sedang diproses');

					// redirect(base_url('home/pendaftaran'));
				}
			}
		}

		// Tutup koneksi cURL
		curl_close($ch);
	}

	public function processRegAPI()
	{
		method('post');

		$config = array(
			'upload_path' => './assets/photo',//'./uploads/gambar_slide',
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
		} else {
			$file_name = '';
		}

		$cek_user = strlen(post('username'));
		$tipe_daftar = post('tipe_daftar');
		if ($cek_user < 6) {
			if ($tipe_daftar == 2) {
				redirect(base_url('home/pendaftaran_komunitasham'));
			} else {
				redirect(base_url('home/pendaftaran_pengunjung'));
			}
		}

		// Ellis: cannot run multiple php requests on local, disable first
		// $url = base_url().'v1/api/auth/register';
		// $url = 'http://127.0.0.1:8000/api/auth/register';
		$url = base_url() . 'api/auth/register';

		$postData = array(
			'apikey' => '$2y$12$WI/TFDjRzOd/wzZkRbm8ZOyjNFfjmfzStPBhCGIGxwkqQh.nNW.k6',
			'name' => post('name'),
			'email' => post('email'),
			'username' => post('username'),
			'status_person' => post('status_person'),
			'password' => post('password'),
			'pendidikan' => post('pendidikan'),
			'lembaga_instansi' => post('lembaga_instansi'),
			'photo' => $file_name,
			'tipe_daftar' => post('tipe_daftar'),
		);

		$ch = curl_init($url);


		// Set konfigurasi cURL untuk POST
		// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// curl_setopt($ch, CURLOPT_POST, true);
		// curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
		curl_setopt($ch, CURLOPT_VERBOSE, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'Content-Type: application/x-www-form-urlencoded',
		]);

		// Lakukan permintaan POST
		$response = curl_exec($ch);

		$result = json_decode($response, true);

		var_dump($response);

		// Cek jika permintaan berhasil
		if ($response === false) {
			$error = curl_error($ch);

			$this->session->set_flashdata('error_messages', 'Pendaftaran Gagal' . $error);
			redirect(base_url('home/login'));

		} else {
			// Lakukan sesuatu dengan data yang diperoleh
			$data = json_decode($response, true);
			if ($data['error'] == false) {
				$this->session->set_userdata([
					'email' => encrypt(post('email')),
					'username' => encrypt(post('username')),
					'verification_code' => encrypt($data['results']['verification_code']),
				]);

				// $responses["status"] = 'sukses';
				// $responses["message"] = "Data berhasil disimpan";
				// $this->session->set_flashdata('success_messages', 'Proses pendaftaran Berhasil');
				// echo json_encode($responses);

				$this->session->set_flashdata('success_messages', 'Proses pendaftaran Berhasil');
				redirect(base_url('home/verifikasi_email'));
			} else {
				if (isset($data['message']['username']) || isset($data['message']['email'])) {
					// Ellis: revert to old ways
					// $messages = [];

					// if (isset($data['message']['username'])) {
					// 	$messages['username'] = $data['message']['username'];
					// 	$responses["status"] = 'adauser';
					// 	$responses["message"] = "Data Username sudah ada!";
					// 	echo json_encode($responses);
					// 	// redirect(base_url('home/login'));
					// }

					// if (isset($data['message']['email'])) {
					// 	$messages['email'] = $data['message']['email'];
					// 	$responses["status"] = 'adaemail';
					// 	$responses["message"] = "Data Email sudah ada!";
					// 	echo json_encode($responses);
					// 	// redirect(base_url('home/login'));
					// }

					$errors = [];

					if (!empty($data['message']['username'])) {
						$errors[] = "Username sudah ada!";
					}

					if (!empty($data['message']['email'])) {
						$errors[] = "Email sudah ada!";
					}

					if ($errors) {
						$this->session->set_flashdata('error_messages', $errors);

						$tipe_daftar = $this->session->userdata('tipe_daftar');

						if ($tipe_daftar == 1) {
							redirect(base_url('home/pendaftaran_pengunjung'));
						} elseif ($tipe_daftar == 2) {
							redirect(base_url('home/pendaftaran_komunitasham'));
						} else {
							redirect(base_url('home/login'));
						}
						exit;
					}

				} else {
					// $responses["status"] = 'terjadikesalahan';
					// $responses["message"] = "Terjadi Kesalahan!";

					// echo json_encode($data);
					$this->session->set_flashdata('error_messages', "Terjadi Kesalahan!");

					redirect(base_url('home/login'));
				}
			}
		}

		// Tutup koneksi cURL
		curl_close($ch);
	}

	public function verifikasiKode()
	{
		method('post');

		// var_dump(post());

		$verifikasi_kode =
			strval($this->input->post('code_1')) .
			strval($this->input->post('code_2')) .
			strval($this->input->post('code_3')) .
			strval($this->input->post('code_4')) .
			strval($this->input->post('code_5')) .
			strval($this->input->post('code_6'));

		// Ellis: cannot run multiple php requests on local, disable first
		// $url = base_url() . 'v1/api/auth/verification-register';
		// $url = 'http://127.0.0.1:8000/api/auth/verification-register';
		$url = base_url() . 'api/auth/verification-register';

		$postData = array(
			'apikey' => '$2y$12$WI/TFDjRzOd/wzZkRbm8ZOyjNFfjmfzStPBhCGIGxwkqQh.nNW.k6',
			'email' => decrypt($this->session->userdata('email')),
			'username' => decrypt($this->session->userdata('username')),
			'verification_code' => $verifikasi_kode,
		);

		$ch = curl_init($url);

		// Set konfigurasi cURL untuk POST
		// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// curl_setopt($ch, CURLOPT_POST, true);
		// curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
		curl_setopt($ch, CURLOPT_VERBOSE, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'Content-Type: application/x-www-form-urlencoded',
		]);

		// Lakukan permintaan POST
		$response = curl_exec($ch);

		$result = json_decode($response, true);

		// var_dump($result);

		// Cek jika permintaan berhasil
		if ($response === false) {
			$error = curl_error($ch);

			// var_dump($error);

			$this->session->set_flashdata('error_messages', 'Terjadi Kesalahan');
			// redirect(base_url('home/login'));

		} else {
			// Lakukan sesuatu dengan data yang diperole	h
			$data = json_decode($response, true);

			var_dump($data);

			if ($data['error'] == false) {
				$responses["status"] = 'sukses';
				$responses["message"] = "Data berhasil disimpan";
				//  $this->session->set_flashdata('success_messages', 'Proses pendaftaran Berhasil');
				// echo json_encode($responses); 
				$this->session->set_flashdata('success_messages', 'Verifikasi Pendaftaran Berhasil');
				///redirect(base_url('home/login'));
				////
				$username = decrypt($this->session->userdata('username'));
				$data = $this->auth->validateKodeLogin($username);
				$this->_changeSession($data);
				///
			} else {
				// if (isset($data['message']['username']) || isset($data['message']['email'])) {
				// 	// var_dump($response);
				// 	$messages = [];

				// 	// if (isset($data['message']['username'])) {
				// 	// 	$messages['username'] = $data['message']['username'];
				// 	// 	$responses["status"] = 'adauser';
				// 	// 	$responses["message"] = "Data Username sudah ada!";
				// 	// 	echo json_encode($responses);

				// 	// 	redirect(base_url('home/verifikasi_kode'));
				// 	// }

				// 	// if (isset($data['message']['email'])) {
				// 	// 	$messages['email'] = $data['message']['email'];
				// 	// 	$responses["status"] = 'adaemail';
				// 	// 	$responses["message"] = "Data Email sudah ada!";
				// 	// 	echo json_encode($responses);

				// 	// 	redirect(base_url('home/verifikasi_kode'));
				// 	// }
				// } else {
				// 	// var_dump($verifikasi_kode);

				// 	$this->session->set_flashdata('error_messages', $data['message']);
				// 	// redirect(base_url('home/login'));
				// 	// $responses["status"] = 'terjadikesalahan';
				// 	// $responses["message"] = "Terjadi Kesalahan!";

				// 	// echo json_encode($responses);

				// 	redirect(base_url('home/verifikasi_email'));
				// }
				$this->session->set_flashdata('error_messages', $data['message']);
				redirect(base_url('home/verifikasi_email'));
			}
		}

		// Tutup koneksi cURL
		curl_close($ch);

	}

	function request_password()
	{
		method('post');
		$email = $this->security->xss_clean(post('email'));
		$username = $this->security->xss_clean(post('username'));
		$check_email = $this->auth->checkEmail($email);
		if ($check_email == 0) {
			$this->session->set_flashdata('error_messages', 'Email tidak terdaftar!');
			redirect(base_url('home/forgot'));
		}
		$url = base_url() . 'v1/api/auth/sendemail';
		//$url = base_url().'v1/api/auth/sendemailpassword';

		$postData = array(
			'apikey' => '$2y$12$WI/TFDjRzOd/wzZkRbm8ZOyjNFfjmfzStPBhCGIGxwkqQh.nNW.k6',
			'email' => $email,
			'username' => $username,
		);

		$ch = curl_init($url);

		// Set konfigurasi cURL untuk POST
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));

		// Lakukan permintaan POST
		$response = curl_exec($ch);

		$code = '';
		$data = json_decode($response, true);
		//	var_dump($data['results']);
		//	var_dump($data['results']['verification_code']);
		$code = encrypt($data['results']['verification_code']);

		$update2 = $this->db->where('email', $email)
			->update('users', ['code_request_password' => $code]);

		redirect(base_url('home/reset_password'));
	}

	public function setnew_password()
	{
		method('post');
		$email = $this->security->xss_clean(post('email'));
		$password = $this->security->xss_clean(post('password'));
		$code_1 = $this->security->xss_clean(post('code_1'));
		$code_2 = $this->security->xss_clean(post('code_2'));
		$code_3 = $this->security->xss_clean(post('code_3'));
		$code_4 = $this->security->xss_clean(post('code_4'));
		$code_5 = $this->security->xss_clean(post('code_5'));

		$code = ($code_1 . $code_2 . $code_3 . $code_4 . $code_5);

		$checkCode = $this->auth->checkDataCode($code);
		$data_user = $this->db->where('email', $email)->get('users')->result();
		foreach ($data_user as $key => $rows) {
			$data_code = (decrypt($rows->code_request_password));
		}

		//print_r($data_user);
		//if ($countUser['username'] == $username) {
		if ($data_code == $code) {
			//$response["status"] = 'sukses';
			//$response["message"] = "Data Username ada!";
			//  echo json_encode($response);

			$data = $this->auth->validateSetPassword($password);
			$this->db->where('email', $email)->update('users', ['password' => $data]);
			//$password_peppered = hash_hmac("sha256", $password, $this->token);
			//$hashed_password = generatePassword($password);
			//$update2 = $this->db->where('code_request_password', $code)
			//             ->update('users', ['password' => $hashed_password]);
			redirect(base_url('home/login'));
		} else {
			$response["status"] = 'code';
			$response["message"] = "Data gagal disimpan";
			// echo json_encode($response); 
			//   $this->session->set_flashdata('error_messages', "Data kosong");
			//   redirect(base_url('home/reset_password'));
		}

	}

	private function _changeSession($data = [])
	{
		if ($data) {
			$person = $data['data'];

			$status_role1 = '';
			if ($person->tipe_daftar == 1) {
				$status_role = 5;
				$status_role1 = 0;
			} else if ($person->tipe_daftar == '2') {
				$status_role = 1;
				$status_role1 = 1;
			} else if ($person->tipe_daftar == null) {
				$status_role = 2;
				$status_role1 = 1;
			}

			$this->db->select('b.*, a.role_id, a.user_id');
			$this->db->where([
				'a.user_id' => $person->id,
				'a.is_active' => 1,//$status_role,			
				'b.is_active' => '1'
			]);
			///  $this->db->or_where(['a.is_active' => $status_role1,]);

			$this->db->join('roles b', 'b.id = a.role_id');
			$query = $this->db->get('user_role a');

			$role_count = $query->num_rows();

			///if ($role_count > 0) {
			if ($person) {
				///if ($role_count === 1 || $role_count == 1 || $role_count>0) {
				if ($person->id) {
					$this->session->set_userdata([
						'id' => encrypt($person->id),
						'ss_iduser' => encrypt($person->id),
						'nama' => $person->nama,
						'email' => $person->email,
						'photo' => $person->photo,
						'username' => $person->username,
						'id_lembaga' => $person->id_lembaga,
						'tipe_daftar' => $person->tipe_daftar
					]);

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

					$datalogs = array(
						'user_id' => $person->id,
						'activity' => 'Login Berhasil',
						'ip_address' => $_SERVER['REMOTE_ADDR'],
					);

					$this->db->insert('logs', $datalogs);

					if ($person->tipe_daftar == 1) {
						redirect(base_url());
					} else {
						//redirect('dashboard');
						$this->session->set_userdata($session);
						if ($this->session->tipe_daftar == 2 && $this->session->nama) {
							redirect();
						} else {
							redirect('dashboard');
						}
					}


				} else {
					redirect('auth/chooseRole/' . encrypt($person->id) . (count($_GET) ? '?' . http_build_query($_GET) : ''));
				}
			} else {

				$this->session->set_flashdata('error_messages', 'Pengguna "<b>' . $person->nama . '</b>" tidak memiliki hak akses di dalam aplikasi');

				redirect(base_url('home/login'));
			}

		} else {
			$this->session->set_flashdata('error_messages', 'Terjadi kesalahan di server');
			redirect(base_url('home/login'));
		}
	}

	public function chooseRole($user_id = null)
	{
		method('get');

		$user_id = decrypt($user_id);

		if (!session('id')) {
			$this->session->set_flashdata('error_messages', 'Anda belum login!');
			redirect(base_url('home/login'));
		}

		if (!$user_id)
			show_404();
		if ($user_id !== decrypt(session('id')))
			show_404();

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

		if ($this->session->tipe_daftar == 1) {
			redirect(base_url());
		} else {
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

		if (session('role_id'))
			$this->session->unset_userdata('role_id');
		if ($user_id !== decrypt(session('id'))) {
			$this->session->set_flashdata('error_messages', 'Id pengguna tidak sesuai');
			redirect(base_url('home/login'));
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
		if ($this->session->tipe_daftar == 2 && $this->session->nama) {
			redirect();
		} else {
			redirect('dashboard');
		}
	}

	public function logout($teks = null)
	{
		method('get');

		$this->session->sess_destroy();
		//if (@$teks) redirect('~/login/' . $teks);
		//redirect('~/login');
		if (@$teks)
			redirect('' . $teks);
		redirect('');
	}

	// Ellis : not needed, move to server
	// public function process_register_api()
	// {
	// 	// $arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);    


	// 	method('post');
	//     $name      = $this->security->xss_clean(post('name'));  
	// 	$lembaga_instansi  = $this->security->xss_clean(post('lembaga_instansi'));
	// 	$email     = $this->security->xss_clean(post('email')); 
	// 	$username  = $this->security->xss_clean(post('username')); 
	// 	$password  = $this->security->xss_clean(post('password'));

	//     $this->db->select('username');
	//     $this->db->from('users');
	//     $this->db->where('username', $username);
	//     $query = $this->db->get();
	//     $countUser = $query->row_array();
	//     //$countUser = $result['COUNT(*)'];

	//     $this->db->select('email');
	//     $this->db->from('users');
	//     $this->db->where('email', $email);
	//     $query = $this->db->get();
	//     $countEmail = $query->row_array();
	//     //$countEmail = $result['COUNT(*)'];

	// 	$check_username = $this->auth->checkUsername($username);
	// 	$check_email    = $this->auth->checkEmail($email);
	// 	header('Content-Type: application/json');

	// 	if ($check_username != 0 && $check_email != 0) {  

	// 		$data = $this->auth->updatePasswordApi();

	// 		$response = [
	// 			'success' => true,
	// 			'message' => 'Data berhasil disimpan', 
	// 			'code' => 200
	// 		];

	// 		return $data;

	// 		// echo json_encode($response);

	// 	} else{ 
	// 		// echo json_encode($password);
	// 		if (!$username || !$password) {

	// 			$response = [
	// 				'success' => false,
	// 				'message' => 'Username dan kata sandi tidak boleh kosong',
	// 				'code' => 400
	// 			];

	// 			return $this->output
	// 			->set_content_type('application/json')
	// 			->set_output(json_encode($response));
	// 		}

	// 		$data = $this->auth->validateRegApi();

	// 		return $data;

	// 	}        

	// 	// echo json_encode($countEmail);


	// }

	public function process_forgot_password()
	{
		// $arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);    


		method('post');
		$email = $this->security->xss_clean(post('email'));

		$this->db->select('email');
		$this->db->from('users');
		$this->db->where('email', $email);
		$query = $this->db->get();
		$countEmail = $query->row_array();
		//$countEmail = $result['COUNT(*)'];

		$check_email = $this->auth->checkEmail($email);
		header('Content-Type: application/json');

		if ($check_email != 0) {

			$data = $this->auth->validateRegApi();

			return $data;

			// echo json_encode($response);

		} else {
			// echo json_encode($password);
			if (!$email) {

				$response = [
					'success' => false,
					'message' => 'Email tidak terdaftar',
					'code' => 400
				];

				return $this->output
					->set_content_type('application/json')
					->set_output(json_encode($response));
			}


			$data = $this->auth->updatePasswordApi();
			return $data;

		}

		// echo json_encode($countEmail);


	}

	public function logout_front($teks = null)
	{
		method('get');

		$this->session->sess_destroy();
		//if (@$teks) redirect('~/login/' . $teks);
		//redirect('~/login');
		if (@$teks)
			redirect('' . $teks);
		redirect('');
	}

	public function resendOTP()
	{
		method('post');

		// $url = 'http://127.0.0.1:8000/api/auth/resendOtp';
		$url = base_url() . 'api/auth/resendOtp';
		$postData = [
			'apikey' => '$2y$12$WI/TFDjRzOd/wzZkRbm8ZOyjNFfjmfzStPBhCGIGxwkqQh.nNW.k6',
			'email' => decrypt($this->session->userdata('email')),
			// 'name' => decrypt($this->session->userdata('name')),
		];

		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
		curl_setopt($ch, CURLOPT_VERBOSE, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'Content-Type: application/x-www-form-urlencoded',
		]);

		$response = curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$curlError = curl_error($ch);

		// curl_close($ch);
		// echo json_encode([
		//     'success' => false,
		//     'message' => $postData['name']
		// ]);
		// return;

		if ($response === false) {
			// Gagal request ke API tujuan
			echo json_encode([
				'success' => false,
				'message' => 'Tidak dapat menghubungi server OTP: ' . $curlError
			]);
			return;
		}

		$apiData = json_decode($response, true);

		if ($httpCode >= 200 && $httpCode < 300 && isset($apiData['status'])) {
			echo json_encode([
				'success' => $apiData['status'],
				'message' => $apiData['message'] ?? ($apiData['status'] ? 'Kode OTP berhasil dikirim.' : 'Gagal mengirim OTP.')
			]);
		} else {
			echo json_encode([
				'success' => false,
				'message' => 'Server OTP mengembalikan kode HTTP ' . $apiData['message']
			]);
		}
	}

	public function oauthGoogle()
	{
		// method('post');			
		echo json_encode([
				'success' => false,
				'message' => 'On Progress'
		]);

		// $url = 'http://127.0.0.1:8000/api/auth/oauthGoogle';
		// $postData = [
		// 	'apikey' => '$2y$12$WI/TFDjRzOd/wzZkRbm8ZOyjNFfjmfzStPBhCGIGxwkqQh.nNW.k6',
		// 	'email' => decrypt($this->session->userdata('email')),
		// 	'name' => decrypt($this->session->userdata('name')),
		// ];

		// $ch = curl_init($url);

		// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// curl_setopt($ch, CURLOPT_POST, true);
		// curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
		// curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
		// curl_setopt($ch, CURLOPT_VERBOSE, true);
		// curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		// curl_setopt($ch, CURLOPT_HTTPHEADER, [
		// 	'Content-Type: application/x-www-form-urlencoded',
		// ]);

		// $response = curl_exec($ch);
		// $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		// $curlError = curl_error($ch);

		// curl_close($ch);
	}

}

/* End of file Auth.php */
