<?php
// error_reporting(E_ALL);
class SaveOrder extends Dbconnection {
	var $name;
	var $db;
	var $invitee_obj;
	var $msg = '';
	var $tablename = "`save_order`";
	var $tablename2 = "`save_order_details`";
	
	// Create Db Connection for this class operations
	function __construct() {
		parent::__construct();
		$this->db = new Dbconnection();
	}

public function save_purchase(){

	$item = array();
		$item = $_POST;
		$save_order=array();
		
$sql='select max(purchase_no) as purchase_no from purchase_order where  branch_id='.$_SESSION['branch_id'].'';
		$result=$this->db->GetResultsArray($sql);
	if ($result[0]['purchase_no']=='' && $result[0]['purchase_no']==0) {
			$purchase_no=1;
		}else{
			$purchase_no=$result[0]['purchase_no']+1;
		}

        $save_order['branch_id']=$_SESSION['branch_id'];
		$save_order['purchase_no']=$purchase_no;
		$save_order['vendor_id']=$this->db->getpost('vendor_id');
		$save_order['discount_amt']=$this->db->getpost('discount');
		$save_order['taxable_amt']=$this->db->getpost('taxable_amount');
		$save_order['tax_amt']=$this->db->getpost('tax_amount');
		$save_order['grand_total']=$this->db->getpost('grand_total');
		$save_order['purchase_note']=$this->db->getpost('purchase_note');
		$save_order['created_by']=$_SESSION['uid'];
		$save_order['created_at']=date('Y-m-d H:i:s');

		$save_order['bill_no']=$this->db->getpost('bill_no');
		$save_order['received_date']=$this->db->getpost('received_date');
		$save_order['paid_amt']=$this->db->getpost('paid_amt');
		$save_order['balance_amt']=$this->db->getpost('balance');
		$save_order['status']='save';	
		$save_order['is_deleted']='NO';

  $id = $this->db->mysql_insert($this->tablename,$save_order);
 

 
foreach ($item as $itemvar) {
         
  if ((isset($itemvar["item_name"]) && $itemvar["item_name"]!='')){
       $save_items=array();
                       $save_items['branch_id']=$_SESSION['branch_id'];
                       $save_items['save_id']= $id;
                       
                       $save_items['item_id']=$itemvar["item_id"];
                       $save_items['brand']=$itemvar["brand"];
                       $save_items['units']=$itemvar["units"];
                       $save_items['category']=$itemvar["category"];
                       if ($itemvar['sub_category']!='') {
                       	$save_items['sub_category']=$itemvar["sub_category"];
                       }else{
                       	$save_items['sub_category']=0;
                       }
                       
                       $save_items['item_name']=$itemvar["item_name"];
                       $save_items['item_code']=$itemvar["item_code"];
                       $save_items['var_id']=$itemvar["varieties_id"];
                       $save_items['var_name']=$itemvar["varieties_name"];
                       $save_items['mrp']=$itemvar["mrp"];
                       $save_items['sales_price']=$itemvar["sale_price"];
                     $save_items['updated_sale_price']=$itemvar["updated_sale_price"];
                       $save_items['discount']=$itemvar["discount"];
                       $save_items['gst']=$itemvar["gst"];
                       $save_items['qty']=$itemvar["quantity"];
                       if ($this->db->getpost('order_type')=='received') {
                       	$save_items['received_qty']=$itemvar["quantity"];
                       }
                       $save_items['taxable_amt']=$itemvar['total']-$itemvar["gstamount"];
                       $save_items['tax_amt']=$itemvar["gstamount"];
                       $save_items['total']=$itemvar["total"];
                       $save_items['created_by']=$_SESSION['uid'];
                       $save_items['created_at']=date('Y-m-d H:i:s');
                      
                      $details_id=$this->db->mysql_insert($this->tablename2, $save_items);
                         
                  

        }

        }
 return ['status'=>'success'];

		
}
public function get_save_id(){
$sql = 'select * from '.$this->tablename.'where branch_id=0 and is_deleted="NO" and status="save"';
$result = $this->db->GetResultsArray($sql);
return $result;


} 
public function get_saved_items($id){

$sql = 'select * from '.$this->tablename2.' where branch_id='.$_SESSION['branch_id'].' and save_id='.$id.' and is_deleted="NO"';
$result = $this->db->GetResultsArray($sql);

return $result;

}
public function get_saved_order($id){
$sql = 'select * from '.$this->tablename.' where branch_id='.$_SESSION['branch_id'].' and id='.$id.' and is_deleted="NO"';
$result = $this->db->GetResultsArray($sql);

return $result;

}

public function get_total_value($id,$b_id){

$sql = 'select * from '.$this->tablename.'where branch_id='.$b_id.' and id='.$id.' and is_deleted="NO"';
$result = $this->db->GetResultsArray($sql);

return $result;

}


public function update_purchase(){
$item = array();
$item = $_POST;
$save_order=array();
        $save_order['branch_id']=$_SESSION['branch_id'];
	
		$save_order['vendor_id']=$this->db->getpost('vendor_id');
		$save_order['discount_amt']=$this->db->getpost('discount');
		$save_order['taxable_amt']=$this->db->getpost('taxable_amount');
		$save_order['tax_amt']=$this->db->getpost('tax_amount');
		$save_order['grand_total']=$this->db->getpost('grand_total');
		$save_order['purchase_note']=$this->db->getpost('purchase_note');
		$save_order['created_by']=$_SESSION['uid'];
		$save_order['created_at']=date('Y-m-d H:i:s');

		$save_order['bill_no']=$this->db->getpost('bill_no');
		$save_order['received_date']=$this->db->getpost('received_date');
		$save_order['paid_amt']=$this->db->getpost('paid_amt');
		$save_order['balance_amt']=$this->db->getpost('balance');
		$save_order['status']='save';	
		$save_order['is_deleted']='NO';

       $result = $this->db->mysql_update($this->tablename,$save_order,'id='.$this->db->getpost('save_id'));

 foreach ($item as $itemvar) {
         
  if ((isset($itemvar["item_name"]) && $itemvar["item_name"]!='')){
       $save_items=array();
                       $save_items['branch_id']=$_SESSION['branch_id'];
                       $save_items['save_id']= $this->db->getpost('save_id');
                       
                       $save_items['item_id']=$itemvar["item_id"];
                       $save_items['brand']=$itemvar["brand"];
                       $save_items['units']=$itemvar["units"];
                       $save_items['category']=$itemvar["category"];
                       if ($itemvar['sub_category']!='') {
                       	$save_items['sub_category']=$itemvar["sub_category"];
                       }else{
                       	$save_items['sub_category']=0;
                       }
                       
                       $save_items['item_name']=$itemvar["item_name"];
                       $save_items['item_code']=$itemvar["item_code"];
                       $save_items['var_id']=$itemvar["varieties_id"];
                       $save_items['var_name']=$itemvar["varieties_name"];
                       $save_items['mrp']=$itemvar["mrp"];
                       $save_items['sales_price']=$itemvar["sale_price"];
                     $save_items['updated_sale_price']=$itemvar["updated_sale_price"];
                       $save_items['discount']=$itemvar["discount"];
                       $save_items['gst']=$itemvar["gst"];
                       $save_items['qty']=$itemvar["quantity"];
                       
                       	$save_items['received_qty']=$itemvar["quantity"];
                 
                       $save_items['taxable_amt']=$itemvar['total']-$itemvar["gstamount"];
                       $save_items['tax_amt']=$itemvar["gstamount"];
                       $save_items['total']=$itemvar["total"];
                       $save_items['created_by']=$_SESSION['uid'];
                       $save_items['created_at']=date('Y-m-d H:i:s');
                       $save_items['is_deleted']=$itemvar['deleted'];



                      if($itemvar['flag']=='new'){
                      $details_id=$this->db->mysql_insert($this->tablename2, $save_items,'');
                     }else{
                     if($itemvar['varieties_id']==0 || $itemvar['varieties_id']==''){
                       $sql = 'select * from '.$this->tablename2.' where save_id='.$itemvar['save_id'].' and item_id='.$itemvar['item_id'].' and branch_id='.$_SESSION['branch_id'].' and is_deleted="NO"';
                       $res = $this->db->GetResultsArray($sql);
                       $details_id=$this->db->mysql_update($this->tablename2, $save_items,'id='.$res[0]['id']);
                           }else{
                             $sql = 'select * from '.$this->tablename2.' where save_id='.$itemvar['save_id'].' and var_id='.$itemvar['varieties_id'].' and branch_id='.$_SESSION['branch_id'].' and is_deleted="NO"';
                              $res = $this->db->GetResultsArray($sql);
                         $details_id=$this->db->mysql_update($this->tablename2, $save_items,'id='.$res[0]['id']);

                           }
                     }

        }

        }


return ['status'=>'success'];

       

}


	


}