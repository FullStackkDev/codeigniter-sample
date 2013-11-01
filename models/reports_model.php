<?php
class reports_model extends Model {

    function reports_model()
    {
        parent::Model();
		$this->obj =& get_instance();
    }

	function getDetailedData($start_date, $end_date)
	{
		$this->db->select('name');
		$this->db->select('SUM(invoice_items.amount) as amount');
		$this->db->select('SUM(invoice_items.amount*invoices.tax1_rate/100) as tax1_collected');
		$this->db->select('SUM(invoice_items.amount*invoices.tax2_rate/100) as tax2_collected');
		$this->db->join('invoices', 'invoices.client_id = clients.id');
		$this->db->join('invoice_items', 'invoices.id = invoice_items.invoice_id');
		$this->db->where('dateIssued > "' . $start_date . '" and dateIssued < "' . $end_date . '"');
		$this->db->orderby('clients.name');
		$this->db->groupby('name');		
		return $this->db->get('clients');
	}

	function getSummaryData($start_date, $end_date)
	{
		$this->db->select('SUM(amount) as amount, sum(invoice_items.amount*invoices.tax1_rate/100) as tax1_collected, sum(amount*invoices.tax2_rate/100) as tax2_collected');
		$this->db->join('invoices', 'invoices.client_id = clients.id');
		$this->db->join('invoice_items', 'invoices.id = invoice_items.invoice_id');
		$this->db->where('dateIssued > ', $start_date);
		$this->db->where('dateIssued < ', $end_date);
		return $this->db->get('clients')->row();
	}

	function getInvoiceDateRange($start_date, $end_date)
	{

		$this->db->select('DISTINCT(invoices.id)');
		$this->db->join('clients', 'invoices.client_id = clients.id');
		$this->db->join('invoice_items', 'invoices.id = invoice_items.invoice_id');
		$this->db->where("dateIssued > '$start_date'");
		$this->db->where("dateIssued < '$end_date'");
		$this->db->orderby('dateIssued desc, invoiceNumber desc');
		return $this->db->get('invoices');
	}

}
?>