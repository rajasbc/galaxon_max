<?php 
include 'header.php';
$obj=new PurchaseOrder();
$purchase_order_dt=$obj->get_purchase_order(base64_decode($_GET['id']));
$purchase_order_item_dt=$obj->get_purchase_order_item(base64_decode($_GET['id']));
$vendor_obj= new Vendors();
$vendor= $vendor_obj->get_vendor_dt($purchase_order_dt[0]['vendor_id']); 
$brand_obj = new Brand();
$brand =  $brand_obj->get_brand_data();
$category_obj = new Category();
$category =  $category_obj->get_category_data();
$items=array();
$i=0;
foreach ($purchase_order_item_dt as $key => $value) {
  $i++;
  $items['sid'.$i]=[
      "po_id"=>$value['id'],
      "item_id"=>$value['item_id'],
      "item_name"=>$value['item_name'],
      "brand"=>$value['brand'],
      "category"=>$value['category'],
      "sub_category"=>$value['sub_category'],
      "units"=>$value['units'],
      "mrp"=>$value['mrp'],
      "sale_price"=>$value['sales_price'],
      "discount"=>$value['discount'],
      "gst"=>$value['gst'],
      "gstpercentage"=>$value['gst']/100,
      "order_qty"=>$value['quantity'],
      "rec_qty"=>$value['received_qty'],
      "enter_qty"=>0,
      "gstamount"=>$value['tax_amt'],
      "total"=>$value['total']
    ];
}
$items=json_encode($items);
?>
<style type="text/css">

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
     background: #e9ecef;
     z-index:4;
   }

   .table-scroll tfoot td {
     background: #fff;
   }
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
              <h1 class="m-0">Purchase Order</h1>
            
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
        
        <!-- Main row -->
        <div class="row">
          <div class="col-12">
          <div class="card watermark_img">
            
              <div class="card-body row col-12">
                <div class="row col-12">
                <div class="col-12" id="vendor_dt">
                  <label>Vendor Details</label><br>
                  <div class="row col-12">
                    <div class="col-6">
                      <label>Name :</label><span id="vendor_name"> <?=$vendor['name']?> - <?=$vendor['vendor_code']?></span>
                    </div>
                    <div class="col-6">
                      <label>Company Name :</label><span id="vendor_company_name"> <?=$vendor['company_name']?></span>
                    </div>
                    <div class="col-6">
                      <label>Mobile No :</label><span id="vendor_mobile"> <?=$vendor['mobile_no']?></span>
                    </div>
                    <div class="col-6">
                      <label>Email :</label><span id="vendor_email"> <?=$vendor['email']?></span>
                    </div>
                  </div>
                </div>
                </div>
                
                <br>

                <div class="table-scroll">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Product</th>
                      <th>Tons</th>
                      <th>Order Qty</th>
                      <th>Received Qty</th>
                      <th>Mrp</th>
                      <th>Sale Price</th>
                      <th>Discount</th>
                      <th>Gst</th>
                      <th>Quantity</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody class="text-left css-serial" id="tdata">
 <?php $sno=0; foreach ($purchase_order_item_dt as $key => $row) {
   $sno++;
   echo '<tr id="trItem_'.$sno.'">';
           echo '<td class=" ch-4"><span></span></td>';
            echo '<td class="text-left ch-10">'.$row['item_name'].'</td>';
            echo '<td class="text-left ch-10" id="tons'.$sno.'">0</td>';
             echo '<td class="text-left ch-10" id="order_qty'.$sno.'">'.$row['qty'].'</td>';
             echo '<td class="text-left ch-10" id="rec_qty'.$sno.'">'.$row['received_qty'].'</td>';
            echo '<td class="text-left ch-4">';

                echo '<input onkeyup=fieldupdate('.$sno.',this) class="form-control mrp" name="mrp[]" id="mrp'.$sno.'" value="'.$row['mrp'].'" style="width:5rem; height:1.75rem">';

                echo '</td>';
                echo '<td class="text-left ch-4">';

                echo '<input onkeyup=fieldupdate('.$sno.',this) class="form-control sale_price" name="sale_price[]" id="sale_price'.$sno.'" value="'.$row['sales_price'].'" style="width:5rem; height:1.75rem">';

                echo '</td>';
                echo '<td class="text-left ch-4">';

                echo '<input onkeyup=fieldupdate('.$sno.',this) class="form-control discount" name="discount[]" id="discount'.$sno.'" value="'.$row['discount'].'" style="width:5rem; height:1.75rem">';

                echo '</td>';
                echo '<td class="text-left ch-4">';

                echo '<input onkeyup=fieldupdate('.$sno.',this) class="form-control gst" name="gst[]" id="gst'.$sno.'" value="'.$row['gst'].'" style="width:5rem; height:1.75rem">';

                echo '</td>';
                echo '<td class="text-left ch-4">';

                echo '<input onkeyup=quantityupdate('.$sno.',this) class="form-control quantity" name="quantity[]" id="quantity'.$sno.'" value="0" style="width:5rem; height:1.75rem">';

                echo '</td>';
                echo '<td class="text-left ch-6" id="totalid'.$sno.'"></td>';
              
                echo '</tr>';
 } ?>
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
     $("#totalid"+idval).html((prototal).toFixed(2));
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
      if ((Number($("#order_qty"+idval).text())-Number($("#rec_qty"+idval).text())) < quantity) {
        $("#quantity"+idval).val((Number($("#order_qty"+idval).text())-Number($("#rec_qty"+idval).text())));
      }
     prototal=Number(mrp*quantity)-(Number(mrp*quantity)*(discount/100));
     gstamount=prototal*(gst/100);
     $("#totalid"+idval).html((prototal).toFixed(2));
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
        val=Number(tempItem["enter_qty"]);
        total_qty=total_qty+Number(tempItem["enter_qty"]);
        total= Number(tempItem["mrp"])*Number(tempItem["enter_qty"]);


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
$("#place_order").click(function(){
      var vendor_id = $("#vendor_id option:selected").val();
      var bill_no = $("#bill_no").val();
      var received_date = $("#received_date").val();
      var paid_amt = $("#paid_amt").val();
      var balance = $("#balance").val();
      var payment_mode = $("#payment_mode option:selected").val();

   
      if (jQuery.isEmptyObject(items)==true) {
        global_alert_modal('fail','Add One Product To Purchase...');
        $("#item_name").focus();
        return false;
      }

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

      
      detailsarray = [];
      detailsarray['vendor_id']=vendor_id;
      detailsarray['bill_no']=bill_no;
      detailsarray['received_date']=received_date;
      detailsarray['paid_amt']=paid_amt;
      detailsarray['balance']=balance;
      detailsarray['payment_mode']=payment_mode;
      detailsarray['taxable_amount']=Number($("#subid").text());
      detailsarray['discount']=Number($("#discid").text());
      detailsarray['tax_amount']=Number($("#taxid").text());
      detailsarray['grand_total']=Number($("#grandid").text());
      detailsarray['po_id']="<?=base64_decode($_GET['id'])?>";
$("#place_order").attr('disabled','disabled');
var dobj=$.extend({},detailsarray);
var obj = $.extend({}, items);
$.ajax({
type: "POST",
dataType:"json",
url: '../ajaxCalls/add_new_purchase_order.php',
data: $.param(obj)+'&'+$.param(dobj),
success: function(res){
    if (res.status=='success') {
      global_alert_modal('success','Purchase Added SuccessFully...');
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
</script>