<?php

namespace App\Modules\Client\Account\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Modules\Client\Account\Models\Traits\AccountAttribute;
use App\Modules\Client\Account\Models\Traits\AccountRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Plank\Mediable\Mediable;

class User extends Authenticatable
{
    use HasApiTokens,
        HasFactory,
        Notifiable,
        Mediable,
        AccountRelationship,
        AccountAttribute;

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
