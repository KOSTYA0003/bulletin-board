<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'avatar',
        'email_verified_at',
        'email_verification_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_banned' => 'boolean',
    ];

    public function advertisements()
    {
        return $this->hasMany(Advertisement::class);
    }

    public function generateVerificationToken()
    {
        $this->email_verification_token = Str::random(60);
        $this->save();

        return $this->email_verification_token;
    }

    public function markEmailAsVerified()
    {
        $this->email_verified_at = now();
        $this->email_verification_token = null;
        $this->save();
    }

    public function isEmailVerified()
    {
        return ! is_null($this->email_verified_at);
    }

    public function isUser()
    {
        return $this->role === 'user';
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isBanned()
    {
        return $this->is_banned === true;
    }

    public function activeAdvertisements()
    {
        return $this->advertisements()->where('status', 'approved');
    }

    public function pendingAdvertisements()
    {
        return $this->advertisements()->where('status', 'pending');
    }
}
