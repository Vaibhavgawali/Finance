<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceCallback extends Model
{
    use HasFactory;
    protected $table = "insurance_callback";
    protected $fillable = [
        'referred_by',
        'InsurerID',
        'InsurerName',
        'EnquiryType',
        'TotalPremium',
        'EnquiryNo',
        'PolicyNo',
        'PolicyStatus',
        'VehicleNo',
        'PolicyHolderName',
        'status',
        'approval_date',
        'remark'
    ];

    public function insuranceRefer()
    {
        return $this->hasOne(User::class, 'referral_id', 'referred_by');
    }
}
