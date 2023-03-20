<?php

class CustomerSale extends Dbconnection {
	var $name;
	var $db;
	var $invitee_obj;
	var $msg = '';
	var $tablename = "`customer_sale`";
  var $tablename2 = "`customer_sale_details`";
  Var $tablename3 = "`sale_payment_log`";
   
	
	// Create Db Connection for this class operations
	function __construct() {
		parent::__construct();
		$this->db = new Dbconnection();
	}

public function add_sales(){

$item = array();
$item = $_POST;
$sales = array();
$sales_log = array();

$sql='select max(sale_id) as sale_id from '.$this->tablename.' where branch_id='.$_SESSION['branch_id'].'';
    $result=$this->db->GetResultsArray($sql);
    if ($result[0]['sale_id']=='' && $result[0]['sale_id']==0) {
      $sale_id=1;
    }else{
      $sale_id=$result[0]['sale_id']+1;
    }

   $sales['branch_id']=$_SESSION['branch_id'];
   $sales['customer_id'] =$this->db->getpost('customer_id');
   $sales['sale_id']=$sale_id;
   $sales['discount_amt']=$this->db->getpost('discount');
   $sales['taxable_amt']=$this->db->getpost('taxable_amount');
   $sales['received_date'] =date('Y-m-d H:i:s');
   $sales['tax_amt']=$this->db->getpost('tax_amount');
   $sales['grand_total']=$this->db->getpost('grand_total');
   $sales['created_by']=$_SESSION['uid'];
   $sales['created_at']=date('Y-m-d H:i:s');

   // $sales['bill_no']=$this->db->getpost('bill_no');
   // $sales['received_date']=$this->db->getpost('received_date');
   $sales['paid_amt']=$this->db->getpost('paid_amt');
   $sales['balance_amt']=$this->db->getpost('balance');
   $sales['required_gst'] = $this->db->getpost('required_gst');
   
    if ($this->db->getpost('balance')==0) {
   $sales['status']='PAID';
    }
   
   $sales_id = $this->db->mysql_insert($this->tablename,$sales);
// print_r($item);die();
   foreach ($item as $key => $itemvar) {
    if ((isset($itemvar["item_name"]) && $itemvar["item_name"] !== '') && $itemvar["mrp"] != 0) {
            
         $sale_items=array();
                       $sale_items['branch_id']=$_SESSION['branch_id'];
                       $sale_items['customer_id']=$this->db->getpost('customer_id');
                       $sale_items['sale_id']=$sale_id;
                       $sale_items['item_id']=$itemvar["item_id"];
                       $sale_items['brand']=$itemvar["brand"];
                       $sale_items['units']=$itemvar["units"];
                       $sale_items['category']=$itemvar["category"];
                       if ($itemvar['sub_category']!='') {
                        $sale_items['sub_category']=$itemvar["sub_category"];
                       }else{
                        $sale_items['sub_category']=0;
                       }
                       
                       $sale_items['item_name']=$itemvar["item_name"];
                       $sale_items['item_code']=$itemvar["item_code"];
                       $sale_items['var_id']=$itemvar["varieties_id"];
                       $sale_items['var_name']=$itemvar["varieties_name"];
                       $sale_items['mrp']=$itemvar["mrp"];
                       $sale_items['sales_price']=$itemvar["sale_price"];
                       $sale_items['discount']=$itemvar["discount"];
                       $sale_items['gst']=$itemvar["gst"];
                       $sale_items['qty']=$itemvar["quantity"];
                       
                        $sale_items['received_qty']=$itemvar["quantity"];
                       
                       $sale_items['taxable_amt']=$itemvar['total']-$itemvar["gstamount"];
                       $sale_items['tax_amt']=$itemvar["gstamount"];
                       $sale_items['total']=$itemvar["total"];
                       $sale_items['created_by']=$_SESSION['uid'];
                       $sale_items['created_at']=date('Y-m-d H:i:s');
                      $this->db->mysql_insert($this->tablename2,$sale_items);
                      if($itemvar["item_id"]!=''){

          $sql ='select * from items where branch_id ='.$_SESSION['branch_id'].' and item_id='.$itemvar["item_id"].'';
          $branch_item_qty = $this->db->GetResultsArray($sql);
           $update_item_qty = array();

            $update_item_qty['qty'] = $branch_item_qty[0]['qty']-$itemvar["quantity"];
            

        $update=$this->db->mysql_update('items',$update_item_qty,'id='.$branch_item_qty[0]['id']);

          }
          if($itemvar["varieties_id"]!=''){

          $sql = 'select * from variety_items where branch_id='.$_SESSION['branch_id'].' and variety_id='.$itemvar["varieties_id"].'';
          $branch_var_qty= $this->db->GetResultsArray($sql);
          $update_var_qty = array();
          $update_var_qty['qty'] = $branch_var_qty[0]['qty']-$itemvar["quantity"];


        $this->db->mysql_update('variety_items',$update_var_qty,'id='.$branch_var_qty[0]['id']);

          }
          
        }
        
           



      }
      if ($this->db->getpost('paid_amt')!='' && $this->db->getpost('paid_amt')!=0) {

    $sales_log['branch_id']=$_SESSION['branch_id'];
    $sales_log['customer_id'] = $this->db->getpost('customer_id');
    $sales_log['sale_id']=$sale_id;
    $sales_log['credit']=$this->db->getpost('paid_amt');
    $sales_log['payment_mode']=$this->db->getpost('payment_mode');
    $sales_log['description']='Balance Collection';
    $sales_log['created_by']=$_SESSION['uid'];
    $sales_log['created_at']=date('Y-m-d H:i:s');
    $this->db->mysql_insert($this->tablename3, $sales_log);
                   }

      


    return ['status'=>'success'];
      }

  public function get_sale_details(){
   $sql = 'select * from '.$this->tablename.'where branch_id='.$_SESSION['branch_id'].' and is_deleted="NO" ORDER BY id DESC';
   $result = $this->db->GetResultsArray($sql);
   return $result;
  }
  public function get_sale_data($id){

   $sql = 'select * from '.$this->tablename2.'where branch_id='.$_SESSION['branch_id'].' and sale_id='.$id.'';
   $result = $this->db->GetResultsArray($sql);
   return $result;

  }
  public function customer_sale_details($id){
  $sql = 'select * from '.$this->tablename.'where branch_id='.$_SESSION['branch_id'].' and id='.$id.' and is_deleted="NO"';
   $result = $this->db->GetResultsArray($sql);
   return $result;

  }
  public function sale_payment($id){

  $sql = 'select * from '.$this->tablename3.' where branch_id='.$_SESSION['branch_id'].' and sale_id='.$id.'';
   $result = $this->db->GetResultsArray($sql);
   return $result;
  }
  public function get_item_details($id){
     $sql = 'select * from '.$this->tablename.' where branch_id='.$_SESSION['branch_id'].' and id='.$id.' and is_deleted="NO"';
   $result = $this->db->GetResultsArray($sql);
   return $result;


  }

 public function customer_pay(){
  $sql='select * from '.$this->tablename.' where branch_id='.$_SESSION['branch_id'].' and id='.$this->db->getpost('pay_id');
    $result=$this->db->GetResultsArray($sql);

    
    $pay_log=array();
 $pay_log['paid_amt']=$result[0]['paid_amt']+$this->db->getpost('paid_amt');
    $pay_log['balance_amt']=$this->db->getpost('balance');
   $pay_log['created_by']=$_SESSION['uid'];
   $pay_log['created_at']=date('Y-m-d H:i:s');
    if ($this->db->getpost('balance')==0) {
    $pay_log['status']='PAID';
    }

     $this->db->mysql_update($this->tablename, $pay_log,'id='.$this->db->getpost('pay_id'));

        $sale_log=array();
     
     $sale_log['branch_id']=$_SESSION['branch_id'];
     $sale_log['sale_id']=$this->db->getpost('sale_id');
     $sale_log['customer_id']=$this->db->getpost('cus_id');
     $sale_log['credit']=$this->db->getpost('paid_amt');
     $sale_log['payment_mode']=$this->db->getpost('payment_mode');
     $sale_log['description']='Balance Collection';
     $sale_log['created_by']=$_SESSION['uid'];
     $sale_log['created_at']=date('Y-m-d H:i:s');
      $this->db->mysql_insert($this->tablename3,$sale_log);

     return ['status'=>'success'];

 }

 public function get_sale_dt($id){
 $sql ='select * from '.$this->tablename.'where id='.$id.' and branch_id='.$_SESSION['branch_id'].' and is_deleted="NO"';

$result=$this->db->GetResultsArray($sql);

return $result;

 }
 public function get_sale_item_dt($id){
$sql ='select * from '.$this->tablename2.'where sale_id='.$id.' and branch_id='.$_SESSION['branch_id'].' and is_deleted="NO"';
$result = $this->db->GetResultsArray($sql);

return $result;

 }
 public function get_top_sale($id){

$sql = 'select sum(qty) as qty,item_name,var_id,var_name from '.$this->tablename2.' where branch_id='.$id.' and is_deleted="NO" group by item_name,var_id order by qty DESC';
$result = $this->db->GetResultsArray($sql);


return $result;


 }
 public function product_details($sale_id){

$sql = 'select * from '.$this->tablename2.' where branch_id = '.$_SESSION['branch_id'].' and sale_id='.$sale_id.'';
$result=$this->db->GetResultsArray($sql);
return $result;

 }

 public function get_collection($fdate,$tdate,$b_id){
 $sql = "select * from ".$this->tablename." where date(created_at)>='".$fdate."' and date(created_at)<='".$tdate."' and branch_id=".$b_id." and  is_deleted='NO'";
$result=$this->db->GetResultsArray($sql);

return $result;

 }
 public function branch_sale_details($sale_id,$b_id){

 $sql = "select * from ".$this->tablename." where sale_id='".$sale_id."' and branch_id
 ='".$b_id."' and is_deleted='NO'";

$result=$this->db->GetResultsArray($sql);


return $result;


 }
public function get_variety_details($sale_id,$b_id){

$sql = "select * from ".$this->tablename2." where sale_id='".$sale_id."' and branch_id
 ='".$b_id."' and is_deleted='NO'";


$result=$this->db->GetResultsArray($sql);
return $result;

}
public function branch_sale_customer_dt($fdate,$tdate){
 $sql = "select * from ".$this->tablename." where date(created_at)>='".$fdate."' and date(created_at)<='".$tdate."' and branch_id=".$_SESSION['branch_id']." and  is_deleted='NO'";
$result=$this->db->GetResultsArray($sql);
  
return $result;

}
public function get_customer_collection($fdate,$tdate,$c_id,$gst){
if($c_id!=0){
$sql = "select * from ".$this->tablename."where date(created_at)>='".$fdate."' and date(created_at)<='".$tdate."' and branch_id=".$_SESSION['branch_id']." and customer_id='".$c_id."' and required_gst='".$gst."' and is_deleted='NO'";
}else{
$sql = "select * from ".$this->tablename."where date(created_at)>='".$fdate."' and date(created_at)<='".$tdate."' and branch_id=".$_SESSION['branch_id']."  and required_gst='".$gst."' and is_deleted='NO'";

}
$result=$this->db->GetResultsArray($sql);


return $result;
}
public function get_item_name($it_id,$fdate,$tdate,$b_id){
  
   $sql = "select a.*,b.* from customer_sale a left join customer_sale_details b on a.sale_id=b.sale_id where b.item_id=".$it_id." and date(a.created_at)>='".$fdate."' and date(a.created_at)<='".$tdate."' and a.branch_id=".$b_id." and a.is_deleted='NO'";

$result=$this->db->GetResultsArray($sql);

return $result;

}

public function branch_sale_items_details($s_id,$b_id,$date,$item_id){
$sql = "select * from ".$this->tablename2."where branch_id=".$b_id." and sale_id=".$s_id." and date(created_at)>='".date('Y-m-d',strtotime($date))."' and date(created_at)<='".date('Y-m-d',strtotime($date))."' and item_id=".$item_id." and is_deleted='NO'";
$result=$this->db->GetResultsArray($sql);

return $result;


}
public function sale_customer_dt_gst($fdate,$tdate,$c_id,$gst){
  if($c_id!=0){
$sql = "select * from ".$this->tablename."where date(created_at)>='".$fdate."' and date(created_at)<='".$tdate."' and branch_id=".$_SESSION['branch_id']." and customer_id='".$c_id."' and required_gst='".$gst."' and is_deleted='NO'";
}else{
$sql = "select * from ".$this->tablename."where date(created_at)>='".$fdate."' and date(created_at)<='".$tdate."' and branch_id=".$_SESSION['branch_id']."  and required_gst='".$gst."' and is_deleted='NO'";

}
$result=$this->db->GetResultsArray($sql);


return $result;


}


}


  



?>