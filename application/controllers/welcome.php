<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$lang = $this->config->config['language'].'/';
		$this->load->view($lang.'welcome_message');
		
		$this->load->model('Test_model', '', TRUE);
		$this->Test_model->abc();
		
	}

	public function test()
	{
		// 直接在控制器里使用 Module
		$this->load->module('test2/home_made');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */