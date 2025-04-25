<?php

namespace App\Listeners;

use IlluminateAuthEventsLogout;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogLogoutActivity
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    // public function handle(IlluminateAuthEventsLogout $event): void
    // {
    //     //
    // }

    public function handle(Logout $event)
    {
        Log::info('User logged out:', ['user_id' => $event->user->id ?? null]);
    }
}
