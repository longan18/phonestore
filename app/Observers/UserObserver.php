<?php

namespace App\Observers;

use App\Enums\NotiTypeEnum;
use App\Modules\Client\Account\Models\User;
use App\Modules\Notification\Interfaces\NotificationInterface;

class UserObserver
{
    protected $notification;
    public function __construct(NotificationInterface $notification)
    {
        $this->notification = $notification;
    }

    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $data = [
            'user_id' => $user->id,
            'noti_type' => NotiTypeEnum::NEW_USER->value,
            'content' => NotiTypeEnum::NEW_USER->getTextNoti($user->name),
        ];

        $this->notification->createNotification($data);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
