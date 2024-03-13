<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    use HasFactory;
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'profession';

    protected $fillable = [
        'user_id',
        'profession',
        'company_name',
        'monthly_income',
        'domain'
    ];
}
