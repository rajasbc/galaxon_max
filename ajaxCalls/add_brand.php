<?php
include '../tables/config.php';

 $obj = new Brand();
if ($_POST['type']=='add') {
	 $result =  $obj->add_brand();
}elseif($_POST['type']=='edit'){
	 $result =  $obj->edit_brand();
}elseif($_POST['type']=='delete'){
	 $result =  $obj->delete_brand();
}


 echo json_encode($result);


?>