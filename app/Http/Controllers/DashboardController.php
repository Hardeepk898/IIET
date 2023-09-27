<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
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
            
           return view('admin.dashboard');
        } catch (Exception $ex) {
            \Log::info(" Error : " . $ex);
            return back()->withInput()->withErrors($ex);
        }
    }
}
