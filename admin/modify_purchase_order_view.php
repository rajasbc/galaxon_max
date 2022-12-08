<?php 
include 'header.php';
$obj=new PurchaseOrder();
$purchase_order_dt=$obj->get_purchase_order($_GET['id']);
$purchase_order_item_dt=$obj->get_purchase_order_item($_GET['id']);
$vendor_obj= new Vendors();
$vendor= $vendor_obj->get_vendor_dt($purchase_order_dt[0]['vendor_id']); 
$brand_obj = new Brand();
$brand =  $brand_obj->get_brand_data();
$description_obj = new Description();
$description =  $description_obj->get_description_data();
$category_obj = new Category();
$category =  $category_obj->get_category_data();

?>
<style type="text/css">

  .css-serial {
      counter-reset: serial-number;  /* Set the serial number counter to 0 */
    }

    .css-serial td:first-child:before {
      counter-increment: serial-number;  /* Increment the serial number counter */
      content: counter(serial-number);  /* Display the counter */
    }
    .table-scroll {
     position: relative;
     width:100%;
     z-index: 1;
     margin: auto;
     overflow: auto;
     <?php if (count($purchase_order_item_dt)>=7) { ?>
     height: 350px;
   <?php }?>
   }
   .table-scroll table {
     width: 98%;
     margin: auto;
     border-collapse: separate;
     border-spacing: 0;
   }
   .table-scroll th,
   .table-scroll td {
     padding: 0.35rem;
     border: 1px solid #000;
     vertical-align: top;
   }
   .table-scroll thead th {
     background: #e9ecef;
     position: -webkit-sticky;
     position: sticky;
     top: 0;
   }
   /* safari and ios need the tfoot itself to be position:sticky also */
   .table-scroll tfoot,
   .table-scroll tfoot th,
   .table-scroll tfoot td {
     position: -webkit-sticky;
     position: sticky;
     bottom: 0;
     background-color: #fff !important;
     z-index:4;
   }

   .table-scroll tfoot td {
     background-color: #fff !important;
   }
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
              <h1 class="m-0">Order View Details</h1>
            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item "><a href="purchase_order.php?type=NEW">Orders List</a></li>
             
              
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
                <div class="row col-12">
                  <?php if($_SESSION['type']=='ADMIN'){ ?>
                <div class="col-12" id="vendor_dt">
                  <label>Vendor Details</label><br>
                  <div class="row col-12">
                    <div class="col-6">
                      <label>Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label><span id="vendor_name"> <?=$vendor['name']?> - <?=$vendor['vendor_code']?></span>
                    </div>
                    <div class="col-6">
                      <label>Company Name :</label><span id="vendor_company_name"> <?=$vendor['company_name']?></span>
                    </div>
                    <div class="col-6">
                      <label>Mobile No :</label><span id="vendor_mobile"> <?=$vendor['mobile_no']?></span>
                    </div>
                    <?php if ($vendor['email']!='') { ?>
                    <div class="col-6">
                      <label>Email &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label><span id="vendor_email"> <?=$vendor['email']?></span>
                    </div>
                  <?php }?>
                   <?php if ($vendor['gst']!='') { ?>
                    <div class="col-6">
                      <label>GST No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label><span id="vendor_gst"> <?=$vendor['gst']?></span>
                    </div>
                  <?php }?>

                  </div>
                </div><?php }else{?>

                    <div class="col-3 form-group mb-2">
                   <label><img src="../dist/img/g.png" height="75px" width="75px">ALAXON MAX&nbsp;</label>
                   <input type="hidden" name="sno" id="sno" value="0">
                   <input type="hidden" name="nvendor_id" id="nvendor_id" value="0">
                  <!-- <input type="hidden" name="vendor" id="vendor" class="form-control" placeholder="Enter Vendor" autofocus> -->
                </div><?php } ?>


                </div>

                <div class=" card-body">
                <table id="example1" class="table table-bordered table-striped ">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Product</th>
                      <th>Variety</th>
                      <th>Qty</th>
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
                  <tbody class="text-left css-serial" id="tdata">
 <?php $sno=0;
 $totalqty = 0;
 $totalton = 0;
 $totdis = 0;
 $taxableamt = 0;
 $taxtot = 0;
 $grandtot = 0;
 foreach ($purchase_order_item_dt as $key => $row) {
   $sno++;
   $description='';
   if ($row['sub_category']!='' && $row['sub_category']!=0) {
     $description =  $description_obj->get_description_dt($row['sub_category']);
     $description_name=$description[0]['name'];
   }

   $tns = $row['qty']/1000;

   $ttl=$row['total']+$row['tax_amt'];
   
   echo '<tr id="trItem_'.$sno.'">';
           echo '<td class=" ch-4"><span></span></td>';
            echo '<td class="text-left ch-10">'.$row['item_name'];
            if ($row['item_code']!='') {
            echo ' - '.$row['item_code'];
            }
            echo '</td>';
             echo '<td class=" ch-4">'.$row['var_name'].'</td>';
            echo '<td class="text-left ch-4">'.$row['qty'].'</td>';
                echo '<td class="text-left ch-10">'.$description_name.'</td>';
                echo '<td class="text-left ch-10">'.$row['units'].'</td>';
            echo '<td class="text-left ch-10" id="tons'.$sno.'">'.$tns.'</td>';

            echo '<td class="text-left ch-4">'.$row['mrp'].'</td>';
                echo '<td class="text-left ch-4">'.$row['sales_price'].'</td>';
                echo '<td class="text-left ch-4">'.$row['discount'].'</td>';
                echo '<td class="text-left ch-4">'.$row['gst'].'</td>';
                echo '<td class="text-left ch-6" id="totalid'.$sno.'">'.number_format($ttl,2,'.','').'</td>';

              
                echo '</tr>';

 

 } ?>
</tbody>

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
      <!-- /.modal -->
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

