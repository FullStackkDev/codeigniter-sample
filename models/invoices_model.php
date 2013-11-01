<?php
class invoices_model extends Model {

    function invoices_model()
    {
        parent::Model();
		$this->obj =& get_instance();
    }

	function addInvoice($invoiceData)
	{
		if ($this->db->insert('invoices', $invoiceData)) {
			return $this->db->insert_id();
		} else {
			return FALSE;
		}
	}

	function addInvoiceItem($invoiceItems)
	{
		if ($this->db->insert('invoice_items', $invoiceItems)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function updateInvoice($invoiceData, $invoice_id)
	{
		$this->db->where('id', $invoice_id);

		if ($this->db->update('invoices', $invoiceData)) {
			return $invoice_id;
		} else {
			return FALSE;
		}
	}

	function delete_invoice($invoice_id)
	{
		$this->db->where('invoice_id', $invoice_id);
		$this->db->delete('invoice_payments'); // remove invoice payments
		$this->db->where('invoice_id', $invoice_id);
		$this->db->delete('invoice_histories'); // remove invoice_histories info
		$this->delete_invoice_items($invoice_id); // remove invoice items
		$this->db->where('id', $invoice_id);
		$this->db->delete('invoices'); // remove invoice info
	}

	function delete_invoice_items($invoice_id)
	{
		$this->db->where('invoice_id', $invoice_id);
		$this->db->delete('invoice_items');
	}

	function getSingleInvoice($invoice_id)
	{
		$this->db->select('invoices.*, clients.name, clients.address1, clients.address2, clients.city, clients.country, clients.province, clients.website, clients.postal_code');
		$this->db->select('(SELECT SUM(invoice_payments.amount_paid) FROM invoice_payments WHERE invoice_payments.invoice_id=' . $invoice_id . ') AS amount_paid'); 
		$this->db->select('TO_DAYS(invoices.dateIssued) - TO_DAYS(curdate()) AS daysOverdue');
		$this->db->select('(SELECT SUM(invoice_items.amount * invoice_items.quantity) FROM invoice_items WHERE invoice_items.invoice_id=' . $invoice_id . ') AS total_notax');
		$this->db->select('(SELECT SUM(invoice_items.amount * invoice_items.quantity * (invoices.tax1_rate/100 * invoice_items.taxable)) FROM invoice_items WHERE invoice_items.invoice_id=' . $invoice_id . ') AS total_tax1');
		$this->db->select('(SELECT SUM(invoice_items.amount * invoice_items.quantity * (invoices.tax2_rate/100 * invoice_items.taxable)) FROM invoice_items WHERE invoice_items.invoice_id=' . $invoice_id . ') AS total_tax2');
		$this->db->select('(SELECT SUM(invoice_items.amount * invoice_items.quantity + (invoice_items.amount * invoice_items.quantity * (invoices.tax1_rate/100 + invoices.tax2_rate/100) * invoice_items.taxable)) FROM invoice_items WHERE invoice_items.invoice_id=' . $invoice_id . ') AS total_with_tax');
		$this->db->join('clients', 'invoices.client_id = clients.id');
		$this->db->join('invoice_items', 'invoices.id = invoice_items.invoice_id');
		$this->db->join('invoice_payments', 'invoices.id = invoice_payments.invoice_id', 'left');
		$this->db->groupby('invoices.id'); 
		$this->db->where('invoices.id', $invoice_id);
		return $this->db->get('invoices');
	}

	function getInvoiceItems($invoice_id)
	{
		$this->db->where('invoice_id', $invoice_id);
		$items = $this->db->get('invoice_items');
		if ($items->num_rows() > 0) {
			return $items;
		} else {
			return FALSE;
		}
	}
	
	function getInvoiceHistory($invoice_id)
	{
		$this->db->where('invoice_histories.invoice_id', $invoice_id);
		$this->db->orderby('date_sent');
		return $this->db->get('invoice_histories');
	}	

	function getInvoicePaymentHistory($invoice_id)
	{
		$this->db->where('invoice_id', $invoice_id);
		$this->db->orderby('date_paid');
		return $this->db->get('invoice_payments');
	}
	
	function getInvoices($offset=0, $limit=100, $status, $days_payment_due=30)
    {
		// just let me say that http://dev.mysql.com/doc/refman/5.0/en/problems-with-float.html sucks...
		if ($status == 'overdue') {
			$having = "daysOverdue <= -$days_payment_due AND (ROUND(amount_paid, 2) < ROUND(subtotal, 2) OR amount_paid is null)";
		} elseif ($status == 'open') {
			$having = '(ROUND(amount_paid, 2) < ROUND(subtotal, 2) or amount_paid is null)';
		} elseif ($status == 'closed') {
			$having = 'ROUND(amount_paid, 2) >= ROUND(subtotal, 2)';
		} else {
			$having = 'invoices.id'; // just list everything
		}
		
		$this->db->select('invoices.*, clients.name');
		$this->db->select('(SELECT SUM(amount_paid) FROM invoice_payments WHERE invoice_id=invoices.id) AS amount_paid');
		$this->db->select('TO_DAYS(invoices.dateIssued) - TO_DAYS(curdate()) AS daysOverdue');
		$this->db->select('(SELECT SUM(invoice_items.amount * invoice_items.quantity + (invoice_items.amount * invoice_items.quantity * (invoices.tax1_rate/100 + invoices.tax2_rate/100) * invoice_items.taxable)) FROM invoice_items WHERE invoice_items.invoice_id=invoices.id) AS subtotal');

		$this->db->join('clients', 'invoices.client_id = clients.id');
		$this->db->join('invoice_items', 'invoices.id = invoice_items.invoice_id');
		$this->db->join('invoice_payments', 'invoices.id = invoice_payments.invoice_id', 'left');
		$this->db->having($having);
		$this->db->orderby('dateIssued desc, invoiceNumber desc');
		$this->db->groupby('invoices.id'); 
		$this->db->offset($offset);
		$this->db->limit($limit);
		return $this->db->get('invoices');
	}

	// Not very DRY to have a separate function for AJAX, so I'll need to get this
	// incorporated into getInvoices() later...
	function getInvoicesAJAX ($status, $client, $days_payment_due=30)
	{
		if ($status == 'overdue') {
			$having = "daysOverdue <= -$days_payment_due AND (ROUND(amount_paid, 2) < ROUND(subtotal, 2) OR amount_paid is null)";
		} elseif ($status == 'open') {
			$having = '(ROUND(amount_paid, 2) < ROUND(subtotal, 2) or amount_paid is null)';
		} elseif ($status == 'closed') {
			$having = 'ROUND(amount_paid, 2) >= ROUND(subtotal, 2)';
		} else {
			$having = 'invoices.id'; // just list everything
		}
		
		if (is_numeric($client)) {
			$client = '='.$client;
		} else {
			$client = ' is not null';
		}
	
		$this->db->select('invoices.*, clients.name');
		$this->db->select('(SELECT SUM(amount_paid) FROM invoice_payments WHERE invoice_id=invoices.id) AS amount_paid');
		$this->db->select('TO_DAYS(invoices.dateIssued) - TO_DAYS(curdate()) AS daysOverdue');
		$this->db->select('(SELECT SUM(invoice_items.amount * invoice_items.quantity + (invoice_items.amount * invoice_items.quantity * (invoices.tax1_rate/100 + invoices.tax2_rate/100) * invoice_items.taxable)) FROM invoice_items WHERE invoice_items.invoice_id=invoices.id) AS subtotal');
		$this->db->join('clients', 'invoices.client_id = clients.id');
		$this->db->join('invoice_items', 'invoices.id = invoice_items.invoice_id');
		$this->db->join('invoice_payments', 'invoices.id = invoice_payments.invoice_id', 'left');
		$this->db->having($having);
		$this->db->having('client_id'.$client);
		$this->db->orderby('dateIssued desc, invoiceNumber desc');
		$this->db->groupby('invoices.id'); 
		return $this->db->get('invoices');
	}

	function lastInvoiceNumber()
	{
		$this->db->where('invoiceNumber !=', '');
		$this->db->orderby("id", "desc"); 
		$this->db->limit(1);
		$query = $this->db->get('invoices');
				
		if ($query->num_rows() > 0) {
			return $query->row()->invoiceNumber;
		} else {
			return '0';
		}
	}
	
	function uniqueInvoiceNumberEdit($invoiceNumber, $invoice_id)
	{
		$this->db->where('invoiceNumber',$invoiceNumber);
		$this->db->where('id!=',$invoice_id);
		$query = $this->db->get('invoices');
		$num_rows = $query->num_rows();
		if ($num_rows == 0) {
//			$row = $query->result_array();
			return TRUE;
		} else {
			return FALSE;
		}
	}
}
?>