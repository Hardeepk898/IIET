<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::prefix('admin')->group(function () {
    Route::get('/', ['as' => '/', 'uses' => 'Auth\LoginController@index']);
    Route::post('login', ['as' => 'login', 'uses' => 'Auth\LoginController@login']);
    Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);
    Route::get('logout/{user_type?}', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
    Route::get('jobs', ['as' => 'jobs', 'uses' => 'JobsController@index']);
    Route::get('jobs/{id}', ['as' => 'jobs', 'uses' => 'JobsController@get_job_by_id']);
    Route::post('jobs', ['as' => 'jobs', 'uses' => 'JobsController@save_job_details']);
    Route::delete('jobs/{id}', ['as' => 'jobs', 'uses' => 'JobsController@delete_job_details']);
    Route::get('job_types', ['as' => 'job_types', 'uses' => 'JobTypesController@index']);
    Route::post('job_types', ['as' => 'job_types', 'uses' => 'JobTypesController@save_job_types']);
    Route::get('job_types/{id}', ['as' => 'job_types', 'uses' => 'JobTypesController@get_job_type_by_id']);
    Route::delete('job_types/{id}', ['as' => 'job_types', 'uses' => 'JobTypesController@delete_job_type_by_id']);
    Route::get('customers', ['as' => 'customers', 'uses' => 'CustomersController@index']);
    Route::get('customers/{id}', ['as' => 'customers', 'uses' => 'CustomersController@get_customer_by_id']);
});

Route::get('/', ['as' => '/', 'uses' => 'Auth\LoginController@customer_login']);
Route::get('register', ['as' => 'register', 'uses' => 'Auth\RegisterController@index']);
Route::post('register', ['as' => 'register', 'uses' => 'Auth\RegisterController@create']);
Route::post('login', ['as' => 'login', 'uses' => 'Auth\LoginController@customer_login_post']);
Route::get('jobs', ['as' => 'jobs', 'uses' => 'Customer\JobsController@index']);
Route::get('jobs/{id}', ['as' => 'job_details', 'uses' => 'Customer\JobsController@get_job_by_id']);
Route::get('home', ['as' => 'jobs', 'uses' => 'Customer\CustomersController@index']);
Route::get('my_account', ['as' => 'my_account', 'uses' => 'Customer\CustomersController@index']);
Route::post('my_account', ['as' => 'my_account', 'uses' => 'Customer\CustomersController@update_customer_details']);
Route::get('admission', ['as' => 'admission', 'uses' => 'Customer\AdmissionController@index']);
Route::post('admission', ['as' => 'admission_save', 'uses' => 'Customer\AdmissionController@save_admission_details']);
Route::get('payment', ['as' => 'payment', 'uses' => 'Customer\CustomersController@payment']);
Route::post('payment', ['as' => 'payment', 'uses' => 'CustomersController@update_payment_status']);

Route::post('payment_confirmation','Customer\CustomersController@payment_confirmation');