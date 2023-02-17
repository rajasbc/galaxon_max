<?php
include '../tables/config.php';

 $obj = new Department();
if ($_POST['type']=='add') {
	 $result =  $obj->add_department();
}elseif($_POST['type']=='edit'){
	 $result =  $obj->edit_department();
}elseif($_POST['type']=='delete'){
	 $result =  $obj->delete_department();
}


 echo json_encode($result);


?>