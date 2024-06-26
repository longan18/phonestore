<?php

namespace App\Modules\OrderDetail\Models\Traits;

use App\Enums\StatusOrder;
use App\Enums\StatusPaymentOrder;
use App\Enums\StatusShippingOrder;

/**
 * @OrderDetailAttribute
 */
trait OrderDetailAttribute
{
    public function getProvinceAttribute()
    {
        return $this->addressShipping->address->province->name;
    }

    public function getDistrictAttribute()
    {
        return $this->addressShipping->address->district->name;
    }

    public function getWardAttribute()
    {
        return $this->addressShipping->address->ward->name;
    }

    public function getAddressDetailAttribute()
    {
        return $this->addressShipping->address->address_detail;
    }

    /**
     * @return Collection
     */
    public function getStatusOrderAttribute()
    {
        $data = collect();

        switch ($this->status) {
            case StatusOrder::ORDER_WRATING->value:
                $data->text = StatusOrder::ORDER_WRATING->getText();
                $data->text_admin = StatusOrder::ORDER_WRATING->getTextAdmin();
                $data->color = StatusOrder::ORDER_WRATING->getColor();
                break;
            case StatusOrder::ORDER_CONFIRMED->value:
                $data->text = StatusOrder::ORDER_CONFIRMED->getText();
                $data->text_admin = StatusOrder::ORDER_CONFIRMED->getTextAdmin();
                $data->color = StatusOrder::ORDER_CONFIRMED->getColor();
                break;
            case StatusOrder::ORDER_CANCEL->value:
                $data->text = StatusOrder::ORDER_CANCEL->getText();
                $data->text_admin = StatusOrder::ORDER_CANCEL->getTextAdmin();
                $data->color = StatusOrder::ORDER_CANCEL->getColor();
                break;
        }

        return $data;
    }

    /**
     * @return Collection
     */
    public function getStatusOrderPaymentAttribute()
    {
        $data = collect();

        switch ($this->status_payment) {
            case StatusPaymentOrder::ORDER_PAYMENT_UNPAID->value:
                $data->text = StatusPaymentOrder::ORDER_PAYMENT_UNPAID->getText();
                $data->color = StatusPaymentOrder::ORDER_PAYMENT_UNPAID->getColor();
                break;
            case StatusPaymentOrder::ORDER_PAYMENT_PAID->value:
                $data->text = StatusPaymentOrder::ORDER_PAYMENT_PAID->getText();
                $data->color = StatusPaymentOrder::ORDER_PAYMENT_PAID->getColor();
                break;
        }

        return $data;
    }


    /**
     * @return Collection
     */
    public function getStatusOrderShippingAttribute()
    {
        $data = collect();

        switch ($this->status_shipping) {
            case StatusShippingOrder::ORDER_SHIP_WRATING->value:
                $data->text = StatusShippingOrder::ORDER_SHIP_WRATING->getText();
                $data->color = StatusShippingOrder::ORDER_SHIP_WRATING->getColor();
                break;
            case StatusShippingOrder::ORDER_SHIP_DELIVERING->value:
                $data->text = StatusShippingOrder::ORDER_SHIP_DELIVERING->getText();
                $data->color = StatusShippingOrder::ORDER_SHIP_DELIVERING->getColor();
                break;
            case StatusShippingOrder::ORDER_SHIP_SUCCESSFUL->value:
                $data->text = StatusShippingOrder::ORDER_SHIP_SUCCESSFUL->getText();
                $data->color = StatusShippingOrder::ORDER_SHIP_SUCCESSFUL->getColor();
                break;
        }

        return $data;
    }
}
