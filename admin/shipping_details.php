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
            <h1 class="m-0">Shipping List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Shipping List</li>
              <li class="breadcrumb-item" data-toggle='modal' data-target="#shipping_modal" id="shipping_modal_btn"><a style="color: #007bff;text-decoration: none;background-color: transparent;cursor: pointer;" id="add_vendor">Add Shipping</a></li>
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
                    <th>Company Name</th>
                    <th>GST NO</th>
                    <th>Mobile No</th>
                    <th>Email</th>
             
                    <th style="width: 150px;">Action</th>
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
  
      <!-- /.modal -->



       <div class="modal fade" id="shipping_modal" data-backdrop='static'>
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"></h4>
             <!--  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button> -->
            </div>
            <div class="modal-body">
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 8.3rem">Name&nbsp;<span class="text-danger">*</span></span>
                  </div>
                   <input type="hidden" name="shipping_id" id="shipping_id" value="0">
                  <input type="text" id='shipping_name' name='shipping_name' class="form-control enterKeyclass" placeholder="Enter Name">

                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Company Name&nbsp;<span class="text-danger">*</span></span>
                  </div>
                  <input type="text" id='shipping_company_name' name='shipping_company_name' class="form-control enterKeyclass" placeholder="Enter Company Name">
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
                  <input type="text" id='ship_gst' name='ship_gst' class="form-control enterKeyclass" placeholder="Enter GST No">
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
                    <span class="input-group-text" style="width: 8.3rem">Shipping Terms</span>
                  </div>
                  <input type="text" id='ship_terms' name='ship_terms' class="form-control enterKeyclass" placeholder="Enter Shipping Terms">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Shipping Medthod</span>
                  </div>
                  <select class="form-control" id="shipping_method">
                    <option value="FEDEX">FEDEX</option>
                    <option value="UPS">UPS</option>
                    <option value="USPS">USPS</option>
                  </select>
                </div>
               <!--  <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 8.3rem">Delivery Date</span>
                  </div>
                  <input type="date" id='shipping_d_date' name='shipping_d_date' class="form-control enterKeyclass" value="<?=date('Y-m-d')?>">
                </div> -->
            </div>
          <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             
            </div>
            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
       
 
  <?php 
include 'footer.php';
?>
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
  function get_data(){
      $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/get_shipping_data.php',
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
  function delete_shipping(e){
 var id = $(e).data('id');


$.ajax({
   type:'POST',
   url:'../ajaxCalls/shipping_deleted.php',
   dataType:'json',
   data:{'shipping_id':id},
success:function(res){
        if(res.status=="success"){

          global_alert_modal('success','Shipping List Deleted SuccessFully...'); 

           get_data();

        }
     


}

});

  }

</script>
<script type="text/javascript">
  function view_shipping(e){
    var id = $(e).data('id');
 
$.ajax({
type: "GET",
dataType:"html",
url: '../ajaxCalls/view_shipping_details.php',
data: {'id':id},
success: function(res){
  $("#shipping_modal .modal-body").html(res);
$("#shipping_modal").modal('show');
}

});
    
  }






</script>
<script type="text/javascript">
   $("#shipping_dt_add").click(function(){

 var shipping_name = $("#shipping_name").val();
 var shipping_company_name = $("#shipping_company_name").val();
 var mobile_no = $("#mobile_no").val();
 var email = $("#email").val();
 var ship_gst = $("#ship_gst").val();
 var address = $("#address").val();
 var city = $("#city").val();
 var state = $("#state").val();
 var country = $('#country').val();
 var pincode = $("#pincode").val();
 var ship_terms = $("#ship_terms").val();
 var shipping_method = $("#shipping_method").val();
 
   $.ajax({

  type:'post',
  dataType:'json',
  url:'../ajaxCalls/add_shipping.php',
  data:{"shipping_name":shipping_name,"shipping_company_name":shipping_company_name,"mobile_no":mobile_no,"email":email,"ship_gst":ship_gst,"address":address,"city":city,"state":state,"country":country,"pincode":pincode,"ship_terms":ship_terms,"shipping_method":shipping_method},
    success:function(res){

            if(res.status=='success'){
                global_alert_modal('success','Shipping Details Added SuccessFully...');
                 $("#shipping_modal").modal('hide');
            

            }
 
    }


});




});

</script>