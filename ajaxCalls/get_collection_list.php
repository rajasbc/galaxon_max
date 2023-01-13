<?php 
include '../tables/config.php';

$obj = new BranchSale(); 
$obj1 = new Shops();

$result= $obj->get_collection();

// print_r($result);die();
$output =array();

if(count($result>0)){
	$i=0;
	$j=0;
	$k=0;
	$total_amount=0;

foreach ($result as $key => $value) {
	$result1 = $obj1->get_branch_name($value['branch_id']);
	// $result1 = $
	// $result2 = $obj1->get_vendor_name($result1[0]['purchase_id']);

	   $i++;
	$output[$j]=[$i,$value['bill_no'],$result1[0]['name'],$result1[0]['branch_code'],$value['total_qty']];

   $j++;
   $total_amount+=$value['paid_amt'];
}







}
echo json_encode($output);

?>