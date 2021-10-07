<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Synase-Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/<?php echo base_url();?>assets/backend/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="/<?php echo base_url();?>assets/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/<?php echo base_url();?>assets/backend/dist/css/adminlte.min.css">

  <link rel="stylesheet" href="/<?php echo base_url();?>assets/backend/custom.css">
</head>


<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>Login</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>
        
          <div id="alert-msg"></div>

      <form action="#" method="post" id="login-form" >

        <div class="form-row">
          <div class="form-group col-md-12">
          <!--   <label for="user_email">Email or Mobile Number<span class="redcolor">* &nbsp;</span></label> -->
            <input type="text" class="form-control" placeholder="Email or Mobile Number" id="user_email" name="user_email">
          </div>
         </div> 

          <div class="form-row">
          <div class="form-group col-md-12">
           <!--  <label for="password">Password<span class="redcolor">* &nbsp;</span></label> -->
             <input type="password" class="form-control" placeholder="Password" id="password" name="password" >
          </div>
         </div> 

        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" onclick="passwordShow()">
              <label for="remember">
                Show Password
              </label>
            </div>
          </div>
          <!-- /.col -->

          <div class="col-4">
            <button type="button" id="btn-login" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    <!--   <div class="social-auth-links text-center mt-2 mb-3">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> -->
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="/<?php echo base_url();?>Registration" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script type="text/javascript">
      var base_url={baseurl:"/<?php echo base_url();?>"};
 </script>
 

<script src="/<?php echo base_url();?>assets/backend/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/<?php echo base_url();?>assets/backend/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/<?php echo base_url();?>assets/backend/dist/js/adminlte.min.js"></script>

<script src="/<?php echo base_url();?>assets/backend/js/jquery.validate.min.js"></script>

<script src="/<?php echo base_url();?>assets/backend/js/gobalSettings.js"></script>
<script src="/<?php echo base_url();?>assets/backend/js/LoginController.js"></script>


</body>
</html>


<script type="text/javascript">

function passwordShow() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}


</script>