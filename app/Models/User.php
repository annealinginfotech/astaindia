<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
}
