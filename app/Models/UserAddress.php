<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'address';

    protected $fillable = [
        'user_id',
        'line1',
        'line2',
        'line3',
        'address',
        'city',
        'state',
        'pincode',
        'country',
    ];
}
