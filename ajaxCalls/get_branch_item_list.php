<?php 
include '../tables/config.php';
// error_reporting(E_ALL);

$obj = new Items(); 
$obj1 = new PurchaseOrder();

$result= $obj->get_branch_item_code();

// print_r($result);die();
$output =array();

if(count($result>0)){
	$i=0;
	$j=0;

foreach ($result as $key => $value) {
	$result1 = $obj->get_variety_id($value['item_code']);
	
	
	   $i++;
	$output[$j]=[$i,$value['item_name'],$value['qty'],'<button type="button" class="btn btn-info" data-id ="'.$result1[0]['item_id'].'" onclick="view_varieties(this);">Varieties</button>'];

   $j++;
}






}
echo json_encode($output);

?>