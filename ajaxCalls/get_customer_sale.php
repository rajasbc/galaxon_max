<?php
include '../tables/config.php';
 
// error_reporting(E_ALL);
 $obj = new CustomerSale();
  
 $result =  $obj->get_sale_details();

 // print_r($result);die();

$output=array();
$main=array();

if (count($result)>0) {
	$i=0;
	$j=0;
	foreach ($result as $key => $value) {

		$i++;
		

	

			$output[$j] =[$i,'<a  href= customer_sale_item_view.php?id='.$value['sale_id'].' id="'.$value['id'].'" >'.$value["sale_id"].'</a>',$value['discount_amt'],$value['tax_amt'],$value['grand_total'],$value['paid_amt'],$value['balance_amt']];
		
		
		$j++;
	}
	
}

$main = $output;
echo json_encode($main);

?>