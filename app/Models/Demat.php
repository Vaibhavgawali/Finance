<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demat extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'demat';

    protected $fillable = [
        'referred_by','phone', 'name', 'adhar_num','pan_num','status','application_stage','approval_date','remark'
    ];

    public function dematRefer() 
    {
        return $this->hasOne(User::class,'referral_id','referred_by');
    }

}
