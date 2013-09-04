<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mail extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		// echo '123';exit;
		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'smtp.126.com',
			'smtp_user' => 'erlanp@126.com',
			'smtp_pass' => '1qW@3er45t',
		);
		$this->load->library('email',$config);
		$this->email->set_newline('\\r\\n');
		$this->email->from('erlanp@126.com','Information');
		$this->email->to('erlanp@126.com');
		$this->email->subject('This is an email test');
		$this->email->message('It is working,Great!');
		if ($this->email->send())
		{
			echo 'Your email was sent';
		}
		else
		{
			echo $this->email->print_debugger();
		}
	}
	
	public function preview()
	{
		$this->load->view('mail/welcome_message');
	}

	
}

/* Location: ./application/controllers/Mail.php */