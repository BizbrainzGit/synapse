<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Welcome extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url','captcha','html','language'));
		$this->load->library(array('session','email'));
		$this->load->database();
		
	}


	public function index()
	{
		$this->load->view('loginview.php');
	}
}
