<?php
include '../tables/config.php';

 $obj = new Shops();

 $result =  $obj->get_Autocomplete_branch_expenses();
$output=array();
 if(count($result)>0){
  foreach($result as $row){
    $temp_array=array();
    $temp_array['value']=strtoupper($row['branch_name']);
    $temp_array['label']=$row['name'];
    $temp_array['id'] = $row['branch_id'];
    

    $output[]=$temp_array;
  }
 }
 else{
  $output['value'] = strtoupper('Branch Not FOUND');
 }

 echo json_encode($output);
?>