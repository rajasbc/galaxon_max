<?php
include '../tables/config.php';


$obj = new Customers();
$result = $obj->customer_enable($_POST['id']);

echo json_encode($result);
?>