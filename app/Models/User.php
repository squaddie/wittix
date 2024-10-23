<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 * @package App\Models\User
 *
 * @property string $user_name
 * @property string $first_name
 * @property string $last_name
 * @property string $password
 * @property string $remember_token
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    private const USER_UNIQUE_SUFFIX_ITERATOR = 1;

    /** @var string[] */
    protected $fillable = [
        'user_name',
        'first_name',
        'last_name',
        'password',
    ];
    /** @var string[] */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /** @var string[] */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * @return null|User
     */
    public function fetchLastUser(): ?User
    {
        return $this->latest()->first();
    }

    /**
     * @return int
     */
    public function getUniqueSuffix(): int
    {
        $segments = explode('_', $this->user_name);

        return (int)end($segments) + self::USER_UNIQUE_SUFFIX_ITERATOR;
    }
}
