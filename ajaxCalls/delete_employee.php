<?php 
include '../tables/config.php';
$obj = new Employee();
$result = $obj->del_employee($_POST['id']);
echo json_encode($result);

?>