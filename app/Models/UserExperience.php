<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExperience extends Model
{
    use HasFactory;
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'experience';

    protected $fillable = [
        'user_id',
        'is_current_company',
        'organization',
        'designation',
        'ctc',
        'state',
        'job_profile_description',
        'experience_year',
        'joining_date',
        'relieving_date'
    ];
}
