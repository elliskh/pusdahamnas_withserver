<?php
class Template
{
	protected $_ci;
	function __construct()
	{
		$this->_ci = &get_instance();
		$this->role = $this->_ci->session->userdata('role');
	}

	function display($view, $data = null)
	{
		if (empty($view['title'])) {
			$data['_title'] = "";
		} else {
			$data['_title'] = $view['title'];
		}
		if (empty($view['sub_title'])) {
			$data['_sub_title'] = "";
		} else {
			$data['_sub_title'] = $view['sub_title'];
		}

		$data['_head'] = $this->_ci->load->view('templates/header', $data, true);
		$data['_sidebar'] = $this->_ci->load->view('templates/sidebar', $data, true);
		$data['_content'] = $this->_ci->load->view($view['content'], $data, true);
		$data['_foot'] = $this->_ci->load->view('templates/footer', $data, true);

		$this->_ci->load->view('/templates/template.php', $data);
	}

	function display_front($view, $data = null)
	{
		if (empty($view['title'])) {
			$data['_title'] = "";
		} else {
			$data['_title'] = $view['title'];
		}
		if (empty($view['sub_title'])) {
			$data['_sub_title'] = "";
		} else {
			$data['_sub_title'] = $view['sub_title'];
		}

		if (empty($view['js'])) {
			$data['_js'] = "";
		} else {
			$data['_js'] = $this->_ci->load->view($view['js'], $data, true);
		}

		if (empty($view['css'])) {
			$data['_css'] = "";
		} else {
			$data['_css'] = $this->_ci->load->view($view['css'], $data, true);
		}

		$data['_head'] = $this->_ci->load->view('/templates_front/head', $data, true);
		$data['_header'] = $this->_ci->load->view('/templates_front/header', $data, true);
		$data['_content'] = $this->_ci->load->view($view['content'], $data, true);
		$data['_footer'] = $this->_ci->load->view('/templates_front/footer', $data, true);

		//$data['_script'] = $this->_ci->load->view('/templates_front/script', $data, true);

		$this->_ci->load->view('/templates_front/template', $data);
	}

	function display_front_en($view, $data = null)
	{
		if (empty($view['title'])) {
			$data['_title'] = "";
		} else {
			$data['_title'] = $view['title'];
		}
		if (empty($view['sub_title'])) {
			$data['_sub_title'] = "";
		} else {
			$data['_sub_title'] = $view['sub_title'];
		}

		if (empty($view['js'])) {
			$data['_js'] = "";
		} else {
			$data['_js'] = $this->_ci->load->view($view['js'], $data, true);
		}

		if (empty($view['css'])) {
			$data['_css'] = "";
		} else {
			$data['_css'] = $this->_ci->load->view($view['css'], $data, true);
		}

		$data['_head'] = $this->_ci->load->view('/templates_front/head', $data, true);
		$data['_header'] = $this->_ci->load->view('/templates_front/header_en', $data, true);
		$data['_content'] = $this->_ci->load->view($view['content'], $data, true);
		$data['_footer'] = $this->_ci->load->view('/templates_front/footer_en', $data, true);

		//$data['_script'] = $this->_ci->load->view('/templates_front/script', $data, true);

		$this->_ci->load->view('/templates_front/template', $data);
	}
}
