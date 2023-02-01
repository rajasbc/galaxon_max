<?php
class Expenses extends Dbconnection{
    var $name;
	var $db;
	var $invitee_obj;
	var $msg = '';
	var $tablename = "`expenses`";
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

$sql = 'select * from '.$this->tablename.' where status="ENABLED"';

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


}


?>