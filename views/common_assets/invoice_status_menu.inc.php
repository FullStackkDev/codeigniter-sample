      <ul id="invoice_status_menu">
        <li><?php echo anchor('invoices', $this->lang->line('invoice_summary'));?></li>
        <li><?php echo anchor('invoices/overdue', $this->lang->line('invoice_overdue'));?></li>
        <li><?php echo anchor('invoices/open', $this->lang->line('invoice_open'));?></li>
        <li><?php echo anchor('invoices/closed', $this->lang->line('invoice_closed'));?></li>
        <li><?php echo anchor('invoices/all', $this->lang->line('invoice_all_invoices'));?></li>
      </ul>
<script type="text/javascript">
<!--<![CDATA[
// hide this submenu from javascript enabled browsers
$('invoice_status_menu').style.display = "none";
// ]]> -->
</script>