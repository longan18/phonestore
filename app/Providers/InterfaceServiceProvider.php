<?php

namespace App\Providers;

use App\Modules\Admin\Account\Interfaces\AccountAdminInterface;
use App\Modules\Admin\Account\Services\AccountAdminService;
use App\Modules\Admin\Brand\Interfaces\BrandInterface;
use App\Modules\Admin\Brand\Services\BrandService;
use App\Modules\Admin\Color\Interfaces\ColorInterface;
use App\Modules\Admin\Color\Services\ColorService;
use App\Modules\Admin\Product\Interfaces\ProductInterface;
use App\Modules\Admin\Product\Services\ProductService;
use App\Modules\Admin\ProductSmartphone\Interfaces\ProductSmartphoneInterface;
use App\Modules\Admin\ProductSmartphone\Services\ProductSmartphoneService;
use App\Modules\Admin\ProductSmartphonePrice\Interfaces\ProductSmartphonePriceInterface;
use App\Modules\Admin\ProductSmartphonePrice\Services\ProductSmartphonePriceService;
use App\Modules\Admin\Ram\Interfaces\RamInterface;
use App\Modules\Admin\Ram\Services\RamService;
use App\Modules\Admin\StorageCapacity\Interfaces\StorageCapacityInterface;
use App\Modules\Admin\StorageCapacity\Services\StorageCapacityService;
use App\Modules\Media\Interfaces\MediaInterface;
use App\Modules\Media\Services\MediaService;
use Illuminate\Support\ServiceProvider;

class InterfaceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AccountAdminInterface::class, AccountAdminService::class);
        $this->app->singleton(MediaInterface::class, MediaService::class);
        $this->app->singleton(BrandInterface::class, BrandService::class);
        $this->app->singleton(ProductInterface::class, ProductService::class);
        $this->app->singleton(ProductSmartphoneInterface::class, ProductSmartphoneService::class);
        $this->app->singleton(ProductSmartphonePriceInterface::class, ProductSmartphonePriceService::class);
        $this->app->singleton(ProductInterface::class, ProductService::class);
        $this->app->singleton(RamInterface::class, RamService::class);
        $this->app->singleton(StorageCapacityInterface::class, StorageCapacityService::class);
        $this->app->singleton(ColorInterface::class, ColorService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
