<?php

namespace App\Models;

use App\Enums\ZoneType;
use App\Enums\CenterStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Center extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable =   ['code', 'name', 'type', 'state_id', 'address', 'phone', 'email'];

    public function scopeActive($query): void {
        $query->where('status', CenterStatus::ACTIVE);
    }

    public function controlCenter() {
        return $this->hasOne(ControlCenter::class, 'center_id', 'id');
    }

    public function parentalControl() {
        return $this->controlCenter->parentZone;
    }

    public function getStatus(){
        switch ($this->status) {
            case CenterStatus::ACTIVE:
                return ['color' => 'status-green', 'status' =>  'Active'];
                break;
            case CenterStatus::INACTIVE:
                return ['color' => 'status-red', 'status' =>  'Inactive'];
            default:
                return ['color' => 'status-info', 'status' =>  ucfirst($this->status)];
                break;
        }
    }

    public function zoneColorPanel() {
        switch ($this->type) {
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
