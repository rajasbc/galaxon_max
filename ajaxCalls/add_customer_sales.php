<?php
include '../tables/config.php';

// print_r($_POST);die();

// error_reporting(E_ALL);
 $obj = new CustomerSale();
 $result =  $obj->add_sales();

 
 
 echo json_encode($result);


?>