<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\ZoneType;

class ControlCenter extends Model
{
    use HasFactory;

    protected $fillable =   ['center_id', 'state_id', 'control_type', 'control_center_id', 'assigned_user'];


    public function parentZone() {
        if($this->control_type == ZoneType::HEADQUARTERS)
            return $this->belongsTo(Zone::class, 'control_center_id', 'id');
        else
            return $this->belongsTo(Center::class, 'control_center_id', 'id');
    }
}
