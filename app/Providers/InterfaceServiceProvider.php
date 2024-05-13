<?php

namespace App\Providers;

use App\Modules\Admin\Account\Interfaces\AccountAdminInterface;
use App\Modules\Admin\Account\Services\AccountAdminService;
use App\Modules\Admin\Brand\Interfaces\BrandInterface;
use App\Modules\Admin\Brand\Services\BrandService;
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
