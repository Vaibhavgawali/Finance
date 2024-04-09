<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'loan';

    protected $fillable = [
        'referred_by','loan_type', 'mobile', 'name', 'income_source', 'email', 'monthly_income', 'pincode', 'adhar_num', 'dob', 'loan_amount',
        'pan_num', 'credit_score', 'marital_status', 'mother_name', 'select_document_type', 'upload_document','status','application_stage','approval_date','remark'
    ];

    public function loan_address() 
    {
        return $this->hasOne(LoanAddress::class,'loan_id','id');
    }

    public function loanRefer() 
    {
        return $this->hasOne(User::class,'referral_id','referred_by');
    }
    
}
