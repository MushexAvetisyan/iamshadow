<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Telegram\Bot\Api;

class NotifyTelegramOnUserRegistration
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
        $telegram = new Api(env('TELEGRAM_BOT_TOKEN'));

        $user = $event->user;
        $message = 'Welcome, ' . $user->name . '! Email: ' . $user->email . '. A new user has registered on the website.';
        $totalUsers = \App\Models\User::count();
        $message .= "\nTotal registered users: {$totalUsers}";

        $telegram->sendMessage([
            'chat_id' => env('TELEGRAM_CHAT_ID'), // Your Telegram chat ID
            'text' => $message,
        ]);
    }
}
