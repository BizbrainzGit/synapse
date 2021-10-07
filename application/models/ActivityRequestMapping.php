<?php
include_once(APPPATH . 'models/CommonBase_model.php');

use \Illuminate\Database\Eloquent\Model as Eloquent;
use \Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;

class ActivityRequestMapping extends CommonBase_model {
	public $timestamps = false;
	protected $table = 'activity_request_mappings';
	protected $primaryKey = 'id';
	protected $fillable = ['id','activity_desc','request_url'];
	
}
?>