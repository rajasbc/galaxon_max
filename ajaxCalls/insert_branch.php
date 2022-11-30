<?php 
include '../tables/config.php';

$obj = new Shops();
$result = $obj->insert_details();


echo json_encode($result);
?>