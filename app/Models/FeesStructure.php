<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Enums\FeesType;

class FeesStructure extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable =   ['main_course_id', 'fees_type', 'amount', 'status'];

    protected $dates    =   ['created_at'];

    public function mainCourse() {
        return $this->belongsTo(MainCourse::class, 'main_course_id', 'id');
    }

    public function scopeMonthly(Builder $query): void {
        $query->where('fees_type', FeesType::MONTHLY);
    }
}
