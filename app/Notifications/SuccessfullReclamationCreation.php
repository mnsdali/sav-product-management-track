<?php

namespace App\Notifications;

use DateTime;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\VonageMessage;
use Illuminate\Support\Facades\Date;

class SuccessfullReclamationCreation extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected string $date_creation;
    protected string $num_tel;
    public function __construct($num_tel, $date_creation)
    {
        $this->num_tel = $num_tel;
        $this->date_creation = $date_creation;
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
    public function toVonage($notifiable)
    {
        return (new VonageMessage())
            ->content('votre réclamation a été enregistré sous le numéro '.$this->num_tel. 'à partir de la date ('
            . $this->date_creation .
            ') restez joinable dans les 48 heures notre technicien résoudra votre probléme');
    }
}
