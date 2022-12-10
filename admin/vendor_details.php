<?php 
include 'header.php';
$obj = new PurchaseOrder();
$result=$obj->vendor_variety_details($_GET['id']);
?>
<div class="content-wrapper">
 <!-- Content Header (Page header) -->
 <div class="content-header">
  <div class="container-fluid">
   <div class="row mb-2">
    <div class="col-sm-6">
     <h1 class="m-0">Vendor Stock List</h1>

    </div><!-- /.col -->
    <div class="col-sm-6">
     <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="stock.php">Stock List</a></li>
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
   <input type="hidden" name="sno" id="sno" value="<?=$i?>">
   <!-- Main row -->
   <div class="row">
    <div class="col-12">
     <div class="card watermark_img">

      <div class="card-body row col-12">


       <div class=" card-body">
        <table id="example1" class="table table-bordered table-striped ">
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
         <tbody class="text-left css-serial" id="tdata">
         <?php
         $i=0;
         $total_value='';
         $total_qty=0;
         $total_mrp=0;
         $total_sale=0;
 foreach ($result as $key => $value) {
                    // $result2 = $obj->get_bill_no($value['vendor_id']);

                  

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
          
  ?>
         </tbody>

         <tfoot>  
          <?php echo "<tr><td><td></td><td></td></td><td><b>Total</b></td><td>".$total_qty."</td><td>".number_format($total_mrp,2,'.','')."</td><td>".number_format($total_sale,2,'.','')."</td></tr>";  
          ?> 
         </tfoot>

        </table>
       </div>
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
<!-- /.content-wrapper -->

<!-- /.modal-dialog -->
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

