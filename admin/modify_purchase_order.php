<?php 
include 'header.php';

$obj=new PurchaseOrder();
$purchase_order_dt=$obj->get_purchase_order(base64_decode($_GET['id']));

// print_r($purchase_order_dt);die();
$purchase_order_item_dt=$obj->get_purchase_order_item($purchase_order_dt[0]['id']);
$shipping_details = $obj->get_shipping_edit($purchase_order_dt[0]['ship_id']);

// print_r($purchase_order_dt[0]['delivery_date']);die();
$vendor_obj= new Vendors();
$vendor= $vendor_obj->get_vendor_dt($purchase_order_dt[0]['vendor_id']); 
$brand_obj = new Brand();
$brand =  $brand_obj->get_brand_data();
$description_obj = new Description();
$description =  $description_obj->get_description_data();
$category_obj = new Category();
$category =  $category_obj->get_category_data();

$items=array();
$i=0;
foreach ($purchase_order_item_dt as $key => $value) {
 $i++;
 $ttl=$value['total']+$value['tax_amt'];
 $items['sid'.$i]=[
  "item_id"=>$value['item_id'],
  "item_name"=>$value['item_name'],
  "item_code"=>$value['item_code'],
  "varieties_id"=>$value['var_id'],
  "varieties_name"=>$value['var_name'],
  "brand"=>$value['brand'],
  "category"=>$value['category'],
  "sub_category"=>$value['sub_category'],
  "units"=>$value['units'],
  "mrp"=>$value['mrp'],
  "sale_price"=>$value['sales_price'],
  "discount"=>$value['discount'],
  "gst"=>$value['gst'],
  "gstpercentage"=>$value['gst']/100,
  "order_qty"=>$value['qty'],
  "rec_qty"=>$value['received_qty'],
  "enter_qty"=>$value['qty'],
  "gstamount"=>$value['tax_amt'],
  "total"=>$value['total'],
  "deleted"=>'no',
  "flag"=>'old',
  "main_id"=>$value['id']
 ];
}
$items=json_encode($items);
?>


<style type="text/css">
<?php if($_SESSION['type']!="ADMIN"){ ?>
  .hide{

    display: none;
  }
 <?php } ?> 

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
  z-index: 0;
  margin: auto;
  overflow: auto;
  <?php if (count($purchase_order_item_dt)>=7) { ?>
   height: 350px;
  <?php }?>
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
 #ui-id-1
 { 
  z-index: 9999999!important;
 }
   /* #ui-id-3
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
      }*/
     </style>
     <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
       <div class="container-fluid">
        <div class="row mb-2">
         <div class="col-sm-6">
          <?php if($_SESSION['type']=="ADMIN") {?>
                  <h1 class="m-0">Edit Order</h1>
               <?php }else{ ?>
                <h1 class="m-0">Receiving Order</h1>
              <?php } ?>  
         </div><!-- /.col -->
         <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
           <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
           <li class="breadcrumb-item "><a href="purchase_order.php?type=NEW">Orders List</a></li>


          </ol>
         </div><!-- /.col -->
        </div><!-- /.row -->
       </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
       <div class="container-fluid">
        <input type="hidden" name="sno" id="sno" value="<?=$i?>">
        <!-- Main row -->
        <div class="row">
         <div class="col-12">
          <div class="card watermark_img">

           <div class="card-body row col-12">
            <div class="row col-10">
             <?php if($_SESSION['type']=='ADMIN'){ ?>
              <div class="col-12" id="vendor_dt">
               <label>Vendor Details</label><br>
               <div class="row col-12">
                <div class="col-6">
                 <label>Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label><span id="vendor_name"> <?=$vendor['name']?> - <?=$vendor['vendor_code']?></span>
                </div>
                <div class="col-6">
                 <label>Company Name :</label><span id="vendor_company_name"> <?=$vendor['company_name']?></span>
                </div>

                <div class="col-6">
                 <label>Mobile No :</label><span id="vendor_mobile"> <?=$vendor['mobile_no']?></span>
                </div>
                <?php if ($vendor['email']!='') { ?>
                 <div class="col-6">
                  <label>Email &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label><span id="vendor_email"> <?=$vendor['email']?></span>
                 </div>
                <?php }?>
                <?php if ($vendor['gst']!='') { ?>
                 <div class="col-6">
                  <label>GST No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label><span id="vendor_gst"> <?=$vendor['gst']?></span>
                 </div>
                <?php }?>

               </div>
               </div><?php }else{?>

                <div class="col-3 form-group mb-2">
                 <label><img src="../dist/img/g.png" height="75px" width="75px">ALAXON MAX&nbsp;</label>
                 <input type="hidden" name="sno" id="sno" value="0">
                 <input type="hidden" name="nvendor_id" id="nvendor_id" value="0">
                 <!-- <input type="hidden" name="vendor" id="vendor" class="form-control" placeholder="Enter Vendor" autofocus> -->
                 </div><?php } ?>


                </div>
                <div class="col-2 form-group mb-2 text-right">
               <?php if($_SESSION['type']=="ADMIN"){ ?>
                 <i class="nav-icon fas fa-solid fa-truck" style="font-size: xx-large;cursor: pointer;" data-toggle='modal' data-target="#shipping_modal" id="shipping_modal_btn"></i>
               <?php } ?>

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
                 <div class="col-3 form-group mb-3 hide">
                  <label>Vendor Price&nbsp;<label class="text-danger">*</label></label>
                  <input type="text" id='mrp' class="form-control enterKeyclass" placeholder="Vendor Price">
                 </div>
                 <div class="col-3 form-group mb-3 hide">
                  <label>Mrp&nbsp;<label class="text-danger">&nbsp;</label></label>
                  <input type="text" id='sale_price' class="form-control enterKeyclass" placeholder="Mrp">
                 </div>
                 <div class="col-2 form-group mb-3 hide">
                  <label>Discount&nbsp;<label class="text-danger">&nbsp;</label></label>
                  <input type="text" id='discount' class="form-control enterKeyclass" placeholder="Discount">
                 </div>
                 <div class="col-2 form-group mb-3 hide">
                  <label>GST&nbsp;<label class="text-danger">&nbsp;</label></label>

                  <select class="form-control enterKeyclass" id="gst">
                   <option value="0">0</option>
                   <option value="5">5</option>
                   <option value="12">12</option>
                   <option value="18">18</option>
                   <option value="28">28</option>
                  </select>
                 </div>

                 <?php if($_SESSION['type']=="ADMIN"){ ?>
                 <div class="col-2 form-group mb-3">
                  <label>Quantity&nbsp;<label class="text-danger">*</label></label>
                  <input type="text" id='quantity' class="form-control enterKeyclass" placeholder="Quantity">
                 </div>
                 <div class="col-3 form-group mb-3 text-center" style="vertical-align: center">
                  <button class="btn btn-primary" id="add_item">Add</button>
                 </div>
                 <?php } else{ ?>
                    <div class="col-1 form-group mb-3">
                  <label>Quantity&nbsp;<label class="text-danger">*</label></label>
                  <input type="text" id='quantity' class="form-control enterKeyclass" placeholder="Quantity">
                 </div>
                 <div class="col-1 form-group mb-3 text-center" style="vertical-align: center;margin-top: 40px;">
                  <button class="btn btn-primary" id="add_item">Add</button>
                 </div>
                  
                <?php } ?>
                </form>
                <br>
                
                <br>

                <div class="table-scroll">
                 <table class="table table-bordered">
                  <thead>
                   <tr>
                    <th>S.No</th>
                    <th>Product</th>
                    <th>Variety</th>
                    <th>Qty</th>
                    <th>Description</th>
                    <th>Units</th>
                    <th>Tons</th>
                    <th class="hide">Vendor Price</th>
                    <th class="hide">Mrp</th>
                    <th class="hide">Discount</th>
                    <th class="hide">Gst</th>
                    <th class="hide">Total</th>
                    <th>Actions</th>
                   </tr>
                  </thead>
                  <tbody class="text-left css-serial" id="tdata">
                   <?php $sno=0;
                   $totalqty = 0;
                   $totalton = 0;
                   $totdis = 0;
                   $taxableamt = 0;
                   $taxtot = 0;
                   $grandtot = 0;
                   foreach ($purchase_order_item_dt as $key => $row) {
                    $sno++;
                    $description='';
                    if ($row['sub_category']!='' && $row['sub_category']!=0) {
                     $description =  $description_obj->get_description_dt($row['sub_category']);
                     $description_name=$description[0]['name'];
                    }

                    $tns = $row['qty']/1000;

                    $ttl=$row['total']+$row['tax_amt'];

                    echo '<tr id="trItem_'.$sno.'">';
                    echo '<td class=" ch-4"><span></span></td>';
                    echo '<td class="text-left ch-10">'.$row['item_name'];
                    if ($row['item_code']!='') {
                     echo ' - '.$row['item_code'];
                    }
                    echo '</td>';
                    echo '<td class=" ch-4">'.$row['var_name'].'</td>';
                    echo '<td class="text-left ch-4">';

                    echo '<input onkeyup=quantityupdate('.$sno.',this) class="form-control quantity" name="quantity[]" id="quantity'.$sno.'" value="'.$row['qty'].'" style="width:4rem; height:1.75rem; font-size:0.9rem;">';

                    echo '</td>';
                    echo '<td class="text-left ch-10">'.$description_name.'</td>';
                    echo '<td class="text-left ch-10">'.$row['units'].'</td>';
                    echo '<td class="text-left ch-10" id="tons'.$sno.'">'.$tns.'</td>';

                    echo '<td class="text-left ch-4 hide">';

                    echo '<input onkeyup=fieldupdate('.$sno.',this) class="form-control mrp" name="mrp[]" id="mrp'.$sno.'" value="'.$row['mrp'].'" style="width:5rem; height:1.75rem; font-size:0.9rem;">';

                    echo '</td>';
                    echo '<td class="text-left ch-4 hide">';

                    echo '<input onkeyup=fieldupdate('.$sno.',this) class="form-control sale_price" name="sale_price[]" id="sale_price'.$sno.'" value="'.$row['sales_price'].'" style="width:4.3rem; height:1.75rem; font-size:0.9rem;">';

                    echo '</td>';
                    echo '<td class="text-left ch-4 hide">';

                    echo '<input onkeyup=fieldupdate('.$sno.',this) class="form-control discount" name="discount[]" id="discount'.$sno.'" value="'.$row['discount'].'" style="width:4rem; height:1.75rem; font-size:0.9rem;">';

                    echo '</td>';
                    echo '<td class="text-left ch-4 hide">';

                    echo '<input onkeyup=fieldupdate('.$sno.',this) class="form-control gst" name="gst[]" id="gst'.$sno.'" value="'.$row['gst'].'" style="width:4rem; height:1.75rem; font-size:0.9rem;">';

                    echo '</td>';
                    echo '<td class="text-left ch-6 hide" id="totalid'.$sno.'">'.number_format($ttl,2,'.','').'</td>';

                    echo'<td><button type="button" class="btn btn-default btn-sm" id="remove_tr'.$sno.'" data-id="old" onclick="removeItem('.$sno.')"><span class="glyphicon glyphicon-trash">
                    <i class="fas fa-trash"></i>
                    </span></button></td>';

                    echo '</tr>';

                    $prt = $row['qty']*$row['mrp'];
                    $disv = $prt*$row['discount']/100;

                    $taxable = $prt-$disv;

                    $grand = $taxable+$row['tax_amt'];

                    $totalqty = $totalqty+$row['qty'];
                    $totalton = $totalton+$tns;
                    $taxableamt = $taxableamt+$taxable;
                    $totdis = $totdis+$disv;
                    $taxtot = $taxtot+$row['tax_amt'];
                    $grandtot = $grandtot+$grand;

                   } ?>
                  </tbody>
                  <tfoot>
                   <tr>
                    <td colspan="15" class="td-last-1 hide">
                     <div class="row">
                      <div class="col-lg-4 col-sm-4 col-md-4">
                       <div class="">
                        <span class="">Total Qty : </span>
                        <span class="" id="tot_qty"><?=$totalqty?></span>
                       </div>
                      </div>

                      <div class="col-lg-4 col-sm-4 col-md-4">
                       <div class="">
                        <span class="">Total Ton : </span>
                        <span class="" id="tot_ton"><?=$totalton?></span>
                       </div>
                      </div>

                      <div class="col-lg-4 col-sm-4 col-md-4">
                       <div class="">
                        <span class="">Discount ₹</span>
                        <span class="" id="discid"><?=$totdis?></span>
                       </div>
                      </div>

                     </div>
                     <div class="row">
                      <div class="col-lg-4 col-sm-4 col-md-4">
                       <div class="">
                        <span class="">Taxable Amount ₹</span>
                        <span class="" id="subid"><?=$taxableamt?></span>
                        <input type="hidden" name="subid1" id="subid1" value="<?=$taxableamt?>">
                       </div>
                      </div>



                      <div class="col-lg-4 col-sm-4 col-md-4">
                       <div class="">
                        <span class="">Tax ₹</span>
                        <span class="" id="taxid"><?=$taxtot?></span>
                       </div>
                      </div>
                      <div class="col-lg-4 col-sm-4 col-md-4">
                       <div class="">
                        <span class="">Purchase Amount (Include Tax ₹)</span>
                        <span class="" id="grandid"><?=$grandtot?></span>
                        <input type='hidden' class="text" id="grandid1" value="<?=$grandtot?>">
                       </div>
                      </div>
                     </div>

                    </td>
                   </tr>

                  </tfoot>
                 </table>
                </div>
                <div class="row col-12 mt-2 text-right">
                 <div class="col-6">
                  &nbsp;
                 </div>
                 <div class="col-3">
                  &nbsp;
                 </div>
                 <div class="col-3 text-center">
                  <button class="col-12 btn btn-primary" id="place_order">SAVE</button>
                 </div>

                </div>
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
         <div class="modal fade" id="add_vendor_modal" data-backdrop='static'>
          <div class="modal-dialog modal-lg">
           <div class="modal-content">
            <div class="modal-header">
             <h4 class="modal-title">Add Vendor Details</h4>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
             </button>
            </div>

           </div>
           <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save</button>
           </div>
          </div>
          <!-- /.modal-content -->
         </div>
         <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
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
             <input type="hidden" name="shipping_prev_id" id="shipping_prev_id" value="<?=$shipping_details[0]['id']?>">

             <input type="hidden" name="po_id" id="po_id" value="<?=$_GET['id']?>">

             <input type="text" id='shipping_name' name='shipping_name' value="<?=$shipping_details[0]['name']?>" class="form-control enterKeyclass" placeholder="Enter Name">

            </div>
            <div class="input-group mb-3">
             <div class="input-group-prepend">
              <span class="input-group-text " >Company Name&nbsp;<span class="text-danger">*</span></span>
             </div>
             <input type="text" id='shipping_company_name' name='shipping_company_name' value="<?=$shipping_details[0]['company_name']?>" class="form-control enterKeyclass" disabled placeholder="Enter Company Name">
            </div>
            <div class="input-group mb-3">
             <div class="input-group-prepend">
              <span class="input-group-text" style="width: 8.3rem">Mobile.No&nbsp;<span class="text-danger">*</span></span>
             </div>
             <input type="number" id='mobile_no' name='mobile_no' class="form-control enterKeyclass" value="<?=$shipping_details[0]['mobile_no']?>" disabled placeholder="Enter Mobile Number">
            </div>
            <div class="input-group mb-3">
             <div class="input-group-prepend">
              <span class="input-group-text" style="width: 8.3rem">Email</span>
             </div>
             <input type="text" id='email' name='email' value="<?=$shipping_details[0]['email']?>" class="form-control enterKeyclass" placeholder="Enter Email" disabled>
            </div>
            <div class="input-group mb-3">
             <div class="input-group-prepend">
              <span class="input-group-text" style="width: 8.3rem">Gst.No</span>
             </div>
             <input type="text" id='ship_gst' name='ship_gst' value="<?=$shipping_details[0]['email']?>" class="form-control enterKeyclass" placeholder="Enter GST No" disabled>
            </div>
            <div class="input-group mb-3">
             <div class="input-group-prepend">
              <span class="input-group-text" style="width: 8.3rem">Address</span>
             </div>
             <input type="text" id='address' name='address' value="<?=$shipping_details[0]['address']?>" class="form-control enterKeyclass" placeholder="Enter Address" disabled>
            </div>
            <div class="input-group mb-3">
             <div class="input-group-prepend">
              <span class="input-group-text" style="width: 8.3rem">City</span>
             </div>
             <input type="text" id='city' name='city' value="<?=$shipping_details[0]['city']?>" class="form-control enterKeyclass" placeholder="Enter City" disabled>
            </div>
            <div class="input-group mb-3">
             <div class="input-group-prepend">
              <span class="input-group-text" style="width: 8.3rem">State</span>
             </div>
             <input type="text" id='state' name='state' value="<?=$shipping_details[0]['state']?>" class="form-control enterKeyclass" placeholder="Enter State" disabled>
            </div>
            <div class="input-group mb-3">
             <div class="input-group-prepend">
              <span class="input-group-text" style="width: 8.3rem">Country</span>
             </div>
             <input type="text" id='country' value="<?=$shipping_details[0]['country']?>" name='country' class="form-control enterKeyclass" placeholder="Enter Country" disabled>
            </div>

            <div class="input-group mb-3">
             <div class="input-group-prepend">
              <span class="input-group-text" style="width: 8.3rem">Pincode</span>
             </div>
             <input type="text" id='pincode' value="<?=$shipping_details[0]['pincode']?>" name='pincode' class="form-control enterKeyclass" placeholder="Enter Pincode" disabled>
            </div>

            <div class="input-group mb-3">
             <div class="input-group-prepend">
              <span class="input-group-text" style="width: 8.3rem">Shipping Terms</span>
             </div>
             <input type="text" id='ship_terms' value="<?=$purchase_order_dt[0]['shipping_terms']?>" name='ship_terms' class="form-control enterKeyclass" placeholder="Enter Shipping Terms" >
            </div>
            <div class="input-group mb-3">
             <div class="input-group-prepend">
              <span class="input-group-text">Shipping Medthod</span>
             </div>

             <select class="form-control" id="shipping_method">

              <option value="FEDEX" <?php if($purchase_order_dt[0]['method']=="FEDEX"){ echo "selected='selected'"; }?>>FEDEX</option>

              <option value="UPS" <?php if($purchase_order_dt[0]['method']=="UPS"){ echo "selected='selected'"; } ?>>UPS</option>

              <option value="USPS"  <?php if($purchase_order_dt[0]['method']=="USPS"){ echo "selected='selected'"; } ?>>USPS</option>

             </select>






            </div>

            <div class="input-group mb-3">
             <div class="input-group-prepend">
              <span class="input-group-text" style="width: 8.3rem">Delivery Date</span>
             </div>

             <input type="date" id='shipping_d_date' name='shipping_d_date' class="form-control enterKeyclass" value="<?=date('Y-m-d',strtotime($purchase_order_dt[0]['delivery_date']))?>">

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
        <?php 
        include 'footer.php';
        ?>

        <script type="text/javascript">
         $("#category").change(function(){
          if ($(this).val()!='') {
           select_sub_category($(this).val(),0);
          }
         });
         $("#vendor_id").change(function(){
          $.ajax({
           type: "POST",
           dataType:"json",
           url: '../ajaxCalls/get_vendor_data.php',
           data: {'vendor_id':$('#vendor_id option:selected').val()},
           success: function(res){
            $("#vendor_name").html(res.name);
            $("#vendor_company_name").html(res.company_name);
            $("#vendor_mobile").html(res.mobile_no);
            $("#vendor_email").html(res.email);
            $("#vendor_dt").css('display','');
           }

          });
         })

         function select_sub_category(e,val){
          $.ajax({
           type: "POST",
           dataType:"json",
           url: '../ajaxCalls/get_category_data.php',
           data: {'category_id':e,'type':'option'},
           success: function(res){
            $('#sub_category').html(res);
            if (val!=0 && val!='') {
             $("#sub_category").val(val);
            }

           }

          });
         }





        </script>
        <script type="text/javascript">
         $(document).ready(function(){
          items = <?=$items?>;
          data=[];
          shipping_data=[];


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


         })
        </script>

        <script type="text/javascript">
         $("#add_item").click(function(){
           var var_id = $("#varieties_id").val();
     if(var_id==0){

      global_alert_modal('warning','select Variety Name...');
         $("#varieties_id").css('border','1px solid red');
                    $("#varieties_id").focus();

                    return false;


     }else{

        $("#varieties_id").css("border","1px solid lightgray");


     }


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
        "enter_qty":quantity,
        "gstamount":gstamount,
        "total":total,
        "deleted":'no',
        "flag":'new',
        "main_id":''
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
       '<td class="text-left ch-4 hide">',

       '<input onkeyup=fieldupdate({{sno}},this) class="form-control mrp " name="mrp[]" id="mrp{{sno}}" value="{{mrp}}" style="width:5rem; height:1.75rem">',

       '</td>',
       '<td class="text-left ch-4 hide">',

       '<input onkeyup=fieldupdate({{sno}},this) class="form-control sale_price" name="sale_price[]" id="sale_price{{sno}}" value="{{sale_price}}" style="width:5rem; height:1.75rem">',

       '</td>',
       '<td class="text-left ch-4 hide">',

       '<input onkeyup=fieldupdate({{sno}},this) class="form-control discount" name="discount[]" id="discount{{sno}}" value="{{discount}}" style="width:5rem; height:1.75rem">',

       '</td>','<td class="text-left ch-4 hide">',

       '<input onkeyup=fieldupdate({{sno}},this) class="form-control gst" name="gst[]" id="gst{{sno}}" value="{{gst}}" style="width:5rem; height:1.75rem">',

       '</td>',
       '<td class="text-left ch-6 hide" id="totalid{{sno}}">{{total}}</td>',
       '<td class="ch-4">',
       '<button type="button" id="remove_tr{{sno}}" data-id="new" class="btn btn-default btn-sm" onclick="removeItem({{sno}})">',
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

       prototal=Number(mrp*quantity)-(Number(mrp*quantity)*(discount/100));
       gstamount=prototal*(gst/100);
       $("#totalid"+idval).html((prototal+gstamount).toFixed(2));
       var tons=Number($("#quantity"+idval).val())/1000;
       $("#tons"+idval).html(tons);
       items[ref].sale_price=sale_price;
       items[ref].mrp=mrp;
       items[ref].enter_qty=quantity;
       items[ref].discount=discount;
       items[ref].gst=gst;
       items[ref].gstpercentage=gst/100;
       items[ref].gstamount=gstamount;
       items[ref].total=prototal;
       calculation();
      }
      function quantityupdate(idval,ele){

       var ref = "sid"+idval;

       var mrp = $("#mrp"+idval).val();
       var sale_price = $("#sale_price"+idval).val();
       var discount = $("#discount"+idval).val();
       var gst = $("#gst"+idval).val();
       var quantity = $("#quantity"+idval).val();
      // if ((Number($("#order_qty"+idval).text())-Number($("#rec_qty"+idval).text())) < quantity) {
      //   $("#quantity"+idval).val((Number($("#order_qty"+idval).text())-Number($("#rec_qty"+idval).text())));
      // }
      prototal=Number(mrp*quantity)-(Number(mrp*quantity)*(discount/100));
      gstamount=prototal*(gst/100);
      $("#totalid"+idval).html((prototal+gstamount).toFixed(2));
      var tons=Number($("#quantity"+idval).val())/1000;
      $("#tons"+idval).html(tons);
      items[ref].sale_price=sale_price;
      items[ref].mrp=mrp;
      items[ref].enter_qty=$("#quantity"+idval).val();
      items[ref].discount=discount;
      items[ref].gst=gst;
      items[ref].gstpercentage=gst/100;
      items[ref].gstamount=gstamount;
      items[ref].total=prototal;
      calculation();
     }
     function removeItem(idval){
      var id = idval;

       // jQuery('#trItem_' + id).empty('');
       // delete items["sid"+idval] ;



       if ($("#remove_tr"+idval).data('id')=='old') {
        var id = idval;
        jQuery('#trItem_' + id).empty('');
        var ref = "sid"+idval;
        items[ref].deleted='yes';
       // delete items[ref] ;

      }else{
       var id = idval;
       jQuery('#trItem_' + id).empty('');
       delete items["sid"+idval] ;
      }



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

       if (tempItem['deleted']=='no') {


        val=Number(tempItem["enter_qty"]);

        total_qty=total_qty+Number(tempItem["enter_qty"]);
        total= Number(tempItem["mrp"])*Number(tempItem["enter_qty"]);


        discount=Number(discount)+(Number(total)*Number(tempItem["discount"]/100));
        remamount=(Number(total)-(Number(total)*Number(tempItem["discount"]/100)));
        subtotal1=Number(subtotal1)+Number(remamount);
        tax=Number(tax)+(Number(tempItem['gstpercentage'])*Number(remamount));

       }

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
     $("#shipping_dt_add").click(function(){





      if($("#shipping_id").val()=='0'){

       shipping_data["shipping_id"]=$("#shipping_prev_id").val()

      }else{
       shipping_data["shipping_id"]= $("#shipping_id").val();

      }
      shipping_data["ship_terms"]=$("#ship_terms").val();
      shipping_data["shipping_method"]=$("#shipping_method").val();
      shipping_data["shipping_d_date"]=$("#shipping_d_date").val();
      $("#shipping_modal").modal('hide');

     })


     $("#place_order").click(function(){

      if (jQuery.isEmptyObject(items)==true) {
       global_alert_modal('fail','Add One Product To Purchase...');
       $("#item_name").focus();
       return false;
      }

      
      detailsarray = [];
      detailsarray['taxable_amount']=Number($("#subid").text());
      detailsarray['discount']=Number($("#discid").text());
      detailsarray['tax_amount']=Number($("#taxid").text());
      detailsarray['grand_total']=Number($("#grandid").text());
      detailsarray['po_id']="<?=base64_decode($_GET['id'])?>";

      detailsarray['note']=$("#note").val();
      $("#place_order").attr('disabled','disabled');
      var dobj=$.extend({},detailsarray);
      var obj = $.extend({}, items);
      var shipobj = $.extend({},shipping_data);
      $.ajax({
       type: "POST",
       dataType:"json",
       url: '../ajaxCalls/update_purchase_order.php',
       data: $.param(obj)+'&'+$.param(dobj)+'&'+$.param(shipobj),
       success: function(res){
        if (res.status=='success') {
         global_alert_modal('success','Purchase Order Edited SuccessFully...');
         window.location='purchase_order.php?type=NEW';
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
<script type="text/javascript">
  $("#shipping_dt_add").on('click',function(){
 var id = $("#shipping_id").val();
 var po_id = "<?=base64_decode($_GET['id'])?>";
 var shipping_name = $("#shipping_name").val();
 var shipping_company_name = $("#shipping_company_name").val();
 var mobile_no = $("#mobile_no").val();
 var email = $("#email").val();
 var ship_gst = $("#ship_gst").val();
 var address = $("#address").val();
 var city = $("#city").val();
 var state = $("#state").val();
 var country = $('#country').val();
 var pincode = $("#pincode").val();
 var ship_terms = $("#ship_terms").val();
 var shipping_method = $("#shipping_method").val();
 var shipping_d_date = $("#shipping_d_date").val();
$.ajax({

  type:'post',
  dataType:'json',
  url:'../ajaxCalls/update_shipping.php',
  data:{"id":id,"po_id":po_id,"shipping_name":shipping_name,"shipping_company_name":shipping_company_name,"mobile_no":mobile_no,"email":email,"ship_gst":ship_gst,"address":address,"city":city,"state":state,"country":country,"pincode":pincode,"ship_terms":ship_terms,"shipping_method":shipping_method,"shipping_d_date":shipping_d_date},
    success:function(res){

            if(res.status=='success'){
                global_alert_modal('success','Edited SuccessFully...');
                 $("#shipping_modal").modal('hide');
            

            }
 
    }


});

  });

 </script>
 <script type="text/javascript">
  $("#shipping_name").autocomplete({

   source: "../ajaxCalls/autocomplete_shipping_list.php",
   minLength: 1,
   select:function(event,ui){

    $("#shipping_company_name").val(ui.item.company_name);
    $("#shipping_id").val(ui.item.id);
    $("#mobile_no").val(ui.item.mobile_no);
    $("#email").val(ui.item.email);
    $("#ship_gst").val(ui.item.gst_no);
    $("#city").val(ui.item.city);
    $("#address").val(ui.item.address);
    $("#state").val(ui.item.state);
    $("#country").val(ui.item.country);
    $("#pincode").val(ui.item.pincode);
    $("#ship_terms").val(ui.item.shipping_terms);


   }



  }).data('ui-autocomplete')._renderItem = function(ul,item){
   return $("<li class='ui-autocomplete-row'></li>")
   .data("item.autocomplete", item)
   .append(item.value)
   .appendTo(ul);
  };

 </script>
 <script type="text/javascript">
 $("#varieties_id").on('change',function(){

 var var_id = $(this).val();
$.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/get_variety_price.php',
data: {'var_id':var_id},
success: function(res){
   console.log(res);
   if(res){
   $("#mrp").val(res.mrp);

    $("#sale_price").val(res.sale_price);
  }else{
     $("#mrp").val(0);
    $("#sale_price").val(0);
   
  }
  }

});

  }); 




</script>