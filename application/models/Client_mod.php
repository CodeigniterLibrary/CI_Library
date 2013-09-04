<?php
 
class Client_mod extends CI_Model
{
	
	private static $id = array('client_id');
	private static $time;
	public static $table;
	const _table = 'client';

	function __construct()
	{
		parent::__construct();
		
		if (true)
		{
			self::$table = '(select * from client where client_is_del = 0) as client';
		}
		else
		{
			self::$table = 'client';
		}
		self::$time = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
	}
	
	public function list_where($seek)
	{
		
		if (isset($seek['id']))
		{
			$seek['id'] !== '' ? 
				$this->db->where('client_id', $seek['id']) : 
				null;
			$seek['name'] !== '' ? 
				$this->db->like('client_name', $seek['name']) : 
				null;
			if (is_array(element('attention', $seek)))
			{
				$int = arr_int(element('attention', $seek));
				
				if ($seek['search'] === 'in') {
					$this->db->where('client_attention & '.$int.' > ', 0);
				}
				elseif ($seek['search'] === 'eq') {
					$this->db->where('client_attention & '.$int.' = ', $int);
				}
				elseif ($seek['search'] === 'neq') {
					$this->db->where('client_attention & '.$int.' = ', 0);
				}
				else {
					$this->db->where('client_attention & '.$int.' > ', 0);
				}
			}
		}
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
				'client_name' => $_POST['client_name'],
				'client_attention' => $_POST['client_attention'],
				'client_is_del' => 0,
				'ins_date' => self::$time
			]);
	}
	
	public function edit()
	{
		$this->db->where($this->db->check_where(self::$id, $this->input->get_post('id')))
			->update(self::_table, [
					'client_name' => $_POST['client_name'],
					'client_attention' => $_POST['client_attention']
				]);
	}
	
	public function delete()
	{
		$this->db->where($this->db->check_where(self::$id, $_POST['chkopt']))
			->update(self::_table, ['client_is_del' => 1]);
	}
	
	public function true_delete()
	{
		$this->db
			->where($this->db->check_where(self::$id, $_POST['chkopt']))
			->delete(self::$table);
	}
	
}

/* Location: ./application/models/Client_mod.php */