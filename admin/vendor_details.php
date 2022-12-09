<?php 
include 'header.php';

$obj = new PurchaseOrder();
$obj2 = new Vendors();

$result=$obj->vendor_variety_details($_GET['id']);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper watermark_img">
 <!-- Content Header (Page header) -->
 <div class="content-header">
  <div class="container-fluid">
   <div class="row mb-2">
    <div class="col-sm-6">
     <h1 class="m-0">Vendor Stock List</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
     <ol class="breadcrumb float-sm-right">



      <li class="breadcrumb-item"><a href="stock.php">Stock LIST</a></li>
      <li class="breadcrumb-item active">Vendor Stock List</li>


     </ol>
    </div><!-- /.col -->
   </div><!-- /.row -->
  </div><!-- /.container-fluid -->
 </div>
 <!-- /.content-header -->

 <!-- Main content -->
 <section class="content">
  <div class="container-fluid"> 

   <!-- Main row -->
   <div class="row">
    <div class="col-12">
     <div class="card">

      <div class="card-body">
       <table id="example1" class="table table-bordered table-striped">
        <thead>

         <tr>
          <th>S.No</th>
          <th>Product Name</th>
          <th>Bill NO</th>

          <th>Vendor Name</th>
          <th>Quantity</th>
          <th>Mrp</th>
          <th>Sale Price</th>


         </tr>

        </thead>
        <tbody>

         <?php 
         $i=0;
         $total_value='';
         $total_qty=0;
         $total_mrp=0;
         $total_sale=0;
         foreach ($result as $key => $value) {
                    // $result2 = $obj2->get_name($value['vendor_id']);

                    // $total_value = ($value['mrp']*$value['received_qty']); 

          $i++;

          echo "<tr><td>".$i."</td>

          <td>".$value['var_name']."</td>
          <td>".$value['bill_no']."</td>

          <td>".$value['name']."</td>
          <td>".$value['received_qty']."</td>



          <td>".number_format(($value['received_qty'])*($value['mrp']),2,'.','')."</td>
           <td>".number_format(($value['sales_price'])*($value['received_qty']),2,'.','')."</td>
           </tr>";






           $total_qty+=$value['received_qty'];
           $total_mrp+=($value['received_qty'])*($value['mrp']);
           $total_sale+=($value['sales_price'])*($value['received_qty']);

          }

          echo "<tr><td colspan='3'></td><td><b>Total</b></td><td>".$total_qty."</td><td>".number_format($total_mrp,2,'.','')."</td><td>".number_format($total_sale,2,'.','')."</td></tr>";



          ?>





          </tbody>
          </table>
          </div>
          <!-- /.card-body -->
          </div>
          </div>
          </div>
          <!-- /.row (main row) -->
          </div><!-- /.container-fluid -->
          </section>
          <!-- /.content -->
          </div>

          <?php 
          include 'footer.php';
          ?>
          <script>

          $(function () {
           $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
           }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
          });
          </script>


          <!-- End Of Purchase Details -->
