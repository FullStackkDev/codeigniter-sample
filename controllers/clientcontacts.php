<?php

class Clientcontacts extends Controller {

	function __construct()
	{
		parent::Controller();
		if (!$this->site_sentry->is_logged_in()) {redirect('login/');exit;}
		$this->load->library('validation');
		$this->load->helper('ajax');
		$this->load->model('clientcontacts_model');
	}

	function index()
	{
		/**
		 * This controller is only used from the clients controller, ans so is called directly.
		 * If anyone access it directly, let's just move them over to clients.
		 */
		redirect('clients/');
		exit;
	}

	function add()
	{
		// validation info for id, first_name, last_name, email, phone
		$this->load->view('custom_validation/clients_contact_validation', '', FALSE);

		if ($this->validation->run() == FALSE) {
			if (isAjax()) {
				echo $this->lang->line('clients_new_contact_fail');
			} else {
				$cid = (int) $this->input->post('client_id');
				($cid)?$data['client_id']=$cid:$data['client_id']=(int) $this->uri->segment(3);
				$data['page_title'] = $this->lang->line('clients_add_contact');
				$this->load->view('clientcontacts/add', $data);
			}
		} else {
			$client_id = $this->clientcontacts_model->addClientContact((int) $this->input->post('client_id'), $this->input->post('first_name'), $this->input->post('last_name'), $this->input->post('email'), $this->input->post('phone'));
			if (isAjax()) {
				echo $client_id;
			} else {
				$this->session->set_flashdata('clientContact', (int) $this->input->post('client_id'));
				redirect('clients/');
			}		
		}
	}

	function edit()
	{
		$rules['id'] = 'trim|required|numeric';
		$fields['id'] = 'id';
		// validation info for id, first_name, last_name, email, phone
		$this->load->view('custom_validation/clients_contact_validation', '', FALSE);

		$data['id'] = (int) $this->uri->segment(3, $this->input->post('id'));

		if ($this->validation->run() == FALSE) {
			$data['clientContactData'] = $this->clientcontacts_model->getContactInfo($data['id']);
			$data['page_title'] = $this->lang->line('clients_edit_contact');
			$this->load->view('clientcontacts/edit', $data);
		} else {
			$this->clientcontacts_model->editClientContact(
				$this->input->post('id'), 
				(int) $this->input->post('client_id'), 
				$this->input->post('first_name'), 
				$this->input->post('last_name'), 
				$this->input->post('email'), 
				$this->input->post('phone')
			);
			$this->session->set_flashdata('message', $this->lang->line('clients_edited_contact_info'));
			redirect('clients/');
			exit;
		}
	}

	function delete()
	{
		($this->input->post('id'))?$id=(int) $this->input->post('id'):$id=(int) $this->uri->segment(3);
		
		if ($this->clientcontacts_model->deleteClientContact($id)) {
			if (isAjax()) {
				return $id;
			} else {
				$this->session->set_flashdata('clientContact', $id);
				redirect('clients/');
				exit;
			}
		} else {
			$this->session->set_flashdata('message', $this->lang->line('clients_contact_delete_fail'));
			redirect('clients/');
			exit;
		}
	}
	
}
?>