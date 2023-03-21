<?php
class Expenses extends Dbconnection{
    var $name;
	var $db;
	var $invitee_obj;
	var $msg = '';
	var $tablename = "`expenses`";
  var $tablename1 = "`customer_expenses`";
  var $tablename2 = "`expenses_file`";
  var $tablename3 = "`customer_expenses_file`";
	// Create Db Connection for this class operations
	function __construct() {
		parent::__construct();
		$this->db = new Dbconnection();
	}
public function add_expenses(){
 $add = array();

 
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
$add['refund']=$this->db->getpost('refund');

$add['exp_date']=$this->db->getpost('exp_date');
$add['created_by'] = $_SESSION['uid'];


$result = $this->db->mysql_insert($this->tablename,$add); 




if(count($result)>0){
  
$upload = array();
$image = array();
$image['expenses_id'] = $result;
$image['branch_id'] = $this->db->getpost('branch_id');


  $number_file = count($_FILES['myfile']['name']);
    $i=0;
 while($i<$number_file){
  $filename = basename($_FILES["myfile"]["name"][$i]);
if($filename!=''){
$temp_name = "GALAXON_MAX-".$filename;
$path = '../uploads/files/';
$target_path = $path.$temp_name;
if(move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$target_path)){

  $upload = $temp_name;
}
if($upload!=''){
          $image['file'] = $upload;
         }

$result = $this->db->mysql_insert($this->tablename2,$image); 
   $i++;
 }else{
  return ['status'=>'success'];

 }
 }
  
}

if(count($result)>0){
 return ['status'=>'success'];
}else{
 return ['status'=>'failed'];	
}
}

public function get_expenses_data(){
 // $fdate = date('Y-m-d');
 // $tdate = date('Y-m-d');

 $sql = 'select * from '.$this->tablename.' where status="ENABLED"';


$result = $this->db->GetResultsArray($sql);


return $result;

}
public function customer_expenses_data(){
  $fdate = date('Y-m-d');
 $tdate = date('Y-m-d');
$sql = 'select * from '.$this->tablename1.' where  exp_date>="'.$fdate.'" and exp_date<="'.$tdate.'" and branch_id='.$_SESSION['branch_id'].' and status="ENABLED"';

$result = $this->db->GetResultsArray($sql);


return $result;



}
public function edit_expenses(){

$add = array();
 
 
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

$add['refund']=$this->db->getpost('refund');
if($this->db->getpost('refund')=='yes'){
$add['refund_amt']=$this->db->getpost('refund_value');
$add['amount_after_refund']=$this->db->getpost('amount_after_refund');

}else{
  $add['refund_amt']=0;
$add['amount_after_refund']=0;

}

$add['exp_date']=$this->db->getpost('exp_date');
$add['created_by'] = $_SESSION['uid'];


$result = $this->db->mysql_update($this->tablename,$add,'id='.$this->db->getpost('edit_expenses_id'));

if(count($result)>0){
  
$upload = array();
$image = array();
$image['expenses_id'] =$this->db->getpost('edit_expenses_id');
$image['branch_id'] = $this->db->getpost('branch_id');


  $number_file = count($_FILES['myfile']['name']);
    $i=0;
 while($i<$number_file){
  $filename = basename($_FILES["myfile"]["name"][$i]);
if($filename!=''){
$temp_name = "GALAXON_MAX-".$filename;
$path = '../uploads/files/';
$target_path = $path.$temp_name;
if(move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$target_path)){

  $upload = $temp_name;
}
if($upload!=''){
          $image['file'] = $upload;
         }

$result = $this->db->mysql_insert($this->tablename2,$image); 
   $i++;
 }else{
  return ['status'=>'success'];

 }
 }
  
}


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
$sql = $this->db->mysql_delete('expenses_file','expenses_id='.$id);
  return 'success';


}


}
public function delete_customer_expenses($id){
$expenses = array();
  $expenses['status'] = "DISABLED";

$result = $this->db->mysql_update($this->tablename1,$expenses,'id='.$id);
if($result){
   $sql = $this->db->mysql_delete('customer_expenses_file','expenses_id='.$id);

  return 'success';

}

}
public function add_customer_expenses(){
  $add = array();
 
 
 $add['branch_id']=$_SESSION['branch_id'];
 $add['customer_id']=$this->db->getpost('customer_id');
 $add['customer_name'] = $this->db->getpost('customer_name');
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
$add['refund']=$this->db->getpost('refund');

$add['exp_date']=$this->db->getpost('exp_date');
$add['created_by'] = $_SESSION['uid'];


$result = $this->db->mysql_insert($this->tablename1,$add); 



if(count($result)>0){
  $image = array();
  $upload = array();
$image['expenses_id'] = $result;
$image['branch_id'] = $_SESSION['branch_id'];
$image['customer_id'] = $this->db->getpost('customer_id');

  
  
  $number_file = count($_FILES['myfile']['name']);
    $i=0;
 while($i<$number_file){
  $filename = basename($_FILES["myfile"]["name"][$i]);
  if($filename!=''){

$temp_name = "GALAXON_MAX-".$filename;
$path = '../uploads/files/';
$target_path = $path.$temp_name;
if(move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$target_path)){

  $upload = $temp_name;
}
if($upload!=''){
          $image['file'] = $upload;
         }

$result = $this->db->mysql_insert($this->tablename3,$image); 
   $i++;

 }else{
  return ['status'=>'success'];

 }
}
  
}
if($result){
 return ['status'=>'success'];
}else{
 return ['status'=>'failed']; 
}
}
public function edit_customer_expenses(){

$add = array();
 
 
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

$add['refund']=$this->db->getpost('refund');
if($this->db->getpost('refund')=='yes'){
$add['refund_amt']=$this->db->getpost('refund_value');
$add['amount_after_refund']=$this->db->getpost('amount_after_refund');

}else{
  $add['refund_amt']=0;
$add['amount_after_refund']=0;

}

$add['exp_date']=$this->db->getpost('exp_date');
$add['created_by'] = $_SESSION['uid'];


$result = $this->db->mysql_update($this->tablename1,$add,'id='.$this->db->getpost('edit_expenses_id'));



if(count($result)>0){
  $image = array();
  $upload = array();
$image['expenses_id'] = $this->db->getpost('edit_expenses_id');
$image['branch_id'] = $_SESSION['branch_id'];
$image['customer_id'] = $this->db->getpost('customer_id');

  
  
  $number_file = count($_FILES['myfile']['name']);
    $i=0;
 while($i<$number_file){
  $filename = basename($_FILES["myfile"]["name"][$i]);
  if($filename!=''){

$temp_name = "GALAXON_MAX-".$filename;
$path = '../uploads/files/';
$target_path = $path.$temp_name;
if(move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$target_path)){

  $upload = $temp_name;
}
if($upload!=''){
          $image['file'] = $upload;
         }

$result = $this->db->mysql_insert($this->tablename3,$image); 
   $i++;

 }else{
  return ['status'=>'success'];

 }
}
  
}
if($result){
 return ['status'=>'success'];
}else{
 return ['status'=>'failed']; 
}

}
public function get_expenses_date($fdate,$tdate,$b_id,$c_id){

$sql = 'select * from '.$this->tablename.' where exp_date>="'.date($fdate).'" and exp_date<="'.date($tdate).'" and  branch_id='.$b_id.' and expenses_category='.$c_id.' and status="ENABLED"';
$res = $this->db->GetResultsArray($sql);

return $res;


}
public function get_expenses_file($e_id){
  if($_SESSION['type']=='ADMIN'){

$sql = 'select * from '.$this->tablename2.' where expenses_id='.$e_id.' and is_delete="NO"';
}else{

 $sql = 'select * from '.$this->tablename3.' where expenses_id='.$e_id.' and is_delete="NO" and branch_id='.$_SESSION['branch_id'].'';
 
}

$result = $this->db->GetResultsArray($sql);

return $result;


}
public function dele_file(){
if($_SESSION['type']=='ADMIN'){
$sql = $this->db->mysql_delete('expenses_file','id='.$_POST['file_id']);
}else{
$sql = $this->db->mysql_delete('customer_expenses_file','id='.$_POST['file_id']);
}
return 'success';

}
public function customer_expenses_date($fdate,$tdate){
  // print_r($fdate);die();

$sql = 'select * from '.$this->tablename1.' where exp_date>="'.$fdate.'" and exp_date<="'.$tdate.'" and status="ENABLED"';
$res = $this->db->GetResultsArray($sql);
return $res;



}


}


?>