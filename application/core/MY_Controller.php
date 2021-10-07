<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	public $cprotocol;
	protected $is_user_logged_in = false;
	protected $auth_user_id, $auth_username, $auth_user_roles, $auth_email, $issuperadmin,$profile_pic_path;
	
	/**
	 * Class constructor
	 */
	public function __construct()
	{
		$this->cprotocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
		parent::__construct();
		if ($this->config->item('maintanance') == TRUE && !in_array($_SERVER['REMOTE_ADDR'],explode(',',$this->config->item('maintananceallowips')))){
			echo MAINTANANCE_MSG;
			return;
		}

		if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
			if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
				header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

			//header("Access-Control-Allow-Headers: {Content-Type, Accept, account" + isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']) ? ", $_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'] : "" + "}");
			if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
				header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
			exit(0);
		}
		$this->load->library(array('session','ion_auth'));
		$this->load->helper(array('jwt','authorization'));
		
		
		
		if(!$this->ion_auth->logged_in() || $this->session->userdata('email') == NULL || is_null($this->session->userdata('issuperadmin'))) {
			$headers = $this->input->request_headers();
			
			if ((array_key_exists('authorization', $headers) && !empty($headers['authorization'])) ||
				(array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) ||
				(array_key_exists('my_auth_token', $headers) && !empty($headers['my_auth_token']))) {
					
					$authToken = "";
					
					if (array_key_exists('authorization', $headers)){
						$authToken = $headers['authorization'];
					}
					else if (array_key_exists('Authorization', $headers)){
						$authToken = $headers['Authorization'];
					}
					else if (array_key_exists('my_auth_token', $headers)){
						$authToken = $headers['my_auth_token'];
					}
					
				$decodedToken = AUTHORIZATION::validateToken($authToken);
				if ($decodedToken != false){
					$this->load->model('Userdetails_model');
					$this->load->model('User');
					$authtokencheck=$this->Userdetails_model->getAuthTokenResult($authToken);
					if (isset($authtokencheck) && ($authtokencheck->count)==1){
						$user=User::find($authtokencheck->user_id);
						$email=$user->email;
						$this->load->model('Ion_auth_model');
						$remember=FALSE;
						$login=$this->Ion_auth_model->loginWithOutPassword($email,$remember);
						$this->setUserSessionData();
					}
				}
			}
		}
		
		if($this->ion_auth->logged_in() && $this->session->userdata('email') != NULL && is_null($this->session->userdata('issuperadmin')) == FALSE) {	
			$this->is_user_logged_in = true;
			
			if (!isset($this->session->userdata) || empty($this->session->userdata)){
				$this->setUserSessionData();
			}
			
			$this->auth_user_id = $this->session->userdata('user_id');
			$this->auth_username = $this->session->userdata('username');
			$this->auth_user_roles = $this->session->userdata('user_roles');
			$this->auth_email = $this->session->userdata('email');
			$this->issuperadmin = $this->session->userdata('issuperadmin');
			$this->profile_pic_path = $this->session->userdata('profile_pic_path');
			$this->name = $this->session->userdata('name');
			$this->city_id = $this->session->userdata('city_id');
			$this->config->set_item( 'auth_user_id',  $this->auth_user_id );
			$this->config->set_item( 'auth_username', $this->auth_username );
			$this->config->set_item( 'auth_user_roles',     $this->auth_user_roles );
			$this->config->set_item( 'auth_email',    $this->auth_email );
			$this->config->set_item( 'issuperadmin',    $this->issuperadmin );
			$this->config->set_item( 'profile_pic_path',    $this->profile_pic_path );
			$this->config->set_item( 'name',    $this->name );
			$this->load->vars([
					'auth_user_id'  => $this->auth_user_id,
					'auth_username' => $this->auth_username,
					'auth_user_roles'    => $this->auth_user_roles,
					'issuperadmin'     => $this->issuperadmin,
					'auth_email'    => $this->auth_email,
					'profile_pic_path'=> $this->profile_pic_path,
					'name'=>$this->name,
				]);
		}
	}
	
	function setUserSessionData(){
		$user = User::with('userdetails')->find($this->ion_auth->get_user_id());
		if($user->Userdetails->profile_pic_path === null || strlen($user->Userdetails->profile_pic_path) === 0){
			$user->Userdetails->profile_pic_path = '/assets/images/profile-img.jpg';
		}
		
		$username = $user->username;
		$email = $user->email;
		$name = trim($user->Userdetails->first_name . ' ' . $user->Userdetails->last_name);
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
			'profile_pic_path'=> $user->Userdetails->profile_pic_path,
			'name'=>$name,
		];
		$this->session->set_userdata($sessiondata);
	}
}