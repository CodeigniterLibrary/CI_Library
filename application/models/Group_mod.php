<?php

class Group_mod extends MY_Model {

	protected $_id = ['group_id'];
	protected $_table = 'group';

	protected function _list_where($seek = null)
	{
		$this->db->where('group_is_del', 0);

		$seek === null && $seek = $_GET;

		if (isset($seek['group_id']))
		{
			$sort = ele('sort', $seek);
			if ($sort)
			{
				$arr = explode('.', $sort);

				$this->db->order_by($arr[0], $arr[1]);
			};

			$seek['group_id'] !== '' && $this->db->where('group_id', $seek['group_id']);
			$seek['group_name'] !== '' && $this->db->like('group_name', $seek['group_name']);

			$int = arr_int(element('group_attention', $seek));
			if ($int !== 0)
			{

				if ($seek['search'] === 'in')
				{
					$this->db->where('group_attention & ' . $int . ' > ', 0);
				}
				elseif ($seek['search'] === 'eq')
				{
					$this->db->where('group_attention & ' . $int . ' = ', $int);
				}
				elseif ($seek['search'] === 'neq')
				{
					$this->db->where('group_attention & ' . $int . ' = ', 0);
				}
				else
				{
					$this->db->where('group_attention & ' . $int . ' > ', 0);
				};
			};
		};
	}

	public function get_id_arr($chkopt = null)
	{
		$chkopt === null && $chkopt = $this->input->get_post('chkopt');

		$this->_check_where($chkopt);
		$arr = $this->db
				->limit(1)
				->get($this->_table)
				->row_array();
		$arr['group_attention'] = int_arr($arr['group_attention']);
		return $arr;
	}

	public function add()
	{
		$this->db->insert($this->_table, [
			'group_name' => $_POST['group_name'],
			'group_attention' => arr_int($this->input->get_post('group_attention')),
			'group_is_del' => 0,
			'group_ins_date' => $_SERVER['REQUEST_TIME'],
			'group_up_date' => $_SERVER['REQUEST_TIME'],
		]);
	}

	public function edit()
	{
		$this->_check_where($this->input->get_post('chkopt'));
		$this->db
				->limit(1)
				->update($this->_table, [
					'group_attention' => arr_int($this->input->get_post('group_attention')),
					'group_up_date' => $_SERVER['REQUEST_TIME'],]);
	}

	public function delete()
	{ // 逻辑删除
		$this->_check_where($this->input->get_post('chkopt'));
		$this->db->update($this->_table, ['group_is_del' => 1]);
	}

	public function true_delete()
	{ // 对被逻辑删除的数据进行删除
		$this->db->where('group_is_del', 1)->delete($this->_table);
	}

}

/* Location: ./application/models/group_mod.php */