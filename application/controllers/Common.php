<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
use Illuminate\Database\Query\Expression as raw;
use \Illuminate\Database\Capsule\Manager as Capsule;
class Common extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url','captcha','html','language','security','util_helper'));
		$this->load->library(array('session','email','ion_auth','ValidationTypes'));
		$this->load->database();
		$this->load->model('User');
		$this->load->model('Userdetails_model');
		// $this->load->model('Cities_model');
		// $this->load->model('States_model');
		
	   }

		

		
		public function getCity()
		{
		 $cityname =$this->Cities_model->CityList();//fetching from database table
		 echo json_encode(array('data'=>$cityname));
		 return;
		}
	
	   public function getState()
		{
			 $statename = $this->States_model->StateList();
			 echo json_encode(array('data'=>$statename));
			 return;
		}
	

		 public function getVehicleType()
		{
			 $vechiletypename = $this->VehicleTypes_model->VehicleTypeForCustomer();
			 echo json_encode(array('data'=>$vechiletypename));
			 return;
		}


     public function getDriversList()
		{
			 $drivers = $this->ManageDriver_model->DriversList();
			 echo json_encode(array('data'=>$drivers));
			 return;
		}

		public function getCustomersList()
		{
			 $customers = $this->Userdetails_model->GetCustomersList();
			 echo json_encode(array('data'=>$customers));
			 return;
		}	


    public function getVehicleListForRoute($driverId)
		{    
		  $userrole=$this->session->userdata('user_roles');
           if($userrole=="Driver"){
                  $id=$this->ion_auth->get_user_id();
               }else{
               	   if($driverId==0){
                            $id="";
               	       }else{
               	      	    $id=$driverId;
               	      }
               } 
			 $vechilename = $this->Vehicles_model->VehiclesList($id);
			 echo json_encode(array('data'=>$vechilename));
			 return;
		}

	public function getVehicleRouteList()
		{
			$userrole=$this->session->userdata('user_roles');
            if($userrole=="Driver"){
              $id=$this->ion_auth->get_user_id();
               }else{
                 $id="";
               } 
			 $vehicleroute = $this->VehicleRoute_model->VehicleRouteTypeList($id);
			 echo json_encode(array('success'=>true,'data'=>$vehicleroute));
			 return;
		}		
    


    public function getPickupPoints()
		{
		  $userrole=$this->session->userdata('user_roles');
            if($userrole=="Driver"){
               $id=$this->ion_auth->get_user_id();
              }else{
               $id="";
               }
		 $PickupPoint =$this->PickupPoints_model->PickupPointsListView($id);//fetching from database table
		 echo json_encode(array('data'=>$PickupPoint));
		 return;
		}


  public function getPaymenttype()
		{
		 $paymenttype = $this->PaymentType_model->PaymentTypeList();//fetching from database table
		 echo json_encode(array('data'=>$paymenttype));
		 return;
		}
		

public function getBookingTypes()
		{
			 $Bookingtype = $this->TripTypes_model->BookingTypesList();
			 echo json_encode(array('data'=>$Bookingtype));
			 return;
		}	
		

 public function getGoodsList()
		{
			 $drivers = $this->Goods_model->GoodsList();
			 echo json_encode(array('data'=>$drivers));
			 return;
		}

  public function getDistrict($stateId)
		  {
               // echo $stateId;

		     if($stateId==0){
		     	 // echo $stateId;
				 $districtname = $this->District_model->DistrictList();
			 }else{
			 	 // echo "dwdw";
				 $districtname = $this->District_model->DistrictListByStateId($stateId);//fetching from database table
			 }
			 echo json_encode(array('data'=>$districtname));
			 return;
		}

		 public function getMandal($districtId)
		{    
			  if($districtId==0){
				   $mandalname = $this->Mandal_model->MandalList();
			 }else{
				  $mandalname = $this->Mandal_model->MandalListBydistrictId($districtId);//fetching from database table
			 }
			 echo json_encode(array('data'=>$mandalname));
			 return;
		}


		 public function getSearchLocationsList()
		{
			 $locations = $this->Location_model->SearchLocationsForCustomer();
			 echo json_encode(array('data'=>$locations));
			 return;
		}
      
       public function getAdvertiseBannerLeftSide()
		{
			 $leftside = $this->AdvertiseBanner_model->advertisebannerForFontView();
			 echo json_encode(array('data'=>$leftside));
			 return;
		}
		 public function getAdvertiseBannerRightSide()
		{
			 $rightside = $this->AdvertiseBanner_model->advertisebannerForFontView();
			 echo json_encode(array('data'=>$rightside));
			 return;
		}

}
?>
