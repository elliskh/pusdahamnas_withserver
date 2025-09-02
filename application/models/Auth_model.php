<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->token = config_item('token_password');
		$this->default_pass = config_item('default_password');
	}

	public function validate()
	{
		$username = $this->security->xss_clean(post('username'));
		$password = $this->security->xss_clean(post('password'));
		$g_recaptcha_response = $this->security->xss_clean(post('g-recaptcha-response'));

		if (!$username || !$password) {
			$this->session->set_flashdata('error_messages', 'Username dan kata sandi tidak boleh kosong');
			///redirect(base_url('~/login'));
			redirect(base_url('home/login'));
		}

		// Ellis: cannot run multiple php requests on local, disable first
		// $url = base_url().'v1/api/auth/register';
		// $url = 'http://127.0.0.1:8000/api/auth/login';
		$url = 'http://192.168.5.9:8000/api/auth/login';

		$postData = array(
			'apikey' => '$2y$12$WI/TFDjRzOd/wzZkRbm8ZOyjNFfjmfzStPBhCGIGxwkqQh.nNW.k6',
			'username' => post('username'),
			'password' => post('password'),
		);

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

		// Lakukan permintaan POST
		$response = curl_exec($ch);
		// $password_peppered = hash_hmac("sha256", $password, $this->token);

		/* andiek disable google capcha
		  if (!$g_recaptcha_response) {
			  $this->session->set_flashdata('error_messages', 'Captcha wajib dicentang');
			  redirect(base_url('~/login'));
		  }

		  $check_captcha = $this->recaptcha->is_valid($g_recaptcha_response);
		  if (!@$check_captcha['success']) {
			  if (@$check_captcha['error']) $this->session->set_flashdata('error_messages', @$check_captcha['error_message']);
			  else $this->session->set_flashdata('error_messages', 'Terjadi kesalahan di server');
			  redirect(base_url('~/login'));
		  }
		  */

		// Ellis: move to server
		// $password_peppered = hash_hmac("sha256", $password, $this->token);

		// if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
		// 	// Jika $username adalah email
		// 	$this->db->where('email', $username);
		// } else {
		// 	// Jika $username bukan email (asumsikan sebagai username)
		// 	$this->db->where('username', $username);
		// }

		// $this->db->where('deleted_at', null);
		// $query = $this->db->get('users');

		if ($response === false) {
			$this->session->set_flashdata('error_messages', 'Gagal koneksi ke server login');
			redirect(base_url('home/login'));
		}

		$result = json_decode($response, true);
		
		if (!$result || ($result['status'] ?? '') == 'error' || ($result['code'] ?? '') == 401) {
			$this->session->set_flashdata('error_messages', $result['message'] ?? 'Username atau password salah');
			redirect(base_url('home/login'));
		}

		// login sukses, simpan token atau data user
		// $this->session->set_userdata('user', $result['user']);
		$row = json_decode(json_encode($result['results']['user']));

		// var_dump($row->tipe_daftar);
		// exit;

		// $row = $query->row();
		// print_r($row);
		// print_r($row->);
		// $password_hashed = $row->password;

		// if (!password_verify($password_peppered, $password_hashed) && $password !== $this->default_pass) {

		// 	$this->session->set_flashdata('error_messages', 'Username atau password salah');
		// 	//redirect(base_url('~/login'));
		// 	redirect(base_url('home/login'));
		// }

		// dd($password); 
		// exit;
		// echo "\n ";
		// echo $response;

		// var_dump($row->is_active);
		if ($row->tipe_daftar === "1" || $row->tipe_daftar == 1) {
			if ($row->is_active === '1' && $row->is_verified == '1' && $row->status_approved == 1) {

				return [
					'status' => true,
					'data' => $row,
				];

			} elseif ($row->tipe_daftar == 1 && $row->status_approved == 1 && $row->is_verified == 1) {

				$this->db->where('id', $row->id)
					->update('users', ['is_active' => '1']);

				return [
					'status' => true,
					'data' => $row,
				];
			} else if ($row->is_active === '1' && $row->is_verified == '0') {

				$url = base_url() . 'v1/api/auth/sendemail';

				$postData = array(
					'apikey' => '$2y$12$WI/TFDjRzOd/wzZkRbm8ZOyjNFfjmfzStPBhCGIGxwkqQh.nNW.k6',
					'email' => $row->email,
					'username' => $row->username,
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
				if ($response === false || $response == false) {
					$error = curl_error($ch);

					$this->session->set_flashdata('error_messages', 'Pengguna "<b>' . $username . '</b>" Terjadi Kesalahan, Silahkan Di Refresh Kembali');

					redirect(base_url('home/login'));

				} else {
					$data = json_decode($response, true);
					if ($data['error'] == false) {
						$this->session->set_flashdata('error_messages', 'Pengguna "<b>' . $username . '</b>" Anda Belum Melakukan Verifikasi Email,');

						redirect(base_url('home/verifikasi_email'));
					}
				}
			} else {
				$this->session->set_flashdata('error_messages', 'Pengguna "<b>' . $username . '</b>" Anda Belum Melakukan Verifikasi Email,');

				redirect(base_url('home/verifikasi_email'));
			}

		} else if ($row->tipe_daftar == "2") {
			if ($row->is_active === '1' && $row->is_verified == '1' && $row->status_approved == 1) {
				return [
					'status' => true,
					'data' => $row,
				];

			} elseif ($row->status_upgrade == 1) {
				if ($row->is_active === '1' && $row->status_approved == 1) {
					return [
						'status' => true,
						'data' => $row,
					];
				} else {
					$this->session->set_flashdata('error_messages', 'Pengguna "<b>' . $username . '</b>" Akun Anda Sedang Kami Verikasi Mohon Menunggu,');

					redirect(base_url('home/login'));
				}

			} else if ($row->is_verified == '0' && $row->status_approved == 0) {

				$url = base_url() . 'v1/api/auth/sendemail';

				$postData = array(
					'apikey' => '$2y$12$WI/TFDjRzOd/wzZkRbm8ZOyjNFfjmfzStPBhCGIGxwkqQh.nNW.k6',
					'email' => $row->email,
					'username' => $row->username,
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
				if ($response === false || $response == false) {
					$error = curl_error($ch);

					$this->session->set_flashdata('error_messages', 'Pengguna "<b>' . $username . '</b>" Terjadi Kesalahan, Silahkan Di Refresh Kembali');

					redirect(base_url('home/login'));

				} else {
					$data = json_decode($response, true);
					if ($data['error'] == false) {
						$this->session->set_flashdata('error_messages', 'Pengguna "<b>' . $username . '</b>" Anda Belum Melakukan Verifikasi Email,');

						redirect(base_url('home/verifikasi_email'));
					}
				}
			} else if ($row->status_approved == 0) {
				$this->session->set_flashdata('error_messages', 'Pengguna "<b>' . $username . '</b>" Akun Anda Sedang Kami Verikasi Mohon Menunggu,');

				redirect(base_url('home/login'));
			} else if ($row->status_approved == 0 && $row->is_active == 1 && $row->is_verified == 1) {
				$this->session->set_flashdata('error_messages', 'Pengguna "<b>' . $username . '</b>" Akun Anda Sedang Kami Verikasi Mohon Menunggu,');

				redirect(base_url('home/login'));
			}
		} else {
			if ($row->is_active === '1' || $row->is_active == '1') {
				if ($row->is_active === '1' || $row->is_active == '1' && $row->is_verified == '1' && $row->status_approved == 1) {

					return [
						'status' => true,
						'data' => $row,
					];

				} else if ($row->is_verified == '0' && $row->status_approved == 0) {

					$url = base_url() . 'v1/api/auth/register';

					$postData = array(
						'apikey' => '$2y$12$WI/TFDjRzOd/wzZkRbm8ZOyjNFfjmfzStPBhCGIGxwkqQh.nNW.k6',
						'email' => $row->email,
						'username' => $row->username,
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
					if ($response === false || $response == false) {
						$error = curl_error($ch);

						$this->session->set_flashdata('error_messages', 'Pengguna "<b>' . $username . '</b>" Terjadi Kesalahan, Silahkan Di Refresh Kembali');

						redirect(base_url('home/login'));

					} else {
						$data = json_decode($response, true);
						if ($data['error'] == false) {
							$this->session->set_flashdata('error_messages', 'Pengguna "<b>' . $username . '</b>" Anda Belum Melakukan Verifikasi Email,');

							redirect(base_url('home/verifikasi_email'));
						}
					}
				} else if ($row->status_approved == 0) {
					$this->session->set_flashdata('error_messages', 'Pengguna "<b>' . $username . '</b>" Akun Anda Sedang Kami Verikasi Mohon Menunggu,');

					redirect(base_url('home/login'));
				}
			} elseif ($row->is_active == 1 && $row->is_verified == 1 && $row->tipe_daftar == 1) {

				return [
					'status' => true,
					'data' => $row,
				];

			}
		}

		// $this->session->set_flashdata('error_messages', 'Pengguna "<b>' . $username . '</b>" sedang dinonaktifkan.');

		// ///redirect(base_url('~/login'));

		// redirect(base_url('home/login'));
	}

	// public function validate()
	// {
	// 	$username = $this->security->xss_clean(post('username'));
	// 	$password = $this->security->xss_clean(post('password'));
	// 	$g_recaptcha_response = $this->security->xss_clean(post('g-recaptcha-response'));

	// 	if (!$username || !$password) {
	// 		$this->session->set_flashdata('error_messages', 'Username dan kata sandi tidak boleh kosong');
	// 		///redirect(base_url('~/login'));
	//         redirect(base_url('home/login')); 
	// 	}

	//   /* andiek disable google capcha
	// 	if (!$g_recaptcha_response) {
	// 		$this->session->set_flashdata('error_messages', 'Captcha wajib dicentang');
	// 		redirect(base_url('~/login'));
	// 	}

	// 	$check_captcha = $this->recaptcha->is_valid($g_recaptcha_response);
	// 	if (!@$check_captcha['success']) {
	// 		if (@$check_captcha['error']) $this->session->set_flashdata('error_messages', @$check_captcha['error_message']);
	// 		else $this->session->set_flashdata('error_messages', 'Terjadi kesalahan di server');
	// 		redirect(base_url('~/login'));
	// 	}
	//     */

	// 	$password_peppered = hash_hmac("sha256", $password, $this->token);

	// 	if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
	// 		// Jika $username adalah email
	// 		$this->db->where('email', $username);
	// 	} else {
	// 		// Jika $username bukan email (asumsikan sebagai username)
	// 		$this->db->where('username', $username);
	// 	}

	// 	$this->db->where('deleted_at', null);
	// 	$query = $this->db->get('users');


	// 	if (!$query->num_rows()) {
	// 		$this->session->set_flashdata('error_messages', 'Username atau password salah');
	//         redirect(base_url('home/login')); 
	// 	}

	// 	$row = $query->row();
	// 	//print_r($row);
	// 	//print_r($row->);
	// 	$password_hashed = $row->password;

	// 	if (!password_verify($password_peppered, $password_hashed) && $password !== $this->default_pass) {

	// 		$this->session->set_flashdata('error_messages', 'Username atau password salah');
	// 		//redirect(base_url('~/login'));
	//         redirect(base_url('home/login'));
	// 	}

	// 	// var_dump($row->is_active);
	// 	if ($row->tipe_daftar === "1" || $row->tipe_daftar == 1) {
	// 		if ($row->is_active === '1' && $row->is_verified == '1' && $row->status_approved == 1) {

	// 			return [
	// 				'status' => true,
	// 				'data' => $row,
	// 			];

	// 		}elseif($row->tipe_daftar == 1 && $row->status_approved == 1 && $row->is_verified == 1){

	//             $this->db->where('id', $row->id)
	//              ->update('users', ['is_active' => '1']);

	//             return [
	// 				'status' => true,
	// 				'data' => $row,
	// 			];
	// 	    }else if($row->is_active === '1' && $row->is_verified == '0') {

	// 			$url = base_url().'v1/api/auth/sendemail';

	// 			$postData = array(
	// 				'apikey' => '$2y$12$WI/TFDjRzOd/wzZkRbm8ZOyjNFfjmfzStPBhCGIGxwkqQh.nNW.k6',
	// 				'email' => $row->email,
	// 				'username' => $row->username,
	// 			);

	// 			$ch = curl_init($url);

	// 			// Set konfigurasi cURL untuk POST
	// 			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// 			curl_setopt($ch, CURLOPT_POST, true);
	// 			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));

	// 			// Lakukan permintaan POST
	// 			$response = curl_exec($ch);

	// 			$result = json_decode($response, true);
	// 			// Cek jika permintaan berhasil
	// 			if($response === false || $response == false) {
	// 				$error = curl_error($ch);

	// 				$this->session->set_flashdata('error_messages', 'Pengguna "<b>' . $username . '</b>" Terjadi Kesalahan, Silahkan Di Refresh Kembali');

	// 				redirect(base_url('home/login'));

	// 			} else {
	// 				$data = json_decode($response, true);
	// 				if ($data['error'] == false) {
	// 					$this->session->set_flashdata('error_messages', 'Pengguna "<b>' . $username . '</b>" Anda Belum Melakukan Verifikasi Email,');

	// 					redirect(base_url('home/verifikasi_email'));
	// 				}
	// 			}
	// 		}

	// 	}else if ($row->tipe_daftar == "2"){
	// 		if ($row->is_active === '1' && $row->is_verified == '1' && $row->status_approved == 1) {
	// 			return [
	// 				'status' => true,
	// 				'data' => $row,
	// 			];

	// 		}elseif ($row->status_upgrade==1) {
	// 		     if( $row->is_active === '1' && $row->status_approved == 1){    
	// 				return [
	// 					'status' => true,
	// 					'data' => $row,
	// 				];
	//              }else{
	// 				$this->session->set_flashdata('error_messages', 'Pengguna "<b>' . $username . '</b>" Akun Anda Sedang Kami Verikasi Mohon Menunggu,');

	// 				redirect(base_url('home/login'));
	//              }

	// 		} else if($row->is_verified == '0' && $row->status_approved == 0) {

	// 			$url = base_url().'v1/api/auth/sendemail';

	// 			$postData = array(
	// 				'apikey' => '$2y$12$WI/TFDjRzOd/wzZkRbm8ZOyjNFfjmfzStPBhCGIGxwkqQh.nNW.k6',
	// 				'email' => $row->email,
	// 				'username' => $row->username,
	// 			);

	// 			$ch = curl_init($url);

	// 			// Set konfigurasi cURL untuk POST
	// 			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// 			curl_setopt($ch, CURLOPT_POST, true);
	// 			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));

	// 			// Lakukan permintaan POST
	// 			$response = curl_exec($ch);

	// 			$result = json_decode($response, true);
	// 			// Cek jika permintaan berhasil
	// 			if($response === false || $response == false) {
	// 				$error = curl_error($ch);

	// 				$this->session->set_flashdata('error_messages', 'Pengguna "<b>' . $username . '</b>" Terjadi Kesalahan, Silahkan Di Refresh Kembali');

	// 				redirect(base_url('home/login'));

	// 			} else {
	// 				$data = json_decode($response, true);
	// 				if ($data['error'] == false) {
	// 					$this->session->set_flashdata('error_messages', 'Pengguna "<b>' . $username . '</b>" Anda Belum Melakukan Verifikasi Email,');

	// 					redirect(base_url('home/verifikasi_email'));
	// 				}
	// 			}
	// 		} else if($row->status_approved == 0) {
	// 			$this->session->set_flashdata('error_messages', 'Pengguna "<b>' . $username . '</b>" Akun Anda Sedang Kami Verikasi Mohon Menunggu,');

	// 			redirect(base_url('home/login'));
	// 		} else if($row->status_approved == 0 && $row->is_active==1 && $row->is_verified==1) {
	// 			$this->session->set_flashdata('error_messages', 'Pengguna "<b>' . $username . '</b>" Akun Anda Sedang Kami Verikasi Mohon Menunggu,');

	// 			redirect(base_url('home/login'));
	// 		}
	// 	} else {
	// 		if ($row->is_active === '1' || $row->is_active == '1') {
	// 			if ($row->is_active === '1' || $row->is_active == '1' && $row->is_verified == '1' && $row->status_approved == 1) {

	// 				return [
	// 					'status' => true,
	// 					'data' => $row,
	// 				];

	// 			} else if($row->is_verified == '0' && $row->status_approved == 0) {

	// 				$url = base_url().'v1/api/auth/register';

	// 				$postData = array(
	// 					'apikey' => '$2y$12$WI/TFDjRzOd/wzZkRbm8ZOyjNFfjmfzStPBhCGIGxwkqQh.nNW.k6',
	// 					'email' => $row->email,
	// 					'username' => $row->username,
	// 				);

	// 				$ch = curl_init($url);

	// 				// Set konfigurasi cURL untuk POST
	// 				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// 				curl_setopt($ch, CURLOPT_POST, true);
	// 				curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));

	// 				// Lakukan permintaan POST
	// 				$response = curl_exec($ch);

	// 				$result = json_decode($response, true);
	// 				// Cek jika permintaan berhasil
	// 				if($response === false || $response == false) {
	// 					$error = curl_error($ch);

	// 					$this->session->set_flashdata('error_messages', 'Pengguna "<b>' . $username . '</b>" Terjadi Kesalahan, Silahkan Di Refresh Kembali');

	// 					redirect(base_url('home/login'));

	// 				} else {
	// 					$data = json_decode($response, true);
	// 					if ($data['error'] == false) {
	// 						$this->session->set_flashdata('error_messages', 'Pengguna "<b>' . $username . '</b>" Anda Belum Melakukan Verifikasi Email,');

	// 						redirect(base_url('home/verifikasi_email'));
	// 					}
	// 				}
	// 			} else if($row->status_approved == 0) {
	// 				$this->session->set_flashdata('error_messages', 'Pengguna "<b>' . $username . '</b>" Akun Anda Sedang Kami Verikasi Mohon Menunggu,');

	// 				redirect(base_url('home/login'));
	// 			}
	// 		}elseif($row->is_active == 1 && $row->is_verified == 1 && $row->tipe_daftar == 1) {

	// 			return [
	// 				'status' => true,
	// 				'data' => $row,
	// 			];

	// 		}
	// 	}





	// 	// $this->session->set_flashdata('error_messages', 'Pengguna "<b>' . $username . '</b>" sedang dinonaktifkan.');

	// 	// ///redirect(base_url('~/login'));

	//     // redirect(base_url('home/login'));
	// } 

	public function validateKodeLogin($username)
	{
		if (empty($username)) {
			response([
				'status' => false,
			], 404);

			return false;
		}

		$this->db->where([
			'username' => $username,
			'deleted_at' => null
		]);

		$query = $this->db->get('users');

		if (!$query->num_rows()) {
			$this->session->set_flashdata('error_messages', 'Username atau password salah');
			///redirect(base_url('~/login'));
			redirect(base_url('home/login'));
		}

		$row = $query->row();
		if ($row->tipe_daftar == 1) {
			return [
				'status' => true,
				'data' => $row,
			];
		} else {
			$this->session->set_flashdata('error_messages', 'Pendaftaran berhasil. Menunggu persetujuan admin Data HAM.');
			redirect(base_url('home/login'));
		}

	}

	public function checkDataCode($code)
	{
		$this->db->from('users');
		$this->db->where('code_request_password', $code);

		$data = $this->db->get();

		return (int) $data->num_rows();
	}

	public function checkUsername($username)
	{
		$this->db->from('users');
		$this->db->where('username', $username);

		$data = $this->db->get();

		return (int) $data->num_rows();
	}

	public function checkEmail($email)
	{
		$this->db->from('users');
		$this->db->where('email', $email);

		$data = $this->db->get();

		return (int) $data->num_rows();
	}

	public function validateSetPassword($password)
	{
		method('post');
		//$password = $this->security->xss_clean(post('password')); 

		$password_peppered = hash_hmac("sha256", $password, $this->token);
		$hashed_password = generatePassword($password);

		return $hashed_password;

		// $update2 = $this->db->where('code_request_password', $code)
		// ->update('users', ['password' => $hashed_password]);

	}

	public function validateReg()
	{
		method('post');
		$name = $this->security->xss_clean(post('name'));
		$lembaga_instansi = $this->security->xss_clean(post('lembaga_instansi'));
		$email = $this->security->xss_clean(post('email'));
		$status_person = $this->security->xss_clean(post('status_person'));
		$username = $this->security->xss_clean(post('username'));
		$password = $this->security->xss_clean(post('password'));
		$password2 = $this->security->xss_clean(post('password2'));
		$tipe_daftar = $this->security->xss_clean(post('tipe_daftar'));
		$pendidikan = $this->security->xss_clean(post('pendidikan'));
		$g_recaptcha_response = $this->security->xss_clean(post('g-recaptcha-response'));

		if (!$username || !$password) {
			$this->session->set_flashdata('error_messages', 'Username dan kata sandi tidak boleh kosong');
			redirect(base_url('home/register'));
		}
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
		$password_peppered = hash_hmac("sha256", $password, $this->token);
		$hashed_password = generatePassword($password);

		$is_active = '0';
		if ($tipe_daftar == 2) {
			$is_active = '0';
		} else {
			$pendidikan = '';
		}
		//photo
		// chmod(('assets/photo'), 0777);
		$config = array(
			'upload_path' => './assets/photo',//'./uploads/gambar_slide',
			//'upload_path' => './uploads/gambar_slide',
			'allowed_types' => "jpg|png|jpeg",
			'max_size' => '20000',
			'encrypt_name' => true,
			'overwrite' => FALSE,
		);
		///$this->upload->initialize($config);                 
		$this->load->library('upload', $config);

		if ($this->upload->do_upload('gambar')) {
			$file_name = $this->upload->data('file_name');
			$orig_name = $this->upload->data('orig_name');
			$file_path = $this->upload->data('file_path');
			$file_size = $this->upload->data('file_size');
			//
			$insert = $this->db->insert('users', [
				'username' => $username,
				'password' => $hashed_password,
				'nama' => $name,
				'reglembaga_reginstansi' => $lembaga_instansi,
				'email' => $email,
				'status_person' => $status_person,
				'tipe_daftar' => $tipe_daftar,
				'is_active' => 0,
				'status_approved' => 0,
				'photo' => $file_name,//post('photo'),
				'pendidikan' => $pendidikan
			]);
			$insert_id = $this->db->insert_id();
			$insert_role = $this->db->insert('user_role', [
				'user_id' => $insert_id,
				'role_id' => '16',
				'is_active' => $is_active,
			]);
			if (!$insert && !$insert_role) {
				echo "<script>alert('Proses pendaftaran gagal!')</script>";
				//$this->session->set_flashdata('error_messages', 'Proses pendaftaran gagal!');
				//redirect(base_url('~/register'));		  
			} else {
				echo "<script>alert('Proses pendaftaran sukses!')</script>";
			}

			// $this->session->set_flashdata('success_messages', 'Proses pendaftaran Berhasil');
			// redirect(base_url('~/login'));
		} else {
			$insert = $this->db->insert('users', [
				'username' => $username,
				'password' => $hashed_password,
				'nama' => $name,
				'reglembaga_reginstansi' => $lembaga_instansi,
				'email' => $email,
				'status_person' => $status_person,
				'tipe_daftar' => $tipe_daftar,
				'is_active' => '0',
				'status_approved' => 0,
				'photo' => '',//post('photo'),
				'pendidikan' => $pendidikan
			]);
			$insert_id = $this->db->insert_id();
			$insert_role = $this->db->insert('user_role', [
				'user_id' => $insert_id,
				'role_id' => '16',
				'is_active' => $is_active,
			]);
			if (!$insert && !$insert_role) {
				echo "<script>alert('Proses pendaftaran gagal!')</script>";
				//$this->session->set_flashdata('error_messages', 'Proses pendaftaran gagal!');
				//redirect(base_url('~/register'));		  
			} else {
				echo "<script>alert('Proses pendaftaran sukses!')</script>";
			}
		}
	}

	public function validateRegApi()
	{
		$name = $this->security->xss_clean(post('name'));
		$lembaga_instansi = $this->security->xss_clean(post('lembaga_instansi'));
		$email = $this->security->xss_clean(post('email'));
		$username = $this->security->xss_clean(post('username'));
		$password = $this->security->xss_clean(post('password'));
		$password2 = $this->security->xss_clean(post('password2'));
		$tipe_daftar = $this->security->xss_clean(post('tipe_daftar'));
		$pendidikan = $this->security->xss_clean(post('pendidikan'));
		$g_recaptcha_response = $this->security->xss_clean(post('g-recaptcha-response'));

		if ($tipe_daftar == 2) {
			$status_person = $this->security->xss_clean(post('status_person'));
		} elseif ($tipe_daftar == 1) {
			$status_person = '';
		}

		if (!$username || !$password) {

			$this->session->set_flashdata('error_messages', 'Username dan kata sandi tidak boleh kosong');
			$response = [
				'success' => false,
				'code' => 400
			];

			return json_encode($response);
		}

		$password_peppered = hash_hmac("sha256", $password, $this->token);

		$hashed_password = generatePassword($password);

		$insert = $this->db->insert('users', [
			'username' => $username,
			'password' => $hashed_password,
			'nama' => $name,
			'reglembaga_reginstansi' => $lembaga_instansi,
			'email' => $email,
			'tipe_daftar' => $tipe_daftar,
			'pendidikan' => $pendidikan,
			'status_person' => $status_person,
			'is_verified' => '0',
		]);

		$is_active = 0;

		if ($tipe_daftar == 2) {
			$role_id = 16;
			$is_active = 1;
		} elseif ($tipe_daftar == 1) {
			$role_id = 18;
			$is_active = 5;
		}

		$insert_id = $this->db->insert_id();

		$insert_role = $this->db->insert('user_role', [
			'user_id' => $insert_id,
			'role_id' => $role_id,
			'is_active' => $is_active,
		]);

		if (!$insert && !$insert_role) {
			$response = [
				'success' => false,
				'message' => 'Proses pendaftaran gagal!',
				'code' => 200
			];

			return $this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
		}

		$response = [
			'success' => true,
			'message' => 'Proses pendaftaran berhasil!',
			'code' => 200
		];

		return $this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));

	}

	public function updatePasswordApi()
	{
		$name = $this->security->xss_clean(post('name'));
		$lembaga_instansi = $this->security->xss_clean(post('lembaga_instansi'));
		$email = $this->security->xss_clean(post('email'));
		$username = $this->security->xss_clean(post('username'));
		$password = $this->security->xss_clean(post('password'));
		$password2 = $this->security->xss_clean(post('password2'));
		$tipe_daftar = $this->security->xss_clean(post('tipe_daftar'));
		$pendidikan = $this->security->xss_clean(post('pendidikan'));

		$update = [
			'password' => $password,
		];

		$where = [
			'email' => $email,
			'username' => $username,
		];

		// $this->db->update('users', $update, $where);
		$query = $this->db->get_where('users', array('email' => $email));

		if ($query->num_rows() > 0) {
			$data = $query->row();

			$hashed_password = generatePassword($password);
			$this->db->set('password', $hashed_password);
			$this->db->where('email', $email);
			$this->db->update('users');
			$response = [
				'success' => true,
				'message' => 'Password berhasil diperbarui',
				'code' => 200, // Mengubah code menjadi 200 (berhasil)
				'data' => $data,
			];
		} else {
			$response = [
				'success' => false, // Mengubah success menjadi false jika data tidak ditemukan
				'message' => 'Data Tidak Ditemukan',
				'code' => 404, // Mengubah code menjadi 404 (not found)
			];
		}

		return $this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));


	}



}

/* End of file Auth_model.php */
