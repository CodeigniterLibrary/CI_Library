<?php

if (isset($_GET['del_cmd']))
{
	if (isset($_GET['no_script']))
	{
		$this->load->view($NO_SCRIPT_DEL);
		return false;
	}
	elseif (isset($_GET['chkopt']))
	{
		$this->$MOD_SELF->delete();
	};
};

/* ./application/macro/common/delete.php */