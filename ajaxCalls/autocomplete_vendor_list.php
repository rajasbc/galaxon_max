<?php
include '../tables/config.php';

 $obj = new Vendors();

 $result =  $obj->get_Autocomplete_Vendor();
$output=array();
 if(count($result)>0){
  foreach($result as $row){
    $temp_array=array();
    $temp_array['value']=strtoupper($row['name']);
    $temp_array['label']=$row['id'];
    $temp_array['name']=$row['name'];
    $temp_array['vendor_code']=$row['vendor_code'];

    $output[]=$temp_array;
  }
 }
 else{
  $output['value'] = ' ';
 }

 echo json_encode($output);
?>