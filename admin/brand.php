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
            <h1 class="m-0">Brands List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Brands List</li>
              <li class="breadcrumb-item"><a style="color: #007bff;text-decoration: none;background-color: transparent;cursor: pointer;" id="add_brand">Add Brand</a></li>
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
                <table id="brand_table" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Action</th>
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
  <div class="modal fade" id="add_brand_modal" data-backdrop='static'>
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Brand</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Name</span>
                  </div>
                  <input type="text" id='brand_name' class="form-control" placeholder="Enter Brand Name">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" id="add_brand_btn" class="btn btn-primary">Save</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <div class="modal fade" id="edit_brand_modal" data-backdrop='static'>
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Brand</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="edit_brand_id" id="edit_brand_id">
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Name</span>
                  </div>
                  <input type="text" id='edit_brand_name' class="form-control" placeholder="Enter Brand Name">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" id="edit_brand_btn" class="btn btn-primary">Save</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <div class="modal fade" id="delete_brand_modal" data-backdrop='static'>
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete Brand</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="delete_brand_id" id="delete_brand_id">
              <h4>Are You Sure Delete This Brand....</h4>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
              <button type="button" id="delete_brand_btn" class="btn btn-primary">Yes</button>
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
    var main_table= $("#brand_table").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#brand_table_wrapper .col-md-6:eq(0)');
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
brands_data();
  })
</script>
<script type="text/javascript">
  $("#add_brand").click(function(){

     $("#add_brand_modal").modal('show');
     $("#brand_name").focus();
  })
</script>
<script type="text/javascript">
  $('#add_brand_btn').on('click',function(e){
      var brand_name=$("#brand_name").val();
     if (brand_name=='' && brand_name==0) {
      global_alert_modal('warning','Enter Brand Name...');
      $("#brand_name").css("border","1px solid red");
                    $("#brand_name").focus();
                    return false;
        }
       else{
        $("#brand_name").css("border","1px solid lightgray");
       }
      
  $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/add_brand.php',
data: {"brand_name": brand_name,"type":'add'},
success: function(res){
if (res.status=='failed') {
  
  global_alert_modal('fail','Brand Not Added...');
    return false;

}else if (res.status=='alert') {
  
  global_alert_modal('info','This BrandName Already Stored...');
  $("#brand_name").focus();
  $("#brand_name").val('');
                    return false;

}
else{
   global_alert_modal('success','Brand Added SuccessFully...');
   $("#brand_name").val('');
   $("#add_brand_modal").modal('hide');
   brands_data();
}
}

});
});
    $('#edit_brand_btn').on('click',function(e){
      var brand_name=$("#edit_brand_name").val();
      var brand_id=$("#edit_brand_id").val();
     if (brand_name=='' && brand_name==0) {
      global_alert_modal('warning','Enter Brand Name...');
      $("#edit_brand_name").css("border","1px solid red");
                    $("#edit_brand_name").focus();
                    return false;
        }
       else{
        $("#edit_brand_name").css("border","1px solid lightgray");
       }
      
  $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/add_brand.php',
data: {"brand_name": brand_name,"brand_id": brand_id,"type":"edit"},
success: function(res){
if (res.status=='failed') {
  
  global_alert_modal('fail','Brand Not Added...');
    return false;

}else if (res.status=='alert') {
  
  global_alert_modal('info','This BrandName Already Stored...');
  $("#edit_brand_name").focus();
  $("#edit_brand_name").val('');
                    return false;

}
else{
   global_alert_modal('success','Brand Edit SuccessFully...');
   $("#edit_brand_name").val('');
   $("#edit_brand_modal").modal('hide');
   brands_data();
}
}

});
});
      $('#delete_brand_btn').on('click',function(e){
      var brand_id=$("#delete_brand_id").val();
    
      
  $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/add_brand.php',
data: {"brand_id": brand_id,"type":"delete"},
success: function(res){
if (res.status=='success') {
  
  global_alert_modal('success','Brand Delete SuccessFully...');
   $("#delete_brand_modal").modal('hide');
   brands_data();

}
}

});
});
</script>
<script type="text/javascript">
  function brands_data(){
      $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/get_brand_data.php',
data: {},
success: function(res){
 var table = $('#brand_table').DataTable();
    table.clear();
    table.rows.add(res).draw();
}

});
  }
</script>
<script type="text/javascript">
function edit_modal(e){
   $("#edit_brand_modal").modal('show');
   $("#edit_brand_id").val($(e).data('id'));
   $("#edit_brand_name").val($(e).data('form')).focus();


}
function delete_modal(e){
   $("#delete_brand_modal").modal('show');
   $("#delete_brand_id").val($(e).data('id'));
   
}
</script>