<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'id_user';

    protected $fillable = [
        'name',
        'photo',
        'username',
        'password',
        'type',
        'id_fraction',
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

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function fraction(){
        return $this->belongsTo(Fraction::class, 'id_fraction', 'id_fraction');
    }

    public function work_plan(){
        return $this->hasMany(WorkPlan::class, 'id_user', 'id_user');
    }

    public function isSuperAdmin(){
        return $this->type == 'superadmin';
    }
}
