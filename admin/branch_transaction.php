<?php 
include 'header.php';

$obj = new Shops();
$branch = $obj->show_branch();

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper watermark_img">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Branch Transaction List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Branch Transaction</li>
             
            </ol>
          </div>
       
		
					<div class=" form-row col-lg-12 col-md-12 col-sm-12" id="sort">
						<div class="col-lg-3 col-md-3 col-sm-3 mx-1 m-1">
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
								<input type="date" class="form-control" name="date" id="tdate" value='<?=date('Y-m-d')?>' >
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3 mx-1 m-1">
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
						</div>
						<!-- <div class="col-lg-1 col-md-1 col-sm-1 mx-1 m-1">
							<div class="input-group input-group-sm ">
								<button class="form-control btn btn-danger btn-sm" id="search" name="Search" type="submit">Search</button>
							</div>
						</div> -->
					</div>


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
                    <th style="width: 100px">Name</th>
                    <th style="width: 100px">Branch Code</th>
                    <th style="width: 80px">Bill No</th>
                    <th style="width: 100px">Total Amount</th>
                    <th style="width: 100px">Paid Amount</th>
                    <th style="width: 100px">Balance Amount</th>
           
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
   
  </div>
  




  <?php 
include 'footer.php';
?>





     
<script>
  $(document).ready(function(){
    get_data();
  })
 
</script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
<script type="text/javascript">
$("#select_user").change(function(){

var fdate = $("#fdate").val();
var tdate = $("#tdate").val();
var branch_id = $(this).val();

$.ajax({
 
	type:'post',
	url:'../ajaxCalls/get_branch_transaction.php',
	dataType:'JSON',
	data:{'fdate':fdate,'tdate':tdate,'branch_id':branch_id},
    success:function(res){
    var table = $('#example1').DataTable();
    table.clear();
    table.rows.add(res).draw();
          
    }


});

});






</script>



