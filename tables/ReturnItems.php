<?php

class ReturnItems extends Dbconnection {
 var $name;
 var $db;
 var $invitee_obj;
 var $msg = '';
 var $tablename = "`return_item`";
 var $tablename2 = "`return_item_details`";
  // Create Db Connection for this class operations
 function __construct() {
  parent::__construct();
  $this->db = new Dbconnection();
 }
 public function add_return_item()
 {

  $return_item = array();
  $return_item = $_POST;
  $add_item=array();
  $add_item_log=array(); 

  $add_item['branch_id']=$this->db->getpost('branch_id');
  $add_item['tbranch_id'] = $this->db->getpost('tbranch_id');

  $add_item['discount_amt']=$this->db->getpost('discount');
  $add_item['taxable_amt']=$this->db->getpost('taxable_amount');
  $add_item['tax_amt']=$this->db->getpost('tax_amount');
  $add_item['grand_total']=$this->db->getpost('grand_total');
  $add_item['created_by']=$_SESSION['uid'];
  $add_item['created_at']=date('Y-m-d H:i:s');
  $add_item['return_date']=date('Y-m-d H:i:s');

  $return_item_id = $this->db->mysql_insert($this->tablename, $add_item);
  
  foreach ($return_item as $key => $itemvar) {


   if ((isset($itemvar["item_name"]) && $itemvar["item_name"] !== '')  && $itemvar["item_id"]!=0) {


    $return_items_variety=array();
    $return_items_variety['branch_id']=$this->db->getpost('branch_id');
    $return_items_variety['tbranch_id'] = $this->db->getpost('tbranch_id');
    $return_items_variety['return_id']= $return_item_id;
    $return_items_variety['item_id']=$itemvar["item_id"];
    $return_items_variety['brand']=$itemvar["brand"];
    $return_items_variety['units']=$itemvar["units"];
    $return_items_variety['category']=$itemvar["category"];
    if ($itemvar['sub_category']!='') {
     $return_items_variety['sub_category']=$itemvar["sub_category"];
    }else{
     $return_items_variety['sub_category']=0;
    }

    $return_items_variety['item_name']=$itemvar["item_name"];
    $return_items_variety['item_code']=$itemvar["item_code"];
    $return_items_variety['var_id']=$itemvar["varieties_id"];
    $return_items_variety['var_name']=$itemvar["varieties_name"];
    $return_items_variety['mrp']=$itemvar["mrp"];
    $return_items_variety['sales_price']=$itemvar["sale_price"];
    $return_items_variety['discount']=$itemvar["discount"];
    $return_items_variety['gst']=$itemvar["gst"];
    $return_items_variety['qty']=$itemvar["quantity"];
    $return_items_variety['return_qty']=$itemvar["quantity"];
    $return_items_variety['taxable_amt']=$itemvar['total']-$itemvar["gstamount"];
    $return_items_variety['tax_amt']=$itemvar["gstamount"];
    $return_items_variety['total']=$itemvar["total"];
    $return_items_variety['created_by']=$_SESSION['uid'];
    $return_items_variety['created_at']=date('Y-m-d H:i:s');

    $details_id=$this->db->mysql_insert($this->tablename2,$return_items_variety);

   }

  }

  $sql = 'select * from '.$this->tablename2.' where return_id = '.$return_item_id.' and is_deleted="NO"';

  $qty = $this->db->GetResultsArray($sql);


  foreach ($qty as $key => $value) {

   if($value['branch_id']!=0){ 
    $sql = 'select * from items where branch_id = '.$value['branch_id'].' and item_id='.$value['item_id'].' and is_deleted="NO"';
    $item_qty = $this->db->GetResultsArray($sql);
    $update_qty = array();

    $update_qty['qty'] = $item_qty[0]['qty']-$value['return_qty'];

    $this->db->mysql_update('items',$update_qty,'id='.$item_qty[0]['id']);

    if($value['var_id']!=0 && $value['var_name']!=''){
     $sql = 'select * from variety_items where branch_id = '.$value['branch_id'].' and variety_id='.$value['var_id'].'';
     $var_qty = $this->db->GetResultsArray($sql);

     $update_var_qty = array();

     $update_var_qty['qty'] = $var_qty[0]['qty']-$value['return_qty'];

     $this->db->mysql_update('variety_items',$update_var_qty,'id='.$var_qty[0]['id']);

    }


   }else{

    $sql = 'select * from items where branch_id = '.$value['branch_id'].' and id='.$value['item_id'].' and is_deleted="NO"';
    $item_qty = $this->db->GetResultsArray($sql);
    $update_qty = array();

    $update_qty['qty'] = $item_qty[0]['qty']-$value['return_qty'];

    $this->db->mysql_update('items',$update_qty,'id='.$item_qty[0]['id']);
    if($value['var_id']!=0 && $value['var_name']!=''){
     $sql = 'select * from variety_items where branch_id = '.$value['branch_id'].' and variety_id='.$value['var_id'].'';
     $var_qty = $this->db->GetResultsArray($sql);

     $update_var_qty = array();

     $update_var_qty['qty'] = $var_qty[0]['qty']-$value['return_qty'];
     $this->db->mysql_update('variety_items',$update_var_qty,'id='.$var_qty[0]['id']);


    }

   }
   if($value['tbranch_id']!=0){

    $sql = 'select * from items where branch_id = '.$value['tbranch_id'].' and item_id='.$value['item_id'].' and is_deleted="NO"';
    $tbranch_item_qty = $this->db->GetResultsArray($sql);
       if(count($tbranch_item_qty)>0){

       $update_tbranch_qty = array();
        $update_tbranch_qty['qty'] =  $tbranch_item_qty[0]['qty']+$value['return_qty'];

       $this->db->mysql_update('items',$update_tbranch_qty ,'id='.$tbranch_item_qty[0]['id']);


     if($value['var_id']!=0 && $value['var_name']!=''){ 

      $sql = 'select * from variety_items where branch_id = '.$value['tbranch_id'].' and variety_id='.$value['var_id'].'';

      $tbranch_var_qty = $this->db->GetResultsArray($sql);

      if(count($tbranch_var_qty)>0){

       $update_tbranch_var_qty = array();
       $update_tbranch_var_qty['qty'] = $tbranch_var_qty[0]['qty']+$value['return_qty'];

       $this->db->mysql_update('variety_items',$update_tbranch_var_qty,'id='.$tbranch_var_qty[0]['id']); 
      }else{
          $add_var = array();
          $add_var['shop_id'] = $_SESSION['shop_id'];
          $add_var['branch_id'] = $value['tbranch_id'];
          $add_var['item_id'] = $value['item_id'];
          $add_var['variety_id'] = $value['var_id'];
          $add_var['qty'] = $value['return_qty'];


         $this->db->mysql_insert('variety_items',$add_var);

        }

     }     


    }else{
     $add_tbranch_item = array();
     $add_tbranch_item['shop_id'] = $_SESSION['shop_id'];
     $add_tbranch_item['branch_id'] = $value['tbranch_id'];
     $add_tbranch_item['brand'] = $value['brand'];
     $add_tbranch_item['category'] = $value['category'];
     if ($value['sub_category']!='') {
      $add_tbranch_item['sub_category']=$value["sub_category"];
     }else{
      $add_tbranch_item['sub_category']=0;
     }
     $add_tbranch_item['units'] = $value['units'];
     $add_tbranch_item['item_id'] = $value['item_id'];
     $add_tbranch_item['item_name'] = $value['item_name'];
     $add_tbranch_item['item_code'] = $value['item_code'];
     $add_tbranch_item['mrp'] = $value['mrp'];
     $add_tbranch_item['sales_price'] = $value['sales_price'];
     $add_tbranch_item['discount'] = $value['discount'];
     $add_tbranch_item['gst'] = $value['gst'];
     $add_tbranch_item['qty'] = $value['qty'];
     $add_tbranch_item['created_by'] = $_SESSION['uid'];
     $add_tbranch_item['created_at'] = date('Y-m-d H:i:s');

     $this->db->mysql_insert('items',$add_tbranch_item);
     if($value['var_id']!=0 && $value['var_name']!=''){

      $add_tbranch_var = array();
      $add_tbranch_var['shop_id'] = $_SESSION['shop_id'];
      $add_tbranch_var['branch_id'] = $value['tbranch_id'];
      $add_tbranch_var['item_id'] = $value['item_id'];
      $add_tbranch_var['variety_id'] = $value['var_id'];
      $add_tbranch_var['qty'] = $value['return_qty'];


      $this->db->mysql_insert('variety_items',$add_tbranch_var);

     }     

    }

   }else{

      $sql = 'select * from items where branch_id = '.$value['tbranch_id'].' and id='.$value['item_id'].' and is_deleted="NO"';
    $admin_item_qty = $this->db->GetResultsArray($sql);
        if(count($admin_item_qty)>0){
            $update_admin_item_qty = array();
       $update_admin_item_qty['qty'] = $admin_item_qty[0]['qty']+$value['return_qty'];


       $this->db->mysql_update('items',$update_admin_item_qty,'id='.$admin_item_qty[0]['id']);

           if($value['var_id']!=0 && $value['var_name']!=''){ 
              $sql = 'select * from variety_items where branch_id = '.$value['tbranch_id'].' and variety_id='.$value['var_id'].'';

            $admin_var_qty = $this->db->GetResultsArray($sql);
             if(count($admin_var_qty)>0){

       $update_admin_var_qty = array();
       $update_admin_var_qty['qty'] = $admin_var_qty[0]['qty']+$value['return_qty'];

       $this->db->mysql_update('variety_items',$update_admin_var_qty,'id='.$admin_var_qty[0]['id']);      
                  
                 }

           }


        }

   }


  }


  return ['status'=>'success'];  
 }

 public function get_item(){

  $sql = 'select * from '.$this->tablename.' where created_by='.$_SESSION['uid'].' and is_deleted="NO"';
  $result = $this->db->GetResultsArray($sql);
  return $result;

 }

 public function return_qty($id){

  $sql = 'select sum(return_qty)as qty from '.$this->tablename2.' where return_id='.$id.' and is_deleted="NO" group by return_qty';
  $result = $this->db->GetResultsArray($sql);

  return $result;


 }
 public function get_return_details($id){

  $sql = 'select * from '.$this->tablename2.' where return_id = '.$id.' and is_deleted="NO"';
  $result = $this->db->GetResultsArray($sql);


  return $result;





 }







}
?>