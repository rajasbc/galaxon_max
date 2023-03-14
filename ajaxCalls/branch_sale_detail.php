<?php
include '../tables/config.php';
$obj = new CustomerSale();
$obj1 = new Customers();
$result = $obj->branch_sale_details($_GET['sale_id'],$_GET['branch_id']);
$result1 = $obj1->branch_customer_data($result[0]['customer_id']);
$sale_details=$obj->get_variety_details($result[0]['sale_id'],$result[0]['branch_id']);


?>
<div class="container-fluid">
  <div class="form-row">
    <div class="form-group col-lg-12">
      <input type="hidden" name="po_id" id="po_id" value="<?=$result[0]['id']?>">
    <h4>Sale Details<button type='button' class='close text-danger font-weight-bold' data-dismiss='modal'>&times;</button></h4></div></div>
    <div class="form-row">
    <!-- <div class="form-group col-lg-3">Purchase No</div><div class="form-group col-lg-3">: 
      <span class="font-weight-bold"><?=$result[0]['purchase_no']?></span>
    </div> -->
    <!-- <div class="form-group col-lg-1">&nbsp;</div> -->
    <div class="form-group col-lg-3">Sale Date</div><div class="form-group col-lg-3">: <span class="font-weight-bold"><?=date('d-m-Y',strtotime($result[0]['created_at']))?></span></div>
  </div>
  <hr>
  <!-- End Of Purchase Details -->
  <div class="form-row">
    
   <div class="form-group col-lg-12">
  
    <h4>Customer Details</h4></div></div>
    <div class="form-row">
    <div class="form-group col-lg-3">Name</div><div class="form-group col-lg-3">: 
      <span class="font-weight-bold"><?=strtoupper($result1['name'].' - '.$result1['customer_code'])?></span>
    </div>
    <!-- <div class="form-group col-lg-1">&nbsp;</div> -->
    <div class="form-group col-lg-3">Mobile No</div><div class="form-group col-lg-3">: 
      <span class="font-weight-bold"><?=$result1['mobile_no']?></span>
    </div>
    <div class="form-group col-lg-3">Company Name</div><div class="form-group col-lg-3">: <span class="font-weight-bold"><?=strtoupper($result1['company_name'])?></span></div>
    <?php if ($result1['email']!='') { ?>
    <div class="form-group col-lg-3">Email</div><div class="form-group col-lg-3">: <span class="font-weight-bold"><?=$result1['email']?></span></div>
  <?php }?>
  </div>





  <hr>
    <!-- End Of Vendor Details -->

    <div class="form-row">
   <div class="form-group col-lg-12">
    <h4>Sale Product Details</h4></div></div>
    <div class="form-row">
    <div class="form-group col-lg-12">
      <?php $sno =1;
      ?>
       
           <table class="table text-center bill-table border-top border-bottom" id="bill-table" >
              <thead class="tablehead">
                <tr class="font-weight-bold" style="font-size:<?=$fontsize?>px">
                  <td>S.No</td>
                  <td class="text-left">Products</td>
                  <td class="text-left">Variety</td>
                  <td class="text-left">Mrp</td>
                  <td class="text-left">Sale Price</td>
                  <td class="text-left">Discount(%)</td>
                   <td class="text-left">Discount Amt</td>
                  <td class="text-left">Gst(%)</td>
                   <td class="text-left">Gst Amt</td>
                  <td class="text-left">Qty</td>
                   <td class="text-left">Total</td>

                 <!--  <td class="text-rigth">Received Quantity</td> -->
                </tr>
              </thead>
              <tbody class="text-center" id="tdata">
                <?php 

                  $total = 0 ;
                foreach($sale_details as $item){
                 $discount_amt = ($item['sales_price'])*($item['discount']/100);


?>
                <tr class=" border-dark line_1">
                    <td class="border-center-0" ><?php echo $sno; ?></td>
                    
                    <td class="text-left" style="width:150px"><?php echo strtoupper($item['item_name']); if ($item['item_code']!='') {
                      echo strtoupper(' - '.$item['item_code']);
                    } ?></td>
                   <td class="text-left"><?php echo $item['var_name'] ?></td> 
                    <td class="text-left"><?php echo $item['mrp'] ?></td> 
                     <td class="text-left"><?php echo $item['sales_price'] ?></td> 
                      <td class="text-left"><?php echo $item['discount'] ?></td> 
                      <td class="text-left"><?php echo  $discount_amt ?></td> 

                      <td class="text-left"><?php echo $item['gst'] ?></td>
                       <td class="text-left"><?php echo $item['tax_amt'] ?></td>  
                        
                 <td class="text-left"><?php echo $item['qty']; ?></td>
                  <td class="text-left"><?php echo $item['total'] ?></td> </tr>
                      

                  <?php 
                     $total+=$item['total'];
                  $sno++;
              }
                  ?>
              </tbody>
              <tfoot>
                 <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>Total</td><td><?php echo number_format($total,'2','.','') ?></td></tr>

              </tfoot>
          </table> 
         

<script type="text/javascript">

  $(document).ready(function(){
     $('#chequeid').hide();
    $("#payment_mode").on('change', function(){
var payment_mode=$("#payment_mode").val();
// console.log(payment_mode);
     if(payment_mode=='Cheque'){
                $('#chequeid').show();
            }
            else{
            $('#chequeid').hide();
            }
        });
        
                        $("#payment_mode").on('change',function(){
                            if($("#payment_mode").val()==''){
                              $("#payment_mode").css("border","1px solid red");   
                            }
                            else{
                                 $("#payment_mode").css("border","1px solid navy");
                                 // alert('sddd');  
                    
                            }
                        });
    var balance=$("#balance").val();

    $("#balance_received").keyup(function(){
      var balance_received=$(this).val();

    if(Number(balance_received)>Number(balance))
    { 
      // var change=balance_received-balance;
      // // console.log(change);
      // $('#change').val(change);
      $(this).val(balance);
      $('#balance_amt').val('0');
      return false;
      
    }
    if(Number(balance_received)<Number(balance))
    {
      console.log();
      var balance_amt=balance-balance_received;
      // $('#change').val('0');
      $('#balance_amt').val(balance_amt);
    }
    if(Number(balance_received)==Number(balance))
    {
      // $('#change').val('0');
      $('#balance_amt').val('0');
    }
    //  if(Number(balance_received)>Number(balance)){
    //    $(this).css("border","1px solid red");
    //    $("#add_balance").attr("disabled", "disabled");

    //  }
    //  else{
    //    $(this).css("border","1px solid lightgray");
    //    $("#add_balance").removeAttr("disabled", "disabled");
    //  }
    // })
  });
  $("#balance_received").bind("keypress", function(event) {
    //this.value=this.value.replace(/[^0-9]/g)    
    if (event.charCode!=0) {
        var regex = new RegExp("^[0-9.]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    }    

}); 
  $('#balance_received').keypress(function(event){

    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
       if($("#balance_received").val()!="")
       {
         $("#add_balance").click();
       }
       else{
         $.growl.error({
            title:"Amt Received was Not allow empty or zero",
            message:"Please Enter the Amt Received "
        })
         return false
       }

    }

});
});  

    $('.enterkey').keypress(function(event){

    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
       if($("#payment_mode").val()!="")
       {
         $('#add_balance').click();
       }
       else{
        if($("#payment_mode").val()==''){
                        return false
                    }
       }
       
     
    }

});
</script>