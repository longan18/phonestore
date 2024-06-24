<?php

namespace App\Observers;

use App\Modules\ShoppingSession\Models\ShoppingSession;

class ShoppingSessionObserver
{
    /**
     * Handle the ShoppingSession "created" event.
     */
    public function created(ShoppingSession $shoppingSession): void
    {
        //
    }

    /**
     * Handle the ShoppingSession "updated" event.
     */
    public function updated(ShoppingSession $shoppingSession): void
    {
        //
    }

    /**
     * Handle the ShoppingSession "deleted" event.
     */
    public function deleted(ShoppingSession $shoppingSession): void
    {
        $shoppingSession->shoppingItems()->delete();
    }

    /**
     * Handle the ShoppingSession "restored" event.
     */
    public function restored(ShoppingSession $shoppingSession): void
    {
        //
    }

    /**
     * Handle the ShoppingSession "force deleted" event.
     */
    public function forceDeleted(ShoppingSession $shoppingSession): void
    {
        //
    }
}
