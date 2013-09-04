<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Translate extends CI_Controller
{
	private static $_map;
	private static $_root;

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('directory', 'file'));
		
		self::$_root = $_SERVER['PATH_TRANSLATED'].DIRECTORY_SEPARATOR.'temp';
		self::$_map = directory_map(self::$_root);
		
		$this->lang->load('tr_'.get_lang(), '');
		
		if (isset($_GET['r']))
		{
			if ($_GET['r'] === 'arr_mb')
			{
				self::_get_arr_mb($this->lang->language);
			}
			elseif ($_GET['r'] === 'tran')
			{
				self::_translat_mb($this->lang->language);
			}
		}
		
	}
	
	private static function _get_arr_mb($old_arr)
	{
		$arr_value_inner = get_multibyte(self::$_map,self::$_root);
		
		$prefix = basename($_SERVER['PHP_SELF']);
		$new_arr = array();

		foreach ($arr_value_inner as $k=>$v)
		{
			if ((isset($k[0]) && isset($k[1])) &&
				(ord($k[0])=== 194 && ord($k[1])===160))
			{
				$k_ = substr($k, 2);
			}
			else
			{
				$k_ = $k;
			}
			
			if (in_array($k_, $old_arr) === false &&
				in_array($k_, $new_arr) === false)
			{
				$new_arr[] = $k_;
				echo "'{$prefix}' => '{$k_}',
				";
				// echo "'{$prefix}' => '{$k_}',<br/>";
			}
		}
	}
	
	private static function  _translat_mb($lang)
	{
		$dr = DIRECTORY_SEPARATOR;
		
		delete_files($_SERVER['PATH_TRANSLATED'].$dr.'comp');
		$arr_file = translat_mb(
			self::$_map,
			$_SERVER['PATH_TRANSLATED'].$dr.'temp',
			$_SERVER['PATH_TRANSLATED'].$dr.'comp'
		);
		
		$lang = sort_by_strlen($lang);
		
		
		$format_str = get_f_format_str();
		
		$f_fomat_trans = function($arr) use($format_str)
		{
			$temp_arr = array();
			foreach ($arr as $k=>$v)
			{
				$temp_arr[$format_str($k)] = $v;
			}
			return array_flip($temp_arr);
		};
		
		$lang = $f_fomat_trans($lang);
		
		var_dump($lang);
		
		foreach ($arr_file as $path_from => $path_to)
		{
			write_file(
				$path_to,
				strtr(read_file($path_from), $lang)
			);
		}
	}
	
	public function index()
	{
		// $this->load->view('welcome_message');
	}
	
}

function get_lang()
{
	$base = basename($_SERVER['PHP_SELF']);
		
	switch ($base)
	{
	case 'm_store':
		return 'test';
		break;
	case 'm_test':
		return 'test2';
		break;
	default:
		return 'default';
	}
}

function get_f_format_str()
{
	$base = basename($_SERVER['PHP_SELF']);
	
	switch ($base) 
	{
    case 'm_store':
        return function($str)
		{
			return '<{$resources.'.strtr($str, '.', '_').'}>';
		};
		break;
    case 'm_test':
        return function($str)
		{
			return 'res('.($str).')';
		};
		break;
	default:
        return function($str)
		{
			return $str;
		};
	}
	
}

function get_multibyte($file_arr, $path)
{
	static $dr = DIRECTORY_SEPARATOR;
	static $arr_data = array();

	foreach ($file_arr as $k=>$val)
	{
		if (is_array($val))
		{
			get_multibyte($val, $path.$dr.$k);
		}
		else
		{
			
			$str = read_file($path.$dr.$val);
			$i_ = strlen($str);
			
			$temp_char = '';
			$get_mb = false;
			
			for ($i=0; $i<$i_; ++$i)
			{
				$_char = $str[$i];
				
				// if ($_char > '~' && $get_mb===false)
				if ($_char >= '€' && $get_mb===false)
				{
					$get_mb = true;
					for ($j=$i-1; $n<100; --$j, ++$n)
					{
						if ( ! isset($str[$j])) {break;};
						$_chr = $str[$j];
						if ($_chr === '"'
							OR $_chr === "'"
							OR $_chr === '>'
							OR $_chr === '}'
							OR $_chr >= '€'
							OR $_chr === "\n")
						{
							break;
						}
						else
						{
							$temp_char = $_chr.$temp_char;
						}
					}
					$temp_char .= $_char;
				}
				elseif ($_char === '"'
					OR $_char === "'"
					OR $_char === '<'
					OR $_char === '{'
					OR $_char === "\n")
				{
					$arr_data[trim($temp_char, '&nbsp;')] = null;
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

function translat_mb($file_arr, $path_from, $path_to)
{
	//根据备份文件夹的路径新建$path_to文件夹, 并返回绝对路径数数。
	static $dr = DIRECTORY_SEPARATOR;
	static $path_from_to = array();
	
	if ((is_dir($path_to) === FALSE) && (mkdir($path_to, 0755) === FALSE))
	{
		exit('建目录失败');
	}
	
	foreach ($file_arr as $k=>$val)
	{
		if (is_array($val))
		{
			translat_mb(
				$val,
				$path_from.$dr.$k,
				$path_to.$dr.$k
			);
		}
		else
		{
			$path_from_to[$path_from.$dr.$val] = $path_to.$dr.$val;
		}
	}
	
	return $path_from_to;
}

function sort_by_strlen($arr)
{
	$temp_arr = array();
	foreach ($arr as $k=>$v)
	{
		$temp_arr[$k] = strlen($v);
	}

	arsort($temp_arr);

	$arr_ = array();

	foreach ($temp_arr as $k=>$v)
	{
		$arr_[$k] = $arr[$k];
	}
	return $arr_;
}



/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */