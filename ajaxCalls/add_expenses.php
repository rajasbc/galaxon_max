<?php
include '../tables/config.php';

 $obj = new Expenses();
if ($_POST['type']=='add') {
	
$result =  $obj->add_expenses();

}elseif($_POST['type']=='edit'){
	 $result =  $obj->edit_expenses();
}elseif($_POST['type']=='delete'){
	 $result =  $obj->delete_category();
}


 echo json_encode($result);


?>