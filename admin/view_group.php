<?php 
include 'header.php';

$obj = new  GroupName();
$result = $obj->get_group_name();

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper watermark_img">

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">View Product By Group Name</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">View Group</li>
             
            </ol>
          </div>


          <div class="col-lg-3 col-md-3 col-sm-3 mx-1 m-1">
              <div class="input-group input-group-sm ">
                
                  <select class="form-control"  name='select_user' id='select_user' >
                    <option value="0">Select Group</option>
                    <?php
                    foreach ($result as $value) {
                      
                      echo "<option value='".$value['id']."' data-id='".$value['id']."'>". $value["group_name"]."</option>";
                      
                    }


                    ?>
                  </select>


              
              </div>
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
                    <th style="width: 100px">Product Name</th>
                     <th style="width: 20px">Quantity</th>
                  
                    
                  
           
                  </tr>
                  </thead>
                  <tbody>
                  
                  </tbody>
                  <tfoot>
                    
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
</div>
  




  <?php 
include 'footer.php';
?>





     
<script>
  $(document).ready(function(){
    get_group_data();
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
var group_id = $(this).val();


$.ajax({
 
  type:'post',
  url:'../ajaxCalls/view_group_product.php',
  dataType:'JSON',
  data:{'id':group_id},
    success:function(res){
    var table = $('#example1').DataTable();
    table.clear();
    table.rows.add(res).draw();
   
    }


});




 });





</script>
<script type="text/javascript">
  function view_stock_item(e){

var item_id = $(e).data('id');
var branch_id = $(e).val();


window.location='view_branch_variety.php?item_id='+btoa(item_id)+'&branch_id='+btoa(branch_id);
  }

</script>
<script type="text/javascript">
function get_group_data(){
var id = $("#select_user").val();
$.ajax({
    type:'post',
    dataType:'json',
    url:'../ajaxCalls/view_group_product.php',
    data:{'id':id},
    success:function(res){
      var table = $('#example1').DataTable();
    table.clear();
    table.rows.add(res).draw();
   
    }
})



}
</script>


