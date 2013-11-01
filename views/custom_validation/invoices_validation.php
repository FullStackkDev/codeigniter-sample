<?php
		$rules['client_id'] = 'required|numeric';
		$rules['invoiceNumber'] = 'trim|required|htmlspecialchars|max_length[12]|alpha_dash|callback_uniqueInvoice';
		$rules['dateIssued'] = 'trim|htmlspecialchars|callback_dateIssued';
		$rules['invoice_note'] = 'trim|htmlspecialchars|max_length[255]';
		$rules['tax1_description'] = 'trim|htmlspecialchars|max_length[50]';
		$rules['tax1_rate'] = 'trim|htmlspecialchars';
		$rules['tax2_description'] = 'trim|htmlspecialchars|max_length[50]';
		$rules['tax2_rate'] = 'trim|htmlspecialchars';
		$this->validation->set_rules($rules);
		
		$fields['client_id'] = $this->lang->line('invoice_client_id');
		$fields['invoiceNumber'] = $this->lang->line('invoice_number');
		$fields['dateIssued'] = $this->lang->line('invoice_date_issued');
		$fields['invoice_note'] = $this->lang->line('invoice_note');
		$fields['tax1_description'] = $this->settings_model->getSetting('tax1_desc');
		$fields['tax1_rate'] = $this->settings_model->getSetting('tax1_rate');
		$fields['tax2_description'] = $this->settings_model->getSetting('tax1_desc');
		$fields['tax2_rate'] = $this->settings_model->getSetting('tax2_rate');
		$this->validation->set_fields($fields);

		$this->validation->set_error_delimiters('<span class="error">', '</span>');

?>