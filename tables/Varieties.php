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
		$variety['mrp']=$this->db->getpost('mrp');
		$variety['sale_price'] = $this->db->getpost('sale_price');
		$id = $this->db->mysql_insert($this->tablename, $variety);
		if ($id!=0) {
			return ['status'=>'success'];
		}else{
			return ['status'=>'failed'];
		}
	}
	public function update_varieties_data(){

  //    $check_sql='select * from '.$this->tablename.' where name="'.$this->db->getpost('variety_name').'" and id="'.$this->db->getpost('id').'" and is_deleted="NO"';

		
		// $check_res=$this->db->GetResultsArray($check_sql);
		// if (count($check_res)>0) {
		// 	return ['status'=>'alert'];
		// }

		$variety=array();
		
		$variety['name']=$this->db->getpost('variety_name');
		$variety['mrp']=$this->db->getpost('mrp');
		$variety['sale_price'] = $this->db->getpost('sale_price');
		$id = $this->db->mysql_update($this->tablename, $variety,'id='.$this->db->getpost('id'));
		if ($id!=0) {
			return ['status'=>'success',];
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
		$sql='select * from '.$this->tablename.' where item_id='.$item_id.' and is_deleted="NO" and branch_id=0';
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

$sql = 'select a.branch_id,a.item_id,a.qty,b.name,b.mrp,b.sale_price,a.variety_id,b.updated_purchase_price from variety_items a join varieties b on a.variety_id=b.id where b.item_id='.$id.' and a.branch_id = '.$_SESSION['branch_id'].' and b.is_deleted="NO"';

  $result = $this->db->GetResultsArray($sql);
  
  return $result;

	}
	public function get_branch_varieties_dt($id){

 $sql = 'select a.branch_id,a.item_id,a.qty,b.name,b.mrp,b.sale_price,a.variety_id,b.updated_purchase_price from variety_items a join varieties b on a.variety_id=b.id where b.item_id='.$id.' and a.branch_id = '.$_SESSION['branch_id'].' and b.is_deleted="NO"';

  $result = $this->db->GetResultsArray($sql);
  
  return $result;

	}

public function get_qty($id){

 $sql = 'select * from '.$this->tablename1.' where variety_id ='.$id.' and branch_id =0';

$result = $this->db->GetResultsArray($sql);

// print_r($result);die();

return $result;
}
public function get_sale_varieties($item_id){

$sql='select * from '.$this->tablename.' where item_id='.$item_id.' and branch_id='.$_SESSION['branch_id'].' and is_deleted="NO"';
$result=$this->db->GetResultsArray($sql);
return $result;

}
public function get_stock_variety($item_id,$b_id){

 $sql = 'select a.*,b.* from variety_items a join Varieties b on a.variety_id=b.variety_id where a.branch_id='.$b_id.' and a.item_id='.$item_id.' and b.branch_id='.$b_id.' ';

$result = $this->db->GetResultsArray($sql);

return $result;

}
public function get_var_price($v_id){
	
$sql = 'select * from '.$this->tablename.' where id='.$v_id.' and branch_id=0 and is_deleted="NO"';
$result = $this->db->getAsIsArray($sql);


return $result;
}

public function get_var_price_dt($v_id){
 $sql = 'select * from '.$this->tablename.' where variety_id='.$v_id.' and branch_id='.$_SESSION['branch_id'].' and is_deleted="NO"';
$result = $this->db->getAsIsArray($sql);
return $result;

}
public function get_var_dt($v_id){
$sql = 'select * from '.$this->tablename.' where id='.$v_id.' and branch_id='.$_SESSION['branch_id'].' and is_deleted="NO"';
$result = $this->db->getAsIsArray($sql);
return $result;
}
public function get_updated_price($v_id,$b_id){
 
$sql = 'select sale_price,updated_purchase_price from '.$this->tablename.' where variety_id='.$v_id.' and branch_id='.$b_id.' and is_deleted="NO"';
$result = $this->db->getAsIsArray($sql);
if(count($result)>0){

return $result;

}else{
  $sql = 'select sale_price,updated_purchase_price from '.$this->tablename.' where id='.$v_id.' and branch_id='.$_SESSION['branch_id'].' and is_deleted="NO"';
$result = $this->db->getAsIsArray($sql);

return $result;

}


}
public function updated_var_price($v_id,$b_id){
if($_SESSION['type']=='ADMIN'){
 $sql = 'select sale_price,updated_purchase_price from '.$this->tablename.' where id='.$v_id.' and branch_id='.$_SESSION['branch_id'].' and is_deleted="NO"';
$result = $this->db->getAsIsArray($sql);

    return $result;

}else{
 $sql = 'select sale_price,updated_purchase_price from '.$this->tablename.' where variety_id='.$v_id.' and branch_id='.$b_id.' and is_deleted="NO"';
$result = $this->db->getAsIsArray($sql);
    return $result;

}


}
public function get_variety_price($id){
 $sql = 'select * from '.$this->tablename.' where variety_id='.$id.' and branch_id='.$_SESSION['branch_id'].' and is_deleted="NO"';

$result = $this->db->GetResultsArray($sql);

return $result;


}
public function get_price($id){
 $sql = 'select * from '.$this->tablename.' where id='.$id.' and branch_id='.$_SESSION['branch_id'].' and is_deleted="NO"';

$result = $this->db->GetResultsArray($sql);

return $result;


}


}
?>