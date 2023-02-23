<?php

include '../tables/config.php';

$obj = new Expenses();
$obj1 = new ExpenseCategory(); 
$result = $obj->get_expenses_date($_POST['fdate'],$_POST['tdate']);

if(count($result)>0){

        $i=0;
        $j=0;
        $output=array();
        foreach ($result as $key => $value) {
                  $category_name = $obj1->get_category($value['expenses_category']);
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


            $output[$j] = [$i,$date,$value['branch_name'],$category_name[0]['name'],$value['expenses_name'],$total_expenses,'<button style="margin-right: 20px"; type="button"  class="btn '.$btn_color.'" data-id="'.$value['id'].'" data-form="'.$value['name'].'" onclick="edit_modal(this);">Edit</button> 
               <button style="margin-right: 20px"; type="button"   class="btn btn-danger" data-id="'.$value['id'].'" onclick="del_btn(this);">Delete</button>'];       

                 
          $j++;
  
        }
}else{


      $output[$j] = ["No Data Found"];

}

echo json_encode($output);
?>
