<?php
include_once(APPPATH . 'models/CommonBase_model.php');
use \Illuminate\Database\Eloquent\Model as Eloquent;
use \Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;
class Userdetails_model extends CommonBase_model {
	public $timestamps = false;
	protected $table = 'user_details';
	protected $primaryKey = 'id';
	protected $fillable = ['user_id', 'address_id', 'first_name', 'last_name', 'mobileno', 'profile_pic_path','aadhaar_number','idproof_photo', 'created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];
	
// 	public function user()
// 	{
// 		return $this->belongsTo('User');
// 	}
	
// 	public function addUserDetails($userdetailsarray){
// 		try{
// 			$userDetailsId = self::create($userdetailsarray)->id;
// 			return $userDetailsId;
// 		}
// 		catch(Exception $ex){
// 			throw new Exception($ex);	
// 		}
//     }


//   function getAuthTokenResult($auth_token){
// 		$authtokencount=Capsule::Select("select count(*) as count,user_id from `user_details` where `auth_token`='".$auth_token."'");
// 		return $authtokencount[0];
// 	}

// 	function getAuthToken($user_id){
// 		$auth_token = self::where('user_id',$user_id)->first()->auth_token;
// 		if(isset($auth_token) && strlen($auth_token)>0){
// 			return $auth_token;
// 		}else{
// 			return null;
// 		}
// 	}


   

// public function EditUser($id)
// 	{
		
// 		$listresult = self::join('users','users.id','=','user_details.user_id')
// 						   ->join('address','address.id','=','user_details.address_id')
// 					       ->where('user_details.id','=',$id)
// 						   ->get(['user_details.id','email','user_details.first_name','user_details.last_name','user_details.mobileno','user_details.address_id','user_details.user_id','user_details.profile_pic_path','houseno', 'area', 'street','city_id', 'state_id','pincode','aadhaar_number','idproof_photo']);
// 		return $listresult;
		
// 	}


// 	function updateUserDetails($data,$user_id)
// 	{
// 		try{
			
// 		 return self::where('id','=',$user_id)->Update($data); 
		
// 		}
// 		catch(Exception $ex){
// 			throw new Exception($ex); //return false;
// 		}
		
// 	}


// function updateUserDetailsForToken($data,$user_id)
// 	{
// 		 $updateresult=self::where('user_details.user_id','=',$user_id)->Update($data); 
// 		 return$updateresult; 
		
// 	}

// function DeleteUser($id)
// 	{
// 			$deleteresult= self::where('id','=',$id)->delete();
// 		     return$deleteresult; 
// 	}


// public function DriverDetailsEdit($id)
// 	{
		
// 	   $listresult= self::join('users','users.id','=','user_details.user_id')
// 	   ->join('groups','groups.id','=','users.role_id')
// 	   ->join('drivers','drivers.user_id','=','user_details.user_id')
// 	   ->join('driver_images','driver_images.driver_id','=','drivers.user_id')
// 	   ->join('address','address.id','=','user_details.address_id')
// 	   ->leftjoin('cities','cities.cityid','=','user_details.address_id')
// 	   ->leftjoin('states','states.state_id','=','user_details.address_id')
// 	   ->where('user_details.id','=',$id)
// 	   ->get(['user_details.id','user_details.user_id','user_details.first_name','user_details.last_name','user_details.mobileno','user_details.profile_pic_path','drivers.license_number','drivers.license_expiry_date','drivers.expiry_reminder','drivers.gender','drivers.date_of_birth','driver_images.driver_license_front','driver_images.driver_id','driver_images.driver_license_back','user_details.address_id','address.houseno','address.area','address.street','address.city_id','cities.cityname','address.state_id','states.state_name','address.pincode','drivers.aadhaar_number','aadhaar_front_photo','aadhaar_back_photo','another_name','another_mobileno','another_aadhaarno','email']);
// 		return $listresult;
		
// 	}

// 	public function EditCustomerProfile($id)
// 	{
		
// 		$listresult = self::join('users','users.id','=','user_details.user_id')
// 						   ->join('address','address.id','=','user_details.address_id')
// 					       ->where('user_details.user_id','=',$id)
// 						   ->get(['user_details.id','email','user_details.first_name','user_details.last_name','user_details.mobileno','user_details.address_id','user_details.user_id','user_details.profile_pic_path','houseno', 'area', 'street','city_id', 'state_id','pincode','aadhaar_number','idproof_photo']);
// 		return $listresult;
		
// 	}
	  
// function TotalCountOfDriver()
// 	{
// 	  $result= self::Where('users.role_id','=',2)->Where('users.active','=',1)->join('users','users.id','=','user_details.user_id')
// 	   ->count();
// 		return $result;
// 	}
// function TotalCountOfCustomer()
// 	{
// 	  $result= self::Where('users.role_id','=',3)->Where('users.active','=',1)->join('users','users.id','=','user_details.user_id')
// 	   ->count();
// 		return $result;
// 	}



// 	function DriversList($search_name,$search_cityid,$search_mobilenumber,$search_stateid){
//         if($search_name!=''){
// 			$search_name="\n AND user_details.first_name like '%$search_name%' OR user_details.last_name like '%$search_name%' ";
// 		}else{
// 			$search_name="";
// 		} 

// 		if($search_mobilenumber!=''){
// 			$search_mobilenumber="\n AND user_details.mobileno like '%$search_mobilenumber%' ";
// 		}else{
// 			$search_mobilenumber="";
// 		} 
		
// 		 if($search_cityid!=''){
// 			$search_cityid="\n AND address.city_id ='$search_cityid'";
// 		}else{
// 			$search_cityid="";
// 		}

// 		 if($search_stateid!=''){
// 			$search_stateid="\n AND address.state_id ='$search_stateid'";
// 		}else{
// 			$search_stateid="";
// 		}

//       $searchData=Capsule::select(" SELECT user_details.id,CONCAT(user_details.first_name,' ',user_details.last_name) AS name ,users.email,users.active,users.role_id,user_details.mobileno,user_details.id, user_details.user_id,drivers.license_number, CONCAT(address.houseno ,' ',address.area,' ',address.street,' ',cities.cityname,' ',states.state_name,' ',address.pincode) AS driveraddress,cities.cityname,states.state_name
// 		from user_details
// 	    join users on users.id=user_details.user_id
// 	    join groups on groups.id=users.role_id
// 	    join drivers on drivers.user_id=user_details.user_id
// 	    join address on address.id=user_details.address_id 
// 	    left join cities on cities.cityid = address.city_id 
// 	    left join states on states.state_id = address.state_id
// 		WHERE user_details.id !=0 AND users.role_id=2".$search_name.$search_cityid.$search_mobilenumber.$search_stateid);     
// 	return $searchData;

// 	}

// 	 public function GetCustomersList(){
         
//        $listresult = self::join('users','users.id','=','user_details.user_id')
// 	   ->join('groups','groups.id','=','users.role_id')
// 	   ->where('users.role_id','=',3)
// 	   ->get(['user_details.id',new raw('CONCAT(user_details.first_name," ",user_details.last_name) AS name'),'users.email','users.active','users.role_id','user_details.mobileno','user_details.id', 'user_details.user_id']);
// 		return $listresult;
          
// 	}

// 	function CustomersList($search_name,$search_cityid,$customer_mobilenumber,$search_stateid){
         

//         if($search_name!=''){
// 			$search_name="\n AND (user_details.first_name like '%$search_name%' OR user_details.last_name like '%$search_name%') ";
// 		}else{
// 			$search_name="";
// 		}

// 		 if($customer_mobilenumber!=''){
// 			$customer_mobilenumber="\n AND user_details.mobileno like '%$customer_mobilenumber%' ";
// 		}else{
// 			$customer_mobilenumber="";
// 		} 
		
// 		 if($search_cityid!=''){
// 			$search_cityid="\n AND address.city_id ='$search_cityid'";
// 		}else{
// 			$search_cityid="";
// 		}
// 	if($search_stateid!=''){
// 			$search_stateid="\n AND address.state_id ='$search_stateid'";
// 		}else{
// 			$search_stateid="";
// 		}

//       $searchData=Capsule::select(" SELECT user_details.id,CONCAT(user_details.first_name,' ',user_details.last_name) AS name ,users.email,users.active,users.role_id,user_details.mobileno,user_details.id, user_details.user_id, CONCAT(address.houseno ,' ',address.area,' ',address.street,' ',cities.cityname,' ',states.state_name,' ',address.pincode) AS customeraddress, cities.cityname,users.active,
// 		states.state_name from user_details
// 	    join users on users.id=user_details.user_id
// 	    join groups on groups.id=users.role_id
// 	    left join address on address.id=user_details.address_id 
// 	    left join cities on cities.cityid = address.city_id 
// 	    left join states on states.state_id = address.state_id
// 		WHERE user_details.id !=0 AND users.role_id=3".$search_name.$search_cityid.$customer_mobilenumber.$search_stateid);     
// 	return $searchData;

// 	}



    
}

?>