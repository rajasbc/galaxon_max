<?php 
include '../tables/config.php';

$obj = new Mail();
$result = $obj->sendEmail();


echo json_encode($result);
?>