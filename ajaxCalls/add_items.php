<?php
include '../tables/config.php';
// print_r($_POST);die();
$obj = new Items();
if($_POST['type']=='delete'){
	 $result =  $obj->delete_items();
}elseif($_POST['type']=='edit'){
	 $result =  $obj->edit_items();
}else{
	$result =  $obj->add_items();
}




 echo json_encode($result);


?>