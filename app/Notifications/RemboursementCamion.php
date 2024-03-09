<?php

namespace App\Notifications;

use App\Models\Camion;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RemboursementCamion extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(Camion $camion)
    {
        $this->camion = $camion;
    }

    public function via($notifiable)
    {
        return ['database']; // ou autre canal comme 'mail', 'sms', etc.
    }


    public function toDatabase($notifiable)
    {
        return [
            'message' => "Le Camion avec le matricul: " . $this->camion->matricule . ", avec id= " . $this->camion->id . " vous lui devez" . number_format($this->camion->restant(), 0, ',', ' ') . " CFA ,Vous devriez Rembourser le " . \Carbon\Carbon::parse($this->camion->date_remboursement)->isoFormat('dddd D/M/YYYY'),
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
