<?php
include '../tables/config.php';
// print_r($_POST);die();
// error_reporting(E_ALL);
 $obj = new SaveOrder();
 $result =  $obj->update_purchase();
 
 echo json_encode($result);


?>