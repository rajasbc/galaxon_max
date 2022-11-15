<?php 
include 'header.php';
// error_reporting(E_ALL);
// error_reporting(E_ALL);
$obj = new Shops();
$result = $obj->get_user();

$result1 = $obj->get_shop_details();
  



?>
<div class="content-wrapper">
  <main>
    <div class="container-fluid">
      <div class="form-row main_page">
        <div class="form-group col-lg-8">
      <ul class="nav nav-tabs pt-4">
        
 
                <div id="branch" class="modal fade" role="dialog">
  
      </ul>

      <div class="tab-content">
      <div class="tab-pane fade show active">
      <div class="row">
      <div class="col-lg-12">
          <form action=""  id='shop_profile' onsubmit="javascript : return false">
          <div class="container mt-4">
            <!-- <a href='template.php' >Add Invoice Template</a><br><br> -->
            <input type="hidden" name='id' value='<?=$result[0]['id']?>'>
            <div class="form-row">
              <div class="form-group col-lg-4"><span>Shop Name</span></div><div class="form-group col-lg-8"><input type="text" name='shop_name' id='shop_name' value="<?=$result1[0]['name']?>"class="form-control mt-2" ></div>
            </div>
            
            <div class="form-row">
              <div class="form-group col-lg-4"><span>Shop Registration  Number</span></div><div class="form-group col-lg-8"><input type="text" value='<?=$result1[0]['shop_registration_number']?>' name='registration_no' id='registration_no' class="form-control mt-2" onKeyPress="if(this.value.length==16)return false;"></div>
            </div>
            <div class="form-row">
              <div class="form-group col-lg-4"><span>DL No</span></div><div class="form-group col-lg-8"><input type="text" value='<?=$result1[0]['dl_no']?>' name='dl_no' id='dl_no' class="form-control mt-2" onKeyPress="if(this.value.length==15)return false;"></div>
            </div>
            <div class="form-row">
              <div class="form-group col-lg-4"><span>Shop GST Number</span></div><div class="form-group col-lg-8"><input type="text" name='shop_gst_no' id='shop_gst_no' value='<?=$result1[0]['shop_gst_no']?>' class="form-control mt-2" onKeyPress="if(this.value.length==15)return false;"></div>
            </div>
            <div class="form-row">
              <div class="form-group col-lg-4"><span>Email Address</span></div><div class="form-group col-lg-8"><input type="email" name='shop_email' id='shop_email' value="<?=$result1[0]['email']?>" class="form-control mt-2" onKeyPress="if(this.value.length==100)return false;"></div>
            </div>

            <!-- <div class="form-row">
              <div class="form-group col-lg-4"><span>Income Account</span></div><div class="form-group col-lg-8"><input type="text" name='income_ac' id='income_ac' class="form-control mt-2" ></div>
            </div>
            <div class="form-row">
              <div class="form-group col-lg-4"><span>Expense Account</span></div><div class="form-group col-lg-8"><input type="text" name='expense_ac' id='expense_ac' class="form-control mt-2" ></div>
            </div>
            <div class="form-row">
              <div class="form-group col-lg-4"><span>Bank Name</span></div><div class="form-group col-lg-8"><input type="text" name='bankname' id='bankname' class="form-control mt-2" ></div>
            </div>
            <div class="form-row">
              <div class="form-group col-lg-4"><span>Account No</span></div><div class="form-group col-lg-8"><input type="text" name='account' id='account' class="form-control mt-2" ></div>
            </div>
            <div class="form-row">
              <div class="form-group col-lg-4"><span>IFSC Code</span></div><div class="form-group col-lg-8"><input type="text" name='ifsc' id='ifsc' class="form-control mt-2" ></div>
            </div>
            <div class="form-row">
              <div class="form-group col-lg-4"><span>Bank Branch</span></div><div class="form-group col-lg-8"><input type="text" name='branch' id='branch' class="form-control mt-2" ></div>
            </div>

 -->
            <div class="form-row">
              <div class="form-group col-lg-4"><span>Address Line 1</span></div><div class="form-group col-lg-8"><input type="text" name='address1' id='address1' value='<?=$result1[0]['address1']?>' class="form-control mt-2"></div>
            </div>
            <div class="form-row">
              <div class="form-group col-lg-4"><span>Address Line 2</span></div><div class="form-group col-lg-8"><input type="text" name='address2' id='address2' value='<?=$result1[0]['address2']?>'class="form-control mt-2"></div>
            </div>
            <div class="form-row">
              <div class="form-group col-lg-4"><span>Area</span></div><div class="form-group col-lg-8"><input type="text" value='<?=$result1[0]['area']?>' name='area' id='area' class="form-control mt-2" ></div>
            </div>
            <div class="form-row">
              <div class="form-group col-lg-4"><span>City</span></div><div class="form-group col-lg-8"><input type="text" name='city' id='city' value='<?=$result1[0]['city']?>' class="form-control mt-2"></div>
            </div>
            <div class="form-row">
              <div class="form-group col-lg-4"><span>State</span></div><div class="form-group col-lg-8"><input type="text" name='state' id='state' value='<?=$result1[0]['state']?>' class="form-control mt-2" ></div>
            </div>
            <div class="form-row">
              <div class="form-group col-lg-4"><span>State Code</span></div><div class="form-group col-lg-8"><input type="number" name='state_code' id='state_code' value='<?=$result1[0]['state_code']?>' class="form-control  number_only mt-2" ></div>
            </div>
            <div class="form-row">
              <div class="form-group col-lg-4"><span>Country</span></div><div class="form-group col-lg-8"><input type="text" name='country' id='country' class="form-control mt-2" value="INDIA" readonly></div>
            </div>
            <div class="form-row">
              <div class="form-group col-lg-4"><span>Pincode</span></div><div class="form-group col-lg-8"><input type="text" name='pincode' id='pincode' value='<?=$result1[0]['pincode']?>' class="form-control mt-2" maxlength="6" ></div>
            </div><div class="form-row">
              <div class="form-group col-lg-4 mt-2">
                <span>Mobile Number</span>
              </div>
              <div class="form-group col-lg-8">
              <div class="form-row">
                <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">+91</span>
                </div><input type="text" name='mobile_no' id='mobile_no' value="<?=$result1[0]['mobile_no']?>" class="form-control" maxlength="10" >
                </div>
              </div>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-lg-4 mt-2">
                <span>Alternative Mobile Number</span>
              </div>
              <div class="form-group col-lg-8">
              <div class="form-row">
                <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">+91</span>
                </div><input type="text" name='alt_mobile_no' id='alt_mobile_no' value='<?=$result1[0]['alt_mobile_no']?>' class="form-control" maxlength="10" >
                </div>
              </div>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-lg-4 mt-2"><span>Landline Number</span></div><div class="form-group col-lg-8"><input type="text" name='Landline_no' id='Landline_no' value='<?=$result1[0]['landline_no']?>' class="form-control " ></div>
            </div>
            
            <div class='form-row'>
              <div class="form-group col-lg-4 mt-5">Signature</div>
              <div class='form-group col-lg-4 mt-5'>
              <input type="file" name='shop_logo' id='shop_logo' value='' accept="image/*" onchange="readURL(this);">
              </div>
              <?php if ($result1[0]['shop_logo']!='') { ?>
            <div class='form-group col-lg-4' id="shop_logo_preview1">
              <img id="shop_logo_preview" src="../uploads/<?=$result1[0]['shop_logo']?>" alt="Shop_logo" style="max-width: 201px;max-height: 175px;
">
              </div>
            <?php }?>
            </div>
            <!-- <div class='form-row'>
              <div class="form-group col-lg-4">Shop Description</div><div class='form-group col-lg-8 mt-2'>
                <textarea name='shop_des' id='shop_des'></textarea>
              </div>
            </div> -->

            <div class="form-row">
            <div class="form-group col-lg-12 text-center"><button type="submit" class="btn-primary btn-sm btn btn update" id='submit'>Update</button></div>
          </div>
          </div>
        </form>
        </div>
      </div>
    </div>
</div>
</div>
</div>
</div>
</main>
</div>
<?php
include 'footer.php';
?>


<script type="text/javascript">
  $('#shop_name').keypress(function(event){


    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
       if($("#shop_name").val()!="")
       {
           
         $('#registration_no').focus();
         return false
       }
       else{
         global_alert_modal('warning','Please Enter Shop Name...');
           
       }
       
     
    }

});
    $('#registration_no').keypress(function(event){

    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
       if($("#registration_no").val()!="")
       {
         $('#dl_no').focus();
         return false
       }
       else{
         global_alert_modal('warning','Please Enter Registration Number...');
           
       }
       
     
    }

});

    $('#dl_no').keypress(function(event){

    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
       if($("#dl_no").val()!="")
       {
         $('#shop_gst_no').focus();
         return false
       }
       else{
        global_alert_modal('warning','Please Enter DL No...');
           
       }
       
     
    }

});
    $('#shop_gst_no').keypress(function(event){

    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
       if($("#shop_gst_no").val()!="")
       {
         $('#address1').focus();
         return false
       }
       else{
         global_alert_modal('warning','Please Enter Shop GST Number...');
           
       }
       
     
    }

});
     $('#address1').keypress(function(event){

    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
       if($("#address1").val()!="")
       {
         $('#address2').focus();
         return false
       }
       else{
         global_alert_modal('warning','Please Enter address1...');
            
       }
       
     
    }

});

     $('#address2').keypress(function(event){


    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
       if($("#address2").val()!="")
       {
         $('#area').focus();
         return false
       }
       else{
        global_alert_modal('warning','Please Enter Address2...');
            
       }
       
     
    }

});
      $('#area').keypress(function(event){

    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
       if($("#area").val()!="")
       {
         $('#city').focus();
         return false
       }
       else{
        global_alert_modal('warning','Please Enter Area...');
           
       }
       
     
    }

});
      $('#city').keypress(function(event){

    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
       if($("#city").val()!="")
       {
         $('#state').focus();
         return false
       }
       else{
         global_alert_modal('warning','Please Enter City...');
           
       }
       
     
    }

});
         $('#state').keypress(function(event){

    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
       if($("#state").val()!="")
       {
         $('#state_code').focus();
         return false
       }
       else{
        global_alert_modal('warning','Please Enter State...');
           
       }
       
     
    }

});
          $('#state_code').keypress(function(event){

    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
       if($("#state_code").val()!="")
       {
         $('#country').focus();
         return false
       }
       else{
        global_alert_modal('warning','Please Enter State Code...');
           
       }
       
     
    }

});
            $('#country').keypress(function(event){

    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
       if($("#country").val()!="")
       {
         $('#pincode').focus();
         return false
       }
       else{
         global_alert_modal('warning','Please Enter Country...');
            
       }
       
     
    }

});
             $('#pincode').keypress(function(event){

    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
       if($("#pincode").val()!="")
       {
         $('#mobile_no').focus();
         return false
       }
       else{
         global_alert_modal('warning','Please Enter Pincode...');
          
       }
       
     
    }

});
$('#mobile_no').keypress(function(event){

    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
       if($("#mobile_no").val()!="")
       {
         $('#alt_mobile_no').focus();
         return false
       }
       else{
        global_alert_modal('warning','Please Enter Mobile Number...');
            
       }
       
     
    }

});

$('#alt_mobile_no').keypress(function(event){

    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
       if($("#alt_mobile_no").val()!="")
       {
         $('#Landline_no').focus();
         return false
       }
       else{
         global_alert_modal('warning','Please Enter Alternative Mobile Number...');
            
       }
       
     
    }

});
$('#Landline_no').keypress(function(event){
    
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
       if($("#Landline_no").val()!="")
       {
         $('#shop_type').focus();
         return false
       }
       else{
         global_alert_modal('warning','Please Enter Landline number...');
       
       }
       
     
    }

});

</script>

<!-- <script type="text/javascript">

   

  $(".tabs").click(function(){

    var id=(this.id);
    
    //alert(id);

    $.ajax({
        type:"POST",
        url:"ajaxCalls/showShopProfile.php",
        dataType:'json',
        data:{"id":id},
        success: function(res){
          // console.log(res);
          $("#id").val(res.id);
          $("#shop_name").val(res.name);
          $("#shop_short_name").val(res.shortname);
          $("#registration_no").val(res.register_id);
          $("#shop_gst_no").val(res.shop_gst_no);
          $("#shop_email").val(res.shop_email);
          $("#dl_no").val(res.dl_no);
          $("#address1").val(res.address1);
          $("#address2").val(res.address2);
          $("#area").val(res.area);
          $("#city").val(res.city);
          $("#state").val(res.state);
          $("#state_code").val(res.state_code);
          $('#income_ac').val(res.income_ac);
          $('#expense_ac').val(res.expense_ac);
          $("#bankname").val(res.bankname);
          $("#branch").val(res.branch_name);
          $("#account").val(res.account);
          $("#ifsc").val(res.ifsc);

          $("#country").val(res.country);
          $("#pincode").val(res.pincode);
          $("#mobile_no").val(res.mobile_no);
          $("#Landline_no").val(res.landline_no);
          $("#shop_type").val(res.shop_type);
          // $('#shop_des').val(res.shop_des);
          $("#alt_mobile_no").val(res.alt_mobile_no);
          $("#header").val(res.header);

          $("input[name=barcode][value=" + res.barcode + "]").attr('checked', 'checked');
          $(".summernote").summernote("code",res.header);
          $(".summernote1").summernote("code",res.footer);

          $("#footer").val(res.footer);
          // if(res.shop_logo!=null){
          // $("#shop_logo_preview").attr("src", '../uploads/'+res.shop_logo);
           $("#shop_logo_preview1").html(res.shop_logo ? "<img height='150' width='150' src=../uploads/" + res.shop_logo + ">" : "");
          // }

        }
       });
    });

</script> -->
<!-- <script type="text/javascript">
    $(document).ready(function() {
      $('.summernote1').summernote({
        height: 300,
        tabsize: 2
      });
    });
  </script> -->
<script type="text/javascript">

    // Submit form data via Ajax

    $("#shop_profile").on('submit', function(e){

              if($('#shop_name').val()==''){
                $('#shopname').css('border','1px solid red');
                $('#shop_name').focus(); 
                return false;

              }
              
              if($('#registration_no').val()==''){
                $('#registration_no').css('border','1px solid red');
                $('#registration_no').focus(); 
                return false;

              }
               if($('#registration_no').val()==''){
                $('#registration_no').css('border','1px solid red');
                $('#registration_no').focus(); 
                return false;

              }
              if($('#registration_no').val()==''){
                $('#registration_no').css('border','1px solid red');
                $('#registration_no').focus(); 
                return false;

              }
              if($('#dl_no').val()==''){
                $('#dl_no').css('border','1px solid red');
                $('#dl_no').focus(); 
                return false;

              }
               if($('#shop_gst_no').val()==''){
                $('#shop_gst_no').css('border','1px solid red');
                $('#shop_gst_no').focus(); 
                return false;

              }
              if($('#shop_email').val()==''){
                $('#shop_email').css('border','1px solid red');
                $('#shop_email').focus(); 
                return false;

              }
               if($('#address1').val()==''){
                $('#address1').css('border','1px solid red');
                $('#address1').focus(); 
                return false;

              }
              if($('#address2').val()==''){
                $('#address2').css('border','1px solid red');
                $('#address2').focus(); 
                return false;

              }
              if($('#area').val()==''){
                $('#area').css('border','1px solid red');
                $('#area').focus(); 
                return false;

              }
              if($('#city').val()==''){
                $('#city').css('border','1px solid red');
                $('#city').focus(); 
                return false;

              }
              if($('#state').val()==''){
                $('#state').css('border','1px solid red');
                $('#state').focus(); 
                return false;

              }
               if($('#state_code').val()==''){
                $('#state_code').css('border','1px solid red');
                $('#state_code').focus(); 
                return false;

              }
              if($('#pincode').val()==''){
                $('#pincode').css('border','1px solid red');
                $('#pincode').focus(); 
                return false;

              }
               if($('#mobile_no').val()==''){
                $('#mobile_no').css('border','1px solid red');
                $('#mobile_no').focus(); 
                return false;

              }
              if($('#alt_mobile_no').val()==''){
                $('#alt_mobile_no').css('border','1px solid red');
                $('#alt_mobile_no').focus(); 
                return false;

              }
               if($('#Landline_no').val()==''){
                $('#Landline_no').css('border','1px solid red');
                $('#Landline_no').focus(); 
                return false;

              }



        e.preventDefault();
        // if($('#shop_profile').valid())
        // {
        
        $.ajax({
            type: 'POST',
            url: "../ajaxCalls/updateShopProfile.php",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
        success: function(res){
          console.log(res);
          if(res.status=="Success")
          {
             global_alert_modal('success','Update Successfully...');
            location.reload();
       
           

          
          $('#submit').attr('disabled',false);
              $('#submit').html('update');
               $("#shop_logo_preview1").html(res.shop_logo ? "<img height='250' width='250' src=../uploads/" + res.shop_logo + ">" : "");

              
          }

            }
        });
    // }
    });

    $('.tabs').first().click();
</script>

<!-- <script>
  function phonenumber(inputtxt)
{
  var phoneno = /^\+?([6-9]{1})\)?([0-9]{4})?([0-9]{5})$/;
  if((inputtxt.match(phoneno)))
        {
      return true;
        }
      else
        {
        return false;
        }
}
$("#mobile_no").blur(function(){
      if(phonenumber($(this).val())==false){
       $("#mobile_no").addClass("errorCall");
                  $("#mobile_no").css("border","1px solid red");
                    $("#mobile_no").val('');
                    $("#mobile_no").attr('placeholder','Please Enter Valid Phone Number');
                }else{
                  $("#mobile_no").removeClass("errorCall");
                    $("#mobile_no").css("border","1px solid #ccc");
                }
    });
       function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#shop_logo_preview')
                        .attr('src', e.target.result)
                        .width(200)
                        .height(175);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#saveBranch").click(function(){
  if($("#addressLine1").val()=="")
  {
    $("#addressLine1").css("border","1px solid red");
        $("#addressLine1").focus();
        return false
  }
  else{
    $("#addressLine1").css("border","1px solid lightgray");
    }
  if($("#addressLine2").val()=="")
  {
    $("#addressLine2").css("border","1px solid red");
        $("#addressLine2").focus();
        return false
  }
  else
  {
    $("#addressLine2").css("border","1px solid lightgray");
  }
  if($("#brancharea").val()=="")
  {
    $("#brancharea").css("border","1px solid red");
        $("#brancharea").focus();
        return false
  }
  else
  {
    $("#brancharea").css("border","1px solid lightgray");
  }
    if($("#branchcity").val()=="")
  {
    $("#branchcity").css("border","1px solid red");
        $("#branchcity").focus();
        return false
  }
  else
  {
    $("#branchcity").css("border","1px solid lightgray");
  }
  if($("#branchstate").val()=="")
  {
    $("#branchstate").css("border","1px solid red");
        $("#branchstate").focus();
        return false
  }
  else
  {
    $("#branchstate").css("border","1px solid lightgray");
  }
  if($("#branchcountry").val()=="")
  {
    $("#branchcountry").css("border","1px solid red");
        $("#branchcountry").focus();
        return false
  }
  else
  {
    $("#branchcountry").css("border","1px solid lightgray");
  }
  if($("#branchstate").val()=="")
  {
    $("#branchstate").css("border","1px solid red");
        $("#branchstate").focus();
        return false
  }
  else
  {
    $("#branchstate").css("border","1px solid lightgray");
  }
  if($("#branchpincode").val()=="")
  {
    $("#branchpincode").css("border","1px solid red");
        $("#branchpincode").focus();
        return false
  }
  else
  {
    $("#branchpincode").css("border","1px solid lightgray");
  }
  
  if($("#branchCode").val()=="")
  {
    $("#branchCode").css("border","1px solid red");
        $("#branchCode").focus();
        return false
  }
  else
  {
    $("#branchCode").css("border","1px solid lightgray");
  }
  var shopname=$("#shopname").val();
  var address1=$("#addressLine1").val();
  var address2=$("#addressLine2").val();
  var labname=$("#labname").val();
  var registerno=$("#registerno").val();
  var branchcity=$("#branchcity").val();
  var brancharea=$("#brancharea").val();
  var branchstate=$("#branchstate").val();
  var branchcountry=$("#branchcountry").val();
  var branchpincode=$("#branchpincode").val();
  var branchmobile=$("#branchmobile").val();
  var branchemail=$("#branchemail").val();
  var branchlaneline=$("#branchlaneline").val();
  var branchcode=$("#branchCode").val();
  $.ajax({
        type:"POST",
        url:'ajaxCalls/addShopBranch.php',
        dataType:"json",
        data:{"shopname":shopname,"address1":address1,"address2":address2,"labname":labname,"registerno":registerno,"branchcity":branchcity,"brancharea":brancharea,"branchstate":branchstate,"branchcountry":branchcountry,"branchpincode":branchpincode,"branchmobile":branchmobile,"branchemail":branchemail,"branchlaneline":branchlaneline,"branchcode":branchcode},
        success: function(res){
          if(res.status=='Success'){
            //$("#printReferralName").html(res.msg);
             $.growl.notice({title:"SUCCESS",message:"Branch Data Added Successfully"});
             $("#branch_show").css('display','none');
          }
        }
      });

});
</script> -->
