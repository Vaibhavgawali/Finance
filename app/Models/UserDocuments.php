<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDocuments extends Model
{
    use HasFactory;
    protected $table = 'user_documents';

    protected $fillable = [
        'user_id',
        'document_title',
        'document_url',
    ];

}
