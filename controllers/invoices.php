<?php

class Invoices extends Controller {

	function __construct()
	{
		parent::Controller();
		if (!$this->site_sentry->is_logged_in()) {redirect('login/');exit;}
		$this->lang->load('calendar');
		$this->load->helper('date');
		$this->load->helper('text');
		$this->load->helper('typography');
		$this->load->library('pagination');
		$this->load->model('invoices_model');
		$this->load->model('clients_model');
	}

	function index()
	{

		$data['clientList'] = $this->clients_model->getAllClients(); // activate the option
		$data['extraHeadContent'] = "<script type=\"text/javascript\" src=\"". base_url()."js/newinvoice.js\"></script>\n";
		$data['extraHeadContent'] .= "<script type=\"text/javascript\" src=\"". base_url()."js/search.js\"></script>\n";
		$data['extraHeadContent'] .= "<link type=\"text/css\" rel=\"stylesheet\" href=\"". base_url()."css/invoice.css\" />\n";
		$offset = (int) $this->uri->segment(3, 0);
		$data['query'] = $this->invoices_model->getInvoices($offset, 5000, 'open', $this->settings_model->getSetting('days_payment_due'));
				
		$data['total_rows'] = $data['query']->num_rows();
		$data['overdue_count'] = $this->invoices_model->getInvoices(0, 5000, 'overdue', $this->settings_model->getSetting('days_payment_due'))->num_rows();
		
		$data['msg'] = '<p class="error">' . $this->session->flashdata('message') . "</p>\n";
		
		$data['submenu'] = TRUE; // pass submenu
		$data['page_title'] = $this->lang->line('menu_invoices');

		$this->load->view('invoices/index', $data);
	}

	function overdue()
    {
		$data['clientList'] = $this->clients_model->getAllClients(); // activate the option
		$data['extraHeadContent'] = "<script type=\"text/javascript\" src=\"". base_url()."js/newinvoice.js\"></script>\n";
		$data['extraHeadContent'] .= "<link type=\"text/css\" rel=\"stylesheet\" href=\"". base_url()."css/invoice.css\" />\n";
		$data['overdueStatus'] = TRUE; // pass submenu
		
		$offset = (int) $this->uri->segment(3, 0);
		$data['query'] = $this->invoices_model->getInvoices($offset, 20, 'overdue', $this->settings_model->getSetting('days_payment_due'));
		
		$data['total_rows'] = $data['query']->num_rows();
		$config['base_url'] = site_url('invoices/overdue');
		$config['total_rows'] = $this->invoices_model->getInvoices(0, 10000, 'overdue', $this->settings_model->getSetting('days_payment_due'))->num_rows();
		$config['per_page'] = 20;
		$config['first_link'] = '';
		$config['last_link'] = '';
		$config['next_link'] = 'next &gt';
		$config['prev_link'] = 'prev &lt';
		$config['full_tag_open'] = '<p id="pagination">';
		$config['full_tag_close'] = '</p>';
		$config['cur_tag_open'] = ' <strong>';
		$config['cur_tag_close'] = '</strong>';
		$config['num_links'] = 2;
		$this->pagination->initialize($config); 
		$data['pagination'] = $this->pagination->create_links();

		$data['submenu'] = TRUE; // pass submenu
		$data['page_title'] = $this->lang->line('invoice_overdue');
		$this->load->view('invoices/overdue', $data);
    }
	
	function open()
    {
		$data['clientList'] = $this->clients_model->getAllClients(); // activate the option
		$data['extraHeadContent'] = "<script type=\"text/javascript\" src=\"". base_url()."js/newinvoice.js\"></script>\n";
		$data['extraHeadContent'] .= "<link type=\"text/css\" rel=\"stylesheet\" href=\"". base_url()."css/invoice.css\" />\n";
				
		$offset = (int) $this->uri->segment(3, 0);
		$data['query'] = $this->invoices_model->getInvoices($offset, 20, 'open', $this->settings_model->getSetting('days_payment_due'));
		
		$data['total_rows'] = $data['query']->num_rows();
		$config['base_url'] = site_url('invoices/open');
		$config['total_rows'] = $this->invoices_model->getInvoices(0, 10000, 'open', $this->settings_model->getSetting('days_payment_due'))->num_rows();
		$config['per_page'] = 20;
		$config['first_link'] = '';
		$config['last_link'] = '';
		$config['next_link'] = 'next &gt';
		$config['prev_link'] = 'prev &lt';
		$config['full_tag_open'] = '<p id="pagination">';
		$config['full_tag_close'] = '</p>';
		$config['cur_tag_open'] = ' <strong>';
		$config['cur_tag_close'] = '</strong>';
		$config['num_links'] = 2;
		$this->pagination->initialize($config); 
		$data['pagination'] = $this->pagination->create_links();

		$data['submenu'] = TRUE; // pass submenu
		$data['page_title'] = $this->lang->line('invoice_open');
		$this->load->view('invoices/open', $data);
    }

	function closed()
    {
		$data['clientList'] = $this->clients_model->getAllClients(); // activate the option
		$data['extraHeadContent'] = "<script type=\"text/javascript\" src=\"". base_url()."js/newinvoice.js\"></script>\n";
		$data['extraHeadContent'] .= "<link type=\"text/css\" rel=\"stylesheet\" href=\"". base_url()."css/invoice.css\" />\n";
				
		$offset = (int) $this->uri->segment(3, 0);
		$data['query'] = $this->invoices_model->getInvoices($offset, 20, 'closed', $this->settings_model->getSetting('days_payment_due'));
	
		$data['total_rows'] = $data['query']->num_rows();
		$config['base_url'] = site_url('invoices/closed');
		$config['total_rows'] = $this->invoices_model->getInvoices(0, 10000, 'closed')->num_rows();
		$config['per_page'] = 20;
		$config['first_link'] = '';
		$config['last_link'] = '';
		$config['next_link'] = 'next &gt';
		$config['prev_link'] = 'prev &lt';
		$config['full_tag_open'] = '<p id="pagination">';
		$config['full_tag_close'] = '</p>';
		$config['cur_tag_open'] = ' <strong>';
		$config['cur_tag_close'] = '</strong>';
		$config['num_links'] = 2;
		$this->pagination->initialize($config); 
		$data['pagination'] = $this->pagination->create_links();
				
		$data['submenu'] = TRUE; // pass submenu
		$data['page_title'] = $this->lang->line('invoice_closed');
		$this->load->view('invoices/closed', $data);
    }
	
	function all()
    {
		$data['clientList'] = $this->clients_model->getAllClients(); // activate the option
		$data['extraHeadContent'] = "<script type=\"text/javascript\" src=\"". base_url()."js/newinvoice.js\"></script>\n";
		$data['extraHeadContent'] .= "<link type=\"text/css\" rel=\"stylesheet\" href=\"". base_url()."css/invoice.css\" />\n";
		
		$offset = (int) $this->uri->segment(3, 0);
		$data['query'] = $this->invoices_model->getInvoices($offset, 20, 'all');
		$data['total_rows'] = $data['query']->num_rows();
		$config['base_url'] = site_url('invoices/all');
		$config['total_rows'] = $this->invoices_model->getInvoices(0, 10000, 'all')->num_rows();
		$config['per_page'] = 20;
		$config['first_link'] = '';
		$config['last_link'] = '';
		$config['next_link'] = 'next &gt';
		$config['prev_link'] = 'prev &lt';
		$config['full_tag_open'] = '<p id="pagination">';
		$config['full_tag_close'] = '</p>';
		$config['cur_tag_open'] = ' <strong>';
		$config['cur_tag_close'] = '</strong>';
		$config['num_links'] = 2;
		$this->pagination->initialize($config); 
		$data['pagination'] = $this->pagination->create_links();
		
		$data['submenu'] = TRUE; // pass submenu
		$data['page_title'] = $this->lang->line('invoice_all_invoices');
		$this->load->view('invoices/all', $data);
    }

	function recalculate_items()
	{
		$amount = 0;
		$tax1_amount = 0;
		$tax2_amount = 0;
	
		$items = $this->input->post('items');
		$tax1_rate = $this->input->post('tax1_rate');
		$tax2_rate = $this->input->post('tax2_rate');

		foreach ($items as $item) {
			(isset($item['taxable']) && $item['taxable'] == 1)?$taxable=1:$taxable=0;
//			if (isset($item['taxable']) && $item['taxable'] == 1) {
				$amount += $item['quantity'] * $item['amount'];
				$tax1_amount += $item['quantity'] * $item['amount'] * (($tax1_rate)/100) * $taxable;
				$tax2_amount += $item['quantity'] * $item['amount'] * (($tax2_rate)/100) * $taxable;
//			}
		}
		echo '{"amount" : "' . number_format($amount, 2, '.', '') . '", "tax1_amount" : "' . number_format($tax1_amount, 2, '.', '') . '", "tax2_amount" : "' . number_format($tax2_amount, 2, '.', '') . '", "total_amount" : "' . number_format($amount + $tax1_amount+$tax2_amount, 2, '.', '') . '"}';
	}

	function newinvoice()
	{
		$this->load->library('validation');
		$this->load->plugin('js_calendar');

		// check if it came from a post, or has a session of clientId
		$id = $this->session->flashdata('clientId');
		$newName = $this->input->post('newClient');
		
		if (!isset($id)) {
			// if they don't already have a client id, then they need to create the
			// client first, so send them off to do that
			$this->session->set_flashdata('clientName', $newName);
			redirect('clients/newclient');
			exit;
		}

		$data['row'] = $this->clients_model->getAllClientInfo($id); // used to extract name, id and tax info
		
		$data['tax1_desc'] = $this->settings_model->getSetting('tax1_desc');
		$data['tax1_rate'] = $this->settings_model->getSetting('tax1_rate');
		$data['tax2_desc'] = $this->settings_model->getSetting('tax2_desc');
		$data['tax2_rate'] = $this->settings_model->getSetting('tax2_rate');
		$data['invoice_note_default'] = $this->settings_model->invoice_note_default();

		$last_invoice_number = $this->invoices_model->lastInvoiceNumber();
		($last_invoice_number != '')?$data['lastInvoiceNumber'] = $last_invoice_number:$data['lastInvoiceNumber'] = '';
		(is_numeric($last_invoice_number))?$data['suggested_invoice_number']=$last_invoice_number+1:$data['suggested_invoice_number'] = '';

		$data['extraHeadContent'] = "<link type=\"text/css\" rel=\"stylesheet\" href=\"". base_url()."css/calendar.css\" />\n";
		$data['extraHeadContent'] .= "<link type=\"text/css\" rel=\"stylesheet\" href=\"". base_url()."css/invoice.css\" />\n";
		$data['extraHeadContent'] .= "<script type=\"text/javascript\">\nvar tax1_rate = ". $data['tax1_rate'] .";\nvar tax2_rate = ". $data['tax2_rate'] .";\nvar datePicker1 = \"" . date("Y-m-d") . "\";\nvar datePicker2 = \"" . date("F j, Y") . "\";\n</script>\n";
		$data['extraHeadContent'] .= "<script type=\"text/javascript\" src=\"". base_url()."js/createinvoice.js\"></script>\n";
		$data['extraHeadContent'] .= js_calendar_script('my_form');
		
		$this->load->view('custom_validation/invoices_validation.php', '', FALSE); // field validation

		$data['invoiceDate'] = date("Y-m-d");

		if ($this->validation->run() == FALSE) {
			$this->session->keep_flashdata('clientId');
			$data['invoiceDate'] = $this->validation->dateIssued;
			$data['page_title'] = $this->lang->line('invoice_new_invoice');
			$this->load->view('invoices/newinvoice', $data);
		} else {
			$invoiceData = array(
				'client_id' => $this->input->post('client_id'),
				'invoiceNumber' => $this->input->post('invoiceNumber'),
				'dateIssued' => $this->input->post('dateIssued'),
				'tax1_desc' => $this->input->post('tax1_description'),
				'tax1_rate' => $this->input->post('tax1_rate'),
				'tax2_desc' => $this->input->post('tax2_description'),
				'tax2_rate' => $this->input->post('tax2_rate'),
				'invoice_note' => $this->input->post('invoice_note')
			);
			
			$invoice_id = $this->invoices_model->addInvoice($invoiceData);

			if ($invoice_id > 0) {
				$items = $this->input->post('items');

				$amount = 0;
				foreach ($items as $item) {
					if (isset($item['taxable']) && $item['taxable'] == 1) {
						$taxable = 1;
					} else {
						$taxable = 0;
					}
					$invoiceItems = array(
						'invoice_id' => htmlspecialchars($invoice_id),
						'quantity' => htmlspecialchars($item['quantity']),
						'amount' => htmlspecialchars($item['amount']),
						'work_description' => htmlspecialchars($item['work_description']),
						'taxable' => htmlspecialchars($taxable)
					);
					$this->invoices_model->addInvoiceItem($invoiceItems);
				}
				redirect('invoices/view/' . $invoice_id);
				exit;
			} else {
				// clear clientId session
				$data['page_title'] = $this->lang->line('invoice_new_error');
				$this->load->view('invoices/create_fail', $data);
			}
		}		
	}

	function newinvoice_first()
	{
		// page for users without javascript enabled
		$data['page_title'] = $this->lang->line('menu_new_invoice');
		$this->load->view('invoices/newinvoice_first', $data);
	}

	function view()
	{
		$this->lang->load('date');
		$this->load->plugin('js_calendar');
		$this->load->helper('logo');
		$this->load->helper('file');
		$this->load->library('parser');

		// if this invoice was just emailed edited or paid,
		// make note, then remove session and delete the files
		$data['emailedInvoice'] = $this->session->flashdata('emailedInvoice');
		$data['editedInvoice'] = $this->session->flashdata('editedInvoice');
		$data['invoicePayment'] = $this->session->flashdata('invoicePayment');

		$data['extraHeadContent'] = "<link type=\"text/css\" rel=\"stylesheet\" href=\"". base_url()."css/calendar.css\" />\n";
		$data['extraHeadContent'] .= "<link type=\"text/css\" rel=\"stylesheet\" href=\"". base_url()."css/invoice.css\" />\n";
		$data['extraHeadContent'] .= "<script type=\"text/javascript\" src=\"". base_url()."js/emailinvoice.js\"></script>\n";
		$data['extraHeadContent'] .= "<script type=\"text/javascript\" src=\"". base_url()."js/help.js\"></script>\n";
		$data['extraHeadContent'] .= "<script type=\"text/javascript\">\nvar datePicker1 = \"" . date("Y-m-d") . "\";\nvar datePicker2 = \"" . date("F j, Y") . "\";\n\n</script>";
		$data['extraHeadContent'] .= "<script type=\"text/javascript\" src=\"". base_url()."js/payinvoice.js\"></script>\n";
		$data['extraHeadContent'] .= js_calendar_script('my_form');
		$data['invoiceDate'] = date("Y-m-d");

		$id = (int) $this->uri->segment(3);
		$invoiceInfo = $this->invoices_model->getSingleInvoice($id);		
		
		if ($invoiceInfo->num_rows() == 0) {redirect('invoices/');exit;}	
		$data['row'] = $invoiceInfo->row();

		if ($data['row']->amount_paid >= $data['row']->total_with_tax) { // paid invoices
			$data['status'] = '<span>' . $this->lang->line('invoice_closed') . '</span>';
		} elseif (mysql_to_unix($data['row']->dateIssued) >= strtotime("-30 days")) { // owing less then 30 days
			$data['status'] =  '<span>' . $this->lang->line('invoice_open') . '</span>';
		} else { // owing more then 30 days
			$data['status'] =  '<span class="error">' . timespan(mysql_to_unix($data['row']->dateIssued), now()). ' ' . $this->lang->line('invoice_overdue') . '</span>';
		}

		$data['items'] = $this->invoices_model->getInvoiceItems($id);
		
		// begin amount and taxes
		$data['total_no_tax'] = $this->lang->line('invoice_amount') . ': ' . $this->settings_model->getSetting('currency_symbol') . number_format($data['row']->total_notax, 2, '.', '') . "<br />\n";			
		$data['tax_info'] = '';
		if ($data['row']->total_tax1 > 0) {
			$data['tax_info'] .= $data['row']->tax1_desc . " (" . $data['row']->tax1_rate . "%): " .  $this->settings_model->getSetting('currency_symbol') . number_format($data['row']->total_tax1, 2, '.', '') . "<br />\n";
		}
		if ($data['row']->total_tax2 > 0) {
			$data['tax_info'] .= $data['row']->tax2_desc . " (" . $data['row']->tax2_rate . "%): " . $this->settings_model->getSetting('currency_symbol') . number_format($data['row']->total_tax2, 2, '.', '') . "<br />\n";
		}		
		$data['total_with_tax'] = $this->lang->line('invoice_total') . ': ' . $this->settings_model->getSetting('currency_symbol') . number_format($data['row']->total_with_tax, 2, '.', '');
		// end amount and taxes

		$data['companyInfo'] = $this->settings_model->getCompanyInfo()->row();
		$data['clientContacts'] = $this->clients_model->getClientContacts($data['row']->client_id);

		$data['invoiceHistory'] = $this->invoices_model->getInvoiceHistory($id);
		$data['paymentHistory'] = $this->invoices_model->getInvoicePaymentHistory($id);

		$data['invoiceOptions'] = TRUE; // create invoice options on sidebar

		$data['company_logo'] = get_logo($this->settings_model->getSetting('logo'), FALSE);

		$data['submenu'] = TRUE; // pass submenu
		$data['page_title'] = 'Invoice Details';
		$this->load->view('invoices/view', $data);
	}
	
	function edit()
	{
		$this->load->library('validation');
		$this->load->plugin('js_calendar');
		
		$id = (int) $this->uri->segment(3);
		$invoiceInfo = $this->invoices_model->getSingleInvoice($id);		
		$data['row'] = $invoiceInfo->row();

		$data['extraHeadContent'] = "<link type=\"text/css\" rel=\"stylesheet\" href=\"". base_url()."css/calendar.css\" />\n";
		$data['extraHeadContent'] .= "<script type=\"text/javascript\">\nvar tax1_rate = ". $data['row']->tax1_rate .";\nvar tax2_rate = ". $data['row']->tax2_rate .";\nvar datePicker1 = \"" . date("Y-m-d", mysql_to_unix($data['row']->dateIssued)) . "\";\nvar datePicker2 = \"" . date("F j, Y", mysql_to_unix($data['row']->dateIssued)) . "\";\n\n</script>";
		$data['extraHeadContent'] .= "<link type=\"text/css\" rel=\"stylesheet\" href=\"". base_url()."css/invoice.css\" />\n";
		$data['extraHeadContent'] .= "<script type=\"text/javascript\" src=\"". base_url()."js/createinvoice.js\"></script>\n";
		$data['extraHeadContent'] .= js_calendar_script('my_form');
		$data['clientListEdit'] = $this->clients_model->getAllClients();

		$this->load->view('custom_validation/invoices_edit_validation.php', '', FALSE); // field validation

		if ($this->validation->run() == FALSE) {
			$data['items'] = $this->invoices_model->getInvoiceItems($id);

			// begin amount and taxes
			$data['total_no_tax'] = $this->lang->line('invoice_amount') . ': ' . $this->settings_model->getSetting('currency_symbol') . number_format($data['row']->total_notax, 2, '.', '') . "<br />\n";			
			$data['tax_info'] = '';
			if ($data['row']->total_tax1 > 0) {
				$data['tax_info'] .= $data['row']->tax1_desc . " (" . $data['row']->tax1_rate . "%): " .  $this->settings_model->getSetting('currency_symbol') . number_format($data['row']->total_tax1, 2, '.', '') . "<br />\n";
			}
			if ($data['row']->total_tax2 > 0) {
				$data['tax_info'] .= $data['row']->tax2_desc . " (" . $data['row']->tax2_rate . "%): " . $this->settings_model->getSetting('currency_symbol') . number_format($data['row']->total_tax2, 2, '.', '') . "<br />\n";
			}		
			$data['total_with_tax'] = $this->lang->line('invoice_total') . ': ' . $this->settings_model->getSetting('currency_symbol') . number_format($data['row']->total_with_tax, 2, '.', '');
			// end amount and taxes

			$data['page_title'] = $this->lang->line('menu_edit_invoice');
			$this->load->view('invoices/edit', $data);
		} else {
			if ($this->invoices_model->uniqueInvoiceNumberEdit($this->input->post('invoiceNumber'), $this->input->post('id'))) {

				$invoiceData = array(
					'client_id' => $this->input->post('client_id'),
					'invoiceNumber' => $this->input->post('invoiceNumber'),
					'dateIssued' => $this->input->post('dateIssued'),
					'tax1_desc' => $this->input->post('tax1_description'),
					'tax1_rate' => $this->input->post('tax1_rate'),
					'tax2_desc' => $this->input->post('tax2_description'),
					'tax2_rate' => $this->input->post('tax2_rate'),
					'invoice_note' => $this->input->post('invoice_note')
				);
				
				$invoice_id = $this->invoices_model->updateInvoice($invoiceData, $this->input->post('id'));
				if (!$invoice_id) {
					die('That invoice could not be updated.');
				}

				// remove old items
				$this->invoices_model->delete_invoice_items($invoice_id);

				// add them back
				$items = $this->input->post('items');
				foreach ($items as $item) {
					if (isset($item['taxable']) && $item['taxable'] == 1) {
						$taxable = 1;
					} else {
						$taxable = 0;
					}
					$invoiceItems = array(
						'invoice_id' => htmlspecialchars($invoice_id),
						'quantity' => htmlspecialchars($item['quantity']),
						'amount' => htmlspecialchars($item['amount']),
						'work_description' => htmlspecialchars($item['work_description']),
						'taxable' => htmlspecialchars($taxable)
					);
					$this->invoices_model->addInvoiceItem($invoiceItems);
				}

				// give a session telling them it worked
				$this->session->set_flashdata('editedInvoice', $this->lang->line('invoice_invoice_edit_success'));
				redirect('invoices/view/' . $invoice_id);
				exit;

	
			} else {
				$data['invoiceNumber_error'] = TRUE;
				$data['items'] = $this->invoices_model->getInvoiceItems($id);
	
				// begin amount and taxes
				$data['total_no_tax'] = $this->lang->line('invoice_amount') . ': ' . $this->settings_model->getSetting('currency_symbol') . number_format($data['row']->total_notax, 2, '.', '') . "<br />\n";			
				$data['tax_info'] = '';
				if ($data['row']->total_tax1 > 0) {
					$data['tax_info'] .= $data['row']->tax1_desc . " (" . $data['row']->tax1_rate . "%): " .  $this->settings_model->getSetting('currency_symbol') . number_format($data['row']->total_tax1, 2, '.', '') . "<br />\n";
				}
				if ($data['row']->total_tax2 > 0) {
					$data['tax_info'] .= $data['row']->tax2_desc . " (" . $data['row']->tax2_rate . "%): " . $this->settings_model->getSetting('currency_symbol') . number_format($data['row']->total_tax2, 2, '.', '') . "<br />\n";
				}		
				$data['total_with_tax'] = $this->lang->line('invoice_total') . ': ' . $this->settings_model->getSetting('currency_symbol') . number_format($data['row']->total_with_tax, 2, '.', '');
				// end amount and taxes
	
				$data['page_title'] = $this->lang->line('menu_edit_invoice');
				$this->load->view('invoices/edit', $data);
			}
		}
	}

	function email()
	{
		$this->lang->load('date');
		$this->load->plugin('to_pdf');
		$this->load->helper('typography');
		$this->load->helper('logo');
		$this->load->helper('file');
		$this->load->library('email');
		$this->load->model('clientcontacts_model');
		$this->load->model('invoice_histories_model', '', TRUE);
		$data['page_title'] = 'invoice';

		$id = (int) $this->uri->segment(3);

		$invoiceInfo = $this->invoices_model->getSingleInvoice($id);
		if ($invoiceInfo->num_rows() == 0) {redirect('invoices/');exit;}
		$data['row'] = $this->invoices_model->getSingleInvoice($id)->row();

		// configure email to be sent
		$data['companyInfo'] = $this->settings_model->getCompanyInfo()->row();
		$data['company_logo'] = get_logo($this->settings_model->getSetting('logo'));

		$items = $this->invoices_model->getInvoiceItems($id);
		$data['items'] = $items;
		$data['total_no_tax'] = $this->lang->line('invoice_amount') . ': ' . $this->settings_model->getSetting('currency_symbol') . number_format($data['row']->total_notax, 2, '.', '') . "<br />\n";

		// taxes
		$data['tax_info'] = '';
		if ($data['row']->total_tax1 > 0) {
			$data['tax_info'] .= $data['row']->tax1_desc . " (" . $data['row']->tax1_rate . "%): " .  $this->settings_model->getSetting('currency_symbol') . number_format($data['row']->total_tax1, 2, '.', '') . "<br />\n";
		}
		if ($data['row']->total_tax2 > 0) {
			$data['tax_info'] .= $data['row']->tax2_desc . " (" . $data['row']->tax2_rate . "%): " . $this->settings_model->getSetting('currency_symbol') . number_format($data['row']->total_tax2, 2, '.', '') . "<br />\n";
		}

		$data['total_with_tax'] = $this->lang->line('invoice_total') . ': ' . $this->settings_model->getSetting('currency_symbol') . number_format($data['row']->total_with_tax, 2, '.', '');

		$from_name = $data['companyInfo']->primary_contact;
		$from_email = $data['companyInfo']->primary_contact_email;
		$email_body = $this->input->post('email_body');
		$recipients =  $this->input->post('recipients');
		$invoiceNumber = $data['row']->invoiceNumber;
		$subject = "Invoice $invoiceNumber from " . $data['companyInfo']->company_name;

		if ($recipients == '') {die ($this->lang->line('invoice_email_no_recipient'));} // a rather rude reminder to include a recipient in case js is disabled

		$recipient_emails = '';
		foreach($recipients as $recipient) {
			($recipient == 1) ? $recipient_emails[] .= $from_email : $recipient_emails[] .= $this->clientcontacts_model->getContactInfo($recipient)->email;
		}

		$recipient_names = '';
		foreach($recipients as $recipient) {
			if ($recipient == 1) {
				$recipient_names[] .= 'You';
			} else {
				$recipient_names[] .= $this->clientcontacts_model->getContactInfo($recipient)->first_name . ' ' . $this->clientcontacts_model->getContactInfo($recipient)->last_name;
			}
		}

		// for the demo, I don't want actual emails sent out, so everything is redirected to me
		if ($this->settings_model->getSetting('demo_flag') == 'y') {
			$recipient_emails = array('info@bambooinvoice.org');
		} 
		
		// create and save invoice to temp
		$html = $this->load->view('invoices/pdf', $data, TRUE);
		if (pdf_create($html, "$invoiceNumber", FALSE)) {
			 echo $this->lang->line('error_problem_saving');
		} else {
			// send emails
		
			if (count($recipient_emails) === 1) {
				$this->email->to($recipient_emails[0]);
			} else {
				$this->email->to($recipient_emails[0]);
				$this->email->cc(array_slice($recipient_emails, 1));
			}

			// should we blind copy the primary contact? 
			if ($this->input->post('primary_contact') == 'y') {
				$this->email->bcc($data['companyInfo']->primary_contact_email);
			}

			$this->email->from($from_email, $from_name);
			$this->email->subject($subject);
			$this->email->message(stripslashes($email_body));
			$this->email->attach("./invoices_temp/invoice_$invoiceNumber.pdf");
			$this->email->send();
//			die($this->email->print_debugger()); // this line for debugging
		}

		// remove the saved invoice
		$this->_delete_stored_files();

		// save this in the invoice_history	
		$this->invoice_histories_model->insertHistory($id, serialize($recipient_names), '1', htmlentities($email_body, ENT_QUOTES));
		if ($this->input->post('isAjax') == 'true') {
			// for future ajax functionality, right now this is permanently set to false
		} else {
			// send them back to the invoice view
			$this->session->set_flashdata('emailedInvoice', $id);
			redirect('invoices/view/' . $id);
			exit;
		}
	}

	function export_xml()
	{
		$this->load->plugin('to_xml');
		if ($this->invoices_model->getInvoicesAJAX($this->uri->segment(3), $this->uri->segment(4), $this->settings_model->getSetting('days_payment_due'))->num_rows() > 0) {
			to_xml($this->invoices_model->getInvoicesAJAX($this->uri->segment(3), $this->uri->segment(4), $this->settings_model->getSetting('days_payment_due')), 'invoices');
		} else {
			show_error($this->lang->line('error_selection'));
		}
	}
	
	function export_excel()
	{
		$this->load->plugin('to_excel');
		if ($this->invoices_model->getInvoicesAJAX($this->uri->segment(3), $this->uri->segment(4), $this->settings_model->getSetting('days_payment_due'))->num_rows() > 0) {
			to_excel($this->invoices_model->getInvoicesAJAX($this->uri->segment(3), $this->uri->segment(4), $this->settings_model->getSetting('days_payment_due')), 'invoices');
		} else {
			show_error($this->lang->line('error_selection'));
		}
	}

	function pdf()
	{
		$this->lang->load('date');
		$this->load->plugin('to_pdf');
		$this->load->helper('typography');
		$this->load->helper('logo');
		$this->load->helper('file');
		
		$data['page_title'] = $this->lang->line('menu_invoices');
		
		$id = (int) $this->uri->segment(3);
		$invoiceInfo = $this->invoices_model->getSingleInvoice($id);
		
		if ($invoiceInfo->num_rows() == 0) {redirect('invoices/');exit;}
		$data['row'] = $this->invoices_model->getSingleInvoice($id)->row();
		
		$data['companyInfo'] = $this->settings_model->getCompanyInfo()->row();
		$data['company_logo'] = get_logo($this->settings_model->getSetting('logo_pdf'));

		$items = $this->invoices_model->getInvoiceItems($id);
		$data['items'] = $items;
		$data['total_no_tax'] = $this->lang->line('invoice_amount') . ': ' . $this->settings_model->getSetting('currency_symbol') . number_format($data['row']->total_notax, 2, '.', '') . "<br />\n";

		// taxes
		$data['tax_info'] = '';
		if ($data['row']->total_tax1 > 0) {
			$data['tax_info'] .= $data['row']->tax1_desc . " (" . $data['row']->tax1_rate . "%): " .  $this->settings_model->getSetting('currency_symbol') . number_format($data['row']->total_tax1, 2, '.', '') . "<br />\n";
		}
		if ($data['row']->total_tax2 > 0) {
			$data['tax_info'] .= $data['row']->tax2_desc . " (" . $data['row']->tax2_rate . "%): " . $this->settings_model->getSetting('currency_symbol') . number_format($data['row']->total_tax2, 2, '.', '') . "<br />\n";
		}

		$data['total_with_tax'] = $this->lang->line('invoice_total') . ': ' . $this->settings_model->getSetting('currency_symbol') . number_format($data['row']->total_with_tax, 2, '.', '');

		$html = $this->load->view('invoices/pdf', $data, TRUE);
		pdf_create($html, 'invoice_' . $data['row']->invoiceNumber);
		$this->_delete_stored_files();
	}

	function payment()
	{
		$id = (int) $this->input->post('id');
		$date_paid = $this->input->post('date_paid');
		$amount = $this->input->post('amount');
		$payment_note = substr (htmlentities($this->input->post('payment_note'), ENT_QUOTES), 0, 255 );
		$data = array(
					   'invoice_id' => $id,
					   'amount_paid' => $amount,
					   'date_paid' => $date_paid,
					   'payment_note' => $payment_note
					);
		$this->db->where('id', $id);
		
		if (!preg_match("/(19|20)\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])/", $date_paid) || !is_numeric($amount)) {
			echo '<p>' . $this->lang->line('error_date_fill') . '</p>';
		} else {
			$this->db->insert('invoice_payments', $data);
			$this->session->set_flashdata('invoicePayment', TRUE);
			redirect('invoices/view/' . $id);
			exit;
		}
	}

	function delete()
	{
		$id = (int) $this->uri->segment(3);
		$this->session->set_flashdata('deleteInvoice', $id);
		$data['deleteInvoice'] = $this->invoices_model->getSingleInvoice($id)->row()->invoiceNumber;
		$data['page_title'] = $this->lang->line('menu_delete_invoice');
		$this->load->view('invoices/delete', $data);
	}


	function delete_confirmed() {
		$invoice_id = $this->session->flashdata('deleteInvoice');
		$this->invoices_model->delete_invoice($invoice_id);
		$this->session->set_flashdata('deleteInvoice', $this->lang->line('invoice_invoice_delete_success'));
		redirect('invoices/');
		exit;
	}

	function retrieveInvoices()
	{
		$query = $this->invoices_model->getInvoicesAJAX ($this->input->post('status'), $this->input->post('client_id'), $this->settings_model->getSetting('days_payment_due'));

		$last_retrieved_month = 0; // no month

		$invoiceResults = '{"invoices" :[';

		if ($query->num_rows() == 0) {
			$invoiceResults .= '{ "invoiceNumber" : "No results available"}, ';
		} else {
			foreach($query->result() as $row) {
				$invoice_date = mysql_to_unix($row->dateIssued);
				if ($last_retrieved_month != date('F', $invoice_date) && $last_retrieved_month !== 0) {
					$invoiceResults .= '{ "invoiceId" : "monthbreak' . date('F', $invoice_date) . '" }, ';
				}
			
				$invoiceResults .= '{ "invoiceId" : "' . $row->id . '", "invoiceNumber" : "' . $row->invoiceNumber . '", "dateIssued" : "';
				// localized month
				$invoiceResults .= $this->lang->line('cal_' . strtolower(date('F', mysql_to_unix($row->dateIssued))));
				// day and year numbers
				$invoiceResults .= date(' j, Y', mysql_to_unix($row->dateIssued));
				$invoiceResults .= '", "clientName" : "' . $row->name.'", "amount" : "' . number_format($row->subtotal, 2, '.', '') .'", "status" : "';
	
				if ($row->amount_paid >= $row->subtotal) { // paid invoices
						$invoiceResults .= 'closed';
				} elseif (mysql_to_unix($row->dateIssued) >= strtotime('-'.$this->settings_model->getSetting('days_payment_due'). ' days')) { // owing less then the overdue days amount
						$invoiceResults .= 'open';
				} else { // owing more then the overdue days amount
						$due_date = $invoice_date + ($this->settings_model->getSetting('days_payment_due') * 60*60*24); 
						$invoiceResults .= timespan($due_date, now()). ' overdue';
				}

				$invoiceResults .= '" }, ';
				$last_retrieved_month = date('F', $invoice_date);
			}
			$invoiceResults = rtrim($invoiceResults, ', ').']}';
			echo $invoiceResults;
		}
	}

	function dateIssued($str) {
		if (preg_match("/(19|20)\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])/", $str)) {
			return TRUE;
		} else {
			$this->validation->set_message('dateIssued', $this->lang->line('error_date_format'));
			return FALSE;
		}
	}

	function _delete_stored_files()
	{
		if ($this->settings_model->getSetting('save_invoices') == "n") {
			delete_files("./invoices_temp/");
		}
	}

} 
?>