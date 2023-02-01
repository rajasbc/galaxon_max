<?php
include '../tables/config.php';
// error_reporting(E_ALL);

 $obj = new Expenses();
 $obj1 = new ExpenseCategory(); 
if ($_POST['expenses_id']==0 && $_POST['expenses_id']=='') {
 $result =  $obj->get_expenses_data();

$output=array();
$main=array();

if (count($result)>0) {
	$i=0;
	$j=0;
	foreach ($result as $key => $value) {
     $result = $obj1->get_category_name($value['expenses_category']);
		
		$i++;

       
               $output [$j] =[$i,$value['branch_name'],$result['name'],$value['expenses_name'],$value['amount'],
               '<button style="margin-right: 20px"; type="button"  class="btn btn-primary" data-id="'.$value['id'].'" data-form="'.$value['name'].'" onclick="edit_modal(this);">Edit</button> 
               <button style="margin-right: 20px"; type="button"   class="btn btn-primary" data-id="'.$value['id'].'" onclick="view_btn(this);">View</button>'];
      $j++;

              }

	}
	


$main = $output;
echo json_encode($main);
}else{

	$result=$obj->get_expenses_dt($_POST['expenses_id']);
	echo json_encode($result);
}
?>