<?php
$this->load->view('header');
?>
<h2><?php echo $page_title;?></h2>
<?php echo form_open('clientcontacts/add', array('id' => 'clientcontact'));?>
<input type="hidden" id="client_id" name="client_id" value="<?php echo $client_id;?>" />
<p><label><span class="required"><?php echo $this->lang->line('clients_first_name');?>*:</span> <input type="text" name="first_name" id="first_name" size="25" maxlength="25" value="<?php echo $this->validation->first_name;?>" /></label><?php echo $this->validation->first_name_error; ?></p>
<p><label><span class="required"><?php echo $this->lang->line('clients_last_name');?>*:</span> <input type="text" name="last_name" id="last_name" size="25" maxlength="25" value="<?php echo $this->validation->last_name;?>" /></label><?php echo $this->validation->last_name_error; ?></p>
<p><label><span class="required"><?php echo $this->lang->line('clients_email');?>*:</span> <input type="text" name="email" id="email" size="25" maxlength="50" value="<?php echo $this->validation->email;?>" /></label><?php echo $this->validation->email_error; ?></p>
<p><label><span><?php echo $this->lang->line('clients_phone');?>:</span> <input type="text" name="phone" id="phone" size="25" maxlength="50" value="<?php echo $this->validation->phone;?>" /></label><?php echo $this->validation->phone_error; ?></p>
<p class="required">* <?php echo $this->lang->line('actions_required_fields');?></p>
<p><input type="submit" name="createClient" id="createClient" value="<?php echo $this->lang->line('clients_save_client');?>" /></p>
</form>
<?php
$this->load->view('footer');
?>