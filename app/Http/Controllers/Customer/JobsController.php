<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Jobs;
use App\Models\UsersAreaOfExpertise;

class JobsController extends Controller {

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /*
     * RETURN CALENDAR PAGE VIEW
     */

    public function index() {
        try {
            $AreaOfExpertise = UsersAreaOfExpertise::get_area_of_expertise_details(\Auth::user()->id);
            $AreaOfExpertise = json_decode($AreaOfExpertise);
            $job_types = array();
            if(count($AreaOfExpertise) > 0) {
                foreach($AreaOfExpertise as $type) {
                    array_push($job_types,$type->job_types_id);
                }
            }
            $jobs = Jobs::get_jobs_with_types($job_types);
            $jobs = json_decode($jobs);
            
            return view('jobs')->with('job_details', $jobs);
        } catch (Exception $ex) {
            \Log::info(" Error : " . $ex);
            return back()->withInput()->withErrors($ex);
        }
    }

    /*
     * RETURN JOB BY ID
     */

    public function get_job_by_id($id) {
        try {
            $job = Jobs::get_job_by_id($id);
            $job = json_decode($job);
            
            return view('job_details')->with('job', $job);
        } catch (Exception $ex) {
            \Log::info(" Error : " . $ex);
            return back()->withInput()->withErrors($ex);
        }
    }

    /*
     * DELETE JOBS BY ID
     */

    public function delete_job_details($id) {
        try {
            $job = Jobs::get_job_by_id($id);
            $job = json_decode($job);
            \Storage::delete('public/' . $job->file_path);

            $job = Jobs::delete_job($id);

            return response()->json(['success' => true, 'message' => 'Job deleted.', 'data' => $job]);
        } catch (Exception $ex) {
            \Log::info(" Error : " . $ex);
            return response()->json(['success' => false, 'message' => 'Unable to delete job, please try again later.', 'data' => null]);
        }
    }

}
