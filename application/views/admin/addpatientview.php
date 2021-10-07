<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/adminLayout_header.php');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row content">
           
           <div class="row clearfix">
                               <div class="col-sm-6">
                                    <div class="form-group">
                                      <label>First Name <span class="redcolor">* &nbsp;</span>: </label>
                                      <div class="input-group">
                                      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                      <input type="text" class="form-control"  id="add_customer_first_name" name="add_customer_first_name" placeholder="Enter First Name">
                                      </div>
                                    </div>
                                </div>

                                 <div class="col-sm-6">
                                    <div class="form-group">
                                      <label>Last Name <span class="redcolor">* &nbsp;</span>: </label>
                                      <div class="input-group">
                                      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                      <input type="text" class="form-control"  id="add_customer_last_name" name="add_customer_last_name" placeholder="Enter Last Name">
                                      </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                      <label>Aadhaar No: </label>
                                      <div class="input-group">
                                      <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                                       <input type="text" class="form-control" id="add_customer_aadhaarno" name="add_customer_aadhaarno" placeholder="Enter Aadhaar No" >
                                      </div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-6">
                                    <div class="form-group">
                                      <label>Email <span class="redcolor">* &nbsp;</span>: </label>
                                      <div class="input-group">
                                      <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                      <input type="email" class="form-control" id="add_customer_email" name="add_customer_email" placeholder="Enter Email" >
                                      </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                      <label>Mobile No <span class="redcolor">* &nbsp;</span>: </label>
                                      <div class="input-group">
                                      <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                                       <input type="text" class="form-control" id="add_customer_mobileno" name="add_customer_mobileno" placeholder="Enter Mobile No" >
                                      </div>
                                    </div>
                                </div>

                                 <div class="col-sm-6">
                                    <div class="form-group">
                                      <label>Password <span class="redcolor">* &nbsp;</span>: </label>
                                      <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-eye"></i></span>
                                       <input type="password" class="form-control" id="add_customer_password" name="add_customer_password" placeholder="Enter Password" >
                                      </div>
                                    </div>
                                </div>

                                 <div class="col-sm-6">
                                    <div class="form-group">
                                      <label>Confirm Password <span class="redcolor">* &nbsp;</span>: </label>
                                      <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-eye"></i></span>
                                       <input type="text" class="form-control" id="add_customer_cpassword" name="add_customer_cpassword" placeholder="Enter Confirm Password" >
                                      </div>
                                    </div>
                                </div> 
                                <div class="col-sm-6">
                                    <div class="form-group">
                                      <label>Photo <span class="redcolor">* &nbsp;</span>: </label>
                                      <div class="input-group">
                                      <span class="input-group-addon"><i class="glyphicon glyphicon-camera"></i></span>
                                      <input type="file" class="form-control" id="add_customer_photo" name="add_customer_photo" placeholder="Enter Email" >
                                      </div>
                                    </div>
                                </div>
                               
                         </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>150</h3>

                <p>New Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>

                <p>Bounce Rate</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>44</h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->




        </div>
        <!-- /.row -->
      
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  


 <?php
include('Layouts/adminLayout_footer.php');
?>