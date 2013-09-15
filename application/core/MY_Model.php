<?php

class MY_Model extends CI_Model {

	protected $_id = [];
	
	protected $_table = '';
	
	public function get_all_query()
	{
		$this->_list_where();

		return $this->db->get($this->_table);
	}
	
	public function get_pagination_arr($config = [])
	{
		$this->_list_where();

		$query = $this->db->get($this->_table);
		
		$config['total_rows'] = $query->num_rows;

		$this->load->library('pagination');
		$this->pagination->initialize($config);
		
		return $query->result_array_slice($config['per_page'], $this->input->get_post('per_page'));
	}
	
	protected function _check_where($chkopt)
	{
		$this->db->where($this->_opt_where($this->_id, $chkopt), null, false);
	}
	
	protected function _list_where() {}
	
	private function _opt_where($arr_id, $chkopt, $delimiter=':')
	{
		(is_string($chkopt)) && $chkopt = array($chkopt);
		
		(is_string($arr_id)) && $arr_id = array($arr_id);
		
		$arr_chkopt = [];
		foreach ($chkopt as $value)
		{
			$pieces = explode($delimiter, $value);
			$row = '';
			for ($i=0; $i<count($pieces); ++$i)
			{
				$row .= ",{$this->db->escape($pieces[$i])}";
			}
			$arr_chkopt[] = substr($row, 1);
		}
		
		return ' ('.implode(',', $arr_id).') in (('.implode('), (', $arr_chkopt).')) ';
	}
	
	private function _opt_where2($arr_id, $chkopt, $delimiter=':')
	{
		(is_string($chkopt)) && $chkopt = array($chkopt);
		
		(is_string($arr_id)) && $arr_id = array($arr_id);
		
		$arr_chkopt = [];
		foreach ($chkopt as $value)
		{
			$pieces = explode($delimiter, $value);
			$row = '';
			$i = 0;
			foreach ($arr_id as $row_name)
			{
				$row .= "{$row_name} = {$this->db->escape($pieces[$i])} and ";
				++$i;
			}
			$arr_chkopt[] = '('.substr($row, 0, -4).')';
		}
		return ' ('.implode(' OR ', $arr_chkopt).') ';
	}
	
}

// END MY_Moder class

/* End of file MY_Moder.php */
/* Location: ./application/core/MY_Moder.php */
