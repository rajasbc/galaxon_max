<?php 
include '../tables/config.php';
$obj = new PurchaseOrder();
$result = $obj->insert_shipping();

echo json_encode($result);


?>