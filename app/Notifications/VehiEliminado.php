<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class VehiEliminado extends Notification
{
    use Queueable;

    protected $vehi;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($vehi)
    {
        $this->vehi = $vehi;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('El vehículo con ID ' . $this->vehi->id . ' ha sido eliminado.')
                    ->action('Ver Vehículos', url('/vehis'))
                    ->line('Gracias por usar nuestra aplicación!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'vehi_id' => $this->vehi->id,
            'message' => 'El vehículo ha sido eliminado.'
        ];
    }
}