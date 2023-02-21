<?php 
include '../tables/config.php';
// error_reporting(E_ALL);

$obj = new CustomerSale();
$obj1 = new Customers();
$out=array();
$out1=array();


$result = $obj->branch_sale_customer_dt($_POST['fdate'],$_POST['tdate']);

// print_r($result);die();
if(count($result)>0){

        $i=0;
        $j=0;
        $total = 0;
        $output=array();
        foreach ($result as $key => $value) {
                  

                  $result = $obj1->customer_dt($value['customer_id']);
                  $date = date('d-m-Y',strtotime($value['created_at']));
            $i++;
            $output[$j] = [$i,$date,$result[0]['name'],$result[0]['customer_code'],$value['grand_total'],'<button type="button"  class="btn btn-info" data-id="'.$value['sale_id'].'" data-date="'. $date.'" data-branch="'.$value['branch_id'].'" onclick="view_details(this);">View Details</button>'];       
     
                 $total+=($value['grand_total']);
          $j++;
         
        }
            
     
}else{


      $output[$j] = ["No Data Found"];

}

$out = $output;
$out1 = number_format($total,2,'.','');
$result3 = ['out'=>$out,'out1'=>$out1];
echo json_encode($result3);

?>