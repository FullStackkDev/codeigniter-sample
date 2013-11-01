<?php
$this->load->view('header');
$this->load->view('common_assets/invoice_new.php');
?>
<h2><?php echo $page_title;?></h2>
<?php
$this->load->view('common_assets/invoice_table.inc.php');
?>
<p id="exportOption"><?php echo $this->lang->line('invoice_export_to') . ' ' . anchor ('invoices/export_xml', '<acronym title=\'Extensible Markup Language\'>XML</acronym>') . ' ' . $this->lang->line('invoice_or') . ' ' . anchor ('invoices/export_excel', 'Excel');?>.</p>
<?php
$this->load->view('footer');
?>