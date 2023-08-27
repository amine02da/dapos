<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;

class SendDataToUserCreatedNotification extends Notification
{
    use Queueable;

    protected $userData;
    protected $password;
    protected $permissionData;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, $password)
    {
        $this->userData = $user;
        $this->password = $password;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        
        return (new MailMessage)
                    ->line(
                        "I hope this message finds you well. 
                        I am writing to inform you that we 
                        have successfully created an account 
                        for you on our Pos
                        Management application. We are excited to have you on board!"
                    )
                    ->line(
                        "Your account has been set up with specific 
                        permissions tailored to your role and responsibilities. "
                    )
                    ->line(
                        "Here are some key details about your account:"
                    )
                    ->line("Username: " .  $this->userData->email)
                    ->line("Password: " . $this->password)
                    ->action('Login', url('/login'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
