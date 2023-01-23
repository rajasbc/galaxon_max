<?php
include '../tables/config.php';

 $obj = new ReturnItems();
 $result =  $obj->add_return_item();
 
 echo json_encode($result);


?>