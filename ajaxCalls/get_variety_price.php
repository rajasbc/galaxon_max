<?php
include '../tables/config.php';

$obj = new Varieties();
$result =  $obj->get_var_price($_POST['var_id']);

// print_r($result);die();
echo json_encode($result);
?>