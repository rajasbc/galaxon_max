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
            <h1 class="m-0">Department List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Department List</li>
              <li class="breadcrumb-item"><a style="color: #007bff;text-decoration: none;background-color: transparent;cursor: pointer;" id="add_department">Add Department</a></li>
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
                <table id="department_table" class="table table-bordered table-striped">
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
  <div class="modal fade" id="add_department_modal" tabindex="1" data-backdrop='static'>
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Department</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text">Department Name&nbsp;<span class="text-danger">*</span></label>
                  </div>
                  <input type="text" id="department_name" class="form-control enterTab" placeholder="Enter Department Name" autofocus="true">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" id="add_department_btn" class="btn btn-primary enterTab">Save</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <div class="modal fade" id="edit_department_modal" data-backdrop='static'>
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Department</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="edit_department_id" id="edit_department_id">
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Department Name&nbsp;<span class="text-danger">*</span></span>
                  </div>
                  <input type="text" id='edit_department_name' class="form-control enterAsTab" placeholder="Enter Department Name">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <input  type="button" id="edit_department_btn" class="btn btn-primary enterAsTab" value="Save">
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <div class="modal fade" id="delete_department_modal" data-backdrop='static'>
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete Department</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="delete_department_id" id="delete_department_id">
              <h4>Are You Sure Delete This Department....</h4>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
              <button type="button" id="delete_department_btn" class="btn btn-primary">Yes</button>
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
<script type="text/javascript">
       
       $('.enterTab').keydown(function (e) {

     if (e.which === 13) {
         var index = $('.enterTab').index(this) + 1;
         $('.enterTab').eq(index).focus();
         if ($(this).attr('id')=='password') {
          $("#add_department_btn").click();
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
          $("#edit_department_btn").click();
         }
     }
 });

    </script>


<script>
  $(function () {
    var main_table= $("#department_table").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#department_table_wrapper .col-md-6:eq(0)');
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
departments_data();
  })
</script>

<script type="text/javascript">
  $("#add_department").click(function(){

  
     $("#add_department_modal").modal('show');
     
 

  });
</script>
<script type="text/javascript">
  $('#add_department_btn').on('click',function(e){
      var department_name=$("#department_name").val();
     if (department_name=='' && department_name==0) {
      global_alert_modal('warning','Enter department Name...');
      $("#department_name").css("border","1px solid red");
                    $("#department_name").focus();
                    return false;
        }
       else{
        $("#department_name").css("border","1px solid lightgray");
       }
      
  $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/add_department.php',
data: {"department_name":department_name,"type":'add'},
success: function(res){
if (res.status=='failed') {
  
  global_alert_modal('fail','Department Not Added...');
    return false;

}else if (res.status=='alert') {
  
  global_alert_modal('info','This DepartmentName Already Stored...');
  $("#department_name").focus();
  $("#department_name").val('');
                    return false;

}
else{
   global_alert_modal('success','department Added SuccessFully...');
   $("#department_name").val('');
   $("#add_department_modal").modal('hide');
   departments_data();
}
}

});
});
    $('#edit_department_btn').on('click',function(e){
      var department_name=$("#edit_department_name").val();
      var department_id=$("#edit_department_id").val();
     if (department_name=='' && department_name==0) {
      global_alert_modal('warning','Enter Department Name...');
      $("#edit_department_name").css("border","1px solid red");
                    $("#edit_department_name").focus();
                    return false;
        }
       else{
        $("#edit_department_name").css("border","1px solid lightgray");
       }
      
  $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/add_department.php',
data: {"department_name": department_name,"department_id": department_id,"type":"edit"},
success: function(res){
if (res.status=='failed') {
  
  global_alert_modal('fail','Department Not Added...');
    return false;

}else if (res.status=='alert') {
  
  global_alert_modal('info','This DepartmentName Already Stored...');
  $("#edit_department_name").focus();
  $("#edit_department_name").val('');
                    return false;

}
else{
   global_alert_modal('success','Department Edit SuccessFully...');
   $("#edit_department_name").val('');
   $("#edit_department_modal").modal('hide');
   departments_data();
}
}

});
});
      $('#delete_department_btn').on('click',function(e){
      var department_id=$("#delete_department_id").val();
    
      
  $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/add_department.php',
data: {"department_id":department_id,"type":"delete"},
success: function(res){
if (res.status=='success') {
  
  global_alert_modal('success','Department Delete SuccessFully...');
   $("#delete_department_modal").modal('hide');
   departments_data();

}
}

});
});
</script>
<script type="text/javascript">
  function departments_data(){
      $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/get_department_data.php',
data: {},
success: function(res){
 var table = $('#department_table').DataTable();
    table.clear();
    table.rows.add(res).draw();
}

});
  }
</script>
<script type="text/javascript">
function edit_modal(e){
  $("#edit_department_name").val($(e).data('form')).focus();
   $("#edit_department_modal").modal('show');
   $("#edit_department_id").val($(e).data('id'));
   $("#edit_department_name").val($(e).data('form')).focus();


}
function delete_modal(e){
   $("#delete_department_modal").modal('show');
   $("#delete_department_id").val($(e).data('id'));
   
}
</script>