<?php 

include '../tables/config.php';

$obj = new Items();
$obj1 = new Shops();
$result = $obj->get_branch_items();

if(count($result)){

       $i=0;
       $j=0;
       $output = array();

       foreach ($result as $key => $value) {
       	 $i++;

                 $name = $obj1->get_shop_name($value['branch_id']);
       	  
       	   $output[$j] = [$i,$name[0]['name'],$name[0]['branch_code'],$value['qty'],' <button type="button" class="btn btn-primary" data-id="'.$value['branch_id'].'" onclick="view_stock_item(this);">View</button>'];
               

         $j++;


       }

          
}



echo json_encode($output);




?>