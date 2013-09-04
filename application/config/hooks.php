<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
  | -------------------------------------------------------------------------
  | Hooks
  | -------------------------------------------------------------------------
  | This file lets you define "hooks" to extend CI without hacking the core
  | files.  Please see the user guide for info:
  |
  |	http://codeigniter.com/user_guide/general/hooks.html
  |
 */

$hook = array(
	'pre_controller' => array(
		[
			'class' => 'MyClass',
			'function' => 'Myfunction',
			'filename' => 'MyClass.php',
			'filepath' => 'hooks',
		],
		[
			'function' => 'Myfunction',
			'filename' => 'MyFn.php',
			'filepath' => 'hooks',
			'params' => array('beer', 'wine', 'snacks'),
		],
	),
	'post_controller_constructor' => array(
		[
			'function' => 'my_autoload',
			'filename' => 'autoload.php',
			'filepath' => 'hooks',
		],
	),
);

/* End of file hooks.php */
/* Location: ./application/config/hooks.php */