<?php
 
class Book_mod extends CI_Model
{
	
	private static $id = array('book_id');
	private static $time;
	public static $table;
	const _table = 'book';

	function __construct()
	{
		parent::__construct();
		
		if (true)
		{
			self::$table = '(select * from book where book_is_del = 0) as book';
		}
		else
		{
			self::$table = 'book';
		}
		self::$time = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
	}
	
	public function list_where($seek)
	{
		
		if (isset($seek['id']))
		{
			$seek['id'] !== '' ? 
				$this->db->where('book_id', $seek['id']) : 
				null;
			$seek['name'] !== '' ? 
				$this->db->like('book_name', $seek['name']) : 
				null;
			if (is_array(element('attention', $seek)))
			{
				$int = arr_int(element('attention', $seek));
				
				if ($seek['search'] === 'in') {
					$this->db->where('book_attention & '.$int.' > ', 0);
				}
				elseif ($seek['search'] === 'eq') {
					$this->db->where('book_attention & '.$int.' = ', $int);
				}
				elseif ($seek['search'] === 'neq') {
					$this->db->where('book_attention & '.$int.' = ', 0);
				}
				else {
					$this->db->where('book_attention & '.$int.' > ', 0);
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
				'book_name' => $_POST['book_name'],
				'book_attention' => $_POST['book_attention'],
				'book_is_del' => 0,
				'ins_date' => $_SERVER['REQUEST_TIME'],
				'up_date' => $_SERVER['REQUEST_TIME'],
			]);
	}
	
	public function edit()
	{
		$this->db->where($this->db->check_where(self::$id, $this->input->get_post('id')))
			->update(self::_table, [
					'book_name' => $_POST['book_name'],
					'book_attention' => $_POST['book_attention'],
					'up_date' => $_SERVER['REQUEST_TIME'],
				]);
	}
	
	public function delete()
	{
		$this->db->where($this->db->check_where(self::$id, $_POST['chkopt']))
			->update(self::_table, ['book_is_del' => 1]);
	}
	
	public function true_delete()
	{
		$this->db
			->where($this->db->check_where(self::$id, $_POST['chkopt']))
			->delete(self::$table);
	}
	
}

/* Location: ./application/models/book_mod.php */