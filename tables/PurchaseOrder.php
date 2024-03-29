<?php

class PurchaseOrder extends Dbconnection {
	var $name;
	var $db;
	var $invitee_obj;
	var $msg = '';
	var $tablename = "`purchase_order`";
	var $tablename2 = "`purchase_order_details`";
	var $tablename3 = "`purchase_order_log`";
	var $tablename4 = "`purchase_order_history`";
	var $tablename5 = "`purchase_order_history_details`";
	var $tablename6 = "`purchase_shipping_details`";
	// Create Db Connection for this class operations
	function __construct() {
		parent::__construct();
		$this->db = new Dbconnection();
	}
	public function add_purchase()
	{
    // print_r($_POST);die();

		$item = array();
		$item = $_POST;
		$purchase=array();
		$purchase_log=array();
		$shipping_array=array();
  $shipping = array();

  $sql='select max(purchase_no) as purchase_no from '.$this->tablename.' where shop_id='.$_SESSION['shop_id']." and branch_id=".$_SESSION['branch_id'];
  $result=$this->db->GetResultsArray($sql);
  if ($result[0]['purchase_no']=='' && $result[0]['purchase_no']==0) {
   $purchase_no=1;
  }else{
   $purchase_no=$result[0]['purchase_no']+1;
  }

  $purchase['shop_id']=$_SESSION['shop_id'];
  $purchase['branch_id']=$_SESSION['branch_id'];
  $purchase['purchase_no']=$purchase_no;
  $purchase['vendor_id']=$this->db->getpost('vendor_id');
  $purchase['discount_amt']=$this->db->getpost('discount');
  $purchase['taxable_amt']=$this->db->getpost('taxable_amount');
  $purchase['tax_amt']=$this->db->getpost('tax_amount');
  $purchase['grand_total']=$this->db->getpost('grand_total');
  $purchase['purchase_note']=$this->db->getpost('purchase_note');
  $purchase['created_by']=$_SESSION['uid'];
  $purchase['created_at']=date('Y-m-d H:i:s');
  if ($this->db->getpost('order_type')=='received') {
   $purchase['bill_no']=$this->db->getpost('bill_no');
   $purchase['received_date']=$this->db->getpost('received_date');
   $purchase['paid_amt']=$this->db->getpost('paid_amt');
   $purchase['balance_amt']=$this->db->getpost('balance');
   $purchase['order_type']='RECEIVED';
   $purchase['order_orgin']='RECEIVED';
   if ($this->db->getpost('balance')==0) {
    $purchase['status']='PAID';
   }
  }else{
   $purchase['order_type']='NEW';
   $purchase['order_orgin']='NEW';
  }
  if($this->db->getpost('shipping_id')==0){
   if($this->db->getpost('shipping_id')!='empty' && $_SESSION['type']=='ADMIN'){
    $shipping['name'] = $this->db->getpost('shipping_name');
    $shipping['email']= $this->db->getpost('email');
    $shipping['company_name'] = $this->db->getpost('shipping_company_name');
    $shipping['mobile_no'] = $this->db->getpost('mobile_no');
    $shipping['gst_no'] = $this->db->getpost('ship_gst');
    $shipping['address'] = $this->db->getpost('address');
    $shipping['city'] = $this->db->getpost('city');
    $shipping['state'] = $this->db->getpost('state');
    $shipping['country'] = $this->db->getpost('country');
    $shipping['pincode'] = $this->db->getpost('pincode');
    $shipping['shipping_terms'] = $this->db->getpost('ship_terms');  
    $shipping['method'] = $this->db->getpost('shipping_method');

    $shipping['shop_id'] = $_SESSION['shop_id'];


    $result = $this->db->mysql_insert($this->tablename6,$shipping);

   }
  }
  if ($this->db->getpost('ship_terms')!='') {
   $purchase['shipping_terms']=$this->db->getpost('ship_terms');
  }
  if ($this->db->getpost('shipping_id')!='') {
   $purchase['ship_id']=$this->db->getpost('shipping_id');
  }else{
   $purchase['ship_id']=$result;

  }
  if ($this->db->getpost('shipping_method')!='') {
   $purchase['method']=$this->db->getpost('shipping_method');
  }
  if ($this->db->getpost('shipping_d_date')!='') {
   $purchase['delivery_date']=$this->db->getpost('shipping_d_date');
  }


  $purchase['po_id']=$purchase_id;
  $purchase['shop_id']=$_SESSION['shop_id'];




  $purchase_id = $this->db->mysql_insert($this->tablename, $purchase);

  foreach ($item as $itemvar) {
   if($_SESSION['type']=='ADMIN'){

    $item = $itemvar["mrp"];


   }

   if ((isset($itemvar["item_name"]) && $itemvar["item_name"] !== '') && $item!= 0) {
    if ($itemvar['item_id']==0 && $this->db->getpost('order_type')=='received') {
     $items=array();

     $items['shop_id']=$_SESSION['shop_id'];

     $items['branch_id']=$_SESSION['branch_id'];
     $items['brand']=$itemvar["brand"];
     $items['category']=$itemvar["category"];
     if ($items['sub_category']!='') {
      $items['sub_category']=$itemvar["sub_category"];
     }else{
      $items['sub_category']=0;
     }

     $items['item_name']=$itemvar["item_name"];
     $items['item_code']=$itemvar["item_code"];
     $items['mrp']=$itemvar["mrp"];
     $items['sales_price']=$itemvar["sale_price"];
     $items['discount']=$itemvar["discount"];
     $items['gst']=$itemvar["gst"];
     $items['units']=$itemvar["units"];
     $items['qty']=0;
     $items['created_by']=$_SESSION['uid'];
     $items['created_at']=date('Y-m-d H:i:s');
     $item_insert_id = $this->db->mysql_insert('items', $items);
     $item_id=$item_insert_id;
    }else{
     $item_id=$itemvar['item_id'];
    }
    $purchase_items=array();
    $purchase_items['branch_id']=$_SESSION['branch_id'];
    $purchase_items['shop_id']=$_SESSION['shop_id'];
    $purchase_items['purchase_id']=$purchase_id;
    $purchase_items['item_id']=$item_id;
    $purchase_items['brand']=$itemvar["brand"];
    $purchase_items['units']=$itemvar["units"];
    $purchase_items['category']=$itemvar["category"];
    if ($itemvar['sub_category']!='') {
     $purchase_items['sub_category']=$itemvar["sub_category"];
    }else{
     $purchase_items['sub_category']=0;
    }

    $purchase_items['item_name']=$itemvar["item_name"];
    $purchase_items['item_code']=$itemvar["item_code"];
    $purchase_items['var_id']=$itemvar["varieties_id"];
    $purchase_items['var_name']=$itemvar["varieties_name"];
    $purchase_items['mrp']=$itemvar["mrp"];
    $purchase_items['sales_price']=$itemvar["sale_price"];
    $purchase_items['discount']=$itemvar["discount"];
    $purchase_items['gst']=$itemvar["gst"];
    $purchase_items['qty']=$itemvar["quantity"];
    if ($this->db->getpost('order_type')=='received') {
     $purchase_items['received_qty']=$itemvar["quantity"];
    }
    $purchase_items['taxable_amt']=$itemvar['total']-$itemvar["gstamount"];
    $purchase_items['tax_amt']=$itemvar["gstamount"];
    $purchase_items['total']=$itemvar["total"];
    $purchase_items['created_by']=$_SESSION['uid'];
    $purchase_items['created_at']=date('Y-m-d H:i:s');
    $details_id=$this->db->mysql_insert($this->tablename2, $purchase_items);

    if ($details_id!=0 && $this->db->getpost('order_type')=='received') {
     $sql = 'select * from save_order where branch_id='.$_SESSION['branch_id'].' and status="save"';
     $res = $this->db->GetResultsArray($sql);
     if(count($res)>0){
      $save_order=array();
      $save_order['status']='received';
      $this->db->mysql_update('save_order',$save_order,'id='.$res[0]['id']);
     }



                       	// $item_sql='select * from items where id='.$item_id;
                       	// $item_res=$this->db->GetResultsArray($item_sql);
                       	// $update_item=array();
                       	// $update_item['qty']=$item_res[0]['qty']+$itemvar['quantity'];
                       	// $this->db->mysql_update('items', $update_item,'id='.$item_id);



     if ($itemvar['varieties_id']!=0 && $itemvar['varieties_id']!='') {


      $var_sql='select * from variety_items where  variety_id='.$itemvar['varieties_id'].' and branch_id='.$_SESSION['branch_id'].' and shop_id='.$_SESSION['shop_id'];

      $var_res=$this->db->GetResultsArray($var_sql);


      if (count($var_res)>0) {
       $update_var=array();
       $update_var['qty']=$var_res[0]['qty']+$itemvar['quantity'];

       $this->db->mysql_update('variety_items',$update_var,'id='.$var_res[0]['id']);


       $item_sql = 'select * from items where id='.$itemvar['item_id'].' and branch_id='.$_SESSION['branch_id'].'';
       $item_res=$this->db->GetResultsArray($item_sql);

       $update_item=array();
       $update_item['qty'] = $item_res[0]['qty']+$itemvar['quantity'];

       $this->db->mysql_update('items',$update_item,'id='.$item_res[0]['id']);
      }else{

       $rec_var = array();
       $rec_var['shop_id']=$_SESSION['shop_id'];
       $rec_var['branch_id']=$_SESSION['branch_id'];
       $rec_var['item_id']=$itemvar['item_id'];
       $rec_var['variety_id']=$itemvar['varieties_id'];
       $rec_var['qty']=$itemvar['quantity'];
       $this->db->mysql_insert('variety_items',$rec_var); 

       $item_sql = 'select * from items where id='.$itemvar['item_id'].' and branch_id='.$_SESSION['branch_id'].'';
       $item_res=$this->db->GetResultsArray($item_sql);
       $update_item=array();
       $update_item['qty'] = $item_res[0]['qty']+$itemvar['quantity'];
       $this->db->mysql_update('items',$update_item,'id='.$item_res[0]['id']);

      }
      $update_price ='select * from varieties where id='.$itemvar['varieties_id'].' and branch_id='.$_SESSION['branch_id'];
      $price = $this->db->getAsIsArray($update_price);

      $purchase_price = array();
      $purchase_price['updated_purchase_price']=$itemvar['updated_sale_price'];

      $this->db->mysql_update('varieties',$purchase_price,'id='.$price['id']);
                        // else{

                       	// $update_var=array();
                       	// $update_var['shop_id']=$_SESSION['shop_id'];
                        // $update_var['branch_id']=$_SESSION['branch_id'];
                       	// $update_var['item_id']=$item_id;
                       	// $update_var['variety_id']=$itemvar['varieties_id'];
                       	// $update_var['qty']=$itemvar['enter_qty'];
                       	// $this->db->mysql_insert('variety_items', $update_var);
                        //  }
     }else{


      $item_sql = 'select * from items where id='.$itemvar['item_id'].' and branch_id='.$_SESSION['branch_id'].'';
      $item_res=$this->db->GetResultsArray($item_sql);

      $update_item=array();
      $update_item['qty'] = $item_res[0]['qty']+$itemvar['quantity'];

      $this->db->mysql_update('items',$update_item,'id='.$item_res[0]['id']);


      $update_price ='select * from items where id='.$itemvar['item_id'].' and branch_id='.$_SESSION['branch_id'];
      $price = $this->db->getAsIsArray($update_price);

      $purchase_price = array();
      $purchase_price['updated_purchase_price']=$itemvar['updated_sale_price'];

      $this->db->mysql_update('items',$purchase_price,'id='.$price['id']);


     }
    }

                // mrp and sale price update
            // if($_SESSION['type']!='ADMIN'){           
            //   if($itemvar['varieties_id']!=0 && $itemvar['varieties_id']!='' && $itemvar['varieties_name']!=''){
            //     $sql = 'select * from varieties where branch_id=0 and id='.$itemvar['varieties_id'].' and is_deleted="NO"';
            //      $res =  $this->db->GetResultsArray($sql);
            //               $price_update = array();
            //         $price_update['mrp'] = $itemvar['mrp'];
            //         $price_update['sale_price'] = $itemvar['sale_price'];
            //       $this->db->mysql_update('varieties',$price_update,'id='.$itemvar['varieties_id']);

            //   }else{
            //          $price_update = array();
            //         $price_update['mrp'] = $itemvar['mrp'];
            //         $price_update['sales_price'] = $itemvar['sale_price'];
            //       $this->db->mysql_update('items',$price_update,'id='.$itemvar['item_id']);

            //   }

            // }

   }
  }
  if ($this->db->getpost('paid_amt')!='' && $this->db->getpost('paid_amt')!=0) {
   $purchase_log['shop_id']=$_SESSION['shop_id'];
   $purchase_log['branch_id']=$_SESSION['branch_id'];
   $purchase_log['purchase_id']=$purchase_id;
   $purchase_log['credit']=$this->db->getpost('paid_amt');
   $purchase_log['payment_mode']=$this->db->getpost('payment_mode');
   $purchase_log['description']='Balance Collection';
   $purchase_log['created_by']=$_SESSION['uid'];
   $purchase_log['created_at']=date('Y-m-d H:i:s');
   $this->db->mysql_insert($this->tablename3, $purchase_log);
  }




  return ['status'=>'success'];

 }
 public function add_new_purchase()
 {
  $item = array();
  $item = $_POST;
  $branch_sale = array();
  $purchase=array();
  $purchase_log=array();
  $purchase_id=$this->db->getpost('po_id');
  $purchase_sql='select * from '.$this->tablename.' where id='.$purchase_id.' and branch_id='.$_SESSION['branch_id'].'';

  $purchase_res=$this->db->GetResultsArray($purchase_sql);

    // print_r($purchase_res);die();

  $purchase['shop_id']=$_SESSION['shop_id'];
  $purchase['branch_id']=$_SESSION['branch_id'];
  $purchase['po_id']=$this->db->getpost('po_id');
  $purchase['discount_amt']=$this->db->getpost('discount');
  $purchase['taxable_amt']=$this->db->getpost('taxable_amount');
  $purchase['tax_amt']=$this->db->getpost('tax_amount');
  $purchase['grand_total']=$this->db->getpost('grand_total');
  $purchase['created_by']=$_SESSION['uid'];
  $purchase['created_at']=date('Y-m-d H:i:s');
  $purchase['bill_no']=$this->db->getpost('bill_no');
  if($_SESSION['type']=='ADMIN'){
   $purchase['received_date']=$this->db->getpost('received_date');
  }else{

   $purchase['received_date'] = date("Y-m-d");  
  }
  $purchase['paid_amt']=$this->db->getpost('paid_amt');
  $purchase['balance_amt']=$this->db->getpost('balance');




  $main_purchase_id= $this->db->mysql_insert($this->tablename4, $purchase);
  foreach ($item as $itemvar) {
   if($_SESSION['type']=='ADMIN'){

    $item = $itemvar["mrp"];


   }

   if ((isset($itemvar["item_name"]) && $itemvar["item_name"] !== '') && $item!= 0 ) {
    if ($itemvar['item_id']==0) {

     $items=array();
     $items['shop_id']=$_SESSION['shop_id'];
     $items['branch_id']=$_SESSION['branch_id'];
     $items['brand']=$itemvar["brand"];
     $items['category']=$itemvar["category"];
     if ($items['sub_category']!='') {
      $items['sub_category']=$itemvar["sub_category"];
     }else{
      $items['sub_category']=0;
     }

     $items['item_name']=$itemvar["item_name"];
     $items['item_code']=$itemvar["item_code"];
     $items['mrp']=$itemvar["mrp"];
     $items['sales_price']=$itemvar["sale_price"];
     $items['updated_purchase_price'] =$itemvar["updated_sale_price"];
     $items['discount']=$itemvar["discount"];
     $items['gst']=$itemvar["gst"];
     $items['units']=$itemvar["units"];
     $items['qty']=0;
     $items['created_by']=$_SESSION['uid'];
     $items['created_at']=date('Y-m-d H:i:s');
     $item_insert_id = $this->db->mysql_insert('items', $items);

     $item_id=$item_insert_id;
    }else{
     $item_id=$itemvar['item_id'];
    }      

                // price_update
    if($_SESSION['type']=='ADMIN'){
     if($itemvar['varieties_id']!='' && $itemvar['varieties_id']!=0){

      $update_price = array();
      $update_price['updated_purchase_price']=$itemvar['update_sale_price'];
      $this->db->mysql_update('varieties',$update_price,'id='.$itemvar['varieties_id']);

     }else{

      $update_price = array();
      $update_price['updated_purchase_price']=$itemvar['update_sale_price'];
      $this->db->mysql_update('items',$update_price,'id='.$itemvar['item_id']);

     }





    }



    if($_SESSION['type']!="ADMIN"){



     $sql ='select * from items where branch_id='.$_SESSION['branch_id'].' and item_code="'.$itemvar['item_code'].'"';
     $res  = $this->db->GetResultsArray($sql);



     $items=array();
     $items['shop_id']=$_SESSION['shop_id'];
     $items['branch_id']=$_SESSION['branch_id'];
     $items['brand']=$itemvar["brand"];
     $items['category']=$itemvar["category"];
     if ($items['sub_category']!='') {
      $items['sub_category']=$itemvar["sub_category"];
     }else{
      $items['sub_category']=0;
     }

     $items['item_name']=$itemvar["item_name"];
     $items['item_id']=$itemvar["item_id"];
     $items['item_code']=$itemvar["item_code"];
     $items['mrp']=$itemvar["mrp"];
                       // $items['sales_price']=$itemvar["sale_price"];
     $items['discount']=$itemvar["discount"];
     $items['gst']=$itemvar["gst"];
     $items['units']=$itemvar["units"];
     if($res[0]['item_code']==""){

      $items['qty']= $itemvar['enter_qty'];
     }else{

      $items['qty'] = $res[0]['qty']+$itemvar['enter_qty'];

     }

                       // $items['qty']=$itemvar['enter_qty'];
     $items['created_by']=$_SESSION['uid'];
     $items['created_at']=date('Y-m-d H:i:s');


     if($res[0]['item_code']==""){

      $id = $this->db->mysql_insert('items', $items);


     }

     else{

      $this->db->mysql_update('items',$items,'id='.$res[0]['id']);

     }



     if($itemvar['varieties_id']!=0 && $itemvar['varieties_id']!=''){
      $sql = 'select * from varieties where branch_id='.$_SESSION['branch_id'].' and variety_id='.$itemvar['varieties_id'].'';

      $var = $this->db->GetResultsArray($sql);


      $varieties = array();
      $varieties['branch_id'] = $_SESSION['branch_id'];
      $varieties['item_id'] = $itemvar['item_id'];
      $varieties['variety_id'] = $itemvar['varieties_id'];
      $varieties['name'] = strtolower($itemvar['varieties_name']);



      if($var[0]['variety_id']!=''){
       $this->db->mysql_update('varieties',$varieties,'id='.$var[0]['id']);
      }else{

       $this->db->mysql_insert('varieties',$varieties);
      }

     }
      // price_update




     if($itemvar['varieties_id']!='' && $itemvar['varieties_id']!=0){

      $sql = 'select * from branch_sale_items where po_id='.$this->db->getpost('po_id').' and branch_id='.$_SESSION['branch_id'].' and var_id='.$itemvar['varieties_id'].' order by Id DESC limit 1';
      $res = $this->db->getAsIsArray($sql);

      $sql1 = 'select * from varieties where branch_id='.$_SESSION['branch_id'].' and variety_id='.$itemvar['varieties_id'].'';
      $result = $this->db->getAsIsArray($sql1);


      $update_price = array();
      $update_price['updated_purchase_price']=$res['sale_price'];
      $update_price['mrp']=$res['mrp'];
      $this->db->mysql_update('varieties',$update_price,'id='.$result['id']);


     }else{
      $sql = 'select * from branch_sale_items where po_id='.$this->db->getpost('po_id').' and branch_id='.$_SESSION['branch_id'].' and item_id='.$itemvar['item_id'].' order by Id DESC limit 1';
      $res = $this->db->getAsIsArray($sql);


      $sql1 = 'select * from items where branch_id='.$_SESSION['branch_id'].' and item_id='.$itemvar['item_id'].'';
      $result = $this->db->getAsIsArray($sql1);

      $update_price = array();
      $update_price['updated_purchase_price']=$res['sale_price'];
      $update_price['mrp']=$res['mrp'];
      $this->db->mysql_update('items',$update_price,'id='.$result['id']);

     }


              // price_update completed



    }


    $purchase_items=array();
    $purchase_items['item_id']=$item_id;
    $purchase_items['received_qty']=$itemvar["rec_qty"]+$itemvar['enter_qty'];
    $details_id=$this->db->mysql_update($this->tablename2, $purchase_items,'id='.$itemvar['po_id']);

    $purchase__history_items=array();
    $purchase__history_items['shop_id']=$_SESSION['shop_id'];
    $purchase__history_items['branch_id']=$_SESSION['branch_id'];

    $purchase__history_items['purchase_id']=$this->db->getpost('po_id');
                       // $purchase__history_items['purchase_id']=$main_purchase_id;
    $purchase__history_items['item_id']=$item_id;
    $purchase__history_items['brand']=$itemvar["brand"];
    $purchase__history_items['units']=$itemvar["units"];
    $purchase__history_items['var_id']=$itemvar["varieties_id"];
    $purchase__history_items['var_name']=$itemvar["varieties_name"];
    $purchase__history_items['category']=$itemvar["category"];
    if ($itemvar['sub_category']!='') {
     $purchase__history_items['sub_category']=$itemvar["sub_category"];
    }else{
     $purchase__history_items['sub_category']=0;
    }

    $purchase__history_items['item_name']=$itemvar["item_name"];
    $purchase__history_items['item_code']=$itemvar["item_code"];
    $purchase__history_items['update_sale_price'] = $itemvar["update_sale_price"];
    $purchase__history_items['mrp']=$itemvar["mrp"];
    $purchase__history_items['sales_price']=$itemvar["sale_price"];

    $purchase__history_items['discount']=$itemvar["discount"];
    $purchase__history_items['gst']=$itemvar["gst"];
    $purchase__history_items['qty']=$itemvar["enter_qty"];
    $purchase__history_items['received_qty']=$itemvar["rec_qty"];
    if ($this->db->getpost('order_type')=='received') {
     $purchase__history_items['received_qty']=$itemvar["quantity"];
    }
    $purchase__history_items['taxable_amt']=$itemvar['total']-$itemvar["gstamount"];
    $purchase__history_items['tax_amt']=$itemvar["gstamount"];
    $purchase__history_items['total']=$itemvar["total"];
    $purchase__history_items['created_by']=$_SESSION['uid'];
    $purchase__history_items['created_at']=date('Y-m-d H:i:s');
    $this->db->mysql_insert($this->tablename5, $purchase__history_items);

    if ($details_id!=0) {
     $item_sql='select * from items where id='.$item_id;
     $item_res=$this->db->GetResultsArray($item_sql);
     $update_item=array();
     $update_item['qty']=$item_res[0]['qty']+$itemvar['enter_qty'];

     if($_SESSION['type']=="ADMIN"){
      $this->db->mysql_update('items', $update_item,'id='.$item_id);

     }

     if ($itemvar['varieties_id']!=0 && $itemvar['varieties_id']!='') {
      $var_sql='select * from variety_items where item_id='.$item_id.' and variety_id='.$itemvar['varieties_id'].' and branch_id='.$_SESSION['branch_id'];
      $var_res=$this->db->GetResultsArray($var_sql);

                        // print_r($var_res);die();
      if (count($var_res)>0) {

       $update_var=array();
       $update_var['qty']=$var_res[0]['qty']+$itemvar['enter_qty'];
       $this->db->mysql_update('variety_items', $update_var,'id='.$var_res[0]['id']);


      }else{
       $update_var=array();
       $update_var['branch_id']= $_SESSION['branch_id'];
       $update_var['shop_id']=$_SESSION['shop_id'];
       $update_var['item_id']=$item_id;
       $update_var['variety_id']=$itemvar['varieties_id'];
       $update_var['qty']=$itemvar['enter_qty'];
       $id = $this->db->mysql_insert('variety_items', $update_var);

      }
                        //   if($_SESSION['type']!="ADMIN"){

                        //     $sql = 'select * from variety_items where id = '.$itemvar['varieties_id'].' and branch_id='.$_SESSION['branch_id'].'' ;
                        //     $var_id = $this->db->GetResultsArray($sql);

                        //          if($var_id[0]['branch_id']>0){
                        //            $update_var=array();

                        //         $update_var['qty']=$var_id[0]['qty']+$itemvar['enter_qty'];
                        //          $this->db->mysql_update('variety_items', $update_var,'id='.$var_id[0]['id']);


                        //          }else{

                        //   $update_var=array();
                        //   $update_var['branch_id']= $_SESSION['branch_id'];
                        // $update_var['shop_id']=$_SESSION['shop_id'];
                        // $update_var['item_id']=$item_id;
                        // $update_var['variety_id']=$itemvar['varieties_id'];
                        // $update_var['qty']=$itemvar['enter_qty'];
                        //  $this->db->mysql_insert('variety_items',$update_var);


                        //          }



                        //  }

     }


    }


   }
  }
  if ($this->db->getpost('paid_amt')!='' && $this->db->getpost('paid_amt')!=0) {
   $purchase_log['branch_id']=$_SESSION['branch_id'];
   $purchase_log['purchase_id']=$purchase_id;
   $purchase_log['credit']=$this->db->getpost('paid_amt');
   $purchase_log['payment_mode']=$this->db->getpost('payment_mode');
   $purchase_log['description']='Balance Collection';
   $purchase_log['created_by']=$_SESSION['uid'];
   $purchase_log['created_at']=date('Y-m-d H:i:s');
   $this->db->mysql_insert($this->tablename3, $purchase_log);
  }
  $item_check_sql	= "select sum(qty)as qty,sum(received_qty)as received_qty from ".$this->tablename2." where purchase_id=".$purchase_id." and branch_id=".$_SESSION['branch_id']."";
  $item_check_res=$this->db->GetResultsArray($item_check_sql);
  $total = $item_check_res[0]['qty']-$item_check_res[0]['received_qty'];
  if($total==0){
   $purchase_update=array();
   $purchase_update['order_type']='RECEIVED';
   $this->db->mysql_update($this->tablename, $purchase_update,'id='.$purchase_id);

  }else{
   $purchase_update=array();
   $purchase_update['order_type']='PARTIAL COMPLETE';
   $this->db->mysql_update($this->tablename, $purchase_update,'id='.$purchase_id);

  }


		// if (count($item_check_res) > 0) {
		// 	$purchase_update=array();
		// 	$purchase_update['order_type']='RECEIVED';
		// $this->db->mysql_update($this->tablename, $purchase_update,'id='.$purchase_id);
		// }else{
		// 	$purchase_update=array();
		// 	$purchase_update['order_type']='PARTIAL COMPLETE';
		// $this->db->mysql_update($this->tablename, $purchase_update,'id='.$purchase_id);
		// }

  $history_sql='select bill_no,received_date,sum(taxable_amt) as taxable,sum(tax_amt) as tax,sum(discount_amt) as discount,sum(grand_total) as total from '.$this->tablename4.' where po_id='.$purchase_id.' and branch_id='.$_SESSION['branch_id'].' group by po_id order by id asc';
  $history_res=$this->db->GetResultsArray($history_sql);

  $log_sql='select sum(credit) as credit from '.$this->tablename3.' where purchase_id='.$purchase_id.' group by purchase_id order by id asc';
  $log_res=$this->db->GetResultsArray($log_sql);
  if (count($history_res)>0) {
   $purchase_update=array();
   $purchase_update['bill_no']=$history_res[0]['bill_no'];
   $purchase_update['received_date']=$history_res[0]['received_date'];
   $purchase_update['taxable_amt']=$history_res[0]['taxable'];
   $purchase_update['tax_amt']=$history_res[0]['tax'];
   $purchase_update['discount_amt']=$history_res[0]['discount'];
   $purchase_update['grand_total']=$history_res[0]['total'];
   $purchase_update['paid_amt']=$log_res[0]['credit'];
   $purchase_update['balance_amt']=$history_res[0]['total']-$log_res[0]['credit'];
      // print_r($purchase_update['balance_amt']);die();
   if($purchase_update['balance_amt']==0){

    $purchase_update['status']="PAID";

   }else{

    $purchase_update['status']="PENDING";

   }

   $this->db->mysql_update($this->tablename, $purchase_update,'id='.$purchase_id);



   if($_SESSION['type']!='ADMIN'){



    $branch_sale = array();

    $sql = 'select * from branch_sale where po_id = '.$this->db->getpost('po_id').' and branch_id='.$_SESSION['branch_id'].' and status!="PAID"';
    $total_paid_amt=$this->db->getpost('paid_amt');
    
    $result = $this->db->GetResultsArray($sql);
    foreach ($result as $key => $value) {
     if ($total_paid_amt > 0) {
      $branch_sale['paid_amt'] = $value['paid_amt']+$total_paid_amt;
      $branch_sale['balance_amt'] = $value['balance_amt']-$total_paid_amt;

      if($branch_sale['balance_amt']==0){

       $branch_sale['status']="PAID";



      }else{

       $branch_sale['status']="PENDING";

      }

      $branch_sale_update = $this->db->mysql_update('branch_sale',$branch_sale,'id='.$value['id']);
      $total_paid_amt=$total_paid_amt-$value['balance_amt'];
     }

    }
   }


  }

  return ['status'=>'success'];

 }


 public function edit_purchase_order()
 {

// print_r($_POST);die();
  $item = array();
  $item = $_POST;
  $purchase=array();
  $purchase_log=array();


		// $purchase['purchase_no']=$this->db->getpost('po_id');
  $purchase['discount_amt']=$this->db->getpost('discount');
  $purchase['taxable_amt']=$this->db->getpost('taxable_amount');
  $purchase['tax_amt']=$this->db->getpost('tax_amount');
  $purchase['grand_total']=$this->db->getpost('grand_total');
  $purchase['purchase_note']=$this->db->getpost('note');
  $purchase['ship_id']=$this->db->getpost('shipping_id');
  $purchase['shipping_terms']=$this->db->getpost('ship_terms');
  $purchase['method']=$this->db->getpost('shipping_method');
  $purchase['delivery_date']=$this->db->getpost('shipping_d_date');


  $purchase_id = $this->db->mysql_update($this->tablename, $purchase, 'id='.$this->db->getpost('po_id'));

  foreach ($item as $itemvar) {

   if ((isset($itemvar["item_name"]) && $itemvar["item_name"] !== '') && $itemvar["mrp"] != 0) {
    if ($itemvar['item_id']==0 && $this->db->getpost('order_type')=='received') {
     $items=array();
     $items['shop_id']=$_SESSION['shop_id'];
     $items['brand']=$itemvar["brand"];
     $items['category']=$itemvar["category"];
     if ($items['sub_category']!='') {
      $items['sub_category']=$itemvar["sub_category"];
     }else{
      $items['sub_category']=0;
     }

     $items['item_name']=$itemvar["item_name"];
     $items['item_code']=$itemvar["item_code"];
     $items['mrp']=$itemvar["mrp"];
     $items['sales_price']=$itemvar["sale_price"];
     $items['discount']=$itemvar["discount"];
     $items['gst']=$itemvar["gst"];
     $items['units']=$itemvar["units"];
     $items['qty']=0;
     $items['created_by']=$_SESSION['uid'];
     $items['created_at']=date('Y-m-d H:i:s');
     $item_insert_id = $this->db->mysql_insert('items', $items);
     $item_id=$item_insert_id;
    }else{
     $item_id=$itemvar['item_id'];
    }
    $purchase_items=array();
    $purchase_items['shop_id']=$_SESSION['shop_id'];
    $purchase_items['purchase_id']=$this->db->getpost('po_id');
    $purchase_items['item_id']=$item_id;
    $purchase_items['brand']=$itemvar["brand"];
    $purchase_items['units']=$itemvar["units"];
    $purchase_items['category']=$itemvar["category"];
    if ($itemvar['sub_category']!='') {
     $purchase_items['sub_category']=$itemvar["sub_category"];
    }else{
     $purchase_items['sub_category']=0;
    }

    $purchase_items['item_name']=$itemvar["item_name"];
    $purchase_items['item_code']=$itemvar["item_code"];
    $purchase_items['var_id']=$itemvar["varieties_id"];
    $purchase_items['var_name']=$itemvar["varieties_name"];
    $purchase_items['mrp']=$itemvar["mrp"];
    $purchase_items['sales_price']=$itemvar["sale_price"];
    $purchase_items['discount']=$itemvar["discount"];
    $purchase_items['gst']=$itemvar["gst"];
    $purchase_items['qty']=$itemvar["enter_qty"];
    if ($this->db->getpost('order_type')=='received') {
     $purchase_items['received_qty']=$itemvar["enter_qty"];
    }
    $purchase_items['taxable_amt']=$itemvar['total']-$itemvar["gstamount"];
    $purchase_items['tax_amt']=$itemvar["gstamount"];
    $purchase_items['total']=$itemvar["total"];
    $purchase_items['created_by']=$_SESSION['uid'];
    $purchase_items['created_at']=date('Y-m-d H:i:s');
    $purchase_items['branch_id']=$_SESSION['branch_id'];

    if($itemvar['flag']=='new' && $itemvar['deleted']=='no')
    {

     $details_id=$this->db->mysql_insert($this->tablename2, $purchase_items);

    }
    else if($itemvar['flag']=='old' && $itemvar['deleted']=='no')
    {

     $sql=$this->db->mysql_update($this->tablename2,$purchase_items,'id='.$itemvar['main_id']);

    }
    else if($itemvar['deleted']=='yes')
    {

     $del = "delete from ".$this->tablename2." where id='".$itemvar['main_id']."'";
     $this->db->ExecuteQuery($del);

    }


   }

  }


  return ['status'=>'success'];



 }


 public function pay_purchase_order()
 {
		// print_r($_POST);die();
  $sql='select * from '.$this->tablename.' where shop_id='.$_SESSION['shop_id'].' and id='.$this->db->getpost('po_id');
  $result=$this->db->GetResultsArray($sql);

    // print_r($result);die($result);
  $purchase=array();
  $purchase['paid_amt']=$result[0]['paid_amt']+$this->db->getpost('paid_amt');
  $purchase['balance_amt']=$this->db->getpost('balance');
  $purchase['created_by']=$_SESSION['uid'];
  $purchase['created_at']=date('Y-m-d H:i:s');
  if ($this->db->getpost('balance')==0) {
   $purchase['status']='PAID';
  }

  $this->db->mysql_update($this->tablename, $purchase,'id='.$this->db->getpost('po_id'));


  // if($_SESSION['type']!='ADMIN'){
  //      $branch_status = array();
  //      if ($this->db->getpost('balance')==0) {
  //   $branch_status['status']='PAID';
  //     $this->db->mysql_update('branch_sale',$branch_status,'po_id='.$this->db->getpost('po_id'));
  //   }

  //   }



  $purchase_log=array();
  $purchase_log['shop_id']=$_SESSION['shop_id'];
  $purchase_log['branch_id']=$_SESSION['branch_id'];
  $purchase_log['purchase_id']=$this->db->getpost('po_id');
  $purchase_log['credit']=$this->db->getpost('paid_amt');
  $purchase_log['payment_mode']=$this->db->getpost('payment_mode');
  $purchase_log['description']='Balance Collection';
  $purchase_log['created_by']=$_SESSION['uid'];
  $purchase_log['created_at']=date('Y-m-d H:i:s');
  $this->db->mysql_insert($this->tablename3, $purchase_log);

  return ['status'=>'success'];
 }
 public function get_purchase_orders()
 {


  if ($this->db->getpost('type')=='RECEIVED') {
   $sql='select * from '.$this->tablename.' where is_deleted="NO" and order_type="RECEIVED" and branch_id='.$_SESSION['branch_id'].' ORDER BY id DESC';
  }else{
   $sql='select * from '.$this->tablename.' where is_deleted="NO" and order_type!="RECEIVED" and branch_id='.$_SESSION['branch_id'].' ORDER BY id DESC';

  }


  $result=$this->db->GetResultsArray($sql);
  // print_r($result);die();
  return $result;

 }
 public function get_purchase_order($id)
 {
  $sql='select * from '.$this->tablename.' where id='.$id.' and branch_id='.$_SESSION['branch_id'].' and is_deleted="NO"';
  $result=$this->db->GetResultsArray($sql);
  return $result;
 }
 public function get_purchase_order_item($id)
 {
  $sql='select * from '.$this->tablename2.' where purchase_id='.$id.' and branch_id='.$_SESSION['branch_id'].'';
  $result=$this->db->GetResultsArray($sql);
  return $result;
 }
 public function get_purchase_order_log($id)
 {
  $sql='select * from '.$this->tablename3.' where purchase_id='.$id.'';
  $result=$this->db->GetResultsArray($sql);
  return $result;
 }
 public function get_purchase_order_history($id)
 {
  $sql='select * from '.$this->tablename4.' where po_id='.$id.'';
  $result=$this->db->GetResultsArray($sql);
  return $result;
 }
 public function get_purchase_order_shipping($id)
 {
  $sql='select * from '.$this->tablename6.' where id='.$id.'';
  $result=$this->db->GetResultsArray($sql);
  return $result;
 }



 public function get_purchase_list(){


  $sql='select * from '.$this->tablename.' where is_deleted="NO" and order_type!="NEW" and status="PENDING" and branch_id='.$_SESSION['branch_id'].'';
  $result=$this->db->GetResultsArray($sql);
  return $result;

 }

 public function get_shipping_details(){

  $sql = 'select * from '.$this->tablename6.' where is_delete="NO"';

  $result = $this->db->GetResultsArray($sql);

  return $result;
 }

 public function get_Autocomplete_shipping(){

  $sql = "select * from ".$this->tablename6."where (name like'%".$this->db->getpost('term')."%') and shop_id = ".$_SESSION['shop_id']."";

  $result = $this->db->GetResultsArray($sql);
  return $result;

 }
 public function shipping_deleted($id){

  $delete = array();
  $delete['is_delete'] = 'YES';

  $result = $this->db->mysql_update($this->tablename6,$delete,'id='.$id);
  if($result){

   return ['status'=>'success'];

  }else{

   return ['status'=>'failed'];

  }




 }
 public function get_shipping($id){

  $sql = 'select * from '.$this->tablename6.' where id= '.$id;
  $result = $this->db->GetResultsArray($sql);
  return $result;

 }
 public function get_stock($id){

  $sql ='select id,purchase_id,item_id,item_name,sum(received_qty) as qty from '.$this->tablename2.'where item_id='.$id.' and branch_id='.$_SESSION['branch_id'].' group by item_id';

  $result = $this->db->GetResultsArray($sql);

// print_r($result);die();
  return $result;

 }
 public function get_vendor_name($pid){

  $sql = 'select * from '.$this->tablename.' where id ='.$pid.' and branch_id='.$_SESSION['branch_id'].' ';
  $result = $this->db->GetResultsArray($sql);
// print_r($result);die();

  return $result;

 }
 public function vendor_variety_details($id){

  $sql = 'select a.bill_no,a.vendor_id,a.id,b.item_name,b.purchase_id,b.var_id,b.var_name,b.item_code,b.mrp,b.sales_price,b.received_qty,c.name,d.name from purchase_order a  join purchase_order_details b on a.id=b.purchase_id join varieties c on b.var_id=c.id join vendors d on a.vendor_id=d.id  where b.item_id ='.$id.' and a.bill_no!="" and a.branch_id='.$_SESSION['branch_id'].'';
  $result = $this->db->GetResultsArray($sql);



  return $result;


 }
 public function vendor_details_novariety($item_id){

  $sql = 'select a.*,b.*,c.* from purchase_order a join purchase_order_details b on a.id=b.purchase_id join vendors c on a.vendor_id=c.id where b.item_id='.$item_id.' and a.bill_no!="" and a.branch_id='.$_SESSION['branch_id'].'';

  $result= $this->db->GetResultsArray($sql);
  return $result;


 }
 public function get_shipping_edit($id){

  $sql = 'select * from '.$this->tablename6.' where id= '.$id;
  $result = $this->db->GetResultsArray($sql);
  return $result;

 }
 public function add_shipping(){

  $shipping = array();
  $shipping['po_id'] = $this->db->getpost('po_id');
  $shipping['name'] = $this->db->getpost('shipping_name');
  $shipping['email']= $this->db->getpost('email');
  $shipping['company_name'] = $this->db->getpost('shipping_company_name');
  $shipping['mobile_no'] = $this->db->getpost('mobile_no');
  $shipping['gst_no'] = $this->db->getpost('ship_gst');
  $shipping['address'] = $this->db->getpost('address');
  $shipping['city'] = $this->db->getpost('city');
  $shipping['state'] = $this->db->getpost('state');
  $shipping['country'] = $this->db->getpost('country');
  $shipping['pincode'] = $this->db->getpost('pincode');
  $shipping['shipping_terms'] = $this->db->getpost('ship_terms');  
  $shipping['method'] = $this->db->getpost('shipping_method');
  $shipping['delivery_date'] = $this->db->getpost('shipping_d_date');
  $shipping['shop_id'] = $_SESSION['shop_id'];
  if($this->db->getpost('id')== ""){



   $result = $this->db->mysql_insert($this->tablename6,$shipping);

  }else{

   $result = $this->db->mysql_update($this->tablename6,$shipping,'id='.$this->db->getpost('id'));

  }

  if($result){

   return ['status'=>'success'];

  }else{

   return ['status'=>'failed'];
  }
  

 }

 public function insert_shipping(){

  $shipping['name'] = $this->db->getpost('shipping_name');
  $shipping['email']= $this->db->getpost('email');
  $shipping['company_name'] = $this->db->getpost('shipping_company_name');
  $shipping['mobile_no'] = $this->db->getpost('mobile_no');
  $shipping['gst_no'] = $this->db->getpost('ship_gst');
  $shipping['address'] = $this->db->getpost('address');
  $shipping['city'] = $this->db->getpost('city');
  $shipping['state'] = $this->db->getpost('state');
  $shipping['country'] = $this->db->getpost('country');
  $shipping['pincode'] = $this->db->getpost('pincode');
  $shipping['shipping_terms'] = $this->db->getpost('ship_terms');  
  $shipping['method'] = $this->db->getpost('shipping_method');

  $shipping['shop_id'] = $_SESSION['shop_id'];


  $result = $this->db->mysql_insert($this->tablename6,$shipping);

  if($result){

   return ['status'=>'success'];

  }else{

   return ['status'=>'failed'];
  }



 }

 public function get_order(){

  $sql = 'select * from '.$this->tablename.' where branch_id!="0" and vendor_id=0 and order_type!="RECEIVED" and is_deleted="NO" ORDER BY id DESC';

  $result = $this->db->GetResultsArray($sql);


  return $result;

 }

 public function branch_name($id){

  $sql = 'select sum(a.qty) as qty ,b.branch_code,b.name from purchase_order_details a join shop_profile b on a.branch_id=b.branch_id where a.purchase_id='.$id.' and a.is_deleted="NO"';
  $result = $this->db->GetResultsArray($sql);


  return $result;
 }

 public function order_details($id,$b_id){

  $sql = 'select * from '.$this->tablename2.' where purchase_id="'.$id.'" and branch_id="'.$b_id.'" and is_deleted="NO" ';

  $result = $this->db->GetResultsArray($sql);
// print_r($result);die();

  return $result;


 }

 public function branch_code($id){

  $sql = 'select * from shop_profile where branch_id="'.$id.'" and status="ENABLED" ';

  $result = $this->db->GetResultsArray($sql);

  return $result;
 }

 public function get_discount($id){

  $sql = 'select * from '.$this->tablename.' where id="'.$id.'" and is_deleted="NO" and order_type="NEW" ';

  $result = $this->db->GetResultsArray($sql);

  return $result;

 }
 public function get_purchase_no($id,$b_id){

  $sql = 'select * from '.$this->tablename.' where id="'.$id.'" and branch_id = "'.$b_id.'" and is_deleted="NO"';

  $result = $this->db->GetResultsArray($sql);

  return $result;

 }

 public function get_details($id,$b_id){

  $sql = 'select * from '.$this->tablename.' where id="'.$id.'" and branch_id="'.$b_id.'" and  is_deleted="NO"';

  $result = $this->db->GetResultsArray($sql);


  return $result;

 }

 public function get_branch_order($id,$b_id){

  $sql = 'select * from '.$this->tablename2.' where purchase_id="'.$id.'" and branch_id="'.$b_id.'" and is_deleted="NO"';

  $result = $this->db->GetResultsArray($sql);
  return $result;

 }

 public function get_payment_log($po,$b_id){

  $sql = 'select * from '.$this->tablename3.' where purchase_id="'.$po.'" and branch_id="'.$b_id.'"';

  $result = $this->db->GetResultsArray($sql);

  return $result;

 }
 public function get_item_qty($po){
  $sql = 'select sum(qty) as qty,sum(received_qty) as received_qty from '.$this->tablename2.' where purchase_id="'.$po.'" and branch_id="'.$_SESSION['branch_id'].'"';

  $result = $this->db->GetResultsArray($sql);


  return $result;

 }
 public function get_received_dt(){
  $sql = 'select * from '.$this->tablename.' where branch_id!=0 and order_type="RECEIVED" and is_deleted="NO"';
  $result = $this->db->GetResultsArray($sql);
// print_r($result);die();

  return $result;


 }
 public function get_order_dt($id,$b_id){
  $sql = 'select sum(qty) as qty,sum(received_qty) as received_qty from '.$this->tablename2.' where purchase_id='.$id.' and branch_id='.$b_id.' and is_deleted="NO" group by purchase_id';
  $result = $this->db->GetResultsArray($sql);

  return $result;

 }
 public function get_total($id,$b_id){


  $sql = 'select * from '.$this->tablename.' where id='.$id.' and is_deleted="NO" and branch_id='.$b_id.'';
  $result = $this->db->getAsIsArray($sql);
// print_r($result);

  return $result;


 }
 public function updated_sale_price($p_id,$item_id,$var_id){

  $sql = 'select * from '.$this->tablename5.' where purchase_id="'.$p_id.'" and branch_id="'.$_SESSION['branch_id'].'" and var_id="'.$var_id.'" and item_id="'.$item_id.'" and is_deleted="NO"';
  $result = $this->db->getAsIsArray($sql);
  return $result;

 }
 public function request_order(){
  // $date = date('Y-m-d');
  // $filter_date = date('Y-m-d',strtotime('-5 days'));
$filter_date = date('Y-m-d');
   $sql = "select * from ".$this->tablename." where branch_id!='".$_SESSION['branch_id']."' and is_deleted='NO' and date(created_at)<='".$filter_date."' and order_type='NEW'";
  $result = $this->db->GetResultsArray($sql);
  return $result;


 }
 public function get_sale_order($id){

  $sql = "select * from branch_sale where branch_id!='".$_SESSION['branch_id']."' and po_id='".$id."'" ;

  $result = $this->db->GetResultsArray($sql);
  


  return $result;
 }
 public function get_request_order($po_id){
  $filter_date = date('Y-m-d',strtotime('-5 days'));

  $sql = "select a.*,b.* from purchase_order a left join branch_sale b on a.id = b.po_id where a.id='".$po_id."' and a.branch_id!='".$_SESSION['branch_id']."' and date(a.created_at)<='".$filter_date."' and a.is_deleted='NO' and order_type='NEW'";
  $result = $this->db->GetResultsArray($sql);

  return $result;
 }
 public function get_product_total($id,$item_id,$count,$var_id){


   $sql = 'select * from '.$this->tablename5.' where purchase_id='.$id.' and branch_id='.$_SESSION['branch_id'].' and item_id='.$item_id.' and is_deleted="NO" and var_id='.$var_id.' ORDER BY id DESC LIMIT 1 ';
  $result = $this->db->GetResultsArray($sql);
// print_r($result);die();
  return $result;


 }
 public function branch_order_notify(){

  $sql = 'select * from '.$this->tablename.' where branch_id='.$_SESSION['branch_id'].' and is_deleted="NO" and order_type="NEW"';
  $result = $this->db->GetResultsArray($sql);

  return $result;

 }
 public function get_branch_sale($po_id){
  $sql = "select * from branch_sale where branch_id='".$_SESSION['branch_id']."' and po_id='".$po_id."'" ;

  $result = $this->db->GetResultsArray($sql);
  return $result;

 }
 public function get_bill_no($po_id){
  $sql = "select * from ".$this->tablename4." where branch_id='".$_SESSION['branch_id']."' and po_id='".$po_id."' ORDER BY id DESC LIMIT 1";
  $result = $this->db->getAsIsArray($sql);
  return $result;


 }
 public function update_received_order(){
  $item = array();
  $item = $_POST;
  $update_order_history=array();
  $i=0;
//  foreach ($item as $key => $value) {
//   if ((isset($value["item_name"]) && $value["item_name"] != '')) {
//    $i++;
//  }
//  }

  foreach ( $item as $key => $itemvar) {
   if ((isset($itemvar["item_name"]) && $itemvar["item_name"] != '')) {
    if($itemvar['varieties_id']!=0 && $itemvar['varieties_id']!=''){
     $update_qty=array();
     $sql='select * from variety_items where variety_id='.$itemvar['varieties_id'].' and branch_id='.$_SESSION['branch_id'].'';
     $result = $this->db->GetResultsArray($sql);


     $sql1 = 'select * from '.$this->tablename5.' where var_id='.$itemvar['varieties_id'].' and branch_id='.$_SESSION['branch_id'].' and is_deleted="NO" and id='.$itemvar['po_id'];

     $result1 = $this->db->GetResultsArray($sql1);



     $qty_substract = $result[0]['qty']-$result1[0]['qty'];
     $update_qty['qty'] = $qty_substract+$itemvar['enter_qty'];


     $this->db->mysql_update('variety_items',$update_qty,'id='.$result[0]['id']);

     $update_item_qty=array();
     $item_qty = 'select * from items where id='.$itemvar['item_id'].' and branch_id='.$_SESSION['branch_id'].' and is_deleted="NO"';
     $res = $this->db->GetResultsArray($item_qty);
     $item_qty_substract = $res[0]['qty']-$result1[0]['qty'];

     $update_item_qty['qty'] =  $item_qty_substract+$itemvar['enter_qty'];

     $this->db->mysql_update('items',$update_item_qty,'id='.$res[0]['id']);
            // $purchase_items=array();
            //            // $purchase_items['item_id']=$item_id;
            //            $purchase_items['received_qty']=$itemvar["rec_qty"];
            //           $details_id=$this->db->mysql_update($this->tablename2, $purchase_items,'id='.$itemvar['po_id']); 


    }else{
     $update_item_qty=array();

     $sql1 = 'select * from '.$this->tablename5.' where item_id='.$itemvar['item_id'].' and branch_id='.$_SESSION['branch_id'].' and is_deleted="NO" and id='.$itemvar['po_id'].'';
     $result1 = $this->db->GetResultsArray($sql1);    
     $item_qty = 'select * from items where id='.$itemvar['item_id'].' and branch_id='.$_SESSION['branch_id'].' and is_deleted="NO"';
     $res = $this->db->GetResultsArray($item_qty);
     $item_qty_substract = $res[0]['qty']-$result1[0]['qty'];

     $update_item_qty['qty'] =  $item_qty_substract+$itemvar['enter_qty'];

     $this->db->mysql_update('items',$update_item_qty,'id='.$res[0]['id']);

              // $purchase_items['received_qty']=$itemvar["rec_qty"];
              //         $details_id=$this->db->mysql_update($this->tablename2, $purchase_items,'id='.$itemvar['po_id']); 
    }
    $purchase_order_details=array();

     $sql = 'select * from '.$this->tablename2.'where branch_id='.$_SESSION['branch_id'].' and purchase_id='.$this->db->getpost('po_id').' and item_id='.$itemvar['item_id'].' and is_deleted="NO"';
      $order_id = $this->db->GetResultsArray($sql);

     $sql1 = 'select * from '.$this->tablename5.' where branch_id='.$_SESSION['branch_id'].' and item_id='.$itemvar['item_id'].' and    id='.$itemvar['po_id'].' and is_deleted="NO"';
      $prev_qty = $this->db->getAsIsArray($sql1);
      
      $sub_qty = $order_id[0]['received_qty']-$prev_qty['qty'];
     
    

     $purchase_order_details['received_qty'] = $itemvar['enter_qty']+$sub_qty;
  

    $this->db->mysql_update($this->tablename2,$purchase_order_details,'id='.$order_id[0]['id']);

    
  





    $purchase__history_items=array();
    $purchase__history_items['shop_id']=$_SESSION['shop_id'];
    $purchase__history_items['branch_id']=$_SESSION['branch_id'];

    $purchase__history_items['purchase_id']=$this->db->getpost('po_id');
                       // $purchase__history_items['purchase_id']=$main_purchase_id;
    $purchase__history_items['item_id']=$itemvar['item_id'];
    $purchase__history_items['brand']=$itemvar["brand"];
    $purchase__history_items['units']=$itemvar["units"];
    $purchase__history_items['var_id']=$itemvar["varieties_id"];
    $purchase__history_items['var_name']=$itemvar["varieties_name"];
    $purchase__history_items['category']=$itemvar["category"];
    if ($itemvar['sub_category']!='') {
     $purchase__history_items['sub_category']=$itemvar["sub_category"];
    }else{
     $purchase__history_items['sub_category']=0;
    }

    $purchase__history_items['item_name']=$itemvar["item_name"];
    $purchase__history_items['item_code']=$itemvar["item_code"];
    $purchase__history_items['update_sale_price'] = $itemvar["update_sale_price"];
    $purchase__history_items['mrp']=$itemvar["mrp"];
    $purchase__history_items['sales_price']=$itemvar["sale_price"];

    $purchase__history_items['discount']=$itemvar["discount"];
    $purchase__history_items['gst']=$itemvar["gst"];
    $purchase__history_items['qty']=$itemvar["enter_qty"];
    if ($this->db->getpost('order_type')=='received') {
     $purchase__history_items['received_qty']=$itemvar["quantity"];
    }
    $purchase__history_items['taxable_amt']=$itemvar['total']-$itemvar["gstamount"];
    $purchase__history_items['tax_amt']=$itemvar["gstamount"];
    $purchase__history_items['total']=$itemvar["total"];
    $purchase__history_items['created_by']=$_SESSION['uid'];
    $purchase__history_items['created_at']=date('Y-m-d H:i:s');
    $this->db->mysql_update($this->tablename5, $purchase__history_items,'id='.$itemvar['po_id']);

   }
     

  }




  $sql = "select id from ".$this->tablename4." ORDER BY id DESC LIMIT 1";
  $result = $this->db->getAsIsArray($sql);




  $update_order_history['shop_id']=$_SESSION['shop_id'];
  $update_order_history['branch_id']=$_SESSION['branch_id'];
  $update_order_history['po_id']=$this->db->getpost('po_id');
  $update_order_history['discount_amt']=$this->db->getpost('discount');
  $update_order_history['taxable_amt']=$this->db->getpost('taxable_amount');
  $update_order_history['tax_amt']=$this->db->getpost('tax_amount');
  $update_order_history['grand_total']=$this->db->getpost('grand_total');
  $update_order_history['created_by']=$_SESSION['uid'];
  $update_order_history['created_at']=date('Y-m-d H:i:s');
  $update_order_history['bill_no']=$this->db->getpost('bill_no');

  $update_order_history['received_date']=$this->db->getpost('received_date');

  $update_order_history['paid_amt']=$this->db->getpost('paid_amt');
  $update_order_history['balance_amt']=$this->db->getpost('balance');

  $this->db->mysql_update($this->tablename4,$update_order_history,'id='.$result['id']);

    if ($this->db->getpost('paid_amt')!='' && $this->db->getpost('paid_amt')!=0) {
     $purchase_log = array();
      $sql = 'select * from '.$this->tablename3.'where purchase_id='.$this->db->getpost('po_id').' and branch_id='.$_SESSION['branch_id'].' ORDER BY id DESC LIMIT 1'; 
      $result=$this->db->getAsIsArray($sql);
    // print_r($result);die();
    $purchase_log['branch_id']=$_SESSION['branch_id'];
    $purchase_log['purchase_id']=$this->db->getpost('po_id');
    $purchase_log['credit']=$this->db->getpost('paid_amt');
    $purchase_log['payment_mode']=$this->db->getpost('payment_mode');
    $purchase_log['description']='Balance Collection';
    $purchase_log['created_by']=$_SESSION['uid'];
    $purchase_log['created_at']=date('Y-m-d H:i:s');
    $this->db->mysql_update($this->tablename3, $purchase_log,'id='.$result['id']);
}
$item_check_sql = "select sum(qty)as qty,sum(received_qty)as received_qty from ".$this->tablename2." where purchase_id=".$this->db->getpost('po_id')." and branch_id=".$_SESSION['branch_id']."";
  $item_check_res=$this->db->GetResultsArray($item_check_sql);
 
  $total = $item_check_res[0]['qty']-$item_check_res[0]['received_qty'];
  if($total==0){
   $purchase_update=array();
   $purchase_update['order_type']='RECEIVED';
   $this->db->mysql_update($this->tablename, $purchase_update,'id='.$this->db->getpost('po_id'));

  }else{
   $purchase_update=array();
   $purchase_update['order_type']='PARTIAL COMPLETE';
   $this->db->mysql_update($this->tablename, $purchase_update,'id='.$this->db->getpost('po_id'));

  }
  $history_sql='select bill_no,received_date,sum(taxable_amt) as taxable,sum(tax_amt) as tax,sum(discount_amt) as discount,sum(grand_total) as total from '.$this->tablename4.' where po_id='.$this->db->getpost('po_id').' and branch_id='.$_SESSION['branch_id'].' group by po_id order by id asc';
  $history_res=$this->db->GetResultsArray($history_sql);

  $log_sql='select sum(credit) as credit from '.$this->tablename3.' where purchase_id='.$this->db->getpost('po_id').' group by purchase_id order by id asc';
  $log_res=$this->db->GetResultsArray($log_sql);

  if (count($history_res)>0) {
   $purchase_update=array();
   $purchase_update['bill_no']=$history_res[0]['bill_no'];
   $purchase_update['received_date']=$history_res[0]['received_date'];
   $purchase_update['taxable_amt']=$history_res[0]['taxable'];
   $purchase_update['tax_amt']=$history_res[0]['tax'];
   $purchase_update['discount_amt']=$history_res[0]['discount'];
   $purchase_update['grand_total']=$history_res[0]['total'];
   $purchase_update['paid_amt']=$log_res[0]['credit'];
   $purchase_update['balance_amt']=$history_res[0]['total']-$log_res[0]['credit'];
      // print_r($purchase_update['balance_amt']);die();
   if($purchase_update['balance_amt']==0){

    $purchase_update['status']="PAID";

   }else{

    $purchase_update['status']="PENDING";

   }

   $this->db->mysql_update($this->tablename, $purchase_update,'id='.$this->db->getpost('po_id'));

 
}
return ['status'=>'success'];
 }
 
}
?>