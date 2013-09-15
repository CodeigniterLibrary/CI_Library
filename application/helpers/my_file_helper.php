<?php

if ( ! function_exists('clone_folder'))
{
	function clone_folder($file_arr, $path_from, $path_to, $recursing = FALSE)
	{ // 根据备份文件夹的路径新建$path_to文件夹, 并返回绝对路径数组。
		static $path_from_to;
		($recursing) OR $path_from_to = array();

		if ((is_dir($path_to) === FALSE) && (@mkdir($path_to, 0755) === FALSE))
		{
			exit('建目录失败');
		};

		foreach ($file_arr as $k => $val)
		{
			if (is_array($val))
			{
				clone_folder($val, $path_from . '/' . $k, $path_to . '/' . $k, TRUE);
			}
			else
			{
				$path_from_to[$path_from . '/' . $val] = $path_to . '/' . $val;
			}
		}

		return $path_from_to;
	}
};

/* End of file my_file_helper.php */
/* Location: ./application/helpers/my_file_helper.php */