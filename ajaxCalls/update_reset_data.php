<?php
include '../tables/config.php';
 
 $obj = new Shops();

 $result =  $obj->update_username($_POST['id']);


 echo json_encode($result);


?>