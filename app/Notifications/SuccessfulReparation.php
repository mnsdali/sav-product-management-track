<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\VonageMessage;
use Illuminate\Notifications\Notification;

class SuccessfulReparation extends Notification
{
    use Queueable;

    protected string $date_heure_intervention;
    protected string $cl_nom;
    protected string $type_panne;
    protected string $choix_cout_piece;
    public function __construct($cl_nom, $date_heure_intervention, $type_panne, $choix_cout_piece )
    {
        $this->cl_nom = $cl_nom;
        $this->date_heure_intervention = $date_heure_intervention;
        $this->type_panne = $type_panne;
        $this->choix_cout_piece = $choix_cout_piece;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        // return ['mail'];
        return ['vonage'];

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

    /**
     * Get the Vonage / SMS representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\VonageMessage
     */
    public function toVonage($notifiable)
    {
        return (new VonageMessage())
            ->content("votre machine a été réparé avec succés: \r\n".
            "Client: ".$this->cl_nom. "\r\n".
            "Date Intervention: ".$this->date_heure_intervention. "\r\n".
            "Type de panne: ". $this->type_panne . "\r\n".
            "Choix entre piéce vendue ou changée; ". $this->choix_cout_piece);
    }
}
