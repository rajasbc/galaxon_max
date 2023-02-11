<?php
include '../tables/config.php';


 $obj = new Expenses();
 $obj1 = new ExpenseCategory(); 
if ($_POST['expenses_id']==0 && $_POST['expenses_id']=='') {
 $result =  $obj->customer_expenses_data();

$output=array();
$main=array();

if (count($result)>0) {
	$i=0;
	$j=0;
	foreach ($result as $key => $value) {
     $result = $obj1->get_category_name($value['expenses_category']);
		
		$i++;

       
               $output [$j] =[$i,$value['customer_name'],$result['name'],$value['expenses_name'],$value['total_amt'],
               '<button style="margin-right: 20px"; type="button"  class="btn btn-primary" data-id="'.$value['id'].'" data-form="'.$value['name'].'" onclick="edit_modal(this);">Edit</button> 
               <button style="margin-right: 20px"; type="button"   class="btn btn-danger" data-id="'.$value['id'].'" onclick="del_btn(this);">Delete</button>'];
      $j++;

              }

	}
	


$main = $output;
echo json_encode($main);
}else{
  
	$result=$obj->customer_expenses_dt($_POST['expenses_id']);


	echo json_encode($result);
}
?>