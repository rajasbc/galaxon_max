<?php 
include '../tables/config.php';
// error_reporting(E_ALL);

// print_r($_POST);die();
$obj = new BranchSale();
$result =  $obj->add_branch_sale();

echo json_encode($result);
?>