<?php

namespace App\Providers;

use App\Modules\Admin\Brand\Interfaces\BrandInterface;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     */
    public function boot(
        BrandInterface $brandInterface,
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
    }
}
