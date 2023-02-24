<?php 
include 'header.php';


?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Return Items List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
   
              
              
          
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Return List</li>
             
          
              
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
          <div class="col-6">
          <div class="card">
            
              <div class="card-body">
                <h5>Quantity Return From</h5>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    
                  <tr>
                    <th>S.No</th>
                     <th>Return Date</th>
                     <th>From</th>
                      
                    <th>Quantity</th>
                    <th>Details</th>
                  </tr>

                  </thead>
                  <tbody>
                  
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>

        
         <div class="col-6">
          <div class="card">
            
              <div class="card-body">
                <h5>Quantity Return To</h5>
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                    
                  <tr>
                    <th>S.No</th>
                     <th>Return Date</th>
                      <th>To</th>
                    <th>Quantity</th>
                    <th>Details</th>
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
<script>
  $(function () {
    $("#example2").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
  });
</script>
<script type="text/javascript">
  function detail_return(e){

$.ajax({
type: "GET",
dataType:"html",
url: '../ajaxCalls/get_return_item_id.php',
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
url: '../ajaxCalls/branch_return_item.php',
data: {},
success: function(res){
 var table = $('#example1').DataTable();
    table.clear();
    table.rows.add(res.res).draw();
 var table = $('#example2').DataTable();
    table.clear();
    table.rows.add(res.res1).draw();   
}

});
  }
  
</script>
