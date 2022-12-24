<?php 

include '../tables/config.php';


$obj = new PurchaseOrder();
$obj2 = new BranchSale();
$result = $obj->get_order();

// print_r($result);die();


$output=array();


if(count($result)>0){
  $i=0;
  $j=0;
 foreach ($result as $key => $value) {
         $result1 = $obj->branch_name($value['id']);
         $result2 = $obj2->get_bill_no($value['branch_id'],$value['purchase_no']);
 	$i++;

 	if(count($result2)>0){
          
             $sale_btn = '';
         
 	}else{

          $sale_btn = '<button type="button" style="
    margin-left: 10px;" value='.$value['purchase_no'].' class="btn-small btn-primary" data-id="'.$value['id'].'"" onclick= "sale_detail(this);">Sale</button>';

 	}
 	$output[$j]=[$i,$value['purchase_no'],($result1[0]['name'].'-'.$result1[0]['branch_code']),date('d-m-Y',strtotime($value['created_at'])),$value['discount_amt'],$value['tax_amt'],$value['grand_total'],$value['paid_amt'],$value['balance_amt'],$value['order_type'],'<button type="button" class="btn-small btn-primary" data-id="'.$value['id'].'"" onclick= "order_detail(this);">Details</button>'  .$sale_btn];
 	
$j++;
 }


}

echo json_encode($output);
?>