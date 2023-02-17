<?php
class ExpenseCategory extends Dbconnection {
	var $name;
	var $db;
	var $invitee_obj;
	var $msg = '';
	var $tablename = "`expense_category`";
	
	// Create Db Connection for this class operations
	function __construct() {
		parent::__construct();
		$this->db = new Dbconnection();
	}
	public function add_category()
	{ if ($this->db->getpost('category_id')=='' && $this->db->getpost('category_id')==0) {
		$check_sql='select * from '.$this->tablename.' where name="'.$this->db->getpost('category_name').'" and status="ENABLED"';
	}else{
		$check_sql='select * from '.$this->tablename.' where name="'.$this->db->getpost('sub_category_name').'" and category_id="'.$this->db->getpost('category_id').'" and status="ENABLED"';
	}
		
		$check_res=$this->db->GetResultsArray($check_sql);
		if (count($check_res)>0) {
			return ['status'=>'alert'];
		}
		if ($this->db->getpost('category_id')=='' && $this->db->getpost('category_id')==0) {
		$category=array();
		$category['name']=$this->db->getpost('category_name');
		$category['branch_id']=$_SESSION['branch_id'];
		$id = $this->db->mysql_insert($this->tablename, $category);
	}else{
		$category=array();
		$category['category_id']=$this->db->getpost('category_id');
		$category['name']=$this->db->getpost('sub_category_name');
		$category['branch_id']=$_SESSION['branch_id'];
		$id = $this->db->mysql_insert($this->tablename, $category);
	}
		if ($id!=0) {
			return ['status'=>'success'];
		}else{
			return ['status'=>'failed'];
		}
	}
	public function edit_category()
	{
		$check_sql='select * from '.$this->tablename.' where name="'.$this->db->getpost('category_name').'" and id!='.$this->db->getpost('category_id').' and status="ENABLED" and branch_id='.$_SESSION['branch_id'].'';
		$check_res=$this->db->GetResultsArray($check_sql);
		if (count($check_res)>0) {
			return ['status'=>'alert'];
		}
		$category=array();
		$category['name']=$this->db->getpost('category_name');
		$id = $this->db->mysql_update($this->tablename, $category,'id='.$this->db->getpost('category_id'));
		if ($id!=0) {
			return ['status'=>'success'];
		}else{
			return ['status'=>'failed'];
		}
	}public function delete_category()
	{
		$category=array();
		$category['status']='DISABLED';
		$id = $this->db->mysql_update($this->tablename, $category,'id='.$this->db->getpost('category_id'));
		if ($id!=0) {
			return ['status'=>'success'];
		}else{
			return ['status'=>'failed'];
		}
	}
	public function get_category_data()
	{
		$sql='select * from '.$this->tablename.' where category_id=0 and branch_id='.$_SESSION['branch_id'].' and  status="ENABLED"';
		$result=$this->db->GetResultsArray($sql);
		return $result;
	}
	public function get_sub_category_data($id)
	{
		$sql='select * from '.$this->tablename.' where category_id="'.$id.'" and status="ENABLED"';
		$result=$this->db->GetResultsArray($sql);
		return $result;
	}
	public function get_catagory_data(){
       $sql='select * from '.$this->tablename.' where branch_id="'.$_SESSION['branch_id'].'" and status="ENABLED"';
		$result=$this->db->GetResultsArray($sql);
		return $result;

	}
	public function get_category_name($id){
      if($_SESSION['type']=='ADMIN'){
      $sql='select * from '.$this->tablename.' where id="'.$id.'" and status="ENABLED"';
		$result=$this->db->GetResultsArray($sql);
	}else{

      $sql='select * from '.$this->tablename.' where id="'.$id.'" and  branch_id='.$_SESSION['branch_id'].' and status="ENABLED"';
		$result=$this->db->GetResultsArray($sql);


	}
	
		return $result;


	}
	public function add_expenses_category()
	{ if ($this->db->getpost('category_id')=='' && $this->db->getpost('category_id')==0) {
		$check_sql='select * from '.$this->tablename.' where name="'.$this->db->getpost('category_name').'" and status="ENABLED"';
	}else{
		$check_sql='select * from '.$this->tablename.' where name="'.$this->db->getpost('sub_category_name').'" and category_id="'.$this->db->getpost('category_id').'" and status="ENABLED"';
	}
		
		$check_res=$this->db->GetResultsArray($check_sql);
		if (count($check_res)>0) {
			return ['status'=>'alert'];
		}
		if ($this->db->getpost('category_id')=='' && $this->db->getpost('category_id')==0) {
		$category=array();
		$category['name']=$this->db->getpost('category_name');
		$category['branch_id']=$_SESSION['branch_id'];
		$id = $this->db->mysql_insert($this->tablename, $category);
	}else{
		$category=array();
		$category['category_id']=$this->db->getpost('category_id');
		$category['name']=$this->db->getpost('sub_category_name');
		$category['branch_id']=$_SESSION['branch_id'];
		$id = $this->db->mysql_insert($this->tablename, $category);
	}
		if ($id!=0) {
			return ['status'=>'success'];
		}else{
			return ['status'=>'failed'];
		}
	}

	public function edit_expenses_category()
	{
		$check_sql='select * from '.$this->tablename.' where name="'.$this->db->getpost('category_name').'" and id!='.$this->db->getpost('category_id').' and status="ENABLED" and branch_id='.$_SESSION['branch_id'].'';
		$check_res=$this->db->GetResultsArray($check_sql);
		if (count($check_res)>0) {
			return ['status'=>'alert'];
		}
		$category=array();
		$category['name']=$this->db->getpost('category_name');
		$id = $this->db->mysql_update($this->tablename, $category,'id='.$this->db->getpost('category_id'));
		if ($id!=0) {
			return ['status'=>'success'];
		}else{
			return ['status'=>'failed'];
		}
	}
	public function delete_expenses_category()
	{
		$category=array();
		$category['status']='DISABLED';
		$id = $this->db->mysql_update($this->tablename, $category,'id='.$this->db->getpost('category_id'));
		if ($id!=0) {
			return ['status'=>'success'];
		}else{
			return ['status'=>'failed'];
		}
	}
  public function get_category($cat_id){
      
     $sql = 'select * from '.$this->tablename.'where id='.$cat_id.' and status="ENABLED"';
     $result = $this->GetResultsArray($sql);
     return $result;
  }	
}
?>