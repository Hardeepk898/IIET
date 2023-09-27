<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmissionJobTypes extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admission_id', 'job_type_id'
    ];
}
