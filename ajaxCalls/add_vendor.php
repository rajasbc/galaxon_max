<?php
include '../tables/config.php';
// print_r($_POST);die();
 $obj = new Vendors();
if ($_POST['type']=='add') {
	 $result =  $obj->add_vendor();
}elseif($_POST['type']=='edit'){
	 $result =  $obj->edit_vendor();
}elseif($_POST['type']=='delete'){
	 $result =  $obj->delete_vendor();
}elseif($_POST['type']=='enable'){
	 $result =  $obj->delete_vendor();
}


 echo json_encode($result);


?>