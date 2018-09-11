<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class SalesTicket extends Model
{

    use Notifiable;
   

    
    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function serviceType()
    {
        return $this->belongsTo('App\Models\ServiceType', 'service_type_id');
    }

    public function device()
    {
        return $this->belongsTo('App\Models\Device', 'device_id');
    }
   
}
