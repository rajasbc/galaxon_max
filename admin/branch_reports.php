<?php 
include 'header.php';

$obj = new Shops();
$branch = $obj->show_branch();
$obj1 = new Items();
$item_name = $obj1->get_collection_items();

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper watermark_img">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Branch Collection Reports</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Branch Collection</li>
             
            </ol>
          </div>
       
		
					<div class=" form-row col-lg-12 col-md-12 col-sm-12" id="sort">
						<div class="col-lg-2 col-md-2 col-sm-2 mx-1 m-1">
							<div class="input-group input-group-sm">
								<div class="input-group-prepend">
									<span class="input-group-text ">From</span>
								</div>
								<input type="date" class="form-control" name="date" id="fdate" value='<?=date('Y-m-d')?>'>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 mx-1 m-1">
							<div class="input-group input-group-sm"> 
								<div class="input-group-prepend">
									<span class="input-group-text ">To</span>
								</div>
								<input type="date" class="form-control" name="date" id="tdate" value='<?=date('Y-m-d')?>' >
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 mx-1 m-1">
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
              <div class="col-lg-2 col-md-2 col-sm-2 mx-1 m-1">
              <div class="input-group input-group-sm ">
                
                  <select class="form-control"  name='item' id='item' >
                    <option value="0">Select Items</option>
                    <?php
                    foreach ($item_name as $value) {
                      
                      echo "<option value='".$value['id']."' data-id='".$value['id']."'>". $value["item_name"]."</option>";
                      
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
                    <th style="width: 20px">Date</th>
                    <th style="width: 100px">Branch Name</th>
                    <th style="width: 100px">Branch Code</th>
                   <!--  <th style="width: 80px">Customer Name</th>
                    <th style="width: 80px">Product Name</th> -->
                    <th style="width: 80px">Total Collection</th>
                    <th style="width: 80px">Details</th>
                    <!-- <th style="width: 100px">Total Amount</th>
                    <th style="width: 100px">Paid Amount</th>
                    <th style="width: 100px">Balance Amount</th> -->
           
                  </tr>
                  </thead>
                  <tbody>
                  
                  </tbody>
                  <tfoot>
                    
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Total</td>
                    <td id="html_total"></td>
                    <td></td>
                  </tfoot>
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





     
<!-- <script>
  $(document).ready(function(){
    get_data();
  })
 
</script> -->
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
var item = $("#item").val(0);

$.ajax({
 
	type:'post',
	url:'../ajaxCalls/get_branch_customer_sale.php',
	dataType:'JSON',
	data:{'fdate':fdate,'tdate':tdate,'branch_id':branch_id},
    success:function(res){
    var table = $('#example1').DataTable();
    table.clear();
    table.rows.add(res.out).draw();
    $("#html_total").html(res.out1);
          
    }


});

});
function view_details(e){
 var branch_id = $(e).data('branch');
 var sale_id = $(e).data('id');
 var date = $(e).data('date');

$.ajax({
type: "GET",
dataType:"html",
url: '../ajaxCalls/branch_sale_detail.php',
data: {'branch_id':branch_id,'sale_id':sale_id,'date':date},
success: function(res){
  $("#order_modal .modal-body").html(res);
$("#order_modal").modal('show');
}

});

}

</script>
<script type="text/javascript">
$("#item").on('change',function(){
var item_id = $(this).val();
var fdate = $("#fdate").val();
var tdate = $("#tdate").val();
var branch_id = $("#select_user").val();

$.ajax({
     type:'post',
     url:'../ajaxCalls/item_based_collection.php',
     dataType:'JSON',
     data:{'item_id':item_id,'fdate':fdate,'tdate':tdate,'branch_id':branch_id},
     success:function(res){
            var table = $('#example1').DataTable();
    table.clear();
    table.rows.add(res.out).draw();
    $("#html_total").html(res.out1);
     }


});

});

</script>
<script type="text/javascript">
  function view_item_details(e){
var date = $(e).data('date');
var sale_id = $(e).data('id');
var branch_id = $(e).data('branch');
var item_id = $(e).data('item');

$.ajax({
   type:'GET',
   dataType:'html',
   url:'../ajaxCalls/view_item_collection.php',
   data:{'date':date,'sale_id':sale_id,'branch_id':branch_id,'item_id':item_id},
   success:function(res){
       $("#order_modal .modal-body").html(res);
       $("#order_modal").modal('show'); 
   }

});


}
</script>



