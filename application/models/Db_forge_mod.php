<?php
 
class Db_forge_mod extends CI_Model
{
	const table = '';
	private static $time;

	function __construct()
	{
		parent::__construct();
		self::$time = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
	}
	
}

/* Location: ./application/models/Client_mod.php */