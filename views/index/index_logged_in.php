<?php
$this->load->view('header');
$this->load->view('common_assets/invoice_new.php');
?>
<h2><?php echo $page_title;?></h2>
<ul id="control_panel">
	<li><a href="<?php echo site_url('invoices')?>" class="root_invoices"><?php echo $this->lang->line('menu_invoices');?></a></li>
	<li><a href="<?php echo site_url('clients')?>" class="root_clients"><?php echo $this->lang->line('menu_clients');?></a></li>
	<li><a href="<?php echo site_url('reports')?>" class="root_reports"><?php echo $this->lang->line('menu_reports');?></a></li>
	<li><a href="<?php echo site_url('settings')?>" class="root_settings"><?php echo $this->lang->line('menu_settings');?></a></li>
	<li><a href="<?php echo site_url('utilities')?>" class="root_utilities"><?php echo $this->lang->line('menu_utilties');?></a></li>
	<li><a href="<?php echo site_url('help')?>" class="root_help"><?php echo $this->lang->line('menu_help');?></a></li>
</ul>
<div class="clearer"></div>
<?php
$this->load->view('footer');
?>