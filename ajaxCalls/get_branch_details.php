<?php
include '../tables/config.php';

// print_r($_POST);die();
$obj = new Shops();
$result =  $obj->get_branch_name($_POST['branch_id']);

$output=array();
$output['branch_id']=$result[0]['branch_id'];
$output['branch_name']=$result[0]['name'];


echo json_encode($output);
?>