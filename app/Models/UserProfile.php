<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_profile';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    // protected $primaryKey = 'flight_id';


    protected $fillable = [
        'user_id',
        'father_name',
        'date_of_birth',
        'gender',
        'age',
        'alt_phone',
        'profile_image',
        'pan',
        'gst',
        'msme',
    ];
}
