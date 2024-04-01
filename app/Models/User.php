<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $fillable = [
        'name', 'email', 'password', 'username', 'provider', 'provider_id', 'provider_token', 'avatar'
    ];

    protected $hidden = [
        'password', 'remember_token', 'two_factor_recovery_codes', 'two_factor_secret',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    public static function generateUserName($username)
    {
        if ($username === null) {
            $username = Str::lower(Str::random(8));
        }
        if (User::where('username', $username)->exists()) {
            $newUsername = $username . Str::lower(Str::random(3));
            $username = self::generateUserName($newUsername);
        }
        return $username;
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }


    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

}

