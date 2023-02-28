<?php 
include 'header.php';
$obj=new  Employee();
$result=$obj->get_customerdata();
// print_r($result);die();

?>
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
 <div class="input-group input-group-md m-1">
                   
                      <span class="input-group-text ">Attendance Date</span>
                  
                    <input type="date" class="form-control" name="date" id="fdate" value="<?=date('Y-m-d')?>" max='<?=date('Y-m-d')?>'>
  </div>

      </div>

        <div class="col-3 m-1" >
                    <input class=" btn-sm  btn-primary m-1" id="search" name="Search" type="submit" value="Search">                          
      </div>





       </div>  
        <!-- Main row -->
       <form id="staff_attendance" enctype="multipart/form-data">
            <div id="StaffTable">
              <table id="example1" class="table table-bordered table-striped table-responsive-sm" id="staff_table">

                <thead class="text-center">

                  <tr><th>S.No</th><th>Staff Name</th><th>Present</th><th>Absent</th><th>Late</th><th>Leave</th><th>Time In</th><th>Remarks</th></tr></thead>
                  <tbody id="mytable">
                    <?php
                    $i = 0;
                    foreach ($result as $row) {
                      // if ($row['name'] == '') {
                      //   $staffname = 'No Name';
                      // } else {
                      //   $staffname = $row['name'];
                      // }

                      $i++;
              // $result=$obj->getUserData();
                      echo "<tr height='50px' id='row".$row['id']."'>
                      <td class='text-center' width='100px'>" . $i . "</td>
                      <td width='250px'>" . $row['first_name']." <input type='hidden' name='staffname[]' value='". $row['first_name']."'><input type='hidden' name='attendance[]' id='att".$row['id']."'><input type='hidden' name='staffid[]' value='".$row['id']."'></td>
                      <td class='text-center' width='100px' id='present1".$row['id']."'><div class='form-check'><input class='form-check-input' type='radio' name='present".$i."' id='".$row['id']."' onclick='insertdata(1,".$row['id'].");' ></div>
                      </td>
                      <td class='text-center' width='100px' id='absent1".$row['id']."'><div class='form-check'><input class='form-check-input' type='radio' name='present".$i."' id='".$row['id']."' onclick='insertdata(2,".$row['id'].");' ></div>
                      </td>
                      <td class='text-center' width='100px' id='late1".$row['id']."'><div class='form-check'><input class='form-check-input' type='radio' name='present".$i."' id='".$row['id']."' onclick='insertdata(3,".$row['id'].");' ></div>
                      </td>
                      <td class='text-center' width='100px' id='leave1".$row['id']."'><div class='form-check'><input class='form-check-input' type='radio' name='present".$i."' id='".$row['id']."' onclick='insertdata(4,".$row['id'].");'></div>
                      </td>
                      <td><input type='time' width='50px' class='form-control' name='time_in[]' id='time".$row['id']."'></td>
                      <td><input type='text' class='form-control' name='remarks[]' id='".$row['id']."'></td>
                      </tr>";
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </form>
            <div class="form-row">
          <div class="form-group col-lg-12 text-center">
            <input type="button" id='staff_save' style="display:none"  class="btn btn-sm btn-success" value="Save">
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
<script type="text/javascript">
    function insertdata(name,id){
      if (name==1) {
        $("#att"+id).val('Present');
        $("#staff_save").css('display','');
      }if (name==2) {
        $("#att"+id).val('Absent');
        $("#staff_save").css('display','');
      }
      if (name==3) {
        $("#att"+id).val('Late');
        $("#staff_save").css('display','');
      }
      if (name==4) {
        $("#att"+id).val('Leave');
        $("#staff_save").css('display','');
      }
    }
</script>

 <script type="text/javascript">
   var array_index=[];
   var checked=0;
   var i=0;
   $("table tr input:radio").on('click', function(e){
     var tab_index=$(this).closest('td').parent()[0].sectionRowIndex;
     array_index.push(tab_index);
     var $box = $(this);
     if ($box.is(":checked")) {
      checked=1;
      var id=$box.attr('id');
      array_index[i]=$box.attr('id');
      i++;
    }
  });
</script>




<script>
  $('#staff_save').on('click', function(){
      // $("#attendace_date").val();
      $.ajax({
        url:"../ajaxCalls/staff_attendance_ajax.php",
        type: "POST",
        dataType: "json",
        data: $('#staff_attendance').serialize()+"&date="+$('#fdate').val(),
        success: function(res) {
          if(res.status=='success')
          {
            global_alert_modal('success','Attendance Taken SuccessFully...');
          }
        }
      });
    });
  </script>


<script>
  $(document).ready(function(){
    var from= $("#fdate").val();
    if( from ==''){
      global_alert_modal('warning','Enter Value To Search');

    }
    else{
      $.ajax({
        type:'POST',
        url:'../ajaxCalls/staff_attendance_report.php',
        dataType:'JSON',
        data:{'from':from},
        success:function(res)
        {
    // console.log(res.value);
    $("#mytable").html(res.value);
    $('table').trigger("update");
  }
});
    }
  });
  $("#search").on('click', function(){
    get_data_report();
  });
   function get_data_report()
   {
    var from= $("#fdate").val();
   
    if( from ==''){
      global_alert_modal('warning','Enter Value To Search');

    }
    else{
      $.ajax({
        type:'POST',
        url:'../ajaxCalls/staff_attendance_report.php',
        dataType:'JSON',
        data:{'from':from},
        success:function(res)
        {
    // console.log(res.value);
    $("#mytable").html(res.value);
    $('table').trigger("update");
  }
});
    }

  }
</script>




