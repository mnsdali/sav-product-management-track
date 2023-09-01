<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\VonageMessage;
use Illuminate\Notifications\Notification;

class NouveauProduit extends Notification
{
    use Queueable;

    protected string $date_achat;
    protected string $cl_nom;
    protected string $num_tel;
    protected string $vendeur_nom;
    protected string $num_serie;
    public function __construct($cl_nom, $num_serie, $date_achat, $num_tel, $vendeur_nom )
    {
        $this->num_serie = $num_serie;
        $this->cl_nom = $cl_nom;
        $this->date_achat = $date_achat;
        $this->num_tel = $num_tel;
        $this->vendeur_nom = $vendeur_nom;
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
            ->content("Félicitation pour l'achat du nouveau produit: \r\n".
            "Client: ".$this->cl_nom. "\r\n".
            "Numéro de série: ".$this->num_serie. "\r\n".
            "Date d'Achat: ". $this->date_achat . "\r\n".
            "Num téléphone: ". $this->num_tel. "\r\n".
            "Vendeur: ". $this->vendeur_nom);
    }
}
