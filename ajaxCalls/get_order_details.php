<?php 

include '../tables/config.php';


$obj = new PurchaseOrder();
$result = $obj->order_details($_GET['id']);
// print_r($result);die();

$result1 = $obj->branch_code($result[0]['branch_id']);

$result2= $obj->get_purchase_no($_GET['id']);

// print_r($result2);die();

?>

<div class="container-fluid">
	<div class="form-row">
		<div class="form-group col-lg-12">
			<input type="hidden" name="po_id" id="po_id" value="<?=$result[0]['id']?>">
		<h4>Branch Order Details<button type='button' class='close text-danger font-weight-bold' data-dismiss='modal'>&times;</button></h4></div></div>
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
	
	<hr>
		<!-- End Of Vendor Details -->
		<div class="form-row">
   <div class="form-group col-lg-12">
		<h4>Purchase Product Details</h4></div></div>
		<div class="form-row">
		<div class="form-group col-lg-12">
			<?php $sno =1;
			?>
			 
           <table class="table text-center bill-table border-top border-bottom" id="bill-table" >
              <thead class="tablehead">
                <tr class="font-weight-bold" style="font-size:<?=$fontsize?>px">
                  <td>S.No</td>
                  <td class="text-left">Products</td>
                   <td class="text-left">Variety</td>
                  <td class="text-rigth">Quantity</td>
                   <td class="text-rigth">Rate</td>
                  <!--  <td class="text-rigth">Sale Price</td> -->
                    <td class="text-rigth">Discount(%)</td>
                  <!--  <td class="text-rigth">GST(%)</td> -->
                   <td class="text-rigth">GST(%)</td>
                
                   	<td class="text-rigth">Price<br>(excl.GST)</td>
                  
                 
                 
                  <td class="text-rigth">Total Amount</td>
                </tr>
              </thead>
              <tbody class="text-center" id="tdata">
                

              	<?php foreach($result as $item){


                  $res = $obj->get_discount($result[0]['purchase_id']);
                  
                  $total_amount = $item['total']+$item['tax_amt'];


                 


?>
              	<tr class=" border-dark line_1">
                    <td style="width:30px" class="border-center-0" ><?php echo $sno; ?></td>
                    
                    <td class="text-left" style="width:30px"><?php echo strtoupper($item['item_name']); ?></td>
                    <td class="text-left" style="width:30px"><?php echo strtoupper($item['var_name']); ?></td>
                   
                 <td style="width:30px" class="text-center"><?php echo $item['qty']; ?></td>
                 <td style="width:30px"><?php echo ($item['mrp']); ?></td>
                 <!--  <td style="width:30px"><?php echo ($item['sales_price']); ?></td> -->
                <td style="width:30px"><?php echo $item['discount']; ?></td>

                  <td style="width:30px" class="text-center"><?php echo $item['gst']; ?></td>
                  <!--  <td style="width:30px" class="text-center"><?php echo $res[0]['tax_amt']; ?></td>
                     -->
                   <td style="width:30px" class="text-center"><?php echo $item['total']; ?></td>
                   
                   
                  
                    <td style="width:30px" ><?php echo $total_amount; ?>
                    
                    </td>
                  </tr>
                  <?php $sno++;


              }
                  ?>
              </tbody></table> 
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
	
<div>