<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class MainCourse extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable =   ['course_code', 'base_course_id', 'name', 'min_qualification', 'status'];

    protected $dates    =   ['created_at'];

    public function baseCourse() {
        return $this->belongsTo(BaseCourse::class, 'base_course_id', 'id');
    }
}
