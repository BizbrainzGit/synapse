<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH.'controllers/admin/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;
class AdminHome extends BaseController {

	public function __construct(){
		
		parent::__construct();
		$this->load->helper(array('form', 'url','captcha','html','language','security','util_helper'));
		$this->load->library(array('session','email','ion_auth','ValidationTypes'));
		$this->load->database();
	   }	
	 
	public function Dashboard()
	 {
		$this->load->view('admin/dashboard');
	 }
}
?>