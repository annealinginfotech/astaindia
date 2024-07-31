<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\ZoneStatus;
use App\Enums\ZoneType;

class Zone extends Model
{
    use HasFactory;

    protected $fillable =   ['zone_name', 'zone_type', 'parent_zone', 'address', 'phone_no'];

    public function scopeActive($query): void {
        $query->where('status', ZoneStatus::ACTIVE);
    }

    public function getStatus(){
        switch ($this->status) {
            case ZoneStatus::ACTIVE:
                return ['color' => 'status-green', 'status' =>  'Active'];
                break;
            case ZoneStatus::INACTIVE:
                return ['color' => 'status-red', 'status' =>  'Inactive'];
            default:
                return ['color' => 'status-info', 'status' =>  ucfirst($this->status)];
                break;
        }
    }
}
