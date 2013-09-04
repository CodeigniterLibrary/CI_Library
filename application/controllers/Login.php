<?php

class Login extends MY_Controller
{
	private static $_res;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		
		$this->lang->load('table');

		$this->_arr_res['arr_attention'] = $this->lang->line('table_attention');
		$this->_arr_res['arr_search'] = $this->lang->line('table_search');

		$name = 'Login';
		
		$lang = $this->config->config['language'].'/';
		$this->_mvc = array_merge(self::_get_view_name($lang), [
			'NAME' => $name,
			'VIEW_SHOW' => "{$lang}{$name}/show",
			'VIEW_EDIT' => "{$lang}{$name}/edit",
			'VIEW_DETAIL' => "{$lang}{$name}/detail",
		]);

	}
	
	public function index($data = [])
	{
		extract($this->_mvc);
	
		if (empty($_POST))
		{
			require(self::_get_macro_tmpl('login', 'view'));
		}
		else
		{
			
			if ($this->_valid_data(
				$this->lang->load("{$NAME}_valid_rules", '', TRUE)
				))
			{ // form 验证
				echo 'succ';
			}
			else
			{
				require(self::_get_macro_tmpl('login', 'view'));
			};
		}
	}

	public function chk_login()
	{	  
		$this->load->library('form_validation');
			
		$this->form_validation
			->set_rules('client_name', '用户名', 'required|min_length[5]|max_length[32]')
			->set_rules('client_pass', '密码', 'required|min_length[8]|max_length[24]');

		if ($this->form_validation->run() === FALSE)
		{
			$this->_show();
		}
		else
		{
			$this->form_validation->set_rules(
				array(
					array(
						'field' => 'null',
						'rules' => 'callback_hash_check'
					)
				)
			);
			
			if ($this->form_validation->run() === FALSE)
			{
				$this->_show();
			}
			else
			{
				$this->session->set_userdata(self::$_res);
				$this->_succ();
			}
		}
	}

	public function hash_check()
	{// 验证用户名
		
		$res = $this->db
			->where('client_name', $_POST['client_name'])
			->get('client')
			->row_array();
		
		if (empty($res) === false &&
			$res['client_pass'] === 
				my_hash($_POST['client_pass'], $res['client_name'], '4@0|K/2u4`hr', '{hB&3{fw4";,t'))
		{
			self::$_res = array(
				'id' => $res['client_id'],
				'name' => $res['client_name'],
				'purview' => $res['client_purview']);
			return true;
		}
		else
		{
			return false;
		}
	}
	
	private function _show()
	{
		$data['res'] = $_POST;
		$this->load->view('login_input', $data);
	}
	
	private function _succ()
	{
		$a = $this->db->query('SELECT * FROM `ci_sessions` LIMIT 0 , 30')->result();//_array();
		var_dump($_COOKIE, $a, self::$_res);
		
		$this->load->view('welcome_message');
	}
	
}

/* End of file Login.php */
/* Location: ./system/application/controllers/Login.php */
