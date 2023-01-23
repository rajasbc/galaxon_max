<?php
include '../tables/config.php';


 $obj = new Shops();
 $result = $obj->get_branch_inf($_POST['branch_id']);

echo json_encode($result);

?>