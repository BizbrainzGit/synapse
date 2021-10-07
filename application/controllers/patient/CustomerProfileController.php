<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
include_once(APPPATH.'controllers/customer/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;

class CustomerProfileController extends BaseController {
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url','captcha','html','language','util_helper'));
		$this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
		$this->load->database();
		$this->load->model('User');
		$this->load->model('Address_model');
	    $this->load->model('Userdetails_model');
		
	   }

 public function PatientDashbordView()
	{

		$this->load->view('customer/profileview');
	}

	
 
}

?>