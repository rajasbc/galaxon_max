<?php 
include 'header.php';
$obj = new SaveOrder();
$result = $obj->get_save_id();
// error_reporting(E_ALL);
// print_r($result);die();

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Purchase Order List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
             <?php if($_SESSION['type']=='ADMIN'){?>
               <li class="breadcrumb-item"><a href="pending_list.php" data-toggle="tooltip" title="Pending Payment List"><i class="fa fa-bell" aria-hidden="true"></i></a></li>
               <?php }?>
          
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Orders List</li>
             <?php if($_SESSION['type']=='ADMIN'){?>
                   <?php if(count($result)>0){ ?>
              <li class="breadcrumb-item"><a style="color: #007bff;text-decoration: none;background-color: transparent;cursor: pointer;" href="save_purchase_order.php?id=<?=$result[0]['id']?> & type=received">Saved Order</a></li>

                  <?php }else{?>
                     <li class="breadcrumb-item"><a style="color: #007bff;text-decoration: none;background-color: transparent;cursor: pointer;" href="new_purchase_order.php?type=received">Received Order</a></li>


                   <?php } ?> 
                <?php  }?>

          
              <li class="breadcrumb-item"><a style="color: #007bff;text-decoration: none;background-color: transparent;cursor: pointer;" href="new_purchase_order.php?type=new">New Order</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid"> 
      <div class="row col-12 mb-2">
        <div class="col-8">&nbsp;</div>
        <div class="col-4">
          <label>Select Order Type :</label>
        
          <select class="form-control" id="select_type">
            <option value="NEW" <?php echo $_GET['type']!='RECEIVED'?'selected="seleted"':''?>>NEW</option>
            
            <option value="RECEIVED" <?php echo $_GET['type']=='RECEIVED'?'selected="seleted"':''?>>RECEIVED</option>
         
          </select>

             <!--  <select class="form-control" id="select_type">
              <option value="NEW" <?php echo $_GET['type']!='RECEIVED'?'selected="selected"':''?>>NEW</option>
                 </select> -->

      
      

               

        </div>
      </div>       
        <!-- Main row -->
        <div class="row">
          <div class="col-12">
          <div class="card">
            
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <?php if ($_GET['type']=='RECEIVED') {?>
                  <tr>
                    <th>S.No</th>
                    <th>Purchase No</th>
                    <?php if($_SESSION['type']=='ADMIN'){ ?> 
                    <th>Bill No</th>
                    
                    <th>Vendor Name</th>
                    <?php }?>
                    <th>Received Date</th>
                     <?php if($_SESSION['type']=='ADMIN'){ ?> 
                    <th>Discount</th>
                    <th>Tax Amount</th>
                       <?php }?>
                    <th>Total Amount</th>
                    <?php if($_SESSION['type']=='ADMIN'){ ?>
                    <th>Paid Amount</th>
                    <th>Balance Amount</th>
                  <?php }?>
                    <th >Details</th>
                    <?php if($_SESSION['type']=='ADMIN'){ ?>
                    <th class="w-50" >Pay</th>
                   <?php }?>
                  </tr>
                <?php }else{?>
                   <?php if($_SESSION['type']=='ADMIN'){ ?>
                  <tr>
                    <th>S.No</th>
                    <th>Purchase No</th>
                   
                    <th>Vendor Name</th>
     
                    <th>Discount</th>
                    <th>Tax Amount</th>
                    <th>Total Amount</th>
                    <th>Paid Amount</th>
                    <th>Balance Amount</th>
                    <th>Status</th>
                    
                    <th width="30%">Details</th>
                  </tr>
                <?php }else{ ?>
                    <tr>
                    <th>S.No</th>
                    <th>Purchase No</th>
                    <th>Order Quantity</th>
                    <th>Received Quantity</th>
                    <th>Status</th>
                    
                    <th width="30%">Details</th>
                  </tr>

                <?php } ?>    
                <?php }?>
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
url: '../ajaxCalls/get_purchase_order_new_id.php',
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
url: '../ajaxCalls/get_purchase_order.php',
data: {'type':"<?=$_GET['type']?>"},
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
    var po_id=$("#po_id").val();
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
url: '../ajaxCalls/paid_purchase_order.php',
data: {'paid_amt':paid_amt,'balance':balance,'payment_mode':payment_mode,'po_id':po_id},
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

    window.open('print_page.php?id='+btoa(e),'_blank');
  }
</script>
<script type="text/javascript">
  
function preview_edit_page(id){
var po_id = id;

$.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/update_received_order.php',
data: {'po_id':po_id},
success: function(res){
 if (res.status=='success') {
  
  
 }
}

});

}
function edit_rec_order(id){
window.location="edit_received_order.php?id="+btoa(id);



}
function order_detail(e){


var po_id = $(e).data('id');


var branch_id = $(e).val();



$.ajax({
type: "GET",
dataType:"html",
url: '../ajaxCalls/branch_sale_details.php',
data: {'id':po_id,'branch_id':branch_id},
success: function(res){
  $("#order_modal .modal-body").html(res);
$("#order_modal").modal('show');
}

});
 
}






</script>