<?php
use doitphp\libraries as libraries;

(defined('BASEPATH') && ENVIRONMENT === 'development') OR exit('No direct script access allowed');

class Replace_valid extends MY_Controller {

	private static $_meta = '<meta charset="utf-8">';

	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper(array('directory', 'file'));

		$_root = APPPATH.'macro/table';
		
		self::_translate_valid(
			clone_folder(directory_map($_root), $_root, APPPATH . 'language/zh-cn')
		);
		
		
	}
	
	private static function _translate_valid($arr_path)
	{
		foreach ($arr_path as $csv_path => $php_path)
		{
			$arr_path[$csv_path] = str_replace('.csv', '_valid_rules_lang.php', strtolower($php_path));
		}
		var_dump($arr_path);
	}
	
	public function index()
	{
	}
}

/* End of file Replace_valid.php */
/* Location: ./application/controllers/Replace_valid.php */