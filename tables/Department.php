<?php
class Department extends Dbconnection {
	var $name;
	var $db;
	var $invitee_obj;
	var $msg = '';
	var $tablename = "`department`";
	// Create Db Connection for this class operations
	function __construct() {
		parent::__construct();
		$this->db = new Dbconnection();
	}
	public function add_department()
	{
		$check_sql='select * from '.$this->tablename.' where name="'.$this->db->getpost('department_name').'" and status="ENABLED"';
		$check_res=$this->db->GetResultsArray($check_sql);
		if (count($check_res)>0) {
			return ['status'=>'alert'];
		}
		$department=array();
		$department['name']=$this->db->getpost('department_name');
		$department['branch_id']=$_SESSION['branch_id'];
		$id = $this->db->mysql_insert($this->tablename, $department);
		if ($id!=0) {
			return ['status'=>'success'];
		}else{
			return ['status'=>'failed'];
		}
	}
	public function edit_department()
	{
		$check_sql='select * from '.$this->tablename.' where name="'.$this->db->getpost('department_name').'" and status="ENABLED"';
		$check_res=$this->db->GetResultsArray($check_sql);
		if (count($check_res)>0) {
			return ['status'=>'alert'];
		}
		$department=array();
		$department['name']=$this->db->getpost('department_name');
		$id = $this->db->mysql_update($this->tablename, $department,'id='.$this->db->getpost('department_id'));
		if ($id!=0) {
			return ['status'=>'success'];
		}else{
			return ['status'=>'failed'];
		}
	}public function delete_department()
	{
		$department=array();
		$department['status']='DISABLED';
		$id = $this->db->mysql_update($this->tablename, $department,'id='.$this->db->getpost('department_id'));
		if ($id!=0) {
			return ['status'=>'success'];
		}else{
			return ['status'=>'failed'];
		}
	}
	public function get_department_data()
	{
		$sql='select * from '.$this->tablename.' where status="ENABLED"';
		$result=$this->db->GetResultsArray($sql);
		return $result;
	}
	public function get_department_details($id)
	{
		 $sql='select * from '.$this->tablename.' where status="ENABLED" and id="'.$id.'"';
		$result=$this->db->GetResultsArray($sql);
		return $result;
	}
}
?>