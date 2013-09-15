<?php  defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Form Value
 *
 * Grabs a value from the GET array for the specified field so you can
 * re-populate an input field or textarea.  If Form Validation
 * is active it retrieves the info from the validation class
 *
 * @access	public
 * @param	string
 * @return	mixed
 */

if ( ! function_exists('seek_value'))
{
	function seek_value($field = '', $default = '')
	{
		if (isset($_GET[$field]))
		{
			return form_prep($_GET[$field], $field);
		}
		else
		{
			return $default;
		}
	}
};

/*

*/
if ( ! function_exists('ymd_format'))
{
	function ymd_format()
	{
		return 'Y-m-d';
	}
}

if ( ! function_exists('say_sort'))
{// 用于排序
	function say_sort($sort_by)
	{
		if ( ! isset($arr))
		{
			$sort = ele('sort', $_GET);
			static $arr;
			if ($sort)
			{
				$arr = explode('.', $sort, 2);
			}
			else
			{
				$arr = ['', ''];
			};
		};
		
		
		if ($sort_by !== $arr[0])
		{
			return '.';
		}
		elseif ($arr[1] === '')
		{
			echo '-asc';
			return '.DESC';
		}
		else
		{
			echo '-desc';
			return '.';
		};
	}
}

if ( ! function_exists('get_img_name'))
{
	function get_img_name($str)
	{
		$str_ = '';
		for ($i=0, $i_=strlen($str); $i<$i_; ++$i)
		{
			if (($str[$i] >= 'A' && $str[$i] <= 'Z')
				OR ($str[$i] >= 'a' && $str[$i] <= 'z')
				OR ($str[$i] >= '0' && $str[$i] <= '9')
				OR $str[$i] === '.')
			{
				$str_ .= $str[$i];
			};
			
			if ($i > 40) {return $str_;};
		}
		
		return $str_;
	}
}


/**
hash
*/
if ( ! function_exists('my_hash'))
{
	function my_hash($pw, $db_salt, $salt_md5 = '4@64q#WWu4``hr', $salt_sha1 = '{YjeB&3{fw4";,t')
	{
		return base64_encode(
			sha1("{$db_salt}{$pw}{$salt_sha1}")
			^ md5("{$salt_md5}{$pw}{$db_salt}")
		);
	}
}

if ( ! function_exists('my_old_hash'))
{
	function my_old_hash($pw, $db_salt, $salt_md5 = '4@0|64K/2u4`hr', $salt_sha1 = '{hB&3hrt4{fw4";,t')
	{
		return base64_encode(
			sha1("{$db_salt}{$pw}{$salt_sha1}")
			^ md5("{$pw}{$db_salt}{$salt_md5}")
		);
	}
}

/**
base64
serialize
*/
if ( ! function_exists('form_url_encode'))
{
	function form_url_encode($input)
	{
		return strtr(
			base64_encode(
				serialize($input)
			), '+/=', '-_,'
		);
	}
}

if ( ! function_exists('form_url_decode'))
{
	function form_url_decode($input)
	{
		return unserialize(
			base64_decode(
				strtr($input, '-_,', '+/=')
			)
		);
	}
}

if ( ! function_exists('like_str'))
{
	function like_str($str)
	{
		return str_replace(array('%', '_'), array('\\%', '\\_'), $str);
	}
}

/**
 * Hidden Input Field 防重复转义
 *
 * Generates hidden fields.  You can pass a simple key/value string or an associative
 * array with multiple values.
 *
 * @access	public
 * @param	mixed
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_hidden2'))
{
	function form_hidden2($name, $value = '', $recursing = FALSE)
	{
		static $form;

		($recursing) OR $form = "\n";

		if (is_array($name))
		{
			foreach ($name as $key => $val)
			{
				form_hidden2($key, $val, TRUE);
			}
			return $form;
		}
		elseif ( ! is_array($value))
		{
			$form .= '<input type="hidden" name="'.$name.'" value="'.$value.'" />'."\n";
		}
		else
		{
			foreach ($value as $k => $v)
			{
				if (is_int($k))
				{
					form_hidden2("{$name}[]", $v, TRUE);
				}
				else
				{
					form_hidden2("{$name}[{$k}]", $v, TRUE);
				};
			}
		}

		return $form;
	}
}

if ( ! function_exists('form_area'))
{
	function form_area($name, $value = '', $recursing = FALSE)
	{
		$form = $recursing ? '' : "\n";

		if (is_array($name))
		{
			foreach ($name as $key => $val)
			{
				$form .= form_area($key, $val, TRUE);
			}
			return $form;
		}
		elseif (is_array($value))
		{
			foreach ($value as $k => $v)
			{
				if (is_int($k))
				{
					$form .= form_area("{$name}[]", $v, TRUE);
				}
				else
				{
					$form .= form_area("{$name}[{$k}]", $v, TRUE);
				};
			}
		}
		else
		{
			$form .= '<textarea name="'.$name.'">'.htmlspecialchars($value).'</textarea>'."\n";
		};

		return $form;
	}
}


/* End of file my_form_helper.php */
/* Location: ./application/helpers/my_form_helper.php */
