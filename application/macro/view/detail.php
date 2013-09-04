<?php

if (isset($_GET['ajax']))
{
	$this->load->view($VIEW_DETAIL, $data);
}
else
{
	$this->load->view($HEADER);
	$this->load->view($VIEW_DETAIL, $data);
	$this->load->view($FOOTER);
};

/* ./appllication/macro/view/detail.php */