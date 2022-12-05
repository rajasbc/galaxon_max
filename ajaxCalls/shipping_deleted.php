<?php
include '../tables/config.php';
$obj = new PurchaseOrder();
 $result = $obj->shipping_deleted($_POST['shipping_id']);

 echo json_encode($result);

?>