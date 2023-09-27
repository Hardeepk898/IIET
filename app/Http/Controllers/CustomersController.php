<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Models\JobTypes;

class CustomersController extends Controller {

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
            $users = User::get_all_customers(0);
            $users = json_decode($users);

            $job_types = JobTypes::get_all_job_types(1);
            $job_types = json_decode($job_types);

            return view('admin.customers')->with('customers',$users)->with('job_types',$job_types);
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

    protected function validator_payment(array $data) {
        return Validator::make($data, [
                    'id' => ['required'],
                    'payment_status' => ['required'],
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
        $name = 'file_' . rand(1000,9999) . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs(
                'jobs', $name, 'public'
        );
        return $path;
    }
    
     /*
     * RETURN CUSTOMER BY ID
     */

    public function get_customer_by_id($id) {
        try {
            $cust = User::get_customer_by_id($id);
            $cust = json_decode($cust);
            return response()->json(['success' => true, 'message' => '', 'data' => $cust]);
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
            \Storage::delete('public/'.$job->file_path);
            
            $job = Jobs::delete_job($id);
            
            return response()->json(['success' => true, 'message' => 'Job deleted.', 'data' => $job]);
        } catch (Exception $ex) {
            \Log::info(" Error : " . $ex);
            return response()->json(['success' => false, 'message' => 'Unable to delete job, please try again later.', 'data' => null]);
        }
    }

    /*
    * UPDATE PAYMENT STATUS
    */
    public function update_payment_status(Request $request) {
        try {
            $data = $request->all();

            $validator = $this->validator_payment($data);
            if ($validator->fails()) {
                $errorString = implode(",", ($validator->messages()->all()));
                return response()->json(['success' => false, 'message' => $errorString, 'data' => null]);
            }
            $User = User::update_status($data);
            if ($User) {                
                return response()->json(['success' => true, 'message' => 'Payment status updated.', 'data' => $User]);
            } else {
                return response()->json(['success' => false, 'message' => 'Payment status not updated. Please try again later.', 'data' => null]);
            }
        } catch (Exception $ex) {
            \Log::info(" Error : " . $ex);
            return response()->json(['success' => false, 'message' => 'Payment status not updated. Please try again later.', 'data' => null]);
        }
    }

}
