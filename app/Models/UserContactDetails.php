<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserContactDetails extends Model
{
    use HasFactory;

    protected $fillable =   ['user_id', 'address', 'primary_contact', 'secondary_contact', 'whatsapp_number', 'emergency_contact'];
}
