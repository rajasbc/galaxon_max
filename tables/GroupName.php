<?php
class GroupName extends Dbconnection {
	var $name;
	var $db;
	var $invitee_obj;
	var $msg = '';
	var $tablename = "`group_name`";
	var $tablename1 = "`branch_group_name`";
	var $tablename2 = "`customer_group_name`";
	// Create Db Connection for this class operations
	function __construct() {
		parent::__construct();
		$this->db = new Dbconnection();
	}
	public function add_group()
	{
		$check_sql='select * from '.$this->tablename.' where group_name="'.$this->db->getpost('group_name').'" and status="ENABLED"';
		$check_res=$this->db->GetResultsArray($check_sql);
		if (count($check_res)>0) {
			return ['status'=>'alert'];
		}
		$group=array();
		$group['group_name']=$this->db->getpost('group_name');
		$group['branch_id']=$_SESSION['branch_id'];
		$id = $this->db->mysql_insert($this->tablename,$group);
		if ($id!=0) {
		
	    	return ['status'=>'success'];
		}else{
			return ['status'=>'failed'];
		}
	}
	public function edit_group()
	{
		$check_sql='select * from '.$this->tablename.' where group_name="'.$this->db->getpost('group_name').'" and status="ENABLED"';
		$check_res=$this->db->GetResultsArray($check_sql);
		if (count($check_res)>0) {
			return ['status'=>'alert'];
		}
		$group=array();
		$group['group_name']=$this->db->getpost('group_name');
		$id = $this->db->mysql_update($this->tablename, $group,'id='.$this->db->getpost('group_id'));
		if ($id!=0) {
			return ['status'=>'success'];
		}else{
			return ['status'=>'failed'];
		}
	}public function delete_group()
	{
		$group=array();
		$group['status']='DISABLED';
		$id = $this->db->mysql_update($this->tablename, $group,'id='.$this->db->getpost('group_id'));
		if ($id!=0) {
			return ['status'=>'success'];
		}else{
			return ['status'=>'failed'];
		}
	}
	public function get_group_data()
	{
		$sql='select * from '.$this->tablename.' where branch_id='.$_SESSION['branch_id'].' and status="ENABLED"';
		$result=$this->db->GetResultsArray($sql);
		return $result;
	}
	public function get_group_name()
	{
		$sql='select * from '.$this->tablename.' where branch_id='.$_SESSION['branch_id'].' and status="ENABLED"';
		$result=$this->db->GetResultsArray($sql);
	
		return $result;
	}
	public function get_group_dt(){

$sql='select * from '.$this->tablename2.' where status="ENABLED"';
		$result=$this->db->GetResultsArray($sql);
		return $result;	
	}
public function add_branch_group(){

  $check_sql='select * from '.$this->tablename1.' where group_name="'.$this->db->getpost('group_name').'" and status="ENABLED"';
		$check_res=$this->db->GetResultsArray($check_sql);
		if (count($check_res)>0) {
			return ['status'=>'alert'];
		}
		$group=array();
		$group['group_name']=$this->db->getpost('group_name');
		// $group['branch_id']=$_SESSION['branch_id'];
		$id = $this->db->mysql_insert($this->tablename1,$group);
		if ($id!=0) {
		
	    	return ['status'=>'success'];
		}else{
			return ['status'=>'failed'];
		}
	}

public function add_customer_group(){

 $check_sql='select * from '.$this->tablename2.' where group_name="'.$this->db->getpost('group_name').'" and status="ENABLED" and branch_id='.$_SESSION['branch_id'].'';
		$check_res=$this->db->GetResultsArray($check_sql);
		if (count($check_res)>0) {
			return ['status'=>'alert'];
		}
		$group=array();
		$group['group_name']=$this->db->getpost('group_name');
		$group['branch_id']=$_SESSION['branch_id'];
		$id = $this->db->mysql_insert($this->tablename2,$group);
		if ($id!=0) {
		
	    	return ['status'=>'success'];
		}else{
			return ['status'=>'failed'];
		}



}


public function get_branch_group_data(){
$sql='select * from '.$this->tablename1.' where status="ENABLED"';
		$result=$this->db->GetResultsArray($sql);

		return $result;
}
public function get_customer_group_data(){
$sql='select * from '.$this->tablename2.' where status="ENABLED" and branch_id='.$_SESSION['branch_id'].'';
		$result=$this->db->GetResultsArray($sql);

		return $result;
}

public function edit_branch_group(){
 $check_sql='select * from '.$this->tablename1.' where group_name="'.$this->db->getpost('group_name').'" and status="ENABLED"';
		$check_res=$this->db->GetResultsArray($check_sql);
		if (count($check_res)>0) {
			return ['status'=>'alert'];
		}
		$group=array();
		$group['group_name']=$this->db->getpost('group_name');
		$id = $this->db->mysql_update($this->tablename1, $group,'id='.$this->db->getpost('group_id'));
		if ($id!=0) {
			return ['status'=>'success'];
		}else{
			return ['status'=>'failed'];
		}

}	
public function edit_customer_group(){
 $check_sql='select * from '.$this->tablename2.' where group_name="'.$this->db->getpost('group_name').'" and status="ENABLED"';
		$check_res=$this->db->GetResultsArray($check_sql);
		if (count($check_res)>0) {
			return ['status'=>'alert'];
		}
		$group=array();
		$group['group_name']=$this->db->getpost('group_name');
		$id = $this->db->mysql_update($this->tablename2, $group,'id='.$this->db->getpost('group_id'));
		if ($id!=0) {
			return ['status'=>'success'];
		}else{
			return ['status'=>'failed'];
		}

}	
public function delete_branch_group(){

$group=array();
		$group['status']='DISABLED';
		$id = $this->db->mysql_update($this->tablename1, $group,'id='.$this->db->getpost('group_id'));
		if ($id!=0) {
			return ['status'=>'success'];
		}else{
			return ['status'=>'failed'];
		}

}
public function delete_customer_group(){

$group=array();
		$group['status']='DISABLED';
		$id = $this->db->mysql_update($this->tablename2, $group,'id='.$this->db->getpost('group_id'));
		if ($id!=0) {
			return ['status'=>'success'];
		}else{
			return ['status'=>'failed'];
		}

}
}
?>