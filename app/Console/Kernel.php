<?php

namespace App\Console;

use App\Models\Camion;
use App\Models\Client;
use App\Models\User;
use App\Notifications\Remboursement;
use App\Notifications\RemboursementCamion;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Twilio\Rest\Client as TwilioClient;


class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $clients = Client::where('notification', false)->get();
            $camions = Camion::where('notification', false)->get();

            $adminUser = User::first(); // Obtenez le premier utilisateur
            if ($adminUser) {
                foreach ($clients as $client) {
                    if ($client->remboursementDepasse() && $client->restant() > 0) {
                        $sid    = env('TWILIO_SID');
                        $token  = env('TWILIO_TOKEN');
                        $twilio = new TwilioClient($sid, $token);

                        $to =env('TWILIO_WHATSAPP_TO') ; // Le numéro du destinataire
                        $from =env('TWILIO_WHATSAPP_FROM') ; // Votre numéro Twilio WhatsApp

                        $message = $twilio->messages
                            ->create($to, [
                                "from" => $from,
                                "body" => "Le client : " . $client->nom . " " . $client->prenom . ", avec id= " . $client->id . " devrais rembourser les " . number_format($client->restant(), 0, ',', ' ') . " CFA qu'il vous doit, à la date du " . \Carbon\Carbon::parse($client->date_remboursement)->isoFormat('dddd D/M/YYYY'),
                            ]);
                        // Envoyez la notification à cet utilisateur
                        $adminUser->notify(new Remboursement($client));
                        // Marquez que la notification a été envoyée
                        $client->notification = true;
                        $client->save();
                    }
                }
                foreach ($camions as $camion) {
                    if ($camion->remboursementDepasse() && $camion->restant() > 0) {
                        $sid    = env('TWILIO_SID');
                        $token  = env('TWILIO_TOKEN');
                        $twilio = new TwilioClient($sid, $token);

                        $to =env('TWILIO_WHATSAPP_TO') ; // Le numéro du destinataire
                        $from =env('TWILIO_WHATSAPP_FROM') ; // Votre numéro Twilio WhatsApp

                        $message = $twilio->messages
                            ->create($to, [
                                "from" => $from,
                                "body" => "Le Camion avec le matricul: " . $camion->matricule . ", avec id= " . $camion->id . " vous lui devez " . number_format($camion->restant(), 0, ',', ' ') . " CFA ,Vous devriez Rembourser le " . \Carbon\Carbon::parse($camion->date_remboursement)->isoFormat('dddd D/M/YYYY'),
                            ]);
                        // Envoyez la notification à cet utilisateur
                        $adminUser->notify(new RemboursementCamion($camion));
                        // Marquez que la notification a été envoyée
                        $camion->notification = true;
                        $camion->save();
                    }
                }

            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
