<?php
/**
* This page gnerates the divs that slide into position when
* the user creates a new invoice
*/
?>
<div id="newinvoice" style="display:block;">
	<?php echo  form_open('clients/newclient');?>
	<h2><input type="hidden" name="newInvoice" value="true" /><?php echo $this->lang->line('invoice_new_invoice');?></h2>
	<p>
	<label><?php echo $this->lang->line('invoice_select_client');?>
	<select name="client_id" id="client_id">
        <option value="0" selected="selected">-- <?php echo $this->lang->line('actions_select_below');?> --</option>
		<?php foreach($clientList->result() as $row): ?>
        <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
		<?php endforeach; ?>
	</select>
	</label></p>
	<p>
		<label><?php echo $this->lang->line('invoice_or_new_client');?> <input type="text" name="newClient" id="newClient" size="50" /></label>
	</p>
	<div>
	<p><input type="submit" value="<?php echo $this->lang->line('actions_create_invoice');?>" name="createInvoice" id="createInvoice" /> <input type="button" value="<?php echo $this->lang->line('actions_cancel');?>" id="newinvoicecancel" /></p>
	</div>

	</form>
</div>
<script type="text/javascript">
<!--<![CDATA[
$('newinvoice').style.display = 'none';
// ]]> -->
</script>