<?php 
include '../tables/config.php';
$obj = new Expenses();
$result = $obj->dele_file();


echo json_encode($result);

?>