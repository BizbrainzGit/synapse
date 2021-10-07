<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent;
 use Illuminate\Database\Capsule\Manager as Capsule;
 use Illuminate\Database\Query\Expression as raw;
class User extends Eloquent {
    public $timestamps = false;
    protected $table = "users"; // table name
    public $primaryKey = 'id';
    protected $fillable = ['ip_address','username','password','salt','email','activation_code','forgotten_password_code','forgotten_password_time','remember_code','created_on','last_login','active','first_name','last_name','company','phone','role_id'];

	// public function DriversList()
	// {
	// 	$result=self::join('user_details','user_details.user_id','=','users.id')
	// 	            ->where('users.role_id','=',"2")->orderBy('username')->get();
	// 	return $result;
	// }

	public function userdetails() {
		return $this->hasOne('Userdetails_model','user_id');
	}
	
	public function address() {
		return $this->hasOne('Address_model','id','address_id')->select('id','address','street','city','state','country','pincode');
	}
	
	public static function userAccountsRole($id)
	{
		$userroledata = self::join('groups','groups.id','=','users.role_id')->where('users.id','=',$id)->select('users.id as user_id','role_id','groups.name')->get();
		return $userroledata;
	}
	
	
	public function userdetailsmin() {
		return $this->hasOne('Userdetails_model','user_id')->select(['first_name','last_name','mobileno','profile_pic_path']);
	}
	
	public static function findByEmail($email){
		
		$userdata = self::join('user_details','user_details.user_id','=','users.id')->where('email','=',$email)->get(['users.id','users.username','users.active','user_details.first_name','user_details.last_name']);
		return $userdata; 
	}
	public static function findById($id){
		
		$userdata = self::join('user_details','user_details.user_id','=','users.id')->where('users.id','=',$id)->get(['users.id','users.username','users.active','user_details.first_name','user_details.last_name']);
		return $userdata; 
	}
	
	public function getUserByIdData($user_id){
		try{
			$baseurl=getBaseURL(true);
			$userdata=self::join('user_details','user_details.user_id','=','users.id')
						->where('users.id',$user_id)
						->get(['users.id','users.email','users.username','users.active as status','user_details.first_name','user_details.last_name','user_details.mobileno',new raw('IF(user_details.profile_pic_path IS NULL OR user_details.profile_pic_path = "",NULL,concat("'.$baseurl.'","",user_details.profile_pic_path)) as profile_pic_path'),'user_details.address_id','user_details.dob','user_details.set_language','user_details.time_zone_id']);
			//$userdata=self::with('address')->find($user_id);
			
			return 	$userdata[0];		
		}
		catch(Exception $ex){
			throw new Exception($ex); //return false;
		}
	}
	
	public function createUsers($userarray)
	{
		$createusers = self::create($userarray);
		$userid = $createusers->id;
		return $userid;
	} 
	public function updateUsersdata($usersdata,$user_id)
	{
		$updateUsersdata = self::where('users.id','=',$user_id)->update($usersdata);
		return $updateUsersdata;
	} 
	
	public function updateUserData($data,$user_id){
		try{
			
		 return self::where('id','=',$user_id)->Update($data); 
		
		}
		catch(Exception $ex){
			throw new Exception($ex); //return false;
		}
	}
	public function deleteUserById($user_id){
		
		$userDelete=self::where('id','=',$user_id)->Delete();
		return $userDelete;
	}

	function updateStatus($statusarray,$employees_status_id){
	$resultupdate=self::where('id','=',$employees_status_id)->update($statusarray);
        return $resultupdate;

		}

   // Forgot Password 
		
    public function resetPassword($email){
		
		$emaildatacount=self::where('users.email','=',$email)->count();
		return $emaildatacount;
	
	}

		
}

?>