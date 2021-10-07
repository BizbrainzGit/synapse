
<?php

defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH.'controllers/CommonBaseController.php');
class BaseController extends CommonBaseController {
   
    public function __construct($redirectType = "Angular" ){
    parent::__construct();
        
    if(!isset($this->session->userdata) ||  strlen($this->session->userdata('user_roles')) == 0 || $this->session->userdata('user_roles')!='Patient'){
        //$this->session->userdata('userroles');die();
        $protocal = (isset($_SERVER['SERVER_PROTOCAL']) ? $_SERVER['SERVER_PROTOCAL'] : 'HTTP/1.0');
        if($redirectType == "Normal"){
                header('Location:'.base_url(),null,302);
            }else{
                header($protocal.' 304 '.'/',base_url());
            }
        die();
    }
    }

}
?>