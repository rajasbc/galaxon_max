<?php
include '../tables/config.php';


$obj = new Items();
$result =  $obj->get_items_dt($_POST['item_id']);
// print_r($result);die();
$Vobj = new Varieties();
$Vresult =  $Vobj->get_varieties_data($_POST['item_id']);
// print_r($Vresult);die();

$var_select='';
if (count($Vresult)>0) {
	$i=0;
	$var_select.='<option value="0">Select Varieties</option>';
	foreach ($Vresult as $key => $value) {
		$i++;

		$var_select .='<option value="'.$value['id'].'">'.strtoupper($value['name']).'</option>';
	}
	
}
$output=array();
$output['item_id']=$result[0]['id'];
$output['brand']=$result[0]['brand'];
$output['category']=$result[0]['category'];

$output['sub_category']=$result[0]['sub_category'];
$output['units']=$result[0]['units'];
$output['item_name']=$result[0]['item_name'];
$output['item_code']=$result[0]['item_code'];
if(count($Vresult)>0){
$output['mrp']=0;
$output['sale_price']=0;
$output['updated_sale_price']=$result[0]['updated_purchase_price'];

}else{
$output['mrp']=$result[0]['mrp'];


$output['sales_price']=$result[0]['sales_price'];
// print_r($output['sales_price']);die();
$output['updated_sale_price']=$result[0]['updated_purchase_price'];

}

$output['discount']=$result[0]['discount'];
$output['gst']=$result[0]['gst'];
$output['varieties']=$var_select;

echo json_encode($output);
?>