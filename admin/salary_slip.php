<?php 
include '../tables/config.php';
$obj = new Employee();
$salary = $obj->get_employee_salary(base64_decode($_GET['id']));
// print_r($salary);die();
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
<link rel="icon" type="image/x-icon" href="../uploads/<?=$shop_result1[0]['shop_image']?>" />
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
.slip{

height: 40px;
}
.text-middle{

padding-top:9px;
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
  //   if (($last_index-$start_index)<=16) {
  //   $end_index=16;
  //   $check=1;
  // }
  if (($last_index-$start_index) > 16 && ($last_index-$start_index)<=23) {
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

 <?php if($_SESSION['type']=="ADMIN"){ ?>
  <img src="../dist/img/logo.png" style="width: 17rem;position: absolute;bottom: -6rem;left: -1rem;"  >
 <?php }else { ?> 

  <img src="../uploads/<?=$shop_result1[0]['shop_image']?>" style="width: 12rem; height: 7rem; position: absolute;bottom: 1rem;left: 0.5rem;"  >
<?php } ?> 


</div>






<div class="col-10 mb-0 text-center">
  

<div class="col-12 text-center" style="font-size: 26px !important;"><b>GALAXON MAX PRIVATE LIMITED</b>
</div>
<!-- <br> -->
<div class="col-12 text-center" style="font-size: 14px;">NO 18/44(1),THAMPILAKSHMI ARCADE,CHITTUR,PALAKKAD-678101</div>

<div class="col-12 text-center" style="font-size: 14px;">Phone : 8438335415 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tele-Phone : 4923 356 006</div>
<div class="col-12 text-center" style="font-size: 14px;">Mail : info@galaxonmax.com</div>

</div>


</div>
<div class="row ">
  <div class = "text-center col-sm-12 col-md-12 col-lg-12 border-bottom border-dark">
    
 <h5 class=""><b>Pay Slip</b></h5>

  </div>



</div>
    <div class="row" >
  

<div class="col-sm-7 col-md-7 col-lg-7 shippingDetails">





<div class="row slip">
<div class="col-5 border-left border-right border-bottom border-dark text-middle " id="buyers_order_no">
<span class="">Name of the Employee</span>
<span class="text-val"></span>
</div>
<div class="col-7 border-left border-right border-bottom border-dark text-middle" id="motor_vehicle_no">
 
<span class="text-val"></span>


<span class="text-val"><?=$salary['first_name']?></span>

   

</div>
</div>
<div class="row slip">
<div class="col-5 border-left border-right border-bottom border-dark text-middle " id="buyers_order_no">

<span class="">Employee Id </span>

<span class="text-val"></span>
</div>
<div class="col-7 border-left border-right border-bottom border-dark text-middle" id="motor_vehicle_no">
 
<span class="text-val"></span>

<span class="text-val"><?=$salary['employee_id']?></span>

</div>
</div>

<div class="row slip">
<div class="col-5 border-left border-right border-bottom border-dark text-middle " id="buyers_order_no">
<span class="">Designation </span>
<span class="text-val"></span>
</div>
<div class="col-7 border-left border-right border-bottom border-dark text-middle" id="motor_vehicle_no">

<span class="text-val"><?=$salary['designation']?></span>


</div>
</div>
<div class="row slip">
<div class="col-5 border-left border-right border-bottom border-dark text-middle " id="buyers_order_no">
<span class="">DOJ </span>
<span class="text-val"></span>
</div>
<div class="col-7 border-left border-right border-bottom border-dark text-middle" id="motor_vehicle_no">



<span class="text-val"><?=$salary['date_of_joining']?></span>


</div>
</div>




<div class="row slip">
<div class="col-5 border-left border-right border-bottom border-dark text-middle" id="buyers_order_no">
<span class="">Gross Wage </span>
<span class="text-val"></span>
</div>
<div class="col-7  border-left border-right border-bottom  border-dark text-middle" id="motor_vehicle_no">
<span class="text-val"><?=$salary['gross_wage']?></span>
</div>
</div>

<div class="row slip">
<div class="col-5 border-left border-right  border-dark text-middle" id="buyers_order_no">
<span class="">Total Working Days</span>
<span class="text-val"></span>
</div>
<div class="col-7  border-left border-right  border-dark text-middle" id="motor_vehicle_no">
<span class="text-val">31</span>
</div>
</div>

<div class="row slip">
<div class="col-5 border-left border-top  border-bottom border-right border-dark text-middle" id="buyers_order_no">
<span class="">LOP days</span>
<span class="text-val"></span>
</div>
<div class="col-7 border-left border-top border-bottom border-right border-dark text-middle" id="motor_vehicle_no">
<span class="text-val">2</span>
</div>
</div>
<div class="row slip">
<div class="text-center col-12 border-top border-left border-bottom border-right border-dark text-middle" id="buyers_order_no">
<span class=""><b>Earnings</b></span>
<span class="text-val"></span>
</div>

</div>

<div class="row slip">
<div class="col-5 border-left border-bottom  border-top border-right  border-dark text-middle" id="buyers_order_no">
<span class="">Basic Wage</span>
<span class="text-val"></span>
</div>
<div class="col-7  border-left border-top border-bottom border-right  border-dark text-middle" id="motor_vehicle_no">
<span class="text-val"><?=$salary['basic_wage']?></span>
</div>
</div>

<div class="row slip">
<div class="col-5 border-left border-bottom border-right  border-dark text-middle" id="buyers_order_no">
<span class="">HRA</span>
<span class="text-val"></span>
</div>
<div class="col-7  border-left border-bottom border-right  border-dark text-middle" id="motor_vehicle_no">
<span class="text-val"></span>
</div>
</div>


<div class="row slip">
<div class="col-5 border-left border-bottom border-right  border-dark text-middle" id="buyers_order_no">
<span class="">Conveyance Allowances</span>
<span class="text-val"></span>
</div>
<div class="col-7  border-left border-bottom border-right  border-dark text-middle" id="motor_vehicle_no">
<span class="text-val"><?=$salary['conveyance_allowances']?></span>
</div>
</div>


<div class="row slip">
<div class="col-5 border-left border-bottom border-right  border-dark text-middle" id="buyers_order_no">
<span class="">Medical Allowances</span>
<span class="text-val"></span>
</div>
<div class="col-7  border-left border-bottom border-right  border-dark text-middle" id="motor_vehicle_no">
<span class="text-val"><?=$salary['medical_allowances']?></span>
</div>
</div>

<div class="row slip">
<div class="col-5 border-left border-bottom border-right  border-dark text-middle" id="buyers_order_no">
<span class="">Other Allowances</span>
<span class="text-val"></span>
</div>
<div class="col-7  border-left border-bottom border-right  border-dark text-middle" id="motor_vehicle_no">
<span class="text-val">31</span>
</div>
</div>
<div class="row slip">
<div class="col-5 border-left border-right border-bottom  border-dark text-middle" id="buyers_order_no">
<span class=""><b>Total Earnings</b></span>
<span class="text-val"></span>
</div>
<div class="col-7 border-left border-right border-bottom border-dark  text-middle" id="motor_vehicle_no">
<span class="text-val"><?=$salary['gross_wage']?></span>
</div>
</div>


<div class="row slip">
<div class="text-center col-12 border-top border-left border-bottom border-dark text-middle" id="buyers_order_no">
<span class=""><b>Net Salary</b></span>
<span class="text-val"></span>
</div>

</div>
<div class="row slip">
<div class="text-center col-12 border-top  border-dark text-middle" id="buyers_order_no">
<span class=""></span>
<span class="text-val"></span>
</div>

</div>






</div>




<div class="col-sm-5 col-md-5 col-lg-5 shippingDetails">


<div class="row ">


</div>
<div class="row slip">
<div class="col-4 border-left border-right border-bottom border-dark text-middle" id="buyers_order_no">
<span class="">UAN</span>
<span class="text-val"></span>
</div>
<div class="col-8 border-left border-right border-bottom border-dark  text-middle" id="motor_vehicle_no">
<span class="text-val"></span>
</div>
</div>
<div class="row slip">
<div class="col-4 border-left border-right border-bottom border-dark text-middle" id="buyers_order_no">
<span class="">PF No </span>
<span class="text-val"></span>
</div>
<div class="col-8 border-left border-right border-bottom border-dark text-middle" id="motor_vehicle_no">
<span class="text-val"></span>
</div>
</div>

<div class="row slip">
<div class="col-4 border-left border-right border-bottom border-dark text-middle" id="buyers_order_no">
<span class="">ESI No </span>
<span class="text-val"></span>
</div>
<div class="col-8 border-left border-right border-bottom border-dark text-middle" id="motor_vehicle_no">
<span class="text-val"></span>
</div>
</div>
<div class="row slip">
<div class="col-4 border-left border-right border-bottom border-dark text-middle" id="buyers_order_no">
<span class="">Bank Name </span>
<span class="text-val"></span>
</div>
<div class="col-8 border-left border-right border-bottom border-dark text-middle" id="motor_vehicle_no">
<span class="text-val"><?=$salary['bank_name']?></span>
</div>
</div>
<div class="row slip">
<div class="col-4 border-left border-right border-dark text-middle" id="buyers_order_no">
<span class="">Bank A/C No </span>
<span class="text-val"></span>
</div>
<div class="col-8  border-left border-right border-dark text-middle" id="motor_vehicle_no">
<span class="text-val"><?=$salary['account_number']?></span>
</div>
</div>

<div class="row slip">
<div class="col-4 border-left border-right border-bottom  border-top border-dark text-middle" id="buyers_order_no">
<span class="">Paid Days </span>
<span class="text-val"></span>
</div>
<div class="col-8 border-left border-right border-bottom  border-dark border-top text-middle" id="motor_vehicle_no">
<span class="text-val">31</span>
</div>
</div>



<div class="row slip">
<div class="col-4 border-left border-right border-bottom   border-dark text-middle" id="buyers_order_no">
<span class="">Leaves Taken</span>
<span class="text-val"></span>
</div>
<div class="col-8 border-left border-right border-bottom  border-dark text-middle" id="motor_vehicle_no">
<span class="text-val">2</span>
</div>
</div>


<div class="row slip">
<div class="text-center col-12 border-top border-left border-right border-dark  border-bottom text-middle" id="buyers_order_no">
<span class=""><b>Deduction</b></span>
<span class="text-val"></span>
</div>

</div>

<div class="row slip">
<div class="col-6 border-left border-top border-right  border-bottom border-dark text-middle" id="buyers_order_no">
<span class="">EPF</span>
<span class="text-val"></span>
</div>
<div class="col-6  border-left border-top border-right  border-bottom  border-dark text-middle" id="motor_vehicle_no">
<span class="text-val"><?=$salary['ta_da']?></span>
</div>
</div>

<div class="row slip">
<div class="col-6 border-left border-right  border-bottom border-dark text-middle" id="buyers_order_no">
<span class="">ESI/Health insurance</span>
<span class="text-val"></span>
</div>
<div class="col-6  border-left border-right  border-bottom border-dark text-middle" id="motor_vehicle_no">
<span class="text-val"><?=$salary['esi_health_insurance']?></span>
</div>
</div>

<div class="row slip">
<div class="col-6 border-left border-right  border-bottom border-dark text-middle" id="buyers_order_no">
<span class="">Professional Tax</span>
<span class="text-val"></span>
</div>
<div class="col-6  border-left border-right  border-bottom border-dark text-middle" id="motor_vehicle_no">
<span class="text-val"><?=$salary['addition_emp_tax']?></span>
</div>
</div>

<div class="row slip">
<div class="col-6 border-left border-right  border-bottom border-dark text-middle" id="buyers_order_no">
<span class="">Loan Recovery</span>
<span class="text-val"></span>
</div>
<div class="col-6  border-left border-right  border-bottom border-dark text-middle" id="motor_vehicle_no">
<span class="text-val">31</span>
</div>
</div>
<div class="row slip">
<div class="col-6 border-left border-right  border-bottom border-dark text-middle" id="buyers_order_no">
<span class=""></span>
<span class="text-val"></span>
</div>
<div class="col-6  border-left border-right  border-bottom border-dark text-middle" id="motor_vehicle_no">
<span class="text-val">31</span>
</div>
</div>

<div class="row slip">
<div class="col-6 border-left border-right border-bottom border-dark text-middle" id="buyers_order_no">
<span class=""><b>Total Deduction</b></span>
<span class="text-val"></span>
</div>
<div class="col-6  border-left border-right border-bottom border-dark text-middle" id="motor_vehicle_no">
<span class="text-val">31</span>
</div>
</div>

<div class="row slip">
<div class="col-6 border-right border-top border-bottom border-dark text-middle" id="buyers_order_no">
<span class=""></span>
<span class="text-val"></span>
</div>
<div class="col-6  border-left border-right border-top border-bottom  border-dark text-middle" id="motor_vehicle_no">
<span class="text-val">1500</span>
</div>

</div>
<div class="row slip">
<div class="text-center col-12 border-top  border-dark text-middle" id="buyers_order_no">
<span class=""></span>
<span class="text-val"></span>
</div>

</div>

</div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<div class="row">
  <div class="col-12">
<div class="row">
<div class="col-6 " style="
    margin-bottom: 70px;
">

<h6 style=" margin-left: 30px;"><b>Employer Signature</b></h6>
</div>
<div class="col-6"  id="motor_vehicle_no">
<h6 style="float: right; margin-right: 30px"><b>Employee Signature</b></h6>
</div>
</div>
</div>
<div>










</div>
</div>

</div> 

</div>
</main>
</div>
 
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

      