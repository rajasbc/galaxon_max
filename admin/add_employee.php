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
          <td><a type='button' class='btn btn-primary'  href='add_employee_list.php?id=".base64_encode($value['id'])."'>Edit</a></td>
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

