<?php
include '../tables/config.php';
$obj = new Varieties();

 $result =  $obj->update_varieties_data();
 echo json_encode($result);

?>