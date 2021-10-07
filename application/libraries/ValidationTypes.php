<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ValidationTypes {
	
	const EMAIL                =   "email";
    const PASSWORD             =   "password";
	const REQUIRED    	       =   "required";
	const MIN_LENGTH           =   "minlength";
	const MAX_LENGTH           =   "maxlength";
	const MIN_MAX_PASSWORD     =   "minmaxpassword";
	const INPUT_NUMBER         = "inputnumber";
	const INPUT_STRING         = "inputstring";
	const URL                  = "url";
	const IPADDRESS            = "ipaddress";
	const INPUT_DATE           = "inputdate";
	const INPUT_NAME           = "fieldname";
}
?>