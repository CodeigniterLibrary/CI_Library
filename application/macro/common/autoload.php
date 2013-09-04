<?php

if ( ! function_exists('__autoload'))
{
	function __autoload($class)
	{
		if ( ! isset($prefix))
		{
			static $prefix;
			$prefix = config_item('subclass_prefix');
		};
		
		if (strpos($class, $prefix) === 0)
		{
			require(APPPATH . "core/{$class}.php");
		}
		else
		{
			strpos($class, 'CI_') !== 0 && require(APPPATH . "third_party/{$class}.php");
		}
	}
};

/* ./application/macro/common/autoload.php */