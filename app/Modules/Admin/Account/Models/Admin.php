<?php

namespace App\Modules\Admin\Account\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @Admin
 *
 * @property string first_name
 * @property string last_name
 * @property string email
 * @property string phone
 * @property string addess
 * @property string password
 */
class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'admins';
    protected $primaryKey = 'id';

    protected string $guard = 'admin';

    protected $hidden = ['password'];

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'address',
        'email',
        'password',
    ];
}
