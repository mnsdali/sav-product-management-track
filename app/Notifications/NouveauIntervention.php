<?php

namespace App\Notifications;

use DateTime;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\VonageMessage;
use Illuminate\Support\Facades\Date;

class NouveauIntervention extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

    protected string $cl_nom;
    protected string $type_panne;
    protected string $date_limite;

    protected string $geoloc_adress;
    public function __construct($cl_nom, $geoloc_adress,  $type_panne, $date_limite )
    {
        $this->cl_nom = $cl_nom;
        $this->geoloc_adress = $geoloc_adress;
        $this->type_panne = $type_panne;
        $this->date_limite = $date_limite;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    // public function via(object $notifiable): array
    // {
    //     return ['mail'];
    // }

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

    public function via($notifiable)
    {
        return ['vonage'];
    }

    /**
     * Get the Vonage / SMS representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\VonageMessage
     */
    public function toVonage($notifiable )
    {
        return (new VonageMessage())
            ->content(
            '-client: '. $this->cl_nom              ."\r\n".
            '-géolocalisation'.$this->geoloc_adress ."\r\n".
            '-numéro de série'                      ."\r\n".
            '-type de panne: '. $this->type_panne   ."\r\n".
            '-deadline: ' . $this->date_limite);
    }
}
