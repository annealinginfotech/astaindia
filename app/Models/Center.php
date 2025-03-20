<?php

namespace App\Models;

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
}
