<?php 
include 'header.php';
// print_r($_SESSION);die();

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Sale List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
           
               <!-- <li class="breadcrumb-item"><a href="pending_list.php" data-toggle="tooltip" title="Pending Payment List"><i class="fa fa-bell" aria-hidden="true"></i></a></li> -->
      
          
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Sale List</li>
          
              <!-- <li class="breadcrumb-item"><a style="color: #007bff;text-decoration: none;background-color: transparent;cursor: pointer;" href="new_purchase_order.php?type=received">Received Order</a></li>
          -->
          
              <li class="breadcrumb-item"><a style="color: #007bff;text-decoration: none;background-color: transparent;cursor: pointer;" href="sale_customer.php">New Sale</a></li>
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
                    <th width="10%">S.No</th>
                    <th width="10%">Bill No</th>
                    <th width="10%">Discount</th>
                    <th width="10%">Tax Amount</th>
                    <th width="10%">Total Amount</th>
                    <th width="10%">Paid Amount</th>
                    <th width="10%">Balance Amount</th>
                     <th width="10%">Details</th>
                    
             
             
                    
                   
                  </tr>
              
                  </thead>
                  <tbody>
                  
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
  <!-- /.content-wrapper -->
  <div class="modal fade" id="order_modal" data-backdrop='static'>
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-body">
             
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
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
<script type="text/javascript">
  function detail_modal(e){
$.ajax({
type: "GET",
dataType:"html",
url: '../ajaxCalls/get_purchase_order_id.php',
data: {'id':e},
success: function(res){
  $("#order_modal .modal-body").html(res);
$("#order_modal").modal('show');
}

});
    
  }
    function new_detail_page(e){


// $.ajax({
// type: "GET",
// dataType:"html",
// url: '../ajaxCalls/get_purchase_order_new_id.php',
// data: {'id':e},
// success: function(res){
//   $("#order_modal .modal-body").html(res);
// $("#order_modal").modal('show');
// }

// });
window.location='edit_purchase_order.php?id='+btoa(e);
    
  }

  function edit_detail_page(e){



window.location='modify_purchase_order.php?id='+btoa(e);
    
  }

  function new_detail_modal(e){

$.ajax({
type: "GET",
dataType:"html",
url: '../ajaxCalls/get_customer_sale_new_id.php',
data: {'id':e},
success: function(res){
  $("#order_modal .modal-body").html(res);
$("#order_modal").modal('show');
}

});
    
  }
</script>
<script type="text/javascript">
  $(document).ready(function(){
    get_data();
  })
</script>
<script type="text/javascript">
  function get_data(){
      $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/get_customer_sale.php',

success: function(res){
 var table = $('#example1').DataTable();
    table.clear();
    table.rows.add(res).draw();
}

});
  }
  function postValue(){
    var paid_amt=$("#balance_received").val();
    var balance = $("#balance_amt").val();
    var payment_mode=$("#payment_mode").val();
    var pay_id=$("#pay_id").val();
    var cus_id = $("#cus_id").val();
    var sale_id = $("#sale_id").val();
   

    if (paid_amt=='' && paid_amt==0) {
      global_alert_modal('warning','Enter Paid Amount...');
      $("#balance_received").css("border","1px solid red");
      $("#balance_received").focus();
      return false;
    }else{
        $("#balance_received").css("border","1px solid gray");
    }
     $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/paid_customer_sale.php',
data: {'paid_amt':paid_amt,'balance':balance,'payment_mode':payment_mode,'pay_id':pay_id,'cus_id':cus_id,'sale_id':sale_id},
success: function(res){
 if (res.status=='success') {
  
   global_alert_modal('success','Paid Added Successfully...');
   get_data();
   $("#order_modal").modal('hide');
 }
}

});
  }
</script>
<script type="text/javascript">
  $("#select_type").on('change',function(){
    if ($(this).val()=='RECEIVED') {
      window.location='purchase_order.php?type=RECEIVED';
    }else{
      window.location='purchase_order.php?type=NEW';
    }
  })
</script>
<script type="text/javascript">
  function print_page(e) {

    window.open('customer_print_page.php?id='+btoa(e),'_blank');
  }
</script>