<?php

class Settings extends Controller {

	function __construct()
	{
		parent::Controller();
		if (!$this->site_sentry->is_logged_in()) {redirect('login/');exit;}
		$this->load->library('validation');
	}	
	
	function index()
	{
		$this->load->view('custom_validation/settings_validation', '', FALSE);
		$data['extraHeadContent'] = "<script type=\"text/javascript\" src=\"". base_url()."js/glider.js\"></script>\n";
		$data['extraHeadContent'] .= "<script type=\"text/javascript\" src=\"". base_url()."js/settings.js\"></script>\n";
		$data['extraHeadContent'] .= "<link type=\"text/css\" rel=\"stylesheet\" href=\"". base_url()."css/settings.css\" />\n";

		if ($this->input->post('lang')) {
			$data['validationStatus'] = TRUE;
		}
		
		if ($this->validation->run() == FALSE) {
			// grab existing prefs
			$data['query'] = $this->db->get('settings');
			$data['page_title'] = $this->lang->line('menu_settings');
			$data['msg'] = '<p class="error">' . $this->session->flashdata('status') . '</p>';
			$this->load->view('settings/index', $data);
		} else {
		
			// a workaround for supporting of "€"
			($this->input->post('currency_symbol') == "€")?$currency_symbol="&#0128;":$currency_symbol=$this->input->post('currency_symbol');
			($this->input->post('save_invoices') == 'y')?$save_invoices='y':$save_invoices='n';
		
			$data = array(
				'company_name' => $this->input->post('company_name'),
				'address1' => $this->input->post('address1'),
				'address2' => $this->input->post('address2'),
				'city' => $this->input->post('city'),
				'province' => $this->input->post('province'),
				'country' => $this->input->post('country'),
				'postal_code' => $this->input->post('postal_code'),
				'website' => $this->input->post('website'),
				'primary_contact' => $this->input->post('primary_contact'),
				'primary_contact_email' => $this->input->post('primary_contact_email'),
				'logo' => $this->input->post('logo'),
				'invoice_note_default' => $this->input->post('invoice_note_default'),
				'currency_type' => $this->input->post('currency_type'),
				'currency_symbol' => $currency_symbol,
				'days_payment_due' => (int) $this->input->post('days_payment_due'),
				'tax_code' => $this->input->post('tax_code'),
				'tax1_desc' => $this->input->post('tax1_desc'),
				'tax1_rate' => $this->input->post('tax1_rate'),
				'tax2_desc' => $this->input->post('tax2_desc'),
				'tax2_rate' => $this->input->post('tax2_rate'),
				'save_invoices' => $save_invoices,
				'display_branding' => $this->input->post('display_branding')
			);
			$this->db->where('id', '1');

			if ($this->db->update('settings', $data)) {
				$data['query'] = $this->db->get('settings');
				$this->session->set_flashdata('status', $this->lang->line('settings_modifys_success'));
			} else {
				$this->session->set_flashdata('status', $this->lang->line('settings_modifys_fail'));
			}

			// running a redirect here instead of a view because glider.js seems to freeze without the reload
			redirect('settings');
			exit;
		}
	}
	
}
?>