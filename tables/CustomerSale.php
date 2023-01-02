<?php
// error_reporting(E_ALL);
class CustomerSale extends Dbconnection {
	var $name;
	var $db;
	var $invitee_obj;
	var $msg = '';
	var $tablename = "`customer_sale`";
  var $tablename2 = "`customer_sale_details`";
  VAR $tablename3 = "`sale_payment_log`";
   
	
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
   $sales['tax_amt']=$this->db->getpost('tax_amount');
   $sales['grand_total']=$this->db->getpost('grand_total');
   $sales['created_by']=$_SESSION['uid'];
   $sales['created_at']=date('Y-m-d H:i:s');

   // $sales['bill_no']=$this->db->getpost('bill_no');
   // $sales['received_date']=$this->db->getpost('received_date');
   $sales['paid_amt']=$this->db->getpost('paid_amt');
   $sales['balance_amt']=$this->db->getpost('balance');
   
    if ($this->db->getpost('balance')==0) {
   $sales['status']='PAID';
    }
   
   $sales_id = $this->db->mysql_insert($this->tablename,$sales);

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
   $sql = 'select * from '.$this->tablename.'where branch_id='.$_SESSION['branch_id'].'';
   $result = $this->db->GetResultsArray($sql);
   return $result;
  }
  public function get_sale_data($id){

   $sql = 'select * from '.$this->tablename2.'where branch_id='.$_SESSION['branch_id'].' and sale_id='.$id.'';
   $result = $this->db->GetResultsArray($sql);
   return $result;

  }



  }



?>