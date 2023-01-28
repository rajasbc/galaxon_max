<?php
include '../tables/config.php';

 $obj = new GroupName();

 $result =  $obj->get_group_data();
$output=array();
$main=array();

if (count($result)>0) {
	$i=0;
	$j=0;
	foreach ($result as $key => $value) {
		$i++;
		$output [$j] =[$i,$value['group_name'],'<button type="button"  class="btn btn-primary" data-id="'.$value['id'].'" data-form="'.$value['name'].'" onclick="edit_modal(this);">Edit</button> <button type="button"  class="btn btn-danger" data-id="'.$value['id'].'" onclick="delete_modal(this);">Delete</button>'];
		$j++;
	}
	
}

$main = $output;
echo json_encode($main);
?>