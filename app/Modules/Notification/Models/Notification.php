<?php

namespace App\Modules\Notification\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Modules\Notification\Models\Traits\NotificationAttribute;
use App\Modules\Notification\Models\Traits\NotificationScope;
use App\Modules\Notification\Models\Traits\NotificationRelationship;
use App\Modules\Notification\Models\Traits\NotificationMethod;

use Plank\Mediable\Mediable;

/**
 * @Notification
 *
 * TODO attribute model
 */
class Notification extends Model
{
     use HasFactory,
         Mediable,
         NotificationAttribute,
         NotificationScope,
         NotificationRelationship,
         NotificationMethod;

    protected $table = 'notifications';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'noti_type',
        'content',
        'is_read',
    ];
}
