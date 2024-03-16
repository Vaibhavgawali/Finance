<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanAddress extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'loan_address';

    protected $fillable = [
        'loan_id','present_line1', 'present_line2', 'present_line3', 'present_landmark', 'present_state', 'present_city', 'present_pincode', 'present_phone',
        'office_line1', 'office_line2', 'office_line3', 'office_landmark', 'office_state', 'office_city', 'office_pincode', 'office_phone',
    ];
}
