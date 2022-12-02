<?php
include '../tables/config.php';


$obj = new Shops();
$result = $obj->branch_enable($_POST['id']);

echo json_encode($result);
?>