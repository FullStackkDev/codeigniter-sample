<?php
		$rules['client_id'] = 'trim|required|htmlspecialchars|numeric';
		$rules['first_name'] = 'trim|required|htmlspecialchars|max_length[25]';
		$rules['last_name'] = 'trim|required|htmlspecialchars|max_length[25]';
		$rules['email'] = 'trim|required|htmlspecialchars|max_length[50]|valid_email';
		$rules['phone'] = 'trim|htmlspecialchars|max_length[20]';
		$this->validation->set_rules($rules);
		
		$fields['client_id'] = $this->lang->line('clients_id');
		$fields['first_name'] =  $this->lang->line('clients_first_name');
		$fields['last_name'] =  $this->lang->line('clients_last_name');
		$fields['email'] =  $this->lang->line('clients_email');
		$fields['phone'] =  $this->lang->line('clients_phone');
		$this->validation->set_fields($fields);

		$this->validation->set_error_delimiters('<span class="error">', '</span>');
?>