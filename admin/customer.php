<?php 
include 'header.php';
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper watermark_img">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">customer List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">customer List</li>
              <li class="breadcrumb-item"><a style="color: #007bff;text-decoration: none;background-color: transparent;cursor: pointer;" id="add_customer">Add customer</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
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
                    <th>S.No</th>
                    <th>customer Code</th>
                    <th>Name</th>
                    <th>Company Name</th>
                    <th>Mobile No</th>
                    <th>Email</th>
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
  <div class="modal fade" id="delete_customer_modal" data-backdrop='static'>
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Disable customer</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="delete_customer_id" id="delete_customer_id">
              <h4>Are You Sure Disable This customer....</h4>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
              <button type="button" id="delete_customer_btn" class="btn btn-primary">Yes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
  <div class="modal fade" id="add_customer_modal" data-backdrop='static'>
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">customer Details</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" id="customerForm" enctype="multipart/form-data" >
            <div class="modal-body">
              
              <input type="hidden" name="edit_customer_id" id="edit_customer_id" value="0">
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 8.3rem">Name&nbsp;<span class="text-danger">*</span></span>
                  </div>
                  <input type="text" id='customer_name' name='customer_name' class="form-control enterKeyclass" placeholder="Enter customer Name">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Company Name&nbsp;<span class="text-danger">*</span></span>
                  </div>
                  <input type="text" id='customer_company_name' name='customer_company_name' class="form-control enterKeyclass" placeholder="Enter Company Name">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 8.3rem">Mobile.No&nbsp;<span class="text-danger">*</span></span>
                  </div>
                  <input type="number" id='mobile_no' name='mobile_no' class="form-control enterKeyclass" placeholder="Enter Mobile Number">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 8.3rem">Email</span>
                  </div>
                  <input type="text" id='email' name='email' class="form-control enterKeyclass" placeholder="Enter Email">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 8.3rem">Gst.No</span>
                  </div>
                  <input type="text" id='gst' name='gst' class="form-control enterKeyclass" placeholder="Enter GST No">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 8.3rem">Address</span>
                  </div>
                  <input type="text" id='address' name='address' class="form-control enterKeyclass" placeholder="Enter Address">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 8.3rem">City</span>
                  </div>
                  <input type="text" id='city' name='city' class="form-control enterKeyclass" placeholder="Enter City">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 8.3rem">State</span>
                  </div>
                  <input type="text" id='state' name='state' class="form-control enterKeyclass" placeholder="Enter State">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 8.3rem">Country</span>
                  </div>
                  <input type="text" id='country' name='country' class="form-control enterKeyclass" placeholder="Enter Country">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 8.3rem">Pincode</span>
                  </div>
                  <input type="text" id='pincode' name='pincode' class="form-control enterKeyclass" placeholder="Enter Pincode">
                </div>
                 <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 8.3rem">Image</span>
                  </div>
                  <input type="file" id='image' name='image' class="form-control " placeholder="Enter Pincode">
                </div>
              
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" id="add_customer_btn" class="btn btn-primary">Save</button>
              <button type="button" style="display: none" id="edit_customer_btn" class="btn btn-primary">Update</button>
            </div>
            </form>
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
  $(document).ready(function(){
    get_data();
  })
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
<script type="text/javascript">
  $("#add_customer").click(function(){
     $("#add_customer_modal").modal('show');
        $("#add_customer_btn").css('display','');
   $("#edit_customer_btn").css('display','none');
   $("#customerForm")[0].reset();

  });
    $("#customerForm").on('submit', function(e){
        e.preventDefault();
      var customer_name=$("#customer_name").val();
      var customer_company_name=$("#customer_company_name").val();
      var mobile_no=$("#mobile_no").val();
      var email=$("#email").val();
      var address=$("#address").val();
      var city=$("#city").val();
      var state=$("#state").val();
      var country=$("#country").val();
      var pincode=$("#pincode").val();
     if (customer_name=='' && customer_name==0) {
      global_alert_modal('warning','Enter customer Name...');
      $("#customer_name").css("border","1px solid red");
                    $("#customer_name").focus();
                    return false;
        }
       else{
        $("#customer_name").css("border","1px solid lightgray");
       }
       if (customer_company_name=='' && customer_company_name==0) {
      global_alert_modal('warning','Enter customer Company Name...');
      $("#customer_company_name").css("border","1px solid red");
                    $("#customer_company_name").focus();
                    return false;
        }
       else{
        $("#customer_company_name").css("border","1px solid lightgray");
       }
       if (mobile_no=='' && mobile_no==0) {
      global_alert_modal('warning','Enter customer Mobile No...');
      $("#mobile_no").css("border","1px solid red");
                    $("#mobile_no").focus();
                    return false;
        }
       else{
        $("#mobile_no").css("border","1px solid lightgray");
       }
      var formData = new FormData(this); 
            formData.append('type','add');
  $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/add_customer.php',
data: formData,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
success: function(res){
if (res.status=='failed') {
  
  global_alert_modal('fail','customer Not Added...');
    return false;

}else if (res.status=='alert') {
  
  global_alert_modal('info','This customer Name Already Stored...');
  $("#customer_name").focus();
  $("#customer_name").val('');
                    return false;

}
else{
    global_alert_modal('success','customer Added SuccessFully...');
    $("#customer_name").val('');
    $("#customer_company_name").val('');
    $("#mobile_no").val('');
    $("#email").val('');
    $("#address").val('');
    $("#city").val('');
    $("#state").val('');
    $("#country").val('');
    $("#pincode").val('');
    $("#add_customer_modal").modal('hide');
    $("#customerForm")[0].reset();
    get_data();
}
}

});
});
     $('#edit_customer_btn').on('click',function(e){
      var customer_name=$("#customer_name").val();
      var customer_company_name=$("#customer_company_name").val();
      var mobile_no=$("#mobile_no").val();
      var email=$("#email").val();
      var address=$("#address").val();
      var city=$("#city").val();
      var state=$("#state").val();
      var country=$("#country").val();
      var pincode=$("#pincode").val();
      var customer_id=$("#edit_customer_id").val();
     if (customer_name=='' && customer_name==0) {
      global_alert_modal('warning','Enter customer Name...');
      $("#customer_name").css("border","1px solid red");
                    $("#customer_name").focus();
                    return false;
        }
       else{
        $("#customer_name").css("border","1px solid lightgray");
       }
       if (customer_company_name=='' && customer_company_name==0) {
      global_alert_modal('warning','Enter customer Company Name...');
      $("#customer_company_name").css("border","1px solid red");
                    $("#customer_company_name").focus();
                    return false;
        }
       else{
        $("#customer_company_name").css("border","1px solid lightgray");
       }
       if (mobile_no=='' && mobile_no==0) {
      global_alert_modal('warning','Enter customer Mobile No...');
      $("#mobile_no").css("border","1px solid red");
                    $("#mobile_no").focus();
                    return false;
        }
       else{
        $("#mobile_no").css("border","1px solid lightgray");
       }
      var formData = new FormData($("#customerForm")[0]);
      formData.append('type','edit');
  $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/add_customer.php',
data: formData,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
success: function(res){
if (res.status=='failed') {
  
  global_alert_modal('fail','customer Not Edited...');
    return false;

}else if (res.status=='alert') {
  
  global_alert_modal('info','This customer Name Already Stored...');
  $("#customer_name").focus();
  $("#customer_name").val('');
                    return false;

}
else{
    global_alert_modal('success','customer Edited SuccessFully...');
    $("#customer_name").val('');
    $("#customer_company_name").val('');
    $("#mobile_no").val('');
    $("#email").val('');
    $("#address").val('');
    $("#city").val('');
    $("#state").val('');
    $("#country").val('');
    $("#pincode").val('');
    $("#add_customer_modal").modal('hide');
    $("#customerForm")[0].reset();
    get_data();
}
}

});
});
</script>
<script type="text/javascript">
      $('#delete_customer_btn').on('click',function(e){
      var customer_id=$("#delete_customer_id").val();
    
      
  $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/add_customer.php',
data: {"customer_id": customer_id,"type":"delete"},
success: function(res){
if (res.status=='success') {
  
  global_alert_modal('success','customer Delete SuccessFully...');
   $("#delete_customer_modal").modal('hide');
   get_data();

}
}

});
});
</script>
<script type="text/javascript">
  function get_data(){
      $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/get_customer_data.php',
data: {},
success: function(res){
 var table = $('#example1').DataTable();
    table.clear();
    table.rows.add(res).draw();
}

});
  }
</script>
<script type="text/javascript">
function edit_modal(e){
 
    $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/get_customer_data.php',
data: {'customer_id':$(e).data('id')},
success: function(res){
    $("#customer_name").val(res.name);
    $("#customer_company_name").val(res.company_name);
    $("#mobile_no").val(res.mobile_no);
    $("#email").val(res.email);
    $("#address").val(res.address);
    $("#city").val(res.city);
    $("#gst").val(res.gst);
    $("#state").val(res.state);
    $("#country").val(res.country);
    $("#pincode").val(res.pincode);
      $("#add_customer_modal").modal('show');
   $("#edit_customer_id").val($(e).data('id'));
   $("#add_customer_btn").css('display','none');
   $("#edit_customer_btn").css('display','');
}

});


}
function delete_modal(e){
   $("#delete_customer_modal").modal('show');
   $("#delete_customer_id").val($(e).data('id'));
   
}
$(".enterKeyclass").keypress(function (event) {
          item_add='on';
    if (event.keyCode == 13) {
        textboxes = $("input.enterKeyclass");        
        currentBoxNumber = textboxes.index(this);
        if (textboxes[currentBoxNumber + 1] != null) {
            nextBox = textboxes[currentBoxNumber + 1];
            nextBox.focus();
            nextBox.select();
            event.preventDefault();
            return false; 
            }else{
              if($("#add_customer_btn").css('display')!='none'){
                $("#add_customer_btn").click();
              }
              if($("#edit_customer_btn").css('display')!='none'){
                $("#edit_customer_btn").click();
              }
              
            }
    }
});
</script>