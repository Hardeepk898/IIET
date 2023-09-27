<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobTypes extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'job_type', 'status'
    ];

    /*
     * SAVE JOB TYPES
     */

    public static function save_job_types($data) {
        try {
            if ($data['id'] == '') {
                $result = new JobTypes;  
            } else {
                $result = JobTypes::find($data['id']);
            }
            $result->job_type = $data['job_type'];
            $result->status = $data['status'];
            $result->save();
            return $result;
        } catch (Exception $ex) {
            Log::error("Method: " . __METHOD__ . ", Line " . __LINE__ . ": " . (string) $ex);
            return false;
        }
    }

    
    /*
     * GET ALL JOB TYPES
     */

    public static function get_all_job_types($status = '') {
        try {
            if($status != '') {
                $jobs = JobTypes::where('status', $status)->get();
            } else {
                $jobs = JobTypes::get();
            }
            return $jobs;
        } catch (Exception $ex) {
            Log::error("Method: " . __METHOD__ . ", Line " . __LINE__ . ": " . (string) $ex);
            return false;
        }
    }
    /*
     * GET JOB TYPE BY ID
     */

    public static function get_job_type_by_id($id) {
        try {
            $jobs = JobTypes::where('id',$id)->first();
            return $jobs;
        } catch (Exception $ex) {
            Log::error("Method: " . __METHOD__ . ", Line " . __LINE__ . ": " . (string) $ex);
            return false;
        }
    }
    
    /*
     * DELETE JOB TYPES
     */
    public static function delete_job_type_by_id($id) {
        try {
            $Jobs = JobTypes::where('id',$id)->delete();
            return $Jobs;
        } catch (Exception $ex) {
            Log::error("Method: " . __METHOD__ . ", Line " . __LINE__ . ": " . (string) $ex);
            return false;
        }
    }
}
