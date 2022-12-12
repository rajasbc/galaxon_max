<?php 

include '../tables/config.php';
// print_r($_POST);die();
$obj = new PurchaseOrder();
$result = $obj->add_shipping();

echo json_encode($result);

?>