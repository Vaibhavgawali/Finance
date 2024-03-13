<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressProofDocuments extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'address_proof_documents';

    protected $fillable = [
        'user_document_id',
        'address_proof_name',
        'document_number'
    ];
}
