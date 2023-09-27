<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'file_path', 'status'
    ];

    /*
     * SAVE JOB DETAILS
     */

    public static function save_job_details($data) {
        try {
            \DB::beginTransaction();
            if ($data['id'] == '') {
                $result = new Jobs;
            } else {
                $result = Jobs::find($data['id']);
            }
            $result->title = $data['title'];
            $result->description = $data['description'];
            $result->status = $data['status'];
            $result->save();

            if (!empty($data['job_types'])) {
                JobsWithJobTypes::where('jobs_id',$result->id)->delete();
                foreach ($data['job_types'] as $job_types) {
                    $types = new JobsWithJobTypes();
                    $types->jobs_id = $result->id;
                    $types->job_types_id = $job_types;
                    $types->save();
                }
                \DB::rollBack();
            }
            return $result;
        } catch (Exception $ex) {
            \DB::commit();
            Log::error("Method: " . __METHOD__ . ", Line " . __LINE__ . ": " . (string) $ex);
            return false;
        }
    }

    /*
     * SAVE DOCUMENTS
     */

    public static function save_file_path($path, $id) {
        try {
            $result = Jobs::find($id);
            $result->file_path = $path;
            $result->save();
            return true;
        } catch (Exception $ex) {
            Log::error("Method: " . __METHOD__ . ", Line " . __LINE__ . ": " . (string) $ex);
            return false;
        }
    }

    /*
     * GET ALL JOBS
     */

    public static function get_all_jobs($status = '') {
        try {
            if ($status != '') {
                $jobs = Jobs::where('status', $status)->with('job_types')->get();
            } else {
                $jobs = Jobs::with('job_types')->get();
            }
            return $jobs;
        } catch (Exception $ex) {
            Log::error("Method: " . __METHOD__ . ", Line " . __LINE__ . ": " . (string) $ex);
            return false;
        }
    }

    /*
     * GET JOB BY ID
     */

    public static function get_job_by_id($id) {
        try {
            $jobs = Jobs::where('id', $id)->with('job_types')->first();
            return $jobs;
        } catch (Exception $ex) {
            Log::error("Method: " . __METHOD__ . ", Line " . __LINE__ . ": " . (string) $ex);
            return false;
        }
    }

    /*
     * DELETE JOBS
     */

    public static function delete_job($id) {
        try {
            $Jobs = Jobs::where('id', $id)->delete();
            return $Jobs;
        } catch (Exception $ex) {
            Log::error("Method: " . __METHOD__ . ", Line " . __LINE__ . ": " . (string) $ex);
            return false;
        }
    }

    /*
     * GET JOB TYPES ACCOCIATED WITH JOBS
     */

    public function job_types() {
        return $this->belongsToMany('App\Models\JobTypes', 'App\Models\JobsWithJobTypes')->select('job_types.id', 'job_type');
    }

    /*
     * GET JOBS FOR CUSTOMERS
     */

    public static function get_jobs_with_types($job_types) {
        try {
            $Jobs = \DB::table('jobs')
                ->leftJoin('jobs_with_job_types','jobs_with_job_types.jobs_id','=','jobs.id')
                    ->whereIn('jobs_with_job_types.job_types_id',$job_types)
                    ->groupBy('jobs_with_job_types.jobs_id')
                    ->select('jobs.*')
                    ->get();
            
            //$Jobs = Jobs::where('id', $id)->get();
            return $Jobs;
        } catch (Exception $ex) {
            Log::error("Method: " . __METHOD__ . ", Line " . __LINE__ . ": " . (string) $ex);
            return false;
        }
    }

}
