<?php
include '../tables/config.php';

$obj = new PurchaseOrder();
$result =  $obj->get_shipping($_GET['id']);


?>

<div class="container-fluid">
	<div class="form-row">
		<div class="form-group col-lg-12">
			<input type="hidden" name="id" id="id" value="<?=$result[0]['id']?>">
		<h4>Shipping Details<button type='button' class='close text-danger font-weight-bold' data-dismiss='modal'>&times;</button></h4></div></div>
		<div class="form-row">
		<!-- <div class="form-group col-lg-3">Purchase Order Id</div><div class="form-group col-lg-3">: 
			<span class="font-weight-bold"><?=$result[0]['po_id']?></span>
		</div> -->
		<!-- <div class="form-group col-lg-1">&nbsp;</div> -->
		<!-- <div class="form-group col-lg-3">Delivery Date</div><div class="form-group col-lg-3">: <span class="font-weight-bold"><?=date('d-m-Y',strtotime($result[0]['delivery_date']))?></span></div> -->
	</div>
	<hr>
	<!-- End Of Purchase Details -->
	<div class="form-row">
   <div class="form-group col-lg-12">
	<!-- 	<h4>Vendor Details</h4></div></div> -->
		<div class="form-row">
		<div class="form-group col-lg-6">Name</div><div class="form-group col-lg-6">: 
			<span class="font-weight-bold"><?=strtoupper($result[0]['name'])?></span>
		</div>
		<!-- <div class="form-group col-lg-1">&nbsp;</div> -->
		<div class="form-group col-lg-6">Mobile No</div><div class="form-group col-lg-6">: 
			<span class="font-weight-bold"><?=$result[0]['mobile_no']?></span>
		</div>
		<div class="form-group col-lg-6">Company Name</div><div class="form-group col-lg-6">: <span class="font-weight-bold"><?=strtoupper($result[0]['company_name'])?></span></div>
		<div class="form-group col-lg-6">Email</div><div class="form-group col-lg-6">: <span class="font-weight-bold"><?=strtoupper($result[0]['email'])?></span></div>
		<div class="form-group col-lg-6">Gst.No</div><div class="form-group col-lg-6">: <span class="font-weight-bold"><?=strtoupper($result[0]['gst_no'])?></span></div>
		<div class="form-group col-lg-6">Address</div><div class="form-group col-lg-6">: <span class="font-weight-bold"><?=strtoupper($result[0]['address'])?></span></div>
		<div class="form-group col-lg-6">City</div><div class="form-group col-lg-6">: <span class="font-weight-bold"><?=strtoupper($result[0]['city'])?></span></div>
		<div class="form-group col-lg-6">State</div><div class="form-group col-lg-6">: <span class="font-weight-bold"><?=strtoupper($result[0]['state'])?></span></div>
		<div class="form-group col-lg-6">Country</div><div class="form-group col-lg-6">: <span class="font-weight-bold"><?=strtoupper($result[0]['country'])?></span></div>
		<div class="form-group col-lg-6">Pincode</div><div class="form-group col-lg-6">: <span class="font-weight-bold"><?=strtoupper($result[0]['pincode'])?></span></div>
		<div class="form-group col-lg-6">Shipping Terms</div><div class="form-group col-lg-6">: <span class="font-weight-bold"><?=strtoupper($result[0]['shipping_terms'])?></span></div>
		<div class="form-group col-lg-6">Shipping Method</div><div class="form-group col-lg-6">: <span class="font-weight-bold"><?=strtoupper($result[0]['method'])?></span></div>

		<!-- <?php if ($vendor_dt['email']!='') { ?>
		<div class="form-group col-lg-3">Email</div><div class="form-group col-lg-3">: <span class="font-weight-bold"><?=$vendor_dt['email']?></span></div>
	<?php }?> -->
	</div>
	<hr>
		<!-- End Of Vendor Details -->
		
