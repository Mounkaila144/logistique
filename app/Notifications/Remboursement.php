<?php

namespace App\Notifications;

use App\Models\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Remboursement extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function via($notifiable)
    {
        return ['database']; // ou autre canal comme 'mail', 'sms', etc.
    }


    public function toDatabase($notifiable)
    {
        return [
            'message' => "Notification: " . $this->client->nom . " " . $this->client->prenom . ", avec id= " . $this->client->id . " devrais rembourser les " . number_format($this->client->restant(), 0, ',', ' ') . " CFA qu'il vous doit, à la date du " . \Carbon\Carbon::parse($this->client->date_remboursement)->isoFormat('dddd D/M/YYYY'),
            // Autres informations pertinentes ici...
        ];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
