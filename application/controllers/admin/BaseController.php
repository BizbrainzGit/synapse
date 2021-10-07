<?php
// defined('BASEPATH') OR exit('No direct script access allowed');
// include_once(APPPATH.'controllers/CommonBaseController.php');
// class BaseController extends CommonBaseController {
//     public function __construct($redirectType = "Angular" ){
        
// 	parent::__construct();
//     $test=$this->session->userdata('is_admin');
// 	if(empty($test) || $test != true){
// 	$protocal = (isset($_SERVER['SERVER_PROTOCAL']) ? $_SERVER['SERVER_PROTOCAL'] : 'HTTP/1.0');
// 	if($redirectType == "Normal"){
//     header('Location:'.base_url(),null,302);
//     }else{
//     header($protocal.' 304 '.'/',base_url());
//     }
// 	die();
// 	}
//  }

// }
?>

<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Query\Expression as raw;
include_once(APPPATH . 'controllers/CommonBaseController.php');
class BaseController extends CommonBaseController {

	public function __construct($redirectType = "Angular")
	{
		parent::__construct($redirectType);
		//echo $this->is_user_logged_in;die();
		if(!isset($this->session->userdata) ||  strlen($this->session->userdata('user_roles')) == 0 || $this->session->userdata('user_roles')!='Admin') {
			$protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
			if ($redirectType == "Normal"){
				echo json_encode(array('success'=>false,'message'=>"Incorrect Username or Password"));
			} else{
				
				header($this->cprotocol . ' 401');
			}
			writeLogsAndDie();
		}
	}
}
?>