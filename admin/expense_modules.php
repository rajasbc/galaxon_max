<?php 
include 'header.php';
$obj = new ExpenseCategory();
$result = $obj->get_catagory_data();
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
                    <th >Branch Name</th>
                     <th style="width: 100px">Category</th>
                    <th style="width: 80px">Expenses Name</th>
                    <th style="width: 100px">Total Amount</th>
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
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" id="expenseForm" enctype="multipart/form-data" >
            <div class="modal-body">
              
              <input type="hidden" name="edit_expenses_id" id="edit_expenses_id" value="0">
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 12rem">Branch Name&nbsp;<!-- <span class="text-danger">*</span> --></span>
                  </div>
                  <input type="hidden" id='branch_id' name='branch_id'>
                  <input type="text" id='branch_name' name='branch_name' class="form-control enterKeyclass" placeholder="Enter Name">
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
                 <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 12rem">Total Amount</span>
                  </div>
                  <input type="text" id='amount' name='amount' class="form-control enterKeyclass" placeholder="Enter Amount">
                </div>
                 <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text "style="width: 12rem">Upload File</span>
                  </div>
                  <input type="file" id='myfile' name='myfile' class="form-control enterKeyclass file_upload" value='' accept="image/*" onchange="readURL(this);" placeholder="Upload File">
                  
                </div>

               
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
   $("#expenseForm")[0].reset();

  });
    $("#expenseForm").on('submit', function(e){

        
        e.preventDefault();

       
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
          
           }
       
}

});

});
     $('#edit_expense_btn').on('click',function(e){
          
          
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
              $("#add_expenses_modal").modal('hide');       
              $("#expenseForm")[0].reset();
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
    $("#category_name").val(res.expenses_category);
    $("#expenses_name").val(res.expenses_name);
     $("#ref_no").val(res.ref_no);
     $("#v_no").val(res.vehicle_no);
     $("#note").val(res.note);
    $("#contact").val(res.contact_no);
    $("#amount").val(res.amount);
    
    
    $("#add_expenses_modal").modal('show');
   $("#edit_expenses_id").val($(e).data('id'));
   $("#add_expense_btn").css('display','none');
   $("#edit_expense_btn").css('display','');
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

<script type="text/javascript">

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

        </script>





