<?php 
include '../tables/config.php';
// print_r($_POST);die();
// error_reporting(E_ALL);

$obj = new Shops();
$result = $obj->insert_details();


echo json_encode($result);
?>