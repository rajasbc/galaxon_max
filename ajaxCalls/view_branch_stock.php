<?php 

include '../tables/config.php';

// print_r($_POST);die();

$obj = new Items();
$obj1 = new Shops();
$result = $obj->get_branch_items($_POST['branch_id']);

if(count($result)){


       $i=0;
       $j=0;
       $output = array();

       foreach ($result as $key => $value) {
       	 $i++;

                 
       	  
       	   $output[$j] = [$i,$value['item_name'],$value['qty'],' <button type="button" class="btn btn-primary" value='.$value['branch_id'].' data-id="'.$value['item_id'].'" onclick="view_stock_item(this);">Variety</button>'];
               

         $j++;


       }
          
}else{

            $output[$j] = ["No Data Found"];
       }




echo json_encode($output);




?>