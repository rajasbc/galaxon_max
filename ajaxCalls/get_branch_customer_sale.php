<?php 
include '../tables/config.php';


$obj = new CustomerSale();
$obj1 = new  Shops();
$result = $obj->get_collection($_POST['fdate'],$_POST['tdate'],$_POST['branch_id']);
$out=array();
$out1=array();

// print_r($result);die();

if(count($result)>0){

        $i=0;
        $j=0;
        $total = 0;
        $output=array();
        foreach ($result as $key => $value) {
                  

                  $result = $obj1->get_shop_name($value['branch_id']);
                  $date = date('d-m-Y',strtotime($value['created_at']));
            $i++;
            $output[$j] = [$i,$date,$result[0]['name'],$result[0]['branch_code'],$value['grand_total'],'<button type="button"  class="btn btn-info" data-id="'.$value['sale_id'].'" data-date="'. $date.'" data-branch="'.$value['branch_id'].'" onclick="view_details(this);">View Details</button>'];       
     
                
          $j++;
          $total+=($value['grand_total']);
        }
            
     
}else{


      $output[$j] = ["No Data Found"];

}


$out = $output;
$out1 = number_format($total,2,'.','');
$result3 = ['out'=>$out,'out1'=>$out1];
echo json_encode($result3);

?>