<?php

/**
 * say_name
 *
 * 用于显示详细页面数据 并用|分隔开字符串 
 *
 * @access	public
 * @param	string OR array
 * @param	array
 * @param	mixed
 * @return	string
 */
if ( ! function_exists('say_name'))
{
	function say_name($item, $array, $delimiter = '|')
	{
		if (is_array($item))
		{
			$str = '';
			foreach ($item as $val)
			{
				isset($array[$val]) && $str .= $array[$val].$delimiter;
			}
			return rtrim($str, $delimiter);
		}
		else
		{
			$str = '';
			foreach ($array as $k=>$val)
			{
				(($item & 1<<$k) !== 0) && $str .= $val.$delimiter;
			}
			return rtrim($str, $delimiter);
		};
	}
};


// ------------------------------------------------------------------------

/**
 * int_arr / arr_int
 *
 * 把int转成数组, 例 29 转 '11101' 转 array('0', '2', '3', '4') 反之也一样
 *
 * @access	public
 * @param	string
 * @return	array
 */
if ( ! function_exists('int_arr'))
{
	function int_arr($int)
	{
		$bin = decbin($int);
		$j = 0;
		$arr = array();
		for ($i=strlen($bin)-1; $i>=0; --$i)
		{
			($bin[$i] === '1') && $arr[] = $j;
			++$j;
		}
		return $arr;
	}
};

if ( ! function_exists('arr_int'))
{
	function arr_int($arr)
	{
		$int = 0;
		if (is_array($arr))
		{
			foreach ($arr as $v)
			{
				($v !== '') && $int += (1<<$v);
			}
		};
		return $int;
	}
};

if ( ! function_exists('ele'))
{
	function ele($item, $array, $default = FALSE)
	{
		if ( ! isset($array[$item]))
		{
			return $default;
		}
		else
		{
			return $array[$item];
		}
	}
};

/* End of file my_array_helper.php */
/* Location: ./system/helpers/my_array_helper.php */