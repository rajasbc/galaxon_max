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
		$sql='select max(vendor_code) as code from '.$this->tablename;
		$result=$this->db->GetResultsArray($sql);
		if ($result[0]['code']!='') {
			$vendor_code=$result[0]['code'];
			$vendor_code++;
		}else{
			$vendor_code='GLXV0001';
		}

		$vendor=array();
		if ($_FILES["image"]["name"]!='') {
			$uploadedFile = '';
		$filename = basename($_FILES["image"]["name"]);

		$tmp_name = $vendor_code."_" . $filename;
		$path = '../uploads/vendor/'; // upload directory

		$targetpath = $path . $tmp_name;

		if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetpath)) {

			$uploadedFile = $tmp_name;


		}
		if ($uploadedFile != '') {
			$vendor['vendor_logo'] = $uploadedFile;
		}
		}
		$vendor['name']=$this->db->getpost('vendor_name');
		$vendor['company_name']=$this->db->getpost('vendor_company_name');
		$vendor['mobile_no']=$this->db->getpost('mobile_no');
		$vendor['vendor_code']=$vendor_code;
		$vendor['email']=$this->db->getpost('email');
		$vendor['gst']=$this->db->getpost('gst');
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
		$check_sql='select * from '.$this->tablename.' where name="'.$this->db->getpost('vendor_name').'" and id!='.$this->db->getpost('edit_vendor_id').' and status="ENABLED"';
		$check_res=$this->db->GetResultsArray($check_sql);
		$sql='select * from '.$this->tablename.' where id='.$this->db->getpost('edit_vendor_id');
		$res=$this->db->GetResultsArray($sql);
		if (count($check_res)>0) {
			return ['status'=>'alert'];
		}
		$vendor=array();
		if ($_FILES["image"]["name"]!='') {
			$uploadedFile = '';
		$filename = basename($_FILES["image"]["name"]);

		$tmp_name = $res[0]['vendor_code']."_" . $filename;
		$path = '../uploads/vendor/'; // upload directory

		$targetpath = $path . $tmp_name;

		if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetpath)) {

			$uploadedFile = $tmp_name;


		}
		if ($uploadedFile != '') {
			$vendor['vendor_logo'] = $uploadedFile;
		}
		}
		$vendor['name']=$this->db->getpost('vendor_name');
		$vendor['company_name']=$this->db->getpost('vendor_company_name');
		$vendor['mobile_no']=$this->db->getpost('mobile_no');
		$vendor['email']=$this->db->getpost('email');
		$vendor['gst']=$this->db->getpost('gst');
		$vendor['address']=$this->db->getpost('address');
		$vendor['city']=$this->db->getpost('city');
		$vendor['state']=$this->db->getpost('state');
		$vendor['country']=$this->db->getpost('country');
		$vendor['pincode']=$this->db->getpost('pincode');
		$id = $this->db->mysql_update($this->tablename, $vendor,'id='.$this->db->getpost('edit_vendor_id'));
		if ($id!=0) {
			return ['status'=>'success'];
		}else{
			return ['status'=>'failed'];
		}
	}public function delete_vendor()
	{
		$vendor=array();
		if ($this->db->getpost('type')=='enable') {
			$vendor['status']='ENABLED';
		}else{
			$vendor['status']='DISABLED';
		}
		
		$id = $this->db->mysql_update($this->tablename, $vendor,'id='.$this->db->getpost('vendor_id'));
		if ($id!=0) {
			return ['status'=>'success'];
		}else{
			return ['status'=>'failed'];
		}
	}
	public function get_vendor_data()
	{
		$sql='select * from '.$this->tablename.'';
		$result=$this->db->GetResultsArray($sql);
		return $result;
	}
	public function get_vendor_dt($id)
	{
		$sql='select * from '.$this->tablename.' where id='.$id.' and status="ENABLED"';
		$result=$this->db->getAsIsArray($sql);
		return $result;
	}
	public function get_Autocomplete_Vendor()
	{
		$sql = "select  * from ".$this->tablename." where (name like '%" . $this->db->getpost('term') . "%' or vendor_code like '%" . $this->db->getpost('term') . "%') and shop_id = " .$_SESSION['shop_id']. " and status = 'ENABLED' ";


	$result = $this->db->GetResultsArray($sql);
	return $result;
	}
}
?>