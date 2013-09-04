<?php

return array(
	'add' => [
		[
			'field' => 'group_name_is_unique',
			'label' => '小组名称',
			'rules' => 'required|is_unique[group.group_name]',],
		[
			'field' => 'group_name',
			'label' => '小组名称',
			'rules' => 'required|min_length[5]|max_length[30]',],
		[
			'field' => 'group_attention[]',
			'rules' => 'integer|max_length[2]',],
	],
	'edit' => [
		[
			'field' => 'group_attention[]',
			'rules' => 'integer|max_length[2]',],
	],
);


/* Location: ./system/language/chinese_traditional/table_lang.php */
