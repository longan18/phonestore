<?php

namespace App\Providers;

use App\Modules\Admin\Brand\Interfaces\BrandInterface;
use App\Modules\Admin\Color\Interfaces\ColorInterface;
use App\Modules\Admin\Ram\Interfaces\RamInterface;
use App\Modules\Admin\StorageCapacity\Interfaces\StorageCapacityInterface;
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
        ColorInterface $colorInterface
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
    }
}
