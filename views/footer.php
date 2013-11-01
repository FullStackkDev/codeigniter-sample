      <div id="footer">
        <p><?php echo $this->lang->line('bambooinvoice_logo');?> &copy; <?php echo date("Y");?> (<?php echo $this->lang->line('bambooinvoice_version');?> <?php echo $this->settings_model->getSetting('bambooinvoice_version');?>)</p>
      </div>
    </div>
  </div>
</div>
<?php if ($this->settings_model->getSetting('demo_flag') == 'y'):?>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-316888-7";
urchinTracker();
// the link is available by now, 
if ($('bamboodownload')) {
	$('bamboodownload').onclick = function() {
		urchinTracker('bamboodownload');
		return true;
	}
}
</script>
<?php endif;?>
</body>
</html>