<?php
include '../tables/config.php';

 $obj = new Varieties();
if ($_POST['type']=='add') {
	 $result =  $obj->add_varieties();
}elseif($_POST['type']=='delete'){
	 $result =  $obj->delete_varieties();
}


 echo json_encode($result);


?>