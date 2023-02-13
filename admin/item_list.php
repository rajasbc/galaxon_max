<?php 
include 'header.php';
$brand_obj = new Brand();
$brand =  $brand_obj->get_brand_data();
$category_obj = new Category();
$category =  $category_obj->get_category_data();
$description_obj = new Description();
$description =  $description_obj->get_description_data();
$group_obj = new GroupName();
$group_name = $group_obj->get_group_data();
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Products List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Products List</li>
              <li class="breadcrumb-item"><a href="add_item.php">Add Products</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>150</h3>

                <p>Total Products</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>

                <p>Most Used Products</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>44</h3>

                <p>Low Quantity</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>Out Of Stocks</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <div class="col-12">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>SalePrice/VendorPrice</th>
                    <th>Mrp</th>
                    <th>Discount</th>
                    <th>Gst</th>
                    <th>Quantity</th>
                    <th>Varieties</th>
                    <th>Action</th>
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
   <div class="modal fade" id="edit_item_modal" data-backdrop='static'>
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Product</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="edit_item_id" id="edit_item_id">
               <input type="hidden" name="edit_var_id" id="edit_var_id">
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-danger">*</span></span>
                  </div>
                  <input type="text" id='edit_item_name' class="form-control enterAsTab" placeholder="Enter Product Name">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Brand&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-danger">&nbsp;</span></span>
                  </div>
                 <select class="form-control select2 enterKeyclass" id='edit_brand'>
                    <option value="">Select Brand</option>
                    <?php foreach ($brand as $key => $value) {?>
                      <option  value="<?=$value['id']?>"><?=$value['name']?></option>
                    <?php }?>
                    
                  </select>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Category&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-danger">&nbsp;</span></span>
                  </div>
                  <select class="form-control select2 enterKeyclass" id="edit_category">
                    <option value="">Select Category</option>
                    <?php foreach ($category as $key => $value) {?>
                      <option  value="<?=$value['id']?>"><?=$value['name']?></option>
                    <?php }?>
                    
                  </select>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Group Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-danger">&nbsp;</span></span>
                  </div>
                  <select class="form-control select2 enterKeyclass" id="edit_group">
                    <option value="">Select Group</option>
                    <?php foreach ($group_name as $key => $value) {?>
                      <option  value="<?=$value['id']?>"><?=$value['group_name']?></option>
                    <?php }?>
                    
                  </select>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Description&nbsp;<span class="text-danger">&nbsp;</span></span>
                  </div>
                  <select class="form-control select2 enterKeyclass" id="edit_sub_category">
                    <option value="">Select Description</option>
                    <?php foreach ($description as $key => $value) {?>
                      <option  value="<?=$value['id']?>"><?=$value['name']?></option>
                    <?php }?>
                  </select>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Units&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-danger">&nbsp;</span></span>
                  </div>
                  <select class="form-control select2 enterKeyclass" id="edit_units">
                   <option value="">Select Units</option>
                    <option value="Kg">Kg</option>
                    <option value="Liter">Liter</option>
                    <option value="Pcs">Pcs</option>
                    <option value="Nos">Nos</option>  
                    <option value="Box">Box</option>
                  </select>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">SalePrice/VendorPrice&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-danger">&nbsp;</span></span>
                  </div>
                  <input type="text" id='edit_item_mrp' class="form-control enterAsTab" placeholder="Enter MRP">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Mrp&nbsp;&nbsp;&nbsp;<span class="text-danger">&nbsp;</span></span>
                  </div>
                  <input type="text" id='edit_item_sale_price' class="form-control enterAsTab" placeholder="Enter Sales Price">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Discount&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                  </div>
                  <input type="text" id='edit_item_discount' class="form-control enterAsTab" placeholder="Enter Discount">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">GST&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                  </div>
                  <!-- <input type="text" id='edit_item_gst' class="form-control enterAsTab" placeholder="Enter GST"> -->
                  <select class="form-control" id="edit_item_gst">
                    <option value="0">0</option>
                <option value="5">5</option>
                <option value="12">12</option>
                <option value="18">18</option>
                <option value="28">28</option>
                  </select>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Quantity&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-danger">*</span></span>
                  </div>
                  <input type="text" id='edit_item_qty' class="form-control enterAsTab" placeholder="Enter Quantity">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" id="edit_item_btn" class="btn btn-primary enterAsTab">Save</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
  <div class="modal fade" id="delete_item_modal" data-backdrop='static'>
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete Product</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="delete_item_id" id="delete_item_id">
              <h4>Are You Sure Delete This Product....</h4>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
              <button type="button" id="delete_item_btn" class="btn btn-primary">Yes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
   <div class="modal fade" id="add_varities_modal" data-backdrop='static' >
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Varieties</h4>
              <button type="button" id="var_close" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="variety_item_id" id="variety_item_id">
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="padding-right: 28px;">Name&nbsp;<span class="text-danger">*</span></span>
                  </div>
                  <input type="text" id='variety_name' class="form-control enterAsTab" placeholder="Enter Variety Name">
                </div>
                 <div class="input-group mb-3">
                  <div class="input-group-prepend">
      <span class="input-group-text" style="padding-right: 50px;">SalePrice/VendorPrice&nbsp;</span>
                  </div>
                  <input type="text" id='mrp' class="form-control enterAsTab" placeholder="Enter SalePrice/VendorPrice">
                </div>
                 <div class="input-group mb-3">
                  <div class="input-group-prepend"><span class="input-group-text" >Mrp&nbsp;</span>
                  </div>
                  <input type="text" id='sale_price' class="form-control enterAsTab" placeholder="Enter Mrp">
                </div>
                <div class="form-group mb-3 text-right" style="float: left;">
                  <button type="button" id="reset_btn" class="btn btn-warning enterAsTab" style="display: none">Reset</button>
                </div>
                <div class="form-group mb-3 text-right">
                  <button type="button" id="add_variety_btn" class="btn btn-primary enterAsTab">Save</button>
                  <button type="button" id="update_variety_btn" class="btn btn-danger enterAsTab" style="display: none">Update</button>
                </div>
                <div class="row">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>SalePrice/VendorPrice</th>
                        <th>Mrp</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="variety_table">
                      
                    </tbody>
                  </table>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" id="close_modal" class="btn btn-default" data-dismiss="modal">Close</button>
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
  $(document).ready(function(){
    get_fetch_data();
  })
</script>
<script type="text/javascript">
  function get_fetch_data(){
         $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/get_item_data.php',
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
  function add_varities(e){
   $("#add_varities_modal").modal('show');
   $("#variety_item_id").val($(e).data('id'));
   get_varieties($(e).data('id'));


}
function get_varieties(e){
   $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/get_item_variety.php',
data: {'item_id':e},
success: function(res){
$("#variety_table").html(res);
}

});
}
$("#add_variety_btn").click(function(){
  var item_id=$("#variety_item_id").val();
  var variety_name=$("#variety_name").val();
  var mrp = $("#mrp").val();
  var sale_price = $("#sale_price").val();

   if (variety_name=='' && variety_name==0) {
      global_alert_modal('warning','Enter Variety Name...');
      $("#variety_name").css("border","1px solid red");
                    $("#variety_name").focus();
                    return false;
        }
       else{
        $("#variety_name").css("border","1px solid lightgray");
       }
   $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/add_variety.php',
data: {'item_id':item_id,'variety_name':variety_name,'mrp':mrp,'sale_price':sale_price,'type':'add'},
success: function(res){
if (res.status=='failed') {
  
  global_alert_modal('fail','Variety Not Added...');
    return false;

}else if (res.status=='alert') {
  
  global_alert_modal('info','This VarietyName Already Stored...');
  $("#variety_name").focus();
  $("#variety_name").val('');
                    return false;

}
else{
   global_alert_modal('success','Variety Added SuccessFully...');
   $("#variety_name").val('');
    get_varieties(item_id);
}
}

});
})
function delete_variety(e){
    $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/add_variety.php',
data: {"id": $(e).data('id'),"type":"delete"},
success: function(res){
if (res.status=='success') {
  
  global_alert_modal('success','Variety Delete SuccessFully...');
    get_varieties($("#variety_item_id").val());

}
}

});
}
function delete_modal(e){
   $("#delete_item_modal").modal('show');
   $("#delete_item_id").val($(e).data('id'));
   
}
$('#delete_item_btn').on('click',function(e){
      var item_id=$("#delete_item_id").val();
    
      
  $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/add_items.php',
data: {"item_id": item_id,"type":"delete"},
success: function(res){
if (res.status=='success') {
  
  global_alert_modal('success','Product Delete SuccessFully...');
   $("#delete_item_modal").modal('hide');
   get_fetch_data();

}
}

});
});
function edit_modal(e){
   $("#edit_item_modal").modal('show');
   $("#edit_item_id").val($(e).data('id'));
   $("#edit_item_name").val($(e).data('form'));
   $("#edit_item_mrp").val($(e).data('form1'));
   $("#edit_item_sale_price").val($(e).data('form2'));
   $("#edit_item_discount").val($(e).data('form3'));
   $("#edit_item_gst").val($(e).data('form4'));
   $("#edit_item_qty").val($(e).data('form5'));
   $("#edit_brand").val($(e).data('form6'));
   $("#edit_category").val($(e).data('form7'));
   $("#edit_sub_category").val($(e).data('form8'));
   $("#edit_units").val($(e).data('form9'));
   $("#edit_group").val($(e).data('form10'));


}
    $('#edit_item_btn').on('click',function(e){

      var item_id=$("#edit_item_id").val();
       var edit_item_name=$("#edit_item_name").val();
        var edit_item_mrp=$("#edit_item_mrp").val();
         var edit_item_sale_price=$("#edit_item_sale_price").val();
          var edit_item_discount=$("#edit_item_discount").val();
           var edit_item_gst=$("#edit_item_gst").val();
            var edit_item_qty=$("#edit_item_qty").val();
            var edit_item_brand=$("#edit_brand").val();
            var edit_item_category=$("#edit_category").val();
             var edit_item_sub_category=$("#edit_sub_category").val();
            var edit_item_group=$("#edit_group").val();
            var edit_item_units=$("#edit_units").val();

     if (edit_item_name=='' && edit_item_name==0) {
      global_alert_modal('warning','Enter Product Name...');
      $("#edit_item_name").css("border","1px solid red");
                    $("#edit_item_name").focus();
                    return false;
        }
       else{
        $("#edit_item_name").css("border","1px solid lightgray");
       }
       if (edit_item_brand=='' && edit_item_brand==0) {
      global_alert_modal('warning','Enter Product Brand...');
      $("#edit_brand").css("border","1px solid red");
                    $("#edit_brand").focus();
                    return false;
        }
       else{
        $("#edit_brand").css("border","1px solid lightgray");
       }
       if (edit_item_category=='' && edit_item_category==0) {
      global_alert_modal('warning','Enter Product Category...');
      $("#edit_category").css("border","1px solid red");
                    $("#edit_category").focus();
                    return false;
        }
       else{
        $("#edit_category").css("border","1px solid lightgray");
       }
        if (edit_item_group=='' && edit_item_group==0) {
      global_alert_modal('warning','Enter Product Category...');
      $("#edit_group").css("border","1px solid red");
                    $("#edit_category").focus();
                    return false;
        }
       else{
        $("#edit_group").css("border","1px solid lightgray");
       }


       if (edit_item_sub_category=='' && edit_item_sub_category==0) {
      global_alert_modal('warning','Enter Product Sub Category...');
      $("#edit_sub_category").css("border","1px solid red");
                    $("#edit_sub_category").focus();
                    return false;
        }
       else{
        $("#edit_sub_category").css("border","1px solid lightgray");
       }

       if (edit_item_mrp=='' && edit_item_mrp==0) {
      global_alert_modal('warning','Enter Product Mrp...');
      $("#edit_item_mrp").css("border","1px solid red");
                    $("#edit_item_mrp").focus();
                    return false;
        }
       else{
        $("#edit_item_mrp").css("border","1px solid lightgray");
       }

       if (edit_item_sale_price=='' && edit_item_sale_price==0) {
      global_alert_modal('warning','Enter Product Sales Price...');
      $("#edit_item_sale_price").css("border","1px solid red");
                    $("#edit_item_sale_price").focus();
                    return false;
        }
       else{
        $("#edit_item_sale_price").css("border","1px solid lightgray");
       }

       if (edit_item_qty=='') {
      $("#edit_item_qty").val(0);
        }
      
  $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/add_items.php',
data: {"item_id": item_id,"edit_item_name": edit_item_name,"edit_item_mrp": edit_item_mrp,"edit_item_sale_price": edit_item_sale_price,"edit_item_discount": edit_item_discount,"edit_item_gst": edit_item_gst,"edit_item_qty": edit_item_qty,"edit_item_brand": edit_item_brand,"edit_item_category": edit_item_category,"edit_item_sub_category": edit_item_sub_category,"edit_item_units": edit_item_units,"edit_item_sub_category": edit_item_sub_category,"edit_item_group":edit_item_group,"type":"edit"},
success: function(res){
if (res.status=='failed') {
  
  global_alert_modal('fail','Product Not Edited...');
    return false;

}else if (res.status=='alert') {
  
  global_alert_modal('info','This ProductName Already Stored...');
  $("#edit_item_name").focus();
  $("#edit_item_name").val('');
  return false;

}
else{
   global_alert_modal('success','Product Edit SuccessFully...');
   $("#edit_item_name").val('');
   $("#edit_item_modal").modal('hide');
   get_fetch_data();
}
}

});
});

</script>
<script type="text/javascript">
  function edit_variety(e){
  var var_id = $(e).data('id');
  $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/update_var_dt.php',
data:{'var_id':var_id},
success:function(res){
  $("#variety_name").val(res.name);
  $("#mrp").val(res.mrp);
  $("#sale_price").val(res.sale_price);
  $("#add_variety_btn").css('display','none');
  $("#update_variety_btn").css('display','');
  $("#reset_btn").css('display','')
  $("#edit_var_id").val(var_id);
  
}

});

}
$("#reset_btn").on('click',function(){
 $("#variety_name").val('');
  $("#mrp").val('');
  $("#sale_price").val('');
 $("#update_variety_btn").css('display','none');
  $("#add_variety_btn").css('display','');
  $("#reset_btn").css('display','none');

})
$("#update_variety_btn").on('click',function(){
var id = $("#edit_var_id").val();
var item_id = $("#variety_item_id").val();
var variety_name = $("#variety_name").val();
var mrp = $("#mrp").val();
var sale_price = $("#sale_price").val();
$.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/update_varieties.php',
data:{'id':id,'variety_name':variety_name,'mrp':mrp,'sale_price':sale_price},
success:function(res){
if(res.status=='success'){
  global_alert_modal('success','Update SuccessFully...');
   get_varieties(item_id);
}
  
}

});

});

$("#var_close").on('click',function(){
location.reload();

});
$("#close_modal").on('click',function(){
location.reload();

});

</script>
