<?php

return array(
	[
		'field' => 'is_login',
		'label' => '',
		'rules' => 'required|is_login[user_name.user_pass]',],
	[
		'field' => 'user_name',
		'label' => '名称',
		'rules' => 'required|min_length[5]|max_length[30]',],
	[
		'field' => 'user_pass',
		'label' => '密码',
		'rules' => 'required|is_print|is_strong|min_length[8]|max_length[30]',],
);


/* Location: ./system/language/chinese_traditional/table_lang.php */
