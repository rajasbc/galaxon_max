<?php
include '../tables/config.php';

 $obj = new Items();

 $result =  $obj->get_items_data();
$output=array();
$main=array();

if (count($result)>0) {
	$i=0;
	$j=0;
	foreach ($result as $key => $value) {
		$i++;
		$output [$j] =[$i,$value['item_name'],$value['mrp'],$value['sales_price'],$value['discount'],$value['gst'],$value['qty']];
		$j++;
	}
	
}

$main = $output;
echo json_encode($main);
?>