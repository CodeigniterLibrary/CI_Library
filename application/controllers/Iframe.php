<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Iframe extends CI_Controller
{
	private static $_arr_res;
	
	function index()
	{
		var_dump($_SERVER);
		
		$_SERVER = $this->security->xss_clean($_SERVER);
		
		defined('FOPEN_READ') OR define('FOPEN_READ', 'undefine');
		defined('LOCK_SH') OR define('LOCK_SH', 'undefine');
		defined('LOCK_UN') OR define('LOCK_UN', 'undefine');

		var_dump(
			FOPEN_READ,
			LOCK_SH,
			LOCK_UN
		);
	}
	
	function __construct()
	{
		parent::__construct();
		self::$_arr_res = array(
			'temp' => $this->config->config['temp'],
			'root_temp' => $this->config->config['root_temp'],
			'root_client' => $this->config->config['root_client'],
		);
	}
	
	public function show()
	{
		$this->load->view('iframe_show');
	}
	
	public function success()
	{
		$this->load->view('iframe_show');
	}
	
	public function delete()
	{
		$images = unserialize($_POST['images']);
		unset($images[$_POST['id']], $_POST['img_title'][$_POST['id']]);
		
		$data['images'] = $images;
		$data['arr_res'] = self::$_arr_res;
		
		$this->load->view('iframe_view', $data);
		$this->_valid_img();
	}
	
	public function conf()
	{
		if ($this->_valid_img())
		{
			$images = unserialize($_POST['images']);
			
			// echo self::$_arr_res['root_temp'];
			// echo self::$_arr_res['root_client'];
			
			$arr_path = array();
			$arr_path['client_path'] = self::$_arr_res['root_client'].'1/';
			$arr_path['album_path'] = $arr_path['client_path'].'default/';
			
			foreach ($arr_path as $path)
			{
				if (( ! is_dir($path)) && ( ! mkdir($path, 0755)))
				{
					echo('mkdir err');
				}
			}
			
			if (isset($images[0]))
			{
				foreach ($images as $image)
				{
					$file = self::$_arr_res['root_temp'].$image;
					if ( ! copy($file, $arr_path['album_path'].$image))
					{
						echo "failed to copy $file...\n";
					}

					unlink($file);
				}
			}
			echo '<script>
				parent.window.location.href="',$_SERVER['SCRIPT_NAME'],'/Iframe/success";
				</script>';
		}
	}
	
	public function upload()
	{//iframe 用js 上传图片
		$this->load->library('upload');
		
		if ($this->upload->do_upload())
		{
			$data['file_name'] = $this->upload->file_name;
			
			$images = unserialize($_POST['images']);
			
			if (is_array($images) && current($images))
			{
				array_unshift($images, $data['file_name']);
				array_unshift($_POST['img_title'], $this->upload->orig_name);
			}
			else
			{
				$images = array($data['file_name']);
				$_POST['img_title'] = array($this->upload->orig_name);
			}
			
			$data['images'] = $images;
			$data['arr_res'] = self::$_arr_res;
			
			$this->load->view('iframe_view', $data);
		}
		else
		{
			$data['error'] = $this->upload->display_errors();
		}
		$this->_valid_img($data);
	}
	
	private function _valid_img($data = array('error'=>''))
	{
		$this->load->library('form_validation');
		$this->form_validation
			->set_rules('img_title[]', '标题', 'max_length[48]');
			
		if ($this->form_validation->run() === FALSE
			OR $data['error'] !== '')
		{
			$data['error'] .= rtrim(validation_errors());
			
			$this->load->view('iframe_err', $data);
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
}



/* Location: ./application/controllers/Iframe.php */