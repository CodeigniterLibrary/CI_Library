<?php defined('BASEPATH') OR exit('No direct script access allowed');

//中

class GiiKiller extends CI_Controller
{
	private static $_map;
	private static $_root;

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('directory', 'file'));
		
		self::$_root = strtr($_SERVER['PATH_TRANSLATED'], '\\', '/').'/csv/';
		self::$_map = directory_map(self::$_root);
		
		var_dump(self::$_map
			, $_SERVER['PATH_TRANSLATED'] 
			, self::$_root);
		
		if ($table_name = $this->input->get_post('table_name'))
		{
			
			$arr_csv = get_csv_data(self::$_root . $table_name . '.csv');
			var_dump($arr_csv);
			
		}
		
		
	}
	
	public function test()
	{
	}
	
}

function get_csv_data($csv_file)
{
	$handle = fopen($csv_file, 'r');
	$i=0;
	
	$arr_csv = array();
	while ($data = fgetcsv($handle, 100, ','))
	{
		if ($i === 0)
		{
			$fn_columns = array(
				'COLUMN_NAME' => '',
				'ORDINAL_POSITION' => '',
				'COLUMN_DEFAULT' => '',
				'IS_NULLABLE' => 'is_nullable',
				'DATA_TYPE' => '',
				'CHARACTER_MAXIMUM_LENGTH' => '',
				'CHARACTER_OCTET_LENGTH' => '',
				'NUMERIC_PRECISION' => '',
				'NUMERIC_SCALE' => '',
				'CHARACTER_SET_NAME' => '',
				'COLLATION_NAME' => '',
				'COLUMN_TYPE' => '',
				'COLUMN_KEY' => '',
				'EXTRA' => '',
				'PRIVILEGES' => '',
				'COLUMN_COMMENT' => '',);
			
			foreach ($data as $column)
			{
				isset($fn_columns[$column]) OR die($column.'-COLUMN不存在');
			}
			$columns = $data;
		}
		else
		{
			foreach ($columns as $k=>$column)
			{
				if ($fn_columns[$column] !== '')
				{
					$arr_csv[$i][$column] = $fn_columns[$column]($data[$k]);
				}
				else
				{
					$arr_csv[$i][$column] = $data[$k];
				}
			}
		}
		
		++$i;
	}
	
	return $arr_csv;
}

function is_nullable($is_nullable)
{
	if ($is_nullable === '')
	{
		return 'YES';
	}
	elseif (strtoupper($is_nullable) === 'NO')
	{
		return 'NO';
	}
	else
	{
		return 'NO';
	}
}



/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */