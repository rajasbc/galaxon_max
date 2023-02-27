<?php 
include 'header.php';
$obj = new Employee();
$result = $obj->get_employee();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
 <!-- Content Header (Page header) -->
 <div class="content-header">
  <div class="container-fluid">
   <div class="row mb-2">
    <div class="col-sm-6">
     <h1 class="m-0">Employee List</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
     <ol class="breadcrumb float-sm-right">




      <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
      <li class="breadcrumb-item active">Employee List</li>


      <li class="breadcrumb-item"><a style="color: #007bff;text-decoration: none;background-color: transparent;cursor: pointer;" id="add_employee" href="add_employee_list.php">Add Employee</a></li>
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
          <th>Employee ID</th>
          <th>Employee Name</th>
          <th>Phone No</th>
          <th>Email</th>
          <th>Details</th>
          <th>Print</th>
         </tr>
        </thead>
        <tbody>
         <?php 
         $i = 0;
         foreach ($result as $key => $value) {
          $i++;
          echo"<tr>
          <td>".$i."</td>
          <td>".$value['first_name']."</td>
          <td>".$value['employee_id']."</td>
          <td>".$value['mobile_no']."</td>
          <td>".$value['email']."</td>
          <td><a type='button' class='btn btn-primary'  href='add_employee_list.php?id=".base64_encode($value['id'])."'>Edit</a>
          <a type='button' class='btn btn-danger' style='
    margin-left: 20px;' data-id='".$value['id']."' onclick='dele_employee(this);'>Delete</a>

          </td>
          <td><a type='button' class='btn btn-lg' onclick='month_salary(this);' data-id='".$value['id']."'><i class='fa fa-print ' aria-hidden='true'></i></a></td>


          </tr>";
         }


         ?>
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
<div class="modal fade" id="order_modal" data-backdrop='static'>
 <div class="modal-dialog modal-lg">
  <div class="modal-content">
   <div class="modal-body">

   </div>
  </div>
  <!-- /.modal-content -->
 </div>
 <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
 <div class="modal fade" id="print_slip" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        
        <div class="modal-body">
           <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div > 
          <p>Select Month</p>
          <input type="month" name="month" id="month" class="col-5  m-1" value="<?=date('Y-m')?>">
           </div>
         <div class="col-12">
          <span>Number Of Working Days &nbsp;&nbsp; </span>
          <input style="margin-top: 20px;width: 57.2px;" type='text' name='working_days' id="working_days">
         </div>
        </div>
        <div class="modal-footer" style="border-top: 0px;">

          <center><button type="button" class="btn btn-primary btn-sm" id="print_btn" data-dismiss="modal">Print</button></center>
        </div>
      </div>
    </div>
  </div>
<?php 
include 'footer.php';
?>

<script>
 $(function () {
  $("#example1").DataTable({
   "responsive": true, "lengthChange": false, "autoWidth": false,
   "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
  }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
 });
</script>
<script type="text/javascript">
  function dele_employee(e){
   var id = $(e).data('id');
 $.ajax({

     type:'post',
     dataType:'json',
     url:'../ajaxCalls/delete_employee.php',
     data:{'id':id},
   success:function(res){


   }

 });

  }
</script>
<script type="text/javascript">
  function month_salary(e){
var id = $(e).data('id');
$("#print_slip").modal('show');
$("#print_btn").val(id);

  }

$("#print_btn").on('click',function(){
  var id = $(this).val();

  var month = $("#month").val();
  var working_days = $("#working_days").val();
  if(month==''){
   global_alert_modal('success','Select Month...');
   $("#month").css('1px','solid red');
   $("#month").focus();
   return false;
  }else{
 
        $("#month").css("border","1px solid gray");
  }
  if(working_days==''){
    global_alert_modal('success','Enter Number Of Working Days..');
    $("#working_days").css('border','1px solid red');
   $("#working_days").focus();
   return false;
  }else{
        $("#working_days").css("border","1px solid gray");
  }
  window.location="salary_slip.php?id="+btoa(id)+"&month="+btoa(month)+"&working_days="+btoa(working_days);


})

</script>


