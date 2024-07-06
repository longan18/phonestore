<?php

namespace App\Providers;

use App\Modules\Admin\Brand\Models\Brand;
use App\Modules\Admin\Product\Models\Product;
use App\Modules\Client\Account\Models\User;
use App\Modules\ShoppingSession\Models\ShoppingSession;
use App\Observers\BrandObserver;
use App\Observers\ProductObserver;
use App\Observers\ShoppingSessionObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Brand::observe(BrandObserver::class);
        ShoppingSession::observe(ShoppingSessionObserver::class);
        Product::observe(ProductObserver::class);
//        User::observe(UserObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
