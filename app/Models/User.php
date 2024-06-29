<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
use App\Enums\UserStatus;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'added_by',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function profile() {
        return $this->hasOne(UserProfile::class, 'user_id', 'id');
    }

    public function bankDetails() {
        return $this->hasOne(UserBankDetails::class, 'user_id', 'id');
    }

    public function documents() {
        return $this->hasOne(UserDocumentDetails::class, 'user_id', 'id');
    }

    public function qualifications() {
        return $this->hasOne(UserQualificationDetails::class, 'user_id', 'id');
    }

    public function contactDetails() {
        return $this->hasOne(UserContactDetails::class, 'user_id', 'id');
    }

    public function getAgeAttribute() {
        return Carbon::parse($this->profile->date_of_birth)->age;
    }

    public function getAddedByNameAttribute() {
        return User::findOrFail($this->added_by)->value('name');
    }

    public function getDpAttribute() {
        if($this->documents) {
            return asset('storage/'.$this->documents->photo);
        } else {
            return asset('static/avatars/default.png');
        }

    }

    public function getStatus(){
        switch ($this->status) {
            case UserStatus::ACTIVE:
                return ['color' => 'status-green', 'status' =>  'Active'];
                break;
            case UserStatus::BLOCK:
                return ['color' => 'status-red', 'status' =>  'Inactive'];
            default:
                return ['color' => 'status-info', 'status' =>  ucfirst($this->status)];
                break;
        }
    }
}
