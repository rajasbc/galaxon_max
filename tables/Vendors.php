<?php
class Vendors extends Dbconnection {
	var $name;
	var $db;
	var $invitee_obj;
	var $msg = '';
	var $tablename = "`vendors`";
	// Create Db Connection for this class operations
	function __construct() {
		parent::__construct();
		$this->db = new Dbconnection();
	}
	public function add_vendor()
	{
		$check_sql='select * from '.$this->tablename.' where name="'.$this->db->getpost('vendor_name').'" and status="ENABLED"';
		$check_res=$this->db->GetResultsArray($check_sql);
		if (count($check_res)>0) {
			return ['status'=>'alert'];
		}
		$vendor=array();
		$vendor['name']=$this->db->getpost('vendor_name');
		$vendor['company_name']=$this->db->getpost('vendor_company_name');
		$vendor['mobile_no']=$this->db->getpost('mobile_no');
		$vendor['email']=$this->db->getpost('email');
		$vendor['address']=$this->db->getpost('address');
		$vendor['city']=$this->db->getpost('city');
		$vendor['state']=$this->db->getpost('state');
		$vendor['country']=$this->db->getpost('country');
		$vendor['pincode']=$this->db->getpost('pincode');
		$vendor['shop_id']=$_SESSION['shop_id'];
		$id = $this->db->mysql_insert($this->tablename, $vendor);
		if ($id!=0) {
			return ['status'=>'success'];
		}else{
			return ['status'=>'failed'];
		}
	}
	public function edit_vendor()
	{
		$check_sql='select * from '.$this->tablename.' where name="'.$this->db->getpost('vendor_name').'" and id!='.$this->db->getpost('vendor_id').' and status="ENABLED"';
		$check_res=$this->db->GetResultsArray($check_sql);
		if (count($check_res)>0) {
			return ['status'=>'alert'];
		}
		$vendor=array();
		$vendor['name']=$this->db->getpost('vendor_name');
		$vendor['company_name']=$this->db->getpost('vendor_company_name');
		$vendor['mobile_no']=$this->db->getpost('mobile_no');
		$vendor['email']=$this->db->getpost('email');
		$vendor['address']=$this->db->getpost('address');
		$vendor['city']=$this->db->getpost('city');
		$vendor['state']=$this->db->getpost('state');
		$vendor['country']=$this->db->getpost('country');
		$vendor['pincode']=$this->db->getpost('pincode');
		$id = $this->db->mysql_update($this->tablename, $vendor,'id='.$this->db->getpost('vendor_id'));
		if ($id!=0) {
			return ['status'=>'success'];
		}else{
			return ['status'=>'failed'];
		}
	}public function delete_vendor()
	{
		$vendor=array();
		$vendor['status']='DISABLED';
		$id = $this->db->mysql_update($this->tablename, $vendor,'id='.$this->db->getpost('vendor_id'));
		if ($id!=0) {
			return ['status'=>'success'];
		}else{
			return ['status'=>'failed'];
		}
	}
	public function get_vendor_data()
	{
		$sql='select * from '.$this->tablename.' where status="ENABLED"';
		$result=$this->db->GetResultsArray($sql);
		return $result;
	}
	public function get_vendor_dt($id)
	{
		$sql='select * from '.$this->tablename.' where id='.$id.' and status="ENABLED"';
		$result=$this->db->getAsIsArray($sql);
		return $result;
	}
}
?>