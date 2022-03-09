<?php

namespace App\Notifications;

use App\Models\OrdenMovilizacion;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrdenMovilizacionIngresadaNoty extends Notification
{
    use Queueable;
    protected $orden;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(OrdenMovilizacion $orden)
    {
        $this->orden=$orden;
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
                    ->subject('Nueva orden de movilización enviado')
                    ->line('ACEPTAR o DENEGAR')
                    ->line('Orden '.$this->orden->numero)
                    ->action('Aceptar O Denegar', route('controlOdernMovilizacion'))
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
            //
        ];
    }
}
