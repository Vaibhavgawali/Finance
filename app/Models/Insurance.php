<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'insurance';

    protected $fillable = ['urc','umc','ak','name','email','phone','pin','referral_id','status','application_stage','approval_date','remark'];

}
