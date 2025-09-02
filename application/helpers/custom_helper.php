<?php

use Nullix\CryptoJsAes\CryptoJsAes;

defined('BASEPATH') or exit('No direct script access allowed');

function themeUrl()
{
	return config_item('theme_url');
}

function sistem()
{
	return (object) [
		'nama' => config_item('nama_sistem'),
		'deskripsi' => config_item('deskripsi_sistem'),
		'author' => config_item('author_sistem'),
		'favicon' => config_item('favicon_sistem'),
		'logo_sm_light' => config_item('logo_sm_light_sistem'),
		'logo_light' => config_item('logo_light_sistem'),
		'logo_sm_dark' => config_item('logo_sm_dark_sistem'),
		'logo_dark' => config_item('logo_dark_sistem'),
	];
}

function comingSoon()
{
	view('layouts/coming_soon');
}

function generatePassword($string)
{

	$password_peppered = hash_hmac("sha256", $string, config_item('token_password'));
	$password_hashed = password_hash($password_peppered, PASSWORD_ARGON2I);

	return $password_hashed;
}

function generateKey()
{
	$ci = &get_instance();

	$ci->load->library('encryption');

	$key = bin2hex($ci->encryption->create_key(16));

	echo $key;
}

function auth()
{
	$ci = &get_instance();

	if ($ci->router->fetch_class() !== 'auth') {
		if (!session('id') && session('logged_in') !== true) {
			redirect('home/login?page=' . urlencode(current_url()));
		}
	}
}

function slugify($string)
{
	// Get an instance of $this
	$CI = &get_instance();

	$CI->load->helper('text');
	$CI->load->helper('url');

	// Replace unsupported characters (add your owns if necessary)
	$string = str_replace("'", '-', $string);
	$string = str_replace(".", '-', $string);
	$string = str_replace("²", '2', $string);

	// Slugify and return the string
	return url_title(convert_accented_characters($string), 'dash', true);
}

function encrypt($string)
{
	$string = $string . ' ' . date('YmdHis') . random_string('alnum', 8);
	$output = false;
	/*
        * read security.ini file & get encryption_key | iv | encryption_mechanism value for generating encryption code
        */
	$security       = parse_ini_file("security.ini");
	$secret_key     = $security["encryption_key"];
	$secret_iv      = $security["iv"];
	$encrypt_method = $security["encryption_mechanism"];

	// hash
	$key    = hash("sha256", $secret_key);

	// iv – encrypt method AES-256-CBC expects 16 bytes – else you will get a warning
	$iv     = substr(hash("sha256", $secret_iv), 0, 16);

	//do the encryption given text/string/number
	$result = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
	$output = base64_encode($result);
	return $output;
}

function decrypt($string)
{

	$output = false;
	/*
	* read security.ini file & get encryption_key | iv | encryption_mechanism value for generating encryption code
	*/

	$security       = parse_ini_file("security.ini");
	$secret_key     = $security["encryption_key"];
	$secret_iv      = $security["iv"];
	$encrypt_method = $security["encryption_mechanism"];

	// hash
	$key    = hash("sha256", $secret_key);

	// iv – encrypt method AES-256-CBC expects 16 bytes – else you will get a warning
	$iv = substr(hash("sha256", $secret_iv), 0, 16);

	//do the decryption given text/string/number

	$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	$hasil = explode(" ", $output);
	return $hasil[0];
}

function cryptoJsAesEncrypt($originalValue)
{
	$password = config_item('cryptojs_aes_password');
	$encrypted = CryptoJsAes::encrypt($originalValue, $password);
	return $encrypted;
}

function cryptoJsAesDecrypt($encrypted)
{
	$password = config_item('cryptojs_aes_password');
	$decrypted = CryptoJsAes::decrypt($encrypted, $password);
	return $decrypted;
}

function uuid($data = null)
{
	// Generate 16 bytes (128 bits) of random data or use the data passed into the function.
	$data = $data ?? random_bytes(16);
	assert(strlen($data) == 16);

	// Set version to 0100
	$data[6] = chr(ord($data[6]) & 0x0f | 0x40);
	// Set bits 6-7 to 10
	$data[8] = chr(ord($data[8]) & 0x3f | 0x80);

	// Output the 36 character UUID.
	return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

function dd($var)
{
	highlight_string("<?php\n\n" . var_export($var, true) . ";\n\n?>");
	exit;
}

function render($data, $view = null, $js = null)
{
	$content_data = getContentJsView($data, $view, $js);
	$ci = &get_instance();

	// ob_start('minifier');
	$ci->load->view('layouts/app', $content_data);
	// ob_end_flush();
}

function getContentJsView($data, $view, $js)
{
	$ci = &get_instance();

	$view_path = 'contents/';
	$js_path = 'contents/';

	$data['access'] = [];
	if (@$data['menu_id']) {
		$actions = $ci->db->get_where('actions', [
			'is_active' => '1',
			'deleted_at' => null
		])->result();

		foreach ($actions as $k => $v) {
			$data['access'][@$v->nama] = checkAccess($data['path'], $data['menu_id'], @$v->id);
		}
	}

	if (@$data['modals']) {
		for ($i = 0; $i < count($data['modals']); $i++) :
			if (file_exists(VIEWPATH . $view_path . "{$data['modals'][$i]}.php")) {
				$data['modals'][$i] = $ci->load->view($view_path . @$data['modals'][$i], $data, true);
			} else unset($data['modals'][$i]);
		endfor;
	}

	if (@$data['contents']) {
		if (file_exists(VIEWPATH . $view_path . "{$data['contents']}.php"))
			$contents = $ci->load->view($view_path . @$data['contents'], $data, true);
		else $contents = null;
	} else {
		if (!$view) $contents = null;
		else {
			if (file_exists(VIEWPATH . $view_path . $view))
				$contents = $ci->load->view($view_path . $view, $data, true);
			else $contents = null;
		}
	}

	if (@$data['script_js']) {
		// if ($js){
			$js = $data['script_js'];
			if (file_exists(FCPATH . $js_path . "$js.php")){
				$data['script_js'] = base_url($js_path . "$js.php");
			}
	}
	if (file_exists(APPPATH .'views/'. $js_path . "$js.php")){
		$javascript = $ci->load->view($js_path . $js, $data, true);
	}else{
		$javascript = null;
	}
	// echo APPPATH .'views/'. $js_path . "$js.php";die;

	$return_data = [
		'contents' => $contents,
		'javascript' => $javascript,
	];
	$array = array_merge($data, $return_data);

	return $array;
}

function checkPermission($path = null, $menu_id = null, $action_id = null)
{
	$ci = &get_instance();

	if (!$menu_id || !$action_id)	show_404();

	$menu_id = decrypt($menu_id);

	$check_menu = $ci->db->get_where('menus', [
		'id' => $menu_id,
		'path' => $path
	])->num_rows();
	if (!$check_menu) show_404();

	$access = checkRBAC($menu_id, $action_id);

	if ($access) return true;
	show_404();
}

function checkAccess($path = null, $menu_id = null, $action_id = null)
{
	$ci = &get_instance();

	if (!$menu_id || !$action_id) return false;

	$menu_id = decrypt($menu_id);

	$check_menu = $ci->db->get_where('menus', [
		'id' => $menu_id,
		'path' => $path
	])->num_rows();
	if (!$check_menu) return false;

	$access = checkRBAC($menu_id, $action_id);

	if ($access) return true;
	return false;
}

function checkAccessAjax($path = null, $menu_id = null, $action_id = null)
{
	$ci = &get_instance();

	if (!$menu_id || !$action_id)
		response([
			'status' => false,
			'message' => 'Forbidden'
		], 403);

	$menu_id = decrypt($menu_id);

	$check_menu = $ci->db->get_where('menus', [
		'id' => $menu_id,
		'path' => $path
	])->num_rows();

	if (!$check_menu)
		response([
			'status' => false,
			'message' => 'Forbidden'
		], 403);

	$access = checkRBAC($menu_id, $action_id);

	if ($access) return true;

	response([
		'status' => false,
		'message' => 'Forbidden'
	], 403);
}

function checkRBAC($menu_id, $action_id)
{
	$ci = &get_instance();

	$ci->db->where([
		'is_active' => '1',
		'menu_id' => $menu_id,
		'action_id' => $action_id,
		'role_id' => decrypt(session('role_id')),
	]);

	$ci->db->from('menu_role');

	$access = $ci->db->get();

	if ($access->num_rows() == 0) return false;

	return true;
}

function response($array = [], $code = 200)
{
	$ci = &get_instance();
	$ci->output->set_content_type('application/json', 'utf-8');
	$ci->output->set_status_header($code);

	$array['code'] = $code;
	$array['total'] = $ci->db->affected_rows();
	$array["payload"] = [
		'postFields' => post(),
		'queryString' => get(),
		'files' => $_FILES
	];
	$array['csrf'] = csrf();

	$ci->output->set_output(json_encode($array));
	$ci->output->_display();
	exit();
}

function method($method, $must_ajax = false)
{
	$ci = &get_instance();

	if ($must_ajax) ajax();

	if ($ci->input->method() !== strtolower($method)) {
		if ($ci->input->is_ajax_request() || $ci->input->is_cli_request()) {
			response([
				'status' => false,
				'message' => 'Forbidden',
			], 403);
		} else show_error("Forbidden", 403);
	}
}

function view($view = '', $data = [], $return = false)
{
	$ci = &get_instance();
	if (!$return) {
		ob_start('minifier');
		$ci->load->view($view, $data, $return);
		ob_end_flush();
	} else echo $ci->load->view($view, $data, $return);
}

function get($input = null, $xss_clean = true)
{
	$ci = &get_instance();

	if (!$input) return $ci->input->get();

	$get = $ci->input->get($input, $xss_clean);
	if (!$get) return null;
	return $get;
}

function post($input = null, $xss_clean = true)
{
	$ci = &get_instance();

	if (!$input) return $ci->input->post();

	$post = $ci->input->post($input, $xss_clean);
	if (!$post) return null;
	return $post;
}

function put($input = null, $xss_clean = true)
{
	$ci = &get_instance();

	if (!$input) return $ci->input->input_stream();

	$put = $ci->input->input_stream($input, $xss_clean);
	if (!$put) return null;
	return $put;
}

function patch($input = null, $xss_clean = true)
{
	$ci = &get_instance();

	if (!$input) return $ci->input->input_stream();

	$patch = $ci->input->input_stream($input, $xss_clean);
	if (!$patch) return null;
	return $patch;
}

function delete($input = null, $xss_clean = true)
{
	$ci = &get_instance();

	if (!$input) return $ci->input->input_stream();

	$delete = $ci->input->input_stream($input, $xss_clean);
	if (!$delete) return null;
	return $delete;
}

function session($key = null, $value = null)
{
	$ci = &get_instance();

	if (!$key) return $_SESSION;
	elseif (!$value) return $ci->session->userdata($key);

	return $ci->session->set_userdata($key, $value);
}

function now()
{
	return date('Y-m-d H:i:s');
}

function ajax()
{
	$ci = &get_instance();
	if (!$ci->input->is_ajax_request()) {
		response([
			'status' => false,
			'message' => 'Forbidden',
		], 403);
	}
}

function totalSegments()
{
	$ci = &get_instance();

	return $ci->uri->total_segments();
}

function segment($segment)
{
	$ci = &get_instance();

	return $ci->uri->segment($segment);
}

function formatTanggal($tanggal)
{
	$bulan = array(
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);

	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun

	return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}

function refKabupatenKota($kode_kabupaten_kota = null)
{
	$ci = &get_instance();
	$ci->db->select('*');
	$ci->db->from('ref_kabupaten_kota');

	if ($kode_kabupaten_kota) $ci->db->like('kode_bersih', $kode_kabupaten_kota, 'after');
	if (get('search')) $ci->db->like('nama', get('search'));
	return $ci->db->get()->result();
}

function refKecamatan($kode_kabupaten_kota = null, $kode_kecamatan = null)
{
	$ci = &get_instance();
	$ci->db->select('*');
	$ci->db->from('ref_kecamatan');

	if ($kode_kabupaten_kota) $ci->db->like('kode_bersih', $kode_kabupaten_kota, 'after');
	if ($kode_kecamatan) $ci->db->like('kode_bersih', $kode_kecamatan, 'after');
	if (get('kode_kabupaten_kota') || $kode_kabupaten_kota) $ci->db->like('kode_bersih', ($kode_kabupaten_kota ?? get('kode_kabupaten_kota')), 'after');
	if (get('search')) $ci->db->like('nama', get('search'));
	return $ci->db->get()->result();
}

function refKelurahan($kode_kabupaten_kota = null, $kode_kecamatan = null, $kode_kelurahan = null)
{
	$ci = &get_instance();
	$ci->db->select('*');
	$ci->db->from('ref_kelurahan');

	if ($kode_kabupaten_kota) $ci->db->like('kode_bersih', $kode_kabupaten_kota, 'after');
	if ($kode_kelurahan) $ci->db->like('kode_bersih', $kode_kelurahan, 'after');
	if (get('kode_kabupaten_kota') || $kode_kabupaten_kota) $ci->db->like('kode_bersih', ($kode_kabupaten_kota ?? get('kode_kabupaten_kota')), 'after');
	if (get('kode_kecamatan') || $kode_kecamatan) $ci->db->like('kode_bersih', ($kode_kecamatan ?? get('kode_kecamatan')), 'after');
	if (get('search')) $ci->db->like('nama', get('search'));
	return $ci->db->get()->result();
}

function recaptchaDisplay()
{
	$ci = &get_instance();
	return $ci->recaptcha->create_box();
}

function recaptchaRenderJs()
{
	return '<script src="https://www.google.com/recaptcha/api.js"></script>';
}

function csrf()
{
	$ci = &get_instance();

	return  [
		'token_name' => $ci->security->get_csrf_token_name(),
		'hash' => $ci->security->get_csrf_hash(),
	];
}

function uploadFile($name, $path, $encrypt_name = TRUE, $file_type = 'gif|jpg|png|jpeg|doc|docx|pdf|xls|xlsx|txt|psd|ai')
{
	$CI = &get_instance();
	$CI->load->library('upload');

	if (!file_exists($path)) {
		mkdir($path, 0775, true);
	}

	$realName = @$_FILES[$name]['name'];
	$_FILES[$name]['name'] = date('YmdHis') . '-' . @$_FILES[$name]['name'];

	$config = [
		'upload_path' => "$path",
		'allowed_types' => $file_type,
		'encrypt_name' => $encrypt_name,
	];

	$CI->upload->initialize($config);
	if (@$CI->upload->do_upload($name)) {
		return (object) [
			'status' => true,
			'data' => [
				'path' => $path . '/' . $CI->upload->data("file_name"),
				'real_name' => $realName,
				'name' => $CI->upload->data("file_name"),
				'type' => $CI->upload->data("file_type"),
				'size' => $CI->upload->data("file_size"),
				'ext' => $CI->upload->data("file_ext"),
			]
		];
	}

	response([
		'status' => false,
		'message' => $CI->upload->display_errors('', ''),
		"payload" => [
			'postFields' => post(),
			'files' => $_FILES
		],
		"csrf" => csrf(),
	], 404);
}

function uploadFileMultiple($name, $path)
{
	$upload = [];

	$length = count($_FILES[$name]['name']);
	for ($i = 0; $i < $length; $i++) {
		if (@$_FILES[$name]['name'][$i]) {
			$_FILES['file']['name'] = $_FILES[$name]['name'][$i];
			$_FILES['file']['type'] = $_FILES[$name]['type'][$i];
			$_FILES['file']['tmp_name'] = $_FILES[$name]['tmp_name'][$i];
			$_FILES['file']['error'] = $_FILES[$name]['error'][$i];
			$_FILES['file']['size'] = $_FILES[$name]['size'][$i];
			$upload[] = uploadFile('file', $path);
		}
	}
	return $upload;
}


function minifier($code)
{
	$search = array(

		// Remove whitespaces after tags
		'/\>[^\S ]+/s',

		// Remove whitespaces before tags
		'/[^\S ]+\</s',

		// Remove multiple whitespace sequences
		'/(\s)+/s',

		// Removes comments
		'/<!--(.|\s)*?-->/'
	);
	$replace = array('>', '<', '\\1');
	$code = preg_replace($search, $replace, $code);
	return $code;
}

function encode_id($id_)
{
    return substr(md5($id_), 0, 20) . $id_ . substr(md5($id_), 20, 12);
}

function decode_id($id_)
{
    return substr($id_, 20, strlen($id_) - 32);
}


function link_file($id, $table, $d = null){
    $CI = &get_instance();
    $file = $CI->db->from($table)->where('id',$id)->get()->row();
    if (@$file->file_path) {
        $url = explode('uploads',$file->file_path)[1];
        if ($d == 'd') {
            return base_url().'/uploads'.$url.$file->file_name;
        }else{
            return 'https://view.officeapps.live.com/op/embed.aspx?src='.base_url().'/uploads'.$url.$file->file_name;
        }
    }else{
        return "";
    }
}

function extractCommonWords($string){
      $stopWords = array('i','a','about','an','and','are','as','at','be','by','com','de','en','for','from','how','in','is','it','la','of','on','or','that','the','this','to','was','what','when','where','who','will','with','und','the','www', 'no', 'tahun', 'untuk', 'dalam', 'tentang', 'dan', 'di', 'atas', 'th', 'dimana', 'kapan', 'sampai', 'siapa', 'dari', 'melalui', 'terhadap', 'bagi', '0', 'o', 'sebuah','nya', 'memperoleh', 'teks');
   
      $string = preg_replace('/\s\s+/i', '', $string); // replace whitespace
      $string = trim($string); // trim the string
      $string = preg_replace('/[^a-zA-Z0-9 -]/', '', $string); // only take alphanumerical characters, but keep the spaces and dashes too…
      $string = strtolower($string); // make it lowercase
   
      preg_match_all('/\b.*?\b/i', $string, $matchWords);
      $matchWords = $matchWords[0];
      
      foreach ( $matchWords as $key=>$item ) {
          if ( $item == '' || in_array(strtolower($item), $stopWords) || strlen($item) <= 3 ) {
              unset($matchWords[$key]);
          }
      }   
      $wordCountArr = array();
      if ( is_array($matchWords) ) {
          foreach ( $matchWords as $key => $val ) {
              $val = strtolower($val);
              if ( isset($wordCountArr[$val]) ) {
                  $wordCountArr[$val]++;
              } else {
                  $wordCountArr[$val] = 1;
              }
          }
      }
      arsort($wordCountArr);
      $wordCountArr = array_slice($wordCountArr, 0, 10);
      return $wordCountArr;
}
 function get_date($datetime = null){
	if ($datetime) {
		$str = $datetime;
$dates = explode(' ', $str);
$dat = $dates[0];
$time = $dates[1];
return $dat;
	}else{
		return null;
	}
 }