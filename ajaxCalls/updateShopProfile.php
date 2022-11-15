
<?php
include '../tables/config.php';


$obj=new Users();
$result=$obj->update_Shops();

echo json_encode($result);
?>

