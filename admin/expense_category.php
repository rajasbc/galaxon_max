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
            <h1 class="m-0">Expense Category List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Expense Category List</li>
              <li class="breadcrumb-item"><a style="color: #007bff;text-decoration: none;background-color: transparent;cursor: pointer;" id="add_category">Add Category</a></li>
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
                <table id="category_table" class="table table-bordered table-striped">
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
  <div class="modal fade" id="add_category_modal" data-backdrop='static'>
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Category</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Name&nbsp;<span class="text-danger">*</span></span>
                  </div>
                  <input type="text" id='category_name' class="form-control enterTab" placeholder="Enter Category Name">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" id="add_category_btn" class="btn btn-primary enterTab">Save</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
            <div class="modal fade" id="edit_category_modal" data-backdrop='static'>
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Category</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="edit_category_id" id="edit_category_id">
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Name&nbsp;<span class="text-danger">*</span></span>
                  </div>
                  <input type="text" id='edit_category_name' class="form-control enterAsTab" placeholder="Enter Category Name">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" id="edit_category_btn" class="btn btn-primary enterAsTab">Save</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <div class="modal fade" id="delete_category_modal" data-backdrop='static'>
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete Category</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="delete_category_id" id="delete_category_id">
              <h4>Are You Sure Delete This Category....</h4>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
              <button type="button" id="delete_category_btn" class="btn btn-primary">Yes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <div class="modal fade" id="add_sub_modal" data-backdrop='static'>
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Sub Category</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="main_category_id" id="main_category_id">
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Sub Category Name</span>
                  </div>
                  <input type="text" id='sub_category_name' class="form-control" placeholder="Enter Sub Category Name">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" id="add_sub_btn" class="btn btn-primary">Save</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <div class="modal fade" id="view_sub_modal" data-backdrop='static'>
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Sub Category</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="main_cat_id" id="main_cat_id">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="main_sub_table">
                  
                </tbody>
              </table>
            </div>
           <!--  <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" id="add_sub_btn" class="btn btn-primary">Save</button>
            </div> -->
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
  <?php 
include 'footer.php';
?>

<script type="text/javascript">
       
       $('.enterTab').keydown(function (e) {

     if (e.which === 13) {
         var index = $('.enterTab').index(this) + 1;
         $('.enterTab').eq(index).focus();
         if ($(this).attr('id')=='password') {
          $("#add_brand_btn").click();
         }
     }
 });

</script>
<script type="text/javascript">
       
       $('.enterAsTab').keydown(function (e) {

     if (e.which === 13) {
         var index = $('.enterAsTab').index(this) + 1;
         $('.enterAsTab').eq(index).focus();
         if ($(this).attr('id')=='password') {
          $("#edit_brand_btn").click();
         }
     }
 });

    </script>






<script>
  $(function () {
    $("#category_table").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#category_table_wrapper .col-md-6:eq(0)');
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
categorys_data();
  })
</script>
<script type="text/javascript">
  $("#add_category").click(function(){
     $("#add_category_modal").modal('show');
  })
</script>
<script type="text/javascript">
  $('#add_category_btn').on('click',function(e){
      var category_name=$("#category_name").val();
     if (category_name=='' && category_name==0) {
      global_alert_modal('warning','Enter Category Name...');
      $("#category_name").css("border","1px solid red");
                    $("#category_name").focus();
                    return false;
        }
       else{
        $("#category_name").css("border","1px solid lightgray");
       }
      
  $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/add_expense_category.php',
data: {"category_name": category_name,"type":'add'},
success: function(res){
if (res.status=='failed') {
  
  global_alert_modal('fail','Category Not Added...');
    return false;

}else if (res.status=='alert') {
  
  global_alert_modal('info','This CategoryName Already Stored...');
  $("#category_name").focus();
  $("#category_name").val('');
                    return false;

}
else{
   global_alert_modal('success','Category Added SuccessFully...');
   $("#category_name").val('');
   $("#add_category_modal").modal('hide');
   categorys_data();
}
}

});
});
    $('#edit_category_btn').on('click',function(e){
      var category_name=$("#edit_category_name").val();
      var category_id=$("#edit_category_id").val();
     if (category_name=='' && category_name==0) {
      global_alert_modal('warning','Enter Category Name...');
      $("#edit_category_name").css("border","1px solid red");
                    $("#category_name").focus();
                    return false;
        }
       else{
        $("#edit_category_name").css("border","1px solid lightgray");
       }
      
  $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/add_expense_category.php',
data: {"category_name": category_name,"category_id": category_id,"type":"edit"},
success: function(res){
if (res.status=='failed') {
  
  global_alert_modal('fail','category Not Added...');
    return false;

}else if (res.status=='alert') {
  
  global_alert_modal('info','This CategoryName Already Stored...');
  $("#edit_category_name").focus();
  $("#edit_category_name").val('');
                    return false;

}
else{
   global_alert_modal('success','Category Edit SuccessFully...');
   $("#edit_category_name").val('');
   $("#edit_category_modal").modal('hide');
   categorys_data();
}
}

});
});
    $('#add_sub_btn').on('click',function(e){
      var sub_category_name=$("#sub_category_name").val();
      var category_id=$("#main_category_id").val();
     if (sub_category_name=='' && sub_category_name==0) {
      global_alert_modal('warning','Enter Sub Category Name...');
      $("#sub_category_name").css("border","1px solid red");
                    $("#category_name").focus();
                    return false;
        }
       else{
        $("#sub_category_name").css("border","1px solid lightgray");
       }
      
  $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/add_category.php',
data: {"sub_category_name": sub_category_name,"category_id": category_id,"type":"add"},
success: function(res){
if (res.status=='failed') {
  
  global_alert_modal('fail','Sub Category Not Added...');
    return false;

}else if (res.status=='alert') {
  
  global_alert_modal('info','This Sub CategoryName Already Stored...');
  $("#sub_category_name").focus();
  $("#sub_category_name").val('');
                    return false;

}
else{
   global_alert_modal('success','Sub Category Added SuccessFully...');
   $("#sub_category_name").val('');
   $("#add_sub_modal").modal('hide');
   categorys_data();
}
}

});
});
      $('#delete_category_btn').on('click',function(e){
      var category_id=$("#delete_category_id").val();
    
      
  $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/add_expense_category.php',
data: {"category_id": category_id,"type":"delete"},
success: function(res){
if (res.status=='success') {
  
  global_alert_modal('success','Category Delete SuccessFully...');
   $("#delete_category_modal").modal('hide');
   categorys_data();

}
}

});
});
function delete_sub_modal(e){
      var category_id=$(e).data('id');
    
      
  $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/add_category.php',
data: {"category_id": category_id,"type":"delete"},
success: function(res){
if (res.status=='success') {
  
  global_alert_modal('success','Sub Category Delete SuccessFully...');
    $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/get_category_data.php',
data: {'category_id':$('#main_cat_id').val()},
success: function(res){
$('#main_sub_table').html(res);
}

});

}
}

});
};
</script>
<script type="text/javascript">
  function categorys_data(){
      $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/get_expense_category_data.php',
data: {},
success: function(res){
 var table = $('#category_table').DataTable();
    table.clear();
    table.rows.add(res).draw();
}

});
  }
</script>
<script type="text/javascript">
function edit_modal(e){
   $("#edit_category_modal").modal('show');
   $("#edit_category_id").val($(e).data('id'));
   $("#edit_category_name").val($(e).data('form'));


}
function delete_modal(e){
   $("#delete_category_modal").modal('show');
   $("#delete_category_id").val($(e).data('id'));
   
}
function add_sub_modal(e){
   $("#add_sub_modal").modal('show');
   $("#main_category_id").val($(e).data('id'));
   
}
function view_sub_modal(e){
   $("#view_sub_modal").modal('show');
   $("#main_cat_id").val($(e).data('id'));
         $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/get_category_data.php',
data: {'category_id':$(e).data('id')},
success: function(res){
$('#main_sub_table').html(res);
}

});
   
}
</script>