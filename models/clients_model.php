<?php
class clients_model extends Model {

    function clients_model()
    {
        parent::Model();
    }

	function countAllClients()
	{
		$query = $this->db->get("clients");
		return $query->num_rows();
	}

	function countClientInvoices($client_id)
	{
		$this->db->where('client_id', $client_id);
		return $this->db->get('invoices')->num_rows();
	}

	function getAllClients()
	{
		$this->db->orderby('name', 'asc');
		return $this->db->get('clients');
	}

	function getAllClientInfo($id)
    {
		$this->db->where('id', $id);
		return $this->db->get('clients')->row();
    }

	function getClientContacts($id)
	{
		$this->db->where('client_id', $id);
		return $this->db->get('clientcontacts');
	}

	function addClient($clientInfo)
	{
		$this->db->insert('clients', $clientInfo);
		return TRUE;
	}

	function updateClient($client_id, $clientInfo)
	{
		$this->db->where('id', $clientInfo['id']);
		$this->db->update('clients', $clientInfo);
		return TRUE;
	}
	
	function deleteClient($client_id)
	{
		// Don't allow the admin to be deleted this way
		if ($client_id === 0) {
			return FALSE;
		} else {

			/**
			 * There are 5 tables of data to delete from in order to completely
			 * clear out record of this client.
			 *
			 * Handle them 1 at a time for clarity and ease of maintenance.
			 */
	
			$this->db->query("DELETE FROM invoice_histories 
								USING invoice_histories, invoices 
								WHERE invoice_histories.invoice_id=invoices.id 
								AND invoices.client_id = " . $client_id);
			$this->db->query("DELETE FROM invoice_payments 
								USING invoice_payments, invoices 
								WHERE invoice_payments.invoice_id=invoices.id 
								AND invoices.client_id = " . $client_id);		 
			$this->db->where('client_id', $client_id);
			$this->db->delete('clientcontacts'); 
			$this->db->where('id', $client_id);
			$this->db->delete('clients');
			$this->db->where('client_id', $client_id);
			$this->db->delete('invoices'); 
			return TRUE;
		}
	}

}
?>