<?php

return array(
	'add' => [
		[
			'field' => 'user_name',
			'label' => '名称',
			'rules' => 'required|min_length[5]|max_length[30]|no_email|is_unique[user.user_name]',],
		[
			'field' => 'user_email',
			'label' => 'email',
			'rules' => 'required|valid_email|max_length[100]|is_unique[user.user_email]',],
		[
			'field' => 'user_phone',
			'label' => '手机',
			'rules' => 'is_int|min_length[8]|max_length[14]|is_unique[user.user_phone]',],
		[
			'field' => 'user_attention[]',
			'label' => '爱好',
			'rules' => 'integer|max_length[2]',],
		[
			'field' => 'user_pass_conf',
			'label' => '确认密码',
			'rules' => 'required|matches[user_pass_conf]',],
		[
			'field' => 'user_pass',
			'label' => '密码',
			'rules' => 'required|is_print|is_strong|min_length[8]|max_length[30]',],
		
	],
	'edit' => [
		[
			'field' => 'user_phone',
			'label' => '手机',
			'rules' => 'is_int|min_length[8]|max_length[14]|update_unique[user.user_phone.user_id.chkopt]',],
		[
			'field' => 'user_attention[]',
			'rules' => 'integer|max_length[2]',],
	],
);


/* Location: ./system/language/chinese_traditional/table_lang.php */
