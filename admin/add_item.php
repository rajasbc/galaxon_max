<?php 
include 'header.php';
$brand_obj = new Brand();
$brand =  $brand_obj->get_brand_data();
$category_obj = new Category();
$category =  $category_obj->get_category_data();
$description_obj = new Description();
$description =  $description_obj->get_description_data();
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add Products</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item "><a href="item_list.php">Products List</a></li>
              <li class="breadcrumb-item active" >Add Products</li>
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
                      <!-- Input addon -->
            <div class="card">
              <div class="card-body row col-12">
                <div class="col-6 form-group mb-3">
                   <label>Product Name&nbsp;<label class="text-danger enterAsTab">*</label></label>
              <input type="text" id='item_name' class="form-control enterKeyclass" placeholder="Product Name" autofocus>
                </div>
                 <div class="col-6 form-group mb-3">
                   <label>Product Code&nbsp;<label class="text-danger enterAsTab">*</label></label>
              <input type="text" id='item_code' class="form-control enterKeyclass" placeholder="Product Code" autofocus>
                </div>
                 <div class="col-6 form-group mb-3">
                  <label>Brand&nbsp;<label class="text-danger">*</label></label>
                  <select class="form-control select2 enterKeyclass" id='brand' style="width: 100%;">
                    <option value="">Select Brand</option>
                    <?php foreach ($brand as $key => $value) {?>
                      <option  value="<?=$value['id']?>"><?=$value['name']?></option>
                    <?php }?>
                    
                  </select>
                </div>
                 <div class="col-6 form-group mb-3">
                   <label>Mrp&nbsp;<label class="text-danger">*</label></label>
              <input type="text" class="form-control enterKeyclass" id="mrp" placeholder="Mrp">
                </div>
                <div class="col-6 form-group mb-3">
                  <label>Category&nbsp;<label class="text-danger">*</label></label>
                  <select class="form-control select2 enterKeyclass" id="category" style="width: 100%;">
                    <option value="">Select Category</option>
                    <?php foreach ($category as $key => $value) {?>
                      <option  value="<?=$value['id']?>"><?=$value['name']?></option>
                    <?php }?>
                    
                  </select>
                </div>
                
                <div class="col-6 form-group mb-3">
                   <label>Sale Price&nbsp;<label class="text-danger">*</label></label>
              <input type="text" class="form-control enterKeyclass" id="sale_price" placeholder="Sale Price">
                </div>
                <div class="col-6 form-group mb-3">
                  <label>Description</label>
                  <select class="form-control select2 enterKeyclass" id="sub_category" style="width: 100%;">
                    <option value="">Select Description</option>
                    <?php foreach ($description as $key => $value) {?>
                      <option  value="<?=$value['id']?>"><?=$value['name']?></option>
                    <?php }?>
                  </select>
                </div>
                <div class="col-6 form-group mb-3">
                   <label>Discount</label>
              <input type="text" class="form-control enterKeyclass" id="discount" placeholder="Discount">
                </div>
               
               
                <div class="col-6 form-group mb-3">
                   <label>Units&nbsp;<label class="text-danger">*</label></label>
                  <select class="form-control enterKeyclass" id="units" style="width: 100%;">
                    <option value="">Select Units</option>
                    <option value="Kg">Kg</option>
                    <option value="Liter">Liter</option>                  
                  </select>
                </div>
                <div class="col-6 form-group mb-3">
                   <label>GST</label>
              <input type="text" class="form-control enterKeyclass" id="gst" placeholder="Gst">
                </div>
                <div class="col-6 form-group mb-3"></div>
                <div class="col-6 form-group mb-3">
                   <label>Quantity&nbsp;<label class="text-danger">*</label></label>
              <input type="text" class="form-control enterKeyclass" id="quantity" placeholder="Quantity">
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="button" id="item_add_btn" class="btn btn-primary float-right enterAsTab">Save</button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php 
include 'footer.php';
?>
<script>
<script type="text/javascript">
       
       $('.enterAsTab').keydown(function (e) {

     if (e.which === 13) {
         var index = $('.enterAsTab').index(this)+1;
         // $('.enterAsTab').eq(index).focus();
         if ($(this).attr('id')=='password') {
          $("#item_add_btn").click();
         }
     }
 });

    </script>






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
  $("#item_add_btn").click(function(){
     var item_name=$("#item_name").val();
     var item_code=$("#item_code").val();
     var brand=$("#brand").val();
     var category=$("#category").val();
     var units=$("#units").val();
     var sub_category=$("#sub_category").val();
     var mrp=$("#mrp").val();
     var sale_price=$("#sale_price").val();
     var discount=$("#discount").val();
     var gst=$("#gst").val();
     var quantity=$("#quantity").val();


     if (item_name=='' && item_name==0) {
      global_alert_modal('warning','Enter Product Name...');
      $("#item_name").css("border","1px solid red");
                    $("#item_name").focus();
                    return false;
        }
       else{
        $("#item_name").css("border","1px solid lightgray");
       }
       if (item_code=='' && item_code==0) {
      global_alert_modal('warning','Enter Product Code...');
      $("#item_code").css("border","1px solid red");
                    $("#item_code").focus();
                    return false;
        }
       else{
        $("#item_code").css("border","1px solid lightgray");
       }
        if (brand=='' && brand==0) {
      global_alert_modal('warning','Select Brand...');
      $("#brand").css("border","1px solid red");
                    $("#brand").focus();
                    return false;
        }
       else{
        $("#brand").css("border","1px solid lightgray");
       }
        if (category=='' && category==0) {
      global_alert_modal('warning','Select Category...');
      $("#category").css("border","1px solid red");
                    $("#category").focus();
                    return false;
        }
       else{
        $("#category").css("border","1px solid lightgray");
       }
        if (units=='' && units==0) {
      global_alert_modal('warning','Select Units...');
      $("#units").css("border","1px solid red");
                    $("#units").focus();
                    return false;
        }
       else{
        $("#units").css("border","1px solid lightgray");
       }
        if (mrp=='' && mrp==0) {
      global_alert_modal('warning','Enter MRP Rate...');
      $("#mrp").css("border","1px solid red");
                    $("#mrp").focus();
                    return false;
        }
       else{
        $("#mrp").css("border","1px solid lightgray");
       }
        if (sale_price=='' && sale_price==0) {
      global_alert_modal('warning','Enter Sale Price Name...');
      $("#sale_price").css("border","1px solid red");
                    $("#sale_price").focus();
                    return false;
        }
       else{
        $("#sale_price").css("border","1px solid lightgray");
       }
        if (quantity=='' && quantity==0) {
      global_alert_modal('warning','Enter Product Quantity...');
      $("#quantity").css("border","1px solid red");
                    $("#quantity").focus();
                    return false;
        }
       else{
        $("#quantity").css("border","1px solid lightgray");
       }
$.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/add_items.php',
data: {'item_name':item_name,'item_code':item_code,'brand':brand,'category':category,'sub_category':sub_category,"mrp":mrp,'sale_price':sale_price,'discount':discount,'gst':gst,'quantity':quantity,'units':units},
success: function(res){
if (res.status=='failed') {
  
  global_alert_modal('fail','Item Not Added...');
    return false;

}else if (res.status=='alert') {
  
  global_alert_modal('info','This ItemName Already Stored...');
  $("#item_name").focus();
  $("#item_name").val('');
                    return false;

}
else{
   global_alert_modal('success','Item Added SuccessFully...');
   window.location='item_list.php';

}
}

});
  })
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
              $("#item_add_btn").click();
            }
    }
});
</script>