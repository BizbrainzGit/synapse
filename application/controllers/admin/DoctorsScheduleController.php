<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH.'controllers/admin/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;
class DoctorsScheduleController extends BaseController {
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url','captcha','html','language','security','util_helper'));
		$this->load->library(array('session','email','ion_auth','ValidationTypes'));
		$this->load->database();
		$this->load->model('DoctorsSchedule_model');
	   }

	public function DoctorsScheduleView()
	 {
		$this->load->view('admin/doctorscheduleview');
	 }

    public function SearchDoctorsScheduleList()
	   {
		    $searchlist = $this->DoctorsSchedule_model->SearchDoctorsSchedule();
			echo json_encode(array('success'=>true,'data'=>$searchlist));
	  }


 public function EditDoctorsScheduleByid($id)
		{
		   $editresult=$this->DoctorsSchedule_model->EditDoctorsSchedule($id);
		   echo json_encode(array('success'=>true,'data'=>$editresult));
        }



public function UpdateDoctorsSchedules(){

        $id                                  = $this->input->post("edit_doctorschedules_id");
        $doctorschedules_doctoruserid        = $this->input->post("edit_doctorschedules_doctoruserid");
        $doctorschedules_day                 = $this->input->post("edit_doctorschedules_day"); 
        $doctorschedules_starttime           = $this->input->post("edit_doctorschedules_starttime");
		$doctorschedules_endtime             = $this->input->post("edit_doctorschedules_endtime"); 
		$doctorschedules_perpatienttime      = $this->input->post("edit_doctorschedules_perpatienttime");
		$doctorschedules_status              = $this->input->post("edit_doctorschedules_status");  
				
          $postData=array();

		  $doctortimescheduledata = [];
          $postData = dataFieldValidation($doctorschedules_doctoruserid, "Doctor Name",$doctortimescheduledata,"doctors_id","",$postData,"doctortimeschedulearray");
          $postData = dataFieldValidation($doctorschedules_day, "Week Days",$doctortimescheduledata,"weekday","",$postData,"doctortimeschedulearray");
          $postData = dataFieldValidation($doctorschedules_starttime, "Start Time",$doctortimescheduledata,"start_time","",$postData,"doctortimeschedulearray");
          $postData = dataFieldValidation($doctorschedules_endtime, "Patinet Time",$doctortimescheduledata,"end_time","",$postData,"doctortimeschedulearray");
          $postData = dataFieldValidation($doctorschedules_perpatienttime, "Per Patient Time",$doctortimescheduledata,"per_patient_time","",$postData,"doctortimeschedulearray");
          $postData = dataFieldValidation($doctorschedules_status, "Schedule Status",$doctortimescheduledata,"schedule_status","",$postData,"doctortimeschedulearray");
	
			if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
				echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
				return;
			}


           $userId = $this->ion_auth->get_user_id();
           $updatedlog=isUpdateLog($userId);	 
		   $doctortimeschedulearray = array_merge($postData['dbinput']['doctortimeschedulearray'],$updatedlog);
		   $updateDoctorTimeschedule= $this->DoctorsSchedule_model->UpdateDoctorsSchedule($doctortimeschedulearray,$id);
				 

	               if($updateDoctorTimeschedule){
			               	echo json_encode(array('success'=>true,'message'=>UPDATE_MSG));
							return;
				     }else{
							echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
							return;
				    }

			

        }


public function SaveDoctorsSchedules(){

        $doctorschedules_doctoruserid        = $this->input->post("add_doctorschedules_doctoruserid");
        $doctorschedules_day                 = $this->input->post("add_doctorschedules_day"); 
        $doctorschedules_starttime           = $this->input->post("add_doctorschedules_starttime");
		$doctorschedules_endtime             = $this->input->post("add_doctorschedules_endtime"); 
		$doctorschedules_perpatienttime      = $this->input->post("add_doctorschedules_perpatienttime");
		$doctorschedules_status              = $this->input->post("add_doctorschedules_status"); 
			

		// $result=$this->DoctorsSchedule_model->CheckDoctorTimeSchedule($doctorschedules_doctoruserid,$doctorschedules_day,$doctorschedules_starttime,$doctorschedules_perpatienttime,$doctorschedules_status);
		// 	if($result>0)
		// 	{
		// 		echo json_encode(array('success'=>false,'message'=>"Doctor Have Already Scheduled..."));
		// 		return; 
		// 	}
         
          $postData=array();
		  $doctortimescheduledata = [];
          $postData = dataFieldValidation($doctorschedules_doctoruserid, "Doctor Name",$doctortimescheduledata,"doctors_id","",$postData,"doctortimeschedulearray");

          $postData = dataFieldValidation($doctorschedules_day, "Week Days",$doctortimescheduledata,"weekday","",$postData,"doctortimeschedulearray");

          $postData = dataFieldValidation($doctorschedules_starttime, "Start Time",$doctortimescheduledata,"start_time","",$postData,"doctortimeschedulearray");

          $postData = dataFieldValidation($doctorschedules_endtime, "End Time",$doctortimescheduledata,"end_time","",$postData,"doctortimeschedulearray");

          $postData = dataFieldValidation($doctorschedules_perpatienttime, "Per Patient Time",$doctortimescheduledata,"per_patient_time","",$postData,"doctortimeschedulearray");

          $postData = dataFieldValidation($doctorschedules_status, "Status",$doctortimescheduledata,"schedule_status","",$postData,"doctortimeschedulearray");
          
	
			if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
				echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
				return;
			}


           $userId = $this->ion_auth->get_user_id();
           $createdlog=isCreatedLog($userId);	 
		   $doctortimeschedulearray = array_merge($postData['dbinput']['doctortimeschedulearray'],$createdlog);
		   $addDoctorTimeschedule= $this->DoctorsSchedule_model->AddDoctorsSchedule($doctortimeschedulearray);
				 
           if($addDoctorTimeschedule){
	               	echo json_encode(array('success'=>true,'message'=>SAVE_MSG));
					return;
		     }else{
					echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
					return;
		    }

			

        }

public function DeleteDoctorsScheduleById($id){ 

               if(isset($id)&&$id>0){

				       	$deleteresult = $this->DoctorsSchedule_model->DeleteDoctorsSchedule($id);
					      if($deleteresult){
					   	         echo json_encode(array('success'=>true,'message'=>DELTE_MSG));
					   	         return;
					         }else{
		                         echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
								return;
		                      }
				      }else{

			             echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
							return;
				     }
                    

         }








}
?>