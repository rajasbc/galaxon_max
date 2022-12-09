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
		$item = array();
		$item = $_POST;
		$purchase=array();
		$purchase_log=array();
		$shipping_array=array();

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

		
		$purchase_id = $this->db->mysql_insert($this->tablename, $purchase);
		foreach ($item as $itemvar) {

					if ((isset($itemvar["item_name"]) && $itemvar["item_name"] !== '') && $itemvar["mrp"] != 0) {
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
                       	$item_sql='select * from items where id='.$item_id;
                       	$item_res=$this->db->GetResultsArray($item_sql);
                       	$update_item=array();
                       	$update_item['qty']=$item_res[0]['qty']+$itemvar['quantity'];
                       	$this->db->mysql_update('items', $update_item,'id='.$item_id);
                       	 if ($itemvar['varieties_id']!=0 && $itemvar['varieties_id']!='') {
                        $var_sql='select * from variety_items where item_id='.$item_id.' and variety_id='.$itemvar['varieties_id'].' and branch_id='.$_SESSION['branch_id'].' shop_id='.$_SESSION['shop_id'];
                       	$var_res=$this->db->GetResultsArray($var_sql);
                       	if (count($var_res)>0) {
                        $update_var=array();
                       	$update_var['qty']=$var_res[0]['qty']+$itemvar['enter_qty'];
                       	$this->db->mysql_update('variety_items', $update_var,'id='.$var_res[0]['id']);
                       	}else{

                       	$update_var=array();
                       	$update_var['shop_id']=$_SESSION['shop_id'];
                        $update_var['branch_id']=$_SESSION['branch_id'];
                       	$update_var['item_id']=$item_id;
                       	$update_var['variety_id']=$itemvar['varieties_id'];
                       	$update_var['qty']=$itemvar['enter_qty'];
                       	$this->db->mysql_insert('variety_items', $update_var);
                         }
                       	}
                       }

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
				
		if ($this->db->getpost('shipping_name')!='') {
	$shipping_array['name']=$this->db->getpost('shipping_name');
}
if ($this->db->getpost('shipping_company_name')!='') {
	$shipping_array['company_name']=$this->db->getpost('shipping_company_name');
}
if ($this->db->getpost('smobile_no')!='') {
	$shipping_array['mobile_no']=$this->db->getpost('smobile_no');
}
if ($this->db->getpost('semail')!='') {
	$shipping_array['email']=$this->db->getpost('semail');
}
if ($this->db->getpost('sgst')!='') {
	$shipping_array['gst_no']=$this->db->getpost('sgst');
}
if ($this->db->getpost('saddress')!='') {
	$shipping_array['address']=$this->db->getpost('saddress');
}
if ($this->db->getpost('scity')!='') {
	$shipping_array['city']=$this->db->getpost('scity');
}
if ($this->db->getpost('sstate')!='') {
	$shipping_array['state']=$this->db->getpost('sstate');
}
if ($this->db->getpost('scountry')!='') {
	$shipping_array['country']=$this->db->getpost('scountry');
}
if ($this->db->getpost('spincode')!='') {
	$shipping_array['pincode']=$this->db->getpost('spincode');
}
if ($this->db->getpost('ship_terms')!='') {
	$shipping_array['shipping_terms']=$this->db->getpost('ship_terms');
}
if ($this->db->getpost('shipping_method')!='') {
	$shipping_array['method']=$this->db->getpost('shipping_method');
}
if ($this->db->getpost('shipping_d_date')!='') {
	$shipping_array['delivery_date']=$this->db->getpost('shipping_d_date');
}
if (!empty($shipping_array)) {
	$shipping_array['po_id']=$purchase_id;
	$shipping_array['shop_id']=$_SESSION['shop_id'];
	$this->db->mysql_insert($this->tablename6, $shipping_array);
}


     return ['status'=>'success'];
		
	}
		public function add_new_purchase()
	{
		$item = array();
		$item = $_POST;
		$purchase=array();
		$purchase_log=array();
		$purchase_id=$this->db->getpost('po_id');
		$purchase_sql='select * from '.$this->tablename.' where id='.$purchase_id;
		$purchase_res=$this->db->GetResultsArray($purchase_sql);

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
		$purchase['received_date']=$this->db->getpost('received_date');
		$purchase['paid_amt']=$this->db->getpost('paid_amt');
		$purchase['balance_amt']=$this->db->getpost('balance');
		
		
	 $main_purchase_id= $this->db->mysql_insert($this->tablename4, $purchase);
		foreach ($item as $itemvar) {

					if ((isset($itemvar["item_name"]) && $itemvar["item_name"] !== '') && $itemvar["mrp"] != 0 && ($itemvar["enter_qty"] != 0 && $itemvar["enter_qty"] !='')) {
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
                       $purchase_items['item_id']=$item_id;
                       $purchase_items['received_qty']=$itemvar["rec_qty"]+$itemvar['enter_qty'];
                      $details_id=$this->db->mysql_update($this->tablename2, $purchase_items,'id='.$itemvar['po_id']);

                      $purchase__history_items=array();
                       $purchase__history_items['shop_id']=$_SESSION['shop_id'];
                       $purchase__history_items['purchase_id']=$main_purchase_id;
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
                       $purchase__history_items['mrp']=$itemvar["mrp"];
                       $purchase__history_items['sales_price']=$itemvar["sale_price"];
                       $purchase__history_items['discount']=$itemvar["discount"];
                       $purchase__history_items['gst']=$itemvar["gst"];
                       $purchase__history_items['qty']=$itemvar["quantity"];
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
                       	$this->db->mysql_update('items', $update_item,'id='.$item_id);
                         if ($itemvar['varieties_id']!=0 && $itemvar['varieties_id']!='') {
                        $var_sql='select * from variety_items where item_id='.$item_id.' and variety_id='.$itemvar['varieties_id'].' and shop_id='.$_SESSION['shop_id'];
                       	$var_res=$this->db->GetResultsArray($var_sql);
                       	if (count($var_res)>0) {
                        $update_var=array();
                       	$update_var['qty']=$var_res[0]['qty']+$itemvar['enter_qty'];
                       	$this->db->mysql_update('variety_items', $update_var,'id='.$var_res[0]['id']);
                       	}else{
                       	$update_var=array();
                       	$update_var['shop_id']=$_SESSION['shop_id'];
                       	$update_var['item_id']=$item_id;
                       	$update_var['variety_id']=$itemvar['varieties_id'];
                       	$update_var['qty']=$itemvar['enter_qty'];
                       	$this->db->mysql_insert('variety_items', $update_var);
                         }
                       	}

                       }

					}
				}
if ($this->db->getpost('paid_amt')!='' && $this->db->getpost('paid_amt')!=0) {
		$purchase_log['shop_id']=$_SESSION['shop_id'];
		$purchase_log['purchase_id']=$purchase_id;
		$purchase_log['credit']=$this->db->getpost('paid_amt');
		$purchase_log['payment_mode']=$this->db->getpost('payment_mode');
		$purchase_log['description']='Balance Collection';
		$purchase_log['created_by']=$_SESSION['uid'];
		$purchase_log['created_at']=date('Y-m-d H:i:s');
		$this->db->mysql_insert($this->tablename3, $purchase_log);
}
		$item_check_sql	= "select * from ".$this->tablename2." where purchase_id=".$purchase_id." and qty=received_qty";
		$item_check_res=$this->db->GetResultsArray($item_check_sql);
		if (count($item_check_res) > 0) {
			$purchase_update=array();
			$purchase_update['order_type']='RECEIVED';
		$this->db->mysql_update($this->tablename, $purchase_update,'id='.$purchase_id);
		}else{
			$purchase_update=array();
			$purchase_update['order_type']='PARTIAL COMPLETE';
		$this->db->mysql_update($this->tablename, $purchase_update,'id='.$purchase_id);
		}

		$history_sql='select bill_no,received_date,sum(taxable_amt) as taxable,sum(tax_amt) as tax,sum(discount_amt) as discount,sum(grand_total) as total from '.$this->tablename4.' where po_id='.$purchase_id.' group by po_id order by id asc';
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

		$this->db->mysql_update($this->tablename, $purchase_update,'id='.$purchase_id);
		}

     return ['status'=>'success'];
		
	}


public function edit_purchase_order()
{


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
		
		$purchase_id = $this->db->mysql_update($this->tablename, $purchase, 'purchase_no='.$this->db->getpost('po_id'));

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
		$purchase=array();
		$purchase['paid_amt']=$result[0]['paid_amt']+$this->db->getpost('paid_amt');
		$purchase['balance_amt']=$this->db->getpost('balance');
		$purchase['created_by']=$_SESSION['uid'];
		$purchase['created_at']=date('Y-m-d H:i:s');
		if ($this->db->getpost('balance')==0) {
		$purchase['status']='PAID';
		}
		 $this->db->mysql_update($this->tablename, $purchase,'id='.$this->db->getpost('po_id'));
		    $purchase_log=array();
			$purchase_log['shop_id']=$_SESSION['shop_id'];
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

    if($_SESSION['type']=='ADMIN'){
		if ($this->db->getpost('type')=='RECEIVED') {
			$sql='select * from '.$this->tablename.' where is_deleted="NO" and order_type="RECEIVED" and vendor_id!="0" and branch_id='.$_SESSION['branch_id'].'';
		}else{
			$sql='select * from '.$this->tablename.' where is_deleted="NO" and order_type!="RECEIVED" and vendor_id!="0" and branch_id='.$_SESSION['branch_id'].'';

		}
	 
		
   
	}else{

    $sql = 'select * from '.$this->tablename.' where is_deleted="NO" and vendor_id="0" and order_type!="RECEIVED" and branch_id='.$_SESSION['branch_id'].'';
  }


  $result=$this->db->GetResultsArray($sql);
    return $result;

}
	public function get_purchase_order($id)
	{
	 $sql='select * from '.$this->tablename.' where id='.$id.' and is_deleted="NO"';
		$result=$this->db->GetResultsArray($sql);
		return $result;
	}
	public function get_purchase_order_item($id)
	{
	 $sql='select * from '.$this->tablename2.' where purchase_id='.$id.'';
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
	 $sql='select * from '.$this->tablename6.' where po_id='.$id.'';
		$result=$this->db->GetResultsArray($sql);
		return $result;
	}



public function get_purchase_list(){


  $sql='select * from '.$this->tablename.' where is_deleted="NO" and order_type!="NEW" and status="PENDING"';
  $result=$this->db->GetResultsArray($sql);
    return $result;

}

public function get_shipping_details(){

   $sql = 'select * from '.$this->tablename6.' where is_delete="NO"';
   
   $result = $this->db->GetResultsArray($sql);

    return $result;
}

public function get_Autocomplete_shipping(){

  $sql = "select * from ".$this->tablename6."where (name like'%".$this->db->getpost('term')."%' or po_id like'%".$this->db->getpost('term')."%') and shop_id = ".$_SESSION['shop_id']."";

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

$sql = 'select a.bill_no,a.vendor_id,a.id,b.item_name,b.purchase_id,b.var_id,b.var_name,b.item_code,b.mrp,b.sales_price,b.received_qty,c.name,d.name from purchase_order a  join purchase_order_details b on a.id=b.purchase_id join varieties c on b.var_id=c.id join vendors d on a.vendor_id=d.id  where b.item_id ='.$id.' and a.branch_id='.$_SESSION['branch_id'].'';
$result = $this->db->GetResultsArray($sql);


return $result;


}
// public function get_vendor_variety($id){
// $sql = 'select * from '.$this->tablename2.' where purchase_id ='.$id.' and branch_id='.$_SESSION['branch_id'].' ';
// $result = $this->db->GetResultsArray($sql);


// return $result;




// }

}
?>