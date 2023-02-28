<?php
include '../tables/config.php';
// print_r($_POST);die();

$obj = new StaffAttendance();
$result =  $obj->staff_attendance();
echo json_encode($result);
?>