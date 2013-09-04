<?php

class MY_Form_validation extends CI_Form_validation {
	
	protected function is_login($jy, $hash)
	{
		$arr = explode('.', $hash, 2);
		
		$str = $_POST[$arr[0]];
		if (preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str))
		{// 邮箱
			$field = 'user_email';
		}
		elseif (preg_match('/^[\-+]?[0-9]+$/', $str))
		{// 手机
			$field = 'user_phone';
		}
		else
		{// 用户名
			$field = 'user_name';
		}
			
		$row = $this->CI
			->db
			->limit(1)
			->select(['user_name', 'user_email', 'user_phone', 'user_pass', 'user_salt'])
			->get_where('user', [$field => $str])
			->row_array();
		
		if ($row)
		{
			if (my_hash($_POST[$arr[1]], "{$row['user_name']}{$row['user_salt']}") === $row['user_pass'])
			{
				return TRUE;
			}
			elseif (my_old_hash($_POST[$arr[1]], "{$row['user_name']}{$row['user_salt']}") === $row['user_pass'])
			{
				$salt = uniqid();
				$this->CI
						->db
						->limit(1)
						->where([$field => $str])
						->update('user', [
							'user_pass' => my_hash($_POST[$arr[1]], "{$row['user_name']}{$salt}"),
							'user_salt' => $salt,
							'user_up_date' => $_SERVER['REQUEST_TIME'],]);
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}
		else
		{
			return FALSE;
		}
		
	}
	
	protected function is_strong($value)
	{
		$len = strlen($value);
		$level = [];
		$str = '';
		for ($i=0; $i<$len; $i++)
		{
			$str = $value[$i];
			if ($str < ' ' && $str > '/')
			{
				$level['num'] = '';
			}
			elseif (($str < '{' && $str > '`')
				OR ($str < '[' && $str > '@'))
			{
				$level['eng'] = '';
			}
			else
			{
				$level['symbol'] = '';
			}
		}
		
		return count($level) > 1;
	}
	
	protected function is_print($value)
	{// 检查是否是半角
		$len = strlen($value);
		
		for ($i=0;$i<$len;$i++)
		{
			if ($value[$i] < ' ' OR $value[$i] > '~')
			{
				return FALSE;
			};
		}
		
		return TRUE;
	}
	
	protected function is_unique($value, $params)
	{
		// $arr['table', 'field']
		$arr = explode('.', $params, 2);
		return $this
				->CI
				->db
				->limit(1)
				->get_where($arr[0], [$arr[1] => $_POST[$arr[1]]])
				->num_rows() === 0;
	}
	
	protected function update_unique($value, $params)
	{// 如果update时没有改变原值，则验证通过。如果改变且unique，也通过。
		// $arr['table', 'field', 'id_key', 'chkopt'];
		$arr = explode('.', $params, 4);
		
		$arr_id_key = explode(':', $arr[2]);
		
		if (isset($_GET[$arr[3]]))
		{
			$chkopt = $_GET[$arr[3]];
		}
		else
		{
			$chkopt = $_POST[$arr[3]];
		}
		
		if (is_array($chkopt))
		{
			$arr_id = array_combine($arr_id_key, explode(':', $chkopt[0]));
		}
		else
		{
			$arr_id = array_combine($arr_id_key, explode(':', $chkopt));
		}
		
		$arr_id_key[] = $arr[1];
		$row = $this
				->CI
				->db
				->select($arr_id_key)
				->limit(1)
				->get_where($arr[0], [$arr[1] => $_POST[$arr[1]]])
				->row_array();
		
		if (empty($row))
		{
			return TRUE;
		}
		else
		{
			foreach ($arr_id as $k=>$v)
			{
				if ($v !== $row[$k])
				{
					return FALSE;
				};
			}
			return TRUE;
		}
	}
	
	/**
	 * NO Email
	 *
	 * @access	protected
	 * @param	string
	 * @return	bool
	 */
	protected function no_email($str)
	{
		return ! (preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str) OR preg_match('/^[\-+]?[0-9]+$/', $str));
	}
}

// END MY_Form_validation Class

/* End of file MY_Form_validation.php */
/* Location: ./system/libraries/MY_Form_validation.php */