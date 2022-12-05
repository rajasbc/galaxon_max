<?php
include '../tables/config.php';

 $obj = new PurchaseOrder();
 $result = $obj->get_shipping_details();


$output=array();


if (count($result)>0) {
	$i=0;
	$j=0;
	foreach ($result as $key => $value) {
		$i++;
	
		$output [$j] =[$i,$value['name'],$value['company_name'],$value['gst_no'],$value['mobile_no'],$value['email'],'<button type="button" class="btn btn-info" onclick="view_shipping(this);" data-id ='.$value['id'].'>View</button> <button type="button" class="btn btn-danger" onclick="delete_shipping(this);" data-id ='.$value['id'].'>Delete</button>'];
		$j++;
	
	}
	
}


echo json_encode($output);


?>