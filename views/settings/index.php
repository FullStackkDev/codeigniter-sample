<?php
$this->load->view('header');
$row = $query->row();
?>
<h2><?php echo $page_title;?></h2>

<?php echo $msg;?>

<p><?php echo $this->lang->line('settings_settings_default') . ' ' . $this->lang->line('bambooinvoice_logo'). ' ' . $this->lang->line('settings_will_use');?></p>

<?php echo form_open_multipart('settings', array('id' => 'settingsform', 'onsubmit' => 'return requiredFields("");'));?>

		
	<div id="settings_sections">
		<div class="controls">
			<a href="#account_settings" id="account_settings_menu">Account Settings</a>
			<a href="#invoice_settings" id="invoice_settings_menu">Invoice Settings</a>
			<a href="#advanced_settings" id="advanced_settings_menu">Advanced Settings</a>
		</div>

		
		<div class="scroller">
			<div class="content">
				<div class="section" id="account_settings">
  <p>
    <label for="company_name"><span><?php echo $this->lang->line('settings_company_name');?></span></label>
    <input class="requiredfield" name="company_name" type="text" id="company_name" size="50" value="<?php echo ($this->validation->company_name) ? ($this->validation->company_name) : ($row->company_name);?>" />
    <?php echo $this->validation->company_name_error; ?>
  </p>
  <p>
    <label for="address1"><span><?php echo $this->lang->line('clients_address1');?></span></label>
    <input name="address1" type="text" id="address1" size="50" value="<?php echo ($this->validation->address1) ? ($this->validation->address1) : ($row->address1);?>" />
    <?php echo $this->validation->address1_error; ?>
    <br />
    <label for="address2"><span><?php echo $this->lang->line('clients_address2');?></span></label>
    <input name="address2" type="text" id="address2" size="50" value="<?php echo ($this->validation->address2) ? ($this->validation->address2) : ($row->address2);?>" />
    <?php echo $this->validation->address2_error; ?>
  </p>
  <p>
    <label for="city"><span><?php echo $this->lang->line('clients_city');?></span></label>
    <input name="city" type="text" id="city" value="<?php echo ($this->validation->city) ? ($this->validation->city) : ($row->city);?>" />
    <?php echo $this->validation->city_error; ?>
  </p>
  <p>
    <label for="province"><span><?php echo $this->lang->line('clients_province');?></span></label>
    <input name="province" type="text" id="province" value="<?php echo ($this->validation->province) ? ($this->validation->province) : ($row->province);?>" />
    <?php echo $this->validation->province_error; ?>
  </p>
  <p>
    <label for="country"><span><?php echo $this->lang->line('clients_country');?></span></label>
    <input name="country" type="text" id="country" value="<?php echo ($this->validation->country) ? ($this->validation->country) : ($row->country);?>" />
    <?php echo $this->validation->country_error; ?>
  </p>
  <p>
    <label for="postal_code"><span><?php echo $this->lang->line('clients_postal');?></span></label>
    <input name="postal_code" type="text" id="postal_code" value="<?php echo ($this->validation->postal_code) ? ($this->validation->postal_code) : ($row->postal_code);?>" />
    <?php echo $this->validation->postal_code_error; ?>
  </p>
  <p>
    <label for="website"><span><?php echo $this->lang->line('clients_website');?></span></label>
    <input name="website" type="text" size="25" id="website" value="<?php echo ($this->validation->website) ? ($this->validation->website) : ($row->website);?>" />
    <?php echo $this->validation->website_error; ?>
  </p>
  <p>
    <label for="primary_contact"><span><?php echo $this->lang->line('settings_primary_contact');?></span></label>
    <input class="requiredfield" name="primary_contact" type="text" id="primary_contact" size="30" value="<?php echo ($this->validation->primary_contact) ? ($this->validation->primary_contact) : ($row->primary_contact);?>" />
    <?php echo $this->validation->primary_contact_error; ?>
  </p>
  <p>
    <label for="primary_contact_email"><span><?php echo $this->lang->line('settings_primary_email');?></span></label>
    <input class="requiredfield" name="primary_contact_email" type="text" id="primary_contact_email" size="30" value="<?php echo ($this->validation->primary_contact_email) ? ($this->validation->primary_contact_email) : ($row->primary_contact_email);?>" />
    <?php echo $this->validation->primary_contact_email_error; ?>
  </p>				</div>
				<div class="section" id="invoice_settings">
<!--
  <p>
    <label for="logo"><span><?php echo $this->lang->line('settings_logo');?> (png, jpg, gif)</span></label> 
    <input name="logo" type="file" id="logo" />
    <?php echo $this->validation->logo_error; ?>
	view current logo
  </p>
-->
  <p>
    <label for="invoice_note_default"><span><?php echo $this->lang->line('settings_default_note');?> <br /><?php echo $this->lang->line('settings_note_max_chars');?></span></label>
    <textarea name="invoice_note_default" id="invoice_note_default" cols="50" rows="5"><?php echo ($this->validation->invoice_note_default) ? ($this->validation->invoice_note_default) : str_replace('\n', "\n", ($row->invoice_note_default));?></textarea></label><br /><?php echo $this->validation->invoice_note_default_error; ?>
  </p>
  <p>
    <label for="tax_code"><span><?php echo $this->lang->line('settings_tax_code');?></span></label>
    <input class="requiredfield" name="tax_code" type="text" id="tax_code" size="50" value="<?php echo ($this->validation->tax_code) ? ($this->validation->tax_code) : ($row->tax_code);?>" />
    <?php echo $this->validation->tax_code_error; ?>
  </p>
  <p>
    <label for="currency_type"><span><?php echo $this->lang->line('settings_currency_type');?></span></label>
    <input class="requiredfield" name="currency_type" type="text" id="currency_type" size="20" value="<?php echo ($this->validation->currency_type) ? ($this->validation->currency_type) : ($row->currency_type);?>" />
    <?php echo $this->validation->currency_type_error; ?>
  </p>
  <p>
    <label for="currency_symbol"><span><?php echo $this->lang->line('settings_currency_symbol');?></span></label>
    <input class="requiredfield" name="currency_symbol" type="text" id="currency_symbol" size="20" value="<?php echo ($this->validation->currency_symbol) ? ($this->validation->currency_symbol) : ($row->currency_symbol);?>" />
    (ie: $ or &#163; or &#165;) <?php echo $this->validation->currency_symbol_error; ?>
  </p>
  <p>
    <label for="days_payment_due"><span><?php echo $this->lang->line('settings_days_payment_due');?></span></label>
    <input class="requiredfield" name="days_payment_due" type="text" id="days_payment_due" size="20" value="<?php echo ($this->validation->days_payment_due) ? ($this->validation->days_payment_due) : ($row->days_payment_due);?>" />
    (ie: 30) <?php echo $this->validation->days_payment_due_error; ?>
  </p>
  <p>
    <label for="tax1_desc"><span><?php echo $this->lang->line('invoice_tax1_description');?></span></label>
    <input name="tax1_desc" type="text" id="tax1_desc" value="<?php echo ($this->validation->tax1_desc) ? ($this->validation->tax1_desc) : ($row->tax1_desc);?>" />
    <?php echo $this->validation->tax1_desc_error; ?><br />
    <label for="tax1_rate"><span><?php echo $this->lang->line('invoice_tax1_rate');?> </span></label>
    <input name="tax1_rate" type="text" id="tax1_rate" value="<?php echo ($this->validation->tax1_rate) ? ($this->validation->tax1_rate) : ($row->tax1_rate);?>" />
    (ie: 6.25) <?php echo $this->validation->tax1_rate_error; ?>
  </p>
  <p>
    <label for="tax2_desc"><span><?php echo $this->lang->line('invoice_tax2_description');?></span></label>
    <input name="tax2_desc" type="text" id="tax2_desc" value="<?php echo ($this->validation->tax2_desc) ? ($this->validation->tax2_desc) : ($row->tax2_desc);?>" />
    <?php echo $this->validation->tax2_desc_error; ?><br />
    <label for="tax2_rate"><span><?php echo $this->lang->line('invoice_tax2_rate');?> </span></label>
    <input name="tax2_rate" type="text" id="tax2_rate" value="<?php echo ($this->validation->tax2_rate) ? ($this->validation->tax2_rate) : ($row->tax2_rate);?>" />
    (ie: 5.0) <?php echo $this->validation->tax2_rate_error; ?>
  </p>				</div>
				<div class="section" id="advanced_settings">
  <p>
    <label for="display_branding"><span><?php echo $this->lang->line('settings_display_branding');?></span></label>
    <input class="requiredfield" name="display_branding" type="checkbox" id="display_branding" size="20" value="y" <?php
	if ($this->validation->set_checkbox('display_branding', 'y')) {
		echo $this->validation->set_checkbox('display_branding', 'y');
	} else {
		if ($this->settings_model->getSetting('display_branding') == 'y') {
			echo 'checked="checked"';
		}
	} ?> />
<?php echo $this->validation->display_branding_error; ?>
  </p>
  <p>
    <label for="save_invoices"><span><?php echo $this->lang->line('settings_save_invoices');?></span></label>
    <input class="requiredfield" name="save_invoices" type="checkbox" id="save_invoices" size="20" value="y" <?php
	if ($this->validation->set_checkbox('save_invoices', 'y')) {
		echo $this->validation->set_checkbox('save_invoices', 'y');
	} else {
		if ($this->settings_model->getSetting('save_invoices') == 'y') {
			echo 'checked="checked"';
		}
	} ?> />
<?php echo $this->validation->save_invoices_error; ?><br />
	<span class="error"><?php echo $this->lang->line('settings_save_invoices_warning');?></span>
  </p>
  				</div>
			</div>
		</div>			
	</div>

  <p>
    <input type="submit" name="Submit" value="<?php echo $this->lang->line('settings_save_settings');?>" />
  </p>
</form>
<?php
$this->load->view('footer');
?>
