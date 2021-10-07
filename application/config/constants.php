<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

define('VALIDATION_MSG_REQUIRED_FIELD','This Is Required Field.');

define('SAVE_MSG','Saved Successfully.');
define('UNSAVE_MSG','Your Details Not Saved Please Try Again ...');
define('SERVER_ERROR','Something went wrong from server side please contact Administrator...');
define('FLNAME_EXIST', 'File Name already exists');
define('FLNAME_ERR', 'File Name Error');
define('INV_FLE','Invalid file');
define('FLNAME_NO_MATCH','File Extension does not matches');
define('FILE_TYPE_ERR','Sorry, only PDF, DOC files are allowed!!!');
define('IMAGE_TYPE_ERR', 'Sorry, only jpg, JPG, png & gif files are allowed!!!');
define('FILE_NOT_UPLOAD','File Not Uploaded Please Try Again...');
define('FILE_SIZE_ERR','Upload File Size is Below 1MB allowed!!');
define('DELTE_MSG','Deleted Successfully..');
define('UPDATE_MSG','Updated Successfully..');
define('NO_RCRD_FND','This User has no subscription');
define('CNFRM_PASSWORD_ERROR','Password and Confirm Password should be same');
define('EMAIL_DOESNT_MATCH','EMail Does not exists');
define('EMAIL_RESET_LINK','Enter your email address we will sent you the password reset link.');
define('INVALID_TOKEN_MSG','Invalid Token Message');
define('PWD_CHANGE_MSG','Password Changed Successfully');
define('USERNAME_INCORRECT','Please enter the Username');
define('PASSWORD_INCORRECT','Please enter the Password');
define('USERNAME_PASSWORD_INCORRECT','Incorrect UserName and Password.');
define('OOPS_ADMINISTRATOR','Something went wrong from server side please contact Administrator...');

define('INVALID_EMAIL_MSG','Invalid EMail Address');
define('REGISTER_MAIL_VAL_MSG','Please Register EMail Address ');
define('CONFIRMATION_MAIL_MSG','We will sent you the password reset link to your email address.');
define('PASSWORD_NOTCHANGED','Your Password not Change  Pls Try Again...');
define('PASSWORD_CHANGED','Your Password Changed Successfully..');
define('INVALID_PASSWORD_MSG','Incorrect Old PassWord Pls Try Again... ');

define('EMAIL_EXISTS_MSG','Enter Email Already Registered Please Try With Another Email.');
define('EMPID_EXISTS_MSG','Enter Mobile No Already Registered Please Try With Another Mobile No.');
define('DWNLOAD_MSG','File Download Successfully..'); 
define('IMAGE_SEND_ERR','File Not Uploaded Please Try Again ..'); 

define('SAVE_MSG_CANCEL_BOOKING','Your Refundable Amount Send To Your Account With in 4 Working Days..');
define('GET_MSG_CANCEL_BOOKING','Your Booking is Already Cancelled..');
define('BOOKING_CANCEL_TIME_MSG','Your Booked Vechile Already Started We Can not Cancel Booking..');

define('AADHAR_EXISTS_MSG','Enter Aadhar Number Already Registered Please Try With Another Aadhar.');
define('BOOKING_RIDE_MSG','Confirmed your booking. We can share Driver Details. Shortly. Thank you.'); 