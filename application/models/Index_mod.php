<?php
 
class Index_mod extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function get_login_name_arr($name)
	{
		return $this->db
			->where('client_name', $name)
			->get('client')
			->row_array();
	}
	
}

/* Location: ./application/models/Client_mod.php */