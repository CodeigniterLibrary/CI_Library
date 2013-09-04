<?php
//分页
$data = [];

if (isset($_GET['show_cmd']))
{
	$config = MY_Lang::my_load('pagination');
	$config['base_url'] = "{$_SERVER['SCRIPT_NAME']}/{$NAME}?"
			. explode('&per_page', $_SERVER['QUERY_STRING'], 2)[0];

	$config['per_page'] = 5;
	$config['page_query_string'] = true;
	$config['total_rows'] = 5;

	$data['sort_url'] = explode('&sort=', $config['base_url'], 2)[0];

	$data['res'] = $this->$MOD_SELF->get_pagination_arr($config);
};

$data['arr_res'] = $this->_arr_res;

/* ./application/macro/common/pagination.php */