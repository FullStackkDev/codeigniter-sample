<?php

class Clients extends Controller {

	function __construct()
	{
		parent::Controller();
		if (!$this->site_sentry->is_logged_in()) {redirect('login/');exit;}
		$this->load->helper('date');
		$this->load->library('validation');
		$this->load->model('clients_model');
	}

	function index()
	{	
		$data['clientList'] = $this->clients_model->getAllClients(); // activate the option
		$data['extraHeadContent'] = "<link type=\"text/css\" rel=\"stylesheet\" href=\"" . base_url()."css/clients.css\" />\n";
		$data['extraHeadContent'] .= "<script type=\"text/javascript\" src=\"" . base_url()."js/newinvoice.js\"></script>\n";
		$data['extraHeadContent'] .= "<script type=\"text/javascript\" src=\"" . base_url()."js/clients.js\"></script>\n";

		if ($this->session->flashdata('clientEdit')) {
			$data['msg'] = '<p class="error topmessage">' . $this->lang->line('clients_edited') . "</p>\n";
			$data['extraHeadContent'] .= "<script type=\"text/javascript\">\nfunction openCurrent() {\n\tEffect.toggle ('clientInfo".$this->session->flashdata('clientEdit')."', 'Blind', {duration:'0.4'});\n}\naddEvent (window, 'load', openCurrent);\n</script>";
		} else {
			$data['msg'] = '<p class="error">' . $this->session->flashdata('message') . "</p>\n";
		}
		
		$data['total_rows'] = $this->clients_model->countAllClients();
		
		// Run the limited version of the query
		$data['all_clients'] = $this->clients_model->getAllClients();

		// validation info for id, first_name, last_name, email, phone
		$this->load->view('custom_validation/clients_contact_validation', '', FALSE);

		$data['page_title'] = $this->lang->line('menu_clients');
		$this->load->view('clients/index', $data);
	}
	
	function newclient()
	{
		// if the client already exists, then the post var client_id will come through
		if ($this->input->post('client_id')) {
			$this->session->set_flashdata('clientId', $this->input->post('client_id'));
			redirect('invoices/newinvoice/');
			exit;
		} elseif ($this->input->post('newClient')) {
			$this->session->set_flashdata('clientName', $this->input->post('newClient'));
		}
	
		$data['clientName'] = $this->input->post('newClient'); // store the name provided in a var

		/**
		* There is a bug on this page where it is passing validation when the user first loads
		* it.  As a quick workaround, I'm detecting if they came from the new invoice form with
		* the hidden form variable "newInvoice" from /includes/invoice_new.php
		*/
		$newinv = $this->input->post('newInvoice');
		/**
		* ugh... sorry
		*/

		$this->load->view('custom_validation/clients_validation.php', '', FALSE); // field validation

		if ($this->validation->run() == FALSE || $newinv != '') {
			$data['page_title'] = $this->lang->line('clients_create_new_client');
			$this->load->view('clients/newclient', $data);
		} else {
			// capture information for inserting a new client
			$clientInfo = array(
				'name' => $this->input->post('clientName'),
				'address1' => $this->input->post('address1'),
				'address2' => $this->input->post('address2'),
				'city' => $this->input->post('city'),
				'province' => $this->input->post('province'),
				'country' => $this->input->post('country'),
				'postal_code' => $this->input->post('postal_code'),
				'website' => $this->input->post('website'),
				'tax_status' => $this->input->post('tax_status')
			);

			// make insertion, grab insert_id
			if ($this->clients_model->addClient($clientInfo)) {
				$this->session->set_flashdata('clientId', $this->db->insert_id());
				$this->session->set_flashdata('clientContact', TRUE);
			} else {
				die ($this->lang->line('error_problem_inserting'));
			}
			
			if ($this->session->flashdata('clientName')) {
				redirect('invoices/newinvoice/');
				exit;
			} else {
				// return to clients page
				$this->session->set_flashdata('message', $this->lang->line('clients_created'));
				redirect('clients/');
				exit;
			}
		}
	}

	function edit()
	{
		$this->load->view('custom_validation/clients_validation.php', '', FALSE); // field validation

		if ($this->validation->run() == FALSE) {
			$cid = (int) $this->input->post('id');
			($cid)?$data['id']=$cid:$data['id']=(int) $this->uri->segment(3);

			$data['row'] = $this->clients_model->getAllClientInfo($data['id']);

			$data['page_title'] = $this->lang->line('clients_edit_client');
			$this->load->view('clients/edit', $data);
		} else {
			$clientInfo = array(
				'id' => (int) $this->input->post('id'),
				'name' => $this->input->post('clientName'),
				'address1' => $this->input->post('address1'),
				'address2' => $this->input->post('address2'),
				'city' => $this->input->post('city'),
				'province' => $this->input->post('province'),
				'country' => $this->input->post('country'),
				'postal_code' => $this->input->post('postal_code'),
				'website' => $this->input->post('website'),
				'tax_status' => $this->input->post('tax_status')
			);
			$this->clients_model->updateClient($clientInfo['id'], $clientInfo);
			$this->session->set_flashdata('clientEdit', $clientInfo['id']);
			redirect('clients/');
			exit;
		}
	}

	function delete() {
		$client_id = (int) $this->uri->segment(3);

		// get number of invoices for when we ask if they are sure they want to remove this client
		$data['numInvoices'] = $this->clients_model->countClientInvoices($client_id);

		$this->session->set_flashdata('deleteClient', $client_id);
		$data['deleteClient'] = $client_id;

		$data['page_title'] = $this->lang->line('clients_delete_client');
		$this->load->view('clients/delete', $data);
	}
	
	function delete_confirmed() {
		$client_id = (int) $this->session->flashdata('deleteClient');

		if ($this->clients_model->deleteClient($client_id)) {
			$this->session->set_flashdata('message', $this->lang->line('clients_deleted'));
			redirect('clients/');
			exit;
		} else {
			$this->session->set_flashdata('message', $this->lang->line('clients_deleted_error'));
			redirect('clients/');
			exit;
		}
	}

	function callback1($str)
	{
		if ($str == 'a') {
			return false;
		} else {
			return 'foo';
		}
	}
	
	function _allhtmlentities($string) {
		if ( strlen($string) == 0 )
			return $string;
		$result = '';
		$string = htmlentities($string, ENT_QUOTES);
		$string = preg_split("//", $string, -1, PREG_SPLIT_NO_EMPTY);
		$ord = 0;
		for ( $i = 0; $i < count($string); $i++ ) {
			$ord = ord($string[$i]);
			if ( $ord > 127 ) {
				$string[$i] = '&#' . $ord . ';';
			}
		}
//		return implode('',$string);
		return 'foo';
	}
}
?>