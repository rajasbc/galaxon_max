<?php
include '../tables/config.php';
// print_r($_POST);die();
 $obj = new CustomerSale();
 $result =  $obj->customer_pay();
 echo json_encode($result);


?>