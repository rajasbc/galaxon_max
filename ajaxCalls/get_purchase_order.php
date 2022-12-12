<?php
include '../tables/config.php';
 

 $obj = new PurchaseOrder();
 $result =  $obj->get_purchase_orders();
 // print_r($result);die();
 $vendor_obj=new Vendors();
$output=array();
$main=array();

if (count($result)>0) {
	$i=0;
	$j=0;
	foreach ($result as $key => $value) {

		$i++;
		$vendor_dt=$vendor_obj->get_vendor_dt($value['vendor_id']);
		if ($value['order_type']!='RECEIVED') {

			if($value['order_type']=='NEW')
			{
			$editbtn = '<button type="button" id="'.$value['id'].'" class="btn btn-default btn-sm" onclick="edit_detail_page('.$value['id'].')"><span class="glyphicon glyphicon-pencil"><i class="fas fa-edit"></i></span></button>';
			}
			else
			{
			$editbtn = '';	
			}

          if($_SESSION['type']=='ADMIN'){
			$output [$j] =[$i,'<a  href= modify_purchase_order_view.php?id='.$value['id'].' id="'.$value['id'].'" >'.$value["purchase_no"].'</a>',($vendor_dt['name'].' - '. $vendor_dt['vendor_code']),$value['discount_amt'],$value['tax_amt'],$value['grand_total'],$value['paid_amt'],$value['balance_amt'],$value['order_type'],'<button type="button" id="'.$value['id'].'" class="btn btn-default btn-sm" onclick="new_detail_page('.$value['id'].')"><span class="glyphicon glyphicon-eye"><i class="fas fa-upload"></i></span></button> '.$editbtn.' <button type="button" id="'.$value['id'].'" class="btn btn-default btn-sm" onclick="new_detail_modal('.$value['id'].')"><span class="glyphicon glyphicon-eye"><i class="fas fa-eye"></i></span></button> <button type="button" id="'.$value['id'].'" class="btn btn-default btn-sm" onclick="print_page('.$value['id'].')"><span class="glyphicon glyphicon-eye"><i class="fas fa-print"></i></span></button>'];
		}else{
              $output [$j] =[$i,'<a  href= modify_purchase_order_view.php?id='.$value['id'].' id="'.$value['id'].'" >'.$value["purchase_no"].'</a>',$value['discount_amt'],$value['tax_amt'],$value['grand_total'],$value['paid_amt'],$value['balance_amt'],$value['order_type'],'<button type="button" id="'.$value['id'].'" class="btn btn-default btn-sm" onclick="new_detail_page('.$value['id'].')"><span class="glyphicon glyphicon-eye"><i class="fas fa-upload"></i></span></button> '.$editbtn.' <button type="button" id="'.$value['id'].'" class="btn btn-default btn-sm" onclick="new_detail_modal('.$value['id'].')"><span class="glyphicon glyphicon-eye"><i class="fas fa-eye"></i></span></button> <button type="button" id="'.$value['id'].'" class="btn btn-default btn-sm" onclick="print_page('.$value['id'].')"><span class="glyphicon glyphicon-eye"><i class="fas fa-print"></i></span></button>'];


		       }
		}else{
			if ($value['order_orgin']=='NEW') {
				$btn='<button type="button" id="'.$value['id'].'" class="btn btn-default btn-sm" onclick="new_detail_modal('.$value['id'].')"><span class="glyphicon glyphicon-eye"><i class="fas fa-eye"></i></span></button>';
			}else{
				$btn='<button type="button" id="'.$value['id'].'" class="btn btn-default btn-sm" onclick="detail_modal('.$value['id'].')"><span class="glyphicon glyphicon-eye"><i class="fas fa-eye"></i></span></button>';
			}
			$output [$j] =[$i,$value['purchase_no'],$value['bill_no'],($vendor_dt['name'].' - '. $vendor_dt['vendor_code']),date('d-m-Y',strtotime($value['received_date'])),$value['discount_amt'],$value['tax_amt'],$value['grand_total'],$value['paid_amt'],$value['balance_amt'],$value['status'],$btn];
		}
		
		$j++;
	}
	
}

$main = $output;
echo json_encode($main);

?>