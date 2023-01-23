<?php
include '../tables/config.php';

 $obj = new Shops();

 $result =  $obj->get_Autocomplete_branch();
$output=array();
 if(count($result)>0){
  foreach($result as $row){
    $temp_array=array();
    $temp_array['value']=strtoupper($row['name']);
    $temp_array['label']=$row['branch_id'];
    $temp_array['name']=$row['name'];
    $temp_array['branch_code']=$row['branch_code'];

    $output[]=$temp_array;
  }
 }
 else{
  $output['value'] = ' ';
 }

 echo json_encode($output);
?>