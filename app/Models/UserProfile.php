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
        'date_of_birth',
        'gender',
        'age',
        'profile_image',
        'preffered_line',
        'spoc'
    ];
}
