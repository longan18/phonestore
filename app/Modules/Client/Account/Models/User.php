<?php

namespace App\Modules\Client\Account\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected string $guard = 'web';

    protected $hidden = ['password'];

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
    ];

    const AUTH = [
        'email',
        'password'
    ];
}
