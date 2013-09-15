<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Preview extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->_arr_res = [
			'temp' => $this->config->config['temp'],
			'root_temp' => $this->config->config['root_temp'],
			'root_client' => $this->config->config['root_client'],
		];

		$name = 'Preview';
		$lang = get_config()['language'] . '/';
		$this->_mvc = array_merge(self::_get_view_name($lang), [
			'NAME' => $name,
			'MOD_SELF' => "{$name}_mod",
			'VIEW_SHOW' => "{$lang}{$name}/show",
			'VIEW_EDIT' => "{$lang}{$name}/edit",
			'VIEW_DETAIL' => "{$lang}{$name}/detail",
			'VIEW_UPLOAD' => "{$lang}{$name}/upload",
			'VIEW_ERROR' => "{$lang}{$name}/error",
			'VIEW_IFRAME_SHOW' => "{$lang}{$name}/iframe_show",
		]);
	}
	
	public function index()
	{
		$this->edit();
	}

	public function show($data = [])
	{
		extract($this->_mvc);

		$this->load->view($HEADER);
		$this->load->view($MENU);
		$this->load->view($VIEW_SHOW, $data);
		$this->load->view($FOOTER);
	}

	public function edit($data = [])
	{
		extract($this->_mvc);

		if (isset($_POST['conf_cmd']))
		{
			if ($this->_valid_img())
			{
				$path = self::mkdir_arr(['1/', 'default/',], $this->_arr_res['root_client']);

				if (isset($_POST['images'][0]))
				{
					foreach ($_POST['images'] as $image)
					{
						$image = get_img_name($image);

						if (!copy($this->_arr_res['root_temp'] . $image, $path . $image) OR
								!copy($this->_arr_res['root_temp'] . 'thumb_' . $image, $path . 'thumb_' . $image))
						{
							echo "failed to copy {$image}...\n";
						}

					}
				}
				
				echo '<script>
				parent.window.location.href="', $_SERVER['SCRIPT_NAME'], '/Preview/success";
				</script>';
			}
		}
		else
		{
			$data['arr_res'] = $this->_arr_res;
			$this->load->view($HEADER);
			$this->load->view($MENU);
			$this->load->view($VIEW_EDIT, $data);
			$this->load->view($FOOTER);
		};
	}

	public function upload($data = [])
	{
		$this->load->library('upload');

		self::mkdir_arr([$this->_arr_res['root_client'], $this->_arr_res['root_temp'],]);
		
		if ($this->upload->do_upload())
		{
			extract($this->_mvc);

			if (isset($_POST['img_title']))
			{
				array_unshift($_POST['img_title'], $this->upload->orig_name);
			}
			else
			{
				$_POST['img_title'][0] = $this->upload->orig_name;
			};

			$data['file_name'] = $this->upload->file_name;

			$data['file_name_thumb'] = 'thumb_' . $data['file_name'];

			$data['orig_name'] = $this->upload->orig_name;
			$data['arr_res'] = $this->_arr_res;
			$data['error'] = '';

			$config['image_library'] = 'gd2';
			$config['source_image'] = $this->_arr_res['root_temp'] . $data['file_name'];
			$config['new_image'] = $this->_arr_res['root_temp'] . $data['file_name'];
			$config['create_thumb'] = TRUE; //FALSE; //
			$config['maintain_ratio'] = TRUE; //FALSE; //
			$config['width'] = 320;
			$config['height'] = 240;

			$this->load->library('image_lib', $config);

			$this->image_lib->resize();

			$this->load->view($VIEW_UPLOAD, $data);
		}
		else
		{
			$data['error'] = $this->upload->display_errors();
		};

		$this->_valid_img($data);
	}

	public function success()
	{
		extract($this->_mvc);
		$this->load->view($VIEW_IFRAME_SHOW);
	}
	
	private static function mkdir_arr($arr, $path = FALSE)
	{
		if (is_string($path))
		{
			foreach ($arr as $v)
			{
				$path .= $v;
				if ((!is_dir($path)) && (!mkdir($path, 0755)))
				{
					echo('mkdir err');
				};
			}
			return $path;
		}
		else
		{
			foreach ($arr as $path)
			{
				if ((!is_dir($path)) && (!mkdir($path, 0755)))
				{
					echo('mkdir err');
				}
			}
		}
	}

	private function _valid_img($data = ['error' => ''])
	{
		extract($this->_mvc);

		$img_check = array(
			[
				'field' => 'img_title[]',
				'label' => '图片标题',
				'rules' => 'max_length[48]',
			],
		);

		if ($data['error'] !== '' OR $this->_valid_data($img_check) === FALSE)
		{
			$data['error'] .= rtrim(validation_errors());
			$this->load->view($VIEW_ERROR, $data);
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

}

/* Location: ./application/controllers/Preview.php */