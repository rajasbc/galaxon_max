<?php
class Varieties extends Dbconnection {
	var $name;
	var $db;
	var $invitee_obj;
	var $msg = '';
	var $tablename = "`varieties`";
	// Create Db Connection for this class operations
	function __construct() {
		parent::__construct();
		$this->db = new Dbconnection();
	}
	public function add_varieties()
	{ 

		$check_sql='select * from '.$this->tablename.' where name="'.$this->db->getpost('variety_name').'" and item_id="'.$this->db->getpost('item_id').'" and is_deleted="NO"';

		
		$check_res=$this->db->GetResultsArray($check_sql);
		if (count($check_res)>0) {
			return ['status'=>'alert'];
		}

		$variety=array();
		$variety['item_id']=$this->db->getpost('item_id');
		$variety['name']=$this->db->getpost('variety_name');
		$id = $this->db->mysql_insert($this->tablename, $variety);
		if ($id!=0) {
			return ['status'=>'success'];
		}else{
			return ['status'=>'failed'];
		}
	}

	public function delete_varieties()
	{
		$varieties=array();
		$varieties['is_deleted']='YES';
		$id = $this->db->mysql_update($this->tablename, $varieties,'id='.$this->db->getpost('id'));
		if ($id!=0) {
			return ['status'=>'success'];
		}else{
			return ['status'=>'failed'];
		}
	}
	public function get_varieties_data($item_id)
	{
		$sql='select * from '.$this->tablename.' where item_id='.$item_id.' and is_deleted="NO"';
		$result=$this->db->GetResultsArray($sql);
		return $result;
	}
	public function get_Autocomplete_varieties($item_id=0)
	{
		$sql = "select  * from ".$this->tablename." where name like '%" . $this->db->getpost('term') . "%' and item_id = " .$item_id. " and is_deleted = 'NO' ";


	$result = $this->db->GetResultsArray($sql);
	return $result;
	}
}
?>