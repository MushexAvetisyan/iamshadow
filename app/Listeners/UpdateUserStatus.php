<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;

class UpdateUserStatus
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
    public function handle(Login $event): void
    {
        $user = $event->user;
        $user->is_active = true;
        $user->save();
    }
}
