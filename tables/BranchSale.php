<?php
class BranchSale extends Dbconnection {
	var $name;
	var $db;
	var $invitee_obj;
	var $msg = '';
	var $tablename = "`branch_sale`";
  var $tablename2 = "`branch_sale_items`";
	
	// Create Db Connection for this class operations
	function __construct() {
		parent::__construct();
		$this->db = new Dbconnection();
	}
	
public function add_branch_sale(){
  
$item = array();
$item = $_POST; 
$branch_sale = array();
$total_enter_qty = 0;


$sql = 'select max(bill_no) as bill_no from '.$this->tablename.' where branch_id ='.$this->db->getpost('branch_id');
$result = $this->db->GetResultsArray($sql);

if($result[0]['bill_no']==''){

     $bill_no = 1;

}else{

     $bill_no = $result[0]['bill_no']+1;  

}


$branch_sale['branch_id'] = $this->db->getpost('branch_id');
$branch_sale['bill_no'] = $bill_no;
$branch_sale['po_id'] = $this->db->getpost('po_id');
$branch_sale['purchase_no'] = $this->db->getpost('purchase_no');
$branch_sale['discount_amt'] = $this->db->getpost('discount');
$branch_sale['taxable_amt'] = $this->db->getpost('taxable_amount');
$branch_sale['tax_amt'] = $this->db->getpost('tax_amount');
$branch_sale['total_qty'] = $this->db->getpost('quantity');
$branch_sale['grand_total'] = $this->db->getpost('grand_total');
$branch_sale['created_by']= $_SESSION['uid'];
$branch_sale['balance_amt'] = $this->db->getpost('grand_total');


$sql = $this->db->mysql_insert($this->tablename,$branch_sale);

foreach ($item as $key => $itemvar) {
  if ((isset($itemvar["item_name"]) && $itemvar["item_name"] !== '') && $itemvar["mrp"] != 0){  
    $sale_item = array();
    $sale_item['branch_id'] = $this->db->getpost('branch_id');
    $sale_item['purchase_no'] = $this->db->getpost('purchase_no');
    $sale_item['po_id'] =  $this->db->getpost('po_id');
    $sale_item['item_id'] = $itemvar['item_id'];
    $sale_item['brand'] = $itemvar['brand'];
    $sale_item['units'] = $itemvar['units'];
    $sale_item['category'] = $itemvar['category'];
   
  
     if ($itemvar['sub_category']!='') {
                       $sale_item['sub_category']=$itemvar["sub_category"];
                       }else{
                        $sale_item['sub_category']=0;
                       }
                       

    $sale_item['item_name'] = $itemvar['item_name'];
    $sale_item['item_code'] = $itemvar['item_code'];
    $sale_item['var_id'] = $itemvar['varieties_id'];
    $sale_item['var_name']=$itemvar["varieties_name"];
    $sale_item['mrp']=$itemvar["mrp"];
    $sale_item['discount']=$itemvar["discount"];
    $sale_item['gst']=$itemvar["gst"];
    $sale_item['qty']=$itemvar["enter_qty"];
    $sale_item['taxable_amt']=$itemvar['total']-$itemvar["gstamount"];
    $sale_item['tax_amount']=$itemvar["gstamount"];
    $sale_item['total']=$itemvar["total"];
    $sale_item['created_by']=$_SESSION['uid'];
    $sale_item['created_at']=date('Y-m-d H:i:s');  


                       
    $sale_id=$this->db->mysql_insert($this->tablename2, $sale_item);


if($sale_id!=""){

 $sql = 'select * from '.$this->tablename2.' where po_id ='.$this->db->getpost('po_id').' and branch_id='.$this->db->getpost('branch_id').'';

$res = $this->db->GetResultsArray($sql);



$sql1 = 'select * from variety_items where variety_id = '.$itemvar['varieties_id'].' and branch_id = 0 ';

$admin_var_qty = $this->db->GetResultsArray($sql1);


$update_qty = array();

$update_qty['qty'] = $admin_var_qty[0]['qty']-$itemvar["enter_qty"];


if($itemvar['varieties_id']!=0){
$update_admin_var = $this->db->mysql_update('variety_items',$update_qty,'id='.$admin_var_qty[0]['id']);

}

$item = 'select * from items where item_code = "'.$itemvar['item_code'].'" and branch_id = 0';
$update_item_qty = $this->db->GetResultsArray($item);



$update_item = array();


$update_item['qty'] = $update_item_qty[0]['qty']-$itemvar["enter_qty"];


$update_id = $this->db->mysql_update('items',$update_item,'id='.$update_item_qty[0]['id']);

}



}

}
if($update_id){

  return ['status'=>'success'];
}

}

public function get_bill_no($b_id,$purchase_no){

$sql = 'select * from '.$this->tablename.' where branch_id='.$b_id.' and purchase_no='.$purchase_no.'';
$result = $this->db->GetResultsArray($sql);

// print_r($result);die();

return $result;

}

public function get_collection(){

$sql = 'select * from '.$this->tablename.' where created_by ='.$_SESSION['uid'];
$result = $this->db->GetResultsArray($sql);

return $result;

}

public function get_payment_details($id,$b_id){

$sql = 'select * from '.$this->tablename.' where po_id = '.$id.' and branch_id = '.$b_id.'';
$result = $this->db->GetResultsArray($sql);
return $result;

}

public function get_items($id,$b_id){

$sql = 'select * from '.$this->tablename2.' where po_id = '.$id.' and branch_id = '.$b_id.'';
$result = $this->db->GetResultsArray($sql);
return $result;

}
public function get_transaction($fdate,$tdate,$branch_id){

 $sql = "select * from ".$this->tablename." where date(created_at)>='".$fdate."' and date(created_at)<='".$tdate."' and branch_id='".$branch_id."'";
$result = $this->db->GetResultsArray($sql);

return $result;


}


}
?>