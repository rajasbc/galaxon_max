<?php 
include 'header.php';
$curPageName =  $_SERVER['HTTP_HOST']; 

$obj=new StaffAttendance();
$result=$obj->month_wise_report1($curPageName);


?>
<style type="text/css">
 .check
{
 
  padding-right:0px !important;
  padding-left:0px !important;
  padding-bottom: 30px!important;
} 
body{
  overflow:auto ;
}
 
 }

</style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Staff Attendance</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
   
              
              
          
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Attendance</li>
             
          
             <!--  <li class="breadcrumb-item"><a style="color: #007bff;text-decoration: none;background-color: transparent;cursor: pointer;" href="salary_slip.php">Salary Slip</a></li> -->
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid"> 
  <div class="row">      
      <div class="col-3">
<select class="form-control m-1" id="selector">
          <!-- <option value=""selected disabled hidden>Select Here</option> -->
          <option value="">Select Here</option>
          <option value="1" data-from='<?=date('Y-01-d',strtotime('first day of this month', time()))?>' data-to='<?=date('Y-01-d',strtotime('last day of this month', time()))?>'>January</option>
          <option value="2" data-from='<?=date('Y-02-d',strtotime('first day of this month', time()))?>' data-to='<?=date('Y-02-d',strtotime('last day of this month', time()))?>'>February</option>
          <option value="3" data-from='<?=date('Y-03-d',strtotime('first day of this month', time()))?>' data-to='<?=date('Y-03-d',strtotime('last day of this month', time()))?>'>March</option>
          <option value="4" data-from='<?=date('Y-04-d',strtotime('first day of this month', time()))?>' data-to='<?=date('Y-04-d',strtotime('last day of this month', time()))?>'>April</option>
          <option value="5" data-from='<?=date('Y-05-d',strtotime('first day of this month', time()))?>' data-to='<?=date('Y-05-d',strtotime('last day of this month', time()))?>'>May</option>
          <option value="6" data-from='<?=date('Y-06-d',strtotime('first day of this month', time()))?>' data-to='<?=date('Y-06-d',strtotime('last day of this month', time()))?>'>June</option>
          <option value="7" data-from='<?=date('Y-07-d',strtotime('first day of this month', time()))?>' data-to='<?=date('Y-07-d',strtotime('last day of this month', time()))?>'>July</option>
          <option value="8" data-from='<?=date('Y-08-d',strtotime('first day of this month', time()))?>' data-to='<?=date('Y-08-d',strtotime('last day of this month', time()))?>'>August</option>
          <option value="9" data-from='<?=date('Y-09-d',strtotime('first day of this month', time()))?>' data-to='<?=date('Y-09-d',strtotime('last day of this month', time()))?>'>September</option>
          <option value="10" data-from='<?=date('Y-10-d',strtotime('first day of this month', time()))?>' data-to='<?=date('Y-10-d',strtotime('last day of this month', time()))?>'>October</option>
          <option value="11" data-from='<?=date('Y-11-d',strtotime('first day of this month', time()))?>' data-to='<?=date('Y-11-d',strtotime('last day of this month', time()))?>'>November</option>
          <option value="12" data-from='<?=date('Y-12-d',strtotime('first day of this month', time()))?>' data-to='<?=date('Y-12-d',strtotime('last day of this month', time()))?>'>December</option>
         </select>

      </div>

        <div class="col-8 m-1">
 <button type="button" class="float-right btn btn-primary  btnupdate" id='addNew'>Take Attendance</button>

      </div>





       </div>  
        <!-- Main row -->
        <div class="row">
          <div class="col-12">
          <div class="card">
            
              <div class="card-body">
                <table  id="example1" style="overflow: scroll;" class="table  table-bordered table-striped">
                   <thead class="text-center ">
        <tr><th class="check">S.No</th><th class="check">Staff Name</th>
          <?php
          if (date('m')=='01') {
            $c=31;
            $month='Jan';
          }
          if (date('m')=='02') {
            $c=28;
            $month='Feb';
          }
          if (date('m')=='03') {
            $c=31;
            $month='Mar';
          }
          if (date('m')=='04') {
            $c=30;
            $month='Apr';
          }
          if (date('m')=='05') {
            $c=31;
            $month='May';
          }
          if (date('m')=='06') {
            $c=30;
            $month='Jun';
          }
          if (date('m')=='07') {
            $c=31;
            $month='Jul';
          }
          if (date('m')=='08') {
            $c=31;
            $month='Aug';
          }
          if (date('m')=='09') {
            $c=30;
            $month='Sep';
          }
          if (date('m')=='10') {
            $c=31;
            $month='Oct';
          }
          if (date('m')=='11') {
            $c=30;
            $month='Nov';
          }
          if (date('m')=='12') {
            $c=31;
            $month='Dec';
          }
         for ($x = 1; $x<=$c; $x++) {
          echo "<th class='check'>".$month." ".$x."</th>";
         }
         ?>   
         <th class='check'>Pre</th>
         <th class='check'>Abs</th>
         <th class='check'>Late</th>
         <th class='check'>Leave</th>
        </tr></thead>
                   <tbody id='myTable'>
         <?php
         $i=0;
         foreach ($result as $row) {
          $i=$i+1;
          echo"<tr height='50px'><td id='row".$row['id']."'>$i</td>
          <td>".$row['staff_name']."</td>";
          $att_details=$obj->getattdetails_id($row['staff_id']);
          $count=$obj->count_attendance($row['staff_id']);
          $html='';

          for ($x = 1; $x <= $c; $x++) {
           $flagCame = 1;
           $present=1;
           foreach ($att_details as $key => $val) {

            $date=strtotime($val['attendance_date']);

            if((int)date('d',$date)==(int)$x){

             if($val['attendance']=='Present'){
              $present = "P";
             }
             if($val['attendance']=='Absent'){
              $present = "A";
             }
             if($val['attendance']=='Leave'){
              $present = "Leave";
             }
             if($val['attendance']=='Late'){
              $present = "Late";
             }

             $flagCame = 2;
            }
           }
           if ($flagCame==2) {
            $html .= "<td>".$present."</td>";
           }else{
            $html .= "<td></td>";
           }

          }
          echo $html;
          echo'<td>'.$count['Present'].'</td>
          <td>'.$count['Absent'].'</td>
          <td>'.$count['Late'].'</td>
          <td>'.$count['Leave'].'</td>';
          echo "</tr>";
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
<script type="text/javascript">
  $("#addNew").click(function(){
  window.location='staff_attendance1.php';
 })
 //  $("#yearwise_report").click(function(){
 //  window.location='staff_attendance_month_yearwise_details.php';
 // })
</script>
<script>
 $("#selector").on('change', function(){

  var select=$("#selector").val();
  if(select=="1"){
   var fdate=$('#selector option:selected').data('from');
   var tdate=$('#selector option:selected').data('to');
   datefunction(fdate,tdate);
  }
  else if(select=="2"){
  var fdate=$('#selector option:selected').data('from');
   var tdate=$('#selector option:selected').data('to');
   datefunction(fdate,tdate);
  } 
  else if(select=="3"){
  var fdate=$('#selector option:selected').data('from');
   var tdate=$('#selector option:selected').data('to');
   datefunction(fdate,tdate);
  }
  else if(select=="4"){
   var fdate=$('#selector option:selected').data('from');
   var tdate=$('#selector option:selected').data('to');
   datefunction(fdate,tdate);
  }
  else if(select=="5"){
   var fdate=$('#selector option:selected').data('from');
   var tdate=$('#selector option:selected').data('to');
   datefunction(fdate,tdate);
  }
  else if(select=="6"){
  var fdate=$('#selector option:selected').data('from');
   var tdate=$('#selector option:selected').data('to');
   datefunction(fdate,tdate);
  }    
  else if(select=="7"){
   var fdate=$('#selector option:selected').data('from');
   var tdate=$('#selector option:selected').data('to');
   datefunction(fdate,tdate);
  }
  else if(select=="8"){
   var fdate=$('#selector option:selected').data('from');
   var tdate=$('#selector option:selected').data('to');
   datefunction(fdate,tdate);
  }       
  else if(select=="9"){
   var fdate=$('#selector option:selected').data('from');
   var tdate=$('#selector option:selected').data('to');
   datefunction(fdate,tdate);
  }
  else if(select=="10"){
   var fdate=$('#selector option:selected').data('from');
   var tdate=$('#selector option:selected').data('to');
   datefunction(fdate,tdate);
  }
  else if(select=="11"){
   var fdate=$('#selector option:selected').data('from');
   var tdate=$('#selector option:selected').data('to');
   datefunction(fdate,tdate);
  }
  else if(select=="12"){
   var fdate=$('#selector option:selected').data('from');
   var tdate=$('#selector option:selected').data('to');
   datefunction(fdate,tdate);
  }
  function datefunction(a,b){
            // console.log($("#fdate").val());
            var from= a;
            var todate= b;
            var type=$("#select_type option:selected").val();
            $.ajax({
             type:'POST',
             url:'../ajaxCalls/staff_attendance_monthwise_filter.php',
             dataType:'JSON',
             data:{'from':from,'todate':todate,'type':type},
             success:function(res)
             {           
              $("#example1").html(res.value);
              $('table').trigger("update");
             }
            });
           }
          });
         </script>





