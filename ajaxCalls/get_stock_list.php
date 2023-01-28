<?php 
include '../tables/config.php';

$obj = new Items(); 
$obj1 = new PurchaseOrder();

$result= $obj->get_item_id();

// print_r($result);die();


$output =array();

if(count($result>0)){
	$i=0;
	$j=0;

foreach ($result as $key => $value) {
	$result1 = $obj->get_variety_id($value['item_code']);
	if($result1[0]['item_id']!='' && $result1[0]['item_id']!=0){

$btn = '<button type="button" class="btn btn-info" style="
    margin-left: 5px;" data-id="'.$result1[0]['item_id'].'" onclick="view_vendor(this);">Vendor</button>';

	}else{

$btn = '<button type="button" class="btn btn-info" style="
    margin-left: 5px;" data-id=0 onclick="view_vendor(this);">Vendor</button>';

	}


	   $i++;
	$output[$j]=[$i,$value['item_name'],$value['qty'],'<button type="button" class="btn btn-info" data-id ="'.$value['id'].'" onclick="view_varieties(this);">Varieties</button>' .$btn];

   $j++;
}






}
echo json_encode($output);

?>