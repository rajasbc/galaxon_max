<?php
include '../tables/config.php';

 $obj = new Items();

 $result =  $obj->get_items_data();
$output=array();
$main=array();

if (count($result)>0) {
	$i=0;
	$j=0;
	foreach ($result as $key => $value) {
		$i++;
		$result1 = $obj->get_item_brand($value['id']);
		if($result1['brand_name']==''){
			$brand_name = '-';
		}else{
			$brand_name = $result1['brand_name'];
		}
		if($result1['cat_name']==''){
             $cat_name='-';
		}else{
			 $cat_name=$result1['cat_name'];
		}
		if($result1['desc_name']==''){
              $desc_name='-';

		}else{
			$desc_name=$result1['desc_name'];
		}
		$output [$j] =[$i,$value['item_name'],$brand_name, $cat_name,$desc_name,$value['mrp'],$value['sales_price'],$value['discount'],$value['gst'],$value['qty'],'<button type="button" class="btn btn-primary" data-id="'.$value['id'].'" onclick="add_varities(this);">View</button>','<button type="button" class="btn btn-primary" data-id="'.$value['id'].'" data-form="'.$value['item_name'].'" data-form1="'.$value['mrp'].'" data-form2="'.$value['sales_price'].'"  data-form3="'.$value['discount'].'" data-form4="'.$value['gst'].'" data-form5="'.$value['qty'].'" data-form6="'.$value['brand'].'" data-form7="'.$value['category'].'" data-form10="'.$value['group_id'].'" data-form8="'.$value['sub_category'].'" data-form9="'.$value['units'].'" onclick="edit_modal(this);">Edit</button> <button type="button" class="btn btn-danger" data-id="'.$value['id'].'" onclick="delete_modal(this);">Delete</button>'];
		$j++;
	}
	
}

$main = $output;
echo json_encode($main);
?>