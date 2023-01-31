<?php
include '../tables/config.php';
// print_r($_POST);die();
// error_reporting(E_ALL);

 $obj = new ReturnItems();
 $result =  $obj->add_return_item();
 		
 echo json_encode($result);


?>