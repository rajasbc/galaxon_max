<?php
include '../tables/config.php';

// error_reporting(E_ALL);
 $obj = new PurchaseOrder();
 $result =  $obj->add_purchase();
 
 echo json_encode($result);


?>