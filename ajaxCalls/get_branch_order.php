<?php 

include '../tables/config.php';

// error_reporting(E_ALL);
$obj = new PurchaseOrder();
$obj2 = new BranchSale();
$result = $obj->get_order();
// print_r($result);die();

// $result1 = $obj->request_order();
// $i=0;
// foreach ($result1 as $key => $value) {
//   // print_r($value);
//   // $i++;
//  $result3 = $obj->get_sale_order($value['id']);


// if(count($result3)==0)
// {
//   $i++;
// }

// }
// print_r($result);die();


$output=array();


if(count($result)>0){
  $i=0;
  $j=0;
 foreach ($result as $key => $value) {
         $result1 = $obj->branch_name($value['id']);
          
         $result2 = $obj2->get_bill_no($value['branch_id'],$value['id']);
      
         $result3 = $obj->get_request_order($value['id']);
 	$i++;
  if(count($result2)>0){
     
       $color = '<span style="color:red;"> Quantity Transfer!</span>';

  }else{
       $color ='';
  }

 	if(count($result3)>0 && $result3[0]['po_id']==''){

     $details_btn='<button type="button" value="'.$value['branch_id'].'" class="btn-small btn-warning" data-id="'.$value['id'].'"" onclick= "order_detail(this);">Details</button>'; 

      $sale_btn = '<button type="button" style="
    margin-left: 10px;" value='.$value['branch_id'].' class="btn-small btn-warning" data-id="'.$value['id'].'"" onclick= "sale_detail(this);">Sale</button>';
      
 	}else{
     $details_btn='<button type="button" value="'.$value['branch_id'].'" class="btn-small btn-primary" data-id="'.$value['id'].'"" onclick= "order_detail(this);">Details</button>'; 
      $sale_btn = '<button type="button" style="
    margin-left: 10px;" value='.$value['branch_id'].' class="btn-small btn-primary" data-id="'.$value['id'].'"" onclick= "sale_detail(this);">Sale</button>';

 	}

 	// if(count($result2)>0 && $value['order_type']=='RECEIVED'){
          
  //            $sale_btn = '';
         
 	// }else{

         
 	// }
 	$output[$j]=[$i,$value['purchase_no'],($result1[0]['name'].'-'.$result1[0]['branch_code']),date('d-m-Y',strtotime($value['created_at'])),$value['order_type'],''.$details_btn.''.$sale_btn.''.$color];
 	
$j++;
 }


}

echo json_encode($output);
?>