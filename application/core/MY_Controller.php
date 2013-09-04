<?php

class MY_Controller extends CI_Controller {
	
	protected $_mvc = [];
	protected $_arr_res = [];
	
	public function index()
	{
		// $tmpl = self::_get_smarty();
		// $tmpl = self::_get_smarty();
		// $tmpl->display('test/index2.tpl');
		$this->show();
	}
	
	protected function show()
	{
		show_404();
	}
	
	protected static function _get_smarty($conf = [])
	{
		$smarty_path = APPPATH.'smarty/';

		require_once(APPPATH.'third_party/smarty/Smarty.php');
		
		$smarty = new Smarty;
		
		foreach (array_merge([
			'compile_check' => 'true',
			// 'debugging' => 'true',
			'caching' => 'true',
			'cache_lifetime' => 120,
			// 'force_compile' => 'true',
			// 'left_delimiter' => '<{',  
			// 'right_delimiter' => '}>',
			'template_dir' => "{$smarty_path}templates",
			'compile_dir' => "{$smarty_path}templates_c",
			'cache_dir' => "{$smarty_path}cache",
			'config_dir' => "{$smarty_path}configs",
			],
			$conf) as $k => $v)
		{
			$smarty->$k = $v;
		}
		
		return $smarty;
	}
	
	protected function _valid_data($config)
	{
		foreach ($config as $v)
		{// 根据要检查的字段进行防xss转义
			$k = $v['field'];
			isset($_POST[$k]) && $_POST[$k] = str_replace(["'", '"'], ['&#39;', '&quot;'], htmlspecialchars($_POST[$k]));
		}
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules($config);

		return $this->form_validation->run();
	}
	
	protected static function _get_macro_tmpl($file_name, $dir = 'common')
	{
		return is_array($file_name)
			? APPPATH."macro/{$file_name[1]}/{$file_name[0]}.php"
			: APPPATH."macro/{$dir}/{$file_name}.php";
	}
	
	protected static function _get_macro_csv($file_name, $dir = 'lang')
	{
		return APPPATH."macro/{$dir}/{$file_name}.csv";
	}
	
	protected static function _get_view_name($lang = '', $dir = 'common')
	{
		return [
			'HEADER' => "{$lang}{$dir}/header_view",
			'MENU' => "{$lang}{$dir}/menu_view",
			'FOOTER' => "{$lang}{$dir}/footer_view",
			'NO_SCRIPT_DEL' => "{$lang}{$dir}/del_view",
			'MAC_VIEW_SHOW' => ['show', 'view',],
			'MAC_VIEW_EDIT' => ['edit', 'view',],
			'MAC_VIEW_DETAIL' => ['detail', 'view',],
		];
	}
	
	protected function _edit_show($data = [])
	{
		extract($this->_mvc);
		$data['arr_res'] = $this->_arr_res;

		require(self::_get_macro_tmpl($MAC_VIEW_EDIT));
	}
	
	protected function _detail_show($data = [])
	{

		extract($this->_mvc);

		$data['cmd'] = (basename($_SERVER['PATH_INFO']));

		if (empty($_POST))
		{ // 详细画面
			$data['res'] = $this->$MOD_SELF->get_id_arr($this->input->get_post('chkopt'));
		}
		else
		{ // insert update 的确认画面
			$data['res'] = $_POST;
		};

		$data['arr_res'] = $this->_arr_res;

		require(self::_get_macro_tmpl($MAC_VIEW_DETAIL));
	}
	
	protected function _edit($cmd)
	{
		$data['cmd'] = $cmd;

		extract($this->_mvc);
		
		$arr_check = MY_Lang::my_load("{$NAME}_valid_rules");

		if (empty($_POST))
		{ // 点链接 初次进入
			if ($cmd === 'add')
			{
				$data['res'] = array();
			}
			elseif ($cmd === 'edit')
			{
				$data['res'] = $this->$MOD_SELF->get_id_arr();
			};

			$this->_edit_show($data);
		}
		else
		{

			if ($this->_valid_data($arr_check[$cmd]))
			{ // form 验证
				if (isset($_POST['conf_cmd']))
				{ // 完成 插入 或 更新
					$this->$MOD_SELF->$cmd();
					$this->show();
				}
				else
				{ // 进入确认页面
					$this->_detail_show();
				};
				return false;
			}
			else
			{
				$data['res'] = $_POST;
				$this->_edit_show($data);
			};
		};
	}
	
	
}

// END MY_Controller class

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */