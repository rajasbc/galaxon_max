<?php
include '../tables/config.php';
$obj = new Employee();
if ($_POST['id']=='') {
$result = $obj->add_employee();
}else{
$result = $obj->update_employee();

}

echo json_encode($result);

?>