<?php

namespace App\Modules\Notification\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Modules\Notification\Http\Requests\NotificationRequest;
use App\Modules\Notification\Interfaces\NotificationInterface;
use App\Modules\Notification\Models\Notification;

/**
 * @NotificationController
 */
class NotificationController extends Controller
{
    protected $notification;

    /**
     * @param NotificationInterface $notification
     */
    public function __construct(NotificationInterface $notification)
    {
        $this->notification = $notification;
    }

    public function update(Request $request)
    {
        $result = $this->notification->updateStatusNoti($request->all());

        return $result ? $this->responseSuccess(message: __('Cập nhật trạng thái thông báo thành công'))
            : $this->responseFailed(message: __('Có một lỗi xảy ra, vui lòng thử lại trong giây lát'));
    }
}
