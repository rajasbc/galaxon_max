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
width: initial;
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
height: 700px;
}
.bill-table.medium{
height: 440px;
}
.bill-table tr.line_1 {
height: 30px;
line-height: 30px;
}
.shippingDetails {
font-size: 10px;
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
      height:120px !important;
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
        height: 700px;
      }
    </style>
<div>
<main>
<div class="page">


<div class="container-fluid">
<div class="row ">
<div class="col-sm-12 col-md-12 col-lg-12">
<div class="row border border-dark" style="height: 165px">
 <div class="col-3">
   <img src="../dist/img/logo.png" style="width: 185px;">
 </div>
 <div class="col-8 text-center">
   <b style="font-size: 12px;">Purchase Order</b> 
   <br>
   <h3>GALAXON MAX PRIVATE LIMITED</h3>
   <h6>NO 18/44(1),THAMPILAKSHMI ARCADE,CITTUR,PALAKKAD-678101</h6>
   <h6>Phone : 8438335415 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tele-Phone : 4923 356 006</h6>
   <h6>Mail : galaxon.co@gmail.com</h6>
   <h6>GSTIN : 33AAOFC2618L1ZC</h6>
   <!-- <b style="font-size: 14px;font-weight: bold">GSTIN : 33AAOFC2618L1ZC</b> -->
 </div>
</div>
<div class="row">
<div class="col-sm-6 col-md-6 col-lg-6 border border-dark" style="
                    padding-left: 25px;">
                    <div class="col-sm-12 col-md-12 col-lg-12  ">
<div class="row col-12 ">
 <div class="col-6"><h5>Purchase No</h5></div>
  <div class="col-1"><h5>:</h5></div>
  <div class="col-5"><h5><?=$purchase_order_dt[0]['purchase_no']?></h5></div>
</div>
<div class="row col-12 ">
 <div class="col-6"><h5>Purchase Date</h5></div>
  <div class="col-1"><h5>:</h5></div>
  <div class="col-5"><h5><?=date('d-m-Y',strtotime($purchase_order_dt[0]['created_at']))?></h5></div>
</div>

</div>
<br>
<div class="row" style="font-size:15px"><h6><b>Vendor Details :</b></h6></div>
<div class="row col-12 mb-2" >
  <div class="col-4"><b>Name</b></div>
  <div class="col-1">:</div>
  <div class="col-7"><b><?=$vendor['name']?> - <?=$vendor['vendor_code']?> </b></div>
</div>
<div class="row col-12 mb-2" >
  <div class="col-4"><b>Company Name</b></div>
  <div class="col-1">:</div>
  <div class="col-7"><b><?=$vendor['company_name']?></b></div>
</div>
<?php if ($vendor['address']!='' || $vendor['city']!='' || $vendor['state']!='' || $vendor['country']!='' || $vendor['pincode']!='') {?>
<div class="row col-12 mb-2" >
  <div class="col-4"><b>Address</b></div>
  <div class="col-1">:</div>
  <div class="col-7"><b>
    <?php 
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
    ?>
  </b></div>
</div>
<?php }?>
<div class="row col-12 mb-2" >
  <div class="col-4"><b>Mobile.No</b></div>
  <div class="col-1">:</div>
  <div class="col-7"><b><?=$vendor['mobile_no']?></b></div>
</div>
<?php if ($vendor['email']!='') {?>
<div class="row col-12 mb-2" >
  <div class="col-4"><b>Email</b></div>
  <div class="col-1">:</div>
  <div class="col-7"><b><?=$vendor['email']?></b></div>
</div>
<?php }?>
<?php if ($vendor['gst']!='') {?>
<div class="row col-12 mb-2" >
  <div class="col-4"><b>GST No </b></div>
  <div class="col-1">:</div>
  <div class="col-7"><b><?=$vendor['gst']?></b></div>
</div>
<?php }?>

</div>

<div class="col-sm-6 col-md-6 col-lg-6 border border-dark ship_cls" style="
                    padding-left: 25px;">
<div class="row" style="font-size:15px"><h6><b>Shipping Details :</b></h6></div>
<div class="row col-12 mb-2" >
  <div class="col-4"><b>Name</b></div>
  <div class="col-1">:</div>
  <div class="col-7"><b><?=$purchase_order_shipping[0]['name']?></b></div>
</div>
<div class="row col-12 mb-2" >
  <div class="col-4"><b>Company Name</b></div>
  <div class="col-1">:</div>
  <div class="col-7"><b><?=$purchase_order_shipping[0]['company_name']?></b></div>
</div>
<?php if ($purchase_order_shipping[0]['address']!='' || $purchase_order_shipping[0]['city']!='' || $purchase_order_shipping[0]['state']!='' || $purchase_order_shipping[0]['country']!='' || $purchase_order_shipping[0]['pincode']!='') {?>
<div class="row col-12 mb-2" >
  <div class="col-4"><b>Address</b></div>
  <div class="col-1">:</div>
  <div class="col-7"><b>
    <?php 
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
    ?>
  </b></div>
</div>
<?php }?>
<div class="row col-12 mb-2" >
  <div class="col-4"><b>Mobile.No</b></div>
  <div class="col-1">:</div>
  <div class="col-7"><b><?=$purchase_order_shipping[0]['mobile_no']?></b></div>
</div>
<?php if ($purchase_order_shipping[0]['email']!='') {?>
<div class="row col-12 mb-2" >
  <div class="col-4"><b>Email</b></div>
  <div class="col-1">:</div>
  <div class="col-7"><b><?=$purchase_order_shipping[0]['email']?></b></div>
</div>
<?php }?>
<?php if ($purchase_order_shipping[0]['gst_no']!='') {?>
<div class="row col-12 mb-2" >
  <div class="col-4"><b>GST No </b></div>
  <div class="col-1">:</div>
  <div class="col-7"><b><?=$purchase_order_shipping[0]['gst_no']?></b></div>
</div>
<?php }?>
<?php if ($purchase_order_shipping[0]['shipping_terms']!='') {?>
<div class="row col-12 mb-2" >
  <div class="col-4"><b>Ship Terms </b></div>
  <div class="col-1">:</div>
  <div class="col-7"><b><?=$purchase_order_shipping[0]['shipping_terms']?></b></div>
</div>
<?php }?>
<?php if ($purchase_order_shipping[0]['method']!='') {?>
<div class="row col-12 mb-2" >
  <div class="col-4"><b>Shipping Method </b></div>
  <div class="col-1">:</div>
  <div class="col-7"><b><?=$purchase_order_shipping[0]['method']?></b></div>
</div>
<?php }?>
<?php if ($purchase_order_shipping[0]['delivery_date']!='') {?>
<div class="row col-12 mb-2" >
  <div class="col-4"><b>Delivery Date </b></div>
  <div class="col-1">:</div>
  <div class="col-7"><b><?=date('d-m-Y',strtotime($purchase_order_shipping[0]['delivery_date']))?></b></div>
</div>
<?php }?>

</div>


</div>
</div>
</div>
<div class="row">
<div class="col-sm-12 col-md-12 col-lg-12 p-0">
<div id="table-fixed" class="table-fixed">
<table class="table text-center bill-table  w-100 border border-dark   large " id="bill-table">
<thead>
<tr class="border-left border-bottom border-dark font-weight-bold">
<th>S.No</th>
<th class="w-50">Product Name</th>
<th>Quantity</th>
<th>Description</th>
<th>Units</th>
<th>Tons</th>
<th>Vendor Price</th>
<th>Mrp</th>
<th>Discount</th>
<th>Gst</th>
<th>Total</th>
</tr>
</thead>
<tbody class="text-center" id="tdata">
   <?php $sno=0; foreach ($purchase_order_item_dt as $key => $row) {
   $sno++;
   $description='';
   $total_qty=$total_qty+$row['qty'];
   $total_ton=$total_ton+($row['qty']/1000);
   $total_amount=$total_amount+$row['total'];
   if ($row['sub_category']!='' && $row['sub_category']!=0) {
     $description =  $description_obj->get_description_dt($row['sub_category']);
     $description_name=$description[0]['name'];
   }?>
<tr class="border border-dark line_1">
<td class="border-left-0"><?=$sno?></td>
<td class="w-50 text-left"><b><?=$row['item_name']?>
  <?php if ($row['item_code']!='') {
    echo ' - '.$row['item_code'];
  } ?>
</b></td>
<td ><?=$row['qty']?></td>

<td><?=$description_name?></td>
<td class="text-right"><?=$row['units']?></td>
<td class="text-right"><?=($row['qty']/1000)?></td>
<td class="text-right"><?=$row['mrp']?></td>
<td class="text-right"><?=$row['sales_price']?></td> 
<td class="text-right"><?=$row['discount']?></td>
<td class="text-right"><?=$row['gst']?></td>
<td class="text-right"><?=$row['total']?></td>
</tr>
<?php }?>
<tr class="border-right border-dark">
<td class="border-left-0">&nbsp;</td>
<td class="w-50 text-left"><b></b></td>
<td ></td>
<td >&nbsp;</td>
<td >&nbsp;</td>

<td></td>
<td class="text-right">&nbsp;</td>
<td class="text-right">&nbsp;</td>
<td class="text-right">&nbsp;</td>
<td class="text-right">&nbsp;</td> 
<td class="text-right"></td>
</tr>
</tbody>
<tfoot>
<tr class="border border-dark font-weight-bold line_1">
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
</tfoot>
</table>
</div>
</div>
</div>
<div class="row border border-dark" style="height: 76px;">
<div class="col-4"><p style="font-size: 12px;font-weight: bold;">Discount Amt : <?=$purchase_order_dt[0]['discount_amt']?></p></div>
<div class="col-4 text-center"><p style="font-size: 12px;font-weight: bold;">Tax Amt : <?=$purchase_order_dt[0]['tax_amt']?></p></div>
<div class="col-4 text-right"><p style="font-size: 12px;font-weight: bold;">Grand Total : <?=$purchase_order_dt[0]['grand_total']?></p></div>

<div class="col-6">
  <p style="font-size: 12px;font-weight: bold;">
  Amount chargeable (in words)<br><span class="font-weight-bold"><?php echo getIndianCurrency(round($purchase_order_dt[0]['grand_total'])); ?></span></p>
</div>
</div>
<div class="row " style="height: 95px;">
  <div class="col-6 text-center border border-dark">
    Message Box
  </div>
  <div class="col-6 border border-dark">
    <div class="row">
      <?php if ($shop_result1[0]['shop_logo']!='') {?>
    <div class="col-12 text-center"><img  src="../uploads/<?=$shop_result1[0]['shop_logo']?>" alt="Shop_logo" style="width: 140px;height:80px;"> </div>
  <?php }else{?>
    <div class="col-12 text-center" style="width: 140px;height:80px;">&nbsp;</div>
  <?php }?>
  </div>

    <div class="row"><div class="col-12 text-center font-weight-bold">Authorised Signatory</div></div>
    
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
