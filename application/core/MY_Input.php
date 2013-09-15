<?php

class MY_Input extends CI_Input {
	
	public static function is_xml_request()
    {
        return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) 
           && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest');
    }
	
	public static function is_get()
    {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }
}

/* End of file MY_Input.php */
/* Location: ./application/core/MY_Input.php */