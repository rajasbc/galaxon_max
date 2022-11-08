<?php
include '../tables/config.php';
// print_r($_POST);die();
 $obj = new PurchaseOrder();
 $result =  $obj->pay_purchase_order();
 echo json_encode($result);


?>