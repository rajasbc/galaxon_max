<?php
include '../tables/config.php';
$obj = new PurchaseOrder();
$result =  $obj->get_purchase_order($_GET['id']);
$item_result =  $obj->get_purchase_order_item($_GET['id']);
$payment_result =  $obj->get_purchase_order_log($_GET['id']);
$vendor_obj=new Vendors();
$output=array();
$main=array();
$vendor_dt=$vendor_obj->get_vendor_dt($result[0]['vendor_id']);
?>
<div class="container-fluid">
	<div class="form-row">
		<div class="form-group col-lg-12">
			<input type="hidden" name="po_id" id="po_id" value="<?=$result[0]['id']?>">
		<h4>Purchase Order Details<button type='button' class='close text-danger font-weight-bold' data-dismiss='modal'>&times;</button></h4></div></div>
		<div class="form-row">
		<div class="form-group col-lg-3">Purchase No</div><div class="form-group col-lg-3">: 
			<span class="font-weight-bold"><?=$result[0]['purchase_no']?></span>
		</div>
		<!-- <div class="form-group col-lg-1">&nbsp;</div> -->
		<div class="form-group col-lg-3">Bill No</div><div class="form-group col-lg-3">: 
			<span class="font-weight-bold"><?=$result[0]['bill_no']?></span>
		</div>
		<div class="form-group col-lg-3">Received Date</div><div class="form-group col-lg-3">: <span class="font-weight-bold"><?=date('d-m-Y',strtotime($result[0]['received_date']))?></span></div>
		<div class="form-group col-lg-3">Created Date</div><div class="form-group col-lg-3">: <span class="font-weight-bold"><?=date('d-m-Y',strtotime($result[0]['created_at']))?></span></div>
	</div>
	<hr>
	<!-- End Of Purchase Details -->
	<div class="form-row">
   <div class="form-group col-lg-12">
		<h4>Vendor Details</h4></div></div>
		<div class="form-row">
		<div class="form-group col-lg-3">Name</div><div class="form-group col-lg-3">: 
			<span class="font-weight-bold"><?=strtoupper($vendor_dt['name'].' - '.$vendor_dt['vendor_code'])?></span>
		</div>
		<!-- <div class="form-group col-lg-1">&nbsp;</div> -->
		<div class="form-group col-lg-3">Mobile No</div><div class="form-group col-lg-3">: 
			<span class="font-weight-bold"><?=$vendor_dt['mobile_no']?></span>
		</div>
		<div class="form-group col-lg-3">Company Name</div><div class="form-group col-lg-3">: <span class="font-weight-bold"><?=strtoupper($vendor_dt['company_name'])?></span></div>
		<?php if ($vendor_dt['email']!='') { ?>
		<div class="form-group col-lg-3">Email</div><div class="form-group col-lg-3">: <span class="font-weight-bold"><?=$vendor_dt['email']?></span></div>
	<?php }?>
	</div>
	<hr>
		<!-- End Of Vendor Details -->
		<div class="form-row">
   <div class="form-group col-lg-12">
		<h4>Purchase Product Details</h4></div></div>
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
                  <td class="text-rigth">Quantity</td>
                  <td class="text-rigth">Rate</td>
                  <td class="text-rigth">Discount</td>
                  <td class="text-rigth">Amount</td>
                </tr>
              </thead>
              <tbody class="text-center" id="tdata">
              	<?php foreach($item_result as $item){
?>
              	<tr class=" border-dark line_1">
                    <td class="border-center-0" ><?php echo $sno; ?></td>
                    
                    <td class="text-left" style="width:150px"><?php echo strtoupper($item['item_name']); ?></td>
                     <td class="text-left" style="width:150px"><?php echo strtoupper($item['var_name']); ?></td>
                   
                 <td style="width:100px" class="text-center"><?php echo $item['qty']; ?></td>
 
                    <td style="text-align: center;"><?php echo ($item['mrp']); ?></td>
                    <td style="text-align: center;"><?php echo ($item['discount']); ?></td>
                  
                    <td style="text-align: center" ><?php echo ($item['total'] ); ?>
                    
                    </td>
                  </tr>
                  <?php $sno++;
              }
                  ?>
              </tbody></table> 
              <table class="table">
				<thead>
					<tr>
						<th colspan="2">Taxable</th>
						<th>Tax</th>
						<th>Discount</th>
						<th colspan="2" class="text-center">Total Amount</th>
					</tr>
				</thead>
				<tbody>
				<tr>
						<th colspan="2"><?=$result[0]['taxable_amt']?></th>
						<th><?=$result[0]['tax_amt']?></th>
						<th><?=$result[0]['discount_amt']?></th>
						<th colspan="2" class="text-center"><?=$result[0]['grand_total']?></th>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<hr>
		<!-- End Of Product Details -->
		<div class="form-row">
   <div class="form-group col-lg-12">
		<h4>Purchase Log Details</h4></div></div>
		<div class="form-row">
		<div class="form-group col-lg-12">
		<table class="table">
				<thead>
					<tr>
						<th>S.No</th><th>Date & Time</th><th>Description</th><th>Mode of Payment</th><th>Amount</th><th>Balance</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i=1;
					$balance=0;
					$paid=0;
					
					echo"<tr><td>".$i."</td><td>".date('d-M-Y h:i:s',strtotime($result[0]['created_at']))."</td><td>Total Purchase Amount</td><td class='text-right'></td><td class='text-right'></td><td class='text-right'>".$result[0]['grand_total']."</td></tr>";
					// print_r($payment_details);
					$balance=$balance+$result[0]['grand_total'];
					foreach($payment_result as $payment){
						$i++;
						$balance=$balance-($payment['credit']+$payment['debit']);
						
							$afterrefundamount=$payment['credit'];
						$paid=$paid+$afterrefundamount;
						echo"<tr><td>".$i."</td><td>".date('d-M-Y h:i:s', strtotime($payment['created_at']))."</td><td>".$payment['description']."</td><td >".$payment['payment_mode']."</td><td class='text-right'>".$afterrefundamount."</td><td class='text-right'>".number_format($balance,2,'.','')."</td></tr>";
					}

					?>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="4">Total Paid (&#8377;)</th><th colspan="2" class='text-right'><?= number_format($paid,2,'.','') ?></th><th></th></tr>
					</tr>
					<tr>
						<th colspan="4">Balance Amount (&#8377;)</th><th colspan="2" class='text-right'><input type="hidden" name="balance" id="balance" value=<?=$balance?>><?= number_format($balance,2,'.','') ?></th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
	<hr>
		<!-- End Of Purchase Log Details -->
			<div class="form-row">
   <div class="form-group col-lg-12">
              <table class="table">
				<tbody>
				<tr>
				<th><div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Amt Received</span>
                        </div>
                        <input name="balance_received" id="balance_received" class="form-control" value='' placeholder="0" >
                      </div></th>
						<th> <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Bal</span>
                        </div>
                        <input type="number" name="balance_amt" id="balance_amt" class="form-control" value='' placeholder="0" readonly>
                      </div></th>
						<!-- <th> <div class="input-group input-group-sm" >
                        <div class="input-group-prepend">
                          <span class="input-group-text">Change</span>
                        </div>
                        <input class="form-control" type="number" id="change" readonly style="padding-left: 5px;">
                      </div></th> -->
                      <th>
                      	<div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Payment Mode</span>
                        </div>
                        <select name="payment_mode" id="payment_mode"  class="form-control enterkey">
                          <option value="Cash">Cash</option>
                          <option value="Card">Card</option>
                          
                          <option value="Net Banking">Net Banking</option>
                          <option value="Google Pay">Google Pay</option>
                          <option value="PhonePe">PhonePe</option>
                          <option value="Paytm">Paytm</option>
                          <option value="Amazon Pay">Amazon Pay</option>
                           <option value="Due">Credit</option>
                          <option value="Cheque">Cheque</option>
                        </select>
                        </div>
                      </th>
					</tr>
					<tr>
						
                      <th colspan="3" class="text-right">
                      	<button class="btn btn-primary btnupdate" onclick="postValue()" id='add_balance'>Pay</button>
                      </th>
					</tr>
				</tbody>
			</table>
		</div></div>
		<div class="row">
		<div class=" col-12">
		<div class="col-3">
                      
                    </div>
                    <div class=" col-2">
                     
                    </div>
                     <div class=" col-2">
                     
                    </div>

                    <div class=" col-3">
                      
                    </div> 
                    <div class="col-2"></div>
		</div>
	</div>
	<hr>
		<!-- End Of Paid Details -->
	
</div>


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
		// 	if(Number(balance_received)>Number(balance)){
		// 		$(this).css("border","1px solid red");
		// 		$("#add_balance").attr("disabled", "disabled");

		// 	}
		// 	else{
		// 		$(this).css("border","1px solid lightgray");
		// 		$("#add_balance").removeAttr("disabled", "disabled");
		// 	}
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