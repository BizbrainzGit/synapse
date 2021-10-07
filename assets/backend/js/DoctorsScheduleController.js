
$(document).ready(function(){
viewdoctorschedules();   
        function viewdoctorschedules(){
            $.ajax({
                type  : 'GET',
                url   : url+"admin/DoctorsScheduleController/SearchDoctorsScheduleList",
                async : true,
                dataType : 'json',
                success : function(result){
                          if(result.success===true){
                             doctorschedulesList(result.data);
                                 }        
                }
            });
        }

function doctorschedulesList(doctorscheduleslistdata){
	 if ( $.fn.DataTable.isDataTable('#doctorscheduletable')) {
				 $('#doctorscheduletable').DataTable().destroy();
				 }

				 $('#doctorscheduletable tbody').empty();
				 var data=doctorscheduleslistdata; 
				 var table = $('#doctorscheduletable').DataTable({
				 paging: true,
				 searching: true,
				 colvis: true,
				 columns: [
		  {data: 'id',title: 'S.No'},
		  {data: 'doctors_id',title: 'Doctors Name'},
		  {data: 'weekday',title: 'Days'},
		  {data: 'start_time',title: 'Start Time'},
		  {data: 'end_time',title: 'End Time'},
		  {data: 'per_patient_time',title: 'Per Patient Time'},
		  {data: 'schedule_status',title: 'Status'},
		  {data: null,
					 'title' : 'Action',
					 "sClass" : "center",
					 mRender: function (data, type, row) {
return '<button class="btn btn-primary btn-md editclass_doctorschedules" data-toggle="modal" data-target="#EditdoctorscheduleModal"><a data-doctorscheduleid="'+data.id+'" style="color:#FFFFFF;"><i class="mdi mdi-grease-pencil"></i>Edit</a></button>&nbsp; <button class="btn btn-danger btn-md deleteclass_doctorschedule"><a data-doctorscheduleid="'+data.id+'" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i>Delete</a></button>&nbsp;'
					 } }],
 columnDefs: [{
		  targets: 6,
         render: function(data, type, full, meta){
		  if(type === 'display'){

		  	 if(data == '1'){
                    data = '<img id="active" src="'+url+Active_Image_Path+'" heignt="32px" width="32px" align="center"/>' 
			  }else{
				   data = '<img id="inactive" src="'+url+Inactive_Image_Path+'" heignt="32px" width="32px" align="center"/>'
			  }	
          }
        return data;
       }
		 }]

			 });


table.rows.add(data).draw();

         
}



/* ====== add start ===== */
$("#add_doctorschedulesForm").validate({
     
     rules:{
     	   add_doctorschedules_doctoruserid :"required",
           add_doctorschedules_day :"required",
           add_doctorschedules_starttime :"required",
           add_doctorschedules_endtime :"required",
           add_doctorschedules_perpatienttime :"required",
           add_doctorschedules_status :"required"
      }
 });

$("#adddoctorschedules").click(function() {
	  if(!$("#add_doctorschedulesForm").valid())
	 {   
		 return false;
	 }
    var formData = new FormData( $("#add_doctorschedulesForm")[0] );
     $.ajax({
      type:"POST",
      url:url+"admin/DoctorsScheduleController/SaveDoctorsSchedules",
      dataType : 'json',
      data: formData,
      contentType: false,
      cache: false,
      processData:false,
    success: function(result){
	  if(result.success===true){
		    $('#addmsg_doctorschedules').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			$( "#addmsg_doctorschedules" ).html("<div class='alert alert-success'>"+result.message+"</div>");
		    $('#add_doctorschedulesForm')[0].reset();
			 setTimeout(function(){
               $('#AdddoctorschedulesModal').modal("hide");
                    }, 4000);
             viewdoctorschedules();          		
				
			}
			else{
				 $('#addmsg_doctorschedules').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#addmsg_doctorschedules" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#addmsg_doctorschedules').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#addmsg_doctorschedules" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	
      });

});
/* ====== add  details  end ===== */

/* ====== edit  details  end ===== */

$(document).on('click','.editclass_doctorschedules a', function(e){
    var id = $(this).attr('data-doctorscheduleid');
    //alert(id);
    $.ajax({
			type:         'GET',
			url:  url+"admin/DoctorsScheduleController/EditDoctorsScheduleByid/" + id,
			dataType:     'json',
	     success: function(result){
            if (result.success===true){
		       $('#edit_doctorschedulesForm #edit_doctorschedules_id').val(id);
               $('#edit_doctorschedulesForm #edit_doctorschedules_doctoruserid').val(result.data[0].doctors_id);
               $('#edit_doctorschedulesForm #edit_doctorschedules_day').val(result.data[0].weekday);

               $('#edit_doctorschedulesForm #edit_doctorschedules_starttime').val(result.data[0].start_time);
               $('#edit_doctorschedulesForm #edit_doctorschedules_endtime').val(result.data[0].end_time);
               $('#edit_doctorschedulesForm #edit_doctorschedules_perpatienttime').val(result.data[0].per_patient_time);

				if(result.data[0].schedule_status=='1'){
					$('#edit_doctorschedulesForm  #edit_doctorschedules_active').prop('checked', true); // checked
				}
				else{
					$('#edit_doctorschedulesForm  #edit_doctorschedules_inactive').prop('checked', true);
				}
		     

              } 
		      else {
		        alert('request failed', 'error');
		      }

	        },
	failure: function (result){

		 alert('request failed', 'error');
	}		

    });
    
  });

/* ====== update  details  start ===== */


$("#edit_doctorschedulesForm").validate({
     rules:{
     	   edit_doctorschedules_doctoruserid :"required",
           edit_doctorschedules_day :"required",
           edit_doctorschedules_starttime :"required",
           edit_doctorschedules_endtime :"required",
           edit_doctorschedules_perpatienttime :"required",
           edit_doctorschedules_status :"required"
      }
 });

$("#updatedoctorschedules").click(function(){

	   if(!$("#edit_doctorschedulesForm").valid())
	 {   
		 return false;
	 }

var formData = new FormData($("#edit_doctorschedulesForm")[0]);
  $.ajax({
      type:"POST",
      url:url+"admin/DoctorsScheduleController/UpdateDoctorsSchedules",
      dataType : 'json',
      data: formData,
      contentType: false,
      cache: false,
      processData:false,
     success: function(result){
			if(result.success===true){
				$('#updatemsg_doctorschedules').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			    $( "#updatemsg_doctorschedules" ).html("<div class='alert alert-success'>"+result.message+"</div>");
				$('#edit_doctorschedulesForm')[0].reset();
                
                setTimeout(function(){
               $('#EditdoctorscheduleModal').modal("hide");
                    }, 4000);	
                viewdoctorschedules();   

			 }
			else{
				$('#updatemsg_doctorschedules').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#doctorschedule-updatemsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#updatemsg_doctorschedules').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$("#updatemsg_doctorschedules").html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	
      
      });


});

/* ====== delete end ===== */

$(document).on('click', '.deleteclass_doctorschedule a', function(e){
 var id= $(this).attr("data-doctorscheduleid");
    $.ajax({
    type: "GET",
    url:url+'admin/DoctorsScheduleController/DeleteDoctorsScheduleById/'+id,
    dataType: 'json',
 beforeSend:function(){
         return confirm("Are you sure? You Want to Delete This Record");
      },
  success:function(result){
      if(result.success===true)
      { 
      alert(result.message); 
      viewdoctorschedules();   
      }else{
            alert('request failed', 'error');
      }

    },
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }


});


 

});

/* ====== delete end ===== */


}); // document ready 