<?php
include '../tables/config.php';

 $obj = new Description();
if ($_POST['type']=='add') {
	 $result =  $obj->add_description();
}elseif($_POST['type']=='edit'){
	 $result =  $obj->edit_description();
}elseif($_POST['type']=='delete'){
	 $result =  $obj->delete_description();
}


 echo json_encode($result);


?>