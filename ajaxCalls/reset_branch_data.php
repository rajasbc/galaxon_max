<?php
include '../tables/config.php';

 $obj = new Shops();

 $result =  $obj->get_username($_POST['id']);


 echo json_encode($result);


?>