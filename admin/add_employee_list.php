<?php 
include 'header.php';
if ($_GET['id']!='') {
 $id = base64_decode($_GET['id']);
 // print_r($id);die();
 $obj = new Employee();
 $result = $obj->get_employee_details($id);
 // $dep = new Department();
 // $res_dep = $dep->get_department_details($result[0]['department_name']);
}
$obj1 = new Department();
$result1 = $obj1->get_department_data();

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
 <!-- Content Header (Page header) -->
 <div class="content-header">
  <div class="container-fluid">
   <div class="row mb-2">
    <div class="col-sm-6">
     <h1 class="m-0">Add Employee</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
     <ol class="breadcrumb float-sm-right">




      <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
      <li class="breadcrumb-item active">Add Employee</li>


      <li class="breadcrumb-item"><a style="color: #007bff;text-decoration: none;background-color: transparent;cursor: pointer;" id="add_employee" href="add_employee.php">Back</a></li>
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
      <form method="POST" id="employee_from" enctype="multipart/form-data" >

       <div class="tab-content mt-3 ">
        <ul class="nav nav-tabs ">
         <li class="nav-item tabs pg-primary" id='basic_info' >
          <a href="" class="nav-link active " data-toggle="tab"><span style="color: #0a59cff5;font-size: 18px;">Basic Information</span></a>
         </li>
        </ul>
       </div>
       <!-- <form method="POST" id="branchForm" enctype="multipart/form-data" > -->
        <div class="row col-12 mt-3">
         <div class="col-4">
          <div class="input-group mb-3">
           <div class="input-group-prepend">
            <span class="input-group-text" >Title&nbsp;</span>
           </div>
           <input type="hidden" id='id' name='id' class="form-control"  value="<?=$result[0]['id']?>">
           <select class="form-control enterKeyclass " id="title" name="title">
            <option value="" >Select Title</option>

            <option value="Mr"  <?php if ($result[0]['title']=='Mr') { echo 'selected="selected"'; }?>>Mr</option>

            <option value="Mrs" <?php if ($result[0]['title']=='Mrs') { echo 'selected="selected"'; }?>>Mrs</option>

            <option value="Master" <?php if ($result[0]['title']=='Master') { echo 'selected="selected"'; }?>>Master</option>

            <option value="Ms" <?php if ($result[0]['title']=='Ms') { echo 'selected="selected"'; }?>>Ms</option>   



           </select>
          </div>
         </div>
         <div class="col-4">
          <div class="input-group mb-3">
           <div class="input-group-prepend">
            <span class="input-group-text" >First Name&nbsp;</span>
           </div>

           <input type="text" id='first_name' name='first_name' class="form-control enterKeyclass" placeholder="Enter First Name" value="<?=$result[0]['first_name']?>">
          </div>
         </div>
         <div class="col-4">
          <div class="input-group mb-3">
           <div class="input-group-prepend">
            <span class="input-group-text">Last Name</span>
           </div>
           <input type="text" id='last_name' name='last_name' class="form-control enterKeyclass" placeholder="Enter Last Name" value="<?=$result[0]['last_name']?>">
          </div>
         </div>
        </div>



        <div class="row col-12 ">
         <div class="col-4">
          <div class="input-group mb-3">
           <div class="input-group-prepend">
            <span class="input-group-text" >DOB&nbsp;</span>
           </div>
           <input type='date' name='dob' id='dob' class='form-control enterKeyclass' max="<?=date('Y-m-d')?>" value="<?=$result[0]['dob']?>"  >
          </div>
         </div>
         <div class="col-4">
          <div class="input-group mb-3">
           <div class="input-group-prepend">
            <span class="input-group-text" >Age&nbsp;</span>
           </div>
           <input type="text" id='age' name='age' class="form-control enterKeyclass" placeholder="Enter Age" value="<?=$result[0]['age']?>">
          </div>
         </div>
         <div class="col-4">
          <div class="input-group mb-3">
           <div class="input-group-prepend">
            <span class="input-group-text">Gender</span>
           </div>
           <select class="form-control enterKeyclass " id="gender" name="gender" >
            <option value="" >Select Gender</option>
            <option value="Male" <?php if ($result[0]['gender']=='Male') { echo 'selected="selected"'; } ?>>Male</option>
            <option value="Female" <?php if ($result[0]['gender']=='Female') { echo 'selected="selected"'; } ?>>Female</option>
            <option value="Others" <?php if ($result[0]['gender']=='Others') { echo 'selected="selected"'; } ?>>Others</option>
           </select>
          </div>
         </div>
        </div>



        <div class="row col-12 ">
         <div class="col-4">
          <div class="input-group mb-3">
           <div class="input-group-prepend">
            <span class="input-group-text" >Mobile.No&nbsp;</span>
           </div>
           <input type='text' name='mobile_no' id='mobile_no' class='form-control enterKeyclass' onkeypress="if(this.value.length>=10) return false;" minlength='10' placeholder="Enter Mobile Number" value="<?=$result[0]['mobile_no']?>">
          </div>
         </div>
         <div class="col-4">
          <div class="input-group mb-3">
           <div class="input-group-prepend">
            <span class="input-group-text" >Email&nbsp;</span>
           </div>
           <input type='text' name='email' id='email' class='form-control enterKeyclass' placeholder="Enter Email" value="<?=$result[0]['email']?>"> 
          </div>
         </div>
         <div class="col-4">
          <div class="input-group mb-3">
           <div class="input-group-prepend">
            <span class="input-group-text">Address Line1</span>
           </div>
           <input type='text' name='address_line1' id='address_line1' class='form-control enterKeyclass' placeholder="Enter Address Line1" value="<?=$result[0]['address_line1']?>"> 
          </div>
         </div>
        </div>



        <div class="row col-12 ">
         <div class="col-4">
          <div class="input-group mb-3">
           <div class="input-group-prepend">
            <span class="input-group-text" >Address Line2&nbsp;</span>
           </div>
           <input type='text' name='address_line2' id='address_line2' class='form-control enterKeyclass' placeholder="Enter Address Line2" value="<?=$result[0]['address_line2']?>"> 
          </div>
         </div>
         <div class="col-4">
          <div class="input-group mb-3">
           <div class="input-group-prepend">
            <span class="input-group-text" >Street&nbsp;</span>
           </div>
           <input type='text' name='street' id='street' class='form-control enterKeyclass' placeholder="Enter Street" value="<?=$result[0]['street']?>"> 
          </div>
         </div>
         <div class="col-4">
          <div class="input-group mb-3">
           <div class="input-group-prepend">
            <span class="input-group-text">City</span>
           </div>
           <input type='text' name='city' id='city' class='form-control enterKeyclass' placeholder="Enter City" value="<?=$result[0]['city']?>"> 
          </div>
         </div>
        </div>



        <div class="row col-12 ">
         <div class="col-4">
          <div class="input-group mb-3">
           <div class="input-group-prepend">
            <span class="input-group-text" >State&nbsp;</span>
           </div>
           <input type='text' name='state' id='state' class='form-control enterKeyclass' placeholder="Enter State" value="<?=$result[0]['state']?>"> 
          </div>
         </div>
         <div class="col-4">
          <div class="input-group mb-3">
           <div class="input-group-prepend">
            <span class="input-group-text" >Country&nbsp;</span>
           </div>
           <input type='text' name='country' id='country' class='form-control enterKeyclass' placeholder="Enter Country" value="<?=$result[0]['country']?>"> 
          </div>
         </div>
         <div class="col-4">
          <div class="input-group mb-3">
           <div class="input-group-prepend">
            <span class="input-group-text">Pincode</span>
           </div>
           <input type='text' name='pincode' id='pincode' class='form-control enterKeyclass' placeholder="Enter Pincode" value="<?=$result[0]['pincode']?>"> 
          </div>
         </div>
        </div>


        <div class="tab-content mt-3 ">
         <ul class="nav nav-tabs ">
          <li class="nav-item tabs pg-primary" id='personal_info' >
           <a href="" class="nav-link active " data-toggle="tab"><span style="color: #0a59cff5;font-size: 18px;">Personal Information</span></a>
          </li>
         </ul>
        </div>


        <div class="row col-12 mt-3">
         <div class="col-4">
          <div class="input-group mb-3">
           <div class="input-group-prepend">
            <span class="input-group-text" >ID Proof&nbsp;</span>
           </div>
           <select class="form-control enterKeyclass" id="id_type" name="id_type">
            <option value="" >Select ID proof</option>
            <option value="Aadhaar_Card" <?php if ($result[0]['id_type']=='Aadhaar_Card') { echo 'selected="selected"'; } ?>>Aadhaar Card</option>
            <option value=" Driving_Licensees" <?php if ($result[0]['Driving_Licensees']=='Male') { echo 'selected="selected"'; } ?>> Driving Licensees</option>
            <option value=" PAN_Card" <?php if ($result[0]['id_type']=='PAN_Card') { echo 'selected="selected"'; } ?>> PAN Card</option>
            <option value="Passport" <?php if ($result[0]['id_type']=='Passport') { echo 'selected="selected"'; } ?>>Passport</option>
            <option value="Voter_ID_Card" <?php if ($result[0]['id_type']=='Voter_ID_Card') { echo 'selected="selected"'; } ?>>Voter ID Card</option>
           </select>
          </div>
         </div>
         <div class="col-4">
          <div class="input-group mb-3">
           <div class="input-group-prepend">
            <span class="input-group-text">ID No</span>
           </div>
           <input type='text' name='id_no' id='id_no' class='form-control enterKeyclass' placeholder="Enter ID Nymber" value="<?=$result[0]['id_no']?>">        
          </div>
         </div>
         <div class="col-4">
          <div class="input-group mb-3">
           <div class="input-group-prepend">
            <span class="input-group-text" >Blood Group&nbsp;</span>
           </div>
           <select class="form-control enterKeyclass" id="blood_group" name="blood_group">
            <option value="" >Select Group</option>
            <option value="A+" <?php if ($result[0]['blood_group']=='A+') { echo 'selected="selected"'; } ?>>A+</option>
            <option value="A-" <?php if ($result[0]['blood_group']=='A-') { echo 'selected="selected"'; } ?>>A-</option>
            <option value="B+" <?php if ($result[0]['blood_group']=='B+') { echo 'selected="selected"'; } ?>>B+</option>
            <option value="B-" <?php if ($result[0]['blood_group']=='B-') { echo 'selected="selected"'; } ?>>B-</option>
            <option value="AB+" <?php if ($result[0]['blood_group']=='AB+') { echo 'selected="selected"'; } ?>>AB+</option>
            <option value="AB-" <?php if ($result[0]['blood_group']=='AB-') { echo 'selected="selected"'; } ?>>AB-</option>
            <option value="O+" <?php if ($result[0]['blood_group']=='O+') { echo 'selected="selected"'; } ?>>O+</option>
            <option value="O-" <?php if ($result[0]['blood_group']=='O-') { echo 'selected="selected"'; } ?>>O-</option>
           </select>
          </div>
         </div>

        </div>

        <div class="row col-12 ">
         <div class="col-4">
          <div class="input-group mb-3">
           <div class="input-group-prepend">
            <span class="input-group-text" >Emergency Contact&nbsp;</span>
           </div>
           <input type='text' name='emergency_contact' id='emergency_contact' class='form-control enterKeyclass' placeholder="Enter Emergency Contact" value="<?=$result[0]['emergency_contact']?>">
          </div>
         </div>
         <div class="col-4">
          <div class="input-group mb-3">
           <div class="input-group-prepend">
            <span class="input-group-text">Vaccinate</span>
           </div>
           <select class="form-control enterKeyclass" id="vaccinate" name="vaccinate">
            <option value="" >Select Here</option>
            <option value="Yes" <?php if ($result[0]['vaccinate']=='Yes') { echo 'selected="selected"'; } ?>>Yes</option>
            <option value="No" <?php if ($result[0]['vaccinate']=='No') { echo 'selected="selected"'; } ?>>No</option>

           </select>   
          </div>
         </div>
        </div>

        <div class="tab-content mt-3 ">
         <ul class="nav nav-tabs ">
          <li class="nav-item tabs pg-primary" id='bank_info' >
           <a href="" class="nav-link active " data-toggle="tab"><span style="color: #0a59cff5;font-size: 18px;">Bank Information</span></a>
          </li>
         </ul>
        </div>

        <div class="row col-12 mt-3">
         <div class="col-4">
          <div class="input-group mb-3">
           <div class="input-group-prepend">
            <span class="input-group-text" >Bank Name&nbsp;</span>
           </div>
           <input type='text' name='bank_name' id='bank_name' class='form-control enterKeyclass' placeholder="Enter Bank Name" value="<?=$result[0]['bank_name']?>">
          </div>
         </div>
         <div class="col-4">
          <div class="input-group mb-3">
           <div class="input-group-prepend">
            <span class="input-group-text">Branch Name</span>
           </div>
           <input type='text' name='branch_name' id='branch_name' class='form-control enterKeyclass' placeholder="Enter Branch Name" value="<?=$result[0]['branch_name']?>">        
          </div>
         </div>
         <div class="col-4">
          <div class="input-group mb-3">
           <div class="input-group-prepend">
            <span class="input-group-text" >Branch Code&nbsp;</span>
           </div>
           <input type='text' name='branch_code' id='branch_code' class='form-control enterKeyclass' placeholder="Enter Branch Code" value="<?=$result[0]['branch_code']?>"> 
          </div>
         </div>
        </div>


        <div class="row col-12">
         <div class="col-4">
          <div class="input-group mb-3">
           <div class="input-group-prepend">
            <span class="input-group-text" >Account No&nbsp;</span>
           </div>
           <input type='text' name='account_number' id='account_number' class='form-control enterKeyclass' placeholder="Enter Account Number" value="<?=$result[0]['account_number']?>">
          </div>
         </div>
         <div class="col-4">
          <div class="input-group mb-3">
           <div class="input-group-prepend">
            <span class="input-group-text" >IFSC Code&nbsp;</span>
           </div>
           <input type='text' name='ifsc_code' id='ifsc_code' class='form-control enterKeyclass' placeholder="Enter IFSC Code" value="<?=$result[0]['ifsc_code']?>"> 
          </div>
         </div>
        </div>

        <div class="tab-content mt-3 ">
         <ul class="nav nav-tabs ">
          <li class="nav-item tabs pg-primary" id='package_info' >
           <a href="" class="nav-link active " data-toggle="tab"><span style="color: #0a59cff5;font-size: 18px;">Package Information</span></a>
          </li>
         </ul>
        </div>


        <div class="row col-12 mt-3">
         <div class="col-4">
          <div class="input-group mb-3">
           <div class="input-group-prepend">
            <span class="input-group-text" >Department Name&nbsp;</span>
           </div>
           <select  type='text' name='department_name' id='department_name' class='form-control enterAsTab'  >
            <option value="">Select Department</option>
            <?php
            foreach ($result1 as $value) { 

             // $sel = $value['name']==$result[0]['department_name']?'selected':'';
              // $sel = $value['name'] == $result[0]['department_name']?'selected':'';
             $selected = "<option value='".$value['name']."' ".$sel." >" . $value["name"]."</option>";
             $selected = str_replace("<option value='".$result[0]['department_name']."'","<option value='".$result[0]['department_name']."' selected", $selected);

             echo $selected;
             
            }
            ?>
           </select>    
          </div>
         </div>
         <div class="col-4">
          <div class="input-group mb-3">
           <div class="input-group-prepend">
            <span class="input-group-text">Designation</span>
           </div>
           <input type='text' name='designation' id='designation' class='form-control enterKeyclass' placeholder="Enter Designation" value="<?=$result[0]['designation']?>">        
          </div>
         </div>
         <div class="col-4">
          <div class="input-group mb-3">
           <div class="input-group-prepend">
            <span class="input-group-text" >Date Of Joining&nbsp;</span>
           </div>
           <input type='date' name='date_of_joining' id='date_of_joining' class='form-control enterKeyclass' value="<?=$result[0]['date_of_joining']?>"> 
          </div>
         </div>

        </div>


        <div class="row col-12">
         <div class="col-4">
          <div class="input-group mb-3">
           <div class="input-group-prepend">
            <span class="input-group-text" >Gross Wage&nbsp;</span>
           </div>
           <input type='text' name='gross_wage' id='gross_wage' class='form-control enterKeyclass' placeholder="Enter Gross Wage" value="<?=$result[0]['gross_wage']?>">
          </div>
         </div>
         <div class="col-4">
          <div class="input-group mb-3">
           <div class="input-group-prepend">
            <span class="input-group-text">Basic Wage</span>
           </div>
           <input type='text' name='basic_wage' id='basic_wage' class='form-control enterKeyclass' placeholder="Enter Basic Wage" value="<?=$result[0]['basic_wage']?>">        
          </div>
         </div>
         <div class="col-4">
          <div class="input-group mb-3">
           <div class="input-group-prepend">
            <span class="input-group-text" >EPF&nbsp;</span>
           </div>
           <input type='text' name='epf' id='epf' class='form-control enterKeyclass' placeholder="Enter EPF" value="<?=$result[0]['epf']?>"> 
          </div>
         </div>
        </div>


        <div class="row col-12">
         <div class="col-4">
          <div class="input-group mb-3">
           <div class="input-group-prepend">
            <span class="input-group-text" >TA/ DA&nbsp;</span>
           </div>
           <input type='text' name='ta_da' id='ta_da' class='form-control enterKeyclass' placeholder="Enter TA/ DA" value="<?=$result[0]['ta_da']?>">
          </div>
         </div>
         <div class="col-4">
          <div class="input-group mb-3">
           <div class="input-group-prepend">
            <span class="input-group-text">ESI/Health Insurance</span>
           </div>
           <input type='text' name='esi_health_insurance' id='esi_health_insurance' class='form-control enterKeyclass' placeholder="Enter ESI/Health Insurance" value="<?=$result[0]['esi_health_insurance']?>">        
          </div>
         </div>
         <div class="col-4">
          <div class="input-group mb-3">
           <div class="input-group-prepend">
            <span class="input-group-text" >Conveyance Allowances&nbsp;</span>
           </div>
           <input type='text' name='conveyance_allowances' id='conveyance_allowances' class='form-control enterKeyclass' placeholder="Enter Conveyance Allowances" value="<?=$result[0]['conveyance_allowances']?>"> 
          </div>
         </div>
        </div>

        <div class="row col-12">
         <div class="col-4">
          <div class="input-group mb-3">
           <div class="input-group-prepend">
            <span class="input-group-text" >Medical Allowances&nbsp;</span>
           </div>
           <input type='text' name='medical_allowances' id='medical_allowances' class='form-control enterKeyclass' placeholder="Enter Medical Allowances" value="<?=$result[0]['medical_allowances']?>">
          </div>
         </div>
         <div class="col-4">
          <div class="input-group mb-3">
           <div class="input-group-prepend">
            <span class="input-group-text">Addition emp tax</span>
           </div>
           <input type='text' name='addition_emp_tax' id='addition_emp_tax' class='form-control enterKeyclass' placeholder="Enter Addition emp tax" value="<?=$result[0]['addition_emp_tax']?>">        
          </div>
         </div>
        </div>


        <div class="modal-footer justify-content-between">
         <button type="reset" class="btn btn-warning" >Reset</button>
         <?php if ($_GET['id']!='') { ?>
          <button type="submit" id="add_employee_btn" class="btn btn-success">Update</button>
         <?php }else{ ?>
          <button type="submit" id="add_employee_btn" class="btn btn-success">Save</button>
         <?php } ?>
        </div>
       </form>

      </div>
     </div>
    </div>
    <!-- /.row (main row) -->
   </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
 </div>

 <?php 
 include 'footer.php';
 ?>
 <script>
  $("#employee_from").on('submit', function(e){
   event.preventDefault();
   $.ajax({
    type:"POST",
    url:"../ajaxCalls/add_employee.php",
    dataType:"json",
    data:new FormData(this),
    contentType: false,
    cache: false,
    processData:false,
    success:function(res){
     if (res.status=='success'){

      window.location='add_employee.php';
     }

    }

   });
  });
 </script>
