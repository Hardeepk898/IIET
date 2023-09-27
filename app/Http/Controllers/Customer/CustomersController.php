<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Models\UsersQualifications;
use App\Models\UsersAreaOfExpertise;
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
            $user = \Auth::user();
            $user = json_decode($user);

            $job_types = JobTypes::get_all_job_types(1);
            $job_types = json_decode($job_types);

            $qualification = UsersQualifications::get_qualification_details(\Auth::user()->id);
            $qualification = json_decode($qualification);
            $user->qualificaion = $qualification;

            $AreaOfExpertise = UsersAreaOfExpertise::get_area_of_expertise_details(\Auth::user()->id);
            $AreaOfExpertise = json_decode($AreaOfExpertise);
            $user->AreaOfExpertise = $AreaOfExpertise;

            return view('my_account')->with('customer', $user)->with('job_types', $job_types);
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
                    'phone' => ['required']
        ]);
    }

    /*
     * SAVE CUSTOMER DETAILS
     */

    public function update_customer_details(Request $request) {
        try {
            $data = $request->all();

            $validator = $this->validator($data);
            if ($validator->fails()) {
                $errorString = implode(",", ($validator->messages()->all()));
                return back()->withInput()
                                ->withErrors($validator->messages()->all());
            }
            $user = User::update_customer_details($data);

            if ($user) {
                // SAVE IMAGE
                if ($request->hasfile('file_path')) {
                    $path = $this->upload_image($request, \Auth::user()->id);
                    User::save_file_path($path, \Auth::user()->id);
                }
                if (\Auth::user()->payment_status == 1) {
                    return back()->with('success', 'User details updated.');
                } else {
                    return $this->payment();
                }
            } else {
                return back()->withErrors('User details not updated, please try again.');
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
                'resume', $name, 'public'
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

    public function payment() {
        try {
            $stripe_key = $_ENV["STRIPE_PUBLISHABLE_KEY"];
            // Enter Your Stripe Secret
            \Stripe\Stripe::setApiKey($_ENV["STRIPE_SECRET_KEY"]);

            $amount = $_ENV["STRIPE_AMOUNT"];
            $amount *= 100;
            $amount = (int) $amount;

            $payment_intent = \Stripe\PaymentIntent::create([
                        'description' => 'Stripe Test Payment',
                        'amount' => $amount,
                        'currency' => 'INR',
                        'description' => 'Payment From Codehunger',
                        'payment_method_types' => ['card'],
            ]);
            $intent = $payment_intent->client_secret;
            return view('payment')->with('stripe_key', $stripe_key)->with('intent', $intent);
        } catch (Exception $ex) {
            \Log::info(" Error : " . $ex);
            return back()->withInput()->withErrors($ex);
        }
    }

    public function payment_confirmation() {
        try {
            $data = array();
            $data['id'] = \Auth::user()->id;
            $data['payment_status'] = 1;
            $User = User::update_status($data);
            if ($User) {
                return view('payment_confirmation');
            } else {
                return back()->withInput()->withErrors('Payment status not updated. Please try again later.');
            }
        } catch (Exception $ex) {
            \Log::info(" Error : " . $ex);
            return back()->withInput()->withErrors($ex);
        }
    }

}
