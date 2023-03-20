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
		$check_sql='select * from '.$this->tablename.' where item_name="'.$this->db->getpost('item_name').'" and is_deleted="NO" and branch_id='.$_SESSION['branch_id'].'';
		$check_res=$this->db->GetResultsArray($check_sql);
		if (count($check_res)>0) {
			return ['status'=>'alert'];
		}
		$item=array();
		$item['item_name']=$this->db->getpost('item_name');
		$item['item_code']=$this->db->getpost('item_code');
		$item['shop_id']=$_SESSION['shop_id'];
		$item['branch_id']=$_SESSION['branch_id'];
		$item['brand']=$this->db->getpost('brand');
		$item['category']=$this->db->getpost('category');
		$item['group_id']=$this->db->getpost('group_id');
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
		$sql='select * from '.$this->tablename.' where is_deleted="NO" and branch_id='.$_SESSION['branch_id'].' ORDER BY id DESC';
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
		$check_sql='select * from '.$this->tablename.' where item_name="'.$this->db->getpost('edit_item_name').'" and id!='.$this->db->getpost('item_id').' and is_deleted="NO" and branch_id='.$_SESSION['branch_id'].'';
		$check_res=$this->db->GetResultsArray($check_sql);
		if (count($check_res)>0) {
			return ['status'=>'alert'];
		}
		$item=array();
		$item['item_name']=$this->db->getpost('edit_item_name');
		$item['brand']=$this->db->getpost('edit_item_brand');
		$item['category']=$this->db->getpost('edit_item_category');
		$item['group_id']=$this->db->getpost('edit_item_group');
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

public function get_branch_items($b_id){

$sql = 'select * from '.$this->tablename.' where branch_id="'.$b_id.'" and is_deleted="NO"';
$result=$this->db->GetResultsArray($sql);
// print_r($result);die();

return $result;

}


public function total_var_qty($var_id){

if($_SESSION['type']=='ADMIN'){
$sql = 'select * from variety_items where branch_id='.$this->db->getpost('fbranch_id').' and variety_id='.$var_id.'';
}else{
$sql = 'select * from variety_items where branch_id='.$_SESSION['branch_id'].' and variety_id='.$var_id.'';

}
$result = $this->db->getAsIsArray($sql);
return ['status'=>'success','qty'=>$result['qty']];
}



public function total_item_qty($item_id){

if($_SESSION['type']=='ADMIN'){	
	if($_POST['fbranch_id']==0){

$sql = 'select * from '.$this->tablename.' where branch_id='.$this->db->getpost('fbranch_id').' and id='.$item_id.' and is_deleted="NO"';
$result = $this->db->getAsIsArray($sql);
return ['status'=>'success','qty'=>$result['qty']];

        }else{
$sql = 'select * from '.$this->tablename.' where branch_id='.$this->db->getpost('fbranch_id').' and item_id='.$item_id.' and is_deleted="NO"';
$result = $this->db->getAsIsArray($sql);
return ['status'=>'success','qty'=>$result['qty']];


        }
       }else{
  $sql = 'select * from '.$this->tablename.' where branch_id='.$_SESSION['branch_id'].' and item_id='.$item_id.' and is_deleted="NO"';
$result = $this->db->getAsIsArray($sql);
return ['status'=>'success','qty'=>$result['qty']];

       } 
}

public function get_group_name_dt($id){

$sql = 'select * from '.$this->tablename.' where branch_id= '.$_SESSION['branch_id'].' and group_id='.$id.' and is_deleted="NO"';
$result = $this->db->GetResultsArray($sql);

return $result;


}
public function get_all_group_name($id){
$sql = 'select * from '.$this->tablename.' where branch_id= '.$_SESSION['branch_id'].' and is_deleted="NO"';
$result = $this->db->GetResultsArray($sql);

return $result;

}
public function get_item_price($it_id,$b_id){

$sql = 'select sales_price as sale_price,updated_purchase_price from '.$this->tablename.' where item_id='.$it_id.' and branch_id='.$b_id.' and is_deleted="NO"';
$result = $this->db->getAsIsArray($sql);
if(count($result)>0){

return $result;

}else{
  $sql = 'select sales_price as sale_price,updated_purchase_price from '.$this->tablename.' where id='.$it_id.' and branch_id='.$_SESSION['branch_id'].' and is_deleted="NO"';
$result = $this->db->getAsIsArray($sql);
// print_r($result);die();
return $result;


}

}
public function update_item_price($it_id,$b_id){

 if($_SESSION['type']=='ADMIN'){
   $sql = 'select sales_price as sale_price,updated_purchase_price,mrp from '.$this->tablename.' where id='.$it_id.' and branch_id='.$_SESSION['branch_id'].' and is_deleted="NO"';
$result = $this->db->getAsIsArray($sql);
    return $result;

 }else{
  $sql = 'select sales_price as sale_price,updated_purchase_price from '.$this->tablename.' where item_id='.$it_id.' and branch_id='.$b_id.' and is_deleted="NO"';
$result = $this->db->getAsIsArray($sql);
    return $result;

 }

}

public function get_collection_items(){
$sql = 'select * from '.$this->tablename.'where branch_id='.$_SESSION['branch_id'].' and is_deleted="NO"';
$result = $this->db->GetResultsArray($sql);

return $result;

}
public function get_item_brand($id){
 $sql = 'select b.name as cat_name,c.name as brand_name,d.name as desc_name from items a join category b on a.category=b.id join brand c on a.brand = c.id join description d on a.sub_category=d.id where a.id='.$id.' and a.branch_id='.$_SESSION['branch_id'].' and a.is_deleted="NO"';
$result = $this->db->getAsIsArray($sql);

return $result;

}
public function get_item_name($id){
$sql = 'select item_name from '.$this->tablename.' where id='.$id.' and branch_id='.$_SESSION['branch_id'].'';
$result = $this->db->getAsIsArray($sql);

return $result;
}

}
?>