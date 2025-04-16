<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseObtain extends Model
{
    use HasFactory;

    protected $fillable =   [
        'student_id',
        'main_course_id',
        'center_id',
        'registration_date',
        'status'
    ];

    protected $dates    =   ['registration_date'];
}
