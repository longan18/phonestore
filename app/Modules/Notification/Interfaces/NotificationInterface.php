<?php

namespace App\Modules\Notification\Interfaces;

/**
 * @NotificationInterface
 */
interface NotificationInterface
{
    public function createNotification($data);
}
