<?php

/**
 * This upgrade controller is only for quick upgrades of an admin user into the system.
 * I strongly recommend you delete this file after you've upgraded BambooInvoice.
 * This controller is not in any way needed to run the application.
 */

class Update extends Controller {

	function __construct()
	{
		parent::Controller();
	}
		
	function index()
	{

		$version_query = $this->db->get('settings');
		$updates = '';
		
		if (!isset($version_query->row()->bambooinvoice_version)) {
			/**
			 *  if we can't find a bambooinvoice_version field, then its old, and needs these
			 *  to be brought up to 0.8.0
			 */
			$this->db->query('ALTER TABLE settings ADD currencySymbol VARCHAR(9) DEFAULT "$"');
			$this->db->query('ALTER TABLE settings ADD bambooinvoice_version VARCHAR(9)');
			$this->db->query("UPDATE settings SET bambooinvoice_version='0.8.0' WHERE id=1");
			$this->db->query('ALTER TABLE settings ADD demo_flag CHAR DEFAULT "n"');
			$this->db->query('ALTER TABLE invoices DROP paymentTerm');
			$this->db->query('ALTER TABLE settings ADD daysPaymentDue TINYINT UNSIGNED DEFAULT "30"');
			$this->db->query("UPDATE settings SET lang=1 WHERE id=1");
			$this->db->query("CREATE TABLE `bamboo_languages` (
							  `id` smallint(3) unsigned NOT NULL auto_increment,
							  `language_shortname` varchar(6) default NULL,
							  `language_name` varchar(20) default NULL,
							  PRIMARY KEY  (`id`)
							) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;");
			$this->db->query("INSERT INTO `bamboo_languages` (`id`, `language_shortname`, `language_name`) VALUES (1, 'en', 'English'),(2, 'fr', 'French');");
			$this->db->query("UPDATE settings SET lang='1' WHERE id=1");
			$this->db->query('ALTER TABLE settings CHANGE lang lang SMALLINT(3)');
			$updates .= "Upgrade to 0.8.0 success<br />";
		} 

		// regrab data, might have been added above
		$version_query = $this->db->get('settings');

		if ($version_query->row()->bambooinvoice_version == '0.8.0') {
			$this->db->query('ALTER TABLE bamboo_languages CONVERT TO CHARACTER SET utf8');
			$this->db->query('ALTER TABLE ci_sessions CONVERT TO CHARACTER SET utf8');
			$this->db->query('ALTER TABLE clientcontacts CONVERT TO CHARACTER SET utf8');
			$this->db->query('ALTER TABLE clients CONVERT TO CHARACTER SET utf8');
			$this->db->query('ALTER TABLE invoice_histories CONVERT TO CHARACTER SET utf8');
			$this->db->query('ALTER TABLE invoice_payments CONVERT TO CHARACTER SET utf8');
			$this->db->query('ALTER TABLE invoices CONVERT TO CHARACTER SET utf8');
			$this->db->query('ALTER TABLE settings CONVERT TO CHARACTER SET utf8');
			$this->db->query("ALTER TABLE settings DROP lang");
			$this->db->query("UPDATE settings SET bambooinvoice_version='0.8.1' WHERE id=1");
			$updates .= "Upgrade to 0.8.1 success<br />";
		}

		// regrab data, might have been added above
		$version_query = $this->db->get('settings');

		if ($version_query->row()->bambooinvoice_version == '0.8.1') {
			$this->db->query("ALTER TABLE invoice_histories CHANGE invoices_id invoice_id INT(11)");
			$this->db->query('ALTER TABLE invoice_histories CHANGE dateSent date_sent DATE DEFAULT "0000-00-00"');
			$this->db->query("ALTER TABLE clients CHANGE postalCode postal_code VARCHAR(10)");
			$this->db->query('ALTER TABLE clients CHANGE taxStatus tax_status TINYINT(1) DEFAULT "1" NOT NULL');
			$this->db->query("ALTER TABLE settings CHANGE postalCode postal_code VARCHAR(10)");
			$this->db->query("ALTER TABLE settings CHANGE primaryContact primary_contact VARCHAR(75)");
			$this->db->query("ALTER TABLE settings CHANGE primaryContactEmail primary_contact_email VARCHAR(50)");
			$this->db->query('ALTER TABLE settings CHANGE currencySymbol currency_symbol VARCHAR(9) DEFAULT "$"');
			$this->db->query("ALTER TABLE settings CHANGE currencyType currency_type VARCHAR(20)");
			$this->db->query("ALTER TABLE settings CHANGE saveInvoices save_invoices CHAR(1)");
			$this->db->query('ALTER TABLE settings CHANGE daysPaymentDue days_payment_due TINYINT(3) DEFAULT "30"');
			$this->db->query("ALTER TABLE settings CHANGE companyName company_name VARCHAR(75)");
			$this->db->query("ALTER TABLE settings CHANGE taxCode tax_code VARCHAR(50)");
			$this->db->query("ALTER TABLE settings CHANGE invoiceNoteDefault invoice_note_default VARCHAR(255) NOT NULL");
			$this->db->query("ALTER TABLE invoice_histories CHANGE emailBody email_body MEDIUMTEXT");
			$this->db->query("ALTER TABLE invoice_histories CHANGE contactType contact_type TINYINT(1)");
			$this->db->query("ALTER TABLE clientcontacts CHANGE firstName first_name VARCHAR(25)");
			$this->db->query("ALTER TABLE clientcontacts CHANGE lastName last_name VARCHAR(25)");
			$this->db->query("ALTER TABLE clientcontacts CHANGE accessLevel access_level INT(11)");
			$this->db->query("ALTER TABLE clientcontacts CHANGE lastLogin last_login INT(11)");
			$this->db->query('ALTER TABLE clientcontacts ADD title VARCHAR(75) DEFAULT "" AFTER last_name');
			$this->db->query("ALTER TABLE invoices ADD itemized TEXT");
			$this->db->query("ALTER TABLE invoices CHANGE workDescription work_description MEDIUMTEXT");			
			$this->db->query("ALTER TABLE invoices CHANGE invoiceNote invoice_note VARCHAR(255)");
			$this->db->query("DROP TABLE bamboo_languages");			
			$this->db->query("ALTER TABLE invoice_payments CHANGE amountPaid amount_paid FLOAT(7,2)");
			$this->db->query("ALTER TABLE invoice_payments CHANGE paymentNote payment_note VARCHAR(255)");			
			$this->db->query('ALTER TABLE invoice_payments CHANGE datePaid date_paid DATE DEFAULT "0000-00-00"');
			$this->db->query("UPDATE settings SET bambooinvoice_version='0.8.2' WHERE id=1");			
			$updates .= "Upgrade to 0.8.2 success<br />";
		}

		// regrab data, might have been added above
		$version_query = $this->db->get('settings');

		if ($version_query->row()->bambooinvoice_version == '0.8.2') {
			$this->db->query('ALTER TABLE settings ADD logo_pdf VARCHAR(50) DEFAULT "0" AFTER logo');
			$this->db->query('ALTER TABLE settings ADD display_branding CHAR DEFAULT "y"');
			$this->db->query('ALTER TABLE settings CHANGE save_invoices save_invoices CHAR(1) DEFAULT "n"');
			$this->db->query('ALTER TABLE ci_sessions DROP user_id');
			$this->db->query('ALTER TABLE ci_sessions DROP logged_in');
			$this->db->query("CREATE TABLE invoice_items (id INT (11) UNSIGNED AUTO_INCREMENT, invoice_id INT (11) UNSIGNED DEFAULT '0', amount DECIMAL (7,2), quantity INT (6) UNSIGNED DEFAULT '1', work_description MEDIUMTEXT, taxable TINYINT (1) UNSIGNED DEFAULT '1', PRIMARY KEY(id), INDEX(invoice_id))");

			$this->_move_to_itemized();

			$this->db->query('ALTER TABLE invoices DROP amount');
			$this->db->query('ALTER TABLE invoices DROP work_description');
			$this->db->query('ALTER TABLE invoices DROP itemized');
			$this->db->query('ALTER TABLE invoices CHANGE tax1_rate tax1_rate DECIMAL(6,3)');
			$this->db->query('ALTER TABLE invoices CHANGE tax2_rate tax2_rate DECIMAL(6,3)');

			/** 
			 * Some Bamboo users when entering payment information were entering only the value
			 * of the invoice (not including tax).  With the old query, this would register as 
			 * "paid" or "closed", but this version of Bamboo doesn't consider an invoice paid
			 * until the amount *including tax* has been entered into the payments window. This
			 * query will update your legacy data, and change the amount paid to include tax, thus
			 * keeping status information correct.
			 */

			$this->db->query('ALTER TABLE clientcontacts CHANGE access_level access_level TINYINT(1) DEFAULT "0"');
			$this->db->query('UPDATE clientcontacts SET access_level = "0"');
			$this->db->query('UPDATE clientcontacts SET access_level = "1" WHERE id = "1"');

			$this->db->query("UPDATE settings SET bambooinvoice_version='0.8.3' WHERE id=1");			
			$updates .= "Upgrade to 0.8.3 success<br /><strong>PLEASE UPDATE THE AUTOLOAD CONFIG FILE</strong> if you have not yet.<br />";

		}

		// regrab data, might have been added above
		$version_query = $this->db->get('settings');
	
		if ($version_query->row()->bambooinvoice_version == '0.8.3') {
			$this->db->query('ALTER TABLE bamboo_languages CONVERT TO CHARACTER SET utf8');
//			$this->db->query('');


			$this->db->query("UPDATE settings SET bambooinvoice_version='0.8.4' WHERE id=1");
			$updates .= "Upgrade to 0.8.4 success<br />";
		}


		// everything's done now, let's optimize and display information
		$this->load->dbutil();
		$this->dbutil->optimize_database();

		echo "$updates<hr />";		
		echo "BambooInvoice is all set up.  You can now <a href=\"" . site_url('login') . "\">login</a> with the username and password you set up. You are <strong>strongly</strong> encouraged to delete these files now.<ul><li>/bamboo_system_files/application/controllers/install.php</li><li>install.php (from the root directory)</li><li>/bamboo_system_files/application/controllers/update.php</li><li>update.php (from the root directory)</li></ul>";


	}

	
	function _move_to_itemized()
	{
		$invoices = $this->db->get('invoices');
		foreach ($invoices->result() as $invoice) {
			$data = array(
				   'invoice_id' => $invoice->id,
				   'amount' => $invoice->amount,
				   'work_description' => $invoice->work_description
				);

			if ($invoice->tax1_rate > 0) {
				$data['taxable'] = 1;
			} else {
				$data['taxable'] = 0;
			}
	
			$this->db->insert('invoice_items', $data); 
		}
		
	}
}
?>