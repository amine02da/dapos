<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use App\Notifications\SendDataToUserCreatedNotification;
use Illuminate\Support\Facades\Crypt;

class SendDataToCreatedUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($userData,$password)
    {
        $user = User::where("id", $userData->id)->first();
        $user->notify(new SendDataToUserCreatedNotification($userData,$password));
    }
}
