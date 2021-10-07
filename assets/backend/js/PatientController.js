
$(document).ready(function(){

patientView();
 function patientView(){
            $.ajax({
                type  : 'GET',
                url   : url+"admin/PatientController/SearchPatientList",
                async : true,
                dataType : 'json',
                success : function(result){
                 if(result.success===true){
                   patientViewList(result.data);
                  }        
                }
            });
        }

function patientViewList(patientdata){

  if ( $.fn.DataTable.isDataTable('#patienttable')) {
         $('#patienttable').DataTable().destroy();
         }  
         $('#patienttable tbody').empty();

         var data=patientdata; 
         var table = $('#patienttable').DataTable({
        
         paging: true,
         searching: true,
         columns: [
      {data: 'id',title: 'Sno'},
      {data: 'name',title:'Name'},
      {data: 'email',title: 'Email'},
      {data: 'mobileno',title: 'Mobile No'},
      {data: 'patientaddress',title: 'Address'},
      {data: 'active',title: 'Status'},
      {data: null,
           'title' : 'Action',
           "sClass" : "center",
           mRender: function (data, type, row) {
    return '<button class="btn btn-primary btn-md editpatient" data-toggle="tooltip" id="patientdata_edit" title="Couster Edit"><a data-patientid="'+data.id+'" data-patientname="' +data.name+ '" style="color:#FFFFFF;"> <i class="fa fa-pencil" aria-hidden="true"></i> </a></button>&nbsp;<button class="btn btn-danger btn-md patient_delete" data-toggle="tooltip" data-placement="bottom" title="patient Delete"><a data-patientid="'+data.id+'" data-patientname="' +data.name+ '" style="color:#FFFFFF;"> <i class="fa fa-trash-o" aria-hidden="true"></i> </a></button>&nbsp; <button class="btn btn-info btn-md patient_status_edit" data-toggle="modal" id="patient_status_edit" data-target="#EditpatientstatusModal" title="patient Status"><a data-patientid="'+data.user_id+'" data-patientname="' +data.name+ '" style="color:#FFFFFF;"> <i class="fa fa-pencil"></i> </a></button>&nbsp; '
           } }],

           columnDefs: [{
         targets: 5,
         render: function(data, type, full, meta){
      if(type === 'display'){
        if(data == '1' ){
             data = '<img id="active" src="'+url+Active_Image_Path+'" heignt="32px" width="32px" align="center"/>' 
        } else if(data == '0' ){
             
           data = '<img id="inactive" src="'+url+Inactive_Image_Path+'" heignt="32px" width="32px" align="center"/>'
        }          
      }
          return data;
       }
     }]
  });

table.rows.add(data).draw();

}

$('[data-toggle="tooltip"]').tooltip();

//Add patient Data Start //

$("#showaddpatient").click(function(){
   $(".patientlist-class").hide();
   $(".addpatient-class").show();
});

var form = $("#add_patient");
form.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {

       add_patient_first_name:"required",
       // add_patient_last_name:"required",
       add_patient_mobileno:{required: true,number:true,minlength:10, maxlength:10},
       add_patient_email:{required: true,email: true },
       add_patient_password:"required",
       add_patient_cpassword :{required: true, equalTo:'#add_patient_password' },
       add_patient_aadhaarno:{number:true,minlength:12, maxlength:12},
       add_patient_photo:"required",
       // add_patient_houseno:"required",
       add_patient_city:"required",
       add_patient_state:"required",
       add_patient_pincode:{required: true,number:true,minlength:6, maxlength:6},
    }
});

$("#addpatient").click(function() {
  
    if(!$("#add_patient").valid())
   {
     return false;
   }
  
   var formData = new FormData($("#add_patient")[0] );
     $.ajax({
      type:"POST",
    url:url+"admin/PatientController/savepatientData",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,
    success: function(result){
      
      if(result.success==true){
        $('#add_patient_message').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
        $("#add_patient_message" ).html("<div class='alert alert-success'>"+result.message+"</div>");
        $('#add_patient')[0].reset();
       window.setTimeout(function(){location.reload()},3000);   
         
      }
      else if(result.success===false){
        $('#add_patient_message').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#add_patient_message" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
    
    failure: function (result){

      $('#add_patient_message').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#add_patient_message" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");     
    } 
  });
});

// Add patient Data End //

// // Edit patient Data Start // 

// $(document).on('click','.editpatient a', function(e){
 
//  $(".patientlist-class").hide();
//  $(".addpatient-class").hide();
//  $(".editpatient-class").show();

//  var id= $(this).attr("data-patientid");
//     // alert(id);     
// $.ajax({
//     type: "GET",
//     url:url+'admin/PatientController/editpatientByid/'+id,
//     dataType: 'json',
 
//   success:function(result){
//       if(result.success===true)
//       { 

//          //alert(result.data);
//         $('#edit_patient #edit_id').val(result.data[0].id);
//         $('#edit_patient #edit_user_id').val(result.data[0].user_id);
//         $('#edit_patient #edit_address_id').val(result.data[0].address_id);
//         $('#edit_patient #edit_patient_first_name').val(result.data[0].first_name);
//         $('#edit_patient #edit_patient_last_name').val(result.data[0].last_name);
//         $('#edit_patient #edit_patient_aadhaarno').val(result.data[0].aadhaar_number);
        
//         $('#edit_patient #edit_patient_email').val(result.data[0].email);
//         $('#edit_patient #edit_patient_mobileno').val(result.data[0].mobileno);

//         $('#edit_patient #edit_patient_houseno').val(result.data[0].houseno);
//         $('#edit_patient #edit_patient_area').val(result.data[0].area);
//         $('#edit_patient #edit_patient_street').val(result.data[0].street);

        
//         $('#edit_patient #edit_patient_city').val(result.data[0].city_id).prop("selected", true);
//         $('#edit_patient #edit_patient_state').val(result.data[0].state_id).prop("selected", true);
//         if (result.data[0].pincode==0) {
//           var pincode="";
//           }else{
//             var pincode=result.data[0].pincode
//           }
//         $('#edit_patient #edit_patient_pincode').val(pincode);

//         if (result.data[0].profile_pic_path==null) {
//           var image=No_Image_Path;
//           }else{
//             var image=result.data[0].profile_pic_path
//           }
//        $("#patientimage").html('<img src="'+url+image+ '" width="100px"  height="100px" class="img-fluid"  alt="Profile-photo" />');
//          }else{
//             alert('request failed', 'error');
//       }

//     },
   
 
//  fail:function(result){
      
//       alert('Information request failed: ' + textStatus, 'error');
//     }

// });

// });

// // Edit patient Data End // 


// // Update patient Data Start // 

// var editpatient = $("#edit_patient");
//  editpatient.validate({
//     errorPlacement: function errorPlacement(error, element) { element.before(error); },
//     rules: {
//        edit_patient_first_name:"required",
//        edit_patient_last_name:"required",
//        edit_patient_aadhaarno:{number:true,minlength:12, maxlength:12},
//        // edit_patient_houseno:"required",
//        edit_patient_city:"required",
//        edit_patient_state:"required",
//        edit_patient_pincode:{number:true,minlength:6, maxlength:6},
//     }
// });


// $("#editpatient").click(function() {
  
//     if(!$("#edit_patient").valid())
//    {
//      return false;
//    }
  
//    var formData = new FormData($("#edit_patient")[0] );
//      $.ajax({
//       type:"POST",
//     url:url+"admin/PatientController/updatepatientdata",
//     dataType: 'json',
//     data:formData,
//     contentType: false, 
//     cache: false,      
//     processData:false,
//       success: function(result){
//       if(result.success==true){
//         $('#update_patient_message').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
//         $( "#update_patient_message" ).html("<div class='alert alert-success'>"+result.message+"</div>");
//         $('#edit_patient')[0].reset();
//         window.setTimeout(function(){location.reload()},3000);
        
//       }
//       else if(result.success===false){
//         $('#update_patient_message').hide().fadeIn('').delay(1000).fadeOut(2200);
//         $( "#update_patient_message" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
//       }
//     },
    
//     failure: function (result){

//       $('#update_patient_message').hide().fadeIn('slow').delay(1000).fadeOut(2200);
//       $( "#update_patient_message" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");     
//     } 
//     });
// });

// // Update patient Data End // 

// // Delete patient Data End // 

// $(document).on('click', '.patient_delete a', function(e){
//    var id= $(this).attr("data-patientid");
//    var name=$(this).attr("data-patientname");
//     // alert(id);
//     $.ajax({
//     type: "GET",
//     url:url+'admin/PatientController/DeleteUserById/'+id,
//     dataType: 'json',
//     beforeSend:function(){
//          return confirm("Are you sure?");
//       },
//     success:function(result){
//       if(result.success==true)
//       alert(result.message); 
//        patientView();
//     },
//   fail:function(result){
//       alert('Information request failed: ' + textStatus, 'error');
//     }


// });
// });



// // search patient start 



// $("#search_patient").validate({
     
//      rules:{
//         // search_patient_name :"required",
//         // search_patient_city :"required",
      
//      }
//  });

// $("#searchpatient").click(function() {
//     if(!$("#search_patient").valid())
//    {
//      return false;
//    }
  
//    var formData = new FormData($("#search_patient")[0] );
//      $.ajax({
//     type:"POST",
//     url:url+"admin/PatientController/patientListView",
//     dataType: 'json',
//     data:formData,
//     contentType: false, 
//     cache: false,      
//     processData:false,
//     success: function(result){
//       if(result.success==true){
//         patientViewList(result.data)
//        }
//       else if(result.success===false){
//         alert('Information request failed:error, Please try Again....');
//       }
//     },
//     failure: function (result){

//       alert('Information request failed: error, Please try Again....');
//     } 

//  });


// });


// // search patient end 



// $(document).on('click', '.patient_status_edit a', function(e){
 
//  var id= $(this).attr("data-patientid");

//  $.ajax({
//     type: "GET",
//     url:url+'admin/PatientController/editpatientStatusByid/'+id,
//     dataType: 'json',
 
//   success:function(result){
//       if(result.success===true)
//       { 
        
//         $('#patient_status_change_form #patient_status_id').val(id);
//         // alert(result.data[0].active);
//         if (result.data[0].active==1) {
//           // alert(result.data[0].active); activestatusmsg
//           var data="Are you sure you want to Deactivate The patient?";
//           $('#activestatusmsg').html(data);
//            $('#patient_status_change_form #patient_status_change').val(0);
//         }else   if (result.data[0].active==0) {
//           var data="Are you sure you want to Activate The patient?";
//           $('#activestatusmsg').html(data);
//            $('#patient_status_change_form #patient_status_change').val(1);
//         }
       
    
//        }else{
//             alert('request failed', 'error');
//       }

//     },
   
 
//  fail:function(result){
      
//       alert('Information request failed: ' + textStatus, 'error');
//     }


// });

// });

// $("#patientupdatestatus").click(function(){
//   // alert("hhh");

//     if(!$("#patient_status_change_form").valid())
//    {
//      return false;
//    }
  
//   var formData = new FormData($("#patient_status_change_form")[0] );
//    $.ajax({
//        type:"POST",
//        url:url+"admin/PatientController/updatepatientStatusByid",
//     dataType: 'json',
//     data:formData,
//     contentType: false, 
//     cache: false,      
//     processData:false,

//  success: function(result){
      
//       if(result.success===true){
      
//         $('#patient-status-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);    
//           $("#patient-status-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");

//            $("#patient_status_change_form")[0].reset();
//             setTimeout(function(){
//                $('#EditpatientstatusModal').modal('hide');
//                 }, 5000);


//        patientView();

//    }
//   else if(result.success===false){
//         $('#patient-status-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
//         $( "#patient-status-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
//       }
//     },
    
//     failure: function (result){

//       $('#patient-status-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
//       $( "#patient-status-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");      
//     } 
         
//       });


// });



// // Export Start //

// $('#searchpatient_excel').click(searchpatient_excelexport);
// $('#searchpatient_pdf').click(searchpatient_excelexport);
// $('#searchpatient_print').click(searchpatient_excelexport);
// function patientDownloadExcel(link) {
//    var downloadurl=url+link;
//   // alert(downloadurl);
//   window.open(downloadurl,'_blank');
// }

// function searchpatient_excelexport(){
//   var export_type='';
//   var id = this.id;
//   if(id=='searchpatient_excel'){
//     export_type=$("#searchpatient_excel").val();
    
//   }
//   if(id=='searchpatient_pdf'){
//     export_type=$("#searchpatient_pdf").val();  
//   }
//   if(id=='searchpatient_print'){
//     export_type=$("#searchpatient_print").val();  
//   }
//   var obj=  {export_type:export_type};
//   var data = JSON.stringify(obj);
//   jQuery.ajax({
//     type: "POST",
//     url:url+"admin/PatientController/patientListExport",
//     dataType: 'json',
//     data:data,
//     success: function(result){
//       if(result.success===true){
//            $('#searchpatient_msg').hide().fadeIn('slow').delay(1350).fadeOut(2200);   
//            $("#searchpatient_msg").html("<div class='alert alert-success'>"+result.message+"</div>");
//           if(result.download_type=='excel' || result.download_type=='pdf'){
//             patientDownloadExcel(result.data);
//             return false;
//           }else{
            
//               var printWindow = window.open('', '', 'height=400,width=800');
//               printWindow.document.write('<html><head><title> patient List </title>');
//               printWindow.document.write('</head><body >');
//               printWindow.document.write(result.data);
//               printWindow.document.write('</body></html>');
//               printWindow.document.close();
//               printWindow.print();
              
//           }
          
//       }
//       else{
//         //window.location.href= '';
//         setTimeout(function(){
//           $('#searchpatient_msgmsg').html('<div class="alert alert-failure">No Data !...</div>');
//         },1000);
//         }
//     },
//     failure: function (result){
//       setTimeout(function(){
//         $('#searchpatient_msgmsg').html('<div class="alert alert-failure">Something went wrong in App!...</div>');
//       },1000);
      
//     }
//   });
// }


// //  Export End //



});//End of document ready