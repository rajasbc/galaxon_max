<?php
include '../tables/config.php';


 $obj = new Shops();
if ($_POST['branch_id']==0 && $_POST['branch_id']=='') {
 $result =  $obj->get_branch_data();


$output=array();
$main=array();

if (count($result)>0) {
	$i=0;
	$j=0;
	foreach ($result as $key => $value) {
		
		$i++;
		$output [$j] =[$i,$value['name'],$value['mobile_no'],$value['email'],'<button type="button"  class="btn btn-primary" data-id="'.$value['id'].'" data-form="'.$value['name'].'" onclick="edit_modal(this);">Edit</button> <button type="button"  class="btn btn-danger" data-id="'.$value['id'].'" onclick="delete_modal(this);">Disable</button>'];
		$j++;
	}
	
}

$main = $output;
echo json_encode($main);
}else{
	$result=$obj->get_branch_dt($_POST['branch_id']);
	echo json_encode($result);
}
?>