<?php
include '../tables/config.php';

// error_reporting(E_ALL);
 $obj = new Expenses();
 $obj1 = new ExpenseCategory(); 
if ($_POST['expenses_id']==0 && $_POST['expenses_id']=='') {
 $result =  $obj->customer_expenses_date($_POST['fdate'],$_POST['tdate']);

$output=array();
$main=array();

if (count($result)>0) {
  $i=0;
  $j=0;
  foreach ($result as $key => $value) {
     $result = $obj1->get_category_name($value['expenses_category']);
    $date = date('d-m-Y',strtotime($value['exp_date']));
        
    $i++;
    if($value['refund']=='yes'){
      
           $total_expenses =$value['total_amt']-$value['refund_amt'];
           $btn_color = 'btn-info';
    }
    else{

          $total_expenses = $value['total_amt'];
           $btn_color = 'btn-primary';
    }

       
               $output [$j] =[$i,$date,$result[0]['name'],$value['expenses_name'],$total_expenses,
               '<button style="margin-right: 20px"; type="button"  class="btn '.$btn_color.'" data-id="'.$value['id'].'" data-form="'.$value['name'].'" onclick="edit_modal(this);">Edit</button> 
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