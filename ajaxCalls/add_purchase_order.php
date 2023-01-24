<?php
include '../tables/config.php';


 $obj = new PurchaseOrder();
 $result =  $obj->add_purchase();
 
 echo json_encode($result);


?>