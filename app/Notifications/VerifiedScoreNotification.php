<?php

namespace App\Notifications;

use App\Models\Score;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifiedScoreNotification extends Notification
{
    use Queueable;


    public function __construct()
    {
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject("Resultado verificado")
            ->greeting(trans('message.hello'))
            ->line("Ha sido verificado el resultado de tu partido")
            ->action("Ver", route('player.home'))
            ->line(trans('global.thankYouForUsingOurApplication'))
            ->salutation(trans('message.salutation'));
    }

    public function toArray($notifiable)
    {
        return [];
    }
}
