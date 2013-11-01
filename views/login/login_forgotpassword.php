<?php
$this->load->view('header');
?>
<h2><?php echo $page_title;?></h2>
<?php
if (isset($status) && $status == "1") {
	echo '<p class="error">' . $this->lang->line('login_password_sent') . '</p>' ;
} else {
?>
<p><?php echo $this->lang->line('bambooinvoice_logo') . ' ' . $this->lang->line('login_password_email');?></p>
<div id="loginformdiv">
<?php echo $this->validation->email_error; ?>
	<?php echo form_open('login/forgot_password', array('id' => 'loginform', 'onsubmit' => 'return checkform();'));?>

		<p>
		<label><span><?php echo $this->lang->line('clients_email');?>: </span><input type="text" name="email" id="email" maxlength="30" class="loginitem" size="30" /></label> <span id="userError" class="error"></span>
		<p>
		<label><input type="submit" name="login" id="login" value="<?php echo $this->lang->line('login_password_submit');?>" class="submitbutton" /></label>
		</p>
	</form>
</div>
<?php 
}
$this->load->view('footer');
?>