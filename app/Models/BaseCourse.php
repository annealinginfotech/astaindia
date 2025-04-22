<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Enums\BaseCourseStatus;

class BaseCourse extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'status'
    ];

    protected $dates    =   ['created_at'];


    public function scopeActive($query): void {
        $query->where('status', BaseCourseStatus::ACTIVE);
    }
}
