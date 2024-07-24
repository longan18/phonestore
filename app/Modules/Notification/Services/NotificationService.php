<?php

namespace App\Modules\Notification\Services;

use App\Enums\NotiReadEnum;
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
            $notiSendSuccess = $this->where('user_id', $data['user_id'], '=')
                ->where('content', '%'.$data['content'].'%', 'like')->first();

            if (!$notiSendSuccess) {
                $this->create($data);
            }

            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("--msg: {$exception->getMessage()} \n--line: {$exception->getLine()} \n--file: {$exception->getFile()}");
        }

        return false;
    }

    public function updateStatusNoti($request)
    {
        DB::beginTransaction();
        try {
            $this->model->where($request)->update(['is_read' => NotiReadEnum::IS_READ_TRUE->value]);

            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("--msg: {$exception->getMessage()} \n--line: {$exception->getLine()} \n--file: {$exception->getFile()}");
        }

        return false;
    }
}
