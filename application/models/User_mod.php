<?php

class User_mod extends MY_Model {

	protected $_id = ['user_id'];
	protected $_table = 'user';

	protected function _list_where($seek = null)
	{
		$this->db->where('user_is_del', 0);

		$seek === null && $seek = $_GET;

		if (isset($seek['user_id']))
		{
			$sort = ele('sort', $seek);
			if ($sort)
			{
				$arr = explode('.', $sort);

				$this->db->order_by($arr[0], $arr[1]);
			};

			$seek['user_id'] !== '' && $this->db->where('user_id', $seek['user_id']);
			$seek['user_name'] !== '' && $this->db->like('user_name', $seek['user_name'], 'after');
			$seek['user_email'] !== '' && $this->db->where('user_email', $seek['user_email']);
			$seek['user_phone'] !== '' && $this->db->like('user_phone', $seek['user_phone'], 'after');

			$int = arr_int(element('user_attention', $seek));
			if ($int !== 0)
			{

				if ($seek['search'] === 'in')
				{
					$this->db->where('user_attention & ' . $int . ' > ', 0);
				}
				elseif ($seek['search'] === 'eq')
				{
					$this->db->where('user_attention & ' . $int . ' = ', $int);
				}
				elseif ($seek['search'] === 'neq')
				{
					$this->db->where('user_attention & ' . $int . ' = ', 0);
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
		$arr['user_attention'] = int_arr($arr['user_attention']);
		return $arr;
	}

	public function add()
	{
		$salt = uniqid();
		$this->db->insert($this->_table, [
			'user_name' => $_POST['user_name'],
			'user_email' => $_POST['user_email'],
			'user_phone' => $_POST['user_phone'],
			'user_attention' => arr_int($this->input->get_post('user_attention')),
			'user_pass' => my_hash($_POST['user_pass'], "{$_POST['user_name']}{$salt}"),
			'user_salt' => $salt,
			'user_is_del' => 0,
			'user_ins_date' => $_SERVER['REQUEST_TIME'],
			'user_up_date' => $_SERVER['REQUEST_TIME'],
		]);
	}

	public function edit()
	{
		$this->_check_where($this->input->get_post('chkopt'));
		$this->db
				->limit(1)
				->update($this->_table, [
					'user_phone' => $_POST['user_phone'],
					'user_attention' => arr_int($this->input->get_post('user_attention')),
					'user_up_date' => $_SERVER['REQUEST_TIME'],]);
	}

	public function delete()
	{ // 逻辑删除
		$this->_check_where($this->input->get_post('chkopt'));
		$this->db->update($this->_table, ['user_is_del' => 1]);
	}

	public function true_delete()
	{ // 对被逻辑删除的数据进行删除
		$this->db->where('user_is_del', 1)->delete($this->_table);
	}

}

/* Location: ./application/models/user_mod.php */