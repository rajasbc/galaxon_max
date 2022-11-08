<?php 
include 'tables/config.php';
if (empty($_SESSION)!=true) {
 if ($_SESSION['type']!='CUSTOMER') {
   header('location:admin/dashboard.php');
 }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GALAXON MAX - LOGIN</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href=""><b>GALAXON</b> MAX</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="" method="post" id="login_form">
        <div class="error_cls"></div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" id='username'  placeholder="Enter Username or MobileNo or Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" id="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>



 
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script type="text/javascript">
  $('#login_form').on('submit',function(e){
     e.preventDefault();
     $('.error_cls').html(' ');
     var username=$("#username").val();
     var password=$("#password").val();
     if (username=='' && username==0) {
      $("#username").css("border","1px solid red");
                    $("#username").focus();
                    return false;
        }
       else{
        $("#username").css("border","1px solid lightgray");
       }
       if (password=='' && password==0) {
      $("#password").css("border","1px solid red");
      $("#password").focus();
                    return false;
        }
       else{
        $("#password").css("border","1px solid lightgray");
       }
       $.ajax({
type: "POST",
dataType:"json",
url: 'ajaxCalls/loginCheck.php',
data: {"username": username,"password":password},
success: function(res){
if (res.status=='failed') {
  $('.error_cls').html('<p style="color:red">Username or Password Is Incorrect....</p>');
  return false;
}else{
  $('.error_cls').html('<p style="color:green">Login Successfully...</p>');
  window.location='admin/dashboard.php';
}
}

});
});
</script>
</body>
</html>
