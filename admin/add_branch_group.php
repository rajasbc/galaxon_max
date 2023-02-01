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
            <h1 class="m-0">Branch Group List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Branch Group List</li>
              <li class="breadcrumb-item"><a style="color: #007bff;text-decoration: none;background-color: transparent;cursor: pointer;" id="add_group">Add Group</a></li>
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
                <table id="group_table" class="table table-bordered table-striped">
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
  <div class="modal fade" id="add_group_modal" data-backdrop='static'>
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Group</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Name&nbsp;<span class="text-danger">*</span></span>
                  </div>
                  <input type="text" id='group_name' class="form-control enterTab" placeholder="Enter Group Name">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" id="add_group_btn" class="btn btn-primary enterTab">Save</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <div class="modal fade" id="edit_group_modal" data-backdrop='static'>
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Group Name</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="edit_group_id" id="edit_group_id">
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Name&nbsp;<span class="text-danger">*</span></span>
                  </div>
                  <input type="text" id='edit_group_name' class="form-control enterAsTab" placeholder="Enter Group Name">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" id='edit_group_btn' class="btn btn-primary enterAsTab">Save</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <div class="modal fade" id="delete_group_modal" data-backdrop='static'>
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete Group</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="delete_group_id" id="delete_group_id">
              <h4>Are You Sure Delete This Group....</h4>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
              <button type="button" id="delete_group_btn" class="btn btn-primary">Yes</button>
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
          $("#add_group_btn").click();
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
          $("#edit_group_btn").click();
         }
     }
 });

    </script>

<script>
  $(function () {
    var main_table= $("#group_table").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#group_table_wrapper .col-md-6:eq(0)');
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
 group_name_data();
  })
</script>
<script type="text/javascript">
  $("#add_group").click(function(){

     $("#add_group_modal").modal('show');
     $("#group_name").focus();
  })
</script>
<script type="text/javascript">
  $('#add_group_btn').on('click',function(e){

      var group_name=$("#group_name").val();
     if (group_name=='' && group_name==0) {
      global_alert_modal('warning','Enter Group Name...');
      $("#group_name").css("border","1px solid red");
                    $("#group_name").focus();
                    return false;
        }
       else{
        $("#group_name").css("border","1px solid lightgray");
       }
      
  $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/add_branch_group.php',
data: {"group_name": group_name,"type":'add'},
success: function(res){
if (res.status=='failed') {
  
  global_alert_modal('fail','Group Not Added...');
    return false;

}else if (res.status=='alert') {
  
  global_alert_modal('info','This Group Already Stored...');
  $("#group_name").focus();
  $("#group_name").val('');
                    return false;

}
else{
   global_alert_modal('success','Group Added SuccessFully...');
   $("#group_name").val('');
   $("#add_group_modal").modal('hide');
   group_name_data();
}
}

});
});
$("#edit_group_btn").on('click',function(e){
   
      var group_name=$("#edit_group_name").val();
     
      var group_id=$("#edit_group_id").val();
     if (group_name=='' && group_name==0) {
      global_alert_modal('warning','Enter Group Name...');
      $("#edit_group_name").css("border","1px solid red");
                    $("#edit_group_name").focus();
                    return false;
        }
       else{
        $("#edit_group_name").css("border","1px solid lightgray");
       }
      
  $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/add_branch_group.php',
data: {"group_name": group_name,"group_id": group_id,"type":"edit"},
success: function(res){
if (res.status=='failed') {
  
  global_alert_modal('fail','Group Not Added...');
    return false;

}else if (res.status=='alert') {
  
  global_alert_modal('info','This GroupName Already Stored...');
  $("#edit_group_name").focus();
  $("#edit_group_name").val('');
                    return false;

}
else{
   global_alert_modal('success','GroupName Edit SuccessFully...');
   $("#edit_group_name").val('');
   $("#edit_group_modal").modal('hide');
   group_name_data();

}

}
});
});  
      $('#delete_group_btn').on('click',function(e){
  
      var group_id=$("#delete_group_id").val();
    
      
  $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/add_branch_group.php',
data: {"group_id": group_id,"type":"delete"},
success: function(res){
if (res.status=='success') {
  
  global_alert_modal('success','Group Delete SuccessFully...');
   $("#delete_group_modal").modal('hide');
   group_name_data();

}
}

});
});
</script>
<script type="text/javascript">
function group_name_data(){
      $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/get_branch_group_data.php',
data: {},
success: function(res){
 var table = $('#group_table').DataTable();
    table.clear();
    table.rows.add(res).draw();
}

});
  }
</script>
<script type="text/javascript">
function edit_modal(e){
   $("#edit_group_modal").modal('show');
   $("#edit_group_id").val($(e).data('id'));
   $("#edit_group_name").val($(e).data('form')).focus();


}
function delete_modal(e){
   $("#delete_group_modal").modal('show');
   $("#delete_group_id").val($(e).data('id'));
   
}
</script>