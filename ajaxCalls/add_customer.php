<?php
include '../tables/config.php';
// print_r($_POST);die();
 $obj = new Customers();
if ($_POST['type']=='add') {
	 $result =  $obj->add_customer();
	 
}elseif($_POST['type']=='edit'){
	 $result =  $obj->edit_customer();
}elseif($_POST['type']=='delete'){
	 $result =  $obj->delete_customer();
}


 echo json_encode($result);


?>