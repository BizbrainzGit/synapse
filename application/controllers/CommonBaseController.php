

<?php defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
use Illuminate\Database\Query\Expression as raw;
use \Illuminate\Database\Capsule\Manager as Capsule;
class CommonBaseController extends MY_Controller {
    protected $redirectType;
    public $protocol = "";
    public function __construct($redirectType = "Normal"){ 
        $this->redirectType = $redirectType;
        ob_clean();
        parent::__construct();
        $this->load->library(array('form_validation'));
        $this->load->helper(array('url','html','form','Util','language'));
        session_write_close();
        $this->load->model('ActivityLogs_model');
        if ($this->config->item('maintanance') == TRUE && !in_array($_SERVER['REMOTE_ADDR'],explode(',',$this->config->item('maintananceallowips')))){
            echo MAINTANANCE_MSG; ## call view
            writeLogsAndDie();
        }
        
        
        if(!$this->is_user_logged_in) {
            if ($redirectType == "Normal"){
                echo json_encode(array('success'=>false,'message'=>"Incorrect Username or Password"));
                header('Location:'."/".base_url(),null,302);
                return;
            } else{
                header($this->cprotocol . ' 350 /');
            }
            writeLogsAndDie();
        }
        
        ob_clean();
         
        //code start - added by Neelesh on Dec 31st to log activites in the db
         if(is_null($this->is_user_logged_in) || $this->is_user_logged_in==0){
            $userId = 0;
         }else{
            $userId = $this->ion_auth->get_user_id();
         }
         $this->load->model('ActivityRequestMapping');
         $className = $this->router->class;
         $methodName = $this->router->method;
         $account_id = $this->session->userdata('auth_account_id');
         $pageData = ActivityRequestMapping::where('request_url', '=',$className."/".$methodName)->get(['activity_desc']);
         if(isset($pageData) && count($pageData) >0){
            $this->activity_log($pageData[0]->activity_desc,$_SERVER,$userId,$methodName,$account_id);
         }
         //code end

         //code added to define variable for exception handling
         $this->protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
        
    }
    
    private static function activity_log($pageData,$serverData,$userId,$methodName,$account_id=null){
        try{
            //echo $this->ion_auth->get_user_id();
            $headers = apache_request_headers();
            
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
                    $user_agent_activity='App';
            }
            else{
                $user_agent_activity='Web';
            }
            $activity_data['activity_desc'] = $pageData;
            if(isset($serverData['HTTP_REFERER'])){
                $refererUrl = $serverData['HTTP_REFERER'];
            }else{
                $refererUrl = '';
            }
            $activity_data['request_referer']= $refererUrl;
            $activity_data['request_url']= $serverData['REQUEST_URI'];
            $activity_data['request_type']= $serverData['REQUEST_METHOD'];
            $activity_data['request_ip']= $serverData['REMOTE_ADDR'];
            $activity_data['request_datetime'] = date('Y-m-d h:i:s');
            $activity_data['user_id'] = $userId;
            $activity_data['activity_method_name'] = $methodName;
            $activity_data['created_at'] = date('Y-m-d');
            $activity_data['created_ip'] = getUserIP();
            $activity_data['created_by'] = $userId;
            $activity_data['account_id'] = $account_id;
            $activity_data['user_agent_activity'] = $user_agent_activity;
            $userlogsId=ActivityLogs_model::createActivityLog($activity_data);
        }catch(Exception $ex){
            //var_dump($ex);
            header($this->protocol . ' 352 '.'/'.base_url());
        }               

    }
    
}