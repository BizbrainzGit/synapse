<?php

require_once(APPPATH.'/hooks/custom_log.php');

function log_custom_message($str){
	$CI =& get_instance();
	
	$CI->custom_log_messages[] = date('Y-m-d H:i:s') . ' - ' . $str;
}

function writeLogsAndDie(){
	$clog = new Custom_log();
	$clog->logMessages();
	die();
}
/**
 * Calculate center of given coordinates
 * @param  array    $coordinates    Each array of coordinate pairs
 * @return array                    Center of coordinates
 */
function getCoordsCenter($coordinates) {    
    $lats = $lons = array();
   
    foreach ($coordinates as $key => $value) {
        //echo $value[0];die();
        array_push($lats, $value['lat']);
        array_push($lons, $value['lng']);
    }
    $minlat = min($lats);
    $maxlat = max($lats);
    $minlon = min($lons);
    $maxlon = max($lons);
    $lat = $maxlat - (($maxlat - $minlat) / 2);
    $lng = $maxlon - (($maxlon - $minlon) / 2);
    return array("lat" => $lat, "lng" => $lng);
}

/*
 inputFieldValidation function info:
 $postdata is $_POST / $_GET data from html form
 $postVar  is varible names from htm form
 $labelname  is used to render the lables
 $dbData is array and store the fields data 
 $dbVar is database column name
 $validations is validation formats
 $inputdata final return data array
 $tablename is optional or pass the tablename for 
*/

function inputFieldValidation($postdata, $postVar,$labelname=null, &$dbData, $dbVar, $validations,  $inputdata = null, $tablename = 'data'){
	
	if ($inputdata == null || empty($inputdata) || !is_array($inputdata)){
		$inputdata = [];
	}
	
	$val = 	isset($postdata[$postVar])? $postdata[$postVar] : NULL;

	$dbData[$dbVar] = $val;
    
	if(empty($validations)){
		$inputdata['dbinput'][$tablename] = $dbData;
		return $inputdata;
	}
	
	foreach($validations as $validation)
	{   
	    $dateformat = '';
		switch($validation)
		{
			case 'email':
				//if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
				if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$val)){
					$inputdata['errorslist'][]=$labelname."|".VALIDATION_MSG_EMAIL_FORMAT;	 
				}
			break;
			case 'password':
				
				if(!preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/', $val)){
					$inputdata['errorslist'][]=$labelname."|".VALIDATION_MSG_PASSWORD_MEET;	 
				}	
			break;
			case 'inputnumber':
				if (!filter_var($val, FILTER_VALIDATE_INT)) {
					$inputdata['errorslist'][]=$labelname."|".VALIDATION_MSG_INT;	 
				}
			break;
			case 'inputstring':
				if (!filter_var($val, FILTER_VALIDATE_STRING)) {
					$inputdata['errorslist'][]=$labelname."|".VALIDATION_MSG_STRING;	 
				}
			break;
			case 'url':
				if (!filter_var($val, FILTER_VALIDATE_URL)) {
					$inputdata['errorslist'][]=$labelname."|".VALIDATION_MSG_URL_ADDRESS;	 
				}
			break;
			case 'ipaddress':
				if (!filter_var($val, FILTER_VALIDATE_IP )) {
					$inputdata['errorslist'][]=$labelname."|".VALIDATION_MSG_IP_ADDRESS;	 
				}
			break;
			case 'inputdate':
			
				if(!isItValidDate($val)) 
				{
					$inputdata['errorslist'][]=$labelname."|".VALIDATION_MSG_DATE_FIELD;	 
				}
				$dateformat=1;
				
			break;	
			case 'required':
				if(empty($val)){
					$inputdata['errorslist'][]=$labelname."|".VALIDATION_MSG_REQUIRED_FIELD;
				}
			break;	
			case 'minmaxpassword':
				if(strlen($val) < 8)
				{
				   $inputdata['errorslist'][] = $labelname."|".VALIDATION_MSG_MIN_PASSWORD;
				}
				else if(strlen($val) > 20)
				{
				   $inputdata['errorslist'][] = $labelname."|".VALIDATION_MSG_MAX_PASSWORD;
				}
			break;
		    case 'minlength':
				if(strlen($val) < 6)
				{
				   $inputdata['errorslist'][] = $labelname."|".VALIDATION_MSG_MIN_LENGTH;
				}
			break;
			case 'maxlength':
				if(strlen($val) >20)
				{
				   $inputdata['errorslist'][] = $labelname."|".VALIDATION_MSG_MAX_LENGTH;
				}
			break;
			case 'fieldname':
				if (!preg_match('/^[\p{L} ]+$/u', $val)){
					$inputdata['errorslist'][] = $labelname.VALIDATION_MSG_INVALID_NAME;
				}
			break;	
		}
	}

	if($dateformat==1){
		
		//$dbData[$dbVar] = $val;
		$dateFormatCha	= date("Y-m-d", strtotime($val));
		$dbData[$dbVar] = $dateFormatCha;
		$inputdata['dbinput'][$tablename] = $dbData;
    }
	else
	{		
		$inputdata['dbinput'][$tablename] = $dbData;
	}
	
	return $inputdata;
}


function dataFieldValidation($inputdata, $labelname=null, &$dbData, $dbVar, $validations,  
                                           $returndata = null, $tablename = 'data')
	{
	
	if ($returndata == null || empty($returndata) || !is_array($returndata)){
		$returndata = [];
	}
	
	$val = 	$inputdata;
	$dbData[$dbVar] = $val;
    
	if(empty($validations)){
		$returndata['dbinput'][$tablename] = $dbData;
		return $returndata;
	}
	
	foreach($validations as $validation)
	{
		$dateformat=0;
		
		switch($validation)
		{
			case 'email':
				//if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
				if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$val)){
					$returndata['errorslist'][]=$labelname."|".VALIDATION_MSG_EMAIL_FORMAT;	 
				}
			break;
			case 'password':
				
				if(!preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/', $val)){
					$returndata['errorslist'][]=$labelname."|".VALIDATION_MSG_PASSWORD_MEET;	 
				}	
			break;
			case 'inputnumber':
				//if(!preg_match('/^[0-9]{10}$/',$val)){
				if (!filter_var($val, FILTER_VALIDATE_INT)) {
					$returndata['errorslist'][]=$labelname."|".VALIDATION_MSG_INT;	 
				}
			break;
			case 'inputstring':
				if (!filter_var($val, FILTER_VALIDATE_STRING)) {
					$returndata['errorslist'][]=$labelname."|".VALIDATION_MSG_STRING;	 
				}
			break;
			case 'url':
				if (!filter_var($val, FILTER_VALIDATE_URL)) {
					$returndata['errorslist'][]=$labelname."|".VALIDATION_MSG_URL_ADDRESS;	 
				}
			break;
			case 'ipaddress':
				if (!filter_var($val, FILTER_VALIDATE_IP )) {
					$returndata['errorslist'][]=$labelname."|".VALIDATION_MSG_IP_ADDRESS;	 
				}
			break;
			case 'inputdate':
				
				if(!isItValidDate($val)) 
				{   
					$returndata['errorslist'][]=$labelname."|".VALIDATION_MSG_DATE_FIELD;
					
				}
				$dateformat=1;
			
			break;	
			case 'required':
				if(empty($val)){
					$returndata['errorslist'][]=$labelname."|".VALIDATION_MSG_REQUIRED_FIELD;
				}
			break;	
			case 'minmaxpassword':
				if(strlen($val) < 8)
				{
				   $returndata['errorslist'][] = $labelname."|".VALIDATION_MSG_MIN_PASSWORD;
				}
				else if(strlen($val) > 20)
				{
				   $returndata['errorslist'][] = $labelname."|".VALIDATION_MSG_MAX_PASSWORD;
				}
			break;
		    case 'minlength':
				if(strlen($val) < 6)
				{
				   $returndata['errorslist'][] = $labelname."|".VALIDATION_MSG_MIN_LENGTH;
				}
			break;
			case 'maxlength':
				if(strlen($val) >20)
				{
				   $returndata['errorslist'][] = $labelname."|".VALIDATION_MSG_MAX_LENGTH;
				}
			break;
			case 'fieldname':
				if (!preg_match('/^[\p{L} ]+$/u', $val)){
					$returndata['errorslist'][] = $labelname."|".VALIDATION_MSG_INVALID_NAME;
				}
			break;	
		}
	}
	 
	
	if($dateformat==1){
		
		$dbData2=date("Y-m-d", strtotime($val));
		$dbData[$dbVar] = $dbData2;
		$returndata['dbinput'][$tablename] = $dbData;		
	}
	else{
		$returndata['dbinput'][$tablename] = $dbData;	
	}
	return $returndata;
}

function isItValidDate($date){
	//MM/DD/YYYY Format
	if(preg_match("/^(\d{2})\/(\d{2})\/(\d{4})$/", $date, $matches)) 
	{
		if(checkdate($matches[1], $matches[2], $matches[3]))
		{
		  return true;
		}
	}
}

function isCreatedLog($userid=null){
	
	$isCreatedArray=array('created_on'=>date("Y-m-d H:i:s"),'created_ip'=>getUserIP(),'created_by'=>$userid);
	return $isCreatedArray;
	
}

function isUpdateLog($userid=null){
	
	$isCreatedArray=array('modified_on'=>date("Y-m-d H:i:s"),'modified_ip'=>getUserIP(),'modified_by'=>$userid);
	return $isCreatedArray;
	
}
//find Address from Latitude and Longitude
function getAddressFromGoogle($lat,$lng)
{
	$CI=& get_instance();
	$url='https://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lat).','.trim($lng).'&key='.$CI->config->config["GOOGLE_API_KEY"].'&sensor=true';
	
	$json = @file_get_contents($url);
	$jsondata = json_decode($json,true);

	$status = $jsondata["status"];
	
	if($status=="OK"){
		$countrycode=getCountryCode($jsondata);
		$countryid=getCountryId($countrycode);
		$address = array('formatted_address'=>getFormattedAddressValue($jsondata),'address'=>getAddressValue($jsondata),'street' => getStreet($jsondata),'city' => getCity($jsondata),'state' => getState($jsondata),'pincode' => getPostalCode($jsondata),'country' =>$countryid,'countrycode'=>$countrycode,'geojson'=>$jsondata);
		return $address;
	}
	else{
		return array();
	}
}
//find Country ID from country code
function getCountryId($countrycode){
	$CI=& get_instance();
	$CI->load->database();
	$sql = "SELECT id FROM countries WHERE shortcode='".$countrycode."'"; 
	$query = $CI->db->query($sql);
	$countryid = $query->row()->id;
	return $countryid;
}
//get Address from Google Json data
function getAddressValue($jsondata) {
    return longNameGivenType("premise", $jsondata["results"][0]["address_components"]). ', ' .longNameGivenType("sublocality_level_2", $jsondata["results"][0]["address_components"]). ', ' .longNameGivenType("sublocality_level_3", $jsondata["results"][0]["address_components"]);
}
function getFormattedAddressValue($jsondata) {
    return $jsondata["results"][0]["formatted_address"];
}
function getCountry($jsondata) {
    return longNameGivenType("country", $jsondata["results"][0]["address_components"]);
}
function getState($jsondata){
    return longNameGivenType("administrative_area_level_1", $jsondata["results"][0]["address_components"], true);
}
function getCity($jsondata) {
    return longNameGivenType("locality", $jsondata["results"][0]["address_components"]);
}
function getStreet($jsondata) {
    return longNameGivenType("street_number", $jsondata["results"][0]["address_components"]) . ', ' . longNameGivenType("route", $jsondata["results"][0]["address_components"]). ', ' .longNameGivenType("sublocality_level_1", $jsondata["results"][0]["address_components"]);
}
function getPostalCode($jsondata) {
    return longNameGivenType("postal_code", $jsondata["results"][0]["address_components"]);
}
function getCountryCode($jsondata) {
    return longNameGivenType("country", $jsondata["results"][0]["address_components"], true);
}

/*
* Searching in Google Geo json, return the long name given the type. 
* (If short_name is true, return short name)
*/
function longNameGivenType($type, $array, $short_name = false) {
    foreach( $array as $value) {
        if (in_array($type, $value["types"])) {
            if ($short_name)    
                return $value["short_name"];
            return $value["long_name"];
        }
    }
}
//Distance Between two points
function getDistanceBetweenPoints($lat1, $lon1, $lat2, $lon2) {
   
	 $radius = 3959;  //approximate mean radius of the earth in miles, can change to any unit of measurement, will get results back in that unit

    $delta_Rad_Lat = deg2rad($lat2 - $lat1);  //Latitude delta in radians
    $delta_Rad_Lon = deg2rad($lon2 - $lon1);  //Longitude delta in radians
    $rad_Lat1 = deg2rad($lat1);  //Latitude 1 in radians
    $rad_Lat2 = deg2rad($lat2);  //Latitude 2 in radians

    $sq_Half_Chord = sin($delta_Rad_Lat / 2) * sin($delta_Rad_Lat / 2) + cos($rad_Lat1) * cos($rad_Lat2) * sin($delta_Rad_Lon / 2) * sin($delta_Rad_Lon / 2);  //Square of half the chord length
    $ang_Dist_Rad = 2 * asin(sqrt($sq_Half_Chord));  //Angular distance in radians
    $distance = $radius * $ang_Dist_Rad;  

    return $distance;  
}
function getRemoveCommas($str){
	$str = explode(",", str_replace(' ', '', $str));
	$string_new = '';
	foreach($str as $data)
	{
		if(!empty($data))
		{
			$string_new .= $data. ',';
		}
	}
	$string=substr_replace($string_new, '', -1);
	return $string;
}
function sendPushNotifications($devicetoken,$title,$message,$extraDetail = null){
	$CI=& get_instance();
	//$CI->load->database();
	//testing device token
	//$devicetoken = 'dgbhR7u4Xeo:APA91bEBXIeM77m_xMpYjUuxN1ew-TpP8NBHqCZJnHNW7KCgHIcXl34mRNq0Vl7uU2xG-cUWhXjTduOSci6DJk4xJ_LaC1j5wG0QXAqAf2Q_Y6OS-HIQbZIUJ4XmGFfySm6knByRnySO';
	 // API access key from Google API's Console
    $url = 'https://fcm.googleapis.com/fcm/send';

	
	$data = array (
					"title" => $title,
                    "body" => $message,
					"sound"=>"default"
            );
	$fields = array (
            'to' => $devicetoken,
            'notification' => $data,"time_to_live" => 3,"icon" => "ic_launcher"
    );
	
	/*
	$data = array (
					"title" => $title,
                    "text" => $message
            );*/
	/*
	$fields = array (
            'to' => $devicetoken,
            'data' => $data,"time_to_live" => 3,"icon" => "ic_launcher"
    );*/
	
	if ($extraDetail != null && is_array($extraDetail)){
		//$fields = array_merge($fields,$extraDetail);
		$fields["data"] = $extraDetail;
	}
	
	 //echo '<pre>';
	 //print_r($fields);die();
	
    $fields = json_encode($fields);
  
    $headers = array(
		'Authorization: key=' . $CI->config->config["pushserverkey"],
		'Content-Type: application/json'
    );
	
	//echo '<pre>';
	//print_r($headers);die();

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url );
    curl_setopt( $ch, CURLOPT_POST, true );
    curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $fields );
	
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

    $result = curl_exec ( $ch );
	
	//echo $result;
	
	if (curl_errno($ch)) { 
        //print "Error: " . curl_error($ch); 
		return false;
	} else {
		$result = json_decode($result);
		
		//echo '<pre>';
		//print_r($result);die();
		
		if ($result->success == 1){
			return true;
		} else {
			return false;
		}
	}
	
    curl_close ( $ch );
}
function sumTime($time1, $time2) {
      $times = array($time1, $time2);
      $seconds = 0;
      foreach ($times as $time)
      {
        list($hour,$minute,$second) = explode(':', $time);
        $seconds += $hour*3600;
        $seconds += $minute*60;
        $seconds += $second;
      }
      $hours = floor($seconds/3600);
      $seconds -= $hours*3600;
      $minutes  = floor($seconds/60);
      $seconds -= $minutes*60;
      if($seconds < 9)
      {
      $seconds = "0".$seconds;
      }
      if($minutes < 9)
      {
      $minutes = "0".$minutes;
      }
        if($hours < 9)
      {
      $hours = "0".$hours;
      }
      return "{$hours}:{$minutes}:{$seconds}";
}
#---- OLD ----
function getLongLat($address){
	// Get a reference to the controller object
    $CI = get_instance();
    
	$loc = array();
	$geo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&key='.$CI->config->config["GOOGLE_API_KEY"].'&sensor=false');
	$geo = json_decode($geo, true);
	if ($geo['status'] = 'OK') {
	$loc['latitude'] = isset($geo['results'][0]['geometry']['location']['lat']) ? $geo['results'][0]['geometry']['location']['lat'] : '';
	$loc['longitude'] = isset($geo['results'][0]['geometry']['location']['lng']) ? $geo['results'][0]['geometry']['location']['lng'] : '';
    return $loc;
    }else{
     return false;
    }
  
}
function sendEmail($from, $fromName, $to, $subject, $body, $attachments)
{
	$CI =& get_instance();
	//echo $from.'<br>';
	if (isset($CI->config->config['environment']) && $CI->config->config['environment'] == 'test'){
		//echo '2';
		
		$CI->load->library('email', $CI->config->config['smtpsettings']);
		
		$CI->email->initialize($CI->config->config['smtpsettings']);
	}
	else
	{
		//echo '1';
		$CI->load->library('email', $CI->config->config['smtpsettingslive']);
		
		$CI->email->initialize($CI->config->config['smtpsettingslive']);
	}
	$CI->email->set_newline("\r\n");
	
	$CI->email->from($from, $fromName);
	
	if(isset($CI->config->config['environment']) && $CI->config->config['environment'] == 'test'){
        
		if (endsWith($to, "bizbrainz.in")){
			$CI->email->to($to);
			//$CI->email->cc("varaharahari@gmail.com");
			$CI->email->subject($subject);
		}
		else
		{
           
			$CI->email->to("varaharahari@gmail.com");
			$CI->email->subject($subject.' - ' .$to);
		}
	}
	else
	{
		$CI->email->to($to);
		$CI->email->subject($subject);
		//$CI->email->cc("varaharahari@gmail.com");
	}
	$CI->email->message($body);
	
	if ($attachments != null && !empty($attachments)){
        // foreach($attachments as $a){
			$CI->email->attach(FCPATH.$attachments);
      // }
	}
	try
	{
		$ss = $CI->email->send();
		//var_dump($CI->email->print_debugger());
		//die();
		return true;
	}
	catch (Exception $e) 
	{
		//var_dump($CI->email->print_debugger());
		var_dump($e);
	}
	return false;
}
function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); 
    $alphaLength = strlen($alphabet) - 1; 
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); 
}

function startsWith($haystack, $needle) {
    // search backwards starting from haystack length characters from the end
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
}

function endsWith($haystack, $needle) {
	// search forward starting from end minus needle length characters
	return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== false);
}

function uniqueMail($email,$id = null)
{  
	$CI=& get_instance();
	$CI->load->database();
	if($id != 0){
		$idcondition="\n AND id!=".$id;
	}
	else{
		$idcondition="";
	}
	$sql = "SELECT count(*) as count FROM users WHERE (email='".$email."' or username='".$email."') $idcondition"; 
	$query = $CI->db->query($sql);
	$row = $query->row()->count;
	return $row;
}

function uniqueUserName($username,$id= null)
{  
	$CI=& get_instance();
	$CI->load->database();
	if($id != 0){
		$idcondition="\n AND id!=".$id;
	}
	else{
		$idcondition="";
	}
	$sql = "SELECT count(*) as count FROM users WHERE (email='".$username."' or username='".$username."') $idcondition"; 
	$query = $CI->db->query($sql);
	$row = $query->row()->count;
	return $row;
}

function uniqueAadharNumber($aadharno,$id= null)
{  
	$CI=& get_instance();
	$CI->load->database();
	if($id != 0){
		$idcondition="\n AND id!=".$id;
	}
	else{
		$idcondition="";
	}
	$sql = "SELECT count(*) as count FROM user_details WHERE (aadhaar_number='".$aadharno."') $idcondition"; 
	$query = $CI->db->query($sql);
	$row = $query->row()->count;
	return $row;
}


function getUserIP()
{
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$user_ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$user_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$user_ip = $_SERVER['REMOTE_ADDR'];
	}
	
	return $user_ip;
}
function getHostURL($includebaseurl = false)
{
	if(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on"){
		return trim('https://'.$_SERVER['HTTP_HOST'] . '/' . ($includebaseurl  == true ? base_url() : ''));
	} else {
		return trim('http://'.$_SERVER['HTTP_HOST'] . '/' . ($includebaseurl  == true ? base_url() : ''));
	}
}
function getBaseURL($includebaseurl = false)
{
	if(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on"){
		return trim('https://'.$_SERVER['HTTP_HOST'] . '/');
	} else {
		return trim('http://'.$_SERVER['HTTP_HOST'] . '/' );
	}
}
function removeSplChar($filename){
    
	$filename = preg_replace("/[^a-zA-Z0-9.]/", "", $filename);
	$filename = strtolower(pathinfo($filename, PATHINFO_FILENAME)) . '.' . strtolower(pathinfo($filename, PATHINFO_EXTENSION));
	//$filename = preg_replace('/.+/', '.', $filename);
	return $filename;
   
}

function getCirclecoordinates($lat, $long, $radius) {
  // convert coordinates to radians
  $lat1 = deg2rad($lat);
  $long1 = deg2rad($long);
  $d_rad = $radius/6378137;
 
  $coordinatesList = array();
  // loop through the array and write path linestrings
  for($i=0; $i<=360; $i+=1) {
    $radial = deg2rad($i);
    $lat_rad = asin(sin($lat1)*cos($d_rad) + cos($lat1)*sin($d_rad)*cos($radial));
    $dlon_rad = atan2(sin($radial)*sin($d_rad)*cos($lat1), cos($d_rad)-sin($lat1)*sin($lat_rad));
    $lon_rad = fmod(($long1+$dlon_rad + M_PI), 2*M_PI) - M_PI;
    $coordinatesList[] = [rad2deg($lat_rad),rad2deg($lon_rad)];
  }
  return $coordinatesList;
}

function sendSMS($fromMobileNumber,$customerName,$orderId){
	
	$smstemplate="Dear $customerName, your order with the ID $orderId has been successfully placed and the payment has been accepted. Your package will be delivered in max 7 business days.";
	// Prepare data for POST request
	//$message = rawurlencode($smstemplate);
	$dataArray = array('user'=>'phanees','pass'=>'BBtpl@4321w', 'phone' => $fromMobileNumber, 'sender' => 'BZBRNZ', 'text' => $smstemplate,'priority'=>'ndnd','stype'=>'normal');
	
	$url='http://bhashsms.com/api/sendmsg.php';
	
	// Send the GET request with cURL
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($dataArray));

	$response = curl_exec($ch);
	curl_close($ch);
	// Process your response here
	//echo $response;
	return $response;
}

function sendSMSApp($fromMobileNumber,$smstemplate){
	        //$api_key = '35F4F2D382C215';
			$contacts = $fromMobileNumber;
			//$from = 'TXTSMS';
			$message=$smstemplate;
			$sms_text = urlencode($message);
			//$api_url = "http://msgweb.smsoln.com/app/smsapi/index.php?key=".$api_key."&campaign=0&routeid=50&type=text&contacts=".$contacts."&senderid=".$from."&msg=".$sms_text;
		$api_url ="http://trans.smsfresh.co/api/sendmsg.php?user=anjanappa&pass=123456&sender=TRUCAB&phone=".$contacts."&text=".$sms_text."&priority=ndnd&stype=normal";
			//Submit to server
			$response = file_get_contents($api_url);
			return $response;

// $api_key = '35F4F2D382C215';
// $contacts = $fromMobileNumber;
// $from = 'EMDSMS';
// $sms_text = $smstemplate;

// //Submit to server

// $ch = curl_init();
// curl_setopt($ch,CURLOPT_URL, "http://msgweb.smsoln.com/app/smsapi/index.php");
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// curl_setopt($ch, CURLOPT_POST, 1);
// curl_setopt($ch, CURLOPT_POSTFIELDS, "key=".$api_key."&campaign=0&routeid=45&type=text&contacts=".$contacts."&senderid=".$from."&msg=".$sms_text);
// $response = curl_exec($ch);
// curl_close($ch);
return $response;

}


function convert_number($number)
{
	if(($number<0) || ($number>999999999)) { return "$number"; }
	$Cr=floor($number/10000000); //Crore(giga) 
	$number-=$Cr*10000000;
	$Gn=floor($number/100000); //Lac(giga)
	$number-=$Gn*100000;
	$kn=floor($number/1000); //Thousands(kilo) 
	$number-=$kn*1000;
	$Hn=floor($number/100); //Hundreds(hecto) 
	$number-=$Hn*100;
	$Dn=floor($number/10); //Tens(deca) 
	$n=$number%10; //Ones 
	
	$res="";
	if($Cr) { $res.=convert_number($Cr)." Crore"; }
	if($Gn) { $res.=convert_number($Gn)." Lac"; }
	if($kn) { $res.=(empty($res) ? "" : " ") . convert_number($kn) . " Thousand"; }
	if($Hn) { $res.=(empty($res) ? "" : " ") . convert_number($Hn) . " Hundred"; }
	
	$ones=array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen");
	$tens=array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety");
	
	if($Dn||$n)
	{
		if(!empty($res)) { $res.= " and "; }
		if($Dn<2) { $res.=" ".$ones[$Dn*10+$n]; }
		else { $res.=" ".$tens[$Dn]; if($n) { $res.=" ".$ones[$n]; } }
	}
	
	if(empty($res)) { $res="zero"; }
	
	return $res;
}



?>