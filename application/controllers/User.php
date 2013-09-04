<?php

class User extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->lang->load('table');

		$this->_arr_res['arr_attention'] = $this->lang->line('table_attention');
		$this->_arr_res['arr_search'] = $this->lang->line('table_search');

		$name = 'User';
		
		$lang = $this->config->config['language'].'/';
		$this->_mvc = array_merge(self::_get_view_name($lang), [
			'NAME' => $name,
			'MOD_SELF' => "{$name}_mod",
			'VIEW_SHOW' => "{$lang}{$name}/show",
			'VIEW_EDIT' => "{$lang}{$name}/edit",
			'VIEW_DETAIL' => "{$lang}{$name}/detail",
		]);

		$this->load->model($this->_mvc['MOD_SELF'], '', TRUE);
	}

	public function show()
	{
		extract($this->_mvc);
		require(self::_get_macro_tmpl('delete'));
		require(self::_get_macro_tmpl('pagination'));
		require(self::_get_macro_tmpl('show', 'view'));
	}

	public function add()
	{
		$this->_edit('add');
	}

	public function edit()
	{
		$this->_edit('edit');
	}

	public function detail()
	{
		$this->_detail_show();
	}

}

/* Location: ./application/controllers/User.php */
