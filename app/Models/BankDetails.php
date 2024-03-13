<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankDetails extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bank_details';

    protected $fillable = [
        'user_id',
        'bank_name',
        'acc_holder_name',
        'acc_number',
        'ifsc_code',
    ];
}
