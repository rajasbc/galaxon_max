<?php
include '../tables/config.php';
// print_r($_POST);die();


$obj = new Shops();
if($_POST['type']=='enable'){
$result = $obj->update_price($_POST['id']);
}else{

$result = $obj->update_price_disable($_POST['id']);

}

echo json_encode($result);
?>