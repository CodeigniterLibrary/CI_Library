<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Db_forge extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->dbforge();
		$this->load->model('Db_forge_mod', '', TRUE);
	}
	
	public function show()
	{
		/* if ($this->dbforge->create_database('smarty2'))
		{
			echo '数据库已经被创建!';
		} */

		$this->load->view('db_forge_show');
	}
	
}



/* Location: ./application/controllers/Iframe.php */