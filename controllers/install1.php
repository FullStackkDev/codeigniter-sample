<?php

/**
 * This install controller is only for quick insertion of an admin user into the system.
 * I strongly recommend you delete this file after you've installed BambooInvoice.
 * This controller is not in any way needed to run the application.
*/

class Install extends Controller {

	function __construct()
	{
		parent::Controller();
		$this->load->library('encrypt');
		$this->load->dbutil();
	}
	
	function index()
	{
		$admin_email = 'info@bambooinvoice.org'; // change this to a different username if you want
		$admin_firstname = 'firstname';
		$admin_lastname = 'lastname';
		
		/**
		 * Setting your admin password
		 * -----------------------------
		 * If you'd prefer to set your password to a specific word rather then a random string
		 * uncomment the second line... if you'd prefer a randmom, uncomment the first
		 */
		// $admin_password = substr(sha1(rand(0,999)), 0, 8); // generate random password
		 $admin_password = 'demo';

		/**
		* You shouldn't need to modify anything beneath here
		*/

		if (floor(phpversion()) < 5) {
			die ('BambooInvoice requires PHP version 5 or higher.  After you have satisfied this, you can try re-installing.');
		}

        if ( ! extension_loaded('dom')) {
			die ('BambooInvoice requires the DOM extension to be enabled to generate PDFs.  After you have satisfied this, you can try re-installing.');
        }
		
		if ( ! is_writable('invoices_temp')) {
			die ('You need to set the invoices_temp folder to writable (777) or BambooInvoice will not be able to generate invoices.  After you have satisfied this, you can try re-installing.');
		}

		if (!isset($admin_password) || !isset($admin_email)) {
			die ("Please first define your admin login, email and password.  Instructions for this are located in the file /bamboo_system_files/application/controllers/install.php.   After you have satisfied this, you can try re-installing.");
		}

		if (!$this->db->table_exists('clientcontacts')) {
			$this->db->query("CREATE TABLE `ci_sessions` (
						  `session_id` varchar(40) NOT NULL default '0',
						  `ip_address` varchar(16) NOT NULL default '0',
						  `user_agent` varchar(50) NOT NULL default '',
						  `last_activity` int(10) unsigned NOT NULL default '0',
						  `user_id` int(11) NOT NULL default '0',
						  `logged_in` tinyint(1) NOT NULL default '0',
						  PRIMARY KEY  (`session_id`)
						) TYPE=MyISAM DEFAULT CHARSET=utf8;");
			$this->db->query("CREATE TABLE `clientcontacts` (
						  `id` int(11) NOT NULL auto_increment,
						  `client_id` int(11) default NULL,
						  `firstName` varchar(25) default NULL,
						  `lastName` varchar(25) default NULL,
						  `email` varchar(50) default NULL,
						  `phone` varchar(20) default NULL,
						  `password` varchar(100) default NULL,
						  `accessLevel` int(11) default NULL,
						  `supervisor` int(11) default NULL,
						  `lastLogin` int(11) default NULL,
						  `password_reset` VARCHAR(12) NULL,
						  PRIMARY KEY  (`id`)
						) TYPE=MyISAM DEFAULT CHARSET=utf8;");
			$this->db->query("CREATE TABLE `clients` (
						  `id` int(11) NOT NULL auto_increment,
						  `name` varchar(75) default NULL,
						  `address1` varchar(100) default NULL,
						  `address2` varchar(100) default NULL,
						  `city` varchar(50) default NULL,
						  `province` varchar(25) default NULL,
						  `country` varchar(25) default NULL,
						  `postalCode` varchar(10) default NULL,
						  `website` varchar(150) default NULL,
						  `taxStatus` tinyint(1) NOT NULL default '1',
						  PRIMARY KEY  (`id`)
						) TYPE=MyISAM DEFAULT CHARSET=utf8;");
			$this->db->query("CREATE TABLE `invoice_histories` (
						  `id` int(11) NOT NULL auto_increment,
						  `invoices_id` int(11) default NULL,
						  `clientcontacts_id` varchar(255) default NULL,
						  `dateSent` date default '0000-00-00',
						  `contactType` tinyint(1) default NULL,
						  `emailBody` text,
						  PRIMARY KEY  (`id`)
						) TYPE=MyISAM DEFAULT CHARSET=utf8;");
			$this->db->query("CREATE TABLE `invoice_payments` (
						  `id` int(11) NOT NULL auto_increment,
						  `invoice_id` int(11) default NULL,
						  `datePaid` date default '0000-00-00',
						  `amountPaid` float(7,2) default NULL,
						  `paymentNote` varchar(255) default NULL,
						  PRIMARY KEY  (`id`)
						) TYPE=MyISAM DEFAULT CHARSET=utf8;");
			$this->db->query("CREATE TABLE `invoices` (
						  `id` int(11) NOT NULL auto_increment,
						  `client_id` int(11) NOT NULL default '0',
						  `invoiceNumber` varchar(12) default NULL,
						  `dateIssued` date default NULL,
						  `amount` float(7,2) default NULL,
						  `workDescription` text,
						  `paymentTerm` varchar(50) default NULL,
						  `tax1_desc` varchar(50) default NULL,
						  `tax1_rate` float(6,3) default NULL,
						  `tax2_desc` varchar(50) default NULL,
						  `tax2_rate` float(6,3) default NULL,
						  `invoiceNote` varchar(255) default NULL,
						  PRIMARY KEY  (`id`)
						) TYPE=MyISAM DEFAULT CHARSET=utf8;");
			$this->db->query("CREATE TABLE `settings` (
						  `id` int(11) NOT NULL auto_increment,
						  `lang` varchar(10) default NULL,
						  `companyName` varchar(75) default NULL,
						  `address1` varchar(100) default NULL,
						  `address2` varchar(100) default NULL,
						  `city` varchar(50) default NULL,
						  `province` varchar(25) default NULL,
						  `country` varchar(25) default NULL,
						  `postalCode` varchar(10) default NULL,
						  `website` varchar(150) default NULL,
						  `primaryContact` varchar(75) default NULL,
						  `primaryContactEmail` varchar(50) default NULL,
						  `logo` varchar(50) default NULL,
						  `invoiceNoteDefault` varchar(255) NOT NULL default '',
						  `currencyType` varchar(20) default NULL,
						  `taxCode` varchar(50) default NULL,
						  `tax1_desc` varchar(50) default NULL,
						  `tax1_rate` double(6,3) default NULL,
						  `tax2_desc` varchar(50) default NULL,
						  `tax2_rate` double(6,3) default NULL,
						  `saveInvoices` tinyint(1) default NULL,
						  PRIMARY KEY  (`id`)
						) TYPE=MyISAM DEFAULT CHARSET=utf8;");
		}
		
		$this->db->select('*');
		$this->db->where('id', 1);
		$query = $this->db->get('clientcontacts')->num_rows();
		
		if ($query == 1) {
			// already have admin user... 
			echo "It appears that BambooInvoice is already installed.  You are <strong>strongly</strong> encouraged to delete the install file now, /bamboo_system_files/application/controllers/install.php";
		} else {
			// insert admin user
			$this->db->query("INSERT INTO `clientcontacts` VALUES (1,0,'$admin_firstname','$admin_lastname','$admin_email','','" . $this->encrypt->encode($admin_password) . "',NULL,NULL," . time() . ", '');");
			$this->db->query("INSERT INTO `settings` VALUES (1,'en','','','','','','','','','$admin_firstname $admin_lastname','$admin_email','','','','','',0,'',0,NULL);");

			// upgrades up to 0.8.0
			redirect('update');
			exit;
		}
	}
	
}
?>