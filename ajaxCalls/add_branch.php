<?php
include '../tables/config.php';

 $obj = new Shops();
if ($_POST['type']=='edit') {
	 $result =  $obj->edit_branch();
}elseif($_POST['type']=='delete'){
	 $result =  $obj->delete_branch();
}

 echo json_encode($result);


?>