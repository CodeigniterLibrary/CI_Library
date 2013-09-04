 <?php
 
class Student_mod extends CI_Model
{
	public static $table  = 'student';

    function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function get_student()
	{
		return $this->db->query('select * from '.self::$table)->result();
	}
}

?>