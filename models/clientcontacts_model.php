<?php
class clientcontacts_model extends Model {

    function clientcontacts_model()
    {
        parent::Model();
    }

	function addClientContact($client_id, $first_name, $last_name, $email, $phone = '')
    {
		$contactInfo = array(
		   'client_id' => (int) $client_id,
		   'first_name' => htmlentities($first_name),
		   'last_name' => htmlentities($last_name),
		   'email' => $email,
		   'phone' => htmlentities($phone)
		);
		$this->db->insert('clientcontacts', $contactInfo);
		return $this->db->insert_id();
    }

	function editClientContact($id, $client_id, $first_name, $last_name, $email, $phone = '')
    {
		$contactInfo = array(
		   'client_id' => (int) $client_id,
		   'first_name' => htmlentities($first_name),
		   'last_name' => htmlentities($last_name),
		   'email' => $email,
		   'phone' => htmlentities($phone)
		);
		$this->db->where('id', (int) $id);
		$this->db->update('clientcontacts', $contactInfo);
    }

	function deleteClientContact($id)
    {
		// Don't allow the admin to be deleted this way
		if ($id === 1) {
			return FALSE;
		} else {
			$this->db->where('id', $id);
			$this->db->delete('clientcontacts');

			if ($this->db->affected_rows() !== 1) {
				return FALSE;		
			} else {
				return $id;
			}
		}
    }

	function getContactInfo($id)
    {
		$this->db->where('id', $id);
		$query = $this->db->get('clientcontacts');
		
		if ($query->num_rows() == 0) {
			return FALSE;
		} else {
			return $query->row();
		}
    }

	function getContactId($email)
    {
		$this->db->select('id');
		$this->db->where('email', $email);
		return $this->db->get('clientcontacts')->row()->id;
    }
	
	function password_reset($email, $random_passkey)
	{
		$this->db->where('email', $email);
		$this->db->where('access_level != 0'); // they allowed to login?
		$this->db->set('password_reset', $random_passkey);
		$this->db->update('clientcontacts');
		if ($this->db->affected_rows() != 0) {
			return $this->getContactId($email);
		} else {
			return FALSE;
		}
	}

	function password_confirm($id, $passkey)
	{
		$this->db->where('id', $id);
		$this->db->set('password_reset', $passkey);
		$password = $this->db->get('clientcontacts');
		if ($password->num_rows() == 1) {
			return $password;
		} else {
			return FALSE;
		}
	}

	function password_change($id, $new_password)
	{
		$this->db->where('id', $id);
		$this->db->set('password', $new_password);
		$this->db->update('clientcontacts');

		$this->db->where('id', $id);
		$password = $this->db->get('clientcontacts');
		if ($password->num_rows() == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

}
?>