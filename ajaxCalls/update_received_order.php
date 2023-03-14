<?php 
include '../tables/config.php';
$obj = new PurchaseOrder();
$result = $obj->update_rec_order($_POST['po_id']);
echo json_encode($result);

?>