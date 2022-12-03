<?php 
include 'header.php';
$vendor_obj= new Vendors();
$vendor= $vendor_obj->get_vendor_data(); 
$brand_obj = new Brand();
$brand =  $brand_obj->get_brand_data();
$description_obj = new Description();
$description =  $description_obj->get_description_data();
$category_obj = new Category();
$category =  $category_obj->get_category_data();
?>
<style type="text/css">
.ui-autocomplete {
  max-height: 200px;
  overflow-y: auto;
  /* prevent horizontal scrollbar */
  overflow-x: hidden;
  /* add padding to account for vertical scrollbar */
  padding-right: 20px;
} 
  .css-serial {
      counter-reset: serial-number;  /* Set the serial number counter to 0 */
    }

    .css-serial td:first-child:before {
      counter-increment: serial-number;  /* Increment the serial number counter */
      content: counter(serial-number);  /* Display the counter */
    }
    .table-scroll {
     position: relative;
     width:100%;
     z-index: 1;
     margin: auto;
     overflow: auto;
     height: 350px;
   }
   .table-scroll table {
     width: 98%;
     margin: auto;
     border-collapse: separate;
     border-spacing: 0;
   }
   .table-scroll th,
   .table-scroll td {
     padding: 0.35rem;
     border: 1px solid #000;
     vertical-align: top;
   }
   .table-scroll thead th {
     background: #e9ecef;
     position: -webkit-sticky;
     position: sticky;
     top: 0;
   }
   /* safari and ios need the tfoot itself to be position:sticky also */
   .table-scroll tfoot,
   .table-scroll tfoot th,
   .table-scroll tfoot td {
     position: -webkit-sticky;
     position: sticky;
     bottom: 0;
     background-color: #fff !important;
     z-index:4;
   }

   .table-scroll tfoot td {
     background-color: #fff !important;
   }
   #shipping_name
   {
    z-index: 9999;
   }
   #ui-id-1
    { 
      z-index: 9999999!important;
    }
    #ui-id-3
    { 
      z-index: 9999999!important;
    }
    #ui-id-4
    { 
      z-index: 9999999!important;
    }
    #ui-id-5
    { 
      z-index: 9999999!important;
    }
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <?php if ($_GET['type']=='new') {
              echo '<h1 class="m-0">Purchase Order</h1>';
            }else{
              echo '<h1 class="m-0">Received Purchase Order</h1>';
            } ?>
            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item "><a href="purchase_order.php">Orders List</a></li>
              <?php if ($_GET['type']=='new') {
                echo '<li class="breadcrumb-item active">New Order</li>';
              }else{
                echo '<li class="breadcrumb-item active">Received Order</li>';
              } ?>
              
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content ">
      <div class="container-fluid ">
        
        <!-- Main row -->
        <div class="row ">
          <div class="col-12">
          <div class="card watermark_img">
            
              <div class="card-body row col-12">
                <div class="row col-12">
                  <?php if($_SESSION['type']=='ADMIN'){?>
                  <div class="col-3 form-group mb-2">
                   <label>Vendor Name&nbsp;<label class="text-danger">*</label></label>
                   <input type="hidden" name="sno" id="sno" value="0">
                   <input type="hidden" name="vendor_id" id="vendor_id" value="0">
                  <input type="text" name="vendor" id="vendor" class="form-control" placeholder="Enter Vendor" autofocus>
                </div><?php } ?>
                <?php if ($_GET['type']=='new') {?>
                 <div class="col-9 form-group mb-2 text-right">
                   <i class="nav-icon fas fa-solid fa-truck" style="font-size: xx-large;cursor: pointer;" data-toggle='modal' data-target="#shipping_modal" id="shipping_modal_btn"></i>
                </div>
              <?php }?>
                </div>
                <div class="row col-12" id="vendor_dt" style="display: none;">
                  
                <div class="col-11">
                  <label>Vendor Details</label><br>
                  <div class="row col-12">
                    <div class="col-6">
                      <label>Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label><span id="vendor_name"></span>
                    </div>
                    <div class="col-6">
                      <label>Company Name :</label><span id="vendor_company_name"></span>
                    </div>
                    <div class="col-6">
                      <label>Mobile No :</label><span id="vendor_mobile"></span>
                    </div>
                    <div class="col-6" id="v_email">
                      <label>Email &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label><span id="vendor_email"></span>
                    </div>
                    <div class="col-6" id="v_gst">
                      <label>GST No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label><span id="vendor_gst"></span>
                    </div>
                  </div>
                </div>
                <div class="col-1">
                  <img src="" id="vendor_image" style="width: 100px;height: 100px;border-radius: 50px;">
                </div>
                </div>
                <form id="add_product" class="row col-12" onsubmit="return(false);">
                 <div class="col-12 mb-3" style="border-bottom: 1px solid gray"></div>
               <div class="col-3 form-group mb-3">
                   <label>Product Name&nbsp;<label class="text-danger">*</label></label>
                   <input type="hidden" name="item_id" id="item_id">
                   
              <input type="text" id='item_name' class="form-control enterKeyclass" placeholder="Product Name">
                </div>
                 <div class="col-3 form-group mb-3">
                   <label>Product Varieties&nbsp;<label class="text-danger">&nbsp;</label></label>
                   
              <select id='varieties_id' class="form-control enterKeyclass">
              </select>
                </div>
                <div class="col-3 form-group mb-3">
                   <label>Product Code&nbsp;<label class="text-danger">&nbsp;</label></label>
                   
              <input type="text" id='item_code' class="form-control enterKeyclass" placeholder="Product Code" disabled>
                </div>
                <div class="col-3 form-group mb-3">
                   <label>Brand&nbsp;<label class="text-danger">*</label></label>
              <select class="form-control enterKeyclass" id='brand' style="width: 100%;" disabled>
                    <option value="">Select Brand</option>
                    <?php foreach ($brand as $key => $value) {?>
                      <option  value="<?=$value['id']?>"><?=$value['name']?></option>
                    <?php }?>
                    
                  </select>
                </div>
                <div class="col-3 form-group mb-3">
                   <label>Category&nbsp;<label class="text-danger">*</label></label>
              <select class="form-control enterKeyclass" id="category" style="width: 100%;" disabled>
                    <option value="">Select Category</option>
                    <?php foreach ($category as $key => $value) {?>
                      <option  value="<?=$value['id']?>"><?=$value['name']?></option>
                    <?php }?>
                    
                  </select>
                </div>
                <div class="col-3 form-group mb-3">
                   <label>Description&nbsp;<label class="text-danger">&nbsp;</label></label>
              <select class="form-control enterKeyclass" id="sub_category" style="width: 100%;" >
                    <option value="">Select Description</option>
                    <?php foreach ($description as $key => $value) {?>
                      <option  value="<?=$value['id']?>"><?=$value['name']?></option>
                    <?php }?>
                    
                  </select>
                </div>
                <div class="col-3 form-group mb-3">
                   <label>Units&nbsp;<label class="text-danger">*</label></label>
              <select class="form-control enterKeyclass" id="units" >
                <option value="">Select Units</option>
                    <option value="Kg">Kg</option>
                    <option value="Liter">Liter</option>  
                    <option value="Pcs">Pcs</option>
                    <option value="Nos">Nos</option>  
                    <option value="Box">Box</option>  
              </select>
                </div>
                <div class="col-3 form-group mb-3">
                   <label>Vendor Price&nbsp;<label class="text-danger">*</label></label>
              <input type="text" id='mrp' class="form-control enterKeyclass" placeholder="Vendor Price">
                </div>
                <div class="col-3 form-group mb-3">
                   <label>Mrp&nbsp;<label class="text-danger">&nbsp;</label></label>
              <input type="text" id='sale_price' class="form-control enterKeyclass" placeholder="Mrp">
                </div>
                <div class="col-2 form-group mb-3">
                   <label>Discount&nbsp;<label class="text-danger">&nbsp;</label></label>
              <input type="text" id='discount' class="form-control enterKeyclass" placeholder="Discount">
                </div>
                <div class="col-2 form-group mb-3">
                   <label>GST&nbsp;<label class="text-danger">&nbsp;</label></label>
              
              <select class="form-control enterKeyclass" id="gst">
                <option value="0">0</option>
                <option value="5">5</option>
                <option value="12">12</option>
                <option value="18">18</option>
                <option value="28">28</option>
              </select>
                </div>
                <div class="col-2 form-group mb-3">
                   <label>Quantity&nbsp;<label class="text-danger">*</label></label>
              <input type="text" id='quantity' class="form-control enterKeyclass" placeholder="Quantity">
                </div>
                <div class="col-3 form-group mb-3 text-center" style="vertical-align: center">
                   <button class="btn btn-primary" id="add_item">Add</button>
                </div>
              </form>
                <br>
                <div class="table-scroll">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Product</th>
                      <th>Variety</th>
                      <th>Quantity</th>
                      <th>Description</th>
                      <th>Units</th>
                      <th>Tons</th>
                      <th>Vendor Price</th>
                      <th>Mrp</th>
                      <th>Discount</th>
                      <th>Gst</th>
                      <th>Total</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody class="text-left css-serial" id="tdata">
   <?php for ($i = 1; $i < 8; $i++) {?>
    <tr class="emptyTr">
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
   </tr>
 <?php }?>
</tbody>
<tfoot>
<tr>
  <td colspan="13" class="td-last-1">
 <div class="row">
<div class="col-lg-4 col-sm-4 col-md-4">
  <div class="">
   <span class="">Total Qty : </span>
   <span class="" id="tot_qty">0</span>
 </div>
</div>

  <div class="col-lg-4 col-sm-4 col-md-4">
   <div class="">
    <span class="">Total Ton : </span>
    <span class="" id="tot_ton">0</span>
  </div>
</div>

  <div class="col-lg-4 col-sm-4 col-md-4">
   <div class="">
    <span class="">Discount ₹</span>
    <span class="" id="discid">0</span>
  </div>
</div>

</div>
  <div class="row">
<div class="col-lg-4 col-sm-4 col-md-4">
  <div class="">
   <span class="">Taxable Amount ₹</span>
   <span class="" id="subid">0</span>
   <input type="hidden" name="subid1" id="subid1">
 </div>
</div>



 <div class="col-lg-4 col-sm-4 col-md-4">
  <div class="">
   <span class="">Tax ₹</span>
   <span class="" id="taxid">0</span>
 </div>
</div>
<div class="col-lg-4 col-sm-4 col-md-4">
  <div class="">
   <span class="">Purchase Amount (Include Tax ₹)</span>
   <span class="" id="grandid">0</span>
   <input type='hidden' class="text" id="grandid1" value="0">
 </div>
</div>
</div>

</td>
</tr>

</tfoot>
                </table>
</div>



              
              <?php if ($_GET['type']=='received') {?>
               <div class="row col-12">
                  <div class="col-4">&nbsp;</div>
                  <div class="col-8 text-right">
                    <div class="row col-12 mt-2">
                      <div class="col-6">
                        <label>Bill No :</label>
                      </div>
                       <div class="col-6">
                        <input type="text" id='bill_no' class="form-control" placeholder="Enter Bill No">
                      </div>
                    </div>
                     <div class="row col-12 mt-2">
                      <div class="col-6">
                        <label>Received Date :</label>
                      </div>
                       <div class="col-6">
                        <input type="date" id='received_date' class="form-control" value="<?=date('Y-m-d')?>">
                      </div>
                    </div>
                     <div class="row col-12 mt-2">
                      <div class="col-6">
                        <label>Paid Amount :</label>
                      </div>
                       <div class="col-6">
                        <input type="text" id='paid_amt' class="form-control" placeholder="Paid Amount ">
                      </div>
                    </div>
                     <div class="row col-12 mt-2">
                      <div class="col-6">
                        <label>Balance Amount :</label>
                      </div>
                       <div class="col-6">
                        <input type="text" id='balance' class="form-control" placeholder="0.00" readonly>
                      </div>
                    </div>
                    <div class="row col-12 mt-2">
                      <div class="col-6">
                        <label>Payment Mode :</label>
                      </div>
                       <div class="col-6">
                       <select class="form-control" id='payment_mode'>
                    <option value="Cash">Cash</option>
                    <option value="Card">Card</option>
                    <option value="Google Pay">Google Pay</option>
                    <option value="Amazon Pay">Amazon Pay</option>
                    <option value="PhonePe">PhonePe</option>
                    <option value="Net Banking">Net Banking</option>
                  </select>
                      </div>
                    </div>
                    <div class="row col-12 mt-2 text-right">
                      <div class="col-6">
                        &nbsp;
                      </div>
                      <div class="col-6 text-center">
                        <button class="col-12 btn btn-primary" id="place_order">Place Order</button>
                      </div>
                      
                    </div>
                  </div>
                </div>
              <?php }else{?>
                <div class="row col-12">
                  <div class="col-4">&nbsp;</div>
                  <div class="col-8 text-right">
                    <div class="row col-12 mt-2">
                      <div class="col-6">
                        <label>Notes :</label>
                      </div>
                       <div class="col-6">
                        <textarea class="form-control" id="purchase_note"></textarea>
                      </div>
                    </div>
                    <div class="row col-12 mt-2 text-right">
                      <div class="col-6">
                        &nbsp;
                      </div>
                      <div class="col-6 text-center">
                        <button class="col-12 btn btn-primary" id="place_order">Place Order</button>
                      </div>
                      
                    </div>
                  </div>
                </div>
              <?php }?>
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
  <div class="modal fade" id="shipping_modal" data-backdrop='static'>
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Shipping Details</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 8.3rem">Name&nbsp;<span class="text-danger">*</span></span>
                  </div>
                   <input type="hidden" name="shipping_id" id="shipping_id" value="0">
                  <input type="text" id='shipping_name' name='shipping_name' class="form-control enterKeyclass" placeholder="Enter Name">

                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Company Name&nbsp;<span class="text-danger">*</span></span>
                  </div>
                  <input type="text" id='shipping_company_name' name='shipping_company_name' class="form-control enterKeyclass" placeholder="Enter Company Name">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 8.3rem">Mobile.No&nbsp;<span class="text-danger">*</span></span>
                  </div>
                  <input type="number" id='mobile_no' name='mobile_no' class="form-control enterKeyclass" placeholder="Enter Mobile Number">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 8.3rem">Email</span>
                  </div>
                  <input type="text" id='email' name='email' class="form-control enterKeyclass" placeholder="Enter Email">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 8.3rem">Gst.No</span>
                  </div>
                  <input type="text" id='ship_gst' name='ship_gst' class="form-control enterKeyclass" placeholder="Enter GST No">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 8.3rem">Address</span>
                  </div>
                  <input type="text" id='address' name='address' class="form-control enterKeyclass" placeholder="Enter Address">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 8.3rem">City</span>
                  </div>
                  <input type="text" id='city' name='city' class="form-control enterKeyclass" placeholder="Enter City">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 8.3rem">State</span>
                  </div>
                  <input type="text" id='state' name='state' class="form-control enterKeyclass" placeholder="Enter State">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 8.3rem">Country</span>
                  </div>
                  <input type="text" id='country' name='country' class="form-control enterKeyclass" placeholder="Enter Country">
                </div>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 8.3rem">Pincode</span>
                  </div>
                  <input type="text" id='pincode' name='pincode' class="form-control enterKeyclass" placeholder="Enter Pincode">
                </div>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 8.3rem">Shipping Terms</span>
                  </div>
                  <input type="text" id='ship_terms' name='ship_terms' class="form-control enterKeyclass" placeholder="Enter Shipping Terms">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Shipping Medthod</span>
                  </div>
                  <select class="form-control" id="shipping_method">
                    <option value="FEDEX">FEDEX</option>
                    <option value="UPS">UPS</option>
                    <option value="USPS">USPS</option>
                  </select>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 8.3rem">Delivery Date</span>
                  </div>
                  <input type="date" id='shipping_d_date' name='shipping_d_date' class="form-control enterKeyclass" value="<?=date('Y-m-d')?>">
                </div>
            </div>
          <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="shipping_dt_add">Add</button>
            </div>
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

<script type="text/javascript">

  function get_vendor_dt(e){
          $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/get_vendor_data.php',
data: {'vendor_id':e},
success: function(res){
    $("#vendor_name").html(res.name+' - '+res.vendor_code);
    $("#vendor_company_name").html(res.company_name);
    $("#vendor_mobile").html(res.mobile_no);
    if (res.email!='') {
      $("#vendor_email").html(res.email);
      $("#v_email").css('display','');
    }else{
      $("#v_email").css('display','none');
    }
     if (res.gst!='' && res.gst!=null) {
      $("#vendor_gst").html(res.gst);
      $("#v_gst").css('display','');
    }else{
      $("#v_gst").css('display','none');
    }
    
    if (res.vendor_logo!='') {
      $("#vendor_image").attr('src','../uploads/vendor/'+res.vendor_logo);
      $("#vendor_image").css('display','');
    }else{
      $("#vendor_image").css('display','none');
    }
    
    $("#vendor_dt").css('display','');

  }

});
  }

</script>
<script type="text/javascript">
  $(document).ready(function(){
 items = [];
 shipping_data = [];
 data=[];
     $('#item_name').autocomplete({
      source: "../ajaxCalls/autocomplete_item_list.php",
      minLength: 1,
      select: function(event, ui)
      {

        if(ui.item.value == 'NO ITEM FOUND'){
       $.growl.warning({title:"Item Not Available",message:"Kindly Add Item From VendorProduct"});
       $("#add_item").attr('disabled','disabled');
    }
    else
    {
       $("#add_item").attr('disabled',false);
    }

        // $('#item_id').val(ui.item.label);
        get_item_dt(ui.item.label);
        // $('#item_name').val(ui.item.value);
        // $('#item_code').val(ui.item.item_code);
        // $("#brand").val(ui.item.brand);
        // $("#category").val(ui.item.category);        
        // $("#mrp").val(ui.item.mrp);
        // $("#units").val(ui.item.units);
        // $("#sale_price").val(ui.item.sale_price);
        // $("#discount").val(ui.item.discount);
        // $("#gst").val(ui.item.gst);
        // $("#sub_category").val(ui.item.sub_category);
          
    }
     
    }).data('ui-autocomplete')._renderItem = function(ul, item){
      return $("<li class='ui-autocomplete-row'></li>")
        .data("item.autocomplete", item)
        .append(item.value)
        .appendTo(ul);
    };

     $('#vendor').autocomplete({
      source: "../ajaxCalls/autocomplete_vendor_list.php",
      minLength: 1,
      select: function(event,ui)
      {

        if(ui.item.value == ' '){
      $("#vendor_id").val(0);
    }
    else
    {

       get_vendor_dt(ui.item.label);
       $("#vendor_id").val(ui.item.label);
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
<script type="text/javascript">
  $('#shipping_name').autocomplete({


      source: "../ajaxCalls/autocomplete_shipping_list.php",
      minLength: 1,
      select: function(event,ui){

          $("#shipping_company_name").val(ui.item.company_name);
           $("#mobile_no").val(ui.item.mobile_no);
           $("#email").val(ui.item.email);
           $("#ship_gst").val(ui.item.gst_no);
           $("#city").val(ui.item.city);
          $("#address").val(ui.item.address);
          $("#state").val(ui.item.state);
          $("#country").val(ui.item.country);
          $("#pincode").val(ui.item.pincode);
          $("#ship_terms").val(ui.item.shipping_terms);
           $("#shipping_d_date").val(ui.item.delivery);
        
    
    }
     
    }).data('ui-autocomplete')._renderItem = function(ul,item){
      return $("<li class='ui-autocomplete-row'></li>")
        .data("item.autocomplete", item)
        .append(item.value)
        .appendTo(ul);
    };

  
</script>


<script type="text/javascript">
  $("#add_item").click(function(){
    var item_name=$("#item_name").val();
     var brand=$("#brand").val();
     var category=$("#category").val();
     var sub_category=$("#sub_category").val();
     var mrp=$("#mrp").val();
     var sale_price=$("#sale_price").val();
     var discount=$("#discount").val();
     var gst=$("#gst").val();
     var quantity=$("#quantity").val();
     var units=$("#units").val();
     var item_code=$("#item_code").val();
     var varieties_id=$("#varieties_id option:selected").val();
     var varieties_name=$("#varieties_id option:selected").text();
if ($("#item_id").val()==0 || $("#item_id").val() =='') {
  global_alert_modal('warning','Enter Stored Product Name...');
                    $("#item_name").focus();
                    return false;
}

     if (item_name=='' && item_name==0) {
      global_alert_modal('warning','Enter Product Name...');
      $("#item_name").css("border","1px solid red");
                    $("#item_name").focus();
                    return false;
        }
       else{
        $("#item_name").css("border","1px solid lightgray");
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
        if (sub_category=='' && sub_category==0) {
      global_alert_modal('warning','Select Category...');
      $("#sub_category").css("border","1px solid red");
                    $("#sub_category").focus();
                    return false;
        }
       else{
        $("#sub_category").css("border","1px solid lightgray");
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
      global_alert_modal('warning','Enter Product Units...');
      $("#units").css("border","1px solid red");
                    $("#quantity").focus();
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
      //   if (sale_price=='' && sale_price==0) {
      // global_alert_modal('warning','Enter Sale Price Name...');
      // $("#sale_price").css("border","1px solid red");
      //               $("#sale_price").focus();
      //               return false;
      //   }
      //  else{
      //   $("#sale_price").css("border","1px solid lightgray");
      //  }
        if (quantity=='' && quantity==0) {
      global_alert_modal('warning','Enter Product Quantity...');
      $("#quantity").css("border","1px solid red");
                    $("#quantity").focus();
                    return false;
        }
       else{
        $("#quantity").css("border","1px solid lightgray");
       }
       sno=Number($("#sno").val())+1;
       data["item_id"]=$("#item_id").val();
       data["item_name"]=item_name;
       data["varieties_id"]=varieties_id;
       data["varieties_name"]=varieties_name;
       data["item_code"]=item_code;
       data["brand"]=brand;
       data["category"]=category;
       data["sub_category"]=sub_category;
       data["mrp"]=mrp;
       data["sale_price"]=sale_price;
       data["discount"]=discount;
       data["gst"]=gst;
       data["quantity"]=quantity;
       data["units"]=units;
       var tons=quantity/1000;
       data["tons"]=tons;
       total1=Number(data["mrp"])*Number(data["quantity"]);
       total2=Number(total1)-Number(total1)*Number(data["discount"])/100;
       total=Number(total2);
       // total=total.toFixed(2);
       
    prototal=Number(($("#mrp").val()*$("#quantity").val())-(($("#mrp").val()*$("#quantity").val())*($("#discount").val()/100)));

     gstamount=prototal*(Number($("#gst").val())/100);
     data["total"]=(total+gstamount).toFixed(2);
      items["sid"+sno] = {
      "item_id":$("#item_id").val(),
      "item_name":$("#item_name").val(),
      "item_code":$("#item_code").val(),
      "varieties_id":$("#varieties_id option:selected").val(),
      "varieties_name":$("#varieties_id option:selected").text(),
      "brand":brand,
      "category":category,
      "sub_category":sub_category,
      "units":units,
      "mrp":mrp,
      "sale_price":sale_price,
      "discount":discount,
      "gst":gst,
      "gstpercentage":gst/100,
      "quantity":quantity,
      "gstamount":gstamount,
      "total":total
      };
            $('#tdata tr').each(function(index) {
              $(this).find('span.sn').html(index+1);
            });
            calculation();
            var trItemTemplate = [
            '<tr id="trItem_{{sno}}">',
            '<td class=" ch-4"><span></span></td>',
            '<td class="text-left ch-10">{{itemname}}</td>',
            '<td class="text-left ch-10">{{variety}}</td>',
            '<td class="text-left ch-4">',
                '<input onkeyup=fieldupdate({{sno}},this) class="form-control quantity" name="quantity[]" id="quantity{{sno}}" value="{{quantity}}" style="width:5rem; height:1.75rem">',
                '</td>',
            '<td class="text-left ch-10">{{description}}</td>',
            '<td class="text-left ch-10">{{units}}</td>',
            '<td class="text-left ch-10" id="tons{{sno}}">{{tons}}</td>',
            '<td class="text-left ch-4">',

                '<input onkeyup=fieldupdate({{sno}},this) class="form-control mrp" name="mrp[]" id="mrp{{sno}}" value="{{mrp}}" style="width:5rem; height:1.75rem">',

                '</td>',
                '<td class="text-left ch-4">',

                '<input onkeyup=fieldupdate({{sno}},this) class="form-control sale_price" name="sale_price[]" id="sale_price{{sno}}" value="{{sale_price}}" style="width:5rem; height:1.75rem">',

                '</td>',
                '<td class="text-left ch-4">',

                '<input onkeyup=fieldupdate({{sno}},this) class="form-control discount" name="discount[]" id="discount{{sno}}" value="{{discount}}" style="width:5rem; height:1.75rem">',

                '</td>','<td class="text-left ch-4">',

                '<input onkeyup=fieldupdate({{sno}},this) class="form-control gst" name="gst[]" id="gst{{sno}}" value="{{gst}}" style="width:5rem; height:1.75rem">',

                '</td>',
                '<td class="text-left ch-6" id="totalid{{sno}}">{{total}}</td>',
                '<td class="text-center ch-4">',
                '<button type="button" id="remove_tr{{sno}}" class="btn btn-default btn-sm" onclick="removeItem({{sno}})">',
                '<span class="glyphicon glyphicon-trash">',
                '<i class="fas fa-trash"></i>',
                '</span>',
                '</button>',
                '</td>',
                '</tr>'].join(''),

                tr = trItemTemplate;
                tr = tr.replace(getRegEx('sno'), sno);
                tr = tr.replace(getRegEx('itemname'), data['item_name']);
                tr = tr.replace(getRegEx('variety'), data['varieties_name']);
                tr = tr.replace(getRegEx('units'), data['units']);
              tr = tr.replace(getRegEx('mrp'), data['mrp']);
              tr = tr.replace(getRegEx('description'), $("#sub_category option:selected").text());
              tr = tr.replace(getRegEx('sale_price'), data['sale_price']);
              tr = tr.replace(getRegEx('discount'), data['discount']);
              tr = tr.replace(getRegEx('gst'), data['gst']);
              tr = tr.replace(getRegEx('quantity'), data['quantity']);
              tr = tr.replace(getRegEx('total'), data['total']);
              tr = tr.replace(getRegEx('tons'), data['tons']);

              var emptyTr = $('#tdata .emptyTr').first();
              if (emptyTr.length === 0) {
               $('#tdata').append(tr);
             }
             else {
               $('#tdata .emptyTr').first().replaceWith(tr);
             }
             $('#add_product').trigger("reset");
            $("#sno").val(sno);
            $("#item_id").val(0);
            $("#varieties_id").val(0);
            $('#item_name').focus();

  })
</script>
<script type="text/javascript">
   function fieldupdate(idval,ele){

      var ref = "sid"+idval;
      
      var mrp = $("#mrp"+idval).val();
      var sale_price = $("#sale_price"+idval).val();
      var discount = $("#discount"+idval).val();
      var gst = $("#gst"+idval).val();
      var quantity = $("#quantity"+idval).val();
      var tons=Number($("#quantity"+idval).val())/1000;
     prototal=Number(mrp*quantity)-(Number(mrp*quantity)*(discount/100));
     gstamount=prototal*(gst/100);
     $("#totalid"+idval).html((prototal+gstamount).toFixed(2));
     $("#tons"+idval).html(tons);
    items[ref].sale_price=sale_price;
    items[ref].mrp=mrp;
    items[ref].quantity=quantity;
    items[ref].discount=discount;
    items[ref].gst=gst;
    items[ref].gstpercentage=gst/100;
    items[ref].gstamount=gstamount;
    items[ref].total=prototal;
      calculation();
  }
    function removeItem(idval){
       var id = idval;
       jQuery('#trItem_' + id).empty('');
       delete items["sid"+idval] ;
    $('#tdata tr').each(function(index) {
     $(this).find('span.sn').html(index+1);
   });
    calculation();
  }
  function calculation() {
    itemslist = items;
    var total=0;
    var tax=0;
    var grand_total=0;
    var total_qty=0;
    var subtotal1=0;
    var subtotal2=0;
    var qty;
    var remamount=0;
    var i=0;
    var discount=0;
    var disamt=0;
    var inclusive_tax=0;
    var inclusive_subtotal=0;
    var val=0;
    var tempItem;
     for(vale in itemslist) {
        tempItem = itemslist[vale];
        val=Number(tempItem["quantity"]);
        total_qty=total_qty+Number(tempItem["quantity"]);
        total= Number(tempItem["mrp"])*Number(tempItem["quantity"]);


        discount=Number(discount)+(Number(total)*Number(tempItem["discount"]/100));
        remamount=(Number(total)-(Number(total)*Number(tempItem["discount"]/100)));
        subtotal1=Number(subtotal1)+Number(remamount);
         tax=Number(tax)+(Number(tempItem['gstpercentage'])*Number(remamount));

      i++;
    }
    subtotal2=Number(subtotal1)+Number(tax);
  grand_total=Number(subtotal2);
  $("#balance").val(grand_total);
  grand_total= grand_total.toFixed(2) ;
       $("#tot_qty").html(total_qty);
       $("#tot_ton").html(total_qty/1000); 
       $("#subid").html(subtotal1.toFixed(2));
       $("#taxid").html(tax.toFixed(2));
       $("#discid").html(discount.toFixed(2));
       $("#grandid").html(grand_total);
  }
  function getRegEx(str) {
  return new RegExp('{{' + str + '}}', 'g');
}
$("#place_order").click(function(){
      var vendor_id = $("#vendor_id").val();
      var bill_no = $("#bill_no").val();
      var received_date = $("#received_date").val();
      var paid_amt = $("#paid_amt").val();
      var balance = $("#balance").val();
      var payment_mode = $("#payment_mode option:selected").val();
      var purchase_note = $("#purchase_note").val();
      if (vendor_id==0) {
      global_alert_modal('warning','Select Vendor Name...');
      $("#vendor").css("border","1px solid red");
      $("#vendor").focus();
      return false;
      }
      else{
      $("#vendor").css("border","1px solid lightgray");
      }
      if (jQuery.isEmptyObject(items)==true) {
        global_alert_modal('fail','Add One Product To Purchase...');
        $("#item_name").focus();
        return false;
      }

      if ("<?=$_GET['type']?>"=='received') {
        if (bill_no=='' && bill_no==0) {
      global_alert_modal('warning','Enter Bill Number...');
      $("#bill_no").css("border","1px solid red");
      $("#bill_no").focus();
      return false;
      }
      else{
      $("#bill_no").css("border","1px solid lightgray");
      }
      if (received_date=='') {
      global_alert_modal('warning','Select Received Date...');
      $("#received_date").css("border","1px solid red");
      $("#received_date").focus();
      return false;
      }
      else{
      $("#received_date").css("border","1px solid lightgray");
      }
      if (paid_amt=='' && paid_amt==0) {
      global_alert_modal('warning','Enter Paid Amount...');
      $("#paid_amt").css("border","1px solid red");
      $("#paid_amt").focus();
      return false;
      }
      else{
      $("#paid_amt").css("border","1px solid lightgray");
      }
      }
      
      detailsarray = [];
      detailsarray['vendor_id']=vendor_id;
      detailsarray['bill_no']=bill_no;
      detailsarray['received_date']=received_date;
      detailsarray['paid_amt']=paid_amt;
      detailsarray['balance']=balance;
      detailsarray['payment_mode']=payment_mode;
      detailsarray['purchase_note']=purchase_note;
      detailsarray['taxable_amount']=Number($("#subid").text());
      detailsarray['discount']=Number($("#discid").text());
      detailsarray['tax_amount']=Number($("#taxid").text());
      detailsarray['grand_total']=Number($("#grandid").text());
      detailsarray['order_type']="<?=$_GET['type']?>";
$("#place_order").attr('disabled','disabled');
var dobj=$.extend({},detailsarray);
var obj = $.extend({}, items);
var shipobj = $.extend({}, shipping_data);
$.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/add_purchase_order.php',
data: $.param(obj)+'&'+$.param(dobj)+'&'+$.param(shipobj),
success: function(res){
    if (res.status=='success') {
      global_alert_modal('success','Purchase Added SuccessFully...');
      window.location='purchase_order.php';
    }
  }

});

});
$("#paid_amt").on('keyup',function(){
  var total_amt=Number($("#grandid").text());

  var paid_amt=$(this).val();
  if (total_amt < paid_amt) {
    $(this).val('');
    $(this).focus();
    global_alert_modal('warning','Enter Paid Amount Below or Equal of Purchase Amount ...');
    $("#balance").val(total_amt);
    return false;
  }
  var balance_amt=total_amt - paid_amt;
  $("#balance").val(balance_amt);
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
               $("#add_item").click();
              
            }
    }
});
</script>
<script type="text/javascript">
  $("#shipping_dt_add").click(function(){
       shipping_data["shipping_name"]=$("#shipping_name").val();

       shipping_data["shipping_company_name"]=$("#shipping_company_name").val();
       shipping_data["smobile_no"]=$("#mobile_no").val();
       shipping_data["semail"]=$("#email").val();
       shipping_data["sgst"]=$("#ship_gst").val();
       shipping_data["saddress"]=$("#address").val();
       shipping_data["scity"]=$("#city").val();
       shipping_data["sstate"]=$("#state").val();
       shipping_data["scountry"]=$("#country").val();
       shipping_data["spincode"]=$("#pincode").val();
       shipping_data["ship_terms"]=$("#ship_terms").val();
       shipping_data["shipping_method"]=$("#shipping_method").val();
       shipping_data["shipping_d_date"]=$("#shipping_d_date").val();
       $("#shipping_modal").modal('hide');
       
  })
  function get_item_dt(e) {
    $.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/get_item_details.php',
data:{'item_id':e},
success: function(res){
      $('#item_id').val(res.item_id);
      $('#item_name').val(res.item_name);
      $('#item_code').val(res.item_code);
      $("#brand").val(res.brand);
      $("#category").val(res.category);        
      $("#mrp").val(res.mrp);
      $("#units").val(res.units);
      $("#sale_price").val(res.sales_price);
      $("#discount").val(res.discount);
      $("#gst").val(res.gst);
      $("#sub_category").val(res.sub_category);
      $("#varieties_id").html(res.varieties);
  }

});
  }
</script>




