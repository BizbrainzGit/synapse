<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Synapse | Registration </title>


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
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Register a new membership</p>
         <div id="customer_register-msg"></div>

       <form action="#" method="post" id="customerregisterForm">
                         <div class="row clearfix">
                            <div class="col-sm-12">
                                    <div class="form-group">
                                       <label>Name <span class="redcolor">* &nbsp;</span></label>
                                       <input type="text" class="form-control" id="add_customer_fname" name="add_customer_fname" placeholder="Name">
                                    </div>
                            </div>
                            <!--  <div class="col-sm-12">
                                    <div class="form-group">
                                       <label>Last Name <span class="redcolor">* &nbsp;</span></label>
                                       <input type="text" class="form-control" id="add_customer_lname" name="add_customer_lname" placeholder="Last Name">
                                    </div>
                            </div> -->
                            <div class="col-sm-12">
                                    <div class="form-group">
                                       <label>Email <span class="redcolor">* &nbsp;</span></label>
                                       <input type="text" class="form-control" id="add_customer_email" name="add_customer_email" placeholder="Email">
                                    </div>
                            </div>
                             <div class="col-sm-12">
                                    <div class="form-group">
                                       <label>Mobile No <span class="redcolor">* &nbsp;</span></label>
                                       <input type="text" class="form-control" id="add_customer_mobileno" name="add_customer_mobileno" placeholder="Mobile No">
                                    </div>
                            </div>

                            <div class="col-sm-12">
                                    <div class="form-group">
                                       <label>Password <span class="redcolor">* &nbsp;</span> </label>
                                       <input type="password" class="form-control" id="add_customer_password" name="add_customer_password" placeholder="Password">
                                    </div>
                            </div>
                            <div class="col-sm-12">
                                    <div class="form-group">
                                       <label> Confirm Password <span class="redcolor">* &nbsp;</span> </label>
                                       <input type="text" class="form-control" id="add_customer_confirmpassword" name="add_customer_confirmpassword" placeholder="Confirm Password">
                                    </div>
                            </div>

                        </div>

                          <div class="row">
                                <div class="col-8">
                                  <div class="icheck-primary">
                                    <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                    <label for="agreeTerms">
                                     I agree to the <a href="#">terms</a>
                                    </label>
                                  </div>
                                </div>
                              <!-- /.col -->
                              <div class="col-4">
                                <button type="button" id="btn_customer_register" class="btn btn-primary btn-block">Register</button>
                              </div>
                             

                              <!-- /.col -->
                        </div>
                             
                        </form>

                     <a href="/<?php echo base_url();?>Login" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

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
