<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    use HasFactory;

    protected $table = 'profession';

    protected $fillable = [
        'reffered_by','bank_name', 'pan_num', 'adhar_num', 'email', 'mobile', 'annual_income',
        'residence_address', 'office_address', 'pan_file', 'adhar_front_file', 'adhar_back_file', 'itr_file', 'bank_statement_file',
    ];
    
}
