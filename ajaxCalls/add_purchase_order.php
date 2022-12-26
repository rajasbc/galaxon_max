<?php
include '../tables/config.php';

// print_r($POST);die();

// error_reporting(E_ALL);
 $obj = new PurchaseOrder();
 $result =  $obj->add_purchase();
 
 echo json_encode($result);


?>