<?php
include '../tables/config.php';
// print_r($_POST);die();
$obj = new Items();

$result =  $obj->add_items();



 echo json_encode($result);


?>