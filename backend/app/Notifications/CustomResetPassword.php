<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPassword extends Notification
{

    public function __construct(private $token) {}

    // Define the channels that will be used for the notification
    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        // Generate the password reset URL with the token and user's email.
        $url = url(route('password.reset.form', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('Reset your password of FlashFoods')
            ->view('emails.reset-password-email', [
                'actionUrl' => $url,
            ]);
    }
}
