<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAddress extends Model
{
    use HasFactory;

    protected $fillable =   [
        'student_id',
        'present_address',
        'permanent_address'
    ];

    protected $dates    =   ['created_at', 'updated_at'];

    protected $casts    =   [
        'present_address'   =>  'array',
        'permanent_address' =>  'array'
    ];
}
