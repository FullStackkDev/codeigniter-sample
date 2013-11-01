<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

function get_logo($logo = 'logo.jpg', $literal_path = TRUE)
{
	// if they don't have a logo in the database, just default to logo.jpg
	if ($logo == '0' || $logo == NULL) {
		$logo = 'logo.jpg';
	}

	if ($literal_path) {
		return '<img src="img/logo/' . $logo . '" /><br />';
	} else {

		if (read_file('./img/logo/' . $logo)) {
			return '<img src="' . base_url() . 'img/logo/' . $logo . '" /><br />';
		}
	}
}

?>