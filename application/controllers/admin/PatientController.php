<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH.'controllers/admin/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;
class PatientController extends BaseController {

	public function __construct(){
		
		parent::__construct();
		$this->load->helper(array('form', 'url','captcha','html','language','security','util_helper'));
		$this->load->library(array('session','email','ion_auth','ValidationTypes'));
		$this->load->database();
		$this->load->model('Userdetails_model');
	   }	
	 
	public function AddPatientView()
	 {
		$this->load->view('admin/addpatientview');
	 }
	 public function PatientListView()
	 {
		$this->load->view('admin/patientlistview');
	 }


	  public function SearchPatientList()
	   {
		    $searchlist = $this->Userdetails_model->SearchPatientList();
			echo json_encode(array('success'=>true,'data'=>$searchlist));
	  }
  





	 
}
?>