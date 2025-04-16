<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentContact extends Model
{
    use HasFactory;

    protected $fillable =   [
        'student_id',
        'student_contact',
        'student_contact2',
        'student_whatsapp',
        'student_email',
        'guardian_contact',
        'guardian_whatsapp'
    ];



}
