<?php 
include '../tables/config.php';
$shop_obj = new Shops();
$shop_result = $shop_obj->get_user();
$shop_result1 = $shop_obj->get_shop_details();
$obj=new PurchaseOrder();
$purchase_order_dt=$obj->get_purchase_order(base64_decode($_GET['id']));
$purchase_order_item_dt=$obj->get_purchase_order_item(base64_decode($_GET['id']));
$purchase_order_shipping=$obj->get_purchase_order_shipping(base64_decode($_GET['id']));
$vendor_obj= new Vendors();
$vendor= $vendor_obj->get_vendor_dt($purchase_order_dt[0]['vendor_id']); 
$brand_obj = new Brand();
$brand =  $brand_obj->get_brand_data();
$description_obj = new Description();

$items=array();
$total_qty=0;
$total_ton=0;
$total_amount=0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta name="description" content="" />
<meta name="author" content="" />
<title id='tab_title'>GALAXON MAX</title>
<link rel="icon" type="image/x-icon" href="../dist/img/logo.png" />
<link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="nav-fixed">
<style type="text/css">

/* below CSS to print as A4 size */
.gst_fsize{
  font-size:10px !important;
  padding:0px !important;
}
.gst_fsize1{
  font-size:14px !important;
  padding:0px !important;
}
<?php if(count($purchase_order_shipping)==0){
 ?>
 .ship_cls{
  display: none;
 }
<?php }?>
.body {
margin: 0;
padding: 0;
background-color: #FAFAFA;
}
* {
box-sizing: border-box;
-moz-box-sizing: border-box;
}
.page {
font-size: 10px;
width: 21cm;
min-height: 37cm;
padding-left: 0.5cm;
padding-top: 0.5cm;
margin: 1cm auto;
border: 1px #D3D3D3 solid;
border-radius: 5px;
/*background: white;*/
/*background-image: url('../dist/img/invoice2.jpeg');*/
    background-size: 100% 109%;
    background-position-y: -116px;
    background-repeat: no-repeat;
box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}
.subpage {
padding: 1cm;
border: 5px #D3D3D3 solid;
height: 256mm;
outline: 2cm #FFEAEA solid;
}
@page {
size: A4;
margin: 0;
}
@media print {
table{
  background-color: transparent;
}
table,thead,tbody,tr,td,th{
  font-size: 18px;
}
/* body {zoom: 70%;}*/
.logo_class{
    max-height: 150px !important;
    height: 130px !important;
    width: 140px !important;
    max-width: 160px !important;
}
.page {
margin: 0;
border: 1px #D3D3D3 solid;
border-radius: 5px;
width: 25.5cm;
min-height: 37cm;
box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
/*background: initial;*/
/*background-image: url('../dist/img/invoice2.jpeg');*/
background-size: 100% 109%;
    background-position-y: -116px;
    background-repeat: no-repeat;
page-break-after: always;
}
@page {
size: A4;
margin: 0;
}

}
/* above CSS to print as A4 size */
.footer {
height: 0rem;
}
.bill-table,
.tax-table {
margin-bottom: 0;
}
.bill-table th, .bill-table td,
.tax-table th, .tax-table td {
padding: 0.2rem;
text-align: inherit;
border: inherit;
}
.container-fluid {
font-size: 10px;
width: 98%;
margin: 0;
/*height: 1180px;*/
}
.bill-table.large{
height: 600px;
}
.bill-table.medium{
height: 440px;
}
.bill-table tr.line_1 {
height: 30px;
line-height: 30px;
}
.shippingDetails {
font-size: 14px;
}
div.declaration_p p{
margin-bottom: 0px !important;
}
.hide_pkgs{display: none !important;}
.hide_gst {display: none !important;}
.hide_Gst {display: none !important;}
.hide_discount {display: none !important;}
.hide_unit {display: none !important;}
.hide_shipping {display: none !important;}
}
</style>
<style type="text/css">
    @media print {
      body {zoom: 100%;}
      * {
    -webkit-print-color-adjust: exact !important; /*Chrome, Safari */
    color-adjust: exact !important;  /*Firefox*/
  }
    }
    .declaration_p{
      /*height:120px !important;*/
    }
  </style>
<style type="text/css">
  .logo_class{
  max-height: 180px;
  height: 180px;
  width: 200px;
  max-width: 200px;
}
</style>
<style>
      .bill-table.large{
        height: 650px;
      }
    </style>
      <?php
 $numItemShow=21;
$arr_count=count($purchase_order_item_dt);
$next_page=$arr_count-$numItemShow;
$next_page=$next_page>0?$next_page:1;
$page_count=1+floor($next_page/$numItemShow);
// $start_index=0;
// $end_index=$numItemShow;

end($output);         
$last_index = count($purchase_order_item_dt);
$temp=0;
if (count($purchase_order_item_dt)<=$numItemShow) {
  $page_count=0;
}
$sno = 0;
$temp=0;
$start_index=0;
$end_index=$numItemShow;
$check=0;
for ($i1 = 0; $i1 <=$page_count; $i1++) {
  if ($page_count==$i1 && $check==0) {
    if (($last_index-$start_index)==16) {
    $end_index=16;
    $check=1;
  }
  if (($last_index-$start_index) > 16 || ($last_index-$start_index)<=23) {
    $end_index=16;
    $page_count++;
    $check=1;
  }
  
}
?>
<div>
<main>
<div class="page">
<div class="row">
<div class="col-sm-12 col-md-12 col-lg-12">
</div>
</div>

<div class="container-fluid ">
<div class="row ">
<div class="col-sm-12 col-md-12 col-lg-12 border border-dark">
<div class="row border-bottom border-dark" style="height: 145px;">
<div class="col-2 text-center" >
  <img src="../dist/img/logo.png" style="width: 17rem;position: absolute;bottom: -6rem;left: -1rem;"  >
</div>
<div class="col-10 mb-0 text-center">
  <div class="row d-flex justify-content-center " style="font-size: 16px !important;">
<b>Purchase Order</b>
</div>
<div class="col-12 text-center" style="font-size: 26px !important;"><b>GALAXON MAX PRIVATE LIMITED</b>
</div>
<!-- <br> -->
<div class="col-12 text-center" style="font-size: 14px;">NO 18/44(1),THAMPILAKSHMI ARCADE,CHITTUR,PALAKKAD-678101</div>

<div class="col-12 text-center" style="font-size: 14px;">Phone : 8438335415 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tele-Phone : 4923 356 006</div>
<div class="col-12 text-center" style="font-size: 14px;">Mail : info@galaxonmax.com</div>
<div class="col-12 text-center" style="font-size: 14px;font-weight: bold;">GSTIN : 32AAJCG9997N1ZL</div>
</div>
</div>
<?php if ($purchase_order_shipping[0]['shipping_terms']!='' || $purchase_order_shipping[0]['method']!='' || $purchase_order_shipping[0]['delivery_date']!='') {?>
<div class="row" >
  <?php }else{?>
    <div class="row" >
   <?php }?>

<!-- <div class="col-sm-6 col-md-6 col-lg-6" style="
                    padding-left: 25px;">
<div class="row" style="font-size:15px"><label><b>Vendor</b></label></div>
<div class="row" ><b>Name : <?=$vendor['name']?> - <?=$vendor['vendor_code']?></b></div>
<div class="row" ><b>Company Name : <?=$vendor['company_name']?></b></div>
<?php if ($vendor['address']!='' || $vendor['city']!='' || $vendor['state']!='' || $vendor['country']!='' || $vendor['pincode']!='') {?>
<div class="row" ><b>Address :    <?php 
if ($vendor['address']!='') {
   echo $vendor['address'];
}
if ($vendor['city']!='') {
   echo ','.$vendor['city'];
}
if ($vendor['state']!='') {
   echo ','.$vendor['state'];
}
if ($vendor['country']!='') {
   echo ','.$vendor['country'];
}
if ($vendor['pincode']!='') {
   echo ','.$vendor['pincode'];
}
    ?></b></div>
<?php }?>
<div class="row" ><b>Mobile.No : <?=$vendor['mobile_no']?></b></div>
<?php if ($vendor['email']!='') {?>
<div class="row" ><b>Email : <?=$vendor['email']?></b></div>
<?php }?>
<?php if ($vendor['gst']!='') {?>
<div class="row" ><b>GST No : <?=$vendor['gst']?></b></div>
<?php }?>

</div> -->
<div class="col-sm-6 col-md-6 col-lg-6 shippingDetails">
<div class="row">
<div class="col-12 border-left text-center  border-bottom border-dark" id="invoice_number">
<span class=""><b>Purchase No : </b></span>
<!-- $shippingDetails['invoice_number'] -->
<span class="text-val"><b><?=$purchase_order_dt[0]['purchase_no']?></b></span>
</div>
<!-- <div class="col-6 border-bottom border-dark" id="invoice_dated">
<span class=""><b>Purchase Date : </b></span>
<span class="text-val"><b><?=date('d-m-Y',strtotime($purchase_order_dt[0]['created_at']))?></b></span>
</div> -->
</div>
<div class="row">
<div class="col-12 border-left  border-bottom border-dark" id="buyers_dated">
<span class=""><b>Vendor Details</b></span>

</div>
<!-- <div class="col-6 border-bottom border-dark" id="delivery_note_date">
<span class="">Delivery Date : </span>

<span class="text-val">21-11-2022</span>
</div> -->
</div>
<div class="row">
<div class="col-4 border-left border-right border-bottom border-dark " id="buyers_order_no">
<span class="">Name </span>
<span class="text-val"></span>
</div>
<div class="col-8 border-bottom border-dark" id="motor_vehicle_no">
<span class="text-val"><?=$vendor['name']?> - <?=$vendor['vendor_code']?></span>
</div>
</div>
<div class="row">
<div class="col-4 border-left border-right border-bottom border-dark " id="buyers_order_no">
<span class="">Company Name </span>
<span class="text-val"></span>
</div>
<div class="col-8 border-bottom border-dark" id="motor_vehicle_no">
<span class="text-val"><?=$vendor['company_name']?></span>
</div>
</div>
<div class="row" style="height: 5rem;">
<div class="col-4 border-left border-right border-bottom border-dark " id="buyers_order_no">
<span class="">Address </span>
<span class="text-val"></span>
</div>
<div class="col-8 border-bottom border-dark" style="overflow-wrap: break-word;" id="motor_vehicle_no">
  <?php if ($vendor['address']!='' || $vendor['city']!='' || $vendor['state']!='' || $vendor['country']!='' || $vendor['pincode']!=''){?>
<span class="text-val"> <?php 
if ($vendor['address']!='') {
   echo $vendor['address'];
}
if ($vendor['city']!='') {
   echo ','.$vendor['city'];
}
if ($vendor['state']!='') {
   echo ','.$vendor['state'];
}
if ($vendor['country']!='') {
   echo ','.$vendor['country'];
}
if ($vendor['pincode']!='') {
   echo ','.$vendor['pincode'];
}
    ?></span>
<?php }?>
</div>
</div>
<div class="row">
<div class="col-4 border-left border-right border-bottom border-dark " id="buyers_order_no">
<span class="">Mobile.No </span>
<span class="text-val"></span>
</div>
<div class="col-8 border-bottom border-dark" id="motor_vehicle_no">
<span class="text-val"><?=$vendor['mobile_no']?></span>
</div>
</div>
<div class="row">
<div class="col-4 border-left border-right border-bottom border-dark " id="buyers_order_no">
<span class="">Email </span>
<span class="text-val"></span>
</div>
<div class="col-8 border-bottom border-dark" id="motor_vehicle_no">
<span class="text-val"><?=$vendor['email']?></span>
</div>
</div>
<div class="row">
<div class="col-4 border-left border-right border-dark " id="buyers_order_no">
<span class="">GST No </span>
<span class="text-val"></span>
</div>
<div class="col-8    border-dark" id="motor_vehicle_no">
<span class="text-val"><?=$vendor['gst']?></span>
</div>
</div>



</div>
<div class="col-sm-6 col-md-6 col-lg-6 shippingDetails">
<div class="row">

<div class="col-12 text-center border-left border-bottom border-dark" id="invoice_dated">
<span class=""><b>Purchase Date : </b></span>
<span class="text-val"><b><?=date('d-m-Y',strtotime($purchase_order_dt[0]['created_at']))?></b></span>
</div>
</div>
<div class="row">
<div class="col-12 border-left  border-bottom border-dark" id="buyers_dated">
<span class=""><b>Shipping Details</b></span>

</div>
<!-- <div class="col-6 border-bottom border-dark" id="delivery_note_date">
<span class="">Delivery Date : </span>

<span class="text-val">21-11-2022</span>
</div> -->
</div>
<div class="row">
<div class="col-4 border-left border-right border-bottom border-dark " id="buyers_order_no">
<span class="">Name </span>
<span class="text-val"></span>
</div>
<div class="col-8 border-bottom border-dark" id="motor_vehicle_no">
<span class="text-val"><?=$purchase_order_shipping[0]['name']?></span>
</div>
</div>
<div class="row">
<div class="col-4 border-left border-right border-bottom border-dark " id="buyers_order_no">
<span class="">Company Name </span>
<span class="text-val"></span>
</div>
<div class="col-8 border-bottom border-dark" id="motor_vehicle_no">
<span class="text-val"><?=$purchase_order_shipping[0]['company_name']?></span>
</div>
</div>
<div class="row" style="height: 5rem;">
<div class="col-4 border-left border-right border-bottom border-dark " id="buyers_order_no">
<span class="">Address </span>
<span class="text-val"></span>
</div>
<div class="col-8 border-bottom border-dark" style="overflow-wrap: break-word;" id="motor_vehicle_no">
  <?php if ($purchase_order_shipping[0]['address']!='' || $purchase_order_shipping[0]['city']!='' || $purchase_order_shipping[0]['state']!='' || $purchase_order_shipping[0]['country']!='' || $purchase_order_shipping[0]['pincode']!='') {?>
<span class="text-val"> <?php 
if ($purchase_order_shipping[0]['address']!='') {
   echo $purchase_order_shipping[0]['address'];
}
if ($purchase_order_shipping[0]['city']!='') {
   echo ','.$purchase_order_shipping[0]['city'];
}
if ($purchase_order_shipping[0]['state']!='') {
   echo ','.$purchase_order_shipping[0]['state'];
}
if ($purchase_order_shipping[0]['country']!='') {
   echo ','.$purchase_order_shipping[0]['country'];
}
if ($purchase_order_shipping[0]['pincode']!='') {
   echo ','.$purchase_order_shipping[0]['pincode'];
}
    ?></span>
<?php }?>
</div>
</div>
<div class="row">
<div class="col-4 border-left border-right border-bottom border-dark " id="buyers_order_no">
<span class="">Mobile.No </span>
<span class="text-val"></span>
</div>
<div class="col-8 border-bottom border-dark" id="motor_vehicle_no">
<span class="text-val"><?=$purchase_order_shipping[0]['mobile_no']?></span>
</div>
</div>
<div class="row">
<div class="col-4 border-left border-right border-bottom border-dark " id="buyers_order_no">
<span class="">Email </span>
<span class="text-val"></span>
</div>
<div class="col-8 border-bottom border-dark" id="motor_vehicle_no">
<span class="text-val"><?=$purchase_order_shipping[0]['email']?></span>
</div>
</div>
<div class="row">
<div class="col-4 border-left border-right border-dark " id="buyers_order_no">
<span class="">GST No </span>
<span class="text-val"></span>
</div>
<div class="col-8    border-dark" id="motor_vehicle_no">
<span class="text-val"><?=$purchase_order_shipping[0]['gst_no']?></span>
</div>
</div>



</div>
</div>
</div>
</div>
<?php if ($purchase_order_shipping[0]['shipping_terms']!='' || $purchase_order_shipping[0]['method']!='' || $purchase_order_shipping[0]['delivery_date']!='') {?>
<div class="row border-top border-left border-right border-dark shippingDetails">
  <div class="col-4 border-right border-dark">
    <label>Shipping Terms</label>
    <p><?=$purchase_order_shipping[0]['shipping_terms']?></p>
  </div>
  <div class="col-4 border-right border-dark">
    <label>Shipping Method</label>
    <p><?=$purchase_order_shipping[0]['method']?></p>
  </div>
  <div class="col-4">
    <label>Delivery Date</label>
    <p><?=date('d-m-Y',strtotime($purchase_order_shipping[0]['delivery_date']))?></p>
  </div>
</div>
<?php }?>
<div class="row">
<div class="col-sm-12 col-md-12 col-lg-12 p-0">
<div id="table-fixed" class="table-fixed">
<table class="table text-center bill-table border w-100 border-dark  large  " id="bill-table">
<thead>
<tr class="border border-dark font-weight-bold">
<th class="border border-dark">S.No</th>
<th class="w-50 border border-dark">Product Name</th>
<th class="border border-dark">Product Code</th>
<th class="border border-dark">Variety</th>
<th class="border border-dark">Quantity</th>
<th class="border border-dark">Description</th>
<th class="border border-dark">Units</th>
<th class="border border-dark">Tons</th>
<!-- <th>Vendor Price</th>
<th>Mrp</th>
<th>Discount %</th>
<th>Gst %</th>
<th>Total</th> -->
</tr>
</thead>
<tbody class="text-center" id="tdata">
 <?php foreach (array_slice($purchase_order_item_dt, $start_index, $end_index) as $row) {
   $sno++;
   $temp++;
   $description='';
   $total_qty=$total_qty+$row['qty'];
   $total_ton=$total_ton+($row['qty']/1000);
   $total_amount=$total_amount+($row['total']+$row['tax_amt']);
   if ($row['sub_category']!='' && $row['sub_category']!=0) {
     $description =  $description_obj->get_description_dt($row['sub_category']);
     $description_name=$description[0]['name'];
   }?>
<tr class="border-right border-dark line_1">
<td class="border-left-0"><?=$sno?></td>
<td class="w-50 text-left"><b><?=$row['item_name']?></b></td>
<td><?=$row['item_code']?></td>
<td><?=$row['var_name']?></td>
<td ><?=$row['qty']?></td>
<td><?=$description_name?></td>
<td class="text-right"><?=$row['units']?></td>
<td class="text-right"><?=($row['qty']/1000)?></td>
<!-- <td class="text-right"><?=$row['mrp']?></td>
<td class="text-right"><?=$row['sales_price']?></td> 
<td class="text-right"><?=round($row['discount'])?></td>
<td class="text-right"><?=round($row['gst'])?></td>
<td class="text-right"><?=($row['total']+$row['tax_amt'])?></td> -->
</tr>
<?php }?>
<tr class="border-right border-dark">
<td class="border-left-0">&nbsp;</td>
<td class="w-50 text-left"><b></b></td>
<td >&nbsp;</td>
<td >&nbsp;</td>
<td class="text-right">&nbsp;</td>
<td class="text-right">&nbsp;</td>
<td class="text-right">&nbsp;</td>
<td class="text-right">&nbsp;</td> 
</tr>

 <?php if ($last_index==$temp) { ?>
  </tbody>
<!-- <tfoot>
<tr class="border-right border-top border-dark font-weight-bold line_1">
<td class="border-left-0">&nbsp;</td>
<td class="w-50 text-left"><b>Total</b></td>
<td ><?=$total_qty?></td>
<td >&nbsp;</td>
<td >&nbsp;</td>

<td><?=$total_ton?></td>
<td class="text-right">&nbsp;</td>
<td class="text-right">&nbsp;</td>
<td class="text-right">&nbsp;</td>
<td class="text-right">&nbsp;</td> 
<td class="text-right"><?=$total_amount?></td>
</tr>
</tfoot> -->
</table>
</div>
</div>
</div>
<!-- <div class="row border border-dark" style="height: 76px;">
<div class="col-4"><p style="font-size: 12px;font-weight: bold;">Discount Amt : <?=$purchase_order_dt[0]['discount_amt']?></p></div>
<div class="col-4 text-center"><p style="font-size: 12px;font-weight: bold;">Tax Amt : <?=$purchase_order_dt[0]['tax_amt']?></p></div>
<div class="col-4 text-right"><p style="font-size: 12px;font-weight: bold;">Grand Total : <?=$purchase_order_dt[0]['grand_total']?></p></div>

<div class="col-6">
  <p style="font-size: 12px;font-weight: bold;">
  Amount chargeable (in words)<br><span class="font-weight-bold"><?php echo getIndianCurrency(round($purchase_order_dt[0]['grand_total'])); ?></span></p>
</div>
</div> -->
<div class="row border border-dark shippingDetails">
<div class="col-sm-12 col-md-12 col-lg-12 mt-2 declaration_p">
<p class="font-weight-bold" style="margin-bottom:0;">Comments / Special Instruction&nbsp;:&nbsp;</p>
<p style="font-size: 10px;overflow-wrap: break-word;"><?=$shop_result1[0]['declaration']?> </p>
</div>

</div>
<div class="row border border-dark shippingDetails" style="height: 180px">
<div class="col-sm-6 col-md-6 col-lg-6">


<div class=""><p class="font-weight-bold" style="margin-bottom:0;">Note&nbsp;:&nbsp;</p><div style="font-size: 10px;overflow-wrap: break-word;"><?=$purchase_order_dt[0]['purchase_note']?></div></div>
</div>
<div class="col-sm-6 col-md-6 col-lg-6 border-left border-top border-dark">
<div class="row">
<span class="col p-0 " style="text-align: center !important"><b>For GALAXON MAX PRIVATE LIMITED</b></span>
</div>
<div class="row">&nbsp;</div>
<div class="row">&nbsp;</div>
<div class="row">&nbsp;</div>
<div class="row">&nbsp;</div>
<div class="row">&nbsp;</div>
<!-- <div class="row">&nbsp;</div> -->
<div class="row">



<span class="col p-0 text-center">
  <?php if ($shop_result1[0]['shop_logo']!='') {?>
<img src="../uploads/<?=$shop_result1[0]['shop_logo']?>" alt="Shop_logo" style="width: 140px;height:80px;" />
<?php }?>
<br>
Authorised Signatory
</span>
</div>
</div>
</div>
</div> 
<div class="container-fluid col-sm-12 col-md-12 col-lg-12 p-0 text-center mb-1">
</div>
<div class="container-fluid col-sm-12 col-md-12 col-lg-12 p-0 text-center">
</div>
</div>
</main>
</div>
<?php }else{?>
   </tbody>
</table>
</div>
</div>
</div>

</div> 

</div>
</main>
</div>
  <?php }?>
 <?php
$start_index+=$end_index;
if (($last_index-$end_index)<=$numItemShow) {
 $end_index=$last_index-$end_index;
}else{
  $end_index=$numItemShow;
}
      }?>
<script type="text/javascript">
      window.print();
      </script>
      <?php
      function getIndianCurrency(float $number) {
      $decimal = round($number - ($no = floor($number)), 2) * 100;
      $hundred = null;
      $digits_length = strlen($no);
      $i = 0;
      $str = array();
      $words = array(0 => '', 1 => 'one', 2 => 'two',
      3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
      7 => 'seven', 8 => 'eight', 9 => 'nine',
      10 => 'ten', 11 => 'eleven', 12 => 'twelve',
      13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
      16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
      19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
      40 => 'forty', 50 => 'fifty', 60 => 'sixty',
      70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
      $digits = array('', 'hundred and', 'thousand', 'lakh', 'crore');
      while ($i < $digits_length) {
      $divider = ($i == 2) ? 10 : 100;
      $number = floor($no % $divider);
      $no = floor($no / $divider);
      $i += $divider == 10 ? 1 : 2;
      if ($number) {
      $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
      // $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
      $hundred = ($counter == 1 && $str[0]) ? ' ' : null;
      $str[] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural . ' ' . $hundred : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural . ' ' . $hundred;
      } else {
      $str[] = null;
      }
      }
      $Rupees = implode('', array_reverse($str));
      $paise = ($decimal > 0) ? ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' paise' : '';
      // $paise = ($decimal > 0) ? " and " . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
      // return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
      return 'INR ' . ucwords($Rupees) . ($paise ? ' and ' . ucwords($paise) : '') . ' Only';
      }
      ?>