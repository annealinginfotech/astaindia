<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDocumentDetails extends Model
{
    use HasFactory;

    protected $fillable =   ['user_id', 'identity_proof', 'photo', 'signature', 'last_qualification'];
}
