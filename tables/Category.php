<?php
class Category extends Dbconnection {
	var $name;
	var $db;
	var $invitee_obj;
	var $msg = '';
	var $tablename = "`category`";
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
		$category['shop_id']=$_SESSION['shop_id'];
		$id = $this->db->mysql_insert($this->tablename, $category);
	}else{
		$category=array();
		$category['category_id']=$this->db->getpost('category_id');
		$category['name']=$this->db->getpost('sub_category_name');
		$category['shop_id']=$_SESSION['shop_id'];
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
		$check_sql='select * from '.$this->tablename.' where name="'.$this->db->getpost('category_name').'" and id!='.$this->db->getpost('category_id').' and status="ENABLED"';
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
		$sql='select * from '.$this->tablename.' where category_id=0 and status="ENABLED"';
		$result=$this->db->GetResultsArray($sql);
		return $result;
	}
	public function get_sub_category_data($id)
	{
		$sql='select * from '.$this->tablename.' where category_id="'.$id.'" and status="ENABLED"';
		$result=$this->db->GetResultsArray($sql);
		return $result;
	}
}
?>