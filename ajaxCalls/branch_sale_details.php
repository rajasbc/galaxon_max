<?php 

include '../tables/config.php';


$obj = new PurchaseOrder();
$obj1 = new BranchSale();
// $result = $obj->order_details($_GET['id'],$_GET['branch_id']);
$result = $obj1->get_amount_details($_GET['id'],$_GET['branch_id']);


$result1 = $obj->branch_code($result[0]['branch_id']);

$result2= $obj->get_purchase_no($_GET['id'],$_GET['branch_id']);
// $price_details = $obj1->get_amount_details($_GET['id'],$_GET['branch_id']);

// print_r($result2);die();

?>

<div class="container-fluid">
	<div class="form-row">
		<div class="form-group col-lg-12">
			<input type="hidden" name="po_id" id="po_id" value="<?=$result[0]['id']?>">
			<?php if($_SESSION['type']=='ADMIN'){ ?>
		<h4>Branch Order Details<button type='button' class='close text-danger font-weight-bold' data-dismiss='modal'>&times;</button></h4>
	<?php }else{ ?>
        <h4>Received Order Details<button type='button' class='close text-danger font-weight-bold' data-dismiss='modal'>&times;</button></h4>
  <?php } ?>		
	</div></div>
		<div class="form-row">
		<div class="form-group col-lg-3">Purchase No</div><div class="form-group col-lg-3">: 
			<span class="font-weight-bold"><?=$result2[0]['purchase_no']?></span>
		</div>
		<!-- <div class="form-group col-lg-1">&nbsp;</div> -->
		<div class="form-group col-lg-3">Branch Name</div><div class="form-group col-lg-3">: 
			<span class="font-weight-bold"><?=$result1[0]['name']?></span>
		</div>
		<div class="form-group col-lg-3">Branch Code</div><div class="form-group col-lg-3">: <span class="font-weight-bold"><?=$result1[0]['branch_code']?></span></div>
		<div class="form-group col-lg-3">Created Date</div><div class="form-group col-lg-3">: <span class="font-weight-bold"><?=date('d-m-Y',strtotime($result[0]['created_at']))?></span></div>
	</div>
	<hr>
	<!-- End Of Purchase Details -->
	

		<!-- End Of Vendor Details -->
		<div class="form-row">
   <div class="form-group col-lg-12">
		<h4>Purchase Product Details</h4></div></div>
		<div class="form-row">
		<div class="form-group col-lg-12">
			<?php $sno =1;
			?>
			 
         
              <table class="table">
				<thead>
					<tr>
						
						<th>S.No</th>
						<th>Product Name</th>
						<th>Variety Name</th>
						<?php if($_SESSION['type']=='ADMIN'){ ?>
						<th>Sale qty</th>
						<?php }else{?>
                        <th>Received qty</th>
						<?php } ?>		
						<th>Mrp</th>
						
						<th>Sale Price </th>
						<!-- <th>Discount</th>
						<th>GST</th> -->
						<th>Total Amount</th>
					</tr>
				</thead>
				<tbody>
				<?php
$i = 0;
foreach ($result as $key => $value) {
	
	
	$i=$i+1;
   $ttl=$value['total']+$value['tax_amount'];

echo "<tr>

<td>".$i."</td>

<td>".$value['item_name']."</td>
<td>".$value['var_name']."</td>
<td>".$value['qty']."</td>

<td>".$value['mrp']."</td>
<td>".$value['sale_price']."</td>

<td>".$ttl."</td>
</tr>";

}



				 ?>
				</tbody>
			</table>
             <!--  <table class="table">
				<thead>
					<tr>
						<th colspan="2">Taxable</th>
						<th>Tax</th>
						<th>Discount</th>
						<th colspan="2" class="text-center">Total Amount</th>
					</tr>
				</thead>
				<tbody>
				<tr>
						<th colspan="2"><?=$result[0]['taxable_amt']?></th>
						<th><?=$result[0]['tax_amt']?></th>
						<th><?=$result[0]['discount_amt']?></th>
						<th colspan="2" class="text-center"><?=$result[0]['grand_total']?></th>
					</tr>
				</tbody>
			</table> -->
		</div>
	</div>
	<hr>
		<!-- End Of Product Details -->
		
	
		<!-- End Of Paid Details -->
	
