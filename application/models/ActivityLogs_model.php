<?php
include_once(APPPATH . 'models/CommonBase_model.php');

use \Illuminate\Database\Eloquent\Model as Eloquent;
use \Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;

class ActivityLogs_model extends CommonBase_model {
	public $timestamps = false;
	protected $table = 'activity_logs';
	protected $primaryKey = 'id';
	protected $fillable = ['user_id','account_id','activity_desc','activity_method_name','request_url','request_referer','request_type','data','request_ip','request_datetime','user_agent_activity','created_at','created_by','created_ip'];
    
	public static function createActivityLog($userlogarray){
		try{
			$userlogsId = self::create($userlogarray)->id;
			return $userlogsId;
		}
		catch(Exception $ex){
			throw new Exception($ex);	
		}
	}
	
    function getActivityLogsData($paging){
		$CI =& get_instance();
		$CI->load->model('Account_model');
		
		if (!isset($paging)){
			 $paging = new StdClass;
			 }
	   
			 if(!isset($paging->sortBy))
			 $paging->sortBy = 'id';
			 if(!isset($paging->sortDirection))
			 $paging->sortDirection = 'desc';
	   
			 if(!isset($paging->pageSize))
			 $paging->pageSize = 5;
	   
			 if(!isset($paging->page))
			 $paging->page = 1;


			$userslistids =isset($paging->search->userslist) ? $paging->search->userslist : [];
			$account_ids =isset($paging->search->account_ids) ? $paging->search->account_ids : '';
			
			$AccDbName  = $CI->Account_model->getDBName($account_ids);
	   		
			$activities = self::join('users','users.id','=','activity_logs.user_id')
			->join('user_details','users.id','=','user_details.user_id')
			->join('user_accounts','user_accounts.user_id','=','users.id')
			->leftjoin(new raw($AccDbName.'.user_business_groups ubg'),'users.id','=','ubg.user_id')
			->join(new raw($AccDbName.'.business_groups  bg'),'bg.id','=','ubg.business_group_id')
			->select('activity_logs.*',new Raw('DATE_FORMAT(request_datetime,"%m/%d/%Y %H:%i:%s") as  request_datetime'),new raw("concat(user_details.first_name,' ',user_details.last_name) as firstname"),new raw('ubg.business_group_id as business_group_id'),new raw('bg.group_name as business_group'));
			
	   		$actcount = self::join('users','users.id','=','activity_logs.user_id')
			->join('user_details','users.id','=','user_details.user_id')
			->join('user_accounts','user_accounts.user_id','=','users.id')
			->leftjoin(new raw($AccDbName.'.user_business_groups ubg'),'users.id','=','ubg.user_id')
			->join(new raw($AccDbName.'.business_groups  bg'),'bg.id','=','ubg.business_group_id')
			->select('activity_logs.*',new Raw('DATE_FORMAT(request_datetime,"%m/%d/%Y %H:%i:%s") as  request_datetime'),new raw("concat(user_details.first_name,' ',user_details.last_name) as firstname"),new raw('ubg.business_group_id as business_group_id'),new raw('bg.group_name as business_group'));
			
		 	if ((isset($paging->search->from_date) && !empty($paging->search->from_date) && isset($paging->search->to_date) && !empty($paging->search->to_date)))
		 	{		
		 	  $activities->whereBetween('activity_logs.created_at',array(date('Y-m-d',strtotime($paging->search->from_date)),date('Y-m-d',strtotime($paging->search->to_date))));	 
			  $actcount->whereBetween('activity_logs.created_at',array(date('Y-m-d',strtotime($paging->search->from_date)),date('Y-m-d',strtotime($paging->search->to_date))));	 
			}
			if(count($userslistids)>0 && is_array($userslistids)){				
			  $activities->whereIn('activity_logs.user_id',$userslistids);	
			  $actcount->whereIn('activity_logs.user_id',$userslistids);	  	
			}
			
			$activities->orderBy($paging->sortBy,$paging->sortDirection);
			
			if(!isset($paging->export_type)){
				$actrecords = $activities->skip($paging->page)->take($paging->pageSize)->get();
			}
			else{
				$actrecords = $activities->get();
			}
			/*if($paging->pageSize != '-1'){
			 $actrecords = $activities->skip($paging->pageSize * $paging->page)
			  ->take($paging->pageSize)->get();
			}else{
				$actrecords = $activities->get();
			}*/			  			
 			
		   $activitiescnt= $actcount->count();

		return (array('data'=>$actrecords,'TotalRecords'=>$activitiescnt));
	}
}

?>