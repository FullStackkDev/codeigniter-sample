<?php

class Front extends Controller {

	function __construct()
	{
		parent::Controller();
		$this->load->model('clients_model');

	}

	function index()
	{
		if (!$this->db->simple_query("SELECT * FROM settings")){
			// Its possible the system isn't installed yet.  If it isn't
			// then this will kick in, and ask the user to install
			echo 'BambooInvoice does not appear to be installed.';
			echo anchor ('install', 'You can install it now') . '.';
			exit;
		}
	
		if ($this->site_sentry->is_logged_in()) {
			$data['page_title'] = $this->lang->line('menu_root_system');
			$data['extraHeadContent'] = "<script type=\"text/javascript\" src=\"" . base_url()."js/newinvoice.js\"></script>\n";

			// for the new invoice generation dropdown
			$data['clientList'] = $this->clients_model->getAllClients();;
			$this->load->view('index/index_logged_in', $data);
		} else {
			if ($this->settings_model->getSetting('demo_flag') == 'y') {
				// for the demo, load the page that describes Bamboo, but if 
				// this isn't the demo, then move the user to the login page
				$data['page_title'] = $this->lang->line('menu_catchphrase_nobreak');
				$this->load->view('index/index_logged_out', $data);
			} else {
				redirect('login');
				exit;
			}
		}
	}
	
}
?>