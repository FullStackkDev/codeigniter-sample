<?php

class Logout extends Controller {

	function __construct()
	{
		parent::Controller();
		if (!$this->site_sentry->is_logged_in()) {redirect('login');exit;}
	}
	
	function index()
	{
		$data['page_title'] = $this->lang->line('login_logout');
		$this->load->view('logout/index', $data);
	}

	function logout_routine()
	{
		$this->session->sess_destroy();
		redirect('logout');
		exit;
	}

	function confirm()
    {
		$data['page_title'] = $this->lang->line('login_logout');
		$this->load->view('logout/logout_confirm', $data);
    }
	
}
?>