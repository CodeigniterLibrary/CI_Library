<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
		$name = 'Register';
		
		$this->_mvc = array_merge(self::_get_view_name(), [
			'NAME' => $name,
			'MOD_SELF' => 'Client_mod',
			'VIEW_SHOW' => $name . '/show',
			'VIEW_EDIT' => $name . '/edit',
			'VIEW_DETAIL' => $name . '/detail',
		]);
	}
	
	public function index()
	{
		$this->load->view('welcome_message');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
