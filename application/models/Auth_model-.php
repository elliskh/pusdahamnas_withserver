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
			redirect(base_url('~/login'));
		}
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
		$password_peppered = hash_hmac("sha256", $password, $this->token);

		$this->db->where([
			'username' => $username,
			'deleted_at' => null
		]);
		$query = $this->db->get('users');

		if (!$query->num_rows()) {
			$this->session->set_flashdata('error_messages', 'Username atau password salah');
			redirect(base_url('~/login'));
		}

		$row = $query->row();
		$password_hashed = $row->password;

		if (!password_verify($password_peppered, $password_hashed) && $password !== $this->default_pass) {
			$this->session->set_flashdata('error_messages', 'Username atau password salah');
			redirect(base_url('~/login'));
		}

		if ($row->is_active === '1') {
			return [
				'status' => true,
				'data' => $row,
			];
		}

		$this->session->set_flashdata('error_messages', 'Pengguna "<b>' . $username . '</b>" sedang dinonaktifkan.');
		redirect(base_url('~/login'));
	}
    
	public function validateReg()
	{
		$name      = $this->security->xss_clean(post('name'));  
		$lembaga_instansi     = $this->security->xss_clean(post('lembaga_instansi'));
		$email     = $this->security->xss_clean(post('email')); 
		$username  = $this->security->xss_clean(post('username')); 
		$password  = $this->security->xss_clean(post('password'));
		$password2 = $this->security->xss_clean(post('password2'));
		$tipe_daftar = $this->security->xss_clean(post('tipe_daftar'));
		$pendidikan = $this->security->xss_clean(post('pendidikan'));
		$g_recaptcha_response = $this->security->xss_clean(post('g-recaptcha-response'));

		if (!$username || !$password) {
			$this->session->set_flashdata('error_messages', 'Username dan kata sandi tidak boleh kosong');
			redirect(base_url('~/register'));
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
	   $insert = $this->db->insert('users', [
			'username'    => $username,
			'password'    => $hashed_password,
			'nama'        => $name,
            'reglembaga_reginstansi' => $lembaga_instansi,
			'email'       => $email,
			'tipe_daftar' => $tipe_daftar,
			'pendidikan'  => $pendidikan
		]);
        
       $is_active = '0';
       if($tipe_daftar==2){
          $is_active = '1';
       } 
       $insert_id   = $this->db->insert_id();
	   $insert_role = $this->db->insert('user_role', [
			'user_id'    => $insert_id,
			'role_id'    => '16',
			'is_active'  => $is_active,
		]);
		if(!$insert && !$insert_role){
            $this->session->set_flashdata('error_messages', 'Proses pendaftaran gagal!');
		  redirect(base_url('~/register'));		  
		}
        $this->session->set_flashdata('success_messages', 'Proses pendaftaran Berhasil');
        redirect(base_url('~/login'));
	}
    
}

/* End of file Auth_model.php */
