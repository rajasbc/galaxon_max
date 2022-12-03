<?php 
include '../tables/config.php';

 $obj = new PurchaseOrder();

 $result =  $obj->get_Autocomplete_shipping();

 
$output=array();
 if(count($result)>0){
  foreach($result as $row){
    $temp_array=array();
    $temp_array['value']=strtoupper($row['name']);
    $temp_array['label']=$row['id'];
    $temp_array['name']=$row['name'];
    $temp_array['company_name']=$row['company_name'];
    $temp_array['mobile_no']=$row['mobile_no'];
    $temp_array['email']=$row['email'];
    $temp_array['gst_no']=$row['gst_no'];
    $temp_array['address']=$row['address'];
    $temp_array['city']=$row['city'];
    $temp_array['state']=$row['state'];
    $temp_array['country']=$row['country'];
    $temp_array['pincode']=$row['pincode'];
    $temp_array['shipping_terms']=$row['shipping_terms'];
    $temp_array['delivery']=$row['delivery_date'];


    $output[]=$temp_array;
  }
 }
 else{
  $output['value'] = '';
 }
 echo json_encode($output);


?>