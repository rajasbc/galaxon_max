<?php
class Customers extends Dbconnection {
	var $name;
	var $db;
	var $invitee_obj;
	var $msg = '';
	var $tablename = "`customers`";
	// Create Db Connection for this class operations
	function __construct() {
		parent::__construct();
		$this->db = new Dbconnection();
	}
	public function add_customer()
	{
		$check_sql='select * from '.$this->tablename.' where name="'.$this->db->getpost('customer_name').'" and status="ENABLED" and branch_id='.$_SESSION['branch_id'].'';
		$check_res=$this->db->GetResultsArray($check_sql);
		if (count($check_res)>0) {
			return ['status'=>'alert'];
		}
		$sql='select max(customer_code) as code from '.$this->tablename.' where branch_id='.$_SESSION['branch_id'].'';
		$result=$this->db->GetResultsArray($sql);
	
		if ($result[0]['code']!='') {

			$customer_code=$result[0]['code'];
			$customer_code++;
		}else{
			$customer_code='GLXC0001';
		}

		$customer=array();
		if ($_FILES["image"]["name"]!='') {
			$uploadedFile = '';
		$filename = basename($_FILES["image"]["name"]);

		$tmp_name = $filename;
		$path = '../uploads/customer/'; // upload directory

		$targetpath = $path . $tmp_name;

		if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetpath)) {

			$uploadedFile = $tmp_name;


		}
		if ($uploadedFile != '') {
			$customer['vendor_logo'] = $uploadedFile;
		}
		}
		$customer['name']=$this->db->getpost('customer_name');
		$customer['branch_id']=$_SESSION['branch_id'];
		$customer['company_name']=$this->db->getpost('customer_company_name');
		$customer['mobile_no']=$this->db->getpost('mobile_no');
		$customer['group_id']=$this->db->getpost('group_name');
		$customer['customer_code']=$customer_code;
		$customer['email']=$this->db->getpost('email');
		$customer['gst']=$this->db->getpost('gst');
		$customer['address']=$this->db->getpost('address');
		$customer['city']=$this->db->getpost('city');
		$customer['state']=$this->db->getpost('state');
		$customer['country']=$this->db->getpost('country');
		$customer['pincode']=$this->db->getpost('pincode');
		$customer['shop_id']=$_SESSION['shop_id'];
		$id = $this->db->mysql_insert($this->tablename, $customer);
		if ($id!=0) {
			return ['status'=>'success'];
		}else{
			return ['status'=>'failed'];
		}
	}
	public function edit_customer()
	{
		$check_sql='select * from '.$this->tablename.' where name="'.$this->db->getpost('customer_name').'" and id!='.$this->db->getpost('edit_customer_id').' and status="ENABLED"';
		$check_res=$this->db->GetResultsArray($check_sql);
		$sql='select * from '.$this->tablename.' where id='.$this->db->getpost('edit_customer_id');
		$res=$this->db->GetResultsArray($sql);
		if (count($check_res)>0) {
			return ['status'=>'alert'];
		}
		$customer=array();
		if ($_FILES["image"]["name"]!='') {
			$uploadedFile = '';
		$filename = basename($_FILES["image"]["name"]);

		$tmp_name =  $filename;
		$path = '../uploads/customer/'; // upload directory

		$targetpath = $path . $tmp_name;

		if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetpath)) {

			$uploadedFile = $tmp_name;


		}
		if ($uploadedFile != '') {
			$customer['vendor_logo'] = $uploadedFile;
		}
		}
		$customer['name']=$this->db->getpost('customer_name');
		$customer['company_name']=$this->db->getpost('customer_company_name');
		$customer['mobile_no']=$this->db->getpost('mobile_no');
		$customer['email']=$this->db->getpost('email');
		$customer['gst']=$this->db->getpost('gst');
		$customer['address']=$this->db->getpost('address');
		$customer['city']=$this->db->getpost('city');
		$customer['state']=$this->db->getpost('state');
		$customer['country']=$this->db->getpost('country');
		$customer['pincode']=$this->db->getpost('pincode');
		$customer['group_id']=$this->db->getpost('group_name');
		$id = $this->db->mysql_update($this->tablename, $customer,'id='.$this->db->getpost('edit_customer_id'));
		if ($id!=0) {
			return ['status'=>'success'];
		}else{
			return ['status'=>'failed'];
		}
	}public function delete_customer()
	{
		$customer=array();
		$customer['status']='DISABLED';
		$id = $this->db->mysql_update($this->tablename, $customer,'id='.$this->db->getpost('customer_id'));
		if ($id!=0) {
			return ['status'=>'success'];
		}else{
			return ['status'=>'failed'];
		}
	}
	public function get_customer_data()
	{
		$sql='select * from '.$this->tablename.' where branch_id='.$_SESSION['branch_id'].'';
		$result=$this->db->GetResultsArray($sql);
		return $result;
	}
	public function get_customer_dt($id)
	{
		$sql='select * from '.$this->tablename.' where id='.$id.' and status="ENABLED" and branch_id='.$_SESSION['branch_id'].'';
		$result=$this->db->getAsIsArray($sql);
		return $result;
	}
public function customer_enable($id){

        $customer=array();
        $customer['status']='ENABLED';	

$result = $this->db->mysql_update($this->tablename,$customer,'id='.$id);
 if($result){
   return ['status'=>'success'];
  }else{

   return ['status'=>'failed'];

  } 




	}

public function get_Autocomplete_Customer(){

$sql = "select * from ".$this->tablename." where (name like '%" .$this->db->getpost('term')."%') and branch_id = ".$_SESSION['branch_id']." and status = 'ENABLED'";

$result = $this->db->GetResultsArray($sql);
return $result;

}
public function get_customer_details($id){

$sql = 'select * from '.$this->tablename.'where branch_id ='.$_SESSION['branch_id'].' and id='.$id.' and status="ENABLED"';

$result = $this->db->GetResultsArray($sql);
return $result;


}
public function get_customer($id){

$sql = 'select * from '.$this->tablename.'where branch_id='.$_SESSION['branch_id'].' and id='.$id.'';

$result = $this->db->GetResultsArray($sql);
return $result;

}
public function get_customer_name($id){

$sql = 'select * from '.$this->tablename.' where id='.$id.' and branch_id='.$_SESSION['branch_id'].'';
$result = $this->db->GetResultsArray($sql);


return $result;


}
public function get_customer_grp_dt($g_id){

$sql = 'select * from '.$this->tablename.' where group_id='.$g_id.' and branch_id='.$_SESSION['branch_id'].' and status="ENABLED"';
$result = $this->db->GetResultsArray($sql);
return $result;


}
public function customer_details(){

$sql = 'select * from '.$this->tablename.' where branch_id='.$_SESSION['branch_id'].' and status="ENABLED"';
$result = $this->db->GetResultsArray($sql);
return $result;


}
public function branch_customer_data($c_id){

$sql = "select * from ".$this->tablename."where id='".$c_id."' and status='ENABLED'";

$result = $this->db->getAsIsArray($sql);
return $result;

}
public function get_customer_detail(){

$sql = "select * from ".$this->tablename." where branch_id='".$_SESSION['branch_id']."' and status='ENABLED'";

$result = $this->db->GetResultsArray($sql);
return $result;

}
public function customer_dt($c_id){
$sql = "select * from ".$this->tablename." where branch_id='".$_SESSION['branch_id']."' and id = '".$c_id."' and status='ENABLED'";
$result = $this->db->GetResultsArray($sql);
return $result;

}

	// public function get_Autocomplete_customer()
	// {
	// 	$sql = "select  * from ".$this->tablename." where (name like '%" . $this->db->getpost('term') . "%' or vendor_code like '%" . $this->db->getpost('term') . "%') and shop_id = " .$_SESSION['shop_id']. " and status = 'ENABLED' ";


	// $result = $this->db->GetResultsArray($sql);
	// return $result;
	// }
}
?>