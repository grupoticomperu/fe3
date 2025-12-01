<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class NotificationShipment extends Component
{

    public $notifications;
    public $noti;

    protected $listeners = ['cantidad'];

    public function mount(){
        $this->notifications = auth()->user()->notifications;//trae todas las notificaciones
        //$this->noti = auth()->user()->local->notification;//para mostrar la cantidad de notificaciones
        $this->noti = auth()->user()->notification;
    }

    public function read($notification_id){
        $notification = auth()->user()->notifications()->findOrFail($notification_id);
        $notification->markAsRead();//guarda el campoone fecha al campo read_at
    }

    public function render()
    {
        $this->notifications = auth()->user()->notifications;//trae todas las notificaciones
        //$this->noti = auth()->user()->local->notification;
        $this->noti = auth()->user()->notification;
        return view('livewire.admin.notification-shipment');
    }


    public function resetNotificationCount(){
        //auth()->user()->notification = 0;
        //auth()->user()->save();
    }

    public function cantidad(){
        $this->notifications = auth()->user()->notifications;//trae todas las notificaciones
        //$this->noti = auth()->user()->local->notification;
        $this->noti = auth()->user()->notification;
    }

}
