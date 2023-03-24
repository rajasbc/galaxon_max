<?php 
include '../tables/config.php';
// error_reporting(E_ALL);
$obj = new CustomerSale();
$obj1 = new  Shops();

if($_POST['item_id']!=0 && $_POST['item_id']!=''){

$items_data = $obj->get_collection_item_name();
}else{

$items_data = $obj->get_branch_collection();
}

$out=array();
$out1=array();
if(count($items_data)>0){
        $i=0;
        $j=0;
        $total = 0;
        $output=array();
foreach ($items_data as $key => $value) {
	      $result = $obj1->get_shop_name($value['branch_id']);

	              
	      
                  $date = date('d-m-Y',strtotime($value['created_at']));
                
	  $i++;
	    if($_POST['item_id']==0){
	    	$output[$j] = [$i,$date,$result[0]['name'],$result[0]['branch_code'],$value['grand_total'],'<button type="button"  class="btn btn-info" data-id="'.$value['sale_id'].'" data-date="'. $date.'" data-branch="'.$value['branch_id'].'" onclick="view_details(this);">View Details</button>'];       
            }else{
                $output[$j] = [$i,$date,$result[0]['name'],$result[0]['branch_code'],   	$value['total'],'<button type="button"  class="btn btn-info" data-id="'.$value['sale_id'].'" data-date="'. $date.'" data-branch="'.$value['branch_id'].'"  data-item="'.$value['item_id'].'" onclick="view_item_details(this);">View Details</button>']; 

            }      
     
                
          $j++;
         if($_POST['item_id']==0){
          $total+=($value['grand_total']);
      }else{

      	  $total+=($value['total']);
      }



}

}else{

 $output[$j] = ["No Data Found"];
}
$out = $output;
$out1 = number_format($total,2,'.','');
$result3 = ['out'=>$out,'out1'=>$out1];
echo json_encode($result3);


?>