<?php
include '../tables/config.php';
 $obj = new Varieties();

 $result =  $obj->get_Autocomplete_varieties($_REQUEST['item_id']==''?0:$_REQUEST['item_id']);
$output=array();
 if(count($result)>0){
  foreach($result as $row){
    $temp_array=array();
    $temp_array['value']=strtoupper($row['name']);
    $temp_array['label']=$row['id'];
    $temp_array['name']=$row['name'];

    $output[]=$temp_array;
  }
 }
 else{
  $output['value'] = strtoupper('No Item Found');
 }

 echo json_encode($output);
?>