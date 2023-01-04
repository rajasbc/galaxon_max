<?php
include '../tables/config.php';


$obj = new Items();
$result =  $obj->get_sale_items($_POST['id']);
// print_r($result);die();

$Vobj = new Varieties();
$Vresult =  $Vobj->get_sale_varieties($result[0]['item_id']);
$var_select='';
if (count($Vresult)>0) {
	$i=0;
	foreach ($Vresult as $key => $value) {
		$i++;
		$var_select .='<option value="'.$value['variety_id'].'">'.strtoupper($value['name']).'</option>';
	}
	
}
$output=array();
$output['item_id']=$result[0]['item_id'];
$output['brand']=$result[0]['brand'];
$output['category']=$result[0]['category'];
$output['sub_category']=$result[0]['sub_category'];
$output['units']=$result[0]['units'];
$output['item_name']=$result[0]['item_name'];
$output['item_code']=$result[0]['item_code'];
$output['mrp']=$result[0]['mrp'];
$output['sales_price']=$result[0]['sales_price'];
$output['discount']=$result[0]['discount'];
$output['gst']=$result[0]['gst'];
$output['varieties']=$var_select;

echo json_encode($output);
?>