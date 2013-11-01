<?php
$this->load->view('header');
?>
<?php $this->load->view('common_assets/invoice_new.php');?>
<h2><?php echo $page_title;?></h2>

<?php $this->load->view('common_assets/invoice_table.inc.php');?>

<?php
$this->load->view('footer');
?>