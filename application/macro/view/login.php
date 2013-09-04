<?php

$this->load->view($HEADER);
$this->load->view($VIEW_EDIT, $data);
$this->load->view("{$FOOTER}_login");