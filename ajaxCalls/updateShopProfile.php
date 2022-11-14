
<?php
include '../tables/config.php';

$obj=new Shops();
$result=$obj->update_Shops();

echo json_encode($result);
?>

