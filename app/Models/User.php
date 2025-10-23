<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public const ROLE_ADMIN = 'admin';
    public const ROLE_USER = 'user';
    public const ROLES = [self::ROLE_ADMIN, self::ROLE_USER];

    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }
    public function isUser()
    {
        return $this->role === self::ROLE_USER;
    }

    /**
     * Get the entries for the user.
     */
    public function entries()
    {
        return $this->hasMany(Entry::class);
    }
}
