<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class LoginController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles authenticating users for the application and
      | redirecting them to your home screen. The controller uses a trait
      | to conveniently provide its functionality to your applications.
      |
     */

use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    /*
     * RETURN LOGIN VIEW
     */

    public function index() {
        try {
            return view('admin.login');
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
                    'email' => ['required', 'string'],
                    'password' => ['required', 'string', 'min:8'],
        ]);
    }

    /*
     * LOGIN POST METHOD
     */

    public function login(Request $request) {
        try {
            $data = $request->all();
            $validator = $this->validator($data);
            if ($validator->fails()) { 
                $errorString = implode(",", ($validator->messages()->all()));
                return back()->withInput()
                                ->withErrors($validator->messages()->all());
            }

            $credentials = array(
                'email' => $data['email'],
                'password' => $data['password']
            );
            if (!\Auth::attempt($credentials)) {
                return back()->withInput()
                                ->withErrors('Invalid email/password');
            }

            return redirect()->to('admin/dashboard');
        } catch (Exception $ex) {
            \Log::info(" Error : " . $ex);
            return back()->withInput()->withErrors($ex);
        }
    }
    
    /*
    * LOGOUT
    */
    public function logout($user_type = 1) {
        try {
            \Auth::logout();
            if($user_type == 0) {
                return redirect('/');
            }
            return redirect('/admin');
        } catch(Exception $ex) {
            \Log::info(" Error : " . $ex);
            return back()->withInput()->withErrors($ex);
        }
        
    }
    
    /*
     * RETURN LOGIN CUSTOMER VIEW
     */

    public function customer_login() {
        try {
            return view('login');
        } catch (Exception $ex) {
            \Log::info(" Error : " . $ex);
            return back()->withInput()->withErrors($ex);
        }
    }
    
    /*
     * LOGIN POST METHOD
     */

    public function customer_login_post(Request $request) {
        try {
            $data = $request->all();
            $validator = $this->validator($data);
            if ($validator->fails()) {
                $errorString = implode(",", ($validator->messages()->all()));
                return back()->withInput()
                                ->withErrors($validator->messages()->all());
            }

            $credentials = array(
                'email' => $data['email'],
                'password' => $data['password'],
                'user_type' => 0,
                'status' => 1,
            );
            if (!\Auth::attempt($credentials)) {
                return back()->withInput()
                                ->withErrors('Invalid email/password');
            }

            return redirect()->to('my_account');
        } catch (Exception $ex) {
            \Log::info(" Error : " . $ex);
            return back()->withInput()->withErrors($ex);
        }
    }
}
