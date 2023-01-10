<?php 
include 'header.php';

$obj = new Shops();
$branch = $obj->show_branch();

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper watermark_img">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Branch Stock List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Branch Stock</li>
             
            </ol>
          </div>
       
		
					


      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content ">
      <div class="container-fluid">
        
        <!-- Main row -->
        <div class="row">
          <div class="col-12">
          <div class="card">
            
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="width: 20px">S.No</th>
                    <th style="width: 100px">Name</th>
                    <th style="width: 100px">Branch Code</th>
           <!--          <th style="width: 80px">Product Name</th> -->
                    <th style="width: 100px">Available Quantity</th>
                    <th style="width: 100px">Action</th>
           
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
   
  </div>
  




  <?php 
include 'footer.php';
?>





     
<script>
  $(document).ready(function(){
    get_data();
  })
 
</script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
<script type="text/javascript">
  function get_data(){

  $.ajax({
      type:'post',
      url:'../ajaxCalls/view_branch_stock.php',
      dataType:'JSON',
      data:{},
      success:function(res){
        var table = $('#example1').DataTable();
        table.clear();
        table.rows.add(res).draw();

      }

  });

  }
</script>
<script type="text/javascript">
  function view_stock_item(e){

var branch_id = $(e).data('id');

$.ajax({
     type:'post',
     dataType:'JSON',
     url:'../ajaxCalls/view_branch_variety.php',
     data:{'branch_id':branch_id},

});
  }






</script>


