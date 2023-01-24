<?php 

include '../tables/config.php';


$obj = new ReturnItems();
$obj1 = new Shops();

$result = $obj->get_return_details($_GET['id']);
$name = $obj1->item_frm_branch($result[0]['branch_id']); 


$name1 = $obj1->item_to_branch($result[0]['tbranch_id']);





?>

<div class="container-fluid">
	<div class="form-row">
		<div class="form-group col-lg-12">
			<input type="hidden" name="po_id" id="po_id" value="<?=$result[0]['id']?>">
		<h4>Return Details<button type='button' class='close text-danger font-weight-bold' data-dismiss='modal'>&times;</button></h4></div></div>
		<div class="form-row">
		<div class="form-group col-lg-1">From</div><div class="form-group col-lg-5">: 
			<span class="font-weight-bold"><?=$name['name']?></span>
		</div>
		<!-- <div class="form-group col-lg-1">&nbsp;</div> -->
		<!-- <div class="form-group col-lg-3">Branch Name</div><div class="form-group col-lg-3">: 
			<span class="font-weight-bold"><?=$result1[0]['name']?></span>
		</div> -->
		<div class="form-group col-lg-1">To</div><div class="form-group col-lg-5">: <span class="font-weight-bold"><?=$name1['name']?></span></div>
		<div class="form-group col-lg-1">Date</div><div class="form-group col-lg-5">: <span class="font-weight-bold"><?=date('d-m-Y',strtotime($result[0]['created_at']))?></span></div>
	</div>
	<hr>
	<!-- End Of Purchase Details -->
	

		
		<div class="form-row">
   <div class="form-group col-lg-12">
		<h4>Return Product Details</h4></div></div>
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
                </tr>
              </thead>
              <tbody class="text-center" id="tdata">
                

              	<?php foreach($result as $item){


                 

                 


?>
              	<tr class=" border-dark line_1">
                    <td style="width:30px" class="border-center-0" ><?php echo $sno; ?></td>
                    
                    <td class="text-left" style="width:30px"><?php echo strtoupper($item['item_name']); ?></td>
                    <?php if($item['var_name']!=''){?>
                    <td class="text-left" style="width:30px"><?php echo strtoupper($item['var_name']); ?></td>
                <?php }else{?>
                     <td class="text-left" style="width:30px">-</td>

                <?php } ?> 	
                   
                 <td style="width:30px" class="text-center"><?php echo $item['qty']; ?></td>
                
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