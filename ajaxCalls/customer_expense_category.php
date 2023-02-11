<?php
include '../tables/config.php';

// print_r($_POST);die();
 $obj = new ExpenseCategory();
if ($_POST['type']=='add') {
	 $result =  $obj->add_expenses_category();
}elseif($_POST['type']=='edit'){
	 $result =  $obj->edit_expenses_category();
}elseif($_POST['type']=='delete'){
	 $result =  $obj->delete_expenses_category();
}


 echo json_encode($result);


?>