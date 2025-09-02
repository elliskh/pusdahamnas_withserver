<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->id = decrypt(session('id'));
		$this->role_id = decrypt(session('role_id'));
	}

	public function _auth()
	{
		if ($this->router->fetch_class() !== 'auth') {
			if (!session('logged_in')) {
				if (!session('id')) redirect('home/login?page=' . urlencode(current_url()));
				else redirect('auth/chooseRole/' . session('id') . (count($_GET) ? '?' . http_build_query($_GET) : ''));
			}
		}
	}
}

/* End of file MY_Controller.php */
