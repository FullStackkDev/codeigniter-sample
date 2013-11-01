<?php

class Utilities extends Controller {

	function __construct()
	{
		parent::Controller();
		if (!$this->site_sentry->is_logged_in()) {redirect('login/');exit;}
	}	
	
	function index()
	{
		$this->load->helper('file');

		$data['page_title'] = $this->lang->line('menu_utilties');

		$this->load->view('utilities/index', $data);
	}

	/*
	 * TO DO
	 * new version check... not currently implemented
	 */
	function new_version_check()
	{
		$data['page_title'] = 'New Version Check';//$this->lang->line('utilties_new_version_check');

		$data['message'] = 'not currently implemented';	
		$this->load->view('utilities/new_version_check', $data);
	}

	function database_backup()
	{
		if ($this->settings_model->getSetting('demo_flag') == 'y') {

			$data['page_title'] = $this->lang->line('utilities_phpinfo_not_available');
            $data['output'] = '<p>' . $this->lang->line('utilities_phpinfo_not_available') . '</p>';
			$this->load->view('utilities/phpinfo', $data);

		} else {

		// Load the DB utility class
		$this->load->dbutil();
		$this->load->helper('file');
		$this->load->helper('download');
		
		$prefs = array(
                'format'      => 'zip',
                'filename'    => 'bambooinvoice_' . date ("Ymd") . '.zip',
		);		
		// Backup your entire database and assign it to a variable
		$backup =& $this->dbutil->backup($prefs);
		write_file('invoices_temp/' . $prefs['filename'], $backup);
		force_download($prefs['filename'], $backup);
		
		}
	}
	
    function php_info()
    {
		$data['page_title'] = $this->lang->line('utilities_phpinfo');
					
        // We use this conditional only for demo installs.
        // It prevents users from viewing this function

		if ($this->settings_model->getSetting('demo_flag') == 'y') {
            $data['output'] = '<p>' . $this->lang->line('utilities_phpinfo_not_available') . '</p>';
		} else {
        
			ob_start();
			
			phpinfo();
			
			$buffer = ob_get_contents();
			
			ob_end_clean();
			
			// OK, the output from PHPinfo is ugly and messy, but I'm not going through it to clear
			// everything out.  This is how ExpressionEngine handles PHPinfo, and I'm happy to blatently
			// steal from there for this function.
			
			$output = (preg_match("/<body.*?".">(.*)<\/body>/is", $buffer, $match)) ? $match['1'] : $buffer;
			$output = preg_replace("/width\=\".*?\"/", "width=\"100%\"", $output);        
			$output = preg_replace("/<hr.*?>/", "<br />", $output); // <?
			$output = preg_replace("/<a href=\"http:\/\/www.php.net\/\">.*?<\/a>/", "", $output);
			$output = preg_replace("/<a href=\"http:\/\/www.zend.com\/\">.*?<\/a>/", "", $output);
			$output = preg_replace("/<a.*?<\/a>/", "", $output);// <?
			$output = preg_replace("/<th(.*?)>/", "<th \\1 align=\"left\" class=\"tableHeading\">", $output); 
			$output = preg_replace("/<tr(.*?).*?".">/", "<tr \\1>\n", $output);
			$output = preg_replace("/<td.*?".">/", "<td valign=\"top\" class=\"tableCellOne\">", $output);
			$output = preg_replace("/cellpadding=\".*?\"/", "cellpadding=\"2\"", $output);
			$output = preg_replace("/cellspacing=\".*?\"/", "", $output);
			$output = preg_replace("/<h2 align=\"center\">PHP License<\/h2>.*?<\/table>/si", "", $output);
			$output = preg_replace("/ align=\"center\"/", "", $output);
			$output = preg_replace("/<table(.*?)bgcolor=\".*?\">/", "\n\n<table\\1>", $output);
			$output = preg_replace("/<table(.*?)>/", "\n\n<table\\1 class=\"tableBorderNoBot\" cellspacing=\"0\">", $output);
			$output = preg_replace("/<h2>PHP License.*?<\/table>/is", "", $output);
			$output = preg_replace("/<br \/>\n*<br \/>/is", "", $output);
			$output = str_replace("<h1></h1>", "", $output);
			$output = str_replace("<h2></h2>", "", $output);
													
			$data['output'] = $output;
		}
		$this->load->view('utilities/phpinfo', $data);
    }

	
}
?>