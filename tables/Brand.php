<?php
class Brand extends Dbconnection {
	var $name;
	var $db;
	var $invitee_obj;
	var $msg = '';
	var $tablename = "`brand`";
	// Create Db Connection for this class operations
	function __construct() {
		parent::__construct();
		$this->db = new Dbconnection();
	}
	public function add_brand()
	{
		$check_sql='select * from '.$this->tablename.' where name="'.$this->db->getpost('brand_name').'" and status="ENABLED"';
		$check_res=$this->db->GetResultsArray($check_sql);
		if (count($check_res)>0) {
			return ['status'=>'alert'];
		}
		$brand=array();
		$brand['name']=$this->db->getpost('brand_name');
		$brand['shop_id']=$_SESSION['shop_id'];
		$id = $this->db->mysql_insert($this->tablename, $brand);
		if ($id!=0) {
			return ['status'=>'success'];
		}else{
			return ['status'=>'failed'];
		}
	}
	public function edit_brand()
	{
		$check_sql='select * from '.$this->tablename.' where name="'.$this->db->getpost('brand_name').'" and status="ENABLED"';
		$check_res=$this->db->GetResultsArray($check_sql);
		if (count($check_res)>0) {
			return ['status'=>'alert'];
		}
		$brand=array();
		$brand['name']=$this->db->getpost('brand_name');
		$id = $this->db->mysql_update($this->tablename, $brand,'id='.$this->db->getpost('brand_id'));
		if ($id!=0) {
			return ['status'=>'success'];
		}else{
			return ['status'=>'failed'];
		}
	}public function delete_brand()
	{
		$brand=array();
		$brand['status']='DISABLED';
		$id = $this->db->mysql_update($this->tablename, $brand,'id='.$this->db->getpost('brand_id'));
		if ($id!=0) {
			return ['status'=>'success'];
		}else{
			return ['status'=>'failed'];
		}
	}
	public function get_brand_data()
	{
		$sql='select * from '.$this->tablename.' where status="ENABLED"';
		$result=$this->db->GetResultsArray($sql);
		return $result;
	}
}
?>