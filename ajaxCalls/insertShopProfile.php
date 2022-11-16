
<?php
include '../tables/config.php';
// print_r($_POST);die();
$obj=new Shops();
$result=$obj->insert_Shops();
echo json_encode($result);
?>

