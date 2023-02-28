<?php
include '../tables/config.php';
// error_reporting(E_ALL);
$obj = new Employee();
if ($_POST['id']=='') {
$result = $obj->add_employee();
}else{
$result = $obj->update_employee();

}

echo json_encode($result);

?>