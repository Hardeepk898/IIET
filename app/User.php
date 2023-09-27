<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'firstname', 'lastname', 'phone', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*
     * GET ALL CUSTOMERS
     */

    public static function get_all_customers($user_type) {
        try {
            $users = User::where('user_type', $user_type)->get();
            return $users;
        } catch (Exception $ex) {
            Log::error("Method: " . __METHOD__ . ", Line " . __LINE__ . ": " . (string) $ex);
            return false;
        }
    }

    /*
     * UPDATE CUSTOMER DETAILS
     */

    public static function update_customer_details($data) {
        try {
            \DB::beginTransaction();
            $result = User::find(\Auth::user()->id);
            $result->firstname = $data['firstname'];
            $result->lastname = $data['lastname'];
            $result->phone = $data['phone'];
            $result->comments = $data['comments'];
            $result->save();
            if (count($data['qualification'])) {
                Models\UsersQualifications::where('users_id',$result->id)->delete();
                foreach ($data['qualification'] as $qualification) {
                    $qual = new Models\UsersQualifications;
                    $qual->users_id = $result->id;
                    $qual->course_name = $qualification['course_name'];
                    $qual->qualification_year = $qualification['qualification_year'];
                    $qual->institute_name = $qualification['institute_name'];
                    $qual->save();
                    
                    if(!$qual) {
                        \DB::rollBack();
                    }
                }
            }
            if (count($data['area_of_expertise'])) {
                Models\UsersAreaOfExpertise::where('users_id',$result->id)->delete();
                foreach ($data['area_of_expertise'] as $area_of_expertise) {
                    $expertise = new Models\UsersAreaOfExpertise;
                    $expertise->users_id = $result->id;
                    $expertise->job_types_id = $area_of_expertise;
                    $expertise->save();
                    
                    if(!$expertise) {
                        \DB::rollBack();
                    }
                }
            }
            return $result;
        } catch (Exception $ex) {
            \DB::commit();
            Log::error("Method: " . __METHOD__ . ", Line " . __LINE__ . ": " . (string) $ex);
            return false;
        }
    }
    
    /*
     * SAVE CV
     */
    public static function save_file_path($path,$id) {
        try {
            $result = User::find($id);
            $result->file_path = $path;
            $result->save();
            return true;
        } catch (Exception $ex) {
            Log::error("Method: " . __METHOD__ . ", Line " . __LINE__ . ": " . (string) $ex);
            return false;
        }
    } 

    /*
    * UPDATE PAYMENT STATUS
    */
    public static function update_status($data) {
        try {
            $result = User::find($data['id']);
            $result->payment_status = $data['payment_status'];
            $result->status = 1;
            $result->save();
            return $result;
        } catch (Exception $ex) {
            Log::error("Method: " . __METHOD__ . ", Line " . __LINE__ . ": " . (string) $ex);
            return false;
        }
    }

    /*
    * GET USER DETAILS BY ID
    */
    public static function get_customer_by_id($id) {
        try {
            $users = User::where('id', $id)->first();
            return $users;
        } catch (Exception $ex) {
            Log::error("Method: " . __METHOD__ . ", Line " . __LINE__ . ": " . (string) $ex);
            return false;
        }
    }

}
