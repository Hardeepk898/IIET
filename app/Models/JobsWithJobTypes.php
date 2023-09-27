<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobsWithJobTypes extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'jobs_id', 'job_types_id'
    ];

}
