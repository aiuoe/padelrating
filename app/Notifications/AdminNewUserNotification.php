<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminNewUserNotification extends Notification
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
            ->subject("Nuevo usuario registrado pendiente de verificar")
            ->greeting(trans('message.hello'))
            ->line("Un nuevo usuario se acaba de registrar en la plataforma")
            ->action("Ir al panel de control", route('admin.users.edit', $this->user->id))
            ->line(trans('global.thankYouForUsingOurApplication'))
            ->salutation(trans('message.salutation'));
    }

    public function toArray($notifiable)
    {
        return [];
    }
}
