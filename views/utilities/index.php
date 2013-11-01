<?php
$this->load->view('header');
?>
<h2><?php echo $this->lang->line('bambooinvoice_logo');?> <?php echo $page_title;?></h2>

<h3>Database Backup</h3>
<ul>
	<li><?php echo anchor('utilities/php_info', $this->lang->line('utilities_phpinfo'));?></li>
	<li>MySQL only. <?php echo anchor('utilities/database_backup', 'download backup');?></li>
</ul>


<?php
$this->load->view('footer');
?>