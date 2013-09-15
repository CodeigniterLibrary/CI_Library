<?php

if ( ! function_exists('__autoload'))
{
	function __autoload($class)
	{
		(strpos($class, '\\') !== FALSE) && require(APPPATH . 'third_party/'.strtr($class, '\\', '/').'.php');
	}
};

/* ./application/macro/common/autoload.php */