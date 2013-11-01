<?php
class invoice_histories_model extends Model {

    function invoice_histories_model()
    {
        parent::Model();
    }

	function insertHistory($invoice_id, $clientcontacts_id, $contact_type, $email_body)
    {
		$historyInfo = array(
					'invoice_id' => $invoice_id,
					'clientcontacts_id' => $clientcontacts_id,
					'date_sent' => date ("Y-m-d"),
					'contact_type' => $contact_type,
					'email_body' => $email_body
				);
		$this->db->insert('invoice_histories', $historyInfo);
		return $invoice_id;
    }
}
?>