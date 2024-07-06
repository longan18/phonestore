<?php

namespace App\Modules\Notification\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Modules\Notification\Interfaces\NotificationInterface;
use App\Modules\Notification\Models\Notification;
use App\Services\BaseService;

/**
 * @NotificationService
 */
class NotificationService extends BaseService implements NotificationInterface
{
    /**
     * @param Notification $notification
     */
    public function __construct(Notification $notification)
    {
        $this->model = $notification;
    }

    public function createNotification($data)
    {
        DB::beginTransaction();
        try {

            $this->create($data);

            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("--msg: {$exception->getMessage()} \n--line: {$exception->getLine()} \n--file: {$exception->getFile()}");
        }

        return false;
    }
}
