<?php

class Changelog extends Controller {

	function __construct()
	{
		parent::Controller();
	}

	function index()
	{
		$data['page_title'] = $this->lang->line('menu_changelog');
		$this->load->view('changelog/index', $data);
	}

}
?>