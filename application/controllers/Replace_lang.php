<?php
use doitphp\libraries as libraries;

(defined('BASEPATH') && ENVIRONMENT === 'development') OR exit('No direct script access allowed');

class Replace_lang extends MY_Controller {

	private static $_arr_root;
	private static $_lang;
	private static $_meta = '<meta charset="utf-8">';

	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper(array('directory', 'file'));

		self::$_arr_root = [
			APPPATH . 'views/',
			BASEPATH . 'language/',
			APPPATH . 'language/',
		];
		
		require(self::_get_macro_tmpl('autoload'));
	}

	public function index()
	{
		$arr_r = array(
			'tran' => '_translate',
				// 'seek' => '_seek_multibyte',
		);

		$r = $this->input->get_post('r');
		
		if ($this->input->get_post('all_csv'))
		{
			$all_csv = $this->input->get_post('all_csv');
		}
		else
		{
			$all_csv = ['zh-tw' => FALSE,];
		}
		
		if (isset($arr_r[$r]))
		{
			foreach ($all_csv as $k => $v)
			{
				self::$arr_r[$r]($k, $v);
			}
		}
		else
		{
			foreach ($all_csv as $k => $v)
			{
				self::_seek_multibyte($k, $v);
			}
		}
	}

	private static function _seek_multibyte($to = FALSE, $from = FALSE)
	{
		$to OR $to = 'zh-tw';
		$from OR $from = 'zh-cn';

		$arr = [];
		foreach (self::$_arr_root as $_root)
		{
			$arr = get_multibyte(directory_map("{$_root}{$from}"), "{$_root}{$from}");
		}
		
		$arr_csv = libraries\csv::readCsvKV(self::_get_macro_csv("{$from}-to-{$to}"));
		
		$lang_file = self::_get_macro_tmpl("{$from}-to-{$to}", 'lang');
		
		if (file_exists($lang_file))
		{
			$lang = require($lang_file);
			foreach ($arr as $k => $v)
			{
				(isset($arr_csv[$k])) OR $arr_csv[$k] = strtr($k, $lang);
			}
		}
		else
		{
			foreach ($arr as $k => $v)
			{
				(isset($arr_csv[$k])) OR $arr_csv[$k] = $v;
			}
		}
		
		write_file(
					self::_get_macro_csv("new-{$from}-to-{$to}")
					, libraries\csv::takeCsvKV($arr_csv)
			);
	}

	private static function _translate($to = FALSE, $from = FALSE)
	{
		$to OR $to = 'zh-tw';
		$from OR $from = 'zh-cn';
		
		self::$_lang = libraries\csv::readCsvKV(self::_get_macro_csv("{$from}-to-{$to}"));
		if (is_array(self::$_lang))
		{
			foreach (self::$_arr_root as $_root)
			{
				self::_replace_file($_root, $from, $to);
			}
		}
	}

	private static function _replace_file($_root, $from, $to)
	{
		$_map = directory_map($_root . $from);

		$arr_file = clone_folder(
				$_map
				, $_root . $from
				, $_root . $to
		);

		foreach ($arr_file as $path_from => $path_to)
		{
			write_file(
					$path_to
					, strtr(read_file($path_from), self::$_lang)
			);
		}
		
		echo(self::$_meta);
		echo '成功';
	}

}

function get_multibyte($file_arr, $path)
{
	static $arr_data = array();

	foreach ($file_arr as $k => $val)
	{
		if (is_array($val))
		{
			get_multibyte($val, $path . '/' . $k);
		}
		else
		{

			$str = read_file($path . '/' . $val);
			$i_ = strlen($str);

			$temp_char = '';
			$get_mb = false;

			for ($i = 0; $i < $i_;  ++ $i)
			{
				$_char = $str[$i];

				// if ($_char > '~' && $get_mb === false)
				if ($_char >= '€' && $get_mb === false)
				{
					$get_mb = true;
					$n = 0;
					for ($j = $i - 1; $n < 100;  -- $j, ++ $n)
					{
						if ( ! isset($str[$j]))
						{
							break;
						};

						$_chr = $str[$j];

						if ($_chr === '"' OR $_chr === "'" OR $_chr === '>' OR $_chr === '}' OR $_chr >= '€' OR $_chr === "\n")
						{
							break;
						}
						else
						{
							$temp_char = $_chr . $temp_char;
						}
					}
					$temp_char .= $_char;
				}
				elseif ($_char === '"' OR $_char === "'" OR $_char === '<' OR $_char === '{' OR $_char === "\n")
				{
					$trim_key = trim(trim(trim($temp_char, '&nbsp;')), '&nbsp;');
					(mb_strlen($trim_key) !== strlen($trim_key)) && $arr_data[$trim_key] = Null;
					$temp_char = '';
					$get_mb = false;
				}
				elseif ($get_mb)
				{
					$temp_char .= $_char;
				}
			}
		}
	}

	return $arr_data;
}

function clone_folder($file_arr, $path_from, $path_to)
{
	//根据备份文件夹的路径新建$path_to文件夹, 并返回绝对路径数数。
	static $path_from_to = array();

	if ((is_dir($path_to) === FALSE) && (@mkdir($path_to, 0755) === FALSE))
	{
		exit('建目录失败');
	};

	foreach ($file_arr as $k => $val)
	{
		if (is_array($val))
		{
			clone_folder($val, $path_from . '/' . $k, $path_to . '/' . $k);
		}
		else
		{
			$path_from_to[$path_from . '/' . $val] = $path_to . '/' . $val;
		}
	}

	return $path_from_to;
}

/* End of file Replace_lang.php */
/* Location: ./application/controllers/Replace_lang.php */