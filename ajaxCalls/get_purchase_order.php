<?php
include '../tables/config.php';
 

 $obj = new PurchaseOrder();
  $obj1 = new BranchSale();
 $result =  $obj->get_purchase_orders();
 // print_r($result);die();

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
		$get_sale = $obj1->get_bill_no($value['branch_id'],$value['id']);
		$item_qty = $obj->get_item_qty($value['id']);

		// print_r($get_sale);die();
		if ($value['order_type']!='RECEIVED') {


			if($value['order_type']=='NEW')
			{


			$editbtn = '<button type="button" id="'.$value['id'].'" class="btn btn-default btn-sm" onclick="edit_detail_page('.$value['id'].')" data-toggle="tooltip" data-placement="top" title="Edit Order"><span class="glyphicon glyphicon-pencil"><i class="fas fa-edit"></i></span></button>';
			$rec_order_edit='';

			}
			else
			{
			$editbtn = '';	
			  $rec_order_edit='<button type="button" id="'.$value['id'].'" class="btn btn-primary btn-sm" onclick="edit_rec_order	('.$value['id'].')" data-toggle="tooltip" data-placement="top" title="Edit Order">Received Order Edit</button>';
			}	
			if(count($get_sale)>0 && $_SESSION['type']!="ADMIN"){

                $new_details = '<button type="button" id="'.$value['id'].'" class="btn btn-default btn-sm" onclick="new_detail_page('.$value['id'].')" data-toggle="tooltip" data-placement="top" title="Received Order"><span class="glyphicon glyphicon-eye"><i class="fas fa-upload"></i></span></button>';
                $editbtn1 = '';	
                if($value['order_type']=='NEW'){
                $color = '<span style="color:red;">New Arrivals!</span>';
            }else{
            	$color='';
            }

			}else{

                $new_details = '';
                $editbtn1 = '<button type="button" id="'.$value['id'].'" class="btn btn-default btn-sm" onclick="edit_detail_page('.$value['id'].')" data-toggle="tooltip" data-placement="top" title="Edit Order"><span class="glyphicon glyphicon-pencil"><i class="fas fa-edit"></i></span></button>';
               $color='';
                  
			}



          if($_SESSION['type']=='ADMIN'){
			$output [$j] =[$i,'<a  href= modify_purchase_order_view.php?id='.$value['id'].' id="'.$value['id'].'" >'.$value["purchase_no"].'</a>',($vendor_dt['name'].' - '. $vendor_dt['vendor_code']),$value['discount_amt'],$value['tax_amt'],$value['grand_total'],$value['paid_amt'],$value['balance_amt'],$value['order_type'],'<button type="button" id="'.$value['id'].'" class="btn btn-default btn-sm" onclick="new_detail_page('.$value['id'].')" data-toggle="tooltip" data-placement="top" title="Received Order"><span class="glyphicon glyphicon-eye"><i class="fas fa-upload"></i></span></button> '.$editbtn.' <button type="button" id="'.$value['id'].'" class="btn btn-default btn-sm" onclick="new_detail_modal('.$value['id'].')" data-toggle="tooltip" data-placement="top" title="View Purchase Details"><span class="glyphicon glyphicon-eye"><i class="fas fa-eye"></i></span></button> <button type="button" id="'.$value['id'].'" class="btn btn-default btn-sm" onclick="print_page('.$value['id'].')" data-toggle="tooltip" data-placement="top" title="Print"><span class="glyphicon glyphicon-eye"><i class="fas fa-print"></i></span></button>' .$rec_order_edit];
		}else{
            $output [$j] =[$i,'<a  href= modify_purchase_order_view.php?id='.$value['id'].' id="'.$value['id'].'" >'.$value["purchase_no"].'</a>',$item_qty[0]['qty'],$item_qty[0]['received_qty'],$value['order_type'],''.$new_details.''.$editbtn1.'<button type="button" id="'.$value['id'].'" class="btn btn-default btn-sm" onclick="new_detail_modal('.$value['id'].')"><span class="glyphicon glyphicon-eye"><i class="fas fa-eye"></i></span></button> <button type="button" id="'.$value['id'].'" class="btn btn-default btn-sm" onclick="print_page('.$value['id'].')"><span class="glyphicon glyphicon-eye"><i class="fas fa-print"></i></span></button>'.$color];


		       }
		}else{
			if ($value['order_orgin']=='NEW') {
				if($_SESSION['type']=='ADMIN'){
				$btn='<button type="button" id="'.$value['id'].'" class="btn btn-default btn-sm" onclick="new_detail_modal('.$value['id'].')"><span class="glyphicon glyphicon-eye"><i class="fas fa-eye"></i></span></button>';
				$rec_order_edit='<button type="button" id="'.$value['id'].'" class="btn btn-primary btn-sm" onclick="edit_rec_order	('.$value['id'].')" data-toggle="tooltip" data-placement="top" title="Edit Order">Order Edit</button>';
				
			}else{
               $btn='<button type="button" value="'.$value['branch_id'].'" class="btn-small btn-primary" data-id="'.$value['id'].'"" onclick= "order_detail(this);">View</button>';

			     }
			}else{
				$btn='<button type="button" id="'.$value['id'].'" class="btn btn-default btn-sm" onclick="detail_modal('.$value['id'].')"><span class="glyphicon glyphicon-eye"><i class="fas fa-eye"></i></span></button>';
				$rec_order_edit='';

			}
			if($_SESSION['type']=='ADMIN'){
				$output [$j] =[$i,'<a  href= modify_purchase_order_view.php?id='.$value['id'].' id="'.$value['id'].'" >'.$value["purchase_no"].'</a>',$value['bill_no'],($vendor_dt['name'].' - '. $vendor_dt['vendor_code']),date('d-m-Y',strtotime($value['received_date'])),$value['discount_amt'],$value['tax_amt'],$value['grand_total'],$value['paid_amt'],$value['balance_amt'],$value['status'],''.$btn.''.$rec_order_edit];

			}else{

                $output [$j] =[$i,'<a  href= modify_purchase_order_view.php?id='.$value['id'].' id="'.$value['id'].'" >'.$value["purchase_no"].'</a>',date('d-m-Y',strtotime($value['received_date'])),$value['grand_total'],$btn];



			}
			
		}
		
		$j++;
	}
	
}

$main = $output;
echo json_encode($main);

?>