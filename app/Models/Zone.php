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

    public function parent() {
        return $this->belongsTo(Zone::class, 'parent_zone', 'id');
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

    public function zoneColorPanel() {
        switch ($this->zone_type) {
            case ZoneType::HEADQUARTERS:
                return 'background-color:rgb(242, 212, 212); color:black';
                break;
            case ZoneType::ADMIN:
                return 'background-color:rgb(212, 242, 216); color:black';
            case ZoneType::STATE:
                return 'background-color:rgb(212, 218, 242); color:black';
            case ZoneType::DISTRICT:
                return 'background-color:rgb(240, 242, 212); color:black';
            case ZoneType::BRANCH:
                return 'background-color:rgb(212, 240, 242); color:black';
            case ZoneType::UNIT:
                return 'background-color:rgb(255, 255, 255); color:black';
            default:
                return 'background-color:rgb(231, 162, 232); color:black';
                break;
        }
    }
}
