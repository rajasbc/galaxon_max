<?php
include '../tables/config.php';

 $obj = new Vendors();
if ($_POST['vendor_id']==0 && $_POST['vendor_id']=='') {
 $result =  $obj->get_vendor_data();

$output=array();
$main=array();

if (count($result)>0) {
	$i=0;
	$j=0;
	foreach ($result as $key => $value) {
		$i++;
		if($value['status']=='ENABLED'){
		$output [$j] =[$i,$value['vendor_code'],$value['name'],$value['company_name'],$value['mobile_no'],$value['email'],'<button type="button"  class="btn btn-primary" data-id="'.$value['id'].'" data-form="'.$value['name'].'" onclick="edit_modal(this);">Edit</button> <button type="button"  class="btn btn-danger" data-id="'.$value['id'].'" onclick="delete_modal(this);">Disable</button>'];
		$j++;
	}else{
         $output [$j] =[$i,$value['vendor_code'],$value['name'],$value['company_name'],$value['mobile_no'],$value['email'],'<button type="button"  class="btn btn-primary" disabled data-id="'.$value['id'].'" data-form="'.$value['name'].'" onclick="edit_modal(this);">Edit</button> <button type="button"  class="btn btn-danger" data-id="'.$value['id'].'" onclick="enable_modal(this);">Enable</button>'];
		$j++;
	}
	}
	
}

$main = $output;
echo json_encode($main);
}else{
	$result=$obj->get_vendor_dt($_POST['vendor_id']);
	echo json_encode($result);
}
?>