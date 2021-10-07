<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class LoginController extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url','captcha','html','language','security','util_helper'));
		$this->load->library(array('session','email','ion_auth','ValidationTypes'));
		$this->load->database();
		$this->load->model('User');
		$this->load->model('Address_model');
		$this->load->model('Userdetails_model'); 
	 }

   public function registerView()
	{
		$this->load->view('registerview.php');
	}

    public function loginView()
	{
		$this->load->view('loginview.php');
	}

function changePassword(){
		
	$old_password		       			= $this->input->post("old_password");
	$new_password 		    			= $this->input->post("new_password");
	$confirm_password		            = $this->input->post("confirm_password");
	
	$identity = $this->session->userdata('identity');

	// echo $identitypass = $this->session->userdata('password');  
	// if ( $identitypass == null || $identitypass!=$old_password){
	// echo json_encode(array('success'=>false,'message'=>INVALID_PASSWORD_MSG));
	// return;
	// }


    $postData=array();
    $changepassdata = [];
    $postData = dataFieldValidation($new_password, "New Password", $changepassdata, "password",  [ValidationTypes::REQUIRED],$postData,"postDataArray");

	if(isset($postData['errorslist']) && is_array($postData['errorslist'])){
	echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
	return;
	 }
     $change = $this->ion_auth->change_password($identity,$old_password,$new_password);
			if ($change)
			{
				echo json_encode(array('success'=>true,'message'=>PASSWORD_CHANGED));
				return;
			}
			else
			{
				echo json_encode(array('success'=>false,'message'=>PASSWORD_NOTCHANGED));
			return;
			}

}
   
public function logout(){
            $this->ion_auth->logout();
		    echo json_encode(array('success'=>true,'message'=>'Logout Successfully'));
        }

public function login(){
		try{
			log_custom_message("Login Method Called");
			// if($this->is_user_logged_in) {
			// 	$data = [
			// 			'user_id'  => $this->auth_user_id,
			// 			'username' => $this->auth_username,
			// 			'user_roles'    => $this->auth_user_roles,
			// 			'issuperadmin'     => $this->issuperadmin,
			// 			'email'    => $this->auth_email,
			// 			'profile_pic_path'=>$this->profile_pic_path,
			// 			'name'=>$this->name,
						
			// 		];
			// 	echo json_encode(array("success"=> true, "data" => $data));
			// 	return;
			// }
			
			$postdata = file_get_contents("php://input");
			$data = json_decode($postdata);
		    // print_r($data);
			// echo $data->email;
			
			$dbData = [];
			$loginData=array();
			$loginData = dataFieldValidation($data->user_email, 'Email', $dbData, "email",[ValidationTypes::REQUIRED], $loginData, "loginArray");
			$loginData = dataFieldValidation($data->password, 'Password', $dbData, "password",[ValidationTypes::REQUIRED], $loginData, "loginArray");
			
			if(isset($postData['errorslist']) && is_array($errors['errorslist'])){
				if(count($errors['errorslist'])>0){
					echo json_encode(array('success'=>false,'message'=>$errors['errorslist']));
					return;
				}
			}
			
			 $username  = isset($data->user_email) ? $data->user_email : '';
			 $password = isset($data->password) ? $data->password : '';
			
			
			$remember = false;
			if (isset($data->rememberme)){
				$remember = $data->rememberme;
			}
			
			if (empty($username) || empty($password))
			{   
				echo json_encode(array('success'=>false,'message'=>"Please Enetre Username or Password"));
				return;
			}
		    			
			$usr_result=$this->ion_auth->login($username, $password, $remember);
			
			if ($usr_result==1) //active user record is present
			{
				$user = User::with('userdetails')->find($this->ion_auth->get_user_id());
				if($user->Userdetails->profile_pic_path === null || strlen($user->Userdetails->profile_pic_path) === 0){
					$user->Userdetails->profile_pic_path = 'assets/backend/images/adminnew.jpg';
				}
				$user_id=$this->ion_auth->get_user_id();
				$username = $user->username;
				$email = $user->email;
				$name = trim($user->Userdetails->first_name . ' ' . $user->Userdetails->last_name);
				$mobileno = $user->Userdetails->mobileno ;
				$issuperadmin = $this->ion_auth->is_admin();
				
				if($issuperadmin){
					$userroles = 'Admin';
					
				}
				else{
					$userroledata=User::userAccountsRole($this->ion_auth->get_user_id());
					foreach($userroledata as $value){
						 $userroles=$value->name;
					}
				}
				//set the session variables

				$sessiondata = [
					'user_id'  => $this->ion_auth->get_user_id(),
					'username' => $username,
					'issuperadmin' => $issuperadmin,
					'user_roles' => $userroles,
					'email'    => $email,
					'mobileno' =>$mobileno,
					'profile_pic_path'=> $user->Userdetails->profile_pic_path,
					'name'=>$name,
				];
				
				$this->session->set_userdata($sessiondata);
				echo json_encode( array("success"=> true, 'data'=>$sessiondata));
				return;
			}
			else
			{
				if (strpos($this->ion_auth->errors(),"Account is inactive") > 0){
					echo json_encode(array("success"=> false, 'message'=> "Your account is inactive. Please contact administrator."));
					return;
				} else {
					echo json_encode(array("success"=> false, 'message'=> "Incorrect Username or Password"));
					return;
				}
			}		
		
		}catch(Exception $ex){
			 log_custom_message("Error:" . $ex. print_r($_REQUEST, TRUE)
							. "\nJSON Data:\n" . file_get_contents("php://input"));
		}
	}	

	 
	public function saveCustomerSignup(){
			$customer_fname       			           = $this->input->post("add_customer_fname");
			$customer_mobileno       			       = $this->input->post("add_customer_mobileno");
			$customer_email       				       = $this->input->post("add_customer_email");
			$customer_password       			       = $this->input->post("add_customer_password");
			$customer_confirmpassword       		   = $this->input->post("add_customer_confirmpassword"); 
            $customer_role       		               = 3; 

            $result=uniqueMail($customer_email);
			if($result>0)
			{
				echo json_encode(array('success'=>false,'message'=>EMAIL_EXISTS_MSG));
				return; 
			}
            
            $id=null;
			$result= uniqueUserName($customer_mobileno,$id);
			if($result>0)
			{
				echo json_encode(array('success'=>false,'message'=>EMPID_EXISTS_MSG));
				return;
			}
		
		   $userId = null;	
           $postData=array();
           $customerdata = [];
          // $postData = dataFieldValidation($customer_password, "Password",$customerdata,"password",[ValidationTypes::REQUIRED], $postData,"customerdataarray");
          // $postData = dataFieldValidation($customer_email, "Email",$customerdata,"email",[ValidationTypes::REQUIRED],$postData,"customerdataarray");
          // $postData = dataFieldValidation($customer_mobileno, "User ID",$employeesdata,"username",[ValidationTypes::REQUIRED],$postData,"employeesdataarray");
          $postData= dataFieldValidation($customer_role, "Role ID",$customerdata,"role_id",[ValidationTypes::REQUIRED],$postData,"customerdataarray");
       

          $customerdetails=[];
         $postData = dataFieldValidation($customer_fname, "First Name",$customerdetails,"first_name",[ValidationTypes::REQUIRED],$postData,"customerdetailsarray");
         $postData = dataFieldValidation($customer_mobileno, "Mobile No",$customerdetails,"mobileno",[ValidationTypes::REQUIRED], $postData,"customerdetailsarray");
	    
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
        
        $createdlog=isCreatedLog($userId);
		$employeedata=$postData['dbinput']['customerdataarray'];
		$group = array($customer_role); 
		$userid=$this->ion_auth->register($customer_mobileno,$customer_password,$customer_email,$employeedata,$group);
       
        $customerAddressarray=array_merge($postData['dbinput'],$createdlog);
        $addressid = $this->Address_model->addAddress($customerAddressarray);

        $userdetailsarray = array_merge( array('address_id'=>$addressid,'user_id'=>$userid),$postData['dbinput']['customerdetailsarray']);
	    $userdata_save = $this->Userdetails_model->addUserDetails($userdetailsarray);
            if($userdata_save){
               	echo json_encode(array('success'=>true,'message'=>SAVE_MSG));
				return;
			}
			else
			{
				echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				return;
			}	
        }




public function forgotpassword(){
	
		$email = $this->input->post('forgotpassword_user_email');
		 //$email=$email;
		// die();
		  $resetpasswordcheck=$this->User->resetPassword($email);
		if($resetpasswordcheck<=0){
			echo json_encode(array('success'=>false,'message'=>EMAIL_DOESNT_MATCH));
			return;
		}
		else{
			$forgotten = $this->ion_auth->forgotten_password($email);
			$useremaildata=$this->User->findByEmail($email);

			if ($useremaildata == null || count($useremaildata) <= 0){
				echo json_encode(array('success'=>false,'message'=>INVALID_EMAIL_MSG));
				return;
			}
            $name=$useremaildata[0]['first_name'].' '.$useremaildata[0]['last_name'];
            // echo $email=$useremaildata[0]['email'];
			$subject='Reset Password from True Cabs';
			$url = getHostURL(true).'Welcome/ChangePasswordView?token='.$forgotten['forgotten_password_code'];
			$message='<h1> Hi, '.$name.'</h1>
				<p> One last step is required </p>
				<p>Please click on the following link to forgot password your account</p>
				<p><a href='.$url.'> click here </a></p><br>
				<p>Thank You</p>';
				$attachament =null;
			if(sendEmail("truecabs2020@gmail.com","True Cabs",$email,$subject,$message,$attachament) && $forgotten){
				echo json_encode(array('success'=>true,'message'=>EMAIL_RESET_LINK));
                
			}
		}
	}

// public function testemail(){
//         $email="tbbrao1991@gmail.com";
//         $subject="hello";
//         $message="test";
//         $attachament=null;
       
// 	echo $x= sendEmail("tbbrao1991@gmail.com.com","Hospital Project",$email,$subject,$message,$attachament);
// }





function resetPassword(){
	    $code=$this->input->post('code');
		$newpassword = $this->input->post('newchangepassword_new_password');
		$confirmpassword = $this->input->post('newchangepassword_confirm_password');
		// die();
	 $reset = $this->ion_auth->forgotten_password_complete($code);
	//  print_r($reset);
	// echo $identity= $reset->email ;
	//  $oldpassword=$reset->password;
	//  echo $normalpassword = Password($oldpassword);

		if ($reset){ 
		 //if the reset worked then send them to the login page
			 // $identity= $reset->email ;
	   //       $oldpassword=$reset->password;
			// $result=$this->ion_auth_model->reset_password($identity,$newpassword);

			$result=$this->ion_auth_model->change_password($reset['identity'], $reset['new_password'], $newpassword);
	// 		echo json_encode(array('success'=>true,'message'=>PWD_CHANGE_MSG, 'url'=>getHostURL().'login'));
	// 		return;

            if($result){
		            	echo json_encode(array('success'=>true,'message'=>PWD_CHANGE_MSG, 'url'=>getHostURL().'Home'));
					    return;
		          }else{
			         echo json_encode(array('success'=>false,'message'=>INVALID_PASSWORD_MSG));
			         return;
		        } 
			
		}
		else { //if the reset didnt work then send them back to the forgot password page
			echo json_encode(array('success'=>false,'message'=>INVALID_TOKEN_MSG));
			return;
		}
		
	}

	


















} ?>


