<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersQualifications extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'users_id', 'course_name', 'qualification_year', 'institute_name'
    ];

    /*
     * GET USER QUALIFICATIONS
     */
    public static function get_qualification_details($id) {
        try {
            $qualification = UsersQualifications::where('users_id',$id)
                    ->select('users_id', 'course_name', 'qualification_year', 'institute_name')->get();
            return $qualification;
        } catch (Exception $ex) {
            Log::error("Method: " . __METHOD__ . ", Line " . __LINE__ . ": " . (string) $ex);
            return false;
        }
    }
}
