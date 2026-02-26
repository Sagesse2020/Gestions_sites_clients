<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\HebergementClient;


class HebergementExpireNotification extends Notification
{
    use Queueable;

    public HebergementClient $hebergement;

    public function __construct(HebergementClient $hebergement)
    {
        $this->hebergement = $hebergement;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('⚠️ Expiration de votre hébergement')
            ->view('emails.alerte-hebergement', [
                'hebergement' => $this->hebergement
            ]);
    }
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
