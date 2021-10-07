<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Query\Expression as raw;
class DoctorsSchedule_model extends Eloquent{
	
    public $timestamps = false;
     protected $guarded = array();
    protected $table = "doctors_time_schedule"; // table name
    public $primaryKey = 'id';
    protected $fillable = ['doctors_id', 'weekday', 'schedule_date', 'start_time', 'end_time', 'per_patient_time', 'schedule_status', 'created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];

	public function AddDoctorsSchedule($addarray)
	{
		$addresult=self::create($addarray);
		return $addresult;
	}

	public function SearchDoctorsSchedule()
	{
		$searchresult=self::get(['doctors_time_schedule.id','doctors_id', 'weekday', 'schedule_date', 'start_time', 'end_time', 'per_patient_time', 'schedule_status']);
		return $searchresult;
	} 
    
    public function EditDoctorsSchedule($id){
		$editresult=self::where('doctors_time_schedule.id','=',$id)->get();
		return $editresult;
	}

	public function UpdateDoctorsSchedule($doctortimeschedulearray,$id){
		$updateresult=self::where('doctors_time_schedule.id','=',$id)->update($doctortimeschedulearray);
		return $updateresult;
	}

   public function DeleteDoctorsSchedule($id)
	{
		$deleteaddress=self::where('doctors_time_schedule.id','=',$id)->delete();
		return $deleteaddress;
	} 


}
?>

