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
            <h1 class="m-0">Vendor List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Vendors List</li>
              <li class="breadcrumb-item"><a style="color: #007bff;text-decoration: none;background-color: transparent;cursor: pointer;" id="add_vendor">Add Vendor</a></li>
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
                    <th>S.No</th>
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
  <div class="modal fade" id="delete_vendor_modal" data-backdrop='static'>
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete Brand</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="delete_vendor_id" id="delete_vendor_id">
              <h4>Are You Sure Delete This Vendor....</h4>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
              <button type="button" id="delete_vendor_btn" class="btn btn-primary">Yes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
  <div class="modal fade" id="add_vendor_modal" data-backdrop='static'>
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Vendor Details</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="edit_vendor_id" id="edit_vendor_id" value="0">
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 8.3rem">Name</span>
                  </div>
                  <input type="text" id='vendor_name' class="form-control enterKeyclass" placeholder="Enter Vendor Name">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Company Name</span>
                  </div>
                  <input type="text" id='vendor_company_name' class="form-control enterKeyclass" placeholder="Enter Company Name">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 8.3rem">Mobile.No</span>
                  </div>
                  <input type="number" id='mobile_no' class="form-control enterKeyclass" placeholder="Enter Mobile Number">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 8.3rem">Email</span>
                  </div>
                  <input type="text" id='email' class="form-control enterKeyclass" placeholder="Enter Email">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 8.3rem">Address</span>
                  </div>
                  <input type="text" id='address' class="form-control enterKeyclass" placeholder="Enter Address">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 8.3rem">City</span>
                  </div>
                  <input type="text" id='city' class="form-control enterKeyclass" placeholder="Enter City">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 8.3rem">State</span>
                  </div>
                  <input type="text" id='state' class="form-control enterKeyclass" placeholder="Enter State">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 8.3rem">Country</span>
                  </div>
                  <input type="text" id='country' class="form-control enterKeyclass" placeholder="Enter Country">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 8.3rem">Pincode</span>
                  </div>
                  <input type="text" id='pincode' class="form-control enterKeyclass" placeholder="Enter Pincode">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" id="add_vendor_btn" class="btn btn-primary">Save</button>
              <button type="button" style="display: none" id="edit_vendor_btn" class="btn btn-primary">Update</button>
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
  $("#add_vendor").click(function(){
     $("#add_vendor_modal").modal('show');
        $("#add_vendor_btn").css('display','');
   $("#edit_vendor_btn").css('display','none');
  });
    $('#add_vendor_btn').on('click',function(e){
      var vendor_name=$("#vendor_name").val();
      var vendor_company_name=$("#vendor_company_name").val();
      var mobile_no=$("#mobile_no").val();
      var email=$("#email").val();
      var address=$("#address").val();
      var city=$("#city").val();
      var state=$("#state").val();
      var country=$("#country").val();
      var pincode=$("#pincode").val();
     if (vendor_name=='' && vendor_name==0) {
      global_alert_modal('warning','Enter Vendor Name...');
      $("#vendor_name").css("border","1px solid red");
                    $("#vendor_name").focus();
                    return false;
        }
       else{
        $("#vendor_name").css("border","1px solid lightgray");
       }
       if (vendor_company_name=='' && vendor_company_name==0) {
      global_alert_modal('warning','Enter Vendor Company Name...');
      $("#vendor_company_name").css("border","1px solid red");
                    $("#vendor_company_name").focus();
                    return false;
        }
       else{
        $("#vendor_company_name").css("border","1px solid lightgray");
       }
       if (mobile_no=='' && mobile_no==0) {
      global_alert_modal('warning','Enter Vendor Mobile No...');
      $("#mobile_no").css("border","1px solid red");
                    $("#mobile_no").focus();
                    return false;
        }
       else{
        $("#mobile_no").css("border","1px solid lightgray");
       }
      
  $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/add_vendor.php',
data: {"vendor_name": vendor_name,"mobile_no": mobile_no,"vendor_company_name": vendor_company_name,"email": email,"address": address,"city": city,"state": state,"country": country,"pincode": pincode,"type":'add'},
success: function(res){
if (res.status=='failed') {
  
  global_alert_modal('fail','Vendor Not Added...');
    return false;

}else if (res.status=='alert') {
  
  global_alert_modal('info','This Vendor Name Already Stored...');
  $("#vendor_name").focus();
  $("#vendor_name").val('');
                    return false;

}
else{
    global_alert_modal('success','Vendor Added SuccessFully...');
    $("#vendor_name").val('');
    $("#vendor_company_name").val('');
    $("#mobile_no").val('');
    $("#email").val('');
    $("#address").val('');
    $("#city").val('');
    $("#state").val('');
    $("#country").val('');
    $("#pincode").val('');
    $("#add_vendor_modal").modal('hide');
    get_data();
}
}

});
});
     $('#edit_vendor_btn').on('click',function(e){
      var vendor_name=$("#vendor_name").val();
      var vendor_company_name=$("#vendor_company_name").val();
      var mobile_no=$("#mobile_no").val();
      var email=$("#email").val();
      var address=$("#address").val();
      var city=$("#city").val();
      var state=$("#state").val();
      var country=$("#country").val();
      var pincode=$("#pincode").val();
      var vendor_id=$("#edit_vendor_id").val();
     if (vendor_name=='' && vendor_name==0) {
      global_alert_modal('warning','Enter Vendor Name...');
      $("#vendor_name").css("border","1px solid red");
                    $("#vendor_name").focus();
                    return false;
        }
       else{
        $("#vendor_name").css("border","1px solid lightgray");
       }
       if (vendor_company_name=='' && vendor_company_name==0) {
      global_alert_modal('warning','Enter Vendor Company Name...');
      $("#vendor_company_name").css("border","1px solid red");
                    $("#vendor_company_name").focus();
                    return false;
        }
       else{
        $("#vendor_company_name").css("border","1px solid lightgray");
       }
       if (mobile_no=='' && mobile_no==0) {
      global_alert_modal('warning','Enter Vendor Mobile No...');
      $("#mobile_no").css("border","1px solid red");
                    $("#mobile_no").focus();
                    return false;
        }
       else{
        $("#mobile_no").css("border","1px solid lightgray");
       }
      
  $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/add_vendor.php',
data: {"vendor_name": vendor_name,"mobile_no": mobile_no,"vendor_company_name": vendor_company_name,"email": email,"address": address,"city": city,"state": state,"country": country,"pincode": pincode,"vendor_id": vendor_id,"type":'edit'},
success: function(res){
if (res.status=='failed') {
  
  global_alert_modal('fail','Vendor Not Edited...');
    return false;

}else if (res.status=='alert') {
  
  global_alert_modal('info','This Vendor Name Already Stored...');
  $("#vendor_name").focus();
  $("#vendor_name").val('');
                    return false;

}
else{
    global_alert_modal('success','Vendor Edited SuccessFully...');
    $("#vendor_name").val('');
    $("#vendor_company_name").val('');
    $("#mobile_no").val('');
    $("#email").val('');
    $("#address").val('');
    $("#city").val('');
    $("#state").val('');
    $("#country").val('');
    $("#pincode").val('');
    $("#add_vendor_modal").modal('hide');
    get_data();
}
}

});
});
</script>
<script type="text/javascript">
      $('#delete_vendor_btn').on('click',function(e){
      var vendor_id=$("#delete_vendor_id").val();
    
      
  $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/add_vendor.php',
data: {"vendor_id": vendor_id,"type":"delete"},
success: function(res){
if (res.status=='success') {
  
  global_alert_modal('success','Vendor Delete SuccessFully...');
   $("#delete_vendor_modal").modal('hide');
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
url: '../ajaxCalls/get_vendor_data.php',
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
url: '../ajaxCalls/get_vendor_data.php',
data: {'vendor_id':$(e).data('id')},
success: function(res){
    $("#vendor_name").val(res.name);
    $("#vendor_company_name").val(res.company_name);
    $("#mobile_no").val(res.mobile_no);
    $("#email").val(res.email);
    $("#address").val(res.address);
    $("#city").val(res.city);
    $("#state").val(res.state);
    $("#country").val(res.country);
    $("#pincode").val(res.pincode);
      $("#add_vendor_modal").modal('show');
   $("#edit_vendor_id").val($(e).data('id'));
   $("#add_vendor_btn").css('display','none');
   $("#edit_vendor_btn").css('display','');
}

});


}
function delete_modal(e){
   $("#delete_vendor_modal").modal('show');
   $("#delete_vendor_id").val($(e).data('id'));
   
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
              if($("#add_vendor_btn").css('display')!='none'){
                $("#add_vendor_btn").click();
              }
              if($("#edit_vendor_btn").css('display')!='none'){
                $("#edit_vendor_btn").click();
              }
              
            }
    }
});
</script>