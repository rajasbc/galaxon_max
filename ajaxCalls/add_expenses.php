<?php
include '../tables/config.php';
// print_r($_POST);die();
// error_reporting(E_ALL);
 $obj = new Expenses();
if ($_POST['type']=='add') {
	
$result =  $obj->add_expenses();

}elseif($_POST['type']=='edit'){
	 $result =  $obj->edit_expenses();
}elseif($_POST['type']=='delete'){
	
	 $result =  $obj->delete_category($_POST['id']);
}


 echo json_encode($result);


?>