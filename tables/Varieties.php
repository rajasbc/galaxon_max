<?php
class Varieties extends Dbconnection {
	var $name;
	var $db;
	var $invitee_obj;
	var $msg = '';
	var $tablename = "`varieties`";
	var $tablename1 = "`variety_items`";
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

	public function varieties_details($id){


      $sql = 'select * from '.$this->tablename.' where item_id='.$id.' and is_deleted="NO"';

      $result = $this->db->GetResultsArray($sql);
      
      return $result;

	}

	public function get_variety($id){

   $sql = 'select item_id,item_name,var_id,var_name,sum(mrp) as mrp,sum(sales_price) as sales_price,sum(received_qty) as received_qty from purchase_order_details where var_id='.$id.' and branch_id='.$_SESSION['branch_id'].' and is_deleted="NO" group by var_name';

      $result = $this->db->GetResultsArray($sql);
      
      return $result;


	}

	public function get_branch_varieties($id){

 $sql = 'select a.*,b.* from variety_items a join varieties b on a.variety_id=b.id where a.item_id='.$id.' and a.branch_id = '.$_SESSION['branch_id'].'';

  $result = $this->db->GetResultsArray($sql);

  return $result;

  // print_r($result);die();


	}
}
?>