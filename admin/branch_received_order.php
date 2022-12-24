<?php
include 'header.php';
?>


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Branch OrderList</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Received List</li>
             
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
                   <th style="width: 33px padding-right: 25px;">S.No</th>
                    <th style="width: 50px padding-right: 20px; padding-left: 10px ;">Purchase No</th>
                    <th style="width: 50px;">Branch Name</th>
                  <!--   <th >Branch code</th> -->
                    <th>Received Date</th>
                    <th style="width: 30px; padding-right: 25px; padding-left: 10px">Discount</th>
                    <th>Tax Amount</th>
                    <th>Total Amount</th>
                    <th>Paid Amount</th>
                    <th style="width: 30px; padding-right: 25px;">Balance Amount</th>
                    <th style="width: 30px;  padding-right: 25px;">Status</th>
                    <th style="width: 100px;">Details</th>
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
     <div class="modal fade" id="order_modal" data-backdrop='static'>
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-body">
             
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
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

<script type="text/javascript">
$(document).ready(function(){

get_order();

});	

function order_detail(e){


var po_id = $(e).data('id');
// alert(po_id);



$.ajax({
type: "GET",
dataType:"html",
url: '../ajaxCalls/get_order_details.php',
data: {'id':po_id},
success: function(res){
  $("#order_modal .modal-body").html(res);
$("#order_modal").modal('show');
}

});
 
}
function sale_detail(e){

var po_id = $(e).data('id');

// var po_no = $(e).val();

window.location='sale_page.php?id='+btoa(po_id);




}

</script>



<script type="text/javascript">
function get_order(){

$.ajax({

  type:'POST',
  dataType:'json',
  url:'../ajaxCalls/get_branch_order.php',
  data:{},
  success:function(res){
   
   var table = $('#example1').DataTable();
     table.clear();
     table.rows.add(res).draw();

  }

});

}	

</script>