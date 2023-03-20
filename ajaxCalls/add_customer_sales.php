<?php
include '../tables/config.php';

 $obj = new CustomerSale();
 $result =  $obj->add_sales();

 
 
 echo json_encode($result);


?>