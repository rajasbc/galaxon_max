<?php 
include 'header.php';
$obj = new ExpenseCategory();
$obj1 = new Shops();
$result = $obj->get_catagory_data();

$result1 = $obj1->branch_details();

$branch = $obj1->show_branch();


?>
<style type="text/css">
#ui-id-1
 { 
  z-index: 9999999!important;
 }  



</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper watermark_img">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-2">
            <h1 class="m-0">Expenses List</h1>
          </div><!-- /.col -->
          
          


          <div class="col-sm-10">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Expenses List</li>
              <li class="breadcrumb-item"><a style="color: #007bff;text-decoration: none;background-color: transparent;cursor: pointer;" id="add_expenses">Add Expenses</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
      <div class=" form-row col-lg-12 col-md-12 col-sm-12" id="sort">
            <div class="col-lg-2 col-md-2 col-sm-2 mx-1 m-1">
              <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                  <span class="input-group-text ">From</span>
                </div>
                <input type="date" class="form-control" name="date" id="fdate" value='<?=date('Y-m-d')?>'>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 mx-1 m-1">
              <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                  <span class="input-group-text ">To</span>
                </div>
                <input type="date" class="form-control" name="date" id="tdate" value='<?=date('Y-m-d')?>'>
              </div>
            </div>

             <div class="col-lg-2 col-md-2 col-sm-2 mx-1 m-1">
              <div class="input-group input-group-sm ">
                
                  <select class="form-control"  name='select_user' id='select_user' >
                    <option value="0" selected>Select Branch</option>
                    <?php
                    foreach ($branch as $value) {
                      
                      echo "<option value='".$value['branch_id']."' data-id='".$value['branch_id']."'>". $value["name"]."</option>";
                      
                    }


                    ?>
                  </select>
              </div>
            </div>

             <div class="col-lg-2 col-md-2 col-sm-2 mx-1 m-1">
              <div class="input-group input-group-sm ">
                
                  <select class="form-control"  name='category' id='category' >
                    <option value="0" selected>Select Category</option>
                    <?php
                    foreach ($result as $value) {
                      
                      echo "<option value='".$value['id']."' data-id='".$value['id']."'>". $value["name"]."</option>";
                      
                    }

                    ?>
                  </select>
              </div>
            </div>
       

            <!-- <div class="col-lg-3 col-md-3 col-sm-3 mx-1 m-1">
              <div class="input-group input-group-sm ">
                
                  <select class="form-control"  name='select_user' id='select_user' >
                    <option value="0">Select Branch</option>
                    <?php
                    foreach ($branch as $value) {
                      
                      echo "<option value='".$value['branch_id']."' data-id='".$value['branch_id']."'>". $value["name"]."</option>";
                      
                    }


                    ?>
                  </select>


              
              </div>
            </div> -->
            <div class="col-lg-1 col-md-1 col-sm-1 mx-1 m-1">
              <div class="input-group input-group-sm ">
                <button class="form-control btn btn-danger btn-sm" id="search" name="Search" type="submit">Search</button>
              </div>
            </div>
          </div>

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
                    <th style="width: 80px">Date</th>
                    <th >Branch Name</th>
                    <th style="width: 100px">Category</th>
                    <th style="width: 80px">Expenses Name</th>
                    <th style="width: 100px">Total Expenses</th>
                    <th style="width: 400px">Action</th>
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
  <div class="modal fade" id="add_expenses_modal" data-backdrop='static'>
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Expenses Details</h4>
              <button type="button" class="close btn_wrong" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" id="expenseForm" enctype="multipart/form-data" >
            <div class="modal-body">
              
              <input type="hidden" name="edit_expenses_id" id="edit_expenses_id" value="0">
              <!-- <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 12rem">Branch Name&nbsp;</span>
                  </div>
                  <input type="hidden" id='branch_id' name='branch_id'>
                  <input type="text" id='branch_name' name='branch_name' class="form-control enterKeyclass" placeholder="Enter Name">
                </div> -->
                 <div class="input-group mb-3">
                  <div class="input-group-prepend">
                     <input type="hidden" id='branch_id' name='branch_id'>
                    <span class="input-group-text" style="width: 12rem">Branch Name <!-- <span class="text-danger">*</span> --></span>
                  </div>
                  <select class="form-control enterKeyclass" id="branch_name" name="branch_name" >
                    <option value="">Select Branch Name</option>
                    <?php foreach ($result1 as $key => $value) {?>
                      <option  value="<?=$value['name']?>" data-id="<?=$value['branch_id']?>"><?=$value['name']?></option>
                    <?php }?>
                    
                  </select>
                </div>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 12rem">Category <!-- <span class="text-danger">*</span> --></span>
                  </div>
                  <select class="form-control enterKeyclass" id="category_name" name="category_name" >
                    <option value="">Select Category</option>
                    <?php foreach ($result as $key => $value) {?>
                      <option  value="<?=$value['id']?>"><?=$value['name']?></option>
                    <?php }?>
                    
                  </select>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 12rem">Expenses Name&nbsp;</span>
                  </div>
                  <input type="text" id='expenses_name' name='expenses_name' class="form-control enterKeyclass" placeholder="Enter Expenses Name">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 12rem">Reference No</span>
                  </div>
                  <input type="text" id='ref_no' name='ref_no' class="form-control enterKeyclass" placeholder="Enter Reference No">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 12rem">Vehicle NO <!-- <span class="text-danger">*</span> --></span>
                  </div>
                  <input type="text" id='v_no' name='v_no' class="form-control enterKeyclass" placeholder="Enter Vehicle NO">
                  </div>
                  <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"style="width: 12rem">Note</span>
                  </div>
                  <textarea type="text" id='note' name='note' class="form-control enterKeyclass" placeholder="Enter note"></textarea>
                </div>
                 <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"style="width: 12rem">Contact No</span>
                  </div>
                  <input type="text" id='contact' name='contact' class="form-control enterKeyclass" placeholder="Enter Contact NO">
                </div>
                 <div class="input-group mb-3" id="expenses_amount">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 12rem">Expenses Amount</span>
                  </div>
                  <input type="text" id='amount' name='amount' class="form-control enterKeyclass" placeholder="Enter Amount">
                </div>
                <div class="input-group mb-3 form-check form-check-inline">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 12rem">Tax(%)</span>
                  </div>
                  <label class="form-check-label" for="call-yes" style="margin-left: 26px;padding-top: 6px;">Yes&nbsp;</label>
                  <input class="form-check-input yes" checked= 'checked' type="radio" name='tax' id='tax-yes' value='yes'>
                  <label  class="form-check-label" for="call-no" style="margin-left: 26px;padding-top: 6px;">No&nbsp;</label>
                  <input class="form-check-input no" type="radio" name='tax' id='tax-no' value='no'>
                   <input type="text" style="width: 105px;margin-left: 10px;margin-top: 5px;"id='tax_percentage' name='tax_percentage' class="enterKeyclass" placeholder="Enter Tax in %">
                   <input type="hidden" style="width: 105px;margin-left: 10px;margin-top: 5px;"id='tax_amount' name='tax_amount' class="enterKeyclass" placeholder="Enter Tax in %">
                </div>
                 <div class="input-group mb-3" id="tot_amount_tax">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 12rem">Total Amount(incl.Tax)</span>
                  </div>
                  <input type="text" readonly="readonly" id='amount_with_tax' name='amount_with_tax' class="form-control enterKeyclass" placeholder="Enter Amount">
                  
                </div>



                 <div class="input-group mb-3" style="display: none" id="tot_amount">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 12rem">Total Amount</span>
                  </div>
                  <input type="text" readonly="readonly" id='amount_without_tax' name='amount_without_tax' class="form-control enterKeyclass" placeholder="Enter Amount">
                </div>

                 <div class="input-group mb-3 form-check form-check-inline" id="refund_grp" >
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 12rem">Refund Amount(if yes)</span>
                  </div>
                  <label class="form-check-label" for="call-yes" style="margin-left: 26px;padding-top: 6px;">Yes&nbsp;</label>
                  <input class="form-check-input ref_yes"  type="radio" name='refund' id='refund_amt_yes' value='yes'>
                  <label  class="form-check-label" for="call-no"  style="margin-left: 26px;padding-top: 6px;">No&nbsp;</label>
                  <input class="form-check-input ref_no" checked="checked" type="radio" name='refund' id='refund_amt_no' value='no'>
                   <input type="text"  style="width: 105px;margin-left: 10px;margin-top: 5px; display:none;" id='refund_value' name='refund_value' class="enterKeyclass" placeholder="Enter Amount">
                </div>

               
                 <div class="input-group mb-3" id="after_refund" style="display: none;">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 12rem">Total Amount After Refund</span>
                  </div>
                  
                   <input type="text" readonly="readonly" id='amount_after_refund' name='amount_after_refund' class="form-control enterKeyclass" placeholder="Enter Amount" >
                </div>


               
                 <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 12rem">Expenses Date</span>
                  </div>
                  <input type="date" id='exp_date' name='exp_date' class="form-control enterKeyclass" value='<?=date("Y-m-d")?>'>
                </div>




                 <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text "style="width: 12rem;height: 29.6px;">Upload File</span>
                  </div>
                  <input style="width: 14rem" multiple type="file" id='myfile[]' name='myfile[]' class="enterKeyclass" value='' placeholder="Upload File">
                  <img id="preview_img" src="" style="max-width: 201px;max-height: 175px;display: none;">
                 <span id="preview" style="display: none;"></span>
                </div>

                 <div class="row">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>File Name</th>
                        <th class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody id="file_table">
                      
                    </tbody>
                  </table>
                </div>

               
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default btn_close" data-dismiss="modal">Close</button>
              <button type="submit" id="add_expense_btn" class="btn btn-primary">Save</button>
              <button type="button" style="display: none" id="edit_expense_btn" class="btn btn-primary">Update</button>
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
<!-- reset_model -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
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
  $("#add_expenses").click(function(){

     $("#add_expenses_modal").modal('show');
        $("#add_expense_btn").css('display','');
   $("#edit_expense_btn").css('display','none');
   $("#tax_percentage").css('display','');
   // $("#refund").css('display','none');
   // $('#refund_value').val('');
   $("#expenseForm")[0].reset();

  });
    $("#expenseForm").on('submit', function(e){

        
        e.preventDefault();
        var tax_con = $("input[type='radio']:checked").val();
      

        var tax_percentage = $("#tax_percentage").val();

       if(tax_con=='yes' && tax_percentage==''){

          global_alert_modal('success','Enter Tax Percentage');
           $("#tax_percentage").css("border","1px solid red");
           $("#tax_percentage").focus();
          return false;

       }


       
      var formData = new FormData(this); 
            formData.append('type','add');
  $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/add_expenses.php',
data: formData,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
success: function(res){
               
           if(res.status=="success"){
            global_alert_modal('success','Save SuccessFully...');
             $("#branch_name").val('');
              $("#category_name").val('');
              $("#expenses_name").val('');
              $("#ref_no").val('');
              $("#v_no").val('');
              $("#note").val('');
              $("#contact").val('');
              $("#amount").val('');
              $("#add_expenses_modal").modal('hide');       
              $("#expenseForm")[0].reset();
               get_data();
               location.reload();
          
           }
       
}

});

});
     $('#edit_expense_btn').on('click',function(e){
          var tax_check = $("input[name='tax']:checked").val();

          var ref_cond = $("input[name='refund']:checked").val();

          if(tax_check=='yes'){
            if($("#tax_percentage").val()=='' || $("#tax_percentage").val()==0){
                global_alert_modal('success','Enter tax Amount');
            
           $("#tax_percentage").css("border","1px solid red");
           $("#tax_percentage").focus();
           $("#amount_without_tax").val(0);

          return false;

            }
          }else{
              if($("#amount_without_tax").val()=='' || $("#amount_without_tax").val()==0){

                global_alert_modal('success','Enter Expenses Amount');
            
           $("#amount").css("border","1px solid red");
           $("#amount").focus();
           $("#amount").val('');
           $("#amount_without_tax").val(0);
           $("#tax_percentage").val('');
           $("#tax_amount").val(0);

          return false;
        }

          }

          if(ref_cond=='yes'){
            if($("#refund_value").val()=='' || $("#refund_value").val()==0 ){
             global_alert_modal('success','Enter Refund Amount');
            
           $("#refund_value").css("border","1px solid red");
           $("#refund_value").focus();
          return false;
            }

          }
          

          // $("input[type='radio']:checked").val()=='yes'
      var formData = new FormData($("#expenseForm")[0]);
      formData.append('type','edit');
      
  $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/add_expenses.php',
data: formData,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
success: function(res){
if (res.status=='success') {
  
  
    global_alert_modal('success','Expenses Edited SuccessFully...');
    $("#branch_name").val('');
              $("#category_name").val('');
              $("#expenses_name").val('');
              $("#ref_no").val('');
              $("#v_no").val('');
              $("#note").val('');
              $("#contact").val('');
              $("#amount").val('');
              $("#amount_without_tax").val('');
              $("#tax_percentage").val('');
              $("#amount_without_tax").val('');
              $("#amount_with_tax").val('');
              $("#add_expenses_modal").modal('hide');       
              $("#expenseForm")[0].reset();
               location.reload();

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
  $('.btn-disable').css('display','none');
  global_alert_modal('success','Branch Disable SuccessFully...');
   $("#delete_branch_modal").modal('hide');
   
   $(".btn-action").attr("disabled");
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
url: '../ajaxCalls/get_expenses_data.php',
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
url: '../ajaxCalls/get_expenses_data.php',
data: {'expenses_id':$(e).data('id')},
success: function(res){


    $("#branch_name").val(res.branch_name);
    $("#branch_id").val(res.branch_id);
    $("#category_name").val(res.expenses_category);
    $("#expenses_name").val(res.expenses_name);
     $("#ref_no").val(res.ref_no);
     $("#v_no").val(res.vehicle_no);
     $("#note").val(res.note);
    $("#contact").val(res.contact_no);
    $("#amount").val(res.amount);
    $("#exp_date").val(res.exp_date);
   
    if(res.tax=="yes"){
      $("#tax-yes").prop('checked',true);
      $("#amount_with_tax").css('display','');
$("#tax_percentage").css('display','');

$("#tot_amount").css('display','none');
      $("#tax_percentage").val(res.tax_percentage);
      $("#amount_with_tax").val(res.total_amt);
      $("#amount_without_tax").val(0);
      $("#tax_amount").val(res.tax_amt);


    }else{

      $("#tax-no").prop('checked',true);
      $("#tax_percentage").val('');
       $("#tax_percentage").css('display','none');
       $("#tot_amount_tax").css('display','none');
       $("#tot_amount").css('display','');
       $("#amount_without_tax").css('display','');
       $("#amount_without_tax").val(res.total_amt);
       $("#amount_with_tax").val(0);
    }
  if(res.refund=="yes"){
      $("#refund_amt_yes").prop('checked',true);
      $("#refund_value").css('display','');
      $("#refund_value").val(res.refund_amt);
      $('#amount_after_refund').val(res.amount_after_refund);
      $('#after_refund').css('display','');
     
  }else{
      $("#refund_amt_no").prop('checked',true);
      $("#refund_value").css('display','none');
      

  }  
 
        get_file(res.id);     


    // $("#preview").html('../uploads/files/'+res.file);
    // var filename = res.file;
    //  var fileExtension = filename.replace(/^.*\./, '');
    //  if(fileExtension=='png' || fileExtension=='jpg' || fileExtension=='jpeg' ){
    //     $("#preview_img").css('display','');
    //     $("#preview_img").attr('src','../uploads/files/'+res.file);

    //  }
    //  if(res.file!='' && fileExtension!='png'){
    //   $("#preview").css('display','');
    //     $("#preview").html('../uploads/files/'+res.file);

    //  }
  
    
    $("#add_expenses_modal").modal('show');
   $("#edit_expenses_id").val($(e).data('id'));
   $("#add_expense_btn").css('display','none');
   $("#edit_expense_btn").css('display','');
    $("#refund").css('display','');

   

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
                $("#add_expense_btn").click();
              }
              if($("#edit_expense_btn").css('display')!='none'){
                $("#edit_expense_btn").click();
              }
              
            }
    }
});
</script>

<script>
  function view_btn(e){

  $('#enable_branch_modal').modal('show');

   var id=$(e).data('id');
    var value = $('#enable_branch_btn').val(id);

  }

  $('#enable_branch_btn').on('click',function(){

     var id = $(this).val();

    $.ajax({
     type:'post',
     url: '../ajaxCalls/update_enable.php ',
     dataType:'json',
     data:{'id':id},
     success:function(res){
        if(res.status=='success'){
              global_alert_modal('success','Enabled SuccessFully...');
               $('#enable_branch_modal').modal('hide');


        }
      

get_data();

     }


  });

   });

  function del_btn(e){
   var id = $(e).data('id');
 $.ajax({
    type:'post',
    dataType:'json',
    url:'../ajaxCalls/add_expenses.php',
    data:{'id':id,'type':'delete'},
    success:function(res){

     get_data();

    }

 })

  }
  
</script>

<script type="text/javascript">

  $(function () {
     //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

  });
</script>

<!-- <script type="text/javascript">

         $(document).ready(function(){
        
          $('#branch_name').autocomplete({
           source: "../ajaxCalls/autocomplete_expenses_branch.php",
           minLength: 1,
           select: function(event, ui)
           {
            if(ui.item.value == 'Branch Not FOUND'){
             $.growl.warning({title:"Item Not Available",message:"Kindly Add Item From VendorProduct"});
             $("#add_expense_btn").attr('disabled','disabled');

            }
            else
            {
             $("#add_expense_btn").attr('disabled',false);
             $("#branch_id").val(ui.item.id)
            }

       
       }

      }).data('ui-autocomplete')._renderItem = function(ul, item){
           return $("<li class='ui-autocomplete-row'></li>")
           .data("item.autocomplete", item)
           .append(item.value)
           .appendTo(ul);
          };


         })
</script> -->
<script type="text/javascript">
  $(".no").on('click',function(){
 
var amount = $("#amount").val();

 $("#amount_with_tax").val(0);
$("#tot_amount").val($("#amount").val()*1);
$("#tot_amount").css('display','');
 $("#tot_amount_tax").css('display','none');
 
 $("#tax_percentage").css('display','none');
 $("#tax_percentage").val(0);
  $("#tax_amount").val(0);
  $("#amount_without_tax").val(amount);
  $("#amount_after_refund").val('');
  $("#refund_value").val('');
 

  });

  $(".yes").on('click',function(){
$("#tot_amount_tax").css('display','');
 $("#tot_amount").css('display','none');
 $("#tax_percentage").css('display','');
 $("#amount_without_tax").val(0);

  });

$("#tax_percentage").on('keyup',function(){
  var tax_val =($(this).val()/100)*1;

var amount = $("#amount").val()*1;


  if(amount=='' &&  amount==0){

   global_alert_modal('success','Enter Expenses Amount');
           $("#tax_percentage").val('');
           $("#amount").css("border","1px solid red");
           $("#amount").focus();
          return false;
  }

var tax_val_amount = (tax_val)*(amount);

var tot_amount = (amount)+(tax_val_amount);

 $("#amount_with_tax").val(tot_amount);
 $("#tax_amount").val(tax_val_amount);
 $("#amount_after_refund").val('');
 $("#refund_value").val('');



});

$("#amount").on('keyup',function(){

  var amount = $(this).val()*1;

  if($("input[type='radio']:checked").val()=="yes"){
      
var tax_perc_val = ($("#tax_percentage").val()/100);
var tax_value = (amount)*(tax_perc_val);
var total_amount = (amount*1)+(tax_value*1);
$("#amount_with_tax").val(total_amount);
$("#amount_without_tax").val(0);
$("#refund_value").val('');
}else{
   $("#amount_without_tax").val(amount);


}

})

</script>
<script type="text/javascript">
  $(".ref_yes").on('click',function(){

    var expenses_id = $("#edit_expenses_id").val();
  if(expenses_id!=0){
     $("#refund_value").css('display','');
 $("#after_refund").css('display','');

  }

  });


  $(".ref_no").on('click',function(){

$("#refund_value").css('display','none');
$("#refund_value").val(0);
$("#after_refund").css('display','none');
$("#amount_after_refund").val(0);

  })

$(".btn_wrong").on('click',function(){

location.reload();

});  
$(".btn_close").on('click',function(){

location.reload();

});
$("#branch_name").on('change',function(){

var branch_id = $('#branch_name option:selected').data('id');

$("#branch_id").val(branch_id);

})

$("#refund_value").keyup(function(){
  

  var refund_amount = $(this).val();


  if($("input[type='radio']:checked").val()=='yes'){
    
     expenses_amount = $('#amount_with_tax').val()-(refund_amount);
   
     $("#amount_after_refund").val(expenses_amount);
     
  }else{

     expenses_amount = $('#amount_without_tax').val()-(refund_amount);
       $("#amount_after_refund").val(expenses_amount);

  }

})
 
</script>
<script type="text/javascript">
  $("#search").on('click',function(){
  var fdate = $("#fdate").val();
  var tdate = $("#tdate").val();
  var branch_id = $("#select_user").val();

  var category_id = $("#category").val();
 
  $.ajax({

     type:"POST",
     dataType:"json",
     url:'../ajaxCalls/get_expenses_dt.php',
     data:{"fdate":fdate,"tdate":tdate,"branch_id":branch_id,"category_id":category_id},
     success:function(res){
       
      var table = $("#example1").DataTable();
    table.clear();
    table.rows.add(res).draw();
         
     }

  });

  });
</script>
<script type="text/javascript">
  function get_file(e){
   

 $.ajax({
      type:'post',
      dataType:'json',
      url:'../ajaxCalls/get_expenses_file.php',
      data:{'expenses_id':e},
      success:function(res){
      $("#file_table").html(res);
       


      }
 })

  }

  function delete_file(e){
  var id = $(e).data('id');
 
  $.ajax({
      type:'post',
      dataType:'json',
      url:'../ajaxCalls/dele_expenses_file.php',
      data:{'file_id':id},
      success:function(res){

            global_alert_modal('success','Deleted SuccessFully...');

          var expenses_id = $("#edit_expenses_id").val();
            get_file(expenses_id);
      
      }
       
  })
  }
  

</script>
