<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Register Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users as well as their
      | validation and creation. By default this controller uses a trait to
      | provide this functionality without requiring any additional code.
      |
     */

use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    /*
     * RETURN REGISTRATION VIEW
     */

    public function index() {
        try {
            return view('register');
        } catch (Exception $ex) {
            \Log::info(" Error : " . $ex);
            return back()->withInput()->withErrors($ex);
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
                    'firstname' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => ['required', 'string', 'min:8'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $request) {
        try {
            $data = $request->all();
            $validator = $this->validator($data);
            if ($validator->fails()) { 
                $errorString = implode(",", ($validator->messages()->all()));
                return back()->withInput()
                                ->withErrors($validator->messages()->all());
            }

            User::create([
                        'firstname' => $data['firstname'],
                        'lastname' => $data['lastname'],
                        'phone' => $data['phone'],
                        'name' => $data['firstname'],
                        'email' => $data['email'],
                        'password' => Hash::make($data['password']),
                        'status' => 1,
            ]);
            
           
            return back()->with('success', 'Registered successfully.');
        } catch (Exception $ex) {
            \Log::info(" Error : " . $ex);
            return back()->withInput()->withErrors($ex);
        }
    }

}
