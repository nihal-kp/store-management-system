<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Authenticatable
{
    use Notifiable, SoftDeletes;
    
    protected $fillable = ['name', 'email', 'password', 'phone', 'status', 'verification_status', 'verification_otp', 'otp_verification_status', 'created_by'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    // Mutator to hash the password before saving
    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = Hash::make($value);
    // }

}
