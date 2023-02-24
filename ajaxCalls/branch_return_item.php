<?php
include '../tables/config.php';
 
// error_reporting(E_ALL);
 $obj = new ReturnItems();
 $obj1 = new  Shops();

$result = $obj->get_return_from();
$result2 = $obj->get_return_to();
 

 
 
$output=array();
$output1 =array();
$output3=array();


if (count($result)>0) {
	$i=0;
	$j=0;
	 foreach ($result as $key => $value) {

           $frm_branch = $obj1->get_return_branch($value['branch_id']);
           $qty = $obj->get_return_qty($value['id']);
	 	
	 	$date = date('d-m-Y',strtotime($value['return_date']));
	 	$i++;
			$output[$j] =[$i,$date,$frm_branch[0]['name'],$qty[0]['qty'],'<button type="button" id="'.$value['id'].'" class="btn btn-primary btn-sm" onclick="detail_return('.$value['id'].')">Details</button>'];
               $j++;
  
          }




		}

		if (count($result2)>0) {
	$i=0;
	$k=0;
	 foreach ($result2 as $key => $value) {

           $to_branch = $obj1->return_to_branch($value['tbranch_id']);
           $qty = $obj->get_return_qty($value['id']);
	 	
	 	$date = date('d-m-Y',strtotime($value['return_date']));
	 	$i++;
			$output1[$k] =[$i,$date,$to_branch[0]['name'],$qty[0]['qty'],'<button type="button" id="'.$value['id'].'" class="btn btn-primary btn-sm" onclick="detail_return('.$value['id'].')">Details</button>'];
               $k++;
  
          }




		}



$output3=['res'=>$output,'res1'=>$output1];
          


echo json_encode($output3);

?>