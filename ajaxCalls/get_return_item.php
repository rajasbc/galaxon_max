<?php
include '../tables/config.php';
 

 $obj = new ReturnItems();
 $obj1 = new  Shops();


 $result =  $obj->get_item();

 // print_r($result);die();
 
$output=array();


if (count($result)>0) {
	$i=0;
	$j=0;
	 foreach ($result as $key => $value) {
	 	$name = $obj1->item_frm_branch($value['branch_id']); 
	 	$name1 = $obj1->item_to_branch($value['tbranch_id']);
	 	$qty = $obj->return_qty($value['id']);
	 

	 	$i++;

			$output[$j] =[$i,($name['name'].'-'.$name['branch_code']),($name1['name'].'-'.$name1['branch_code']),$qty[0]['qty'],$value['return_date'],'<button type="button" id="'.$value['id'].'" class="btn btn-primary btn-sm" onclick="detail_return('.$value['id'].')">Details</button>'];
               $j++;
  
          }




		}

          


echo json_encode($output);

?>