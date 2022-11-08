<?php
include '../tables/config.php';

 $obj = new PurchaseOrder();
 $result =  $obj->get_purchase_orders();
 $vendor_obj=new Vendors();
$output=array();
$main=array();

if (count($result)>0) {
	$i=0;
	$j=0;
	foreach ($result as $key => $value) {

		$i++;
		$vendor_dt=$vendor_obj->get_vendor_dt($value['vendor_id']);
		$output [$j] =[$i,$value['purchase_no'],$value['bill_no'],$vendor_dt['name'],date('d-m-Y',strtotime($value['received_date'])),$value['discount_amt'],$value['tax_amt'],$value['grand_total'],$value['paid_amt'],$value['balance_amt'],$value['status'],'<button type="button" id="'.$value['id'].'" class="btn btn-default btn-sm" onclick="detail_modal('.$value['id'].')"><span class="glyphicon glyphicon-eye"><i class="fas fa-eye"></i></span></button>'];
		$j++;
	}
	
}

$main = $output;
echo json_encode($main);

?>