<?php
include '../tables/config.php';

 $obj = new Items();

 $result =  $obj->get_Autocomplete_items();
$output=array();
 if(count($result)>0){
  foreach($result as $row){
    $temp_array=array();
    $temp_array['value']=strtoupper($row['item_name']);
    $temp_array['label']=$row['id'];
    $temp_array['item_id']=$row['item_id'];
    $temp_array['name']=$row['item_name'];
    $temp_array['item_code']=$row['item_code'];
    $temp_array['brand']=$row['brand'];
    $temp_array['category']=$row['category'];
    $temp_array['sub_category']=$row['sub_category'];
    $temp_array['qty']=$row['qty'];
    $temp_array['sale_price']=$row['sales_price'];
    $temp_array['mrp']=$row['mrp'];
    $temp_array['units']=$row['units'];
    $temp_array['discount']=$row['discount'];
    $temp_array['gst']=$row['gst'];

    $output[]=$temp_array;
  }
 }
 else{
  $output['value'] = strtoupper('No Item Found');
 }

 echo json_encode($output);
?>