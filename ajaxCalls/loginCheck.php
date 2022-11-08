<?php
include '../tables/config.php';

 $obj = new Users();

 $result =  $obj->loginCheck();

 echo json_encode($result);


?>