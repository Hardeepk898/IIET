<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Models\Jobs;
use App\Models\JobTypes;

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
            $jobs = Jobs::get_all_jobs();
            $jobs = json_decode($jobs);

            $job_types = JobTypes::get_all_job_types(1);
            $job_types = json_decode($job_types);

            return view('admin.jobs')->with('job_details', $jobs)->with('job_types', $job_types);
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
                    'title' => ['required']
        ]);
    }

    /*
     * SAVE JOB DETAILS
     */

    public function save_job_details(Request $request) {
        try {
            $data = $request->all();
            $validator = $this->validator($data);
            if ($validator->fails()) {
                $errorString = implode(",", ($validator->messages()->all()));
                return back()->withInput()
                                ->withErrors($validator->messages()->all());
            }
            $job = Jobs::save_job_details($data);
            if ($job) {
                // SAVE IMAGE
                if ($request->hasfile('file_path')) {
                    $path = $this->upload_image($request, $job->id);
                    Jobs::save_file_path($path, $job->id);
                }

                // Email to user for job alerts
                if ($data['id'] == '') {
                    $area_of_interests = \App\Models\UsersAreaOfExpertise::getUserID($data['job_types']);
                    $area_of_interests = json_decode($area_of_interests);
                    foreach ($area_of_interests as $area) {
                        $user = \App\User::get_customer_by_id($area->users_id);
                        $email = $user->email;
                        $data = array();
                        $data['username'] = $user->firstname . ' ' . $user->lastname;
                        Mail::send('emails.job_alert', $data, function ($message) use ($email) {
                            $message->to($email)->subject('IIET Solutions - Job Alert');
                        });
                    }
                }

                return back()->with('success', 'Job details updated.');
            } else {
                return back()->withErrors('Job details not updated, please try again.');
            }
        } catch (Exception $ex) {
            \Log::info(" Error : " . $ex);
            return back()->withInput()->withErrors($ex);
        }
    }

    /*
     * CEATE IMAGE PATH
     */

    private function upload_image($request, $id) {
        $file = $request->file('file_path');
        $name = 'file_' . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs(
                'jobs', $name, 'public'
        );
        return $path;
    }

    /*
     * RETURN JOB BY ID
     */

    public function get_job_by_id($id) {
        try {
            $job = Jobs::get_job_by_id($id);
            $job = json_decode($job);
            return response()->json(['success' => true, 'message' => '', 'data' => $job]);
        } catch (Exception $ex) {
            \Log::info(" Error : " . $ex);
            return response()->json(['success' => false, 'message' => 'Unable to fecth the data, please try again later.', 'data' => null]);
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
