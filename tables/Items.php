<?php
class Items extends Dbconnection {
	var $name;
	var $db;
	var $invitee_obj;
	var $msg = '';
	var $tablename = "`items`";
	// Create Db Connection for this class operations
	function __construct() {
		parent::__construct();
		$this->db = new Dbconnection();
	}
	public function add_items()
	{
		$check_sql='select * from '.$this->tablename.' where item_name="'.$this->db->getpost('item_name').'" and is_deleted="NO"';
		$check_res=$this->db->GetResultsArray($check_sql);
		if (count($check_res)>0) {
			return ['status'=>'alert'];
		}
		$item=array();
		$item['item_name']=$this->db->getpost('item_name');
		$item['item_code']=$this->db->getpost('item_code');
		$item['shop_id']=$_SESSION['shop_id'];
		$item['brand']=$this->db->getpost('brand');
		$item['category']=$this->db->getpost('category');
		$item['units']=$this->db->getpost('units');
		if ($this->db->getpost('sub_category')!='' && $this->db->getpost('sub_category') !=0) {
		 $item['sub_category']=$this->db->getpost('sub_category');
		}else{
			$item['sub_category']=0;
		}
		
		$item['mrp']=$this->db->getpost('mrp');
		$item['sales_price']=$this->db->getpost('sale_price');
		if ($this->db->getpost('discount')!='' && $this->db->getpost('discount') !=0) {
$item['discount']=$this->db->getpost('discount');
		}else{
			$item['discount']=0;
		}
		if ($this->db->getpost('gst')!='' && $this->db->getpost('gst') !=0) {
$item['gst']=$this->db->getpost('gst');
		}else{
			$item['gst']=0;
		}
		
		$item['qty']=$this->db->getpost('quantity');
		$item['created_by']=$_SESSION['uid'];
		$id = $this->db->mysql_insert($this->tablename, $item);
		if ($id!=0) {
			return ['status'=>'success'];
		}else{
			return ['status'=>'failed'];
		}
	}
	public function get_items_data()
	{
		$sql='select * from '.$this->tablename.' where is_deleted="NO" and branch_id='.$_SESSION['branch_id'].'';
		$result=$this->db->GetResultsArray($sql);
		return $result;
	}
	public function get_items_dt($id)
	{
		$sql='select * from '.$this->tablename.' where id='.$id.' and branch_id=0';
		$result=$this->db->GetResultsArray($sql);
		return $result;
	}
	public function get_Autocomplete_items()
	{
		$sql = "select  * from ".$this->tablename." where item_name like '%" . $this->db->getpost('term') . "%' and branch_id = 0 and is_deleted = 'NO' ";


	$result = $this->db->GetResultsArray($sql);
	return $result;
	}
	public function edit_items()
	{
		$check_sql='select * from '.$this->tablename.' where item_name="'.$this->db->getpost('edit_item_name').'" and id!='.$this->db->getpost('item_id').' and is_deleted="NO"';
		$check_res=$this->db->GetResultsArray($check_sql);
		if (count($check_res)>0) {
			return ['status'=>'alert'];
		}
		$item=array();
		$item['item_name']=$this->db->getpost('edit_item_name');
		$item['brand']=$this->db->getpost('edit_item_brand');
		$item['category']=$this->db->getpost('edit_item_category');
		$item['sub_category']=$this->db->getpost('edit_item_sub_category');
		$item['mrp']=$this->db->getpost('edit_item_mrp');
		$item['sales_price']=$this->db->getpost('edit_item_sale_price');
		$item['discount']=$this->db->getpost('edit_item_discount');
		$item['units']=$this->db->getpost('edit_item_units');
		$item['gst']=$this->db->getpost('edit_item_gst');
		$item['qty']=$this->db->getpost('edit_item_qty');
		$id = $this->db->mysql_update($this->tablename, $item,'id='.$this->db->getpost('item_id'));
		if ($id!=0) {
			return ['status'=>'success'];
		}else{
			return ['status'=>'failed'];
		}
	}
	public function delete_items()
	{
		$varieties=array();
		$varieties['is_deleted']='YES';
		$id = $this->db->mysql_update($this->tablename, $varieties,'id='.$this->db->getpost('item_id'));
		if ($id!=0) {
			return ['status'=>'success'];
		}else{
			return ['status'=>'failed'];
		}
	}
	public function get_item_id(){

   $sql = 'select * from '.$this->tablename.' where branch_id="'.$_SESSION['branch_id'].'"';
   $result = $this->db->GetResultsArray($sql);
  
   return $result;

	}

	public function get_branch_item_code(){

   $sql = 'select * from '.$this->tablename.' where branch_id="'.$_SESSION['branch_id'].'"';
   $result = $this->db->GetResultsArray($sql);
  
   return $result;

	}

   public function get_variety_id($id){

   $sql = 'select * from purchase_order_details where item_code = "'.$id.'" and branch_id = '.$_SESSION['branch_id'].'';

  $result = $this->db->GetResultsArray($sql);

  return $result;

   }

public function get_Autocomplete_product(){
$sql = "select  * from ".$this->tablename." where item_name like '%" . $this->db->getpost('term') . "%' and branch_id = ".$_SESSION['branch_id']." and is_deleted = 'NO' ";

	$result = $this->db->GetResultsArray($sql);
	return $result;

  }

public function get_sale_items($id){
   $sql='select * from '.$this->tablename.' where id='.$id.' and branch_id='.$_SESSION['branch_id'].' and is_deleted="NO"';
		$result=$this->db->GetResultsArray($sql);
		// print_r($result);die();
		return $result;

}

}
?>