<?php
class Description extends Dbconnection {
	var $name;
	var $db;
	var $invitee_obj;
	var $msg = '';
	var $tablename = "`description`";
	// Create Db Connection for this class operations
	function __construct() {
		parent::__construct();
		$this->db = new Dbconnection();
	}
	public function add_description()
	{
		$check_sql='select * from '.$this->tablename.' where name="'.$this->db->getpost('description_name').'" and status="ENABLED"';
		$check_res=$this->db->GetResultsArray($check_sql);
		if (count($check_res)>0) {
			return ['status'=>'alert'];
		}
		$description=array();
		$description['name']=$this->db->getpost('description_name');
		$description['shop_id']=$_SESSION['shop_id'];
		$id = $this->db->mysql_insert($this->tablename, $description);
		if ($id!=0) {
			return ['status'=>'success'];
		}else{
			return ['status'=>'failed'];
		}
	}
	public function edit_description()
	{
		$check_sql='select * from '.$this->tablename.' where name="'.$this->db->getpost('description_name').'" and status="ENABLED"';
		$check_res=$this->db->GetResultsArray($check_sql);
		if (count($check_res)>0) {
			return ['status'=>'alert'];
		}
		$description=array();
		$description['name']=$this->db->getpost('description_name');
		$id = $this->db->mysql_update($this->tablename, $description,'id='.$this->db->getpost('description_id'));
		if ($id!=0) {
			return ['status'=>'success'];
		}else{
			return ['status'=>'failed'];
		}
	}public function delete_description()
	{
		$description=array();
		$description['status']='DISABLED';
		$id = $this->db->mysql_update($this->tablename, $description,'id='.$this->db->getpost('description_id'));
		if ($id!=0) {
			return ['status'=>'success'];
		}else{
			return ['status'=>'failed'];
		}
	}
	public function get_description_data()
	{
		$sql='select * from '.$this->tablename.' where status="ENABLED"';
		$result=$this->db->GetResultsArray($sql);
		return $result;
	}
}
?>