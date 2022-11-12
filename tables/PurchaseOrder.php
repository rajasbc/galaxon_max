<?php
class PurchaseOrder extends Dbconnection {
	var $name;
	var $db;
	var $invitee_obj;
	var $msg = '';
	var $tablename = "`purchase_order`";
	var $tablename2 = "`purchase_order_details`";
	var $tablename3 = "`purchase_order_log`";
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
		$sql='select max(purchase_no) as purchase_no from '.$this->tablename.' where shop_id='.$_SESSION['shop_id'];
		$result=$this->db->GetResultsArray($sql);
		if ($result[0]['purchase_no']=='' && $result[0]['purchase_no']==0) {
			$purchase_no=1;
		}else{
			$purchase_no=$result[0]['purchase_no']+1;
		}

		$purchase['shop_id']=$_SESSION['shop_id'];
		$purchase['purchase_no']=$purchase_no;
		$purchase['vendor_id']=$this->db->getpost('vendor_id');
		$purchase['discount_amt']=$this->db->getpost('discount');
		$purchase['taxable_amt']=$this->db->getpost('taxable_amount');
		$purchase['tax_amt']=$this->db->getpost('tax_amount');
		$purchase['grand_total']=$this->db->getpost('grand_total');
		$purchase['created_by']=$_SESSION['uid'];
		$purchase['created_at']=date('Y-m-d H:i:s');
if ($this->db->getpost('order_type')=='received') {
		$purchase['bill_no']=$this->db->getpost('bill_no');
		$purchase['received_date']=$this->db->getpost('received_date');
		$purchase['paid_amt']=$this->db->getpost('paid_amt');
		$purchase['balance_amt']=$this->db->getpost('balance');
		$purchase['order_type']='RECEIVED';
		if ($this->db->getpost('balance')==0) {
		$purchase['status']='PAID';
		}
}else{
	$purchase['order_type']='NEW';
}

		
		$purchase_id = $this->db->mysql_insert($this->tablename, $purchase);
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
                       $purchase_items['purchase_id']=$purchase_id;
                       $purchase_items['item_id']=$item_id;
                       $purchase_items['brand']=$itemvar["brand"];
                       $purchase_items['category']=$itemvar["category"];
                       if ($itemvar['sub_category']!='') {
                       	$purchase_items['sub_category']=$itemvar["sub_category"];
                       }else{
                       	$purchase_items['sub_category']=0;
                       }
                       
                       $purchase_items['item_name']=$itemvar["item_name"];
                       $purchase_items['mrp']=$itemvar["mrp"];
                       $purchase_items['sales_price']=$itemvar["sale_price"];
                       $purchase_items['discount']=$itemvar["discount"];
                       $purchase_items['gst']=$itemvar["gst"];
                       $purchase_items['qty']=$itemvar["quantity"];
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
	 $sql='select * from '.$this->tablename.' where is_deleted="NO"';
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
}
?>