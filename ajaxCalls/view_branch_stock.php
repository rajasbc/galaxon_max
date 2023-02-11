<?php 

include '../tables/config.php';

// print_r($_POST);die();

$obj = new Items();
$obj1 = new Shops();
$result = $obj->get_branch_items($_POST['branch_id']);

// print_r($result);die();
if(count($result)){


 $i=0;
 $j=0;
 $output = array();
 $total = 0;

 foreach ($result as $key => $value) {
  $i++;
  // $net_worth = $value['qty']*$value['mrp'];


  $output[$j] = [$i,$value['item_name'],$value['qty'],' <button type="button" class="btn btn-primary" value='.$value['branch_id'].' data-id="'.$value['item_id'].'" onclick="view_stock_item(this);">Variety</button>'];

  // $total+=$net_worth;

  $j++;


 }

 // $output[$j] = ['','',"Net Worth",$total,''];

}else{

 $output[$j] = ["No Data Found"];
}




echo json_encode($output);




?>