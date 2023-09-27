<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersAreaOfExpertise extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'users_id', 'job_types_id'
    ];

    /*
     * GET AREA OF EXPERTISE
     */

    public static function get_area_of_expertise_details($id) {
        try {
            $result = UsersAreaOfExpertise::where('users_id', $id)
                    ->select('job_types_id')
                    ->with('job_types')
                    ->get();
            return $result;
        } catch (Exception $ex) {
            Log::error("Method: " . __METHOD__ . ", Line " . __LINE__ . ": " . (string) $ex);
            return false;
        }
    }

    /*
     * GET JOB TYPES ASSOCIATED TO USERS
     */

    public function job_types() {
        return $this->belongsTo('App\Models\JobTypes')->select('id', 'job_type');
    }

    /*
     * GET USER ID BASED ON TYPE ID
     */

    public static function getUserID($type) {
        try {
            $result = UsersAreaOfExpertise::whereIn('job_types_id',$type)
                    ->select('users_id')->distinct()->get();
            return $result;
        } catch (Exception $ex) {
            Log::error("Method: " . __METHOD__ . ", Line " . __LINE__ . ": " . (string) $ex);
            return null;
        }
    }

}
