<?php 
include '../tables/config.php';

$fdate=$_POST['fdate'];
$tdate=$_POST['tdate'];
$branch_id=$_POST['branch_id'];

$obj = new BranchSale();
$obj1 = new Shops();
$get_branch = $obj->get_transaction($fdate,$tdate,$branch_id);


if(count($get_branch)>0){

        $i=0;
        $j=0;
        $output=array();
        foreach ($get_branch as $key => $value) {

                  $result = $obj1->get_shop_name($value['branch_id']);
            $i++;
            $output[$j] = [$i,$result[0]['name'],$result[0]['branch_code'],$value['bill_no']];       

                 
          $j++;
  
        }
}else{


      $output[$j] = ["No Data Found"];

}

echo json_encode($output);

?>