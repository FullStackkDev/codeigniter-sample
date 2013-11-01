<?php
Header('Cache-Control: no-cache');
Header('Pragma: no-cache');
$this->load->view('header');
echo $msg;
$this->load->view('common_assets/invoice_new.php');
?>
<h2><?php echo $page_title;?></h2>
<p class="button"><a href="<?php echo site_url('clients/newclient')?>" class="clientnew"><?php echo $this->lang->line('clients_create_new_client');?></a></p>
	<div id="clientContactEntry" style="display: none;">
	<?php echo form_open('#', array('id' => 'clientcontact', 'onsubmit' => 'ajaxAddContact(); return false;'));?>

	<h4 id="company_nameContact"></h4>
	<p class="error" id="ajaxstatus"></p>
	<p><input type="hidden" id="client_contact_id" name="client_contact_id" value="" /><label><span class="required"><?php echo $this->lang->line('clients_first_name');?>*:</span> <input type="text" name="first_name" id="first_name" size="25" maxlength="25" value="<?php echo $this->validation->first_name;?>" /></label><?php echo $this->validation->first_name_error; ?></p>
	<p><label><span class="required"><?php echo $this->lang->line('clients_last_name');?>*:</span> <input type="text" name="last_name" id="last_name" size="25" maxlength="25" value="<?php echo $this->validation->last_name;?>" /></label><?php echo $this->validation->last_name_error; ?></p>
	<p><label><span class="required"><?php echo $this->lang->line('clients_email');?>*:</span> <input type="text" name="email" id="email" size="25" maxlength="50" value="<?php echo $this->validation->email;?>" /></label><?php echo $this->validation->email_error; ?></p>
	<p><label><span><?php echo $this->lang->line('clients_phone');?>:</span> <input type="text" name="phone" id="phone" size="25" maxlength="50" value="<?php echo $this->validation->phone;?>" /></label><?php echo $this->validation->phone_error; ?></p>
	<p class="required">* <?php echo $this->lang->line('actions_required_fields');?></p>
	<p><input type="submit" name="createClient" id="createClient" value="<?php echo $this->lang->line('clients_add_contact');?>" /> <input type="button" value="<?php echo $this->lang->line('clients_cancel_add_contact');?>" name="close" id="close" /></p>
	</form>

	</div>
<?php foreach($all_clients->result() as $client): ?>
<h3 class="display clientHeader clientHeader<?php echo $client->id;?>"><a class="displayLink" id="client<?php echo $client->id;?>" href="#clientHeader<?php echo $client->id;?>"><?php echo $client->name;?></a></h3>
<div class="clientInfo" id="clientInfo<?php echo $client->id;?>">

<div class="contactList" id="contactList<?php echo $client->id;?>">
<h4><?php echo $this->lang->line('clients_contacts');?></h4>
<a href="<?php echo site_url('clientcontacts/add/' . $client->id)?>" id="clientToAdd<?php echo $client->id;?>" class="addcontact"><?php echo $this->lang->line('clients_add_contact');?><span style="display:none;"> <?php echo $this->lang->line('clients_to');?> <?php echo $client->name;?></span></a>
	<?php
		// client contact information
		$this->db->where('client_id', $client->id);
		$this->db->orderby("last_name", "first_name"); 
		$clientContacts = $this->db->get('clientcontacts');
		$clientContactCount = $clientContacts->num_rows();

	if (!$clientContactCount) {
		echo '<p id="nocontact' . $client->id . '">' . $this->lang->line('clients_no_invoice_listed') . ' ' . $client->name . '</p>';
	} else {
		foreach($clientContacts->result() as $contactRow):
			echo '<table id="clientTable' . $contactRow->id . '">';
			echo '<tr class="contactname"><td>';
			echo $contactRow->first_name . ' ' . $contactRow->last_name;
			echo '</td><td class="clienteditdelete">';
			echo anchor ('clientcontacts/edit/'.$contactRow->id, $this->lang->line('actions_edit')) . ' | ';
			echo anchor ('clientcontacts/delete/'.$contactRow->id, $this->lang->line('actions_delete'), array('class' => 'ajaxDelContact', 'id' => '_'.$contactRow->id));
			echo '</td></tr><tr><td colspan="2">';
			echo mailto($contactRow->email,$contactRow->email) . '<br />' . $contactRow->phone;
			echo '</td></tr>';
			echo '</table>';
		endforeach;
	}
	?>
</div>
<p><?php if ($client->address1 != '') {echo $client->address1;}?>
<?php if ($client->address2 != '') {echo ', ' . $client->address2;}?>
<?php if ($client->address1 != '' || $client->address2 != '') {echo '<br />';}?>
<?php if ($client->city != '') {echo $client->city;}?>
<?php if ($client->province != '') {echo ', ' . $client->province;}?>
<?php if ($client->country != '') {echo ', ' . $client->country;}?>
<?php if ($client->postal_code != '') {echo ' ' . $client->postal_code;}?>
<?php if ($client->city != '' || $client->province != '' || $client->country != '' || $client->postal_code != '') {echo '<br />';}?>
<?php echo auto_link(prep_url($client->website));?></p>
<p><?php echo $this->lang->line('invoice_tax_status');?>: <?php
if ($client->tax_status) {
echo "Taxable";
} else {
echo "Tax not applicable";
}
?></p>
<p><?php echo anchor('clients/edit/'.$client->id, $this->lang->line('clients_edit_client'), array('class' => 'clientedit'));?> | <?php echo anchor('clients/delete/'.$client->id, $this->lang->line('clients_delete_client'), array('class'=>'lbOn deleteConfirm clientdelete'));?></p>
<div class="clearer_r"></div>
</div>
<?php endforeach; ?>
<p><?php echo $this->lang->line('clients_you_have');?> <?php echo $total_rows;?> <?php echo $this->lang->line('clients_clients_registered');?></p>
<script type="text/javascript">
<!--<![CDATA[
	accorianClientDivs = document.getElementsByClassName('clientInfo');
	for (i=0; i<accorianClientDivs.length; i++) {
		accorianClientDivs[i].style.display = 'none'; // this seems to be the only way to kick IE's butt... setAttribute I miss you...
	}
// ]]> -->
</script>
<?php
$this->load->view('footer');
?>