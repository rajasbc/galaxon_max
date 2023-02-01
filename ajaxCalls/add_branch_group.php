<?php
include '../tables/config.php';

 $obj = new GroupName();
if ($_POST['type']=='add') {

	 $result =  $obj->add_branch_group();
}elseif($_POST['type']=='edit'){

	 $result =  $obj->edit_branch_group();
}elseif($_POST['type']=='delete'){

	 $result =  $obj->delete_branch_group();
}


 echo json_encode($result);


?>