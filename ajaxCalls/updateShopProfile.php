
<?php
include '../tables/config.php';
// print_r($_POST);die();

$obj=new Shops();
$result=$obj->update_Shops();

echo json_encode($result);
?>

