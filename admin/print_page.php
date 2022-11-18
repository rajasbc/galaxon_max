
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta name="description" content="" />
<meta name="author" content="" />
<title id='tab_title'>GALAXON MAX</title>
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
background-image: url('../dist/img/invoice.png');
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
background-image: url('../dist/img/invoice.png');
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
height: 20px;
line-height: 20px;
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
<div class="row " style="width: 756px;height: 120px;">


</div>
<div class="row">
<div class="col-sm-6 col-md-6 col-lg-6" style="
                    padding-left: 25px;">
<div class="row" style="font-size:15px"><h6><b>Vendor Details :</b></h6></div>
<div class="row col-12 mb-2" >
  <div class="col-4"><b>Name</b></div>
  <div class="col-1">:</div>
  <div class="col-7"><b>Amar - GLAX001</b></div>
</div>
<div class="row col-12 mb-2" >
  <div class="col-4"><b>Company Name</b></div>
  <div class="col-1">:</div>
  <div class="col-7"><b>Amar Company</b></div>
</div>
<div class="row col-12 mb-2" >
  <div class="col-4"><b>Mobile.No</b></div>
  <div class="col-1">:</div>
  <div class="col-7"><b>9442686630</b></div>
</div>
<div class="row col-12 mb-2" >
  <div class="col-4"><b>Email</b></div>
  <div class="col-1">:</div>
  <div class="col-7"><b>amar@gmail.com</b></div>
</div>
<div class="row col-12 mb-2" >
  <div class="col-4"><b>Address</b></div>
  <div class="col-1">:</div>
  <div class="col-7"><b>73,Priyar St,Salem - 636001.</b></div>
</div>



</div>
<div class="col-sm-6 col-md-6 col-lg-6">
<div class="row col-12 text-right">
 <div class="col-6"><h5>Purchase No</h5></div>
  <div class="col-1"><h5>:</h5></div>
  <div class="col-5"><h5>34</h5></div>
</div>
<div class="row col-12 text-right">
 <div class="col-6"><h5>Purchase Date</h5></div>
  <div class="col-1"><h5>:</h5></div>
  <div class="col-5"><h5><?=date('d-m-Y')?></h5></div>
</div>

</div>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-12 col-md-12 col-lg-12 p-0">
<div id="table-fixed" class="table-fixed">
<table class="table text-center bill-table  w-100 border border-dark  large  " id="bill-table">
<thead>
<tr class="border-left border-bottom border-dark font-weight-bold">
<td>S.No</td>

<td class="w-50">Product Name</td>
<td > Units </td>
<td>Tons</td>
<td>Purchase Price</td>
<td >Disc %</td>
<td >GST %</td>
<td >Quantity</td>
<td >Amount</td>
</tr>
</thead>
<tbody class="text-center" id="tdata">
<tr class="border border-dark line_1">
<td class="border-left-0">1</td>
<td class="w-50 text-left"><b>
MONITER </b></td>
<td >Kg</td>

<td>1</td>
<td class="text-right">10.00</td>
<td class="text-right">10</td>
<td class="text-right">10</td>
<td class="text-right">1000</td> 
<td class="text-right">9900.00</td>
</tr>

</tbody>
<tfoot>
<tr class="border border-dark font-weight-bold line_1">
<td class="border-left-0">&nbsp;</td>
<td class="w-50 text-left"><b>Total</b></td>
<td >&nbsp;</td>

<td>1</td>
<td class="text-right">10.00</td>
<td class="text-right">&nbsp;</td>
<td class="text-right">&nbsp;</td>
<td class="text-right">1000</td> 
<td class="text-right">9900.00</td>
</tr>
</tfoot>
</table>
</div>
</div>
</div>
<div class="row col-12 mt-2 mb-2">
<div class="col-4"></div>
<div class="col-3 text-right"><h6>Discount Amt</h6></div>
<div class="col-1"><h6>:</h6></div>
<div class="col-4 text-right"><h6>1000.00</h6></div>
<div class="col-4"></div>
<div class="col-3 text-right"><h6>Tax Amt</h6></div>
<div class="col-1"><h6>:</h6></div>
<div class="col-4 text-right"><h6>900.00</h6></div>
<div class="col-4"></div>
<div class="col-3 text-right"><h6>Total Amt</h6></div>
<div class="col-1"><h6>:</h6></div>
<div class="col-4 text-right"><h6>9900.00</h6></div>
<div class="col-sm-6 col-md-6 col-lg-6 p-0">

</div>
<div class="col-6 text-right">
  <h6>
  Amount chargeable (in words)<br><span class="font-weight-bold">INR One Hundred And Ten Only</span></h6>
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
