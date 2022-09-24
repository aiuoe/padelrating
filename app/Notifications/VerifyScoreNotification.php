<?php

namespace App\Notifications;

use App\Models\Score;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifyScoreNotification extends Notification
{
    use Queueable;

    private $score = null;

    public function __construct(Score $score)
    {
        $this->score = $score;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(trans('message.subjectVerifyScore'))
            ->greeting(trans('message.hello'))
            ->line("Uno de tus contringantes ha subido un nuevo resultado. Tienes 24 horas para aprobarlo o rechazarlo.")
            ->action("Comprobar", route('player.scores.verify', $this->score->id))
            ->line(trans('global.thankYouForUsingOurApplication'))
            ->salutation(trans('message.salutation'));
    }

    public function toArray($notifiable)
    {
        return [];
    }
}
