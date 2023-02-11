<?php
class Expenses extends Dbconnection{
    var $name;
	var $db;
	var $invitee_obj;
	var $msg = '';
	var $tablename = "`expenses`";
  var $tablename1 = "`customer_expenses`";
	// Create Db Connection for this class operations
	function __construct() {
		parent::__construct();
		$this->db = new Dbconnection();
	}
public function add_expenses(){
 $add = array();
 $uplaod = array();
 
 $add['branch_id']=$this->db->getpost('branch_id');
 $add['branch_name']=$this->db->getpost('branch_name');
 $add['expenses_category']=$this->db->getpost('category_name');
$add['expenses_name']=$this->db->getpost('expenses_name');
$add['ref_no']=$this->db->getpost('ref_no');
$add['vehicle_no']=$this->db->getpost('v_no');
$add['note']=$this->db->getpost('note');
$add['contact_no']=$this->db->getpost('contact');
$add['amount']=$this->db->getpost('amount');

$add['tax_amt']=$this->db->getpost('tax_amount');
if($this->db->getpost('tax')=="yes"){

$add['total_amt']=$this->db->getpost('amount_with_tax');
$add['tax_percentage'] = $this->db->getpost('tax_percentage');
$add['tax']=$this->db->getpost('tax');

}else{
$add['total_amt']=$this->db->getpost('amount_without_tax');
$add['tax']=$this->db->getpost('tax');
}
$add['refund_amt']=$this->db->getpost('refund_value');
$add['refund']=$this->db->getpost('refund_amt');


$add['created_by'] = $_SESSION['uid'];



$filename = basename($_FILES["myfile"]["name"]);
$temp_name = "GALAXON_MAX-".$filename;
$path = '../uploads/files/';
$target_path = $path.$temp_name;
if(move_uploaded_file($_FILES["myfile"]["tmp_name"],$target_path)){

  $upload = $temp_name;
}
if($upload!=''){
          $add['file'] = $upload;
         }

$result = $this->db->mysql_insert($this->tablename,$add); 
if($result){
 return ['status'=>'success'];
}else{
 return ['status'=>'failed'];	
}
}

public function get_expenses_data(){


$sql = 'select * from '.$this->tablename.' where branch_id='.$_SESSION['branch_id'].' and status="ENABLED"';


$result = $this->db->GetResultsArray($sql);


return $result;

}
public function customer_expenses_data(){
$sql = 'select * from '.$this->tablename1.' where branch_id='.$_SESSION['branch_id'].' and status="ENABLED"';


$result = $this->db->GetResultsArray($sql);


return $result;



}
public function edit_expenses(){

$add = array();
 $uplaod = array();
 
 $add['branch_id']=$this->db->getpost('branch_id');
 $add['branch_name']=$this->db->getpost('branch_name');
 $add['expenses_category']=$this->db->getpost('category_name');
$add['expenses_name']=$this->db->getpost('expenses_name');
$add['ref_no']=$this->db->getpost('ref_no');
$add['vehicle_no']=$this->db->getpost('v_no');
$add['note']=$this->db->getpost('note');
$add['contact_no']=$this->db->getpost('contact');
$add['amount']=$this->db->getpost('amount');

$add['tax_amt']=$this->db->getpost('tax_amount');
if($this->db->getpost('tax')=="yes"){

$add['total_amt']=$this->db->getpost('amount_with_tax');
$add['tax_percentage'] = $this->db->getpost('tax_percentage');
$add['tax']=$this->db->getpost('tax');

}else{
$add['total_amt']=$this->db->getpost('amount_without_tax');
$add['tax_percentage'] = 0;
$add['tax']=$this->db->getpost('tax');
}
$add['refund_amt']=$this->db->getpost('refund_value');
$add['refund']=$this->db->getpost('refund_amt');


$add['created_by'] = $_SESSION['uid'];


$filename = basename($_FILES["myfile"]["name"]);
$temp_name = "GALAXON_MAX-".$filename;
$path = '../uploads/files/';
$target_path = $path.$temp_name;
if(move_uploaded_file($_FILES["myfile"]["tmp_name"],$target_path)){

  $upload = $temp_name;
}
if($upload!=''){
          $add['file'] = $upload;
         }

$result = $this->db->mysql_update($this->tablename,$add,'id='.$this->db->getpost('edit_expenses_id')); 
return ['status'=>'success'];

}
public function get_expenses_dt($id){

$sql ='select * from '.$this->tablename.' where  id='.$id.' and status="ENABLED"';
$result = $this->db->getAsIsArray($sql);

return $result;

}
public function customer_expenses_dt($id){
$sql ='select * from '.$this->tablename1.' where  id='.$id.' and status="ENABLED"';
$result = $this->db->getAsIsArray($sql);

return $result;

}
public function delete_category($id){

  $expenses = array();
  $expenses['status'] = "DISABLED";

$result = $this->db->mysql_update($this->tablename,$expenses,'id='.$id);
if($result){

  return 'success';

}


}
public function delete_customer_expenses($id){
$expenses = array();
  $expenses['status'] = "DISABLED";

$result = $this->db->mysql_update($this->tablename1,$expenses,'id='.$id);
if($result){

  return 'success';

}

}
public function add_customer_expenses(){
 $add = array();
 $uplaod = array();
 
 $add['branch_id']=$_SESSION['branch_id'];
 $add['customer_id'] = $this->db->getpost('customer_id');
 $add['customer_name']=$this->db->getpost('customer_name');
 $add['expenses_category']=$this->db->getpost('category_name');
$add['expenses_name']=$this->db->getpost('expenses_name');
$add['ref_no']=$this->db->getpost('ref_no');
$add['vehicle_no']=$this->db->getpost('v_no');
$add['note']=$this->db->getpost('note');
$add['contact_no']=$this->db->getpost('contact');
$add['amount']=$this->db->getpost('amount');

$add['tax_amt']=$this->db->getpost('tax_amount');
if($this->db->getpost('tax')=="yes"){

$add['total_amt']=$this->db->getpost('amount_with_tax');
$add['tax_percentage'] = $this->db->getpost('tax_percentage');
$add['tax']=$this->db->getpost('tax');

}else{
$add['total_amt']=$this->db->getpost('amount_without_tax');
$add['tax']=$this->db->getpost('tax');
}
$add['refund_amt']=$this->db->getpost('refund_value');
$add['refund']=$this->db->getpost('refund_amt');


$add['created_by'] = $_SESSION['uid'];



$filename = basename($_FILES["myfile"]["name"]);
$temp_name = "GALAXON_MAX-".$filename;
$path = '../uploads/files/';
$target_path = $path.$temp_name;
if(move_uploaded_file($_FILES["myfile"]["tmp_name"],$target_path)){

  $upload = $temp_name;
}
if($upload!=''){
          $add['file'] = $upload;
         }

$result = $this->db->mysql_insert($this->tablename1,$add); 
if($result){
 return ['status'=>'success'];
}else{
 return ['status'=>'failed']; 
}
}
public function edit_customer_expenses(){

$add = array();
 $uplaod = array();
 
 $add['branch_id']=$_SESSION['branch_id'];
 $add['customer_id']=$this->db->getpost('customer_id');
 $add['customer_name']=$this->db->getpost('customer_name');

 $add['expenses_category']=$this->db->getpost('category_name');
$add['expenses_name']=$this->db->getpost('expenses_name');
$add['ref_no']=$this->db->getpost('ref_no');
$add['vehicle_no']=$this->db->getpost('v_no');
$add['note']=$this->db->getpost('note');
$add['contact_no']=$this->db->getpost('contact');
$add['amount']=$this->db->getpost('amount');

$add['tax_amt']=$this->db->getpost('tax_amount');
if($this->db->getpost('tax')=="yes"){

$add['total_amt']=$this->db->getpost('amount_with_tax');
$add['tax_percentage'] = $this->db->getpost('tax_percentage');
$add['tax']=$this->db->getpost('tax');

}else{
$add['total_amt']=$this->db->getpost('amount_without_tax');
$add['tax_percentage'] = 0;
$add['tax']=$this->db->getpost('tax');
}
$add['refund_amt']=$this->db->getpost('refund_value');
$add['refund']=$this->db->getpost('refund_amt');


$add['created_by'] = $_SESSION['uid'];


$filename = basename($_FILES["myfile"]["name"]);
$temp_name = "GALAXON_MAX-".$filename;
$path = '../uploads/files/';
$target_path = $path.$temp_name;
if(move_uploaded_file($_FILES["myfile"]["tmp_name"],$target_path)){

  $upload = $temp_name;
}
if($upload!=''){
          $add['file'] = $upload;
         }

$result = $this->db->mysql_update($this->tablename1,$add,'id='.$this->db->getpost('edit_expenses_id')); 
return ['status'=>'success'];

}




}


?>