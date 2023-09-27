<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\JobTypes;

class JobTypesController extends Controller {

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
            $JobTypes = JobTypes::get_all_job_types();
            $JobTypes = json_decode($JobTypes);
            return view('admin.job_types')->with('job_types', $JobTypes);
        } catch (Exception $ex) {
            \Log::info(" Error : " . $ex);
            return back()->withInput()->withErrors($ex);
        }
    }

    /*
     * VALIDATIONS
     */

    protected function validator(array $data) {
        return Validator::make($data, [
                    'job_type' => ['required']
        ]);
    }

    /*
     * SAVE JOB TYPES
     */

    public function save_job_types(Request $request) {
        try {
            $data = $request->all();

            $validator = $this->validator($data);
            if ($validator->fails()) {
                $errorString = implode(",", ($validator->messages()->all()));
                return back()->withInput()
                                ->withErrors($validator->messages()->all());
            }
            $job = JobTypes::save_job_types($data);
            if ($job) {
                return back()->with('success', 'Job type updated.');
            } else {
                return back()->withErrors('Job type not updated, please try again.');
            }
        } catch (Exception $ex) {
            \Log::info(" Error : " . $ex);
            return back()->withInput()->withErrors($ex);
        }
    }
    
     /*
     * RETURN JOB TYPE BY ID
     */

    public function get_all_job_types() {
        try {
            $job = JobTypes::get_all_job_types();
            $job = json_decode($job);
            return response()->json(['success' => true, 'message' => '', 'data' => $job]);
        } catch (Exception $ex) {
            \Log::info(" Error : " . $ex);
            return response()->json(['success' => false, 'message' => 'Unable to fecth the data, please try again later.', 'data' => null]);
        }
    }

    /*
     * RETURN JOB TYPE BY ID
     */

    public function get_job_type_by_id($id) {
        try {
            $job = JobTypes::get_job_type_by_id($id);
            $job = json_decode($job);
            return response()->json(['success' => true, 'message' => '', 'data' => $job]);
        } catch (Exception $ex) {
            \Log::info(" Error : " . $ex);
            return response()->json(['success' => false, 'message' => 'Unable to fecth the data, please try again later.', 'data' => null]);
        }
    }

   

    /*
     * DELETE JOBS TYPE BY ID
     */

    public function delete_job_type_by_id($id) {
        try {
            $job = JobTypes::delete_job_type_by_id($id);
            $job = json_decode($job);

            return response()->json(['success' => true, 'message' => 'Job Type deleted.', 'data' => $job]);
        } catch (Exception $ex) {
            \Log::info(" Error : " . $ex);
            return response()->json(['success' => false, 'message' => 'Unable to delete job type, please try again later.', 'data' => null]);
        }
    }

}
