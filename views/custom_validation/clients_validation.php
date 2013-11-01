<?php
		$rules['clientName'] = 'trim|required|max_length[75]|htmlspecialchars';
		$rules['website'] = 'trim|htmlspecialchars|max_length[150]';
		$rules['address1'] = 'trim|htmlspecialchars|max_length[100]';
		$rules['address2'] = 'trim|htmlspecialchars|max_length[100]';
		$rules['city'] = 'trim|htmlspecialchars|max_length[50]';
		$rules['province'] = 'trim|htmlspecialchars|max_length[25]';
		$rules['country'] = 'trim|htmlspecialchars|max_length[25]';
		$rules['postal_code'] = 'trim|htmlspecialchars|max_length[10]';
		$rules['tax_status'] = 'trim|htmlspecialchars|exact_length[1]|numeric|required';
		$this->validation->set_rules($rules);

		$fields['clientName'] = $this->lang->line('clients_name');
		$fields['website'] = $this->lang->line('clients_website');
		$fields['address1'] = $this->lang->line('clients_address1');
		$fields['address2'] = $this->lang->line('clients_address2');
		$fields['city'] = $this->lang->line('clients_cityt');
		$fields['province'] = $this->lang->line('clients_province');
		$fields['country'] = $this->lang->line('clients_country');
		$fields['postal_code'] = $this->lang->line('clients_postal');
		$fields['tax_status'] = $this->lang->line('invoice_tax_status');
		$this->validation->set_fields($fields);

		$this->validation->set_error_delimiters('<span class="error">', '</span>');
?>