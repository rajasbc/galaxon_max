<?php
include '../tables/config.php';

 $obj = new Customers();
if($_POST['group_id']!=0 && $_POST['group_id']!=''){
 $result =  $obj->get_customer_grp_dt($_POST['group_id']);
}else{

$result =  $obj->get_customer_data();

}

 // print_r($result);die();

$output=array();
$main=array();

if (count($result)>0) {
	$i=0;
	$j=0;
	foreach ($result as $key => $value) {
		$i++;
		if($value['status']=='ENABLED'){
		$output [$j] =[$i,$value['customer_code'],$value['name'],$value['company_name'],$value['mobile_no'],$value['email'],'<button type="button"  class="btn btn-primary" data-id="'.$value['id'].'" data-form="'.$value['name'].'" onclick="edit_modal(this);">Edit</button> <button type="button"  class="btn btn-danger" data-id="'.$value['id'].'" onclick="delete_modal(this);">Disable</button>'];
		$j++;
	}else{
         $output [$j] =[$i,$value['customer_code'],$value['name'],$value['company_name'],$value['mobile_no'],$value['email'],'<button type="button"  class="btn btn-primary" disabled data-id="'.$value['id'].'" data-form="'.$value['name'].'" onclick="edit_modal(this);">Edit</button> <button type="button" class="btn btn-danger" data-id="'.$value['id'].'" onclick="enable_btn(this);">Enable</button>'];
		$j++;
	}
	}
	
}

$main = $output;
echo json_encode($main);

?>