<?php
include '../tables/config.php';
// error_reporting(E_ALL);
// print_r($_POST);die();
$obj = new PurchaseOrder();
$result = $obj->update_received_order();

echo json_encode($result);
 ?>