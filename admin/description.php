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
            <h1 class="m-0">Descriptions List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Descriptions List</li>
              <li class="breadcrumb-item"><a style="color: #007bff;text-decoration: none;background-color: transparent;cursor: pointer;" id="add_description">Add Description</a></li>
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
                <table id="description_table" class="table table-bordered table-striped">
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
  <div class="modal fade" id="add_description_modal" data-backdrop='static'>
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Description</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Name&nbsp;<span class="text-danger">*</span></span>
                  </div>
                  <input type="text" id='description_name' class="form-control enterTab" placeholder="Enter Description Name">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" id="add_description_btn" class="btn btn-primary enterTab">Save</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <div class="modal fade" id="edit_description_modal" data-backdrop='static'>
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit description</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="edit_description_id" id="edit_description_id">
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Name&nbsp;<span class="text-danger">*</span></span>
                  </div>
                  <input type="text" id='edit_description_name' class="form-control enterAsTab" placeholder="Enter Description Name">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" id="edit_description_btn" class="btn btn-primary enterAsTab">Save</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <div class="modal fade" id="delete_description_modal" data-backdrop='static'>
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete description</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="delete_description_id" id="delete_description_id">
              <h4>Are You Sure Delete This Description....</h4>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
              <button type="button" id="delete_description_btn" class="btn btn-primary">Yes</button>
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
          $("#add_description_btn").click();
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
          $("#edit_description_btn").click();
         }
     }
 });

    </script>






<script>
  $(function () {
    var main_table= $("#description_table").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#description_table_wrapper .col-md-6:eq(0)');
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
descriptions_data();
  })
</script>
<script type="text/javascript">
  $("#add_description").click(function(){

     $("#add_description_modal").modal('show');
     $("#description_name").focus();
  })
</script>
<script type="text/javascript">
  $('#add_description_btn').on('click',function(e){
      var description_name=$("#description_name").val();
     if (description_name=='' && description_name==0) {
      global_alert_modal('warning','Enter Description Name...');
      $("#description_name").css("border","1px solid red");
                    $("#description_name").focus();
                    return false;
        }
       else{
        $("#description_name").css("border","1px solid lightgray");
       }
      
  $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/add_description.php',
data: {"description_name": description_name,"type":'add'},
success: function(res){
if (res.status=='failed') {
  
  global_alert_modal('fail','Description Not Added...');
    return false;

}else if (res.status=='alert') {
  
  global_alert_modal('info','This DescriptionName Already Stored...');
  $("#description_name").focus();
  $("#description_name").val('');
                    return false;

}
else{
   global_alert_modal('success','Description Added SuccessFully...');
   $("#description_name").val('');
   $("#add_description_modal").modal('hide');
   descriptions_data();
}
}

});
});
    $('#edit_description_btn').on('click',function(e){
      var description_name=$("#edit_description_name").val();
      var description_id=$("#edit_description_id").val();
     if (description_name=='' && description_name==0) {
      global_alert_modal('warning','Enter Description Name...');
      $("#edit_description_name").css("border","1px solid red");
                    $("#edit_description_name").focus();
                    return false;
        }
       else{
        $("#edit_description_name").css("border","1px solid lightgray");
       }
      
  $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/add_description.php',
data: {"description_name": description_name,"description_id": description_id,"type":"edit"},
success: function(res){
if (res.status=='failed') {
  
  global_alert_modal('fail','Description Not Added...');
    return false;

}else if (res.status=='alert') {
  
  global_alert_modal('info','This DescriptionName Already Stored...');
  $("#edit_description_name").focus();
  $("#edit_description_name").val('');
                    return false;

}
else{
   global_alert_modal('success','Description Edit SuccessFully...');
   $("#edit_description_name").val('');
   $("#edit_description_modal").modal('hide');
   descriptions_data();
}
}

});
});
      $('#delete_description_btn').on('click',function(e){
      var description_id=$("#delete_description_id").val();
    
      
  $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/add_description.php',
data: {"description_id": description_id,"type":"delete"},
success: function(res){
if (res.status=='success') {
  
  global_alert_modal('success','Description Delete SuccessFully...');
   $("#delete_description_modal").modal('hide');
   descriptions_data();

}
}

});
});
</script>
<script type="text/javascript">
  function descriptions_data(){
      $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/get_description_data.php',
data: {},
success: function(res){
 var table = $('#description_table').DataTable();
    table.clear();
    table.rows.add(res).draw();
}

});
  }
</script>
<script type="text/javascript">
function edit_modal(e){
   $("#edit_description_modal").modal('show');
   $("#edit_description_id").val($(e).data('id'));
   $("#edit_description_name").val($(e).data('form')).focus();


}
function delete_modal(e){
   $("#delete_description_modal").modal('show');
   $("#delete_description_id").val($(e).data('id'));
   
}
</script>