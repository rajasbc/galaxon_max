<?php
include '../tables/config.php';

$obj = new Varieties();
$result =  $obj->get_var_price($_POST['var_id']);


echo json_encode($result);
?>