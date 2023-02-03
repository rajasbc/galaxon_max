<?php
include '../tables/config.php';
 
// error_reporting(E_ALL);
 $obj = new CustomerSale();
 $obj1 = new Customers();
  
 $result =  $obj->get_sale_details();



$output=array();
$main=array();

if (count($result)>0) {
	$i=0;
	$j=0;
	foreach ($result as $key => $value) {

              $result = $obj1->get_customer_name($value['customer_id']);
		$i++;
		

	

			$output[$j] =[$i,'<a  href= customer_sale_item_view.php?id='.$value['sale_id'].' id="'.$value['id'].'" >'.$value["sale_id"].'</a>',$result[0]['name'].'-'.$result[0]['customer_code'],$value['discount_amt'],$value['tax_amt'],$value['grand_total'],$value['paid_amt'],$value['balance_amt'],'<button type="button" id="'.$value['sale_id'].'" class="btn btn-default btn-sm" data-toggle="tooltip" title="view Sales Details" onclick="new_detail_modal('.$value['id'].')"><span class="glyphicon glyphicon-eye"><i class="fas fa-eye"></i></span></button> <button type="button" id="'.$value['id'].'" class="btn btn-default btn-sm" data-toggle="tooltip" title="Print Sales Details" onclick="print_page('.$value['id'].')"><span class="glyphicon glyphicon-eye"><i class="fas fa-print"></i></span></button>'];
		
		
		$j++;
	}
	
}

$main = $output;
echo json_encode($main);

?>