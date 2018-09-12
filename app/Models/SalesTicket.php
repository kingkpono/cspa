<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class SalesTicket extends Model
{

    use Notifiable;

    protected $fillable = [
       'client_id', 'service_type_id' ,'device','serial_number', 
        'device_description', 'device_warranty','project_details', 'start_date','end_date',
            'status','project_officers', 'attachment'];

    
    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function serviceType()
    {
        return $this->belongsTo('App\Models\ServiceType', 'service_type_id');
    }

   
   
}
