<?php 

include '../tables/config.php';


$obj = new PurchaseOrder();
$result = $obj->get_order();

// print_r($result);die();
$output=array();


if(count($result)>0){
  $i=0;
  $j=0;
 foreach ($result as $key => $value) {
         $result1 = $obj->branch_name($value['id']);
 	$i++;
 	$output[$j]=[$i,$value['purchase_no'],$result1[0]['name'],$result1[0]['branch_code'],date('d-m-Y',strtotime($value['created_at'])),$value['discount_amt'],$value['tax_amt'],$value['grand_total'],$value['paid_amt'],$value['balance_amt'],$value['order_type'],'<button type="button" class="btn btn-primary" data-id="'.$value['id'].'"" onclick= "order_detail(this);">Details</button>'];
 	
$j++;
 }


}

echo json_encode($output);
?>