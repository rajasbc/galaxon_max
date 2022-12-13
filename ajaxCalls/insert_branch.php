<?php 
include '../tables/config.php';

// error_reporting(E_ALL);

$obj = new Shops();
$result = $obj->insert_details();


echo json_encode($result);
?>