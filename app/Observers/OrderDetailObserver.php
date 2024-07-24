<?php

namespace App\Observers;

use App\Enums\NotiTypeEnum;
use App\Enums\StatusEnum;
use App\Enums\StatusOrder;
use App\Enums\StatusPaymentOrder;
use App\Enums\StatusShippingOrder;
use App\Modules\Notification\Interfaces\NotificationInterface;
use App\Modules\OrderDetail\Models\OrderDetail;


class OrderDetailObserver
{
    protected $notification;
    public function __construct(NotificationInterface $notification)
    {
        $this->notification = $notification;
    }

    /**
     * Handle the OrderDetail "created" event.
     */
    public function created(OrderDetail $orderDetail): void
    {
        //
    }

    /**
     * Handle the OrderDetail "updated" event.
     */
    public function updated(OrderDetail $orderDetail): void
    {
        $data = [
            'user_id' => $orderDetail->user_id,
            'noti_type' => NotiTypeEnum::ORDER->value,
        ];

        if ($orderDetail->status == StatusOrder::ORDER_CONFIRMED->value) {
            $data['content'] = StatusOrder::ORDER_CONFIRMED->getTextNoti($orderDetail->uuid);
            $this->notification->createNotification($data);
        }

        if ($orderDetail->status == StatusOrder::ORDER_CANCEL->value) {
            $data['content'] = StatusOrder::ORDER_CANCEL->getTextNoti($orderDetail->uuid);
            $this->notification->createNotification($data);
        }

        if ($orderDetail->status_shipping == StatusShippingOrder::ORDER_SHIP_DELIVERING->value) {
            $data['content'] = StatusShippingOrder::ORDER_SHIP_DELIVERING->getTextNoti($orderDetail->uuid);
            $this->notification->createNotification($data);
        }

        if ($orderDetail->status_shipping == StatusShippingOrder::ORDER_SHIP_SUCCESSFUL->value) {
            $data['content'] = StatusShippingOrder::ORDER_SHIP_SUCCESSFUL->getTextNoti($orderDetail->uuid);
            $this->notification->createNotification($data);
        }

        if ($orderDetail->status_payment == StatusPaymentOrder::ORDER_PAYMENT_PAID->value) {
            $data['content'] = StatusPaymentOrder::ORDER_PAYMENT_PAID->getTextNoti($orderDetail->uuid);
            $this->notification->createNotification($data);
        }
    }

    /**
     * Handle the OrderDetail "deleted" event.
     */
    public function deleted(OrderDetail $orderDetail): void
    {
        //
    }

    /**
     * Handle the OrderDetail "restored" event.
     */
    public function restored(OrderDetail $orderDetail): void
    {
        //
    }

    /**
     * Handle the OrderDetail "force deleted" event.
     */
    public function forceDeleted(OrderDetail $orderDetail): void
    {
        //
    }
}
