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
            <h1 class="m-0">Branch List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Branch List</li>
              <li class="breadcrumb-item"><a style="color: #007bff;text-decoration: none;background-color: transparent;cursor: pointer;" id="add_branch">Add Branch</a></li>
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
                    <th>Name</th>
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
  <div class="modal fade" id="delete_branch_modal" data-backdrop='static'>
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete Branch</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="delete_branch_id" id="delete_branch_id">
              <h4>Are You Sure Disable This Branch....</h4>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
              <button type="button" id="delete_branch_btn" class="btn btn-primary">Yes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
  <div class="modal fade" id="add_branch_modal" data-backdrop='static'>
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Branch Details</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" id="branchForm" enctype="multipart/form-data" >
            <div class="modal-body">
              
              <input type="hidden" name="edit_branch_id" id="edit_branch_id" value="0">
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 8.3rem">Name&nbsp;</span>
                  </div>
                  <input type="text" id='name' name='name' class="form-control enterKeyclass" placeholder="Enter Name">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Registration Number&nbsp;</span>
                  </div>
                  <input type="text" id='registration_no' name='registration_no' class="form-control enterKeyclass" placeholder="Enter Registration Number">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 8.3rem">Gst.No</span>
                  </div>
                  <input type="text" id='gst_no' name='gst_no' class="form-control enterKeyclass" placeholder="Enter GST No">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 8.3rem">Email</span>
                  </div>
                  <input type="text" id='email' name='email' class="form-control enterKeyclass" placeholder="Enter Email">
                  </div>
                  <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 8.3rem">Address</span>
                  </div>
                  <input type="text" id='address' name='address' class="form-control enterKeyclass" placeholder="Enter Address">
                </div>
                 <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 8.3rem">Country</span>
                  </div>
                  <input type="text" id='country' name='country' class="form-control enterKeyclass" placeholder="Enter Country">
                </div>
                 <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 8.3rem">State</span>
                  </div>
                  <input type="text" id='state' name='state' class="form-control enterKeyclass" placeholder="Enter State">
                </div>
                 <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 8.3rem">Pincode</span>
                  </div>
                  <input type="text" id='pincode' name='pincode' class="form-control enterKeyclass" placeholder="Enter Pincode">
                </div>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 8.3rem">Mobile.No&nbsp;</span>
                  </div>
                  <input type="number" id='mobile_no' name='mobile_no' class="form-control enterKeyclass" placeholder="Enter Mobile Number">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 8.3rem">Alternative Mobile Number&nbsp;
                  </div>
                  <input type="number" id='alt_mobile_no' name='alt_mobile_no' class="form-control enterKeyclass" placeholder="Enter Alternative Mobile Number">
                </div>

                 <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 8.3rem">Telephone Number&nbsp;
                  </div>
                  <input type="number" id='Landline_no' name='Landline_no' class="form-control enterKeyclass" placeholder="Enter Telephone Number">
                </div>
                 <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 8.3rem">User Name&nbsp;</span>
                  </div>
                  <input type="text" id='username' name='username' class="form-control enterKeyclass" placeholder="Enter User Name">
                </div>
                <div class="input-group mb-3" id="passcheck">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 8.3rem">Password&nbsp;</span>
                  </div>
                  <input type="password" id='password' name='password' class="form-control enterKeyclass " style="width: 8.3rem" placeholder="Enter Password">
               
                 <div class="input-group-append">
              <span class="input-group-text" id="basic-addon2">
                <div class="input-group-addon">
                 <a href="#" id='psh'><i class="fa fa-eye" ></i></a>

               </div>
             </span>
           </div>
            </div>
                
                
               
               
               
              
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" id="add_branch_btn" class="btn btn-primary">Save</button>
              <button type="button" style="display: none" id="edit_branch_btn" class="btn btn-primary">Update</button>
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
    $("#psh").on('click', function(event) {

            event.preventDefault();
        if($('#passcheck input').attr("type") == "text"){
            $('#passcheck input').attr('type', 'password');
            //$('#confirmPassword a svg').removeClass( '' );
           $('#psh').html( '<i class="fa fa-eye" aria-hidden="true"></i>' );

        }else if($('#passcheck input').attr("type") == "password"){

            $('#passcheck input').attr('type', 'text');
           //$('#confirmPassword i').removeClass( "fa-eye-slash" );
            $('#psh').html('<i class="fa fa-eye-slash" aria-hidden="true"></i>');
        }
    });
</script>



<script>
  $(document).ready(function(){
    get_data();
  })
  // $(function () {
  //   $("#example1").DataTable({
  //     "responsive": true, "lengthChange": false, "autoWidth": false,
  //     "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
  //   }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  // });
</script>
<script type="text/javascript">
  $("#add_branch").click(function(){
     $("#add_branch_modal").modal('show');
        $("#add_branch_btn").css('display','');
   $("#edit_branch_btn").css('display','none');
   $("#branchForm")[0].reset();

  });
    $("#branchForm").on('submit', function(e){

        e.preventDefault();
      
     // if (vendor_name=='' && vendor_name==0) {
     //  global_alert_modal('warning','Enter Vendor Name...');
     //  $("#vendor_name").css("border","1px solid red");
     //                $("#vendor_name").focus();
     //                return false;
     //    }
     //   else{
     //    $("#vendor_name").css("border","1px solid lightgray");
     //   }
     //   if (vendor_company_name=='' && vendor_company_name==0) {
     //  global_alert_modal('warning','Enter Vendor Company Name...');
     //  $("#vendor_company_name").css("border","1px solid red");
     //                $("#vendor_company_name").focus();
     //                return false;
     //    }
     //   else{
     //    $("#vendor_company_name").css("border","1px solid lightgray");
     //   }
     //   if (mobile_no=='' && mobile_no==0) {
     //  global_alert_modal('warning','Enter Vendor Mobile No...');
     //  $("#mobile_no").css("border","1px solid red");
     //                $("#mobile_no").focus();
     //                return false;
     //    }
     //   else{
     //    $("#mobile_no").css("border","1px solid lightgray");
     //   }
      var formData = new FormData(this); 
            formData.append('type','BRANCH');
  $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/insert_branch.php',
data: formData,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
success: function(res){

            if(res.status=='success')
                global_alert_modal('success','Save Successfully...');
             
              $("#name").val('');
              $("#registration_no").val('');
              $("#gst_no").val('');
              $("#email").val('');
              $("#address").val('');
              $("#country").val('');
              $("#state").val('');
              $("#pincode").val('');
              $("#mobile_no").val('');
              $("#alt_mobile_no").val('');
              $("#Landline_no").val('');
              $("#username").val('');
              $("#password").val('');
              $("#add_branch_modal").modal('hide');
              $("#branchForm")[0].reset();
               get_data();

}

});

});
     $('#edit_branch_btn').on('click',function(e){
          

      var name=$("#name").val();
     
     
        var registration_no = $("#registration_no").val();
         var gst_no = $("#gst_no").val();
              var email = $("#email").val();
              var address = $("#address").val();
              var country = $("#country").val();
              var state = $("#state").val();
              var pincode = $("#pincode").val();
              var mobile_no = $("#mobile_no").val();
              var alt_mobile_no$ = $("#alt_mobile_no").val();
              var Landline_no = $("#Landline_no").val();
              var username = $("#username").val();
              var password = $("#password").val();
    
      var formData = new FormData($("#branchForm")[0]);
      formData.append('type','edit');
      formData.append('Type','BRANCH');
  $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/add_branch.php',
data: formData,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
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
    $("#name").val('');
    $("#mobile_no").val('');
    $("#email").val('');
    $("#address").val('');
    $("#state").val('');
    $("#country").val('');
    $("#pincode").val('');
    $("#add_branch_modal").modal('hide');
    $("#vendorForm")[0].reset();
    get_data();
}
}

});
});
</script>
<script type="text/javascript">
      $('#delete_branch_btn').on('click',function(e){


      var branch_id=$("#delete_branch_id").val();
    
      
  $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/add_branch.php',
data: {"branch_id": branch_id,"type":"delete"},
success: function(res){
if (res.status=='success') {
  
  global_alert_modal('success','Branch Disable SuccessFully...');
   $("#delete_branch_modal").modal('hide');
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
url: '../ajaxCalls/get_branch_data.php',
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
url: '../ajaxCalls/get_branch_data.php',
data: {'branch_id':$(e).data('id')},
success: function(res){
    $("#name").val(res.name);
    $("#registration_no").val(res.shop_registration_number);
    $("#mobile_no").val(res.mobile_no);
     $("#alt_mobile_no").val(res.alt_mobile_no);
     $("#Landline_no").val(res.landline_no);
    $("#email").val(res.email);
    $("#address").val(res.address1);
    $("#gst_no").val(res.shop_gst_no);
    $("#state").val(res.state);
    $("#country").val(res.country);
    $("#pincode").val(res.pincode);
      $("#add_branch_modal").modal('show');
   $("#edit_branch_id").val($(e).data('id'));
   $("#add_branch_btn").css('display','none');
   $("#edit_branch_btn").css('display','');
}

});


}
function delete_modal(e){
   $("#delete_branch_modal").modal('show');
   $("#delete_branch_id").val($(e).data('id'));
   
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
              if($("#add_branchr_btn").css('display')!='none'){
                $("#add_branch_btn").click();
              }
              if($("#edit_branch_btn").css('display')!='none'){
                $("#edit_branch_btn").click();
              }
              
            }
    }
});
</script>