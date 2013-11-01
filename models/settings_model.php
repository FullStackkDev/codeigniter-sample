<?php
class settings_model extends Model {

    function settings_model()
    {
        parent::Model();
		$this->obj =& get_instance();
    }

	function getCompanyInfo()
	{
		$this->db->select ('*, id AS settingsId');
		return $this->db->get('settings');
	}

	function getSetting($field)
	{
		$row = $this->db->get('settings')->row();
		return $row->$field;
	}

	function invoice_note_default()
	{
		$row = $this->db->get('settings')->row();
		return $row->invoice_note_default;
	}
	
}
?>