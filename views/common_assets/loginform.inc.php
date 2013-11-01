<div id="loginformdiv">
	<?php echo form_open('login', array('id' => 'loginform', 'onsubmit' => 'return checkform();'));?>
		<p><label><span><?php echo $this->lang->line('login_username');?>: </span><input type="text" name="username" id="username" value="<?php if ($this->settings_model->getSetting('demo_flag') == 'y') {echo 'info@bambooinvoice.org';}?>" maxlength="50" class="loginitem" size="30" /></label> <span id="userError" class="error"></span></p>
		<p><label><span><?php echo $this->lang->line('login_password');?>: </span><input type="password" name="password" id="password" value="<?php if ($this->settings_model->getSetting('demo_flag') == 'y') {echo 'demo';}?>" maxlength="100" class="loginitem" size="30" /></label> <span id="passError" class="error"></span></p>
<!--	<p><label><input type="checkbox" name="rememberme" id="rememberme" class="noborder" value="true" /> <?php echo $this->lang->line('login_remember_me');?></label></p>-->
		<p>
		<label><input type="submit" name="login" id="login" value="<?php echo $this->lang->line('login_login');?>" class="submitbutton" /></label>
		</p>
		<p><?php echo anchor('login/forgot_password', $this->lang->line('login_forgot_password'));?></p>
	</form>
</div>
