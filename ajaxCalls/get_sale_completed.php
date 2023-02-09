<?php 

include '../tables/config.php';

$obj = new BranchSale();
$obj1 = new Shops();
$result = $obj->get_branch_sale();

// print_r($result);die();


$output=array();


if(count($result)>0){
  $i=0;
  $j=0;
 foreach ($result as $key => $value) {
         $result1 = $obj->branch_sale_item($value['po_id'],$value['branch_id']);

         $branch_name = $obj1->get_salebranch_name($value['branch_id']);
 	$i++;

 	
 	$output[$j]=[$i,$value['purchase_no'],$branch_name['name'].'-'.$branch_name['branch_code'],$value['total_qty'],$result1[0]['qty'],'<button type="button" value="'.$value['branch_id'].'" class="btn-small btn-primary" data-id="'.$value['po_id'].'"" onclick= "order_detail(this);">View</button>'];
 	
$j++;
 }


}

echo json_encode($output);
?>