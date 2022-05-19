<?php

namespace App\Notifications\DespachoCombustible;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class EnviarNotiChoferDespachoCombustible extends Notification
{
    use Queueable;
    public $dc;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($dc)
    {
        $this->dc=$dc;
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
                    ->subject('DESPACHO DE COMBUSTIBLE '.$this->dc->estado)
                    ->line('FORMULARIO DE AUTORIZACIÓN PARA EL DESPACHO DEL COMBUSTIBLE '.$this->dc->estado)
                    ->LINE(new HtmlString('<strong>CÓDIGO: '.$this->dc->codigo.'</strong>'))
                    ->LINE('N° ORDEN: '.$this->dc->numero)
                    ->line('FECHA: '.$this->dc->fecha)
                    ->line('N° MOVIL: '.$this->dc->vehiculo->numero_movil)
                    ->line('CONCEPTO: '.$this->dc->concepto)
                    ->line('CANTIDAD GALONES: '.$this->dc->cantidad_galones)
                    ->line('VALOR: '.$this->dc->valor);
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
