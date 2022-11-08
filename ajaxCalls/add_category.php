<?php
include '../tables/config.php';

 $obj = new Category();
if ($_POST['type']=='add') {
	 $result =  $obj->add_category();
}elseif($_POST['type']=='edit'){
	 $result =  $obj->edit_category();
}elseif($_POST['type']=='delete'){
	 $result =  $obj->delete_category();
}


 echo json_encode($result);


?>