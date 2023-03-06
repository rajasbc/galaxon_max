<?php
include '../tables/config.php';
// print_r($_POST);die();
// error_reporting(E_ALL);
 $obj = new SaveOrder();
 $result =  $obj->save_purchase();
 
 echo json_encode($result);


?>