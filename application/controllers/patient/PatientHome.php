<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH.'controllers/patient/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;
class PatientHome extends BaseController {
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url','captcha','html','language','security','util_helper'));
		$this->load->library(array('session','email','ion_auth','ValidationTypes'));
		$this->load->database();
		$this->load->model('User');
		
	   }	
	public function Dashboard()
	 {
		$this->load->view('patient/dashboard');
	 }

}
?>