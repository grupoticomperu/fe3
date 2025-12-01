<?php

namespace App\Notifications;

use App\Models\Local;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;


class ProductSent extends Notification
{
    use Queueable;

    public $shipment;


    public function __construct( $shipment)
    {
       $this->shipment = $shipment;
    }


    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];

    }


    public function toMail($notifiable)
    {

        return (new MailMessage)
                    ->error() //color rojo del boton
                    ->line('Tienes un envio.')
                    ->greeting('Bienvenido a TICOM')
                    ->line('Para ver el envío hacer click aqui.')
                    ->action('ver Envio', url('admin/shipments/'.strval($this->shipment->id)))
                    ->line('Hasta Pronto');

    }


    public function toDatabase($notifiable)
    {
        //notifiable es un campo agregado en la tabla user
        $notifiable->notification +=1;
        $notifiable->save();
     /*    $local = Local::where('user_id', $notifiable->id)->first();
        $local->notification +=1;
        $local->save(); */

        return [
           'shipment'=>$this->shipment->id,//guardo el shipment
           'url'=>route('reception.edit',$this->shipment->id),
           'message'=> 'Has recibido un mensaje de ' . Local::find($this->shipment->local_envia_id)->name,
           'state'=> 2
        ];
    }



    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            /* 'id' => $this->shipment->id,
            'message'=> 'Has recibido un mensaje de ' . Local::find($this->shipment->local_envia_id)->name, */
        ]);
    }


    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
