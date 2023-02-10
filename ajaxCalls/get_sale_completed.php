<?php 

include '../tables/config.php';

$obj = new BranchSale();
$obj1 = new Shops();
$obj2 = new PurchaseOrder();
$result = $obj2->get_received_dt();
// $result1 = $obj2->get_order_dt($result[0]['id']);

// $result = $obj->get_branch_sale();


// print_r($result);die();


$output=array();


if(count($result)>0){
  $i=0;
  $j=0;
 foreach ($result as $key => $value) {

         $result1 = $obj2->get_order_dt($value['id'],$value['branch_id']);

         // $result1 = $obj->branch_sale_item($value['po_id'],$value['branch_id']);

         $branch_name = $obj1->get_salebranch_name($value['branch_id']);
 	$i++;

 	
 	$output[$j]=[$i,$value['purchase_no'],$branch_name['name'].'-'.$branch_name['branch_code'],$result1[0]['qty'],$result1[0]['received_qty'],'<button type="button" value="'.$value['branch_id'].'" class="btn-small btn-primary" data-id="'.$value['id'].'"" onclick= "order_detail(this);">View</button>'];
 	
$j++;
 }


}

echo json_encode($output);
?>