<?php 

include '../tables/config.php';


$obj = new Items();

$result = $obj->get_group_name_dt($_POST['id']);


if(count($result)){


 $i=0;
 $j=0;
 $output = array();
 $total = 0;

 foreach ($result as $key => $value) {
  $i++;
  

  $output[$j] = [$i,$value['item_name'],$value['qty']];



  $j++;


 }



}else{

 $output[$j] = ["No Data Found"];
}




echo json_encode($output);




?>