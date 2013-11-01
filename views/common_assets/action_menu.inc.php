<?php if ($this->session->userdata('logged_in')): ?>

		<li><?php echo anchor('', $this->lang->line('menu_root_system'), array('class' => 'dashboard'));?></li>
		<li><?php echo anchor('invoices', $this->lang->line('menu_invoice_summary'), array('class' => 'summaryinv'));?></li>
		
		<?php if (isset($clientList)): ?>
		<li><?php echo anchor('invoices/newinvoice_first', $this->lang->line('menu_new_invoice'), array('class' => 'addinv createInvoice', 'id' => 'addinv'));?></li>
		<?php endif; ?>

		<?php if (isset($invoiceOptions)): ?>
			<?php if ($row->amount_paid < $row->total_with_tax): ?>
			<li id="invpayli"><a class="invpayment" href="javascript:void(0);" onclick="Effect.BlindDown('enterPayment', {duration: '0.4'});"><?php echo $this->lang->line('menu_enter_payment');?></a></li>
	        <li id="invemailli"><a class="invemail" href="javascript:void(0);" onclick="Effect.BlindDown('emailInvoice', {duration: '0.4'});"><?php echo $this->lang->line('menu_email_invoice');?></a></li>
			<?php endif; ?>

        <li><?php echo anchor('invoices/pdf/' . $row->id, $this->lang->line('menu_generate_pdf'), array('class' => 'emailpdf'));?></li>
        <li id="invprintli"><?php echo anchor('', $this->lang->line('menu_print_invoice'), array('class' => 'invprint', 'onclick' => 'print(); return false;'));?></li>
			<?php if ($row->amount_paid < $row->total_with_tax): ?>
			<li><?php echo anchor('invoices/edit/'.$row->id, $this->lang->line('menu_edit_invoice'), array('class' => 'invedit'));?></li>
			<?php endif; ?>

		<li><?php echo anchor('invoices/delete/'.$row->id, $this->lang->line('menu_delete_invoice'), array('class'=>'lbOn deleteConfirm'));?></li>
		<?php endif; ?>

<?php else: ?>
	<li class="menu_promo"><?php echo $this->lang->line('menu_catchphrase');?></li>
<?php endif; ?>