<?php

class Help extends Controller {

	function __construct()
	{
		parent::Controller();
	}

	function index()
	{
		$data['page_title'] =  $this->lang->line('menu_help');
		$this->load->view('help/index', $data);
	}

}
?>