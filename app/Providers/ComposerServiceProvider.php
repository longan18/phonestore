<?php

namespace App\Providers;

use App\Enums\NotiReadEnum;
use App\Modules\Admin\Brand\Interfaces\BrandInterface;
use App\Modules\Admin\Color\Interfaces\ColorInterface;
use App\Modules\Admin\Ram\Interfaces\RamInterface;
use App\Modules\Admin\StorageCapacity\Interfaces\StorageCapacityInterface;
use App\Modules\Notification\Interfaces\NotificationInterface;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     */
    public function boot(
        BrandInterface $brandInterface,
        RamInterface $ramInterface,
        StorageCapacityInterface $storageCapacityInterface,
        ColorInterface $colorInterface,
        NotificationInterface $notificationInterface,
    ) {
        View::composer(
            [
                'admin.product-smartphone.index',
                'admin.product-smartphone.form'
            ],
            function ($view) use ($brandInterface) {
                $view->with(
                    [
                        'brands' => $brandInterface->all(),
                    ]
                );
            }
        );

        View::composer(
            [
                'admin.product-smartphone.option.form',
            ],
            function ($view) use ($ramInterface, $storageCapacityInterface, $colorInterface) {
                $view->with(
                    [
                        'rams' => $ramInterface->all(),
                        'storageCapacities' => $storageCapacityInterface->all(),
                        'colors' => $colorInterface->all(),
                    ]
                );
            }
        );

        View::composer(
            [
                'client.layouts.top_info',
            ],
            function ($view) use ($notificationInterface) {
                $view->with(
                    [
                        'quantityCart' => userInfo()->count_shopping_item ?? null,
                        'totalCart' => userInfo()->shoppingSession->price_total ?? null,
                        'notifi' => userInfo() ? userInfo()->notifis()->orderByDesc('created_at')->get() : null,
                        'qtyNotiNoRead' => userInfo() ? userInfo()->notifis()->where('is_read', NotiReadEnum::IS_READ_FALSE->value)->count() : null,
                    ]
                );
            }
        );
    }
}
