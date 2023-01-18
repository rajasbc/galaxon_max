<?php 

include '../tables/config.php';

// print_r($_POST);die();

$obj = new CustomerSale();

$result = $obj->get_top_sale($_POST['branch_id']);

if(count($result)){


       $i=0;
       $j=0;
       $output = array();

       foreach ($result as $key => $value) {
       	 $i++;

        if($value['var_id']!= 0){
       	  
       	   $output[$j] = [$i,$value['item_name'].'-'.$value['var_name'],$value['qty']];

            }else{

               $output[$j] = [$i,$value['item_name'],$value['qty']];

            }
               

         $j++;


       }
          
}else{

            $output[$j] = ["No Data Found"];
       }




echo json_encode($output);




?>