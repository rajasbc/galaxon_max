<?php
// error_reporting(E_ALL);
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
$branch_sale['created_by']= $_SESSION['branch_id'];

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


}

}
if($sale_id){

  return ['status'=>'success'];
}

}

public function get_bill_no($b_id,$purchase_no){

$sql = 'select * from '.$this->tablename.' where branch_id='.$b_id.' and purchase_no='.$purchase_no.'';
$result = $this->db->GetResultsArray($sql);

// print_r($result);die();

return $result;

}

}
?>