<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://www.codeigniter.com/user_guide/general/hooks.html
|
*/

$hook['pre_controller'][] = array(
'class' => 'MyClasses',
'function' => 'index',
'filename' => 'pdf.php',
'filepath' => 'hooks'
);

?>