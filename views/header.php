<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>BambooInvoice: <?php echo $page_title;?></title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta name="author" content="Derek Allard - http://www.derekallard.com" />
<meta name="description" content="Bamboo Invoice : Simple, Open Source, Online Invoicing" />
<meta name="keywords" content="Bamboo Invoice, Online Invoicing" />
<?php if ($this->settings_model->getSetting('demo_flag') == 'y'):?>
<meta name="robots" content="all" />
<?php else :?>
<meta name="robots" content="noindex, nofollow" />
<?php endif;?>
<meta name="rating" content="general" />
<meta name="language" content="<?php echo $this->lang->line('setting_short_language');?>" />
<meta name="copyright" content="Copyright (c) <?php echo date("Y");?> Derek Allard" />
<script type="text/javascript" src="<?php echo base_url()?>js/bamboo.js"></script>

<script type="text/javascript" src="<?php echo base_url()?>js/prototype.js"></script>

<script type="text/javascript" src="<?php echo base_url()?>js/lightbox.js"></script>

<script type="text/javascript" src="<?php echo base_url()?>js/scriptaculous/scriptaculous.js?load=effects,dragdrop"></script>
<link rel="shortcut icon" href="<?php echo base_url()?>favicon.ico" type="image/ico" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url()?>css/bamboo.css" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url()?>css/lightbox.css" />
<link type="text/css" rel="stylesheet" media="print" href="<?php echo base_url()?>css/bamboo_print.css" />
<script type="text/javascript">
base_url = "<?php echo site_url();?>/";
base_url_no_index = "<?php echo base_url();?>/";
bi_currency_symbol = new String("<?php echo ($this->settings_model->getSetting('currency_symbol'));?>");
lang_invoice_date_issued = new String("<?php echo ($this->lang->line('invoice_date_issued'));?> ");
lang_invoice_change = new String("<?php echo ($this->lang->line('actions_change'));?>");
lang_amount_error = new String("<?php echo ($this->lang->line('invoice_amount_error'));?>");
lang_numbers_only = new String("<?php echo ($this->lang->line('invoice_amount_numbers_only'));?>");
lang_field_required = new String("<?php echo ($this->lang->line('error_field_required'));?>");
lang_clients_contact_add = new String("<?php echo ($this->lang->line('clients_contact_add'));?>");
lang_error_email_recipients = new String("<?php echo ($this->lang->line('error_email_recipients'));?>");
lang_error_login_username = new String("<?php echo ($this->lang->line('error_login_username'));?>");
lang_error_login_password = new String("<?php echo ($this->lang->line('error_login_password'));?>");
lang_invoice = new String("<?php echo ($this->lang->line('invoice_invoice'));?>");
lang_client_name = new String("<?php echo ($this->lang->line('clients_name'));?>");
lang_amount = new String("<?php echo ($this->lang->line('invoice_amount'));?>");
lang_status = new String("<?php echo ($this->lang->line('invoice_status'));?>");
lang_quantity = new String("<?php echo ($this->lang->line('invoice_quantity'));?>");
lang_work_description = new String("<?php echo ($this->lang->line('invoice_work_description'));?>");
lang_taxable = new String("<?php echo ($this->lang->line('invoice_taxable'));?>");
lang_amount = new String("<?php echo ($this->lang->line('invoice_amount'));?>");
</script>
<?php
	if (isset($extraHeadContent)) {
		echo $extraHeadContent;
	}
?>
</head>
<body>
<div id="allHolder">
  <div id="container">
    <div id="masthead">
      <h1 id="bamboo_logo"><a href="<?php echo site_url()?>"><?php echo $this->lang->line('bambooinvoice_logo');?></a></h1>
<?php 
if ($this->session->userdata('logged_in')) {
	$this->load->view('common_assets/sub_menu.inc.php');
}
?>
    </div>
    <div id="invoice_action_menu">
      <ul>
<?php
	$this->load->view('common_assets/action_menu.inc.php');
?>
      </ul>
<?php
		// random tip
		$quotes = $this->lang->line('menu_did_you_know_quotes');
		echo '<p id="tip"><strong>' . $this->lang->line('menu_did_you_know') . '</strong><br />' . $quotes[array_rand($quotes)] . '</p>';
?>
    </div>
    <div id="main_content">
<?php
if ($this->session->userdata('logged_in') && isset($submenu)) {
	$this->load->view("common_assets/invoice_status_menu.inc.php");
}
?>
