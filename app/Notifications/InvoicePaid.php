<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvoicePaid extends Notification
{
    use Queueable;
    public $address;

    /**
     * Create a new notification instance.
     */
    public function __construct($address)
    {
        $this->address = $address;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Nouvelle adresse ajoutée dans ton carnet')
            ->line('Une nouvelle adresse a été ajoutée dans ton carnet.')
            ->line('Nom: ' . $this->address->nom)  // Accès à la propriété 'nom' si $address est un objet
            ->line('Numéro: ' . $this->address->numero) // Accès à la propriété 'numero'
            ->line('Adresse: ' . $this->address->address) // Accès à la propriété 'address'
            ->action('Voir les détails', url('/'))
            ->line('Merci d\'utiliser notre service!');
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