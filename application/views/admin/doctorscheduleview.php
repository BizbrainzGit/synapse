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
            <h1 class="m-0">Doctor Time Schedule </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/<?php echo base_url();?>Admin-Dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active">Doctor Time Schedule </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Search Doctors Time Schedule Lists  </h3>
                <a href="#" data-toggle="modal" data-target="#AdddoctorschedulesModal"  style="float:right;"><button class="btn btn-primary">Add Doctors Schedules </button></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="doctorscheduletable" class="table table-bordered table-hover display responsive nowrap" style="width:100%">
                </table>
         
                <!-- <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Rendering engine</th>
                    <th>Browser</th>
                    <th>Platform(s)</th>
                    <th>Engine version</th>
                    <th>CSS grade</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>Trident</td>
                    <td>Internet
                      Explorer 4.0
                    </td>
                    <td>Win 95+</td>
                    <td> 4</td>
                    <td>X</td>
                  </tr>
                  <tr>
                    <td>Trident</td>
                    <td>Internet
                      Explorer 5.0
                    </td>
                    <td>Win 95+</td>
                    <td>5</td>
                    <td>C</td>
                  </tr>
                  <tr>
                    <td>Trident</td>
                    <td>Internet
                      Explorer 5.5
                    </td>
                    <td>Win 95+</td>
                    <td>5.5</td>
                    <td>A</td>
                  </tr>
                  </tbody>
                  <tfoot>
                  </tfoot>
                </table> -->


              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->




  </div>
  <!-- /.content-wrapper -->
  


<!--  add model start-->
<div class="modal fade" id="AdddoctorschedulesModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add doctors Schedules</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
         <!-- Modal body -->

           <form id="add_doctorschedulesForm" method="post" enctype="multipart/form-data">

            <div class="modal-body">
                    <div class="body">
                            <div class="row clearfix">
                               <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Doctor Name <span class="redcolor">* &nbsp;</span></label>
                                         <input type="text" class="form-control" placeholder="Doctor Name" name="add_doctorschedules_doctoruserid" id="add_doctorschedules_doctoruserid">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Day<span class="redcolor">* &nbsp;</span></label>
                                         <!-- <input type="text" class="form-control" placeholder="Day" name="add_doctorschedules_day" id="add_doctorschedules_day"> -->
			                              <select  class="form-control" name="add_doctorschedules_day" id="add_doctorschedules_day">
			                                 <option value="">--- Select Week Day ---</option>
			                                 <option value="Monday">Monday</option>
			                                 <option value="Tuesday">Tuesday</option>
			                                 <option value="Wednesday">Wednesday</option>
			                                 <option value="Thursday">Thursday</option>
			                                 <option value="Friday">Friday</option>
			                                 <option value="Saturday">Saturday</option>
			                                 <option value="Sunday">Sunday</option>
			                             </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Start Time <span class="redcolor">* &nbsp;</span></label>
                                         <input type="time" class="form-control" placeholder="Start Time " name="add_doctorschedules_starttime" id="add_doctorschedules_starttime">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">End Time<span class="redcolor">* &nbsp;</span></label>
                                         <input type="time" class="form-control" placeholder="End Time" name="add_doctorschedules_endtime" id="add_doctorschedules_endtime">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Per Patient Time(In Mins) <span class="redcolor">* &nbsp;</span></label>
                                         <input type="text" class="form-control" placeholder="Per Patient Time " name="add_doctorschedules_perpatienttime" id="add_doctorschedules_perpatienttime">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                   <div class="form-group">
                                       <label>Status <span class="redcolor">* &nbsp;</span></label>   
                                         <p class='add_doctorschedules_status'>
                                        <label class="radio-inline">
                                        <input type="radio" name="add_doctorschedules_status" value="1" id="add_doctorschedules_active"> Active
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="add_doctorschedules_status" value="2" id="add_doctorschedules_inactive"> In Active
                                        </label><br>
                                        </p>
                                   </div>
                                </div>

                            </div>             
                        </div> 
                      </div> 

        <div class="modal-footer">
          <div class="col-sm-12" style="text-align: center;">

             <button  type="button" id="adddoctorschedules" class="btn btn-primary">Save</button>
          <!--    <button type="reset" class="btn btn-outline-secondary">Reset</button> -->
              <div id="addmsg_doctorschedules"></div>
          </div>
       
      </div>
 </form>

      </div>
    </div>
  </div>
<!--  add model end -->

<!--  edit model start-->
<div class="modal fade" id="EditdoctorscheduleModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Doctors Schedules</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
         <!-- Modal body -->

           <form id="edit_doctorschedulesForm" method="post" enctype="multipart/form-data">
            
            <div class="modal-body">
                    <div class="body">
                            <div class="row clearfix">
                               <div class="col-sm-6">
                                    <div class="form-group">
                                    	<input type="hidden" class="form-control" name="edit_doctorschedules_id" id="edit_doctorschedules_id">
                                        <label>Doctor Name <span class="redcolor">* &nbsp;</span></label>
                                         <input type="text" class="form-control" placeholder="Doctor Name" name="edit_doctorschedules_doctoruserid" id="edit_doctorschedules_doctoruserid">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Day<span class="redcolor">* &nbsp;</span></label>
			                              <select  class="form-control" name="edit_doctorschedules_day" id="edit_doctorschedules_day">
			                                 <option value="">--- Select Week Day ---</option>
			                                 <option value="Monday">Monday</option>
			                                 <option value="Tuesday">Tuesday</option>
			                                 <option value="Wednesday">Wednesday</option>
			                                 <option value="Thursday">Thursday</option>
			                                 <option value="Friday">Friday</option>
			                                 <option value="Saturday">Saturday</option>
			                                 <option value="Sunday">Sunday</option>
			                             </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Start Time <span class="redcolor">* &nbsp;</span></label>
                                         <input type="time" class="form-control" placeholder="Start Time " name="edit_doctorschedules_starttime" id="edit_doctorschedules_starttime">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">End Time<span class="redcolor">* &nbsp;</span></label>
                                         <input type="time" class="form-control" placeholder="End Time" name="edit_doctorschedules_endtime" id="edit_doctorschedules_endtime">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Per Patient Time(In Mins) <span class="redcolor">* &nbsp;</span></label>
                                         <input type="text" class="form-control" placeholder="Per Patient Time " name="edit_doctorschedules_perpatienttime" id="edit_doctorschedules_perpatienttime">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                   <div class="form-group">
                                       <label>Status <span class="redcolor">* &nbsp;</span></label>   
                                         <p class='edit_doctorschedules_status'>
                                        <label class="radio-inline">
                                        <input type="radio" name="edit_doctorschedules_status" value="1" id="edit_doctorschedules_active"> Active
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="edit_doctorschedules_status" value="2" id="edit_doctorschedules_inactive"> In Active
                                        </label><br>
                                        </p>
                                   </div>
                                </div>

                            </div>             
                        </div> 
                      </div> 

        <div class="modal-footer">
          <div class="col-sm-12" style="text-align: center;">

             <button  type="button" id="updatedoctorschedules" class="btn btn-primary">Upadte</button>
          <!--    <button type="reset" class="btn btn-outline-secondary">Reset</button> -->
              <div id="updatemsg_doctorschedules"></div>
          </div>
       
      </div>
 </form>

      </div>
    </div>
  </div>
<!--  edit model end -->




 <?php
include('Layouts/adminLayout_footer.php');
?>
<script src="/<?php echo base_url();?>assets/backend/js/DoctorsScheduleController.js"></script>

