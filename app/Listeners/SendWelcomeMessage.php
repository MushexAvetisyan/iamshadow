<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Milly\Laragram\Laragram;

class SendWelcomeMessage
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
    public function handle(UserRegistered $event): void
    {
        $user = $event->user;
        $message = 'Welcome, ' . $user->name . '! Email: ' . $user->email . '. A new user has registered on the website.';
        // Send message using Laragram
        Laragram::sendMessage(
            '7181996723',
            null,
            $message
        );
    }
}
