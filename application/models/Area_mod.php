<?php
 
class Area_mod extends CI_Model
{
	private static $id = array('area_id');
	private static $time;
	
	public static $table;
	const _table = 'area';

	function __construct()
	{
		parent::__construct();
		self::$time = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
		
		if (true)
		{
			self::$table = '(select * from area where area_is_del = 0) as area';
		}
		else
		{
			self::$table = 'area';
		}
		self::$time = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
	}
	
	public function list_where($seek)
	{
		$seek = $this->db->escape_str($seek);
		
		$sql = '';
		if (isset($seek['id']))
		{
			$sql = 
				($seek['id'] !== ''
					? " AND area_id = {$seek['id']}"
					: '')
				. ($seek['name'] !== ''
					? " AND area_name like '%".like_str($seek['name'])."%'"
					: '')
				;

			if (is_array(ele('area', $seek)))
			{
				$int = arr_int(ele('area', $seek));
				
				switch($seek['search'])
				{
					case 'in':
						$sql .= ' AND area_int & '.$int.' > 0'; 
						break;
					case 'eq':
						$sql .= ' AND area_int & '.$int.' = '.$int; 
						break;
					case 'neq':
						$sql .= ' AND area_int & '.$int.' = 0'; 
						break;
					default:
						$sql .= ' AND area_int & '.$int.' > 0';
						break;
				}
			}
		}
		
		return $sql !== ''
			? substr($sql, 4)
			: '';
	}
	
	public function get_id_arr($id)
	{
		return $this->db
			->where($this->db->check_where(self::$id, $id), null, false)
			->get(self::$table)->row_array();
	}
	
	public function add()
	{
		$this->db->insert(self::_table, [
				'area_name' => $_POST['area_name'],
				'area_int' => $_POST['area_int'],
				'area_is_del' => 0,
				'area_ins_date' => self::$time
			]);
	}
	
	public function edit()
	{
		$this->db->where($this->db->check_where(self::$id, $this->input->get_post('id')))
			->update(self::_table, [
					'area_name' => $_POST['area_name'],
					'area_int' => $_POST['area_int']
				]);
	}
	
	public function delete()
	{
		$this->db->where($this->db->check_where(self::$id, $_POST['chkopt']));
		$this->db->delete(self::$table);
	}
	
}

/* Location: ./application/models/Area_mod.php */