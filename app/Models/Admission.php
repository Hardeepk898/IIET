<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admission extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    protected $fillable = [
//        'firstname', 'lastname', 
//    ];

    /*
     * SAVE Details
     */

    public static function save_details($data) {
        try {
            \DB::beginTransaction();
            $result = new Admission;  
            
            $result->firstname = $data['firstname'];
            $result->lastname = $data['lastname'];
            $result->email = $data['email'];
            $result->phone = $data['phone'];
            $result->dob = date('Y-m-d',strtotime($data['dob']));
            $result->guardian_name = $data['guardian_name'];
            $result->religion = $data['religion'];
            $result->gender = $data['gender'];
            $result->address1 = $data['address1'];
            $result->address2 = $data['address2'];
            $result->city = $data['city'];
            $result->state = $data['state'];
            $result->country = $data['country'];
            $result->postcode = $data['postcode'];
            $result->course = $data['course'];
            $result->center = $data['center'];
            $result->category = $data['category'];
            $result->school_name = $data['school_name'];
            $result->class = $data['class'];
            $result->save();
            
            if($result) {
                foreach ($data['education'] as $education) {
                    $edu = new AdmissionEducationDetails();  
                    $edu->admission_id = $result->id;
                    $edu->examination = $education['examination'];
                    $edu->university = $education['university'];
                    $edu->passing_year = $education['passing_year'];
                    $edu->total_marks = $education['total_marks'];
                    $edu->percentage_marks = $education['percentage_marks'];
                    $edu->save();
                }
                
            }
            
            if (!empty($data['job_types'])) {
                AdmissionJobTypes::where('admission_id',$result->id)->delete();
                foreach ($data['job_types'] as $job_types) {
                    $types = new AdmissionJobTypes();
                    $types->admission_id = $result->id;
                    $types->job_type_id = $job_types;
                    $types->save();
                }
                
            }
            \DB::commit();
            return $result;
        } catch (Exception $ex) {
            \DB::rollBack();
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
