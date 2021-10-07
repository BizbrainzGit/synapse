
// var getUrlParameter = function getUrlParameter(sParam) {
//     var sPageURL = decodeURIComponent(window.location.search.substring(1)),
//         sURLVariables = sPageURL.split('&'),
//         sParameterName,
//         i;

//     for (i = 0; i < sURLVariables.length; i++) {
//         sParameterName = sURLVariables[i].split('=');

//         if (sParameterName[0] === sParam) {
//             return sParameterName[1] === undefined ? true : sParameterName[1];
//         }
//     }
// };

$('document').ready(function()
{

$('#changepasswordForm').validate({
    rules:{
  
  old_password: {
            required: true
        },
  new_password: {
            required: true
        },
  confirm_password : {
                equalTo : '[name="new_password"]'
        }
  
  }
  
  
});



$("#btn_changepassword").click(function(){

  if(!$("#changepasswordForm").valid()){
    return false;
  }
  var old_password=$("#old_password").val();
  var new_password=$("#new_password").val();
  var confirm_password=$("#confirm_password").val();
  
  $.ajax({
      type:"POST",
      url:url+"LoginController/changePassword",
      dataType : 'json',
      cache :false,
      data: {old_password:old_password,new_password:new_password,confirm_password:confirm_password},
      success: function(result)
      {
      if(result.success==true) {
       $('#changepassword-msg').hide().fadeIn('slow').delay(350).fadeOut('slow');
       $("#changepassword-msg").html("<div class='alert alert-success'>"+result.message+"</div>");
       $('#changepasswordForm')[0].reset();
          
          setTimeout(function(){
          $('#changePasswordModal').modal('hide');
              },900);       
      }else if(result.success==false){
           $('#changepassword-msg').hide().fadeIn('slow').delay(350).fadeOut('slow');
           $("#changepassword-msg").html("<div class='alert alert-danger'>"+result.message+"</div>");

      }
      
    },
    failure: function (result)
    {
       $('#changepassword-msg').hide().fadeIn('slow').delay(350).fadeOut('slow');
      $( "#changepassword-msg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ..</div>");
    }   
  });
})

/* login form validation */
  $("#login-form").validate({
    rules:
     {
       password: {required: true},
       user_email: { required: true}
     }
 }); 

$('#btn-login').click(function(e) {
   if(!$("#login-form").valid())
   {
     return false;
   }
  var user_email = $("#user_email").val();
  var password = $("#password").val();
  login={user_email:user_email,password:password};  
  var Login = JSON.stringify(login);
  $.ajax({
    type: "POST",
    url:url+'LoginController/login',
    data:Login,
    dataType: 'json',
    success: function(result){
      
      if(result.success===true && result.data.user_roles=='Admin')
      {     
       // alert("hhhh");
        setTimeout('window.location.href = "'+url+'Admin-Dashboard"; ',100);
      }
      if(result.success==true && result.data.user_roles=='Driver'){
       setTimeout('window.location.href = "'+url+'Driver-ManageVehicleRoutes"; ',100);
      }
      if(result.success===true && result.data.user_roles=='Patient'){
        setTimeout('window.location.href = "'+url+'Patient-Dashboard"; ',100);
      }
      
      if(result.success===false){
          alert(result.message); 
      }
    }
    
    });
});




$('#btn-logout').click(function(e) {
  $.ajax({
    type: "POST",
    url:url+'LoginController/logout',
    dataType: 'json',
    success: function(result){
      if(result.success===true)
      {     
        alert(result.message); 
        setTimeout('window.location.href = "'+url+'"; ',100);
      }

      if(result.success===false){
          alert(result.message); 
      }
    }
    
    });
});


// Add User Details Start //


$('#customerregisterForm').validate({
    rules:{
  add_customer_fname: {
            required: true
        },
  add_customer_lname: {
            required: true
        },
  add_customer_password: {
            required: true
        },
  add_customer_confirmpassword : {
                equalTo : '[name="add_customer_password"]'
        },
  add_customer_email:{
     required:true,
     email: true     
  },
  
  add_customer_mobileno:{
    required: true,
    minlength:10, maxlength:10
  }

    }

});
// End The UserDetails Validations

// Add the UserDetails Details
$("#btn_customer_register").click(function(){

  if(!$("#customerregisterForm").valid()){
    return false;
  }

  var add_customer_fname               =$("#add_customer_fname").val();
  var add_customer_mobileno            =$("#add_customer_mobileno").val();
  var add_customer_email               =$("#add_customer_email").val();
  var add_customer_password            =$("#add_customer_password").val();
  var add_customer_confirmpassword     =$("#add_customer_confirmpassword").val();
  
      $.ajax({
      type:"POST",
      url:url+"LoginController/saveCustomerSignup",
      dataType : 'json',
      data: {add_customer_fname:add_customer_fname,add_customer_mobileno:add_customer_mobileno,add_customer_email:add_customer_email,add_customer_password:add_customer_password,add_customer_confirmpassword:add_customer_confirmpassword},

    success: function(result){
      
      if(result.success===true){
        
          $('#customer_register-msg').hide().fadeIn('slow').delay(350).fadeOut('slow');   
          $('#customer_register-msg').html("<div class='alert alert-success'>"+result.message+"</div>");
          $('#customerregisterForm')[0].reset();
        }
      else{
        $('#customer_register-msg').hide().fadeIn('slow').delay(350).fadeOut('slow');
        $( "#customer_register-msg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
    
    failure: function (result){
      $('#customer_register-msg').hide().fadeIn('slow').delay(350).fadeOut('slow');
      $( "#customer_register-msg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");      
    }   
  }); //Ajax  Call
});


// Add User Details End  //


$('#forgotpassword-form').validate({
    rules:{
  
  forgotpassword_user_email: {
                                required: true,
                                email:true
 
  }
}
  
  
});




// End the Add the UserDetails
$("#forgotpassword-button").click(function(){
  
  if(!$("#forgotpassword-form").valid()){
    return false;
  }
  var forgotpassword_user_email=$("#forgotpassword_user_email").val();
   var obj={forgotpassword_user_email:forgotpassword_user_email};
  $.ajax({
      type:"POST",
     url:url+"LoginController/forgotpassword",
      dataType : 'json',
      cache :false,
      data:obj,
      success: function(result)
      {
      if(result.success==true)
      {
       
      $('#forgotpassword-msg').hide().fadeIn('slow').delay(350).fadeOut('slow');
      $("#forgotpassword-msg").html("<div class='alert alert-success'>"+result.message+"</div>");
      $('#forgotpassword-form')[0].reset();
           
      }else{

         $('#forgotpassword-msg').hide().fadeIn('slow').delay(350).fadeOut('slow');
         $("#forgotpassword-msg").html("<div class='alert alert-success'>"+result.message+"</div>");

      }
      
    },
    failure: function (result)
    {
       $('#forgotpassword-msg').hide().fadeIn('slow').delay(350).fadeOut('slow');
      $( "#forgotpassword-msg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ..</div>");
    }   
  });
});



  /* change password validation */
  $("#newchangepassword_form").validate({
      rules:
   {
      newchangepassword_new_password: {
            required: true
      },
      newchangepassword_confirm_password : {
                required: true,
                equalTo : '[name="newchangepassword_new_password"]'
      },
    },
       messages:
    {
            newchangepassword_new_password:"Please enter New Password",
            newchangepassword_confirm_password:"Please enter the Confirm Password match with the New Password"
    }
       });  
    /* end of Change password validation */
/* Change Password Button*/
$("#newchangepassword_button").click(function(){
  
  if(!$("#newchangepassword_form").valid()){
    return false;
  }
  var token=getUrlParameter("token");
  var newchangepassword_new_password=$("#newchangepassword_new_password").val();
  var newchangepassword_confirm_password=$("#newchangepassword_confirm_password").val();
  // alert(token);
  $.ajax({
      type:"POST",
      url:url+"LoginController/resetPassword",
      dataType : 'json',
      cache :false,
      data: {newchangepassword_new_password:newchangepassword_new_password,newchangepassword_confirm_password:newchangepassword_confirm_password,code:token},
      success: function(result)
      {
      if(result.success==true)
      {
       $('#newchangepassword-msg').hide().fadeIn('slow').delay(350).fadeOut('slow');
       $("#newchangepassword-msg").html("<div class='alert alert-success'>"+result.message+"</div>");
       $('#newchangepassword_form')[0].reset();
       
      }else{
        $('#newchangepassword-msg').hide().fadeIn('slow').delay(350).fadeOut('slow');
       $("#newchangepassword-msg").html("<div class='alert alert-danger'>"+result.message+"</div>");

      }
      
    },
    failure: function (result)
    {
       $('#newchangepassword-msg').hide().fadeIn('slow').delay(350).fadeOut('slow');
      $( "#newchangepassword-msg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ..</div>");
    }   
  });
});









  

});
