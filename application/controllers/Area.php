<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Area extends CI_Controller
{
	private static $_arr_res = array(
		'arr_int' => array(
			'地区一',
			'地区二',
			'地区三',
			'地区四',
			'地区五'
		),
		'arr_search' => array(
			'in' => '求交集',
			'eq' => '求父集',
			'neq' => '求补集',
		)
	);
	
	private static $_mvc = array();
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('Area_mod', '', TRUE);
		$name = 'Area';
		self::$_mvc = array_merge(get_view_name(), [
			'NAME' => $name
			, 'MOD_SELF' => $name.'_mod'
			, 'VIEW_SHOW' => $name.'_show'
			, 'VIEW_EDIT' => $name.'_edit'
			, 'ARR_SEARCH' => array('id', 'name', 'area', 'search')
		]);
	}
	
	
	
	public function show()
	{
		extract(self::$_mvc);
	
		if (isset($_POST['del_cmd']))
		{
			if (isset($_POST['no_script']))
			{
				$this->load->view($view_del);
				return false;
			}
			else
			{
				$this->$MOD_SELF->delete();
			}
		}

		$show_cmd = isset($_POST['url_seek']);
		switch($show_cmd)
		{
			case false:
				$url_seek = $this->input->get_post('url_seek');
				$url_seek && $_POST = array_merge($_POST, form_url_decode($url_seek));
			case true:
				$seek = array();
				foreach ($ARR_SEARCH as $k)
				{
					isset($_POST[$k]) && $seek[$k] = $_POST[$k];
				}
				isset($url_seek) OR $url_seek = form_url_encode($seek);
				break;
		}
		
		

		if (isset($_POST['show_cmd']) OR $url_seek)
		{
			$where = $this->$MOD_SELF->list_where($seek);
			$where !== ''
				&& $this->db->where($where, null, false);
			
			$this->load->library('pagination');
			$config['base_url'] = $_SERVER['SCRIPT_NAME'].'/'.$NAME.'/show/?url_seek='.$url_seek;
			$config['total_rows'] = $this->db->count_all_results($MOD_SELF::$table);
			$this->pagination->initialize($config);
			
			$where !== ''
				&& $this->db->where($where, null, false);
			$data['url_seek'] = $url_seek;
			$data['res'] = $this->db
				->get($MOD_SELF::$table
					, $this->pagination->per_page
					, $this->input->get_post('per_page'))
				->result_array();
		}
		else
		{
			$data['url_seek'] = '';
		}

		$data['arr_res'] = self::$_arr_res;

		$this->load->view($HEADER);
		$this->load->view($MENU);
		$this->load->view($VIEW_SHOW, $data);
		$this->load->view($FOOTER);
	}
	
	public function add()
	{
		if (empty($_POST))
		{
			$this->_edit_show();
		}
		else
		{
			$_POST['area_int'] = arr_int($_POST['area_int']);
			if ($this->_valid_data([[
				'field' => 'area_name'
				, 'label' => '地区名'
				, 'rules' => 'required|min_length[5]|max_length[30]']]))
			{
				extract(self::$_mvc);
				$this->$MOD_SELF->add();
				$this->show();
			}
			else
			{
				$this->_edit_show();
			}
		}
	}
	
	public function edit()
	{
		if (empty($_POST))
		{
			$this->_edit_show();
		}
		else
		{
			$_POST['area_int'] = arr_int($_POST['area_int']);
			
			if ($this->_valid_data([[
				'field' => 'area_name'
				, 'label' => '地区名'
				, 'rules' => 'required|min_length[5]|max_length[30]']]))
			{
				extract(self::$_mvc);
				$this->$MOD_SELF->edit();
				$this->show();
				return false;
			}
			else
			{
				$this->_edit_show();
			}
		}
	}
	
	private function _edit_show($data = array())
	{
		extract(self::$_mvc);
	
		$cmd = (basename($_SERVER['PATH_INFO']));
		$data['cmd'] = $cmd;
		
		if (empty($_POST))
		{
			if ($cmd === 'add')
			{
				$data['res'] = array();
			}
			elseif ($cmd === 'edit')
			{
				$data['res'] = $this->$MOD_SELF->get_id_arr($this->input->get_post('id'));
			}
		}
		else
		{
			$data['res'] = $_POST;
		}
		
		$data['arr_res'] = self::$_arr_res;
		
		$this->load->view($HEADER);
		$this->load->view($MENU);
		$this->load->view($VIEW_EDIT, $data);
		$this->load->view($FOOTER);
	}
	
}

/* Location: ./application/controllers/Area.php */