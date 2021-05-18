<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserApprovedNotification extends Notification
{
    use Queueable;

    private $user = null;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject("Cuenta de usuario aprobada")
            ->greeting(trans('message.hello'))
            ->line("Tu cuenta ha sido aprobada y ya puedes entrar en My padel Rating")
            ->action("Entrar ahora", route('player.home'))
            ->line(trans('global.thankYouForUsingOurApplication'))
            ->salutation(trans('message.salutation'));
    }

    public function toArray($notifiable)
    {
        return [];
    }
}
