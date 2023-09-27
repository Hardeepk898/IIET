<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Models\Admission;
use App\Models\JobTypes;

class AdmissionController extends Controller {

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
            $job_types = JobTypes::get_all_job_types(1);
            $job_types = json_decode($job_types);

            return view('admission')->with('job_types',$job_types);
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
                    'firstname' => ['required'],
                    'lastname' => ['required'],
                    'phone' => ['required'],
                    'course' => ['required'],
                    'class' => ['required'],
        ]);
    }

    /*
     * SAVE ADMISSION DETAILS
     */

    public function save_admission_details(Request $request) {
        try {
            $data = $request->all();
            
            $validator = $this->validator($data);
            if ($validator->fails()) {
                $errorString = implode(",", ($validator->messages()->all()));
                return back()->withInput()
                                ->withErrors($validator->messages()->all());
            }
            
            $result = Admission::save_details($data);            
            if ($result) {   
                $email = env('MAIL_TO');    
                Mail::send('emails.admission', $data, function($message) use ($email) {
                    $message->to($email)->subject('IIET Solutions - Admission');
                });
                return back()->with('success', 'Details updated.');
            } else {
                return back()->withErrors('Details not updated, please try again.');
            }
        } catch (Exception $ex) {
            \Log::info(" Error : " . $ex);
            return back()->withInput()->withErrors($ex);
        }
    }
    
    

}
