<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable =   ['uid_no', 'first_name', 'middle_name',
                            'last_name', 'gender', 'dob', 'image',
                            'adhaar_no', 'nickname', 'martial_status',
                            'father_name', 'mother_name', 'guardian_name',
                            'guardian_relation', 'status'];

    protected $dates    =   ['dob', 'created_at', 'updated_at'];

    /**
     * File: Student.php
     * Description: relationships codes
     * Author: Debanjan Roy
     * Created on: 2025-04-16
     */

    public function address() {
        return $this->hasOnly(StudentAddress::class, 'student_id', 'id');
    }

    public function contact() {
        return $this->hasOnly(StudentContact::class, 'student_id', 'id');
    }

    public function courseObtain() {
        return $this->hasMany(CourseObtain::class, 'student_id', 'id');
    }
}
